<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Driver</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('backend.bandung.layouts.loadLibGlobal')
</head>

<body>
    @include('backend.bandung.layouts.sidebar') 
    <div class="content-wrapper">
        <div class="row mt-4">
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

                        <a class="btn btn-info mr-2 add-driver">
                            <i class="fas fa-plus mr-2"></i>Tambah Driver</a>

                        <a class="btn btn-success" href="#"><i class="fas fa-file-excel mr-2"></i> Export Excel</a>
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

    <!-- END Modal Payment for each rental -->

    <script>
        // AJAX START
        $(document).ready(() => {

            function Rupiah(angka) {
                var rupiah = "";
                var angkarev = angka.toString().split("").reverse().join("");
                for (var i = 0; i < angkarev.length; i++)
                    if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ".";
                return rupiah
                    .split("", rupiah.length - 1)
                    .reverse()
                    .join("");
            }

            // DATATABLE DRIVER START
            let dtbDriver = new DataTable('#driverTable', {
                processing: true,
                serverSide: false,
                ajax: "{{ route('getDriver') }}",
                columns: [
                    {
                        data: 'nama_driver',
                        class: 'text-start',
                        name: 'nama_driver'
                    },
                    {
                        data: 'nama_cabang',
                        class: 'text-start',
                        name: 'nama_cabang'
                    },
                    {
                        data: 'harga',
                        class: 'text-end',
                        render: function (data, type, row) {
                            return Rupiah(data);
                        },
                    },
                    {
                        data: 'id',
                        class: 'text-center',
                        render: (data, type, row) => {
                            return `<a style="font-size: 16px" href="#" class="btn btn-sm btn-primary edit-driver-btn" data-key="${data}" data-cabang="${row['cabang_id']}"  data-driver="${row['nama_driver']}" data-price="${row['harga']}">
                            <i class="fa fa-pencil"></i>
                            </a>
                            <a style="font-size: 16px" href="#" class="btn btn-sm btn-danger delete-driver-btn" data-key="${data}">
                            <i class="fa fa-trash"></i>
                            </a>`;
                        }
                    }
                ]
            });
            // DATATABLE DRIVER END

            // MODAL UNTUK TAMBAH DRIVER START
            $('div#addDriverModal').modal({
                show: false,
                keyboard: false,
                backdrop: 'static',
            });
            // MODAL UNTUK TAMBAH DRIVER END

            // SETTING EDIT MODAL UNTUK DRIVER START
            $('#editDriverModal').modal({
                show:false,
                keyboard: false,
                backdrop: 'static',
            }).on('shown.bs.modal', () => {
                $('#addDriverModal').modal('hide');
            }).on('hidden.bs.modal', () => {
                $('form#driverEdit').validate().resetForm();
                $("div#alertMessageEditDriver").addClass("d-none");
            });
            // SETTING EDIT MODAL UNTUK DRIVER END

            // FUNGSI KETIKA TOMBOL 'Tambah Driver' DITEKAN START
            $(document).on('click', 'a.add-driver', function () {
                $('div#addDriverModal').modal('show');
            });
            // FUNGSI KETIKA TOMBOL 'Tambah Driver' DITEKAN END

            // FUNGSI UNTUK EDIT NAMA DRIVER START
            $(document).on('click', 'a.edit-driver-btn', function () {
                let driverId = $(this).data('key');
                let cabangId = $(this).data('cabang');
                let driverName = $(this).data('driver');
                let driverPrice = $(this).data('price');
                $('input[name="id_driver_edit"]').val(driverId);
                $(`select[name="editCabangName"]`).val(cabangId);
                $('input[name="editDriverName"]').val(driverName);
                $('input[name="editDriverPrice"]').val(driverPrice);

                $.ajax({
                    url: "{{ route('getDriverInformation') }}",
                    method: 'GET',
                    data: {id: driverId},
                    success: (response) => {
                        if(response.data) {
                            $('select[name="editCabangName"]').val(response.data.cabang_id);
                            $('input[name="editDriverName"]').val(response.data.nama_driver);
                            $('input[name="editDriverPrice"]').val(response.data.harga);
                        }
                        $('#addDriverModal').modal('hide');
                        $('#editDriverModal').modal('show');
                    },
                    error: (err) => {
                        console.error(err);
                    },
                });
            });
            // FUNGSI UNTUK EDIT NAMA DRIVER END

            // FUNGSI HAPUS DRIVER START
            $(document).on('click', 'a.delete-driver-btn', function () {
                let driverId = $(this).data('key');

                Swal.fire({
                    title: 'Hapus Driver',
                    text: 'Apakah Anda yakin ingin menghapus driver ?',
                    icon: 'question',
                    confirmButtonText: 'Ya',
                    showCancelButton: true,
                    cancelButtonText: 'Tidak',
                }).then(result => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('deleteDriver') }}",
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                id: driverId,
                            },
                            success: function (response) {
                                if (response.success) {
                                    dtbDriver.ajax.reload();

                                    Swal.fire({
                                        title: response.msg,
                                        text: 'Kembali ke halaman driver...',
                                        icon: 'success',
                                    });
                                } else {
                                    console.error(response.msg);
                                }
                            },
                            error: function (response) {
                                console.error(response);
                            }
                        });
                    }
                });
            });
            // FUNGSI HAPUS DRIVER END

            // FUNGSI KETIKA KLIK TOMBOL TAMBAH DRIVER MODAL START
            $('button#add-driver-submit-btn').click(function () {
                $('form#addDriverForm').submit();
            });
            // FUNGSI KETIKA KLIK TOMBOL TAMBAH DRIVER MODAL END

            // FUNGSI FORM TAMBAH DRIVER START
            $('form#addDriverForm').submit(e => {
                e.preventDefault();
                let getNewDriverName = $('input[name="addDriverName"]').val();
                let getCabangName = $('select[name="selectCabangName"]').val();
                let getCabangId;
                if (getCabangName === 'Bandung') {
                    getCabangId = 1;
                } else if (getCabangName === 'Purwakarta') {
                    getCabangId = 2;
                } else {
                    $('div#alertMessageAddDriver').removeClass('d-none');
                    return false;
                }
                let formData = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: $('input[name="id_driver_add"]').val() || null,
                    cabang_id: getCabangId || null,
                    nama_driver: getNewDriverName || null,
                    harga: $('input[name="addDriverPrice"]').val() || null
                };

                $.ajax({
                    url: "{{ route('driver.store') }}",
                    type: 'POST',
                    dataType: 'JSON',
                    data: formData,
                    beforeSend: () => {
                        $('form#addDriverForm').validate({
                            rules: {
                                selectCabangName: {
                                    required: true,
                                },
                                addDriverName: {
                                    required: true,
                                },

                                addDriverPrice: {
                                    required: true,
                                },
                            },
                        });

                        jQuery.extend(jQuery.validator.messages, {
                            required: 'Bagian ini wajib diisi!',
                        });

                        if (!$('form#addDriverForm').valid()) {
                            $('div#alertMessageAddDriver').removeClass('d-none');
                            return false;
                        } else {
                            $('div#alertMessageAddDriver').addClass('d-none');
                            $('form#addDriverForm').validate().resetForm();
                        }
                    },
                    success: function (response) {
                        if (response.success) {
                            dtbDriver.ajax.reload();
                            Swal.fire({
                                title: response.msg,
                                text: 'Kembali ke menu driver...',
                                icon: 'success',
                                confirmButtonText: 'Lanjutkan',
                            }).then(result => {
                                if (result.isConfirmed) $('div#addDriverModal').modal('hide');
                            });
                        } else {
                            console.error(response.msg);
                        }
                    },
                    error: function (response) {
                        console.error(response);
                    }

                })
            });
            // FUNGSI FORM TAMBAH DRIVER END

            // FUNGSI KETIKA TOMBOL EDIT DIKLIK START
            $('button#edit-driver-submit-btn').click(() => {
                $('form#driverEdit').submit();
            });
            // FUNGSI KETIKA TOMBOL EDIT DIKLIK END

            // FUNGSI FORM EDIT CABANG START
            $('form#driverEdit').submit((e) => {
                e.preventDefault();
                let newCabang = $('select[name="editCabangName"]').val();
                let newDriver = $('input[name="editDriverName"]').val();
                let newPrice = $('input[name="editDriverPrice"]').val();
                let formData = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: $('input[name="id_driver_edit"]').val() || null,
                    cabang_id: newCabang || null,
                    nama_driver: newDriver || null,
                    harga: newPrice || 0
                };

                $.ajax({
                    url: "{{ route('updateDriver') }}",
                    type: 'POST',
                    dataType: 'JSON',
                    data: formData,
                    beforeSend: () => {
                        $('form#driverEdit').validate({
                            rules: {
                                editCabangName: {required: true},
                                editDriverName: {required: true},
                                editDriverPrice: {required: true},
                            }
                        }); 
                        jQuery.extend(jQuery.validator.messages, {
                            required: 'Bagian ini wajib diisi!',
                        });

                        if(!$('form#driverEdit').valid()) {
                            $("div#alertMessageEditDriver").removeClass("d-none");
                        } else {
                            $("div#alertMessageEditDriver").addClass("d-none");
                            // $('form#driverEdit').validate().resetForm();
                        }
                    },
                    success: (response) => {
                        if(response.success){
                            dtbDriver.ajax.reload();
                            Swal.fire({
                                title: response.msg,
                                text: 'Driver berhasil diedit...',
                                icon: 'success',
                                confirmButtonText: 'Lanjutkan',
                                backdrop: false,
                            }).then((result) => {
                                if(result.isConfirmed) $('#editDriverModal').modal('hide');
                            });
                        } else {
                            console.error(reponse.msg);
                        }
                    },
                    error: (response) => console.error(response),
                });
            });
            // FUNGSI FORM EDIT CABANG END

            // FUNGSI KETIKA KLIK TOMBOL CLOSE TAMBAH DRIVER START
            $(document).on('click', 'button#close-add-driver-modal-btn', function () {
                $('div#addDriverModal').modal('hide');
            });
            // FUNGSI KETIKA KLIK TOMBOL CLOSE TAMBAH DRIVER END
            
            // FUNGSI KETIKA KLIK TOMBOL CLOSE EDIT DRIVER START
            $(document).on('click', 'button#close-edit-driver-modal-btn', function () {
                $('div#editDriverModal').modal('hide');
            });
            // FUNGSI KETIKA KLIK TOMBOL CLOSE EDIT DRIVER END
        });
        // AJAX END
    </script>

    <!-- Custom CSS (Load paling terakhir agar menimpa style lain jika perlu) -->
    <!-- <link rel="stylesheet" href="/assets/css/style.css"> -->

    <!-- <script src="./assets/js/adminPage/driver/driverIndex.js"></script> -->

</body>

</html>