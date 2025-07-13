<?php

namespace App\Http\Controllers\Frontend\Bandung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $history = Rental::where('id_pelanggan', Auth::user()->name)->paginate(10);
        return view('frontend.bandung.riwayat', compact('history'));
    }
}
