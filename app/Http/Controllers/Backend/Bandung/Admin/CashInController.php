<?php

namespace App\Http\Controllers\Backend\Bandung\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Cabang;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CashIn;

class CashInController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Filter cabang berdasarkan role
        if ($user->role === 'super_admin') {
            // Super admin dapat mengakses semua cabang
            $cabangs = Cabang::all();
        } elseif ($user->role === 'admin') {
            // Admin hanya dapat mengakses cabang_id miliknya
            $cabangs = Cabang::where('id', $user->cabang_id)->get();
        } else {
            // Jika role tidak dikenali, kosongkan cabangs
            $cabangs = [];
        }

        $cash_in = CashIn::all();
        return view('backend.bandung.cash_in.index', compact('cabangs'));
    }

    public function getDataTableCashIn()
    {
        $user = Auth::user();

        // Filter cabang berdasarkan role
        if ($user->role === 'super_admin') {
            $cabangs = Cabang::all();
        } elseif ($user->role === 'admin') {
            $cabangs = Cabang::where('id', $user->cabang_id)->get();
        } else {
            $cabangs = [];
        }

        // Ambil daftar ID cabang
        $cabangIds = $cabangs->pluck('id')->toArray();

        $cash_in = DB::table('cash_in as ci')
            ->leftJoin('cabang as cb', 'cb.id', '=', 'ci.cabang_id')
            ->select(
                'ci.id',
                'ci.tgl_cin',
                'ci.nominal',
                'ci.deskripsi',
                'ci.payment_id',
                'cb.nama_cabang'
            )
            ->whereIn('ci.cabang_id', $cabangIds)
            ->get();

        return response()->json(['data' => $cash_in]);
    }

    public function create()
    {
        $pembayaran = Pembayaran::all();
        return view('backend.bandung.cash_in.create', compact('pembayaran'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'nominal' => 'required|numeric',
                'desc' => 'required',
                'date' => 'required',
                'cabang_id' => 'required',
            ]);

            CashIn::create([
                'nominal' => $request->nominal,
                'deskripsi' => $request->desc,
                'tgl_cin' => $request->date,
                'cabang_id' => $request->cabang_id,
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Berhasil Menyimpan Cash In',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getDataCashIn(Request $request)
    {
        $idCashIn = $request->input('id');  // Ambil idrental dari request

        // Query data berdasarkan idrental
        $dataCashIn = DB::table('cash_in')
            ->where('id', $idCashIn)
            ->first();

        return response()->json(['data' => $dataCashIn]);
    }

    public function updateDataCashIn(Request $request)
    {
        try {
            $this->validate($request, [
                'nominal' => 'required|numeric',
                'desc' => 'required',
                'date' => 'required',
                'cabang_id' => 'required',
            ]);

            $cash_in = CashIn::findOrFail($request->cashIn_id);

            $cash_in->update([
                'nominal' => $request->nominal,
                'deskripsi' => $request->desc,
                'tgl_cout' => $request->date,
                'cabang_id' => $request->cabang_id,
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Berhasil Mengubah Cash Out',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function deleteDataCashIn(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required'
            ]);

            $cashIn = CashIn::where('id', $request->id)->first();

            if ($cashIn) {
                $cashIn->delete();
                return response()->json([
                    'success' => true,
                    'msg' => 'Berhasil Menghapus Cash In',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data Cash In Tidak Ditemukan',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::all();
        $cash_in = CashIn::where('id', $id)->first();
        return view('backend.bandung.cash_in.edit', compact('cash_in', 'pembayaran'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nominal',
            'deskripsi',
            'payment_id'
        ]);

        $cash_in = CashIn::where('id', $id)->first();
        $cash_in->update($request->all());
        return redirect()->route('CashIn.index')->with(['message' => 'CashIn Berhasil Diubah']);
    }

    public function destroy($id)
    {
        $cash_in = CashIn::where('id', $id)->first();
        $cash_in->delete();
        return redirect()->route('CashIn.index')->with(['message' => 'CashIn Berhasil Dihapus']);
    }
}
