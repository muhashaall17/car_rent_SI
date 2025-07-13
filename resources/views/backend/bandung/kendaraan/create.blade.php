<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mobil</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @include('backend.bandung.layouts.loadLibGlobal')
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

    <script>
        // AJAX START
        $(document).ready(() => {
            // AJAX UNTUK TAMBAH DATA KENDARAAN START
            $('button#add-kendaraan-submit-btn').click(function () {
                $('form#addKendaraanForm').submit();
            });
            // AJAX UNTUK TAMBAH DATA KENDARAAN EBD

            // AJAX UNTUK FORM TAMBAH KENDARAAN START
            $('form#addKendaraanForm').submit(e => {
                e.preventDefault();
                let getCabang = $('select[name="cabang_id"]').val();
                let getJenisKendaraan = $('select[name="jenis_kendaraan"]').val();
                let getPlatNomor = $('input[name="plat_nomor"]').val();
                let getMerk = $('input[name="merk"]').val();
                let getNamaKendaraan = $('input[name="nama_kendaraan"]').val();
                let getTahunPembuatan = $('input[name="tahun_pembuatan"]').val();
                let getWarna = $('input[name="warna"]').val();
                let getHargaSewa = $('input[name="harga_sewa"]').val();
                let getGambar = $('input[name="gambar"]').val();

                // console.log(getCabang);
                // console.log(getJenisKendaraan);
                // console.log(getPlatNomor);
                // console.log(getMerk);
                // console.log(getNamaKendaraan);
                // console.log(getTahunPembuatan);
                // console.log(getWarna);
                // console.log(getHargaSewa);
                // console.log(getGambar);

                let formData = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: $('input[name="id_kendaraan_add"]').val() || null,
                    cabang_id: getCabang || null,
                    jenis_kendaraan: getJenisKendaraan || null,
                    plat_nomor: getPlatNomor || null,
                    merk: getMerk || null,
                    nama_kendaraan: getNamaKendaraan || null,
                    tahun_pembuatan: getTahunPembuatan || null,
                    warna: getWarna || null,
                    harga_sewa: getHargaSewa || null,
                    gambar: getGambar || null,
                };

                $.ajax({
                    url: "{{ route('kendaraan.store') }}",
                    type: 'POST',
                    dataType: 'JSON',
                    data: formData,
                    beforeSend: () => {
                        $('form#addKendaraanForm').validate({
                            rules: {
                                cabang_id: {required: true},
                                jenis_kendaraan: {required: true},
                                plat_nomor: {required: true},
                                merk: {required: true},
                                nama_kendaraan: {required: true},
                                tahun_pembuatan: {required: true},
                                warna: {required: true},
                                harga_sewa: {required: true},
                                gambar: {required: true},
                            }
                        });

                        jQuery.extend(jQuery.validator.messages, {
                            required: 'Bagian ini wajib diisi!',
                        });

                        if(!$('form#addKendaraanForm').valid()) {
                            $('div#alertMessageAddKendaraan').removeClass('d-none');
                            return false;
                        } else {
                            $('div#alertMessageAddKendaraan').addClass('d-none');
                        }
                    },
                    success: function (response) {
                        if(response.success) {
                            Swal.fire({
                                title: response.msg,
                                text: 'Kembali ke menu driver...',
                                icon: 'success',
                                confirmButtonText: 'Lanjutkan',
                            }).then(result => {
                                if(result.isConfirmed) {
                                    alert('Berhasil!');
                                }
                            });
                        } else {
                            console.error(response.msg);
                        }
                    },
                    error: function (response) {
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