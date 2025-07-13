<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Untuk Transaksi</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>

<body>
    <div class="container">
        <form action="{{ route('register.store')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold" for="name">Nama</label>
                        <input type="text" name="name" class="form-control" id="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold" for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold" for="email">email</label>
                        <input type="text" name="email" class="form-control" id="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="">
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