<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash In</title>
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
                            <h5 class="card-title">Data Cash In</h5>
                        </center>
                    </div>

                    <div class="row m-1">
                        <form action="#" method='POST' class="d-flex align-items-center">
                            @csrf
                            @method('DELETE')

                            <a class="btn btn-primary m-1 add-cash-in-btn" href="#">
                                <i class="fas fa-plus m-2"></i>Tambah Cash In
                            </a>


                            <!-- <a class="btn btn-success" href="#"><i class="fas fa-file-excel mr-2"></i> Export Excel</a> -->
                        </form>
                    </div>

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    <div class="card-body">
                        <table id="cashInTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Tanggal</th>
                                    <th>Cabang</th>
                                    <th class="text-end">Nominal</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- START Modal ADD Cash In -->
    <div class="modal fade" id="cashInADDModal" tabindex="-1" role="dialog" aria-labelledby="cashInADDModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Cash In</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="cashInFormADD" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div id="alertMessageFormcashInADD" class="alert alert-danger alert-dismissible fade show text-center d-none" role="alert"><strong>Terdapat isian yang tidak valid!</strong></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="cashIn_date_ADD">Tanggal</label>
                                <input type="text" class="form-control" name="cashIn_date_ADD" id="cashIn_date_ADD">
                            </div>
                            <div class="col-6">
                                <label for="cashIn_cabangId_ADD">Cabang</label>
                                <select name="cashIn_cabangId_ADD" id="cashIn_cabangId_ADD" class="form-select">
                                    @foreach ($cabangs as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_cabang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="cashIn_nominal_ADD">Nominal</label>
                                <input type="text" class="form-control rupiah" name="cashIn_nominal_ADD" id="cashIn_nominal_ADD">
                            </div>
                            <div class="col-6">
                                <label for="cashIn_desc_ADD">Deskripsi</label>
                                <textarea class="form-control" name="cashIn_desc_ADD" id="cashIn_desc_ADD"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tes">Close</button>
                        <button type="button" class="btn btn-success" id="add-cashIn-submit-btn">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Modal ADD Cash In -->

    <!-- START Modal EDIT Cash In -->
    <div class="modal fade" id="cashInEDITModal" tabindex="-1" role="dialog" aria-labelledby="cashInEDITModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Cash In</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="cashInFormEDIT" autocomplete="off">
                    <div class="modal-body">
                        <input type="hidden" name="cashIn_id_EDIT" id="cashIn_id_EDIT">
                        <div class="row">
                            <div class="col-12">
                                <div id="alertMessageFormcashInEDIT" class="alert alert-danger alert-dismissible fade show text-center d-none" role="alert"><strong>Terdapat isian yang tidak valid!</strong></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="cashIn_date_EDIT">Tanggal</label>
                                <input type="text" class="form-control" name="cashIn_date_EDIT" id="cashIn_date_EDIT">
                            </div>
                            <div class="col-6">
                                <label for="cashIn_cabangId_EDIT">Cabang</label>
                                <select name="cashIn_cabangId_EDIT" id="cashIn_cabangId_ADD" class="form-select">
                                    @foreach ($cabangs as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_cabang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="cashIn_nominal_EDIT">Nominal</label>
                                <input type="text" class="form-control rupiah" name="cashIn_nominal_EDIT" id="cashIn_nominal_EDIT">
                            </div>
                            <div class="col-6">
                                <label for="cashIn_desc_EDIT">Deskripsi</label>
                                <textarea class="form-control" name="cashIn_desc_EDIT" id="cashIn_desc_EDIT"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tes">Close</button>
                        <button type="button" class="btn btn-success" id="edit-cashIn-submit-btn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Modal EDIT Cash In -->

    <script>
        let getDataTableCashIn = "{{ route('getDataTableCashIn') }}",
            deleteDataCashIn = "{{ route('deleteDataCashIn') }}",
            getDataCashIn = "{{ route('getDataCashIn') }}",
            updateDataCashIn = "{{ route('updateDataCashIn') }}",
            cashin_store = "{{ route('CashIn.store') }}";
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

    <script src="./assets/js/adminPage/cashIn/cashInIndex.js"></script>
</body>

</html>