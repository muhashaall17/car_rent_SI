<?php

namespace App\Http\Controllers\Backend\Bandung\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function login()
    {
        // Jika user sudah login, redirect ke halaman home atau dashboard
        if (Auth::check()) {
            return redirect(route('dashboard.index'));
        } else {
            return view('backend.bandung.auth.login');
        }
    }

    // Proses login

    public function actionlogin(Request $request)
    {
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ];
        if (Auth::Attempt($data)) {
            $user = Auth::user();
            if ($user->role == 'super_admin') {
                return redirect()->route('dashboard.index');
            } elseif ($user->role == 'admin') {
                return redirect()->route('dashboard.index'); // bisa arahkan ke route lain jika perlu
            } else {
                return redirect('/'); // fallback untuk role lain
            }
        } else {
            return redirect('/login/admin')->with('error', 'Username atau Password Salah');
        }
    }

    // Logout
    public function actionlogout()
    {
        Auth::logout(); // Logout user
        return redirect('/login/admin'); // Redirect ke halaman login
    }
}
