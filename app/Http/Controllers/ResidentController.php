<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resident;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = $user->id_users;
        $userRole = $user->role;

        // Base query
        $query = Resident::query();

        if ($userRole === 'admin') {
            // Admin bisa lihat semua data
            $residents = $query->orderBy('created_at', 'desc')
                ->paginate(10); // <-- tambahkan pagination
        } else {
            // User biasa hanya bisa lihat data miliknya
            $residents = $query->where('users_id', $userId)
                ->orderBy('created_at', 'desc')
                ->paginate(10); // <-- tambahkan pagination
        }

        return view('users.resident', compact('residents'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.resident-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:16|unique:residents,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'nullable|string',
            'agama' => 'nullable|string|max:50',
            'status_perkawinan' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'kewarganegaraan' => 'nullable|string|max:50',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
        ]);

        $validated['users_id'] = Auth::user()->id_users;

        Resident::create($validated);

        return redirect()->route('resident.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        $resident = Resident::findOrFail($id);

        // Cek akses: admin bisa lihat semua, user biasa hanya miliknya
        if ($user->role !== 'admin' && $resident->users_id !== $user->id_users) {
            return redirect()->route('resident.index')->with('error', 'Anda tidak memiliki akses ke data ini.');
        }

        return view('users.resident-show', compact('resident'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        $resident = Resident::findOrFail($id);

        // Cek akses
        if ($user->role !== 'admin' && $resident->users_id !== $user->id_users) {
            return redirect()->route('resident.index')->with('error', 'Anda tidak memiliki akses ke data ini.');
        }

        return view('users.resident-edit', compact('resident'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $resident = Resident::findOrFail($id);

        // Cek akses
        if ($user->role !== 'admin' && $resident->users_id !== $user->id_users) {
            return redirect()->route('resident.index')->with('error', 'Anda tidak memiliki akses ke data ini.');
        }

        $validated = $request->validate([
            'nik' => 'required|string|max:16|unique:residents,nik,' . $id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'nullable|string',
            'agama' => 'nullable|string|max:50',
            'status_perkawinan' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'kewarganegaraan' => 'nullable|string|max:50',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
        ]);

        $resident->update($validated);

        return redirect()->route('resident.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $resident = Resident::findOrFail($id);

        // Cek akses: hanya admin yang bisa hapus
        if ($user->role !== 'admin') {
            return redirect()->route('resident.index')->with('error', 'Hanya admin yang dapat menghapus data.');
        }

        $resident->delete();

        return redirect()->route('resident.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
