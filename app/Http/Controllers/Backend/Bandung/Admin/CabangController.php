<?php

namespace App\Http\Controllers\Backend\Bandung\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Cabang;
use App\Models\Kendaraan;
use App\Models\Pembayaran;
use App\Models\CashIn;
use App\Models\User;
use App\Models\RentalItem;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CabangController extends Controller
{
    public function index()
    {
        $cabang = Cabang::all();
        $user = Auth::user();
        $role = $user->role;
        return view('backend.bandung.cabang.index', compact('cabang','role'));
    }

    public function getCabang(Request $request) {
        $idCabang = $request->input('id');

        // Query untuk ambil data cabang
        $getCabang = DB::table('cabang')
            ->select(
                'id',
                'nama_cabang',
            )
            ->get();
        
        return response()->json(['data' => $getCabang]);
    }

    public function getNameCabang(Request $request) {
        $getIdCabang = $request->input('id');

        $dataCabang = DB::table('cabang')
            ->select(
                'nama_cabang',
            )
            ->where('id', $getIdCabang)
            ->first();

            return response()->json(['data' => $dataCabang]);
    }

    public function updateCabangName(Request $request) {
        try {
            $this->validate($request, [
                'nama_cabang' => 'required',
            ]);

            $getCabangName = Cabang::where('id', $request->id)->first();

            $getCabangName->update([
                'nama_cabang' => $request->nama_cabang,
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Nama cabang berhasil diupdate!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Terjadi kesalahan' . $e->getMessage(),
            ], 500);
        }
    }

    public function deleteCabang(Request $request) {
        try {
            $this->validate($request, [
                'id' => 'required',
            ]);

            $deleteCabang = Cabang::where('id', $request->id)->first();

            $deleteCabang->delete();

            return response()->json([
                'success' => true,
                'msg' => 'Berhasil Menghapus Cabang',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function create()
    {
        return view('backend.bandung.cabang.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_cabang' => 'required|string|max:255',
            ]);
    
            Cabang::create([
                'nama_cabang' => $request->nama_cabang,
            ]);
    
            return response()->json(['success' => true, 'msg' => 'Cabang berhasil ditambahkan!']);
        } catch (\Exception $e) {
            // Log::error($e->getMessage()); // Logging error untuk debugging
            return response()->json(['success' => false, 'msg' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $cabang = Cabang::where('id', $id)->first();
        return view('backend.bandung.cabang.edit', compact('cabang'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_cabang',
        ]);

        $cabang = Cabang::where('id', $id)->first();
        $cabang->update($request->all());
        return redirect()->route('cabang.index')->with(['message'=>'Cabang Berhasil Diupdate']);
    }

    public function destroy($id)
    {
        $cabang = Cabang::where('id', $id)->first();
        $cabang->delete();
        return redirect()->route('cabang.index')->with(['message'=>'Cabang Berhasil Dihapus']);
    }
}
