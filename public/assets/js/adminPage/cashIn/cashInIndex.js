$(document).ready(function () {
    function Rupiah(angka) {
        var rupiah = "";
        var angkarev = angka.toString().split("").reverse().join("");
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ".";
        return rupiah
            .split("", rupiah.length - 1)
            .reverse()
            .join("");
    }

    $(".rupiah").mask("#.##0", {
        reverse: true,
    });

    // DATATABLE RENTAL/INVOICE
    let dtbCashIn = new DataTable("#cashInTable", {
        processing: true,
        serverSide: false,
        ajax: getDataTableCashIn,
        columns: [
            {
                data: "tgl_cin",
                class: "text-center",
                render: function (data, type, row) {
                    return moment(data).format("DD/MM/YYYY");
                },
            },
            {
                data: "nama_cabang",
                name: "nama_cabang",
            },
            {
                data: "nominal",
                class: "text-end",
                render: function (data, type, row) {
                    return Rupiah(data);
                },
            },
            {
                data: "deskripsi",
                name: "deskripsi",
            },
            {
                data: "id",
                class: "text-center",
                render: function (data, type, row) {
                    let btn = "";
                    if (!row["payment_id"]) {
                        btn = `
                        <a style="font-size: 16px" href="#" class="btn btn-sm btn-primary edit-cash-in-btn" data-key="${data}">
                             <i class="fa fa-pencil"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-danger delete-cash-in-btn" data-key="${data}">
                            <i class="fa fa-trash"></i>
                        </a>`;
                    }
                    return `
                    <a style="font-size: 16px" href="#" class="btn btn-sm btn-primary detail-cash-in-btn" data-key="${data}">
                    <i class="fa fa-info"></i>
                    </a>
                    ${btn}
                    `;
                },
            },
        ],
    });

    // setting modal cash in ADD
    $("div#cashInADDModal")
        .modal({
            show: false,
            keyboard: false,
            backdrop: "static",
        })
        .on("shown.bs.modal", function (e) {
            $('input[name="cashIn_date_ADD"]').val(
                moment().format("DD/MM/YYYY")
            );
        })
        .on("hidden.bs.modal", function (e) {
            $("form#cashInFormADD").validate().resetForm();
            $('input[name="cashIn_nominal_ADD"]').val(null);
            $('textarea[name="cashIn_desc_ADD"]').val(null);
            $("div#alertMessageFormcashInADD").addClass("d-none");
        });

    // setting modal cash in EDIT
    $("div#cashInEDITModal")
        .modal({
            show: false,
            keyboard: false,
            backdrop: "static",
        })
        .on("hidden.bs.modal", function (e) {
            $("form#cashInFormEDIT").validate().resetForm();
            $("div#alertMessageFormCashInEDIT").addClass("d-none");
        });

    // event button cash in ADD
    $(document).on("click", "a.add-cash-in-btn", function () {
        $("div#cashInADDModal").modal("show");
    });

    // event button cash in EDIT
    $(document).on("click", "a.edit-cash-in-btn", function () {
        let cashInId = $(this).data("key");
        $('input[name="cashIn_id_EDIT"]').val(cashInId);

        $.ajax({
            url: getDataCashIn,
            method: "GET",
            data: {
                id: cashInId,
            },
            success: function (response) {
                if (response.data) {
                    // console.log(response);
                    $('input[name="cashIn_date_EDIT"]').val(
                        moment(response.data.tgl_cin).format("DD/MM/YYYY")
                    );
                    $('select[name="cashIn_cabangId_EDIT"]').val(
                        response.data.cabang_id
                    );
                    $('input[name="cashIn_nominal_EDIT"]').val(
                        Rupiah(response.data.nominal)
                    );
                    $('textarea[name="cashIn_desc_EDIT"]').val(
                        response.data.deskripsi
                    );
                }

                // Menampilkan modal
                $("div#cashInEDITModal").modal("show");
            },
            error: function (err) {
                console.error(err);
                alert("Terjadi kesalahan saat mengambil data.");
            },
        });
    });

    $('input[name="cashIn_date_ADD"]').datepicker({
        dateFormat: "dd/mm/yy",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        onSelect: function (dateText) {},
    });

    $('input[name="cashIn_date_EDIT"]').datepicker({
        dateFormat: "dd/mm/yy",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        onSelect: function (dateText) {},
    });

    // FUNSGI SUBMIT ADD CASHIN START::
    $("button#add-cashIn-submit-btn").click(function () {
        $("form#cashInFormADD").submit();
    });

    $("form#cashInFormADD").submit(function (e) {
        e.preventDefault(); // Mencegah pengiriman form secara default
        let fixedNominal = $('input[name="cashIn_nominal_ADD"]')
            .val()
            .replace(/\./g, "");
        let formData = {
            _token: $('meta[name="csrf-token"]').attr("content"),
            date: $('input[name="cashIn_date_ADD"]').val()
                ? moment(
                      $('input[name="cashIn_date_ADD"]').val(),
                      "DD/MM/YYYY"
                  ).format("YYYY-MM-DD")
                : null,
            cabang_id: $('select[name="cashIn_cabangId_ADD"]').val() || null,
            nominal: parseFloat(fixedNominal) || null,
            desc: $('textarea[name="cashIn_desc_ADD"]').val() || null,
        };

        $.ajax({
            url: cashin_store,
            type: "POST",
            dataType: "JSON",
            data: formData,
            beforeSend: function () {
                $.validator.addMethod(
                    "notzero",
                    function (value, element) {
                        let valFormatted = value.replace(/\./g, ""),
                            thisVal = isNaN(valFormatted)
                                ? 0
                                : parseFloat(value || 0);
                        return thisVal > 0;
                    },
                    "Bagian ini tidak bisa diisi nol(0)!"
                );

                $("form#cashInFormADD").validate({
                    rules: {
                        cashIn_date_ADD: {
                            required: true,
                        },
                        cashIn_cabangId_ADD: {
                            required: true,
                        },
                        cashIn_desc_ADD: {
                            required: true,
                        },
                        cashIn_nominal_ADD: {
                            required: true,
                            notzero: true,
                        },
                    },
                });
                jQuery.extend(jQuery.validator.messages, {
                    required: "Bagian ini wajib diisi!",
                });

                if (!$("form#cashInFormADD").valid()) {
                    $("div#alertMessageFormcashInADD").removeClass("d-none");
                    return false;
                } else {
                    $("div#alertMessageFormcashInADD").addClass("d-none");
                }
            },
            success: function (response) {
                if (response.success) {
                    dtbCashIn.ajax.reload();
                    Swal.fire({
                        title: response.msg,
                        text: "Kembali ke daftar cash in...",
                        icon: "success",
                        confirmButtonText: "Lanjutkan",
                        backdrop: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("div#cashInADDModal").modal("hide");
                        }
                    });
                } else {
                    console.error(response.msg);
                }
            },
            error: function (response) {
                console.error(response);
            },
        });
    });
    // FUNSGI SUBMIT ADD CASHIN END::

    // FUNSGI SUBMIT EDIT CASHIN START::
    $("button#edit-cashIn-submit-btn").click(function () {
        $("form#cashInFormEDIT").submit();
    });

    $("form#cashInFormEDIT").submit(function (e) {
        e.preventDefault(); // Mencegah pengiriman form secara default
        let fixedNominal = $('input[name="cashIn_nominal_EDIT"]')
            .val()
            .replace(/\./g, "");
        let formData = {
            _token: $('meta[name="csrf-token"]').attr("content"),
            cashIn_id: $('input[name="cashIn_id_EDIT"]').val() || null,
            date: $('input[name="cashIn_date_EDIT"]').val()
                ? moment(
                      $('input[name="cashIn_date_EDIT"]').val(),
                      "DD/MM/YYYY"
                  ).format("YYYY-MM-DD")
                : null,
            cabang_id: $('select[name="cashIn_cabangId_EDIT"]').val() || null,
            nominal: parseFloat(fixedNominal) || null,
            desc: $('textarea[name="cashIn_desc_EDIT"]').val() || null,
        };

        $.ajax({
            url: updateDataCashIn,
            type: "POST",
            dataType: "JSON",
            data: formData,
            beforeSend: function () {
                $.validator.addMethod(
                    "notzero",
                    function (value, element) {
                        let valFormatted = value.replace(/\./g, ""),
                            thisVal = isNaN(valFormatted)
                                ? 0
                                : parseFloat(value || 0);
                        return thisVal > 0;
                    },
                    "Bagian ini tidak bisa diisi nol(0)!"
                );

                $("form#cashInFormEDIT").validate({
                    rules: {
                        cashIn_date_EDIT: {
                            required: true,
                        },
                        cashIn_cabangId_EDIT: {
                            required: true,
                        },
                        cashIn_desc_EDIT: {
                            required: true,
                        },
                        cashIn_nominal_EDIT: {
                            required: true,
                            notzero: true,
                        },
                    },
                });
                jQuery.extend(jQuery.validator.messages, {
                    required: "Bagian ini wajib diisi!",
                });

                if (!$("form#cashInFormEDIT").valid()) {
                    $("div#alertMessageFormCashInEDIT").removeClass("d-none");
                    return false;
                } else {
                    $("div#alertMessageFormCashInEDIT").addClass("d-none");
                }
            },
            success: function (response) {
                if (response.success) {
                    dtbCashIn.ajax.reload();
                    Swal.fire({
                        title: response.msg,
                        text: "Kembali ke daftar cash in...",
                        icon: "success",
                        confirmButtonText: "Lanjutkan",
                        backdrop: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("div#cashInEDITModal").modal("hide");
                        }
                    });
                } else {
                    console.error(response.msg);
                }
            },
            error: function (response) {
                console.error(response);
            },
        });
    });
    // FUNSGI SUBMIT EDIT CASHIN END::

    // event button cash in DELETE
    $(document).on("click", "a.delete-cash-in-btn", function () {
        let cashInId = $(this).data("key");

        Swal.fire({
            title: "Hapus Cash In",
            text: "Apakah Anda yakin ingin menghapus cash in?",
            icon: "question",
            confirmButtonText: "Ya",
            showCancelButton: true,
            cancelButtonText: "Tidak",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteDataCashIn,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        id: cashInId,
                    },
                    success: function (response) {
                        if (response.success) {
                            dtbCashIn.ajax.reload();
                            Swal.fire({
                                title: response.msg,
                                text: "Kembali ke halaman cash in..",
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
});
