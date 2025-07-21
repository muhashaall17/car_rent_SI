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

class DriverController extends Controller
{
    public function index()
    {
        $driver = Driver::all();
        $cabang = Cabang::all();
        return view('backend.bandung.driver.index', compact('driver', 'cabang'));
    }

    public function getDriver(Request $request)
    {
        // $idDriver = $request->input('id');

        // Query untuk ambil driver
        $getDriver = DB::table('driver as drv')
            ->leftJoin('cabang as cb', 'cb.id', '=', 'drv.cabang_id')
            ->select(
                'drv.id',
                'drv.cabang_id',
                'drv.nama_driver',
                'drv.harga',
                'cb.nama_cabang'
            )
            ->get();

        return response()->json(['data' => $getDriver]);
    }

    public function getDriverInformation(Request $request) {
        $getDriverId = $request->input('id');

        $driverData = DB::table('driver')
            ->select(
                'cabang_id',
                'nama_driver',
                'harga'
            )
            ->where('id', $getDriverId)
            ->first();

            return response()->json(['data' => $driverData]);
    }

    public function updateDriver(Request $request) {
        try {
            $this->validate($request, [
                'cabang_id' => 'required',
                'nama_driver' => 'required',
                'harga' => 'required',
            ]);

            $getDriver = Driver::where('id', $request->id)->first();

            $getDriver->update([
                'cabang_id' => $request->cabang_id,
                'nama_driver' => $request->nama_driver,
                'harga' => $request->harga,
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Driver berhasil diupdate!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Terjadi kesalahan' . $e->getMessage(),
            ], 500);
        }
    }

    public function deleteDriver(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required',
            ]);

            $deleteDriver = Driver::where('id', $request->id)->first();

            $deleteDriver->delete();

            return response()->json([
                'success' => true,
                'msg' => 'Berhasil Menghapus Driver',
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function create()
    {
        $cabang_id = Cabang::all();
        return view('backend.bandung.driver.create', compact('cabang_id'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'cabang_id',
                'nama_driver',
                'harga',
            ]);

            Driver::create([
                'cabang_id' => $request->cabang_id,
                'nama_driver' => $request->nama_driver,
                'harga' => $request->harga,
            ]);

            return response()->json(['success' => true, 'msg' => 'Driver berhasil ditambahkan!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()], 500);
        }

    }

    public function edit($id)
    {
        $cabang_id = Cabang::all();
        $driver = Driver::where('id', $id)->first();
        return view('backend.bandung.driver.edit', compact('driver', 'cabang_id'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'cabang_id',
            'nama_driver',
            'harga',
        ]);

        $driver = Driver::where('id', $id)->first();
        $driver->update($request->all());
        return redirect()->route('driver.index')->with(['message' => 'Driver Berhasil Diubah']);
    }

    public function destroy($id)
    {
        DB::table('rental_item')->where('driver_id', $id)->delete();
        $driver = Driver::where('id', $id);
        $driver->delete();
        return redirect()->route('driver.index')->with(['message' => 'Driver Berhasil Dihapus']);
    }
}
