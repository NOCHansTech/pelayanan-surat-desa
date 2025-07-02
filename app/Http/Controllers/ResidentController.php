<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data warga yang sesuai dengan filter pencarian (jika ada)
        $query = Resident::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_lengkap', 'like', "%$search%")
                ->orWhere('nik', 'like', "%$search%");
        }

        $data = $query->paginate(10); // Paginate hasilnya untuk menampilkan 10 data per halaman

        // Kirim data ke view
        return view('users.resident', compact('data'));
    }
}
