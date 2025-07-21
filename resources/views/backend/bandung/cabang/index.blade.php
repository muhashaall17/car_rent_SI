<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Cabang</title>
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
                            <h5 class="card-title">Cabang</h5>
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

                        <!-- href="{{ route('cabang.create')}}" -->
                        <a class="btn btn-primary m-2 add-cabang"><i class="fas fa-plus me-2"></i>Tambah Cabang</a>

                        <!-- <a class="btn btn-success" href="#"><i class="fas fa-file-excel mr-2"></i> Export Excel</a> -->
                    </form>

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    <div class="card-body">
                        <table id="cabangTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-start" style="width: 8%;">No</th>
                                    <th class="text-start">Nama Cabang</th>
                                    <th class="text-center" style="width: 20%;">Action</th>
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

    <!-- START Modal Payment for each rental -->
    <!-- START Modal Add Cabang -->
    <div class="modal fade" id="addCabangModal" tabindex="-1" role="dialog" aria-labelledby="addCabangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Cabang</h5>
                </div>
                <form id="addCabang" autocomplete="off">
                    <div class="modal-body">
                        <input type="hidden" name="id_cabang_add" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div id="alertMessageAddCabang"
                                    class="alert alert-danger alert-dismissible fade show text-center d-none"
                                    role="alert"><strong>Terdapat isian yang tidak valid!</strong></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="addCabangName">Nama Cabang</label>
                                <input type="text" class="form-control" name="addCabangName" id="addCabangName"
                                    placeholder="Isikan nama cabang...">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            id="close-add-cabang-modal-btn">Close</button>
                        <button type="button" class="btn btn-success" id="add-cabang-submit-btn">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Modal Add Cabang -->

    <!-- START Modal Edit Cabang -->
    <div class="modal fade" id="editCabangModal" tabindex="-1" role="dialog" aria-labelledby="editCabangmodalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Cabang</h5>
                </div>
                <form id="cabangEdit" autocomplete="off">
                    <div class="modal-body">
                        <input type="hidden" name="id_cabang_edit" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div id="alertMessageEditCabang" class="alert alert-danger alert-dismissible fade show text-center d-none" role="alert"><strong>Terdapat isian yang tidak valid!</strong></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="editCabangName">Nama Cabang Baru</label>
                                <input type="text" class="form-control" name="editCabangName" id="editCabangName">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            id="close-edit-cabang-modal-btn">Close</button>
                        <button type="button" class="btn btn-success" id="edit-cabang-submit-btn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Modal Edit Cabang -->

    <script>
        let getCabang = "{{ route('getCabang') }}",
            getNameCabang = "{{ route('getNameCabang') }}",
            deleteCabang = "{{ route('deleteCabang') }}",
            cabang_store = "{{ route('cabang.store') }}",
            updateCabangName = "{{ route('updateCabangName') }}";
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

    <script src="./assets/js/adminPage/cabang/cabangIndex.js"></script>

</body>

</html>