<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>

    <title>Data Rental Mobil</title>
</head>

<body>
    @include('backend.bandung.layouts.sidebar')
    <div class="main-content">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mb-2">
                        <center>
                            <h5 class="card-title">Data Rental Mobil</h5>
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

                        <a class="btn btn-info mr-2" href="{{ route('rental.create')}}"><i
                                class="fas fa-plus mr-2"></i>Tambah Rental Mobil</a>

                        <a class="btn btn-success" href="#"><i class="fas fa-file-excel mr-2"></i> Export Excel</a>
                    </form>
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    <div class="card-body">
                        <table id="table_rental_invoice" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No Invoice</th>
                                    <th>Cabang</th>
                                    <th>Tanggal Invoice</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Status Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rental as $p)
                                <tr>
                                    <td>{{ $p->no_invoice }}</td>
                                    <td>{{ $p->nama_cabang }}</td>
                                    <td>{{ $p->tanggal_invoice }}</td>
                                    <td>{{ $p->nama_pelanggan }}</td>
                                    <td>{{ $p->status_pembayaran }}</td>
                                    <td>
                                        <a style="font-size: 16px" href="#" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#detailModal{{ $p->id }}">
                                            <i class="fa fa-info"></i>
                                        </a>

                                        <a style="font-size: 16px" href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#paymentModal{{ $p->id }}">
                                            $
                                        </a>

                                        <!-- START Modal Payment for each rental -->
                                        <div class="modal fade classModalPayment" id="paymentModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="paymentModalLabel">Pembayaran Invoice Nomor - {{ $p->no_invoice }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <p><strong>Daftar Pembayaran</strong></p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#paymentModalAdd{{ $p->id }}"><i class="fa fa-danger">+</i></a>
                                                            </div>
                                                        </div>
                                                        <table>
                                                            <thead>
                                                                <tr>
                                                                    <th>Tanggal Bayar</th>
                                                                    <th>Jenis Pembayaran</th>
                                                                    <th>Nominal</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($p->payments as $payment)
                                                                <tr>
                                                                    <td>{{ $payment->tgl_bayar }}</td>
                                                                    <td>{{ $payment->metode_pembayaran }}</td>
                                                                    <td>{{ $payment->nominal }}</td>
                                                                    <td>{{ $payment->id }}</td>
                                                                </tr>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="4" class="text-center">Data Tidak Valid</td>
                                                                </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Modal Payment for each rental -->

                                        <!-- START Modal Add payment -->
                                        <div class="modal fade classModalAddPayment" id="paymentModalAdd{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="paymentModalAddLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1>Tambah Pembayaran</h1>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h2>Form Isi</h2>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <h2>Footer</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Modal Add payment -->

                                        <!-- START Modal Detail for each rental -->
                                        <div class="modal fade" id="detailModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detailModalLabel">Detail Invoice Nomor - {{ $p->no_invoice }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Detail Pelanggan -->
                                                        <p><strong>Detail Pelanggan</strong></p>
                                                        <p>Pesanan dari Cabang: {{ $p->nama_cabang }}</p>
                                                        <p>Nama Pelanggan: {{ $p->nama_pelanggan }}</p>
                                                        <p>Alamat: {{ $p->alamat }}</p>
                                                        <p>Email: {{ $p->email }}</p>

                                                        <br>

                                                        <!-- Detail Booking -->
                                                        <p><strong>Detail Booking</strong></p>
                                                        <table>
                                                            <thead>
                                                                <tr>
                                                                    <th>Deskripsi</th>
                                                                    <th>Tanggal Sewa</th>
                                                                    <th>Tanggal Kembali</th>
                                                                    <th>Harga</th>
                                                                    <th>Jumlah</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($p->details as $detail)
                                                                <tr>
                                                                    <td>{{ $detail->deskripsi }}</td>
                                                                    <td>{{ $detail->tanggal_sewa }}</td>
                                                                    <td>{{ $detail->tanggal_kembali }}</td>
                                                                    <td>{{ $detail->harga }}</td>
                                                                    <td>{{ $detail->jumlah }}</td>
                                                                </tr>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="5" class="text-center">Data Tidak Valid</td>
                                                                </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>

                                                        <br>

                                                        <!-- Detail Pembayaran -->
                                                        <p><strong>Detail Pembayaran</strong></p>
                                                        <p>Grand Total: Rp. {{ $p->grand_total }}</p>

                                                        <br>

                                                        <!-- Syarat Booking -->
                                                        <p><strong>Syarat Booking</strong></p>
                                                        <p>File KTP: {{ $p->ktp }}</p>
                                                        <p>File SIM: {{ $p->sim }}</p>
                                                        <p>File KK: {{ $p->ktp }}</p>
                                                        <p>File KTM: {{ $p->ktm }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Modal Detail for each rental -->

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
    <script>
        let tableInvoice = new DataTable('#table_rental_invoice');

        // $('div.classModalAddPayment').modal({
        //     show: false,
        //     keyboard: false
        // }).on('shown.bs.modal', function(e) {
        //     $('div.classModalPayment').modal('hide');
        // }).on('hidden.bs.modal', function(e) {
        //     $('div.classModalPayment').modal('show');
        // });
    </script>
</body>

</html>