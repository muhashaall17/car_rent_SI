<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Data Diri</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>

<body>
    <div class="container">
        <form action="{{ route('register.data')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold" for="no_ktp">No KTP</label>
                        <input type="text" name="no_ktp" class="form-control" id="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold" for="no_sim">No SIM</label>
                        <input type="text" name="no_sim" class="form-control" id="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold" for="alamat">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold" for="nama">Nama</label>
                        <!-- Mengisi nama otomatis dari user yang sudah login -->
                        <input type="text" name="nama" class="form-control" id="" value="{{ Auth::user()->name }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold" for="no_hp">Nomor Handphone</label>
                        <input type="text" name="no_hp" class="form-control" id="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold" for="email">Email</label>
                        <!-- Mengisi email otomatis dari user yang sudah login -->
                        <input type="text" name="email" class="form-control" id="" value="{{ Auth::user()->email }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold" for="no_ktm">No KTM</label>
                        <input type="text" name="no_ktm" class="form-control"
                            placeholder="kosongkan jika anda bukan mahasiswa/pelajar" id="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                    <br><br>
                    <button type="reset" class="btn btn-warning">RESET</button>
                </div>
            </div>
        </form>

    </div>
</body>

</html>
