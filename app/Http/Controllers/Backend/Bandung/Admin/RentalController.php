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

class RentalController extends Controller
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

        // Ambil daftar ID cabang
        $cabangIds = $cabangs->pluck('id')->toArray(); // Ambil array id dari hasil query cabang

        // Kirim data ke view
        return view('backend.bandung.rental.index', compact('cabangs'));
    }

    public function getDataTableRental()
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

        // Ambil data rental utama
        $rentals = DB::table('rental as inv')
            ->leftJoin('cabang as cb', 'cb.id', '=', 'inv.cabang_id')
            ->leftJoin('pembayaran as py', 'py.rental_id', '=', 'inv.id')
            ->select(
                'inv.id',
                'inv.no_invoice',
                'cb.id as id_cabang',
                'cb.nama_cabang as cabang',
                'inv.tanggal_invoice',
                'inv.nama_pelanggan',
                'inv.status_rental',
                DB::raw('
                CASE 
                    WHEN SUM(py.nominal) IS NULL OR SUM(py.nominal) = 0 THEN "pending"
                    WHEN SUM(py.nominal) >= inv.grand_total THEN "done"
                    WHEN SUM(py.nominal) > 0 AND SUM(py.nominal) < inv.grand_total THEN "half"
                    ELSE "pending"
                END AS status_pembayaran
            ')
            )
            ->when(!empty($cabangIds), function ($query) use ($cabangIds) {
                $query->whereIn('inv.cabang_id', $cabangIds);
            })
            ->groupBy('inv.id', 'inv.no_invoice', 'cb.nama_cabang', 'inv.tanggal_invoice', 'inv.nama_pelanggan', 'inv.grand_total', 'inv.status_rental')
            ->get();

        // Kembalikan data dalam format JSON sesuai kebutuhan DataTables
        return response()->json(['data' => $rentals]);
    }

    public function getDetailRental(Request $request)
    {

        $id = $request->input('id');

        // Query untuk data invoice (master)
        $invoice = DB::table('rental as inv')
            ->leftJoin('cabang as cb', 'cb.id', '=', 'inv.cabang_id')
            ->leftJoin('pembayaran as py', 'py.rental_id', '=', 'inv.id')
            ->select(
                'inv.*',
                'cb.nama_cabang',
                DB::raw('IFNULL(SUM(py.nominal), 0) as terbayar'),
                DB::raw('inv.grand_total - IFNULL(SUM(py.nominal), 0) as tagihan'),
                DB::raw('
                CASE 
                    WHEN SUM(py.nominal) IS NULL OR SUM(py.nominal) = 0 THEN "pending"
                    WHEN SUM(py.nominal) >= inv.grand_total THEN "done"
                    WHEN SUM(py.nominal) > 0 AND SUM(py.nominal) < inv.grand_total THEN "half"
                    ELSE "pending"
                END AS status_pembayaran
                ')
            )
            ->where('inv.id', $id)
            ->groupBy('inv.id', 'cb.nama_cabang')
            ->first();

        // Query untuk data detail item
        $details = DB::table('rental_item as item_inv')
            ->leftJoin('kendaraan as vch', 'vch.id', '=', 'item_inv.kendaraan_id')
            ->leftJoin('driver as drv', 'drv.id', '=', 'item_inv.driver_id')
            ->select(
                'item_inv.book_date_start AS tanggal_sewa',
                'item_inv.book_date_end AS tanggal_kembali',
                DB::raw("CASE 
                    WHEN item_inv.driver_id IS NOT NULL AND item_inv.kendaraan_id IS NULL THEN drv.nama_driver
                    WHEN item_inv.driver_id IS NULL AND item_inv.kendaraan_id IS NOT NULL THEN vch.nama_kendaraan
                    ELSE 'data ini tidak valid'
                END AS deskripsi"),
                DB::raw("CASE 
                    WHEN item_inv.kendaraan_id IS NOT NULL AND item_inv.driver_id IS NULL THEN vch.harga_sewa
                    WHEN item_inv.driver_id IS NOT NULL AND item_inv.kendaraan_id IS NULL THEN drv.harga
                    ELSE 0
                END AS harga"),
                DB::raw("DATEDIFF(item_inv.book_date_end, item_inv.book_date_start) + 1 AS durasi_sewa"),
                DB::raw("CASE 
                    WHEN item_inv.kendaraan_id IS NOT NULL AND item_inv.driver_id IS NULL THEN vch.harga_sewa * (DATEDIFF(item_inv.book_date_end, item_inv.book_date_start) + 1)
                    WHEN item_inv.driver_id IS NOT NULL AND item_inv.kendaraan_id IS NULL THEN drv.harga * (DATEDIFF(item_inv.book_date_end, item_inv.book_date_start) + 1)
                    ELSE 0
                END AS jumlah")
            )
            ->where('item_inv.rental_id', $id)
            ->get();

        // Mengembalikan data dalam bentuk JSON
        return response()->json([
            'invoice' => $invoice,
            'details' => $details
        ]);
    }

    public function getDataTablePayment(Request $request)
    {
        $idrental = $request->input('idRental');  // Ambil idrental dari request

        // Query data berdasarkan idrental
        $payments = DB::table('pembayaran')
            ->select(
                'id',
                'tgl_bayar',
                'metode_pembayaran',
                'nominal',
                'bukti_pembayaran'
            )
            ->where('rental_id', $idrental)
            ->get();

        return response()->json(['data' => $payments]);
    }

    public function getDataPayment(Request $request)
    {
        $idPayment = $request->input('id');  // Ambil idrental dari request

        // Query data berdasarkan idrental
        $dataPayment = DB::table('pembayaran')
            ->where('id', $idPayment)
            ->first();

        return response()->json(['data' => $dataPayment]);
    }

    public function getVehicles(Request $request)
    {
        $search = $request->get('term', ''); // Input pencarian dari Select2 (default kosong)
        $cabang_id = $request->get('cabang_id', null); // Ambil cabang_id dari request (default null)

        // Query untuk kendaraan
        $queryKendaraan = DB::table('kendaraan')
            ->select([
                'id',
                'cabang_id',
                DB::raw("CONCAT(merk, ' ', nama_kendaraan) AS text"),
                'harga_sewa AS harga',
                DB::raw("'vch' AS type")
            ])
            ->where('cabang_id', $cabang_id)
            ->where(DB::raw("CONCAT(merk, ' ', nama_kendaraan)"), 'LIKE', "%{$search}%");

        // Gabungkan query menggunakan UNION ALL
        $result = $queryKendaraan->limit(10)->get();

        return response()->json(['results' => $result]);
    }

    public function getDrivers(Request $request)
    {
        $search = $request->get('term', ''); // Input pencarian dari Select2 (default kosong)
        $cabang_id = $request->get('cabang_id', null); // Ambil cabang_id dari request (default null)

        // Query untuk driver
        $queryDriver = DB::table('driver')
            ->select([
                'id',
                'cabang_id',
                'nama_driver AS text',
                'harga',
                DB::raw("'drv' AS type")
            ])
            ->where('cabang_id', $cabang_id)
            ->where('nama_driver', 'LIKE', "%{$search}%");

        // Gabungkan query menggunakan UNION ALL
        $result = $queryDriver->limit(10)->get();

        return response()->json(['results' => $result]);
    }


    public function checkDriverAndVehicleAvailability(Request $request)
    {
        // Validasi input
        $request->validate([
            'type' => 'required|string|in:vch,drv',
            'id_item' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Ambil input dari request
        $type = $request->input('type'); // kendaraan atau driver
        $id_item = $request->input('id_item'); // ID kendaraan atau driver
        $start_date = $request->input('start_date'); // Tanggal mulai
        $end_date = $request->input('end_date'); // Tanggal akhir

        // Jalankan query
        $results = DB::table('rental_item as item')
            ->join('rental as inv', 'item.rental_id', '=', 'inv.id')
            ->when($type === 'vch', function ($query) use ($id_item) {
                return $query->where('item.kendaraan_id', $id_item);
            })
            ->when($type === 'drv', function ($query) use ($id_item) {
                return $query->where('item.driver_id', $id_item);
            })
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween('item.book_date_start', [$start_date, $end_date])
                    ->orWhereBetween('item.book_date_end', [$start_date, $end_date])
                    ->orWhere(function ($q) use ($start_date, $end_date) {
                        $q->where('item.book_date_start', '<=', $start_date)
                            ->where('item.book_date_end', '>=', $end_date);
                    });
            })
            ->where('inv.status_rental', '!=', 'done') // Status rental harus tidak "done"
            ->exists(); // Hanya untuk mengecek apakah ada data atau tidak

        // Kembalikan respons JSON
        if ($results) {
            return response()->json(['status' => 'tidak_tersedia']);
        } else {
            return response()->json(['status' => 'tersedia']);
        }
    }

    public function generateInvoiceNumber(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'date' => 'required|date',
        ]);

        // Ambil tanggal dari request
        $tanggal = $request->input('date');
        $formattedDate = date('ym', strtotime($tanggal)); // Format YYMM untuk bulan
        $currentDay = date('d', strtotime($tanggal));    // Format DD untuk hari

        // Cari nomor invoice terakhir di database berdasarkan bulan (YYMM)
        $latestInvoice = DB::table('rental')
            ->where('no_invoice', 'like', "$formattedDate%") // Filter berdasarkan YYMM
            ->orderBy('no_invoice', 'desc') // Urutkan nomor terbesar dulu
            ->first();

        // Tentukan nomor urut berikutnya
        if ($latestInvoice) {
            // Ambil bagian tanggal dari nomor invoice terakhir
            $lastDate = substr($latestInvoice->no_invoice, 0, 4); // Ambil YYMMDD dari no_invoice
            $lastSequence = (int)substr($latestInvoice->no_invoice, -4); // Ambil 4 digit terakhir

            // Jika bulan berbeda (YYMM), reset sequence ke 1
            if ($lastDate !== $formattedDate) {
                $nextSequence = 1;
            } else {
                // Jika masih dalam bulan yang sama, lanjutkan nomor terakhir
                $nextSequence = $lastSequence + 1;
            }
        } else {
            $nextSequence = 1; // Mulai dari 1 jika belum ada nomor invoice pada bulan tersebut
        }

        // Formatkan nomor invoice menjadi 4 digit
        $formattedSequence = str_pad($nextSequence, 4, '0', STR_PAD_LEFT);

        // Gabungkan untuk mendapatkan nomor invoice akhir
        $newInvoiceNumber = $formattedDate . $currentDay . $formattedSequence;

        // Kembalikan nomor invoice
        return response()->json([
            'status' => 'success',
            'no_invoice' => $newInvoiceNumber
        ]);
    }

    public function create()
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

        // Ambil daftar ID cabang
        // $cabangIds = $cabangs->pluck('id')->toArray(); // Ambil array id dari hasil query cabang

        return view('backend.bandung.rental.create', compact('cabangs'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'no_invoice' => 'required',
                'tgl_invoice' => 'required',
                'cabang_id' => 'required',
                'nama_pelanggan' => 'required',
                'alamat' => 'required',
                'email' => 'required',
                'nomor_hp' => 'required',
                'grandTotalInput' => 'required|numeric',
                'rentalItems' => 'required|json'
            ]);

            $sim = $request->file('sim');
            $sim->storeAs('public/syarat-rental/sim', $sim->hashName());

            $ktp = $request->file('ktp');
            $ktp->storeAs('public/syarat-rental/ktp', $ktp->hashName());

            $kk = $request->file('kk');
            $kk->storeAs('public/syarat-rental/kk', $kk->hashName());

            if ($request->file('ktm')) {
                $ktm = $request->file('ktm');
                $ktm->storeAs('public/syarat-rental/ktm', $ktm->hashName());
                $ktm = $ktm->hashName();
            } else {
                $ktm = null;
            }

            $dateData = str_replace('/', '-', $request->tgl_invoice);
            $invoice_date = date("Y-m-d", strtotime($dateData));

            // Simpan data ke tabel rental
            $rental = Rental::create([
                'no_invoice' => $request->no_invoice,
                'tanggal_invoice' => $invoice_date,
                'cabang_id' => $request->cabang_id,
                'nama_pelanggan' => $request->nama_pelanggan,
                'alamat' => $request->alamat,
                'sim' => $sim->hashName(),
                'ktp' => $ktp->hashName(),
                'kk' => $kk->hashName(),
                'email' => $request->email,
                'nomor_hp' => $request->nomor_hp,
                'ktm' => $ktm,
                'grand_total' => $request->grandTotalInput
            ]);

            $rentalItems = json_decode($request->rentalItems, true);

            foreach ($rentalItems as $item) {
                RentalItem::create([
                    'rental_id' => $rental->id,
                    'driver_id' => $item['type'] === 'drv' ? $item['id_drv_vch'] : null,
                    'kendaraan_id' => $item['type'] === 'vch' ? $item['id_drv_vch'] : null,
                    'subtotal' => $item['subtotal'],
                    'book_date_start' => $item['tgl_sewa'],
                    'book_date_end' => $item['tgl_kembali']
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Rental berhasil disimpan!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function deleteDataRental(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required'
            ]);

            $payment = Pembayaran::where('rental_id', $request->id)->get();

            if ($payment) {
                foreach ($payment as $payments) {
                    $cashIn = CashIn::where('payment_id', $payments->id)->first();
                    if ($cashIn) {
                        $cashIn->delete();
                    }
                    $payments->delete();
                }
            }

            $rentalItem = RentalItem::where('rental_id', $request->id)->get();

            if ($rentalItem) {
                foreach ($rentalItem as $items) {
                    $items->delete();
                }
            }

            $rental = Rental::findOrFail($request->id);

            $rental->delete();

            return response()->json([
                'success' => true,
                'msg' => 'Berhasil Menghapus Invoice'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // public function create()
    // {
    //     $pelanggan = Pelanggan::all();
    //     $mobil = Mobil::where('status', 'available')->get();
    //     return view('backend.bandung.rental.create', compact('pelanggan', 'mobil'));
    // }

    // public function store(Request $request)
    // {
    //     $mobil = Mobil::find($request->id_mobil);

    //     if (!$mobil) {
    //         return redirect()->back()->with('error', 'Mobil tidak ditemukan.');
    //     }

    //     $tanggal_sewa = Carbon::parse($request->tanggal_sewa);
    //     $tanggal_kembali = Carbon::parse($request->tanggal_kembali);
    //     $jumlah_hari = $tanggal_kembali->diffInDays($tanggal_sewa);

    //     $total_biaya = $jumlah_hari * $mobil->harga_sewa;

    //     DB::table('rental')->insert([
    //         'id_pelanggan' => $request->id_pelanggan,
    //         'id_mobil' => $request->id_mobil,
    //         'tanggal_sewa' => $tanggal_sewa,
    //         'tanggal_kembali' => $tanggal_kembali,
    //         'total_biaya' => $total_biaya,
    //         'metode_pembayaran' => '-',
    //         'bukti_pembayaran' => '-',
    //         'status' => 'ongoing',
    //         'created_at' => now(),
    //         'updated_at' => now()
    //     ]);

    //     // Update status mobil
    //     $mobil->update(['status' => 'disewa']);

    //     return redirect()->route('rental.index');

    // }
}
