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

        // Default query
        $query = SuratPengajuan::query();

        // Jika warga, filter berdasarkan id_residents miliknya
        if ($user->role === 'warga') {
            $resident = Resident::where('users_id', $user->id_users)->first();
            if ($resident) {
                $query->where('id_residents', $resident->id);
            } else {
                // Jika tidak ada data resident, semua count = 0
                return view('dashboard.index', [
                    'pengajuan_diajukan' => 0,
                    'pengajuan_diproses' => 0,
                    'pengajuan_ditolak' => 0,
                    'pengajuan_selesai' => 0,
                    'nama_users' => $nama_users,
                ]);
            }
        }

        // Hitung per status
        $pengajuan_diajukan = (clone $query)->where('status', 'diajukan')->count();
        $pengajuan_diproses = (clone $query)->where('status', 'diproses')->count();
        $pengajuan_ditolak = (clone $query)->where('status', 'ditolak')->count();
        $pengajuan_selesai = (clone $query)->where('status', 'selesai')->count();

        return view('dashboard.index', compact(
            'pengajuan_diajukan',
            'pengajuan_diproses',
            'pengajuan_ditolak',
            'pengajuan_selesai',
            'nama_users'
        ));
    }
}
