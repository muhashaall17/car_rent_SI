<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Rental Mobil</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @include('backend.bandung.layouts.sidebar')
    <div class="content-wrapper">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mb-2">
                        <center>
                            <h5 class="card-title">Data Rental Mobil</h5>
                        </center>
                    </div>

                    <div class="row m-1">
                        <form action="#" method='POST' class="d-flex align-items-center">
                            @csrf
                            @method('DELETE')

                            <!-- <button type="submit" class="btn btn-danger m-2"
                                onclick="return confirm('Yakin ingin menghapus seluruh data?')">
                                <i class="fas fa-trash m-2"></i>
                                Hapus Semua Data
                            </button> -->

                            <a class="btn btn-primary m-1" href="{{ route('rental.create')}}">
                                <i class="fas fa-plus m-2"></i>Tambah Rental Mobil
                            </a>

                            <!-- <a class="btn btn-success m-2" href="#"><i class="fas fa-file-excel m-2"></i> Export Excel</a> -->
                        </form>
                    </div>

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <div class="card-body">
                        <table id="rentalTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-start">No Invoice</th>
                                    <th>Cabang</th>
                                    <th class="text-center">Tanggal</th>
                                    <th>Nama Pelanggan</th>
                                    <th class="text-center">Status Pembayaran</th>
                                    <th class="text-center">Status Rental</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- START Modal Payment for each rental -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><span id="paymentModalTitle"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-primary add-payment-btn"><i class="fa-solid fa-plus"></i> Tambah Pembayaran</button>
                    <input type="hidden" name="invId_payment" autocomplete="off">
                    <input type="hidden" name="id_cabang" autocomplete="off">
                    <table id="paymentTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Tanggal</th>
                                <th>Jenis Pembayaran</th>
                                <th class="text-end">Nominal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- END Modal Payment for each rental -->

    <!-- START Modal ADD Payment -->
    <div class="modal fade" id="paymentADDModal" tabindex="-1" role="dialog" aria-labelledby="paymentADDModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Pembayaran</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="paymentFormADD" autocomplete="off">
                    <div class="modal-body">
                        <input type="hidden" name="invId_payment_ADD" autocomplete="off">
                        <input type="hidden" name="id_cabang_ADD" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div id="alertMessageFormPaymentADD" class="alert alert-danger alert-dismissible fade show text-center d-none" role="alert"><strong>Terdapat isian yang tidak valid!</strong></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="payment_date_ADD">Tanggal</label>
                                <input type="text" class="form-control" name="payment_date_ADD" id="payment_date_ADD">
                            </div>
                            <div class="col-6">
                                <label for="payment_method_ADD">Metode</label>
                                <select name="payment_method_ADD" id="payment_method_ADD" class="form-control">
                                    <option value="transfer">Transfer</option>
                                    <option value="tunai">Tunai</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="payment_nominal_ADD">Nominal</label>
                                <input type="text" class="form-control rupiah" name="payment_nominal_ADD" id="payment_nominal_ADD">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="payment_proof_ADD">Bukti Bayar</label>
                                <input type="text" class="form-control" name="payment_proof_ADD" id="payment_proof_ADD" value="bukti_bayar.png" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tes">Close</button>
                        <button type="button" class="btn btn-success" id="add-payment-submit-btn">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- START Modal ADD Payment -->

    <!-- START Modal EDIT Payment -->
    <div class="modal fade" id="paymentEDITModal" tabindex="-1" role="dialog" aria-labelledby="paymentEDITModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Pembayaran</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="paymentFormEDIT" autocomplete="off">
                    <div class="modal-body">
                        <input type="hidden" name="payment_id_EDIT" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div id="alertMessageFormPaymentEDIT" class="alert alert-danger alert-dismissible fade show text-center d-none" role="alert"><strong>Terdapat isian yang tidak valid!</strong></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="payment_date_EDIT">Tanggal</label>
                                <input type="text" class="form-control" name="payment_date_EDIT" id="payment_date_EDIT">
                            </div>
                            <div class="col-6">
                                <label for="payment_method_EDIT">Metode</label>
                                <select name="payment_method_EDIT" id="payment_method_EDIT" class="form-control">
                                    <option value="transfer">Transfer</option>
                                    <option value="tunai">Tunai</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="payment_nominal_EDIT">Nominal</label>
                                <input type="text" class="form-control rupiah" name="payment_nominal_EDIT" id="payment_nominal_EDIT">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="payment_proof_EDIT">Bukti Bayar</label>
                                <input type="text" class="form-control" name="payment_proof_EDIT" id="payment_proof_EDIT" value="bukti_bayar.png" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="edit-payment-submit-btn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- START Modal EDIT Payment -->

    <!-- START Modal Detail for each rental -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Detail Invoice</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6">
                                <div class="card bg-light">
                                    <div class="card-header"><b>Invoice</b></div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <p>No Invoice</p>
                                                <p>Tanggal</p>
                                                <p>Cabang</p>
                                            </div>
                                            <div class="col-1">
                                                <p>:</p>
                                                <p>:</p>
                                                <p>:</p>
                                            </div>
                                            <div class="col-6">
                                                <p><span id="detailInvoiceNo"></span></p>
                                                <p><span id="detailInvoiceDate"></span></p>
                                                <p><span id="detailInvoiceBranch"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card bg-light">
                                    <div class="card-header"><b>Pelanggan</b></div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <p>Nama</p>
                                                <p>No Telp</p>
                                                <p>Email</p>
                                                <p>Alamat</p>
                                            </div>
                                            <div class="col-1">
                                                <p>:</p>
                                                <p>:</p>
                                                <p>:</p>
                                                <p>:</p>
                                            </div>
                                            <div class="col-7">
                                                <p><span id="detailCustomerName"></span></p>
                                                <p><span id="detailCustomerPhone"></span></p>
                                                <p><span id="detailCustomerEmail"></span></p>
                                                <p><span id="detailCustomerAddress"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <th class="text-center">Tanggal Sewa</th>
                                        <th class="text-center">Tanggal Kembali</th>
                                        <th class="text-center">Durasi</th>
                                        <th class="text-end">Harga</th>
                                        <th class="text-end">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody id="detailItemInvoice"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- END Modal Detail for each rental -->

    <style>
        .error {
            color: red;
        }
    </style>

    <script>
        let getDataTableRental = "{{ route('getDataTableRental') }}",
            getDataTablePayment = "{{ route('getDataTablePayment') }}",
            getDataPayment = "{{ route('getDataPayment') }}",
            deleteDataPayment = "{{ route('deleteDataPayment') }}",
            getDetailRental = "{{ route('getDetailRental') }}",
            deleteDataRental = "{{ route('deleteDataRental') }}",
            pembayaran_store = "{{ route('pembayaran.store') }}",
            updateDataPayment = "{{ route('updateDataPayment') }}";
    </script>

    <!-- jQuery (Load pertama kali) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI (Versi yang kompatibel dengan jQuery 3.x) -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Bootstrap CSS (Versi 5.3.3) -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> -->

    <!-- Font Awesome (Versi terbaru 6.7.1) -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <!-- Select2 CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">

    <!-- Popper.js (Bootstrap dependency) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->

    <!-- Bootstrap JS (Versi 5.3.3) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script> -->

    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>

    <!-- Dexie.js -->
    <!-- <script src="https://unpkg.com/dexie/dist/dexie.js"></script> -->

    <!-- Select2 JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>

    <!-- Validasi Form JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <!-- Sweet Alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Money Formatting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- Custom CSS (Load paling terakhir agar menimpa style lain jika perlu) -->
    <!-- <link rel="stylesheet" href="/assets/css/style.css"> -->

    <script src="./assets/js/adminPage/invoice/invoiceIndex.js"></script>
</body>

</html>