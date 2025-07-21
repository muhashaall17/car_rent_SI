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

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::all();
        return view('backend.bandung.kendaraan.index', compact('kendaraan'));
    }

    public function createPage()
    {
        $cabang_id = Cabang::all();
        return view('backend.bandung.kendaraan.create', compact('cabang_id'));
    }

    public function editPage() {
        $cabang_id = Cabang::all();
        return view('backend.bandung.kendaraan.edit', compact($cabang_id));
    }

    public function getKendaraan(Request $request) {
        // QUERY UNTUK MENGAMBIL INFORMASI KENDARAAN
        $getKendaraan = DB::table('kendaraan')
            ->select(
                'id',
                'cabang_id',
                'jenis_kendaraan',
                'plat_nomor',
                'merk',
                'harga_sewa',
                'status'
            )
            ->get();

        return response()->json(['data' => $getKendaraan]);
    }

    public function deleteKendaraan(Request $request) {
        try{
            $this->validate($request, [
                'id' => 'required',
            ]);
            
            $deleteKendaraan = Kendaraan::where('id', $request->id)->first();

            $deleteKendaraan->delete();

            return response()->json([
                'success' => true,
                'msg' => 'Berhasil Menghapus Kendaraan',
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage() 
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
           $this->validate($request, [
                'cabang_id',
                'jenis_kendaraan',
                'plat_nomor',
                'merk',
                'nama_kendaraan',
                'tahun_pembuatan',
                'warna',
                'harga_sewa',
                'status',
            ]);
            
            $image = $request->file('gambar');
            $image->storeAs('public/mobil', $image->hashName());
    
            Kendaraan::create([
                'cabang_id' => $request->cabang_id,
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'plat_nomor' => $request->plat_nomor,
                'merk' => $request->merk,
                'nama_kendaraan' => $request->nama_kendaraan,
                'tahun_pembuatan' => $request->tahun_pembuatan,
                'warna' => $request->warna,
                'harga_sewa' => $request->harga_sewa,
                'gambar' => $image->hashName(),
                'status' => 'tersedia',
            ]);
    
            return response()->json([
                'success' => true, 
                'msg' => 'Kendaraan Baru Berhasil Ditambahkan'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $cabang_id = Cabang::all();
        $kendaraan = Kendaraan::where('id', $id)->first();
        return view('backend.bandung.kendaraan.edit', compact('cabang_id', 'kendaraan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $this->validate($request, [
            'cabang_id' => 'required',
            'jenis_kendaraan' => 'required',
            'plat_nomor' => 'required',
            'merk' => 'required',
            'nama_kendaraan' => 'required',
            'tahun_pembuatan' => 'required|numeric',
            'warna' => 'required',
            'harga_sewa' => 'required|numeric',
            'gambar',
            'status' => 'required',
        ]);

        // Ambil data kendaraan
        $kendaraan = Kendaraan::findOrFail($id);

        // Cek apakah gambar diunggah
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kendaraan->gambar) {
                Storage::disk('local')->delete('public/mobil/' . $kendaraan->gambar);
            }

            // Simpan gambar baru
            $image = $request->file('gambar');
            $image->storeAs('public/mobil', $image->hashName());

            // Update data termasuk gambar
            $kendaraan->update([
                'gambar' => $image->hashName(),
                'cabang_id' => $request->cabang_id,
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'plat_nomor' => $request->plat_nomor,
                'merk' => $request->merk,
                'nama_kendaraan' => $request->nama_kendaraan,
                'tahun_pembuatan' => $request->tahun_pembuatan,
                'warna' => $request->warna,
                'harga_sewa' => $request->harga_sewa,
                'status' => $request->status,
            ]);
        } else {
            // Update data tanpa mengganti gambar
            $kendaraan->update([
                'cabang_id' => $request->cabang_id,
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'plat_nomor' => $request->plat_nomor,
                'merk' => $request->merk,
                'nama_kendaraan' => $request->nama_kendaraan,
                'tahun_pembuatan' => $request->tahun_pembuatan,
                'warna' => $request->warna,
                'harga_sewa' => $request->harga_sewa,
                'status' => $request->status,
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('kendaraan.index')->with(['message' => 'Kendaraan Berhasil Diubah']);
    }

    public function destroy($id) {
        $kendaraan = Kendaraan::where('id',$id)->first();
        $kendaraan->delete();
        return redirect()->route('kendaraan.index')->with(['message'=>'Kendaraan Berhasil Dihapus']);
    }
}