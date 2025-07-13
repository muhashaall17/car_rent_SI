<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Rental;
use App\Models\Cabang;
use App\Models\Pembayaran;
use App\Models\CashIn;
use App\Models\User;
use App\Models\RentalItem;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{
    //
    public function index(Request $request)
    {
        $cars = Kendaraan::query();

        if ($request->has('merk')) {
            $cars->where('merk', $request->merk);
        }

        return view('frontend.catalog-rev', [
            'cars' => $cars->get()
        ]);
    }
}
