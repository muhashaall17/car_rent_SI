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
    let dtbCashOut = new DataTable("#cashOutTable", {
        processing: true,
        serverSide: false,
        responsive: {
            details: {
                type: "inline",
                renderer: function (api, rowIdx, columns) {
                    let data = $.map(columns, function (col, i) {
                        if (col.hidden) {
                            return `<tr data-dt-row="${col.rowIndex}" data-dt-column="${col.columnIndex}">
                                <td><strong>${col.title}:</strong></td> 
                                <td>${col.data}</td>
                            </tr>`;
                        } else {
                            return "";
                        }
                    }).join("");

                    return data ? $("<table/>").append(data) : false;
                },
            },
        },
        ajax: getDataTableCashOut,
        columns: [
            {
                data: "tgl_cout",
                title: "Tanggal",
                class: "text-center",
                responsivePriority: 1,
                render: function (data) {
                    return moment(data).format("DD/MM/YYYY");
                },
            },
            {
                data: "nama_cabang",
                title: "Cabang",
                responsivePriority: 4, // Akan disembunyikan lebih dulu
            },
            {
                data: "nominal",
                title: "Nominal",
                class: "text-end",
                responsivePriority: 2,
                render: function (data) {
                    return Rupiah(data);
                },
            },
            {
                data: "deskripsi",
                title: "Deskripsi",
                responsivePriority: 5,
            },
            {
                data: "id",
                title: "Action",
                class: "text-center",
                responsivePriority: 6,
                orderable: false,
                render: function (data) {
                    return `
                        <a style="font-size: 14px" href="#" class="btn btn-sm btn-primary detail-cash-out-btn" data-key="${data}">
                            <i class="fa fa-info"></i>
                        </a>
                        <a style="font-size: 14px" href="#" class="btn btn-sm btn-primary edit-cash-out-btn" data-key="${data}">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-danger delete-cash-out-btn" data-key="${data}">
                            <i class="fa fa-trash"></i>
                        </a>
                    `;
                },
            },
        ],
    });

    // setting modal cash out ADD
    $("div#cashOutADDModal")
        .modal({
            show: false,
            keyboard: false,
            backdrop: "static",
        })
        .on("shown.bs.modal", function (e) {
            $('input[name="cashOut_date_ADD"]').val(
                moment().format("DD/MM/YYYY")
            );
        })
        .on("hidden.bs.modal", function (e) {
            $("form#cashOutFormADD").validate().resetForm();
            $('input[name="cashOut_nominal_ADD"]').val(null);
            $('textarea[name="cashOut_desc_ADD"]').val(null);
            $("div#alertMessageFormCashOutADD").addClass("d-none");
        });

    // setting modal cash out EDIT
    $("div#cashOutEDITModal")
        .modal({
            show: false,
            keyboard: false,
            backdrop: "static",
        })
        .on("hidden.bs.modal", function (e) {
            $("form#cashOutFormEDIT").validate().resetForm();
            $("div#alertMessageFormCashOutEDIT").addClass("d-none");
        });

    // event button cash out ADD
    $(document).on("click", "a.add-cash-out-btn", function () {
        $("div#cashOutADDModal").modal("show");
    });

    // event button cash out EDIT
    $(document).on("click", "a.edit-cash-out-btn", function () {
        let cashOutId = $(this).data("key");
        $('input[name="cashOut_id_EDIT"]').val(cashOutId);

        $.ajax({
            url: getDataCashOut,
            method: "GET",
            data: {
                id: cashOutId,
            },
            success: function (response) {
                if (response.data) {
                    // console.log(response);
                    $('input[name="cashOut_date_EDIT"]').val(
                        moment(response.data.tgl_cout).format("DD/MM/YYYY")
                    );
                    $('select[name="cashOut_cabangId_EDIT"]').val(
                        response.data.cabang_id
                    );
                    $('input[name="cashOut_nominal_EDIT"]').val(
                        Rupiah(response.data.nominal)
                    );
                    $('textarea[name="cashOut_desc_EDIT"]').val(
                        response.data.deskripsi
                    );
                }

                // Menampilkan modal
                $("div#cashOutEDITModal").modal("show");
            },
            error: function (err) {
                console.error(err);
                alert("Terjadi kesalahan saat mengambil data.");
            },
        });
    });

    $('input[name="cashOut_date_ADD"]').datepicker({
        dateFormat: "dd/mm/yy",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        onSelect: function (dateText) {},
    });

    $('input[name="cashOut_date_EDIT"]').datepicker({
        dateFormat: "dd/mm/yy",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        onSelect: function (dateText) {},
    });

    // FUNSGI SUBMIT ADD CASHOUT START::
    $("button#add-cashOut-submit-btn").click(function () {
        $("form#cashOutFormADD").submit();
    });

    $("form#cashOutFormADD").submit(function (e) {
        e.preventDefault(); // Mencegah pengiriman form secara default
        let fixedNominal = $('input[name="cashOut_nominal_ADD"]')
            .val()
            .replace(/\./g, "");
        let formData = {
            _token: $('meta[name="csrf-token"]').attr("content"),
            date: $('input[name="cashOut_date_ADD"]').val()
                ? moment(
                      $('input[name="cashOut_date_ADD"]').val(),
                      "DD/MM/YYYY"
                  ).format("YYYY-MM-DD")
                : null,
            cabang_id: $('select[name="cashOut_cabangId_ADD"]').val() || null,
            nominal: parseFloat(fixedNominal) || null,
            desc: $('textarea[name="cashOut_desc_ADD"]').val() || null,
        };

        $.ajax({
            url: cashout_store,
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

                $("form#cashOutFormADD").validate({
                    rules: {
                        cashOut_date_ADD: {
                            required: true,
                        },
                        cashOut_cabangId_ADD: {
                            required: true,
                        },
                        cashOut_desc_ADD: {
                            required: true,
                        },
                        cashOut_nominal_ADD: {
                            required: true,
                            notzero: true,
                        },
                    },
                });
                jQuery.extend(jQuery.validator.messages, {
                    required: "Bagian ini wajib diisi!",
                });

                if (!$("form#cashOutFormADD").valid()) {
                    $("div#alertMessageFormCashOutADD").removeClass("d-none");
                    return false;
                } else {
                    $("div#alertMessageFormCashOutADD").addClass("d-none");
                }
            },
            success: function (response) {
                if (response.success) {
                    dtbCashOut.ajax.reload();
                    Swal.fire({
                        title: response.msg,
                        text: "Kembali ke daftar cash out...",
                        icon: "success",
                        confirmButtonText: "Lanjutkan",
                        backdrop: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("div#cashOutADDModal").modal("hide");
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
    // FUNSGI SUBMIT ADD CASHOUT END::

    // FUNSGI SUBMIT EDIT CASHOUT START::
    $("button#edit-cashOut-submit-btn").click(function () {
        $("form#cashOutFormEDIT").submit();
    });

    $("form#cashOutFormEDIT").submit(function (e) {
        e.preventDefault(); // Mencegah pengiriman form secara default
        let fixedNominal = $('input[name="cashOut_nominal_EDIT"]')
            .val()
            .replace(/\./g, "");
        let formData = {
            _token: $('meta[name="csrf-token"]').attr("content"),
            cashOut_id: $('input[name="cashOut_id_EDIT"]').val() || null,
            date: $('input[name="cashOut_date_EDIT"]').val()
                ? moment(
                      $('input[name="cashOut_date_EDIT"]').val(),
                      "DD/MM/YYYY"
                  ).format("YYYY-MM-DD")
                : null,
            cabang_id: $('select[name="cashOut_cabangId_EDIT"]').val() || null,
            nominal: parseFloat(fixedNominal) || null,
            desc: $('textarea[name="cashOut_desc_EDIT"]').val() || null,
        };

        $.ajax({
            url: updateDataCashOut,
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

                $("form#cashOutFormEDIT").validate({
                    rules: {
                        cashOut_date_EDIT: {
                            required: true,
                        },
                        cashOut_cabangId_EDIT: {
                            required: true,
                        },
                        cashOut_desc_EDIT: {
                            required: true,
                        },
                        cashOut_nominal_EDIT: {
                            required: true,
                            notzero: true,
                        },
                    },
                });
                jQuery.extend(jQuery.validator.messages, {
                    required: "Bagian ini wajib diisi!",
                });

                if (!$("form#cashOutFormEDIT").valid()) {
                    $("div#alertMessageFormCashOutEDIT").removeClass("d-none");
                    return false;
                } else {
                    $("div#alertMessageFormCashOutEDIT").addClass("d-none");
                }
            },
            success: function (response) {
                if (response.success) {
                    dtbCashOut.ajax.reload();
                    Swal.fire({
                        title: response.msg,
                        text: "Kembali ke daftar cash out...",
                        icon: "success",
                        confirmButtonText: "Lanjutkan",
                        backdrop: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("div#cashOutEDITModal").modal("hide");
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
    // FUNSGI SUBMIT EDIT CASHOUT END::

    // event button cash out DELETE
    $(document).on("click", "a.delete-cash-out-btn", function () {
        let cashOutId = $(this).data("key");

        Swal.fire({
            title: "Hapus Cash Out",
            text: "Apakah Anda yakin ingin menghapus cash out?",
            icon: "question",
            confirmButtonText: "Ya",
            showCancelButton: true,
            cancelButtonText: "Tidak",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteDataCashOut,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        id: cashOutId,
                    },
                    success: function (response) {
                        if (response.success) {
                            dtbCashOut.ajax.reload();
                            Swal.fire({
                                title: response.msg,
                                text: "Kembali ke halaman cash out..",
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
