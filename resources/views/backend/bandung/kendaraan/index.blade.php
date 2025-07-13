<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kendaraan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('backend.bandung.layouts.loadLibGlobal')
</head>

<body>
    @include('backend.bandung.layouts.sidebar') 
    <div class="content-wrapper">
        <div class="row mt-4">
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

                        <a class="btn btn-info mr-2 add-kendaraan">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Kendaraan
                        </a>
                                
                        <a class="btn btn-success" href="#"><i class="fas fa-file-excel mr-2"></i> Export Excel</a>
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
        // AJAX START
        $(document).ready(() => {
            /* 
                KOLOM-KOLOM YANG DI AWAL TAMPIL :
                => ID CABANG
                => JENIS KENDARAAN
                => PLAT NOMOR
                => MERK
                => HARGA
                => STATUS
                => ACTION
            */
            // DATATABLE KENDARAAN START
            let dtbKendaraan = new DataTable('#kendaraanTable', {
                processing: true,
                serverSide: false,
                ajax: "{{ route('getKendaraan') }}",
                columns: [
                    {
                        data: 'id',
                        class: 'text-center',
                        name: 'id',
                    },
                    {
                        data: 'cabang_id',
                        class: 'text-center',
                    },
                    {
                        data: 'jenis_kendaraan',
                        class: 'text-center',
                    },
                    {
                        data: 'plat_nomor',
                        class: 'text-center',
                    },
                    {
                        data: 'merk',
                        class: 'text-center',
                    },
                    {
                        data: 'harga_sewa',
                        class: 'text-center',
                    },
                    {
                        data: 'status',
                        class: 'text-center',
                    },
                    {
                        data: 'id',
                        class: 'text-center',
                        render: (data, type, row) => {
                            return `
                                <a style="font-size: 16px" href="#" class="btn btn-sm btn-primary edit-driver-btn" data-key="${data}">
                                    <i class="fa fa-info"></i>
                                </a>

                                <a style="font-size: 16px" href="#" class="btn btn-sm btn-primary edit-kendaraan-btn" data-key="${data}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                
                                <a style="font-size: 16px" href="#" class="btn btn-sm btn-danger delete-kendaraan-btn" data-key="${data}">
                                <i class="fa fa-trash"></i>
                                </a>
                            `;
                        }
                    },
                ]
            });
            // DATATABLE KENDARAAN END

            $(document).on('click', 'a.add-kendaraan', () => {
                window.location.href = "{{ route('kendaraan.create') }}";
            });

            // AJAX EDIT KENDARAAN START
            // $(document).on('click', 'a.edit-kendaraan-btn', () => {
                //     window.location.href = "{{ route('kendaraan.edit') }}"
                // });
            // AJAX EDIT KENDARAAN END

            // AJAX DELETE KENDARAAN START
            $(document).on('click', 'a.delete-kendaraan-btn', function() {
                const kendaraanId = $(this).data('key');
                
                Swal.fire({
                    title: 'Hapus Kendaraan',
                    text: 'Apakah Anda yakin ingin menghapus kendaraan ?',
                    icon: 'question',
                    confirmButtonText: 'Ya',
                    showCancelButton: true,
                    cancelButtonText: 'Tidak',
                }).then(result => {
                    if(result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('deleteKendaraan') }}",
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                id: kendaraanId,
                            },
                            success: function (response) {
                                if (response.success) {
                                    dtbKendaraan.ajax.reload();

                                    Swal.fire({
                                        title: response.msg,
                                        text: 'Kembali ke halaman Kendaraan...',
                                        icon: 'success',
                                    });
                                } else {
                                    console.error(response.msg);
                                }
                            },
                            error: function (response) {console.error(response);
                            }
                        });
                    }
                })
            });
            // AJAX DELETE KENDARAAN END
        });
        // AJAX END
    </script>
    <!-- <link rel="stylesheet" href="/assets/css/style.css"> -->

    <!-- <script src="./assets/js/adminPage/kendaraan/kendaraanIndex.js"></script> -->

</body>

</html>