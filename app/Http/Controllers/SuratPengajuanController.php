<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Resident;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use App\Models\SuratPengajuan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Pagination\LengthAwarePaginator;

class SuratPengajuanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $query = SuratPengajuan::with(['jenisSurat', 'resident']);

        $jumlah = SuratPengajuan::whereYear('created_at', now()->year)
            ->where('status', 'selesai')
            ->count();

        $nomorSurat = str_pad($jumlah + 1, 3, '0', STR_PAD_LEFT);

        // Filter berdasarkan role
        if ($user->role === 'warga') {
            $residentIds = Resident::where('users_id', $user->id_users)->pluck('id');

            if ($residentIds->isEmpty()) {
                // Buat empty paginator
                $data = new LengthAwarePaginator(
                    [],           // items
                    0,            // total
                    10,           // per page
                    1,            // current page
                    ['path' => $request->url(), 'query' => $request->query()]
                );

                return view('surat-pengajuan.index', [
                    'data' => $data,
                    'filter_status' => $request->status,
                    'filter_bulan' => $request->bulan,
                    'filter_tahun' => $request->tahun,
                    'nomorSurat' => $nomorSurat,
                ]);
            }

            $query->whereIn('id_residents', $residentIds);
        }

        // Filter pencarian umum
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('jenisSurat', function ($q2) use ($request) {
                    $q2->where('nama', 'like', '%' . $request->search . '%');
                })
                    ->orWhereHas('resident', function ($q2) use ($request) {
                        $q2->where('nama_lengkap', 'like', '%' . $request->search . '%');
                    })
                    ->orWhere('nomor_surat', 'like', '%' . $request->search . '%')
                    ->orWhere('status', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan bulan
        if ($request->bulan) {
            $query->whereMonth('created_at', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->tahun) {
            $query->whereYear('created_at', $request->tahun);
        }

        $data = $query->orderByDesc('created_at')->paginate(10);

        return view('surat-pengajuan.index', [
            'data' => $data,
            'filter_status' => $request->status,
            'filter_bulan' => $request->bulan,
            'filter_tahun' => $request->tahun,
            'nomorSurat' => $nomorSurat,
        ]);
    }

    public function create()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = $user->id_users;
        $userRole = $user->role;

        // Admin bisa melihat semua residents, warga hanya miliknya
        if ($userRole === 'admin') {
            $residents = Resident::orderBy('nama_lengkap', 'asc')->get();
        } else {
            $residents = Resident::where('users_id', $userId)
                ->orderBy('nama_lengkap', 'asc')
                ->get();
        }

        // Ambil semua jenis surat
        $jenisSurat = JenisSurat::all();

        return view('surat-pengajuan.create', compact('residents', 'jenisSurat'));
    }

    public function getResidentData($id)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Admin bisa akses semua data, warga hanya miliknya
        if ($user->role === 'admin') {
            $resident = Resident::find($id);
        } else {
            $resident = Resident::where('id', $id)
                ->where('users_id', $user->id_users)
                ->first();
        }

        if (!$resident) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($resident);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'id_jenis_surat' => 'required|exists:jenis_surat,id',
            'nik' => ['required', 'digits:16', 'regex:/^[0-9]+$/'],
            'nama_lengkap' => 'required|string|max:100',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'agama' => 'nullable|string|max:50',
            'status_perkawinan' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'kewarganegaraan' => 'nullable|string|max:50',
            'nama_ayah' => 'nullable|string|max:100',
            'nama_ibu' => 'nullable|string|max:100',
            'tanggal_pengajuan' => 'required|date|after_or_equal:today',
            'catatan_multi' => 'required|array|min:1',
            'catatan_multi.*' => 'required|string|max:255',
        ], [
            'id_jenis_surat.required' => 'Jenis surat wajib dipilih.',
            'nik.required' => 'NIK tidak boleh kosong.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit angka.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'tanggal_pengajuan.required' => 'Tanggal pengajuan wajib diisi.',
            'tanggal_pengajuan.after_or_equal' => 'Tanggal pengajuan tidak boleh sebelum hari ini.',
            'catatan_multi.required' => 'Catatan wajib diisi minimal 1 item.',
            'catatan_multi.*.required' => 'Setiap catatan tidak boleh kosong.',
        ]);

        DB::beginTransaction();

        try {
            $userId = $user->id_users;

            // Untuk warga, pastikan NIK yang diinput adalah miliknya
            if ($user->role !== 'admin') {
                $existingResident = Resident::where('nik', $request->nik)
                    ->where('users_id', '!=', $userId)
                    ->first();

                if ($existingResident) {
                    DB::rollBack();
                    return back()->with('error', 'NIK sudah terdaftar oleh pengguna lain.')
                        ->withInput();
                }
            }

            // Simpan atau update data warga
            $resident = Resident::updateOrCreate(
                ['nik' => $request->nik],
                [
                    'users_id' => $userId,
                    'nik' => $request->nik,
                    'nama_lengkap' => $request->nama_lengkap,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat' => $request->alamat,
                    'agama' => $request->agama,
                    'status_perkawinan' => $request->status_perkawinan,
                    'pekerjaan' => $request->pekerjaan,
                    'kewarganegaraan' => $request->kewarganegaraan,
                    'nama_ayah' => $request->nama_ayah,
                    'nama_ibu' => $request->nama_ibu,
                ]
            );

            // Validasi kepemilikan resident untuk warga
            if ($user->role !== 'admin' && $resident->users_id !== $userId) {
                DB::rollBack();
                return back()->with('error', 'Anda tidak memiliki akses ke data warga ini.')
                    ->withInput();
            }

            // Simpan surat pengajuan
            $pengajuan = SuratPengajuan::create([
                'id_residents' => $resident->id,
                'id_jenis_surat' => $request->id_jenis_surat,
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'catatan' => collect($request->catatan_multi)
                    ->filter()
                    ->map(fn($item) => trim($item))
                    ->implode("\n"),
                'status' => 'diajukan',
            ]);

            DB::commit();

            return redirect()->route('surat-pengajuan')
                ->with('success', 'Pengajuan surat berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function detail($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $surat = SuratPengajuan::with(['resident', 'jenisSurat'])->findOrFail($id);

        // Validasi akses untuk warga
        if ($user->role !== 'admin') {
            if ($surat->resident->users_id !== $user->id_users) {
                abort(403, 'Anda tidak memiliki akses ke surat ini.');
            }
        }

        return view('surat-pengajuan.detail', compact('surat'));
    }

    public function updateStatus(Request $request, $id)
    {
        $user = Auth::user();

        // Hanya admin yang bisa update status
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengubah status surat.');
        }

        // Validasi input status
        $request->validate([
            'status' => 'required|in:diajukan,diproses,ditolak,selesai',
        ]);

        // Ambil surat berdasarkan ID
        $surat = SuratPengajuan::findOrFail($id);
        $surat->status = $request->status;

        // Jika status diubah menjadi "selesai"
        if ($request->status === 'selesai') {
            // Set tanggal disetujui sekarang
            $surat->tanggal_disetujui = now();

            // Hitung jumlah surat selesai di tahun ini
            $jumlah = SuratPengajuan::whereYear('tanggal_disetujui', now()->year)
                ->whereNotNull('tanggal_disetujui')
                ->count();

            // Nomor surat baru, urut, 3 digit
            $nomorSurat = str_pad($jumlah + 1, 3, '0', STR_PAD_LEFT);
            $surat->nomor_surat = $nomorSurat;
        }

        // Simpan perubahan
        $surat->save();

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Status berhasil diperbarui menjadi: ' . ucfirst($request->status));
    }


    public function destroy($id)
    {
        $user = Auth::user();

        // Hanya admin yang bisa hapus
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menghapus surat.');
        }

        $surat = SuratPengajuan::findOrFail($id);

        // Cek status
        if (in_array($surat->status, ['selesai', 'ditolak'])) {
            return redirect()->route('surat-pengajuan')
                ->with('warning', 'Surat dengan status ' . $surat->status . ' tidak dapat dihapus.');
        }

        $surat->delete();

        return redirect()->route('surat-pengajuan')
            ->with('success', 'Data surat berhasil dihapus.');
    }

    public function cetakSKTM($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $surat = SuratPengajuan::with('resident', 'jenisSurat')->findOrFail($id);

        // Validasi akses untuk warga
        if ($user->role !== 'admin') {
            if ($surat->resident->users_id !== $user->id_users) {
                abort(403, 'Anda tidak memiliki akses ke surat ini.');
            }
        }

        // Cek status
        if ($surat->status !== 'selesai') {
            return redirect()->back()
                ->with('warning', 'Surat hanya dapat dicetak jika sudah selesai.');
        }

        $pdf = Pdf::loadView('surat-pengajuan.pdf.sktm', compact('surat'))
            ->setPaper([0, 0, 595.276, 935.433], 'portrait');

        return $pdf->stream('surat_keterangan_tidak_mampu.pdf');
    }

    public function cetakSku($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $surat = SuratPengajuan::with('resident', 'jenisSurat')->findOrFail($id);

        // Validasi akses untuk warga
        if ($user->role !== 'admin') {
            if ($surat->resident->users_id !== $user->id_users) {
                abort(403, 'Anda tidak memiliki akses ke surat ini.');
            }
        }

        // Cek status
        if ($surat->status !== 'selesai') {
            return redirect()->back()
                ->with('warning', 'Surat hanya dapat dicetak jika sudah selesai.');
        }

        $pdf = Pdf::loadView('surat-pengajuan.pdf.sku', compact('surat'))
            ->setPaper('F4', 'portrait');

        return $pdf->stream('surat-keterangan-usaha.pdf');
    }

    public function cetakDomisili($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $surat = SuratPengajuan::with('resident', 'jenisSurat')->findOrFail($id);

        // Validasi akses untuk warga
        if ($user->role !== 'admin') {
            if ($surat->resident->users_id !== $user->id_users) {
                abort(403, 'Anda tidak memiliki akses ke surat ini.');
            }
        }

        // Cek status
        if ($surat->status !== 'selesai') {
            return redirect()->back()
                ->with('warning', 'Surat hanya dapat dicetak jika sudah selesai.');
        }

        $pdf = Pdf::loadView('surat-pengajuan.pdf.domisili', compact('surat'));

        return $pdf->stream('surat_domisili.pdf');
    }

    public function cetakDomisiliLembaga($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $surat = SuratPengajuan::with('resident', 'jenisSurat')->findOrFail($id);

        // Validasi akses untuk warga
        if ($user->role !== 'admin') {
            if ($surat->resident->users_id !== $user->id_users) {
                abort(403, 'Anda tidak memiliki akses ke surat ini.');
            }
        }

        // Cek status
        if ($surat->status !== 'selesai') {
            return redirect()->back()
                ->with('warning', 'Surat hanya dapat dicetak jika sudah selesai.');
        }

        $pdf = Pdf::loadView('surat-pengajuan.pdf.domisili_lembaga', compact('surat'));

        return $pdf->stream('surat_domisili_lembaga.pdf');
    }

    public function cetakUmum($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $surat = SuratPengajuan::with('resident', 'jenisSurat')->findOrFail($id);

        // Validasi akses untuk warga
        if ($user->role !== 'admin') {
            if ($surat->resident->users_id !== $user->id_users) {
                abort(403, 'Anda tidak memiliki akses ke surat ini.');
            }
        }

        // Cek status
        if ($surat->status !== 'selesai') {
            return redirect()->back()
                ->with('warning', 'Surat hanya dapat dicetak jika sudah selesai.');
        }

        $bulan = Carbon::parse($surat->tanggal_pengajuan)->format('n');
        $tahun = Carbon::parse($surat->tanggal_pengajuan)->format('Y');
        $bulanRomawi = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];

        $pdf = Pdf::loadView('surat-pengajuan.pdf.umum', compact('surat', 'bulan', 'tahun', 'bulanRomawi'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('surat-umum.pdf');
    }
}
