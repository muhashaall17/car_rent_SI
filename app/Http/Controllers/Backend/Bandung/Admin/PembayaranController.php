<?php

namespace App\Http\Controllers\Backend\Bandung\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\CashIn;
use App\Models\Rental;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index()
    {
        // $pembayaran = Pembayaran::all();
        $pembayaran = DB::table('pembayaran as py')
            ->leftJoin('rental as inv', 'inv.id', '=', 'py.rental_id')
            ->select('py.*', 'inv.no_invoice', 'inv.nama_pelanggan')
            ->get();

        return view('backend.bandung.pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        $rental_id = Rental::all();
        return view('backend.bandung.pembayaran.create', compact('rental_id'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'rental_id' => 'required',
                'date' => 'required',
                'method' => 'required',
                'nominal' => 'required|numeric',
            ]);

            $payment = Pembayaran::create([
                'rental_id' => $request->rental_id,
                'tgl_bayar' => $request->date,
                'metode_pembayaran' => $request->method,
                'nominal' => $request->nominal
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Berhasil Menyimpan Pembayaran',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateDataPayment(Request $request)
    {
        try {
            $this->validate($request, [
                'date' => 'required',
                'method' => 'required',
                'nominal' => 'required|numeric'
            ]);

            $payment = Pembayaran::findOrFail($request->payment_id);

            $payment->update([
                'tgl_bayar' => $request->date,
                'metode_pembayaran' => $request->method,
                'nominal' => $request->nominal
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Berhasil Mengubah Pembayaran',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function deleteDataPayment(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required'
            ]);

            $payment = Pembayaran::findOrFail($request->id);

            $payment->delete();

            return response()->json([
                'success' => true,
                'msg' => 'Berhasil Menghapus Pembayaran',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
