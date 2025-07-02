<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $data = User::when($search, function ($query, $search) {
            return $query->where('username', 'like', "%{$search}%");
        })
            ->orderBy('username', 'desc')
            ->paginate(10);
        return view('users.index', compact('data', 'search'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,warga',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users')->with('success', 'User berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $id . ',id_users',
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:admin,warga',
        ]);

        $user->username = $request->username;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Data user berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }
    public function profile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    // public function updateProfile(Request $request)
    // {
    //     $user = Auth::user();

    //     $request->validate([
    //         'username' => 'required|string|unique:users,username,' . $user->id_users . ',id_users',
    //         'password' => 'nullable|string|min:6|confirmed',
    //     ]);

    //     $user->username = $request->username;

    //     if ($request->filled('password')) {
    //         $user->password = Hash::make($request->password);
    //     }

    //     $user->save();

    //     return back()->with('success', 'Profil berhasil diperbarui.');
    // }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|in:' . $user->username,
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'username.in' => 'Maaf, username tidak boleh diubah. Silakan gunakan username asli Anda.',
        ]);


        // Jangan ubah username
        // $user->username = $request->username;  // hapus atau komentar

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
