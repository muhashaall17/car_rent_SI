<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">

    <title>Data Rental Item</title>
</head>

<body>
    @include('backend.bandung.layouts.sidebar') 
    <div class="content-wrapper">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mb-2">
                        <center>
                            <h5 class="card-title">Data Rental Item</h5>
                        </center>
                    </div>
                    <form action="#" method='POST' class="d-flex align-items-center">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger mr-2"
                            onclick="return confirm('Yakin ingin menghapus seluruh data?')">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus Semua Data
                        </button>

                        <a class="btn btn-info mr-2" href="{{ route('pembayaran.create')}}"><i class="fas fa-plus mr-2"></i>Tambah Pembayaran</a>

                        <a class="btn btn-success" href="#"><i class="fas fa-file-excel mr-2"></i> Export Excel</a>
                    </form>

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <table id="Pembayaran" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No Invoice</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Nominal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembayaran as $p)
                                    <tr>
                                        <td>{{ $p->no_invoice }}</td>
                                        <td>{{ $p->nama_pelanggan }}</td>
                                        <td>{{ $p->nominal }}</td>
                                        <td>
                                            <!-- <form action="#" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a style="font-size: 14.5px" href="#" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <button style="font-size: 12px" type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form> -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#Pembayaran');
    </script>
</body>

</html>