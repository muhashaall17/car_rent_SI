<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Mobil</title>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <!-- Judul Form -->
                        <div class="text-center mb-4">
                            <h1>Tambah Invoice</h1>
                        </div>

                        <!-- Notifikasi -->
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif

                        <!-- Form Rental -->
                        <form id="rentalForm" enctype="multipart/form-data">
                            @csrf
                            <!-- Bagian Form Rental (Data Utama) -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" for="no_invoice">No Invoice</label>
                                    <input type="text" name="no_invoice" class="form-control" id="no_invoice" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" for="tgl_invoice">Tanggal Invoice</label>
                                    <input type="text" name="tgl_invoice" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" for="cabang_id">Cabang</label>
                                    <select name="cabang_id" id="cabang_id" class="form-select">
                                        @foreach ($cabangs as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama_cabang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" for="nama_pelanggan">Nama</label>
                                    <input type="text" name="nama_pelanggan" class="form-control" placeholder="Isikan Nama Lengkap Anda">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" for="alamat">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" placeholder="Isikan Alamat Anda">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" for="email">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" for="nomor_hp">Nomor Telp</label>
                                    <input type="text" name="nomor_hp" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" for="sim">SIM</label>
                                    <input type="file" name="sim" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" for="ktp">KTP</label>
                                    <input type="file" name="ktp" class="form-control" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" for="kk">KK</label>
                                    <input type="file" name="kk" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" for="ktm">KTM</label>
                                    <input type="file" name="ktm" class="form-control" readonly>
                                </div>
                            </div>

                            <!-- Form Rental Item -->
                            <hr>
                            <div class="text-center mb-3">
                                <h1>Detail Invoice</h1>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="vehicleSelect2">Pilih Kendaraan</label>
                                    <select name="vehicleSelect2" id="vehicleSelect2" class="form-select"></select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="driverSelect2">Pilih Driver</label>
                                    <select name="driverSelect2" id="driverSelect2" class="form-select"></select>
                                </div>
                            </div>

                            <!-- Tabel Item -->
                            <div class="mb-4">
                                <table class="table table-bordered table-striped table-responsive-sm">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Deskripsi</th>
                                            <th class="text-end">Harga</th>
                                            <th class="text-center">Tgl Sewa</th>
                                            <th class="text-center">Tgl Kembali</th>
                                            <th class="text-end">Subtotal</th>
                                            <th class="text-center">Status Ketersediaan</th>
                                            <th class="text-center">Act</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detailInvoiceTr">
                                        <!-- Data tabel akan diisi di sini -->
                                    </tbody>
                                </table>
                                <input type="hidden" name="grandTotalInput" id="grandTotalInput">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <!-- Tombol Aksi -->
                        <div class="text-end">
                            <button type="reset" class="btn btn-warning me-2">Reset</button>
                            <a class="btn btn-info me-2" href="{{ route('rental.index') }}">Kembali</a>
                            <button type="button" class="btn btn-primary" id="submitRentalButton">Booking Rental</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .error {
            color: red;
        }
    </style>

    <script>
        let generateInvoiceNumber = "{{ route('generateInvoiceNumber') }}",
            getVehicles = "{{ route('getVehicles') }}",
            getDrivers = "{{ route('getDrivers') }}",
            checkDriverAndVehicleAvailability = "{{ route('checkDriverAndVehicleAvailability') }}",
            rental_store = "{{ route('rental.store') }}",
            rental_index = "{{ route('rental.index') }}";
    </script>

    <!-- jQuery (Load pertama kali) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI (Versi yang kompatibel dengan jQuery 3.x) -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Bootstrap CSS (Versi 5.3.3) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome (Versi terbaru 6.7.1) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- DataTables CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css"> -->

    <!-- Popper.js (Bootstrap dependency) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->

    <!-- Bootstrap JS (Versi 5.3.3) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>

    <!-- Dexie.js -->
    <script src="https://unpkg.com/dexie/dist/dexie.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- DataTables JS -->
    <!-- <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script> -->

    <!-- Validasi Form JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <!-- Sweet Alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Money Formatting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- Custom CSS (Load paling terakhir agar menimpa style lain jika perlu) -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <script src="../assets/js/adminPage/invoice/invoiceAdd.js"></script>

</body>

</html>