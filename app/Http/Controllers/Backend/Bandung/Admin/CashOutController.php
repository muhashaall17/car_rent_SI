<?php

namespace App\Http\Controllers\Backend\Bandung\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashOut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cabang;

class CashOutController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
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

        $cash_out = CashOut::all();
        return view('backend.bandung.cash_out.index', compact('cabangs'));
    }

    public function getDataTableCashOut()
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

        $cash_out = DB::table('cash_out as co')
            ->leftJoin('cabang as cb', 'cb.id', '=', 'co.cabang_id')
            ->select(
                'co.id',
                'co.tgl_cout',
                'co.nominal',
                'co.deskripsi',
                'cb.nama_cabang'
            )
            ->whereIn('co.cabang_id', $cabangIds)
            ->get();

        return response()->json(['data' => $cash_out]);
    }

    public function create()
    {
        return view('backend.bandung.cash_out.create');
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

            CashOut::create([
                'nominal' => $request->nominal,
                'deskripsi' => $request->desc,
                'tgl_cout' => $request->date,
                'cabang_id' => $request->cabang_id,
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Berhasil Menyimpan Cash Out',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getDataCashOut(Request $request)
    {
        $idCashOut = $request->input('id');  // Ambil idrental dari request

        // Query data berdasarkan idrental
        $dataCashOut = DB::table('cash_out')
            ->where('id', $idCashOut)
            ->first();

        return response()->json(['data' => $dataCashOut]);
    }

    public function updateDataCashOut(Request $request)
    {
        try {
            $this->validate($request, [
                'nominal' => 'required|numeric',
                'desc' => 'required',
                'date' => 'required',
                'cabang_id' => 'required',
            ]);

            $cash_out = CashOut::findOrFail($request->cashOut_id);

            $cash_out->update([
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

    public function deleteDataCashOut(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required'
            ]);

            $cashOut = CashOut::where('id', $request->id)->first();

            if ($cashOut) {
                $cashOut->delete();
                return response()->json([
                    'success' => true,
                    'msg' => 'Berhasil Menghapus Cash Out',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data Cash Out Tidak Ditemukan',
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
        $cash_out = CashOut::where('id', $id)->first();
        return view('backend.bandung.cash_out.edit', compact('cash_out'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nominal',
            'deskripsi',
            'tgl_cout'
        ]);

        $cash_out = CashOut::where('id', $id)->first();
        $cash_out->update($request->all());
        return redirect()->route('CashOut.index')->with(['message' => 'CashOut Berhasil Diubah']);
    }

    public function destroy($id)
    {
        $cash_out = CashOut::where('id', $id)->first();
        $cash_out->delete();
        return redirect()->route('CashOut.index')->with(['message' => 'CashOut Berhasil Dihapus']);
    }
}
