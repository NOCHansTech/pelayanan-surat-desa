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
    // public function getNomorSurat($id)
    // {
    //     $surat = JenisSurat::findOrFail($id);
    //     // $last = SuratPengajuan::where('id_jenis_surat', $id)
    //     //     ->whereMonth('created_at', now()->month)
    //     //     ->whereYear('created_at', now()->year)
    //     //     ->count();
    //     // Hitung jumlah surat untuk tahun sekarang (reset setiap tahun)
    //     $last = SuratPengajuan::whereYear('created_at', now()->year)->count();

    //     $nomor = str_pad($last + 1, 3, '0', STR_PAD_LEFT);
    //     return response()->json([
    //         'nomor' => $nomor,
    //     ]);
    // }


    public function index(Request $request)
    {
        $query = SuratPengajuan::with('jenisSurat');
        $jumlah = SuratPengajuan::whereYear('created_at', now()->year)->where('status', 'selesai')->count();
        $nomorSurat = str_pad($jumlah + 1, 3, '0', STR_PAD_LEFT);

        // Jika user login adalah warga, filter berdasarkan id_residents
        if (Auth::user()->role === 'warga') {
            $resident = Resident::where('users_id', Auth::user()->id_users)->first();
            if ($resident) {
                $query->where('id_residents', $resident->id);
            } else {
                // Jika data resident tidak ditemukan, kembalikan halaman dengan data kosong
                return view('surat-pengajuan.index', [
                    'data' => collect([]),
                    'filter_status' => $request->status,
                    'filter_bulan' => $request->bulan,
                    'filter_tahun' => $request->tahun,
                    'nomorSurat' => $nomorSurat,  // Pass nomorSurat ke view
                ]);
            }
        }

        // Filter pencarian umum
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                // Pencarian berdasarkan nama pada jenis_surat
                $q->whereHas('jenisSurat', function ($q2) use ($request) {
                    $q2->where('nama', 'like', '%' . $request->search . '%');
                })
                    // Pencarian berdasarkan nama pada resident (kolom nama_lengkap)
                    ->orWhereHas('resident', function ($q2) use ($request) {
                        $q2->where('nama_lengkap', 'like', '%' . $request->search . '%');
                    })
                    // Pencarian berdasarkan nomor surat
                    ->orWhere('nomor_surat', 'like', '%' . $request->search . '%')
                    // Pencarian berdasarkan status
                    ->orWhere('status', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $data = $query->orderByDesc('created_at')->paginate(10);

        return view('surat-pengajuan.index', [
            'data' => $data,
            'filter_status' => $request->status,
            'filter_bulan' => $request->bulan,
            'filter_tahun' => $request->tahun,
            'nomorSurat' => $nomorSurat,  // Pass nomorSurat ke view
        ]);
    }




    public function create()
    {
        $userId = Auth::user()->id_users;
        $userRole = Auth::user()->role; // Misalnya role disimpan dalam tabel users

        // Jika admin, bisa memilih semua resident
        if ($userRole == 'admin') {
            $residents = \App\Models\Resident::all();
        } else {
            // Jika bukan admin, hanya ambil resident terkait user
            $residents = \App\Models\Resident::where('users_id', $userId)->get();
        }

        $jenisSurat = \App\Models\JenisSurat::all();

        return view('surat-pengajuan.create', compact('residents', 'jenisSurat'));
    }

    public function getResidentData($id)
    {
        // Mengambil data resident berdasarkan ID
        $resident = Resident::findOrFail($id);

        return response()->json($resident);
    }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'id_jenis_surat' => 'required|exists:jenis_surat,id',
    //         'nomor_surat' => 'required|string',
    //         'nik' => 'required|string|max:16',
    //         'nama_lengkap' => 'required|string',
    //         'tempat_lahir' => 'nullable|string',
    //         'tanggal_lahir' => 'nullable|date',
    //         'jenis_kelamin' => 'required|in:L,P',
    //         'alamat' => 'nullable|string',
    //         'agama' => 'nullable|string',
    //         'status_perkawinan' => 'nullable|string',
    //         'pekerjaan' => 'nullable|string',
    //         'kewarganegaraan' => 'nullable|string',
    //         'nama_ayah' => 'nullable|string',
    //         'nama_ibu' => 'nullable|string',
    //         'tanggal_pengajuan' => 'required|date',
    //         'catatan' => 'nullable|string',
    //     ]);

    //     DB::beginTransaction();
    //     try {
    //         $userId = Auth::user()->id_users;

    //         // Update or create resident
    //         $resident = Resident::updateOrCreate(
    //             ['users_id' => $userId],
    //             [
    //                 'nik' => $request->nik,
    //                 'nama_lengkap' => $request->nama_lengkap,
    //                 'tempat_lahir' => $request->tempat_lahir,
    //                 'tanggal_lahir' => $request->tanggal_lahir,
    //                 'jenis_kelamin' => $request->jenis_kelamin,
    //                 'alamat' => $request->alamat,
    //                 'agama' => $request->agama,
    //                 'status_perkawinan' => $request->status_perkawinan,
    //                 'pekerjaan' => $request->pekerjaan,
    //                 'kewarganegaraan' => $request->kewarganegaraan,
    //                 'nama_ayah' => $request->nama_ayah,
    //                 'nama_ibu' => $request->nama_ibu,
    //             ]
    //         );

    //         // Create surat pengajuan
    //         SuratPengajuan::create([
    //             'id_residents' => $resident->id,
    //             'id_jenis_surat' => $request->id_jenis_surat,
    //             'nomor_surat' => $request->nomor_surat,
    //             'tanggal_pengajuan' => $request->tanggal_pengajuan,
    //             'catatan' => collect($request->catatan_multi)
    //                 ->filter() // hilangkan yang kosong
    //                 ->values() // reset index
    //                 ->map(function ($item, $i) {
    //                     return ($i + 1) . '. ' . trim($item);
    //                 })
    //                 ->implode("\n"),


    //             'status' => 'diajukan',
    //         ]);

    //         DB::commit();

    //         return redirect()->route('surat-pengajuan')->with('success', 'Pengajuan surat berhasil disimpan.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
    //     }
    // }
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

            $resident = Resident::updateOrCreate(
                ['users_id' => $userId],
                [
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

            SuratPengajuan::create([
                'id_residents' => $resident->id,
                'id_jenis_surat' => $request->id_jenis_surat,
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                // 'catatan' => collect($request->catatan_multi)
                //     ->filter()
                //     ->map(function ($item, $i) {
                //         return ($i + 1) . '. ' . trim($item);
                //     })->implode("\n"),
                'catatan' => collect($request->catatan_multi)
                    ->filter()
                    ->map(function ($item) {
                        return trim($item);
                    })->implode("\n"),
                'status' => 'diajukan',
            ]);

            DB::commit();

            return redirect()->route('surat-pengajuan')->with('success', 'Pengajuan surat berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
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
