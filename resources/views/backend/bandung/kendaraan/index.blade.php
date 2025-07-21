<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kendaraan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @include('backend.bandung.layouts.sidebar')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mb-2">
                        <center>
                            <h5 class="card-title">Data Kendaraan</h5>
                        </center>
                    </div>

                    <form action="#" method='POST' class="d-flex align-items-center">
                        @csrf
                        @method('DELETE')

                        <!-- <a class="btn btn-info mr-2" href="{{ route('kendaraan.create')}}"><i
                                class="fas fa-plus mr-2"></i>Tambah Kendaraan</a> -->

                        <a class="btn btn-primary m-2 add-kendaraan">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Kendaraan
                        </a>

                        <!-- <a class="btn btn-success" href="#"><i class="fas fa-file-excel mr-2"></i> Export Excel</a> -->
                    </form>

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    <div class="card-body">
                        <table id="kendaraanTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">ID Cabang</th>
                                    <th class="text-center">Jenis Kendaraan</th>
                                    <th class="text-center">Plat Nomor</th>
                                    <th class="text-center">Merk</th>
                                    <th class="text-center">Harga Sewa</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- @foreach ($kendaraan as $p)
                                <tr>
                                    <td>{{ $p->cabang_id }}</td>
                                    <td>{{ $p->jenis_kendaraan}}</td>
                                    <td>{{ $p->plat_nomor}}</td>
                                    <td>{{ $p->merk}}</td>
                                    <td>{{ $p->harga_sewa}}</td>
                                    <td>{{ $p->status}}</td>
                                    <td>
                                        <form action="{{ route('kendaraan.destroy', $p->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a style="font-size: 16px" href="#" class="btn btn-sm btn-secondary"
                                                data-toggle="modal" data-target="#detailModal{{ $p->id }}">
                                                <i class="fa fa-info"></i>
                                            </a>
                                            <a style="font-size: 14.5px" href="{{ route('kendaraan.edit', $p->id)}}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button style="font-size: 12px" type="submit" class="btn btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus data?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        Modal for each rental -->
                                <!-- <div class="modal fade" id="detailModal{{ $p->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="detailModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detailModalLabel">Detail Kendaraan -
                                                            {{ $p->merk }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>ID Cabang:</strong> {{ $p->cabang_id }}</p>
                                                        <p><strong>Jenis Kendaraan:</strong> {{ $p->jenis_kendaraan }}
                                                        </p>
                                                        <p><strong>Plat Nomor:</strong> {{ $p->plat_nomor }}</p>
                                                        <p><strong>Merk:</strong> {{ $p->merk }}</p>
                                                        <p><strong>Nama Kendaraan:</strong> {{ $p->nama_kendaraan }}</p>
                                                        <p><strong>Tahun:</strong> {{ $p->tahun_pembuatan }}</p>
                                                        <p><strong>Warna:</strong> {{ $p->warna }}</p>
                                                        <p><strong>Harga:</strong> {{ $p->harga_sewa }}</p>
                                                        <p><strong>Gambar :</strong>
                                                            @if ($p->gambar == null)
                                                            -
                                                            @else
                                                            <a href="{{ url('storage/mobil/' . $p->gambar) }}"
                                                                target="_blank">
                                                                <img src="{{ url('storage/mobil/' . $p->gambar) }}"
                                                                    alt="Gambar Kendaraan"
                                                                    style="width: 150px; height: auto; border-radius: 8px; cursor: pointer;">
                                                            </a>
                                                            @endif
                                                        </p>
                                                        <p><strong>Status:</strong> {{ $p->status }}
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach  -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let getKendaraan = "{{ route('getKendaraan') }}",
            deleteKendaraan = "{{ route('deleteKendaraan') }}",
            kendaraan_store = "{{ route('kendaraan.store') }}",
            kendaraan_create = "{{ route('kendaraan.create') }}",
            updateDriver = "{{ route('updateDriver') }}";
    </script>

    <!-- jQuery (Load pertama kali) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI (Versi yang kompatibel dengan jQuery 3.x) -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Bootstrap CSS (Versi 5.3.3) -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> -->

    <!-- Font Awesome (Versi terbaru 6.7.1) -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <!-- Select2 CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">

    <!-- Popper.js (Bootstrap dependency) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->

    <!-- Bootstrap JS (Versi 5.3.3) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script> -->

    <!-- Moment.js -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script> -->

    <!-- Dexie.js -->
    <!-- <script src="https://unpkg.com/dexie/dist/dexie.js"></script> -->

    <!-- Select2 JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>

    <!-- Validasi Form JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <!-- Sweet Alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Money Formatting -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> -->

    <!-- <link rel="stylesheet" href="/assets/css/style.css"> -->

    <script src="./assets/js/adminPage/kendaraan/kendaraanIndex.js"></script>

</body>

</html>