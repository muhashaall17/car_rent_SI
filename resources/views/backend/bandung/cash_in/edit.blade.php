<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cash In</title>
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
                        <form action="{{ route('CashIn.update', $cash_in->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="cabang_id">Payment ID</label>
                                        <select name="payment_id" id="payment_id" class="form-control">
                                            @foreach ($pembayaran as $payment)
                                                <option value="{{ $payment->id }}" {{ $payment->id == $cash_in->payment_id ? 'selected' : '' }}>
                                                    {{ $payment->id }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="nominal">Nominal</label>
                                        <input type="text" name="nominal" class="form-control"
                                            value="{{($cash_in->nominal)}}" id="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="deskripsi">Deskripsi</label>
                                        <input type="text" name="deskripsi" class="form-control"
                                            value="{{($cash_in->deskripsi)}}" id="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                    <button type="reset" class="btn btn-warning">RESET</button>
                                    <a type="button" class="btn btn-info" href="{{ route('CashIn.index')}}">Kembali</a>
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