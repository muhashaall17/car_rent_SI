// AJAX START
$(document).ready(() => {
    // DATATABLE CABANG START
    let dtbCabang = new DataTable("#cabangTable", {
        processing: true,
        serverSide: false,
        ajax: getCabang,
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
                data: "nama_cabang",
                class: "text-start",
                name: "nama_cabang",
            },
            {
                data: "id",
                orderable: false,
                class: "text-center",
                render: (data, type, row) => {
                    return `<a style="font-size: 16px" href="#" class="btn btn-sm btn-primary edit-cabang-btn" data-key="${data}">
                    <i class="fa fa-pencil"></i>
                    </a>
                    <a style="font-size: 16px" href="#" class="btn btn-sm btn-danger delete-cabang-btn" data-key="${data}">
                    <i class="fa fa-trash"></i>
                    </a>`;
                },
            },
        ],
    });
    // DATATABLE CABANG END

    // SETTING TAMBAH MODAL UNTUK CABANG START
    $("#addCabangModal").modal({
        show: false,
        keyboard: false,
        backdrop: "static",
    });
    // SETTING TAMBAH MODAL UNTUK CABANG END

    // SETTING EDIT MODAL UNTUK CABANG START
    $("#editCabangModal")
        .modal({
            show: false,
            keyboard: false,
            backdrop: "static",
        })
        .on("shown.bs.modal", () => {
            $("#addCabangModal").modal("hide");
        })
        .on("hidden.bs.modal", () => {
            $("form#cabangEdit").validate().resetForm();
            $("div#alertMessageEditCabang").addClass("d-none");
        });
    // SETTING EDIT MODAL UNTUK CABANG END

    // FUNGSI KETIKA TOMBOL 'Tambah Cabang' DIKLIK, MODAL MUNCUL START
    $(document).on("click", "a.add-cabang", () => {
        $("#addCabangModal").modal("show");
    });
    // FUNGSI KETIKA TOMBOL 'Tambah Cabang' DIKLIK, MODAL MUNCUL END

    // FUNGSI UNTUK EDIT NAMA CABANG START
    $(document).on("click", "a.edit-cabang-btn", function () {
        let cabangId = $(this).data("key");
        // console.log(cabangId);
        $('input[name="id_cabang_edit"]').val(cabangId);

        $.ajax({
            url: getNameCabang,
            method: "GET",
            data: {
                id: cabangId,
            },
            success: (response) => {
                if (response.data) {
                    $('input[name="editCabangName"]').val(
                        response.data.nama_cabang
                    );
                }
                $("#addCabangModal").modal("hide");
                $("#editCabangModal").modal("show");
            },
            error: (err) => {
                console.error(err);
            },
        });
    });
    // FUNGSI UNTUK EDIT NAMA CABANG END

    // DELETE CABANG START
    $(document).on("click", "a.delete-cabang-btn", function () {
        let cabangId = $(this).data("key");

        Swal.fire({
            title: "Hapus Cabang",
            text: "Apakah Anda yakin ingin menghapus cabang?",
            icon: "question",
            confirmButtonText: "Ya",
            showCancelButton: true,
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteCabang,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        id: cabangId,
                    },
                    success: function (response) {
                        dtbCabang.ajax.reload();
                        if (response.success) {
                            Swal.fire({
                                title: response.msg,
                                text: "Kembali ke halaman cabang..",
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
    // DELETE CABANG END

    // FUNGSI KETIKA KLIK TOMBOL TAMBAH CABANG START
    $("button#add-cabang-submit-btn").click(function () {
        $("form#addCabang").submit();
    });
    // FUNGSI KETIKA KLIK TOMBOL TAMBAH CABANG END

    // FUNGSI FORM TAMBAH CABANG START
    $("form#addCabang").submit((e) => {
        e.preventDefault();
        let getNewCabang = $('input[name="addCabangName"]').val();
        let formData = {
            _token: $('meta[name="csrf-token"]').attr("content"),
            id: $('input[name="id_cabang_add"]').val() || null,
            nama_cabang: getNewCabang || null,
        };

        $.ajax({
            url: cabang_store,
            type: "POST",
            dataType: "JSON",
            data: formData,
            beforeSend: () => {
                $.validator.addMethod(
                    "onlyText",
                    function (value, element) {
                        return /^[a-zA-Z\s]+$/.test(value);
                    },
                    "Hanya huruf yang diperbolehkan!"
                );

                $("form#addCabang").validate({
                    rules: {
                        addCabangName: {
                            required: true,
                            onlyText: true,
                        },
                    },
                });
                jQuery.extend(jQuery.validator.messages, {
                    required: "Bagian ini wajib diisi!",
                });

                if (!$("form#addCabang").valid()) {
                    $("div#alertMessageAddCabang").removeClass("d-none");
                    return false;
                }
            },
            success: (response) => {
                if (response.success) {
                    dtbCabang.ajax.reload();
                    Swal.fire({
                        title: response.msg,
                        text: "Kembali ke menu cabang...",
                        icon: "success",
                        confirmButtonText: "Lanjutkan",
                    }).then((result) => {
                        if (result.isConfirmed)
                            $("div#addCabangModal").modal("hide");
                    });
                } else {
                    console.error(response.msg);
                }
            },
            error: (response) => console.error(response),
        });
    });
    // FUNGSI FORM TAMBAH CABANG END

    // FUNGSI KETIKA TOMBOL EDIT DIKLIK START
    $("button#edit-cabang-submit-btn").click(() => {
        $("form#cabangEdit").submit();
    });
    // FUNGSI KETIKA TOMBOL EDIT DIKLIK END

    // FUNGSI FORM EDIT CABANG START
    $("form#cabangEdit").submit((e) => {
        e.preventDefault();
        let newCabang = $('input[name="editCabangName"]').val();
        let formData = {
            _token: $('meta[name="csrf-token"]').attr("content"),
            id: $('input[name="id_cabang_edit"]').val() || null,
            nama_cabang: newCabang || null,
        };

        $.ajax({
            url: updateCabangName,
            type: "POST",
            dataType: "JSON",
            data: formData,
            beforeSend: () => {
                $("form#cabangEdit").validate({
                    editCabangName: {
                        required: true,
                    },
                });
                jQuery.extend(jQuery.validator.messages, {
                    required: "Bagian ini wajib diisi!",
                });

                if (!$("form#cabangEdit").valid()) {
                    $("div#alertMessageEditCabang").removeClass("d-none");
                } else {
                    $("div#alertMessageEditCabang").addClass("d-none");
                }
            },
            success: (response) => {
                if (response.success) {
                    dtbCabang.ajax.reload();
                    Swal.fire({
                        title: response.msg,
                        text: "Nama cabang berhasil diedit...",
                        icon: "success",
                        confirmButtonText: "Lanjutkan",
                        backdrop: false,
                    }).then((result) => {
                        if (result.isConfirmed)
                            $("#editCabangModal").modal("hide");
                    });
                } else {
                    console.error(reponse.msg);
                }
            },
            error: (response) => console.error(response),
        });
    });
    // FUNGSI FORM EDIT CABANG END

    // FUNGSI KETIKA KLIK TOMBOL CLOSE TAMBAH CABANG START
    $(document).on("click", "button#close-add-cabang-modal-btn", function () {
        $("div#addCabangModal").modal("hide");
    });
    // FUNGSI KETIKA KLIK TOMBOL CLOSE TAMBAH CABANG END

    // FUNGSI KETIKA KLIK TOMBOL CLOSE EDIT CABANG START
    $(document).on("click", "button#close-edit-cabang-modal-btn", function () {
        $("div#editCabangModal").modal("hide");
        // MENAMBAHKAN CLASS D-NONE KETIKA CLICK CLOSE
        $("div#alertMessageEditCabang").addClass("d-none");
    });
    // FUNGSI KETIKA KLIK TOMBOL CLOSE EDIT CABANG END
});
// AJAX END
