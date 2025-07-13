<?php
namespace App\Http\Controllers\Frontend\Bandung;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function index()
    {
        return view('frontend.bandung.auth.DataDiri');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Arahkan pengguna ke dashboard atau halaman lain
        return redirect()->route('register.index');
    }

    public function DataDiri(Request $request)
    {
        $this->validate($request, [
            'no_ktp',
            'no_sim',
            'alamat',
            'nama',
            'no_hp',
            'email',
            'no_ktm',
        ]);

        Pelanggan::create([
            'no_ktp' => $request->no_ktp,
            'no_sim' => $request->no_sim,
            'alamat' => $request->alamat,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'no_ktm' => $request->no_ktm,
        ]);

        return redirect()->route('home.index')->with(['success' => 'Data Berhasil Ditambahkan']);
    }

}
