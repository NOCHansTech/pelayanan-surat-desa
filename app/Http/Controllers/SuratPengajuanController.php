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

class SuratPengajuanController extends Controller
{
    public function index(Request $request)
    {
        $query = SuratPengajuan::with('jenisSurat');

        $jumlah = SuratPengajuan::whereYear('created_at', now()->year)
            ->where('status', 'selesai')
            ->count();

        $nomorSurat = str_pad($jumlah + 1, 3, '0', STR_PAD_LEFT);

        // Jika user login adalah warga, filter berdasarkan id_residents
        if (Auth::user()->role === 'warga') {
            $residentIds = Resident::where('users_id', Auth::user()->id_users)->pluck('id');

            if ($residentIds->isNotEmpty()) {
                $query->whereIn('id_residents', $residentIds);
            } else {
                // Jika data resident tidak ditemukan, kembalikan halaman dengan data kosong
                return view('surat-pengajuan.index', [
                    'data' => collect([]),
                    'filter_status' => $request->status,
                    'filter_bulan' => $request->bulan,
                    'filter_tahun' => $request->tahun,
                    'nomorSurat' => $nomorSurat,
                ]);
            }
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

        // Filter berdasarkan bulan dan tahun jika tersedia
        if ($request->bulan) {
            $query->whereMonth('created_at', $request->bulan);
        }

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

        // Ambil data residents berdasarkan role
        $residents = $userRole === 'admin'
            ? \App\Models\Resident::all()
            : \App\Models\Resident::where('users_id', $userId)->get();

        // Ambil semua jenis surat
        $jenisSurat = \App\Models\JenisSurat::all();

        return view('surat-pengajuan.create', compact('residents', 'jenisSurat'));
    }


    public function getResidentData($users_id)
    {
        // Mengambil data resident berdasarkan ID
        $resident = Resident::findOrFail($users_id);

        return response()->json($resident);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jenis_surat' => 'required|exists:jenis_surat,id',
            'nik' => 'required|digits:16',
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
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'tanggal_pengajuan.required' => 'Tanggal pengajuan wajib diisi.',
            'tanggal_pengajuan.after_or_equal' => 'Tanggal pengajuan tidak boleh sebelum hari ini.',
        ]);

        DB::beginTransaction();

        try {
            $userId = Auth::user()->id_users;

            // Simpan atau update data warga
            $resident = Resident::updateOrCreate(
                ['nik' => $request->nik, 'users_id' => $userId],
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

            return redirect()->route('surat-pengajuan')->with('success', 'Pengajuan surat berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function detail($id)
    {
        $surat = SuratPengajuan::with(['resident', 'jenisSurat'])->findOrFail($id);

        return view('surat-pengajuan.detail', compact('surat'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diajukan,diproses,ditolak,selesai',
            'nomor_surat' => 'nullable|string', // Validasi jika nomor_surat perlu
        ]);

        $surat = SuratPengajuan::findOrFail($id);
        $surat->status = $request->status;

        if ($request->status === 'selesai') {
            // Kalau statusnya "selesai", baru kita update nomor_surat
            $surat->tanggal_disetujui = now();

            // Hitung nomor surat baru berdasarkan jumlah surat selesai tahun ini
            $jumlah = SuratPengajuan::whereYear('created_at', now()->year)
                ->where('status', 'selesai')
                ->count();

            // Generate nomor surat baru dengan 3 digit
            $nomorSurat = str_pad($jumlah + 1, 3, '0', STR_PAD_LEFT);
            $surat->nomor_surat = $nomorSurat;
        } else {
            // Kalau status selain selesai, biarkan nomor_surat tetap sama atau tidak diubah
            // Kalau status selain selesai, kita bisa kosongin nomor_surat atau biarkan tetap
            // Jika ingin menghapus nomor_surat, uncomment bagian bawah ini:
            // $surat->nomor_surat = null;
        }

        // Simpan perubahan
        $surat->save();

        return back()->with('success', 'Status berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $surat = SuratPengajuan::findOrFail($id);
        $surat->delete();

        return redirect()->route('surat-pengajuan')->with('success', 'Data surat berhasil dihapus.');
    }


    public function cetakSKTM($id)
    {
        $surat = SuratPengajuan::with('resident', 'jenisSurat')->findOrFail($id);
        $pdf = Pdf::loadView('surat-pengajuan.pdf.sktm', compact('surat'))
            ->setPaper([0, 0, 595.276, 935.433], 'portrait');
        return $pdf->stream('surat_keterangan_tidak_mampu.pdf');
    }

    public function cetakSku($id)
    {
        $surat = SuratPengajuan::with('resident', 'jenisSurat')->findOrFail($id);

        $pdf = Pdf::loadView('surat-pengajuan.pdf.sku', compact('surat'))
            ->setPaper('F4', 'portrait');

        return $pdf->stream('surat-keterangan-usaha.pdf');
    }
    public function cetakDomisili($id)
    {
        $surat = SuratPengajuan::with('resident', 'jenisSurat')->findOrFail($id);
        $pdf = Pdf::loadView('surat-pengajuan.pdf.domisili', compact('surat'));
        return $pdf->stream('surat_domisili.pdf');
    }

    public function cetakDomisiliLembaga($id)
    {
        $surat = SuratPengajuan::with('resident', 'jenisSurat')->findOrFail($id);
        $pdf = Pdf::loadView('surat-pengajuan.pdf.domisili_lembaga', compact('surat'));
        return $pdf->stream('surat_domisili_lembaga.pdf');
    }
    public function cetakUmum($id)
    {
        $surat = SuratPengajuan::with('resident', 'jenisSurat')->findOrFail($id);
        $bulan = \Carbon\Carbon::parse($surat->tanggal_pengajuan)->format('n');
        $tahun = \Carbon\Carbon::parse($surat->tanggal_pengajuan)->format('Y');
        $bulanRomawi = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'];

        $pdf = Pdf::loadView('surat-pengajuan.pdf.umum', compact('surat', 'bulan', 'tahun', 'bulanRomawi'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('surat-umum.pdf');
    }
}
