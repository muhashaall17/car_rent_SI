<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mobil</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <form id="addKendaraanForm" enctype="multipart/form-data" autocomplete="off" method="POST">
                            @csrf
                            <input type="hidden" name="id_kendaraan_add" autocomplete="off">
                            <div class="row">
                                <div class="col-12">
                                    <div id="alertMessageAddKendaraan"
                                        class="alert alert-danger alert-dismissible fade show text-center d-none"
                                        role="alert"><strong>Terdapat isian yang tidak valid!</strong></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cabang_id">Cabang</label>
                                <select name="cabang_id" id="cabang_id" class="form-control">
                                    @foreach ($cabang_id as $cId)
                                    <option value="{{ $cId->id }}">{{ $cId->nama_cabang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="jenis_kendaraan">Jenis Kendaraan</label>
                                        <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-control">
                                            <option value="Mobil">Mobil</option>
                                            <option value="Motor">Motor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="plat_nomor">Plat Nomor</label>
                                        <input type="text" name="plat_nomor" class="form-control" id="plat_nomor">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="merk">Merk</label>
                                        <input type="text" name="merk" class="form-control" id="merk">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="nama_kendaraan">Nama Kendaraan</label>
                                        <input type="text" name="nama_kendaraan" class="form-control" id="nama_kendaraan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="tahun_pembuatan">Tahun Pembuatan</label>
                                        <input type="text" name="tahun_pembuatan" class="form-control" id="tahun_pembuatan">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="warna">Warna</label>
                                        <input type="text" name="warna" class="form-control" id="warna">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="harga_sewa">Harga Sewa</label>
                                        <input type="text" name="harga_sewa" class="form-control" id="harga">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="gambar">Gambar</label>
                                        <input type="file" name="gambar" class="button" id="gambar">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary" id="add-kendaraan-submit-btn">Tambah</button>
                                    <button type="reset" class="btn btn-warning">RESET</button>
                                    <a type="button" class="btn btn-info back-to-kendaraan-page">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery (Load pertama kali) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI (Versi yang kompatibel dengan jQuery 3.x) -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Bootstrap CSS (Versi 5.3.3) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome (Versi terbaru 6.7.1) -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- DataTables CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css"> -->

    <!-- Popper.js (Bootstrap dependency) -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Bootstrap JS (Versi 5.3.3) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <!-- Moment.js -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script> -->

    <!-- Dexie.js -->
    <!-- <script src="https://unpkg.com/dexie/dist/dexie.js"></script> -->

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
    <!-- <link rel="stylesheet" href="/assets/css/style.css"> -->

    <script>
        // AJAX START
        $(document).ready(() => {
            // AJAX UNTUK TAMBAH DATA KENDARAAN START
            $('button#add-kendaraan-submit-btn').click(function() {
                $('form#addKendaraanForm').submit();
            });
            // AJAX UNTUK TAMBAH DATA KENDARAAN EBD

            // AJAX UNTUK FORM TAMBAH KENDARAAN START
            $('form#addKendaraanForm').submit(e => {
                e.preventDefault();

                let formElement = document.querySelector('#addKendaraanForm');
                let formData = new FormData(formElement);

                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                formData.append('id', $('input[name="id_kendaraan_add"]').val() || '');

                $.ajax({
                    url: "{{ route('kendaraan.store') }}",
                    type: 'POST',
                    data: formData,
                    processData: false, // penting untuk file
                    contentType: false, // penting untuk file
                    dataType: 'JSON',
                    beforeSend: () => {
                        $('form#addKendaraanForm').validate({
                            rules: {
                                cabang_id: {
                                    required: true
                                },
                                jenis_kendaraan: {
                                    required: true
                                },
                                plat_nomor: {
                                    required: true
                                },
                                merk: {
                                    required: true
                                },
                                nama_kendaraan: {
                                    required: true
                                },
                                tahun_pembuatan: {
                                    required: true
                                },
                                warna: {
                                    required: true
                                },
                                harga_sewa: {
                                    required: true
                                },
                                gambar: {
                                    required: true
                                },
                            }
                        });

                        jQuery.extend(jQuery.validator.messages, {
                            required: 'Bagian ini wajib diisi!',
                        });

                        if (!$('form#addKendaraanForm').valid()) {
                            $('div#alertMessageAddKendaraan').removeClass('d-none');
                            return false;
                        } else {
                            $('div#alertMessageAddKendaraan').addClass('d-none');
                        }
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: response.msg,
                                text: 'Kembali ke menu driver...',
                                icon: 'success',
                                confirmButtonText: 'Lanjutkan',
                            }).then(result => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('kendaraan.index') }}";
                                }
                            });
                        } else {
                            console.error(response.msg);
                        }
                    },
                    error: function(response) {
                        console.error(response);
                    }
                });
            });
            // AJAX UNTUK FORM TAMBAH KENDARAAN END

            // AJAX UNTUK MENEKAN TOMBOL KEMBALI START
            $(document).on('click', 'a.back-to-kendaraan-page', () => {
                window.location.href = "{{ route('kendaraan.index') }}";
            })
            // AJAX UNTUK MENEKAN TOMBOL KEMBALI END
        });
        // AJAX END
    </script>
</body>

</html>