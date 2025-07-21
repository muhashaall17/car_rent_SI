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
    let dtbKendaraan = new DataTable("#kendaraanTable", {
        processing: true,
        serverSide: false,
        ajax: getKendaraan,
        columns: [
            {
                data: null, // tidak mengambil dari field data
                class: "text-start",
                orderable: true,
                searchable: false,
                render: (data, type, row, meta) => {
                    return meta.row + 1;
                },
            },
            {
                data: "plat_nomor",
                class: "text-start",
            },
            {
                data: "nama_cabang",
                class: "text-start",
            },
            {
                data: "nama",
                class: "text-start",
            },
            {
                data: "harga_sewa",
                class: "text-end",
            },
            {
                data: "status",
                class: "text-center",
            },
            {
                data: "id",
                class: "text-center",
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
                },
            },
        ],
    });
    // DATATABLE KENDARAAN END

    $(document).on("click", "a.add-kendaraan", () => {
        window.location.href = kendaraan_create;
    });

    // AJAX EDIT KENDARAAN START
    // $(document).on('click', 'a.edit-kendaraan-btn', () => {
    //     window.location.href = "{{ route('kendaraan.edit') }}"
    // });
    // AJAX EDIT KENDARAAN END

    // AJAX DELETE KENDARAAN START
    $(document).on("click", "a.delete-kendaraan-btn", function () {
        const kendaraanId = $(this).data("key");

        Swal.fire({
            title: "Hapus Kendaraan",
            text: "Apakah Anda yakin ingin menghapus kendaraan ?",
            icon: "question",
            confirmButtonText: "Ya",
            showCancelButton: true,
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteKendaraan,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        id: kendaraanId,
                    },
                    success: function (response) {
                        if (response.success) {
                            dtbKendaraan.ajax.reload();

                            Swal.fire({
                                title: response.msg,
                                text: "Kembali ke halaman Kendaraan...",
                                icon: "success",
                            });
                        } else {
                            console.error(response.msg);
                        }
                    },
                    error: function (response) {
                        console.error(response);
                    },
                });
            }
        });
    });
    // AJAX DELETE KENDARAAN END
});
// AJAX END
