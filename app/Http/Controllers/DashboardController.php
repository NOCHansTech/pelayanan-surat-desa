<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use App\Models\SuratPengajuan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


    public function index()
    {
        $user = Auth::user();
        $nama_users = $user->username;
        $role = $user->role;

        // Default query SuratPengajuan
        $query = SuratPengajuan::query();

        // Jika user adalah warga, filter berdasarkan id_residents
        if ($role === 'warga') {
            $resident = Resident::where('users_id', $user->id_users)->first();

            if ($resident) {
                $query->where('id_residents', $resident->id);
            } else {
                // Tidak ada resident, semua count = 0
                return view('dashboard.index', [
                    'pengajuan_diajukan' => 0,
                    'pengajuan_diproses' => 0,
                    'pengajuan_ditolak' => 0,
                    'pengajuan_selesai' => 0,
                    'recent_activities' => collect(),
                    'nama_users' => $nama_users,
                    'role' => $role,
                ]);
            }
        }

        // Hitung jumlah per status
        $pengajuan_diajukan = (clone $query)->where('status', 'diajukan')->count();
        $pengajuan_diproses = (clone $query)->where('status', 'diproses')->count();
        $pengajuan_ditolak = (clone $query)->where('status', 'ditolak')->count();
        $pengajuan_selesai = (clone $query)->where('status', 'selesai')->count();

        // Ambil recent activities (5 terakhir)
        $recent_activities = (clone $query)
            ->with('jenisSurat') // pastikan ada relasi jenisSurat di model SuratPengajuan
            ->latest('tanggal_pengajuan')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'pengajuan_diajukan',
            'pengajuan_diproses',
            'pengajuan_ditolak',
            'pengajuan_selesai',
            'recent_activities',
            'nama_users',
            'role'
        ));
    }
}
