<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mobil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                        <form action="{{ route('kendaraan.update', $kendaraan->id)}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="cabang_id">Nama Cabang</label>
                                        <select name="cabang_id" id="cabang_id" class="form-control">
                                            @foreach ($cabang_id as $cabang)
                                                <option value="{{ $cabang->id }}" {{ $cabang->id == $kendaraan->cabang_id ? 'selected' : '' }}>
                                                    {{ $cabang->nama_cabang }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="jenis_kendaraan">Jenis Kendaraan</label>
                                        <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-control">
                                            <option value="mobil" {{ $kendaraan->jenis_kendaraan == 'mobil' ? 'selected' : '' }}>Mobil</option>
                                            <option value="motor" {{ $kendaraan->jenis_kendaraan == 'motor' ? 'selected' : '' }}>Motor</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="merk">Merk</label>
                                        <input type="text" name="merk" class="form-control"
                                            value="{{($kendaraan->merk)}}" id="">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="nama_kendaraan">Nama Kendaraan</label>
                                        <input type="text" name="nama_kendaraan" class="form-control"
                                            value="{{($kendaraan->nama_kendaraan)}}" id="">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="plat_nomor">Plat</label>
                                        <input type="text" name="plat_nomor" class="form-control"
                                            value="{{($kendaraan->plat_nomor)}}" id="">
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="font-weight-bold" for="warna">Warna</label>
                                        <input type="text" name="warna" class="form-control"
                                            value="{{($kendaraan->warna)}}" id="">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="harga_sewa">Harga</label>
                                        <input type="text" name="harga_sewa" class="form-control"
                                            value="{{($kendaraan->harga_sewa)}}" id="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="gambar">Gambar</label>
                                        <input type="file" name="gambar" class="button"
                                            value="{{($kendaraan->gambar)}}" id="gambar" request>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="tahun_pembuatan">Tahun Pembuatan</label>
                                        <input type="text" name="tahun_pembuatan" class="form-control"
                                            value="{{($kendaraan->tahun_pembuatan)}}" id="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="status">Status</label>
                                        <input type="text" name="status" class="form-control"
                                            value="{{($kendaraan->status)}}" id="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                    <button type="reset" class="btn btn-warning">RESET</button>
                                    <a type="button" class="btn btn-info" href="{{ route('driver.index')}}">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>