<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Driver</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @include('backend.bandung.layouts.sidebar')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mb-2">
                        <center>
                            <h5 class="card-title">Data Driver</h5>
                        </center>
                    </div>
                    <form action="#" method='POST' class="d-flex align-items-center">
                        @csrf
                        @method('DELETE')

                        <!-- <button type="submit" class="btn btn-danger mr-2"
                            onclick="return confirm('Yakin ingin menghapus seluruh data?')">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus Semua Data
                        </button> -->

                        <a class="btn btn-primary m-2 add-driver">
                            <i class="fas fa-plus me-2"></i>Tambah Driver</a>


                    </form>

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    <div class="card-body">
                        <table id="driverTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Driver</th>
                                    <th>Cabang</th>
                                    <th class="text-end">Harga</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- START Modal Driver for each rental -->
    <!-- START Modal ADD Driver -->
    <div class="modal fade" id="addDriverModal" tabindex="-1" role="dialog" aria-labelledby="addDriverModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Menambahkan Driver</h5>
                </div>
                <form id="addDriverForm" autocomplete="off">
                    <div class="modal-body">
                        <input type="hidden" name="id_driver_add" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div id="alertMessageAddDriver"
                                    class="alert alert-danger alert-dismissible fade show text-center d-none"
                                    role="alert"><strong>Terdapat isian yang tidak valid!</strong></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="selectCabangName">Cabang</label>
                                <select name="selectCabangName" id="selectCabangName" class="form-control">
                                    @foreach ($cabang as $c)
                                    <option value="{{ $c->nama_cabang}}">{{ $c->nama_cabang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="addDriverName">Nama Driver</label>
                                <input type="text" class="form-control" name="addDriverName" id="addDriverName"
                                    placeholder="Isikan nama driver...">
                            </div>
                            <div class="col-6">
                                <label for="addDriverPrice">Harga Driver</label>
                                <input type="text" class="form-control" name="addDriverPrice" id="addDriverPrice"
                                    placeholder="Isikan harga driver...">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            id="close-add-driver-modal-btn">Close</button>
                        <button type="button" class="btn btn-success" id="add-driver-submit-btn">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- START Modal ADD Driver -->

    <!-- START Modal Edit Driver -->
    <div class="modal fade" id="editDriverModal" tabindex="-1" role="dialog" aria-labelledby="editDrivermodalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Driver</h5>
                </div>
                <form id="driverEdit" autocomplete="off">
                    <div class="modal-body">
                        <input type="hidden" name="id_driver_edit" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div id="alertMessageEditDriver" class="alert alert-danger alert-dismissible fade show text-center d-none" role="alert"><strong>Terdapat isian yang tidak valid!</strong></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="editCabangName">Cabang</label>
                                <select name="editCabangName" id="editCabangName" class="form-control">
                                    @foreach ($cabang as $c)
                                    <option value="{{ $c->id}}">{{ $c->nama_cabang }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="editDriverName">Edit Nama Driver</label>
                                <input type="text" class="form-control" name="editDriverName" id="editDriverName"
                                    placeholder="Isikan nama driver...">
                            </div>

                            <div class="col-6">
                                <label for="editDriverPrice">Harga Driver</label>
                                <input type="text" class="form-control" name="editDriverPrice" id="editDriverPrice"
                                    placeholder="Isikan harga driver...">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            id="close-edit-driver-modal-btn">Close</button>
                        <button type="button" class="btn btn-success" id="edit-driver-submit-btn">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Modal Edit Driver -->


    <!-- Custom CSS (Load paling terakhir agar menimpa style lain jika perlu) -->
    <!-- <link rel="stylesheet" href="/assets/css/style.css"> -->

    <script>
        let getDriver = "{{ route('getDriver') }}",
            getDriverInformation = "{{ route('getDriverInformation') }}",
            deleteDriver = "{{ route('deleteDriver') }}",
            driver_store = "{{ route('driver.store') }}",
            updateDriver = "{{ route('updateDriver') }}";
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
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script> -->

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
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> -->

    <!-- Custom CSS (Load paling terakhir agar menimpa style lain jika perlu) -->
    <!-- <link rel="stylesheet" href="/assets/css/style.css"> -->

    <script src="./assets/js/adminPage/driver/driverIndex.js"></script>

</body>

</html>