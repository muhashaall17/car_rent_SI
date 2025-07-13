<?php

namespace App\Http\Controllers\Frontend\Bandung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;

class HomeController extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::all();
        return view('frontend.bandung.home', compact('kendaraan'));
    }
}
