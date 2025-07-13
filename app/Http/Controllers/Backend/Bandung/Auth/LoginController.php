<?php

namespace App\Http\Controllers\Backend\Bandung\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function login()
    {
        // Jika user sudah login, redirect ke halaman home atau dashboard
        if (Auth::check()) {
            return redirect('/dashboard');
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
        if (Auth::Attempt($data)){
            return redirect('/dashboard');
        }else{
            Session::flash('error', 'salah');
            return redirect('/');     
        }
    }

    // Logout
    public function actionlogout()
    {
        Auth::logout(); // Logout user
        return redirect('/'); // Redirect ke halaman utama
    }
}
