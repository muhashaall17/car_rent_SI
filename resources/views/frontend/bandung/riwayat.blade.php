<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">

    <title>Riwayat Transaksi</title>
</head>

<body>
    @include('frontend.bandung.layouts.navbar') 
    <div class="main-content">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mb-2">
                        <center>
                            <h5 class="card-title">Data Riwayat Transaksi</h5>
                        </center>
                    </div>

                    <div class="card-body">
                        <table id="riwayat" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Pelanggan</th>
                                    <th>Mobil</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Total Biaya</th>
                                    <th>Metode</th>
                                    <th>Bukti</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($history as $p)
                                    <tr>
                                        <td>{{ $p->id_pelanggan }}</td>
                                        <td>{{ $p->id_mobil }}</td>
                                        <td>{{ $p->tanggal_sewa }}</td>
                                        <td>{{ $p->tanggal_kembali }}</td>
                                        <td>{{ $p->total_biaya }}</td>
                                        <td>{{ $p->metode_pembayaran }}</td>
                                        <td>{{ $p->bukti_pembayaran }}</td>
                                        <td>{{ $p->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>