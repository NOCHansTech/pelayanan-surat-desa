<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $data = JenisSurat::when($search, function ($query, $search) {
            return $query->where('kode', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('jenis-surat.index', compact('data', 'search'));
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode' => 'required|unique:jenis_surat,kode',
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        // Simpan ke database
        JenisSurat::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Jenis surat berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|unique:jenis_surat,kode,' . $id,
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        JenisSurat::findOrFail($id)->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
    public function delete($id)
    {
        JenisSurat::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
