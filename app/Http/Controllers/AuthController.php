<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function proseslogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cek kredensial
        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Jika berhasil, lakukan login
            Auth::login($user);

            return redirect()->route('dashboard');
        } else {
            // Jika gagal, simpan pesan peringatan ke session
            Session::flash('warning', 'Username atau password salah');

            // Redirect kembali ke halaman login
            return redirect()->route('login');
        }
    }

    public function proseslogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function prosesregister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username|max:255',
            'password' => 'required|min:6|confirmed',
            'nik' => 'required|digits:16|unique:residents,nik',
            'nama_lengkap' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'kampung' => 'required|string|max:255|regex:/^Kp\. .+$/',
            'rt' => 'required|digits:3',
            'rw' => 'required|digits:3',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'status_perkawinan' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'kewarganegaraan' => 'required|string|max:50',
            'nama_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            'desa_kec_prov' => 'required|string|max:255',
        ], [
            'username.required' => 'Kolom nama pengguna wajib diisi.',
            'username.unique' => 'Nama pengguna sudah terdaftar.',
            'username.max' => 'Nama pengguna tidak boleh lebih dari 255 karakter.',
            'password.required' => 'Kolom kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'nik.required' => 'Kolom NIK wajib diisi.',
            'nik.digits' => 'Kolom NIK harus terdiri dari 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama_lengkap.required' => 'Kolom nama lengkap wajib diisi.',
            'nama_lengkap.max' => 'Nama lengkap tidak boleh lebih dari 100 karakter.',
            'tempat_lahir.required' => 'Kolom tempat lahir wajib diisi.',
            'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 100 karakter.',
            'tanggal_lahir.required' => 'Kolom tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Kolom tanggal lahir harus berupa tanggal yang valid.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'jenis_kelamin.required' => 'Kolom jenis kelamin wajib diisi.',
            'jenis_kelamin.in' => 'Kolom jenis kelamin harus diisi dengan L (Laki-laki) atau P (Perempuan).',
            'kampung.required' => 'Kolom kampung wajib diisi.',
            'kampung.regex' => 'Format kampung harus diawali dengan "Kp. ".',
            'rt.required' => 'Kolom RT wajib diisi.',
            'rt.digits' => 'Kolom RT harus terdiri dari 3 digit.',
            'rw.required' => 'Kolom RW wajib diisi.',
            'rw.digits' => 'Kolom RW harus terdiri dari 3 digit.',
            'agama.required' => 'Kolom agama wajib diisi.',
            'agama.in' => 'Kolom agama harus diisi dengan salah satu pilihan yang valid.',
            'status_perkawinan.required' => 'Kolom status perkawinan wajib diisi.',
            'pekerjaan.required' => 'Kolom pekerjaan wajib diisi.',
            'kewarganegaraan.required' => 'Kolom kewarganegaraan wajib diisi.',
            'nama_ayah.required' => 'Kolom nama ayah wajib diisi.',
            'nama_ibu.required' => 'Kolom nama ibu wajib diisi.',
            'desa_kec_prov.required' => 'Kolom desa, kecamatan, dan provinsi wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('warning', 'Terdapat kesalahan pada inputan Anda. Silakan periksa kembali.');
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'warga',
        ]);

        // Gabung alamat lengkap
        $alamatLengkap = trim($request->kampung) . ' RT ' . $request->rt . ' RW ' . $request->rw . ', ' . $request->desa_kec_prov;

        Resident::create([
            'users_id' => $user->id_users,
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $alamatLengkap,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'pekerjaan' => $request->pekerjaan,
            'kewarganegaraan' => $request->kewarganegaraan,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }
}
