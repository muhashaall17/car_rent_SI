<?php

namespace App\Http\Controllers\Frontend\Bandung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SewaController extends Controller
{
    public function create($id_mobil)
    {
        $mobil = Mobil::findOrFail($id_mobil); // Get the selected car
        $user = Auth::user(); // Get the logged-in user

        return view('frontend.bandung.sewa', compact('mobil', 'user'));
    }

    public function store(Request $request, $id_mobil)
    {
        $mobil = Mobil::find($request->id_mobil);
        $tanggal_sewa = Carbon::parse($request->tanggal_sewa);
        $tanggal_kembali = Carbon::parse($request->tanggal_kembali);

        $total_biaya = $request->total_biaya;
        $metode_pembayaran = $request->metode_pembayaran;
        $bukti_pembayaran = $request->bukti_pembayaran;

        // Store transaction
        if ($mobil->isAvailable($tanggal_sewa, $tanggal_kembali)){
            Rental::create([
                'id_pelanggan' => $request->id_pelanggan,
                'id_mobil' => $mobil->id_mobil,
                'tanggal_sewa' => $tanggal_sewa,
                'tanggal_kembali' => $tanggal_kembali,
                'total_biaya' => $total_biaya,
                'metode_pembayaran' => $metode_pembayaran,
                'bukti_pembayaran' => $bukti_pembayaran,
                'status' => 'ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        

        // Update car status
        $mobil->update(['status' => 'disewa']);
        return redirect()->route('transaksi.success')->with('success', 'Transaksi berhasil!');
    }

}  
        