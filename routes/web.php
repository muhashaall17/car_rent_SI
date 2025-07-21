<?php

use App\Http\Controllers\Backend\Bandung\Admin\CabangController;
use App\Http\Controllers\Backend\Bandung\Admin\CashInController;
use App\Http\Controllers\Backend\Bandung\Admin\CashOutController;
use App\Http\Controllers\Backend\Bandung\Admin\DriverController;
use App\Http\Controllers\Backend\Bandung\Admin\KendaraanController;
use App\Http\Controllers\Backend\Bandung\Admin\PelangganController;
use App\Http\Controllers\Backend\Bandung\Admin\PembayaranController;
use App\Http\Controllers\Backend\Bandung\Admin\RentalController;
use App\Http\Controllers\Backend\Bandung\Admin\RentalItemController;
use App\Http\Controllers\Backend\Bandung\Admin\UserController;
use App\Http\Controllers\Frontend\Bandung\RegisterController;
use App\Http\Controllers\Frontend\Bandung\RiwayatController;
use App\Http\Controllers\Frontend\Bandung\SewaController;
use App\Http\Controllers\Frontend\Bandung\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Bandung\Auth\LoginController;
use App\Http\Controllers\Backend\Bandung\Admin\DashboardController;
use App\Http\Controllers\Frontend\CatalogController;
use App\Http\Controllers\Frontend\Bandung\ProfileController;
use App\Models\CashIn;
use App\Models\Pembayaran;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// contoh

route::get('/contoh', function () {
    return view('frontend.bandung.contoh');
});


// <-- Frontend --> \\
Route::get('/', function () {
    return view('frontend.bandung.home');
});

Route::get('sewa/success', function () {
    return view('frontend.bandung.sukses');
})->name('transaksi.success');
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/registrasi', function () {
    return view('frontend.bandung.auth.register');
})->name('registrasi');
Route::resource('register', RegisterController::class);
Route::get('sewa/{id}', [SewaController::class, 'create'])->name('Rental.create');
Route::post('sewa/{id}', [SewaController::class, 'store'])->name('sewa.store');
Route::resource('riwayat', RiwayatController::class);
Route::post('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');



// <-- Backend --> \\
Route::get('/login/admin', [LoginController::class, 'index'])->name('admin.login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('/login/admin', function () {
    return view('backend.bandung.auth.login');
});

Route::group(['middleware' => ['auth', 'role:super_admin,admin']], function () {
    Route::resource('home', HomeController::class);
    Route::resource('Dashboard', DashboardController::class);
    Route::resource('cabang', CabangController::class);
    Route::resource('driver', DriverController::class);
    Route::resource('kendaraan', KendaraanController::class);
    Route::resource('rental', RentalController::class);
    Route::resource('rental_item', RentalItemController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('CashIn', CashInController::class);
    Route::resource('CashOut', CashOutController::class);
    Route::resource('users', UserController::class);

    // ROUTES UNTUK CABANG CONTROLLER START
    Route::get('/api/get-cabang', [CabangController::class, 'getCabang'])->name('getCabang');
    Route::get('/api/get-name-cabang', [CabangController::class, 'getNameCabang'])->name('getNameCabang');
    Route::post('/api/update-cabang', [CabangController::class, 'updateCabangName'])->name('updateCabangName');
    Route::post('/api/delete-cabang', [CabangController::class, 'deleteCabang'])->name('deleteCabang');
    // ROUTES UNTUK CABANG CONTROLLER END

    // ROUTE UNTUK DRIVER CONTROLLER START
    Route::get('/api/get-driver', [DriverController::class, 'getDriver'])->name('getDriver');
    Route::get('/api/get-driver-information', [DriverController::class, 'getDriverInformation'])->name('getDriverInformation');
    Route::post('/api/update-driver', [DriverController::class, 'updateDriver'])->name('updateDriver');
    Route::post('/api/delete-driver', [DriverController::class, 'deleteDriver'])->name('deleteDriver');
    // ROUTE UNTUK DRIVER CONTROLLER END

    Route::get('/api/get-kendaraan', [KendaraanController::class, 'getKendaraan'])->name('getKendaraan');
    Route::post('/api/delete-kendaraan', [KendaraanController::class, 'deleteKendaraan'])->name('deleteKendaraan');
    Route::get('/api/form-tambah-kendaraan', [KendaraanController::class, 'createPage'])->name('kendaraan.create');
    Route::get('/api/form-edit-kendaraan', [KendaraanController::class, 'editPage'])->name('kendaraan.edit');
    // ROUTE UNTUK RENTAL CONTROLLER START

    Route::get('/api/get-vehicle', [RentalController::class, 'getVehicles'])->name('getVehicles');
    Route::get('/api/get-drivers', [RentalController::class, 'getDrivers'])->name('getDrivers');
    Route::post('/api/check-vehicles-and-drivers-availability', [RentalController::class, 'checkDriverAndVehicleAvailability'])->name('checkDriverAndVehicleAvailability');
    Route::post('/api/get-invoice-number', [RentalController::class, 'generateInvoiceNumber'])->name('generateInvoiceNumber');
    Route::get('/api/get-datatable-rental', [RentalController::class, 'getDataTableRental'])->name('getDataTableRental');
    Route::get('api/get-datatable-payment', [RentalController::class, 'getDataTablePayment'])->name('getDataTablePayment');
    Route::get('/api/get-detail-rental', [RentalController::class, 'getDetailRental'])->name('getDetailRental');
    Route::post('/api/delete-data-rental', [RentalController::class, 'deleteDataRental'])->name('deleteDataRental');
    Route::get('/api/get-data-payment', [RentalController::class, 'getDataPayment'])->name('getDataPayment');
    // ROUTE UNTUK RENTAL CONTROLLER END

    // ROUTE UNTUK PEMBAYARAN CONTROLLER START
    Route::post('/api/update-data-payment', [PembayaranController::class, 'updateDataPayment'])->name('updateDataPayment');
    Route::post('/api/delete-data-payment', [PembayaranController::class, 'deleteDataPayment'])->name('deleteDataPayment');
    // ROUTE UNTUK PEMBAYARAN CONTROLLER END
    
    
    // ROUTE UNTUK CASHIN CONTROLLER START
    Route::get('/api/get-datatable-cash-in', [CashInController::class, 'getDataTableCashIn'])->name('getDataTableCashIn');
    Route::post('/api/delete-data-cash-in', [CashInController::class, 'deleteDataCashIn'])->name('deleteDataCashIn');
    Route::get('/api/get-data-cash-in', [CashInController::class, 'getDataCashIn'])->name('getDataCashIn');
    Route::post('/api/update-data-cash-in', [CashInController::class, 'updateDataCashIn'])->name('updateDataCashIn');
    Route::get('/api/get-datatable-cash-out', [CashOutController::class, 'getDataTableCashOut'])->name('getDataTableCashOut');
    Route::get('/api/get-data-cash-out', [CashOutController::class, 'getDataCashOut'])->name('getDataCashOut');
    Route::post('/api/update-data-cash-out', [CashOutController::class, 'updateDataCashOut'])->name('updateDataCashOut');
    Route::post('/api/delete-data-cash-out', [CashOutController::class, 'deleteDataCashOut'])->name('deleteDataCashOut');
    // ROUTE UNTUK CASHOUT CONTROLLER END

    Route::get('/dashboard', function () {
        return view('backend.bandung.dashboard.index');
    });
});



Route::group(['middleware' => ['auth', 'role:user']], function () {});
