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
    let dtbRental = new DataTable("#rentalTable", {
        processing: true,
        serverSide: false,
        ajax: getDataTableRental,
        columns: [
            {
                data: "no_invoice",
                class: "text-start",
                render: function (data, type, row) {
                    return `
                    <i class="fa fa-plus-square text-primary toggle-child" style="cursor: pointer; margin-right: 6px;"></i>
                    ${data}
                `;
                },
            },
            {
                data: "tanggal_invoice",
                class: "text-center",
                render: function (data) {
                    return moment(data).format("DD/MM/YYYY");
                },
            },
            {
                data: "cabang",
            },
            {
                data: "nama_pelanggan",
            },
            {
                data: "status_pembayaran",
                class: "text-center",
                render: function (data) {
                    let bg = "",
                        text = "";
                    if (data == "pending") {
                        text = "Menunggu Pembayaran";
                        bg = "warning";
                    } else if (data == "half") {
                        text = "Dibayar Sebagian";
                        bg = "info";
                    } else if (data == "done") {
                        text = "Lunas";
                        bg = "success";
                    } else {
                        text = "Error";
                        bg = "danger";
                    }
                    return `<a class="btn btn-sm btn-${bg}" style="font-size: 16px; width: 100%">${text}</a>`;
                },
            },
            {
                data: "status_rental",
                class: "text-center",
                render: function (data) {
                    let bg = "",
                        text = "";
                    if (data == "waiting") {
                        text = "Menunggu Diambil";
                        bg = "warning";
                    } else if (data == "ongoing") {
                        text = "Sedang Digunakan";
                        bg = "info";
                    } else if (data == "done") {
                        text = "Selesai";
                        bg = "success";
                    } else if (data == "due") {
                        text = "Telat Dikembalikan";
                        bg = "danger";
                    } else {
                        text = "Error";
                        bg = "danger";
                    }
                    return `<a class="btn btn-sm btn-${bg}" style="font-size: 16px; width: 100%">${text}</a>`;
                },
            },
            {
                data: "id",
                visible: false,
                render: function (data, type, row) {
                    return `
                    <a class="btn btn-sm btn-primary detail-invoice-btn" data-key="${data}">
                        <i class="fa fa-info"></i>
                    </a>
                    <a class="btn btn-sm btn-success list-payment-btn" data-key="${data}" data-invoiceno="${row["no_invoice"]}" data-idcabang="${row["id_cabang"]}">$</a>
                    <a class="btn btn-sm btn-danger delete-invoice-btn" data-key="${data}">
                        <i class="fa fa-trash"></i>
                    </a>
                `;
                },
            },
        ],
    });

    $("#rentalTable tbody").on("click", ".toggle-child", function () {
        let tr = $(this).closest("tr");
        let row = dtbRental.row(tr);
        let icon = $(this);

        if (row.child.isShown()) {
            row.child.hide();
            icon.removeClass("fa-minus-square text-danger").addClass(
                "fa-plus-square text-primary"
            );
        } else {
            row.child(formatChildRow(row.data())).show();
            icon.removeClass("fa-plus-square text-primary").addClass(
                "fa-minus-square text-danger"
            );
        }
    });

    function formatChildRow(data) {
        return `
        <div style="padding: 10px;">
            <a class="btn btn-sm btn-primary detail-invoice-btn" data-key="${data.id}">
                <i class="fa fa-info"></i>
            </a>
            <a class="btn btn-sm btn-success list-payment-btn" data-key="${data.id}" data-invoiceno="${data.no_invoice}" data-idcabang="${data.id_cabang}">$</a>
            <a class="btn btn-sm btn-danger delete-invoice-btn" data-key="${data.id}">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    `;
    }

    // DATATABLE PEMBAYARAN
    let dtbPayment = new DataTable("#paymentTable", {
        processing: true,
        serverSide: false,
        ajax: {
            url: getDataTablePayment,
            type: "GET",
            data: function (d) {
                d.idRental = $('input[name="invId_payment"]').val() || null;
            },
        },
        columns: [
            {
                data: "tgl_bayar",
                class: "text-center",
                render: function (data, type, row) {
                    return moment(data).format("DD/MM/YYYY");
                },
            },
            {
                data: "metode_pembayaran",
            },
            {
                data: "nominal",
                class: "text-end",
            },
            {
                data: "id",
                class: "text-center",
                render: function (data, type, row) {
                    return `<a style="font-size: 16px" href="#" class="btn btn-sm btn-primary edit-payment-btn" data-key="${data}">
                    <i class="fa fa-pencil"></i>
                    </a>
                    <a style="font-size: 16px" href="#" class="btn btn-sm btn-danger delete-payment-btn" data-key="${data}">
                    <i class="fa fa-trash"></i>
                    </a>`;
                },
            },
        ],
    });

    // setting modal payment list
    $("div#paymentModal").modal({
        show: false,
        keyboard: false,
        backdrop: "static",
    });

    // setting modal payment ADD
    $("div#paymentADDModal")
        .modal({
            show: false,
            keyboard: false,
            backdrop: "static",
        })
        .on("shown.bs.modal", function (e) {
            $('input[name="payment_date_ADD"]').val(
                moment().format("DD/MM/YYYY")
            );
            $('input[name="payment_nominal_ADD"]').val(null);
            $("div#paymentModal").modal("hide");
        })
        .on("hidden.bs.modal", function (e) {
            $("form#paymentFormADD").validate().resetForm();
            $("div#alertMessageFormPaymentADD").addClass("d-none");
            $("div#paymentModal").modal("show");
        });

    // setting modal payment EDIT
    $("div#paymentEDITModal")
        .modal({
            show: false,
            keyboard: false,
            backdrop: "static",
        })
        .on("shown.bs.modal", function (e) {
            $("div#paymentModal").modal("hide");
        })
        .on("hidden.bs.modal", function (e) {
            $("form#paymentFormEDIT").validate().resetForm();
            $("div#alertMessageFormPaymentEDIT").addClass("d-none");
            $("div#paymentModal").modal("show");
        });

    // setting modal detail
    $("div#detailModal")
        .modal({
            show: false,
            keyboard: false,
        })
        .on("shown.bs.modal", function (e) {
            // fungsi saat muncul
        })
        .on("hidden.bs.modal", function (e) {
            // fungsi saat tutup
        });

    // event button payment
    $(document).on("click", "a.list-payment-btn", function () {
        let invoiceId = $(this).data("key"),
            cabangId = $(this).data("idcabang"),
            invoiceNo = $(this).data("invoiceno");
        $('input[name="invId_payment"]').val(invoiceId);
        $('input[name="id_cabang"]').val(cabangId);
        $("span#paymentModalTitle").text(
            "Daftar Pembayaran Invoice - " + invoiceNo
        );
        dtbPayment.ajax.reload(function () {}, true);
        $("div#paymentModal").modal("show");
    });

    // event button payment ADD
    $(document).on("click", "button.add-payment-btn", function () {
        let invoiceId = $('input[name="invId_payment"]').val(),
            cabangId = $('input[name="id_cabang"]').val();
        $('input[name="invId_payment_ADD"]').val(invoiceId);
        $('input[name="id_cabang_ADD"]').val(cabangId);
        // $('span#paymentModalTitle').text("Daftar Pembayaran Invoice - " + invoiceNo);
        // dtbPayment.ajax.reload(function() {}, true);
        $("div#paymentModal").modal("hide");
        $("div#paymentADDModal").modal("show");
    });

    // event button payment EDIT
    $(document).on("click", "a.edit-payment-btn", function () {
        let paymentId = $(this).data("key");
        $('input[name="payment_id_EDIT"]').val(paymentId);

        $.ajax({
            url: getDataPayment,
            method: "GET",
            data: {
                id: paymentId,
            },
            success: function (response) {
                if (response.data) {
                    $('input[name="payment_date_EDIT"]').val(
                        moment(response.data.tgl_bayar).format("DD/MM/YYYY")
                    );
                    $('select[name="payment_method_EDIT"]').val(
                        response.data.metode_pembayaran
                    );
                    $('input[name="payment_nominal_EDIT"]').val(
                        Rupiah(response.data.nominal)
                    );
                    $('input[name="payment_proof_EDIT"]').val(
                        response.data.bukti_pembayaran
                    );
                }

                // Menampilkan modal
                $("div#paymentModal").modal("hide");
                $("div#paymentEDITModal").modal("show");
            },
            error: function (err) {
                console.error(err);
                alert("Terjadi kesalahan saat mengambil data.");
            },
        });
    });

    // event button payment DELETE
    $(document).on("click", "a.delete-payment-btn", function () {
        let paymentId = $(this).data("key");

        Swal.fire({
            title: "Hapus Pembayaran",
            text: "Apakah Anda yakin ingin menghapus pembayaran?",
            icon: "question",
            confirmButtonText: "Ya",
            showCancelButton: true,
            cancelButtonText: "Tidak",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteDataPayment,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        id: paymentId,
                    },
                    success: function (response) {
                        if (response.success) {
                            dtbPayment.ajax.reload();
                            dtbRental.ajax.reload();
                            Swal.fire({
                                title: response.msg,
                                text: "Kembali ke halaman pembayaran..",
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

    // event button detail
    $(document).on("click", "a.detail-invoice-btn", function () {
        let invoiceId = $(this).data("key");
        // $('input[name="invId_payment"]').val(invoiceId);
        // dtbPayment.ajax.reload(function() {}, true);

        $.ajax({
            url: getDetailRental,
            method: "GET",
            data: {
                id: invoiceId,
            },
            success: function (response) {
                if (response) {
                    $("span#detailInvoiceNo").text(response.invoice.no_invoice);
                    $("span#detailInvoiceDate").text(
                        moment(response.invoice.tanggal_invoice).format(
                            "DD/MM/YYYY"
                        )
                    );
                    $("span#detailInvoiceBranch").text(
                        response.invoice.nama_cabang
                    );
                    $("span#detailCustomerName").text(
                        response.invoice.nama_pelanggan
                    );
                    $("span#detailCustomerPhone").text(
                        response.invoice.nomor_hp
                    );
                    $("span#detailCustomerEmail").text(response.invoice.email);
                    $("span#detailCustomerAddress").text(
                        response.invoice.alamat
                    );
                }

                let details = response.details,
                    detailTable = "";

                details.forEach(function (item) {
                    detailTable += `
                    <tr>
                        <td>${item.deskripsi}</td>
                        <td class="text-center">${moment(
                            item.tanggal_sewa
                        ).format("DD/MM/YYYY")}</td>
                        <td class="text-center">${moment(
                            item.tanggal_kembali
                        ).format("DD/MM/YYYY")}</td>
                        <td class="text-center">${item.durasi_sewa} hari</td>
                        <td class="text-end">${Rupiah(item.harga)}</td>
                        <td class="text-end">${Rupiah(item.jumlah)}</td>
                    </tr>
                    `;
                });

                detailTable += `
                <tr class="text-end">
                    <th colspan="4">Grand Total : </th>
                    <th colspan="2">${Rupiah(response.invoice.grand_total)}</th>
                </tr>
                <tr class="text-end">
                    <th colspan="4">Terbayar : </th>
                    <th colspan="2">${Rupiah(response.invoice.terbayar)}</th>
                </tr>
                <tr class="text-end">
                    <th colspan="4">Sisa Tagihan : </th>
                    <th colspan="2">${Rupiah(response.invoice.tagihan)}</th>
                </tr>
                `;

                let tanggalInv = moment(
                        response.invoice.tanggal_invoice,
                        "YYYY-MM-DD"
                    ),
                    tanggalToday = moment(),
                    diffPyDate = tanggalToday.diff(tanggalInv, "days"); //menghitung jumlah hari dari invoice dibuat ke hari ini

                if (response.invoice.terbayar >= response.invoice.grand_total) {
                    detailTable += `
                    <tr class="text-center">
                        <th colspan="6" class="text-light bg-success">Lunas</th>
                    </tr>
                    `;
                } else if (
                    response.invoice.terbayar < response.invoice.grand_total &&
                    response.invoice.terbayar > 0
                ) {
                    detailTable += `
                    <tr class="text-center">
                        <th colspan="6" class="text-light bg-info">Terbayar Sebagian</th>
                    </tr>
                    `;
                } else if (response.invoice.terbayar <= 0 && diffPyDate > 0) {
                    detailTable += `
                    <tr class="text-center">
                        <th colspan="6" class="text-light bg-danger">Jatuh Tempo</th>
                    </tr>
                    `;
                } else if (response.invoice.terbayar <= 0) {
                    detailTable += `
                    <tr class="text-center">
                        <th colspan="6" class="text-light bg-warning">Menunggu Pembayaran</th>
                    </tr>
                    `;
                } else {
                    // ngaco
                }

                $("#detailItemInvoice").html(detailTable);

                // Menampilkan modal
                $("div#detailModal").modal("show");
            },
            error: function (err) {
                console.error(err);
                alert("Terjadi kesalahan saat mengambil data.");
            },
        });

        $("div#detailModal").modal("show");
    });

    // event button invoice DELETE
    $(document).on("click", "a.delete-invoice-btn", function () {
        let invoiceId = $(this).data("key");

        Swal.fire({
            title: "Hapus Invoice",
            text: "Apakah Anda yakin ingin menghapus invoice?",
            icon: "question",
            confirmButtonText: "Ya",
            showCancelButton: true,
            cancelButtonText: "Tidak",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteDataRental,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        id: invoiceId,
                    },
                    success: function (response) {
                        if (response.success) {
                            // console.log(response.data)
                            dtbPayment.ajax.reload();
                            dtbRental.ajax.reload();
                            Swal.fire({
                                title: response.msg,
                                text: "Kembali ke daftar invoice..",
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

    $('input[name="payment_date_ADD"]').datepicker({
        dateFormat: "dd/mm/yy",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        onSelect: function (dateText) {},
    });

    $('input[name="payment_date_EDIT"]').datepicker({
        dateFormat: "dd/mm/yy",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        onSelect: function (dateText) {},
    });

    // FUNSGI SUBMIT ADD PAYMENT START::
    $("button#add-payment-submit-btn").click(function () {
        $("form#paymentFormADD").submit();
    });

    $("form#paymentFormADD").submit(function (e) {
        e.preventDefault(); // Mencegah pengiriman form secara default
        let fixedNominal = $('input[name="payment_nominal_ADD"]')
            .val()
            .replace(/\./g, "");
        let formData = {
            _token: $('meta[name="csrf-token"]').attr("content"),
            rental_id: $('input[name="invId_payment_ADD"]').val() || null,
            cabang_id: $('input[name="id_cabang_ADD"]').val() || null,
            date: $('input[name="payment_date_ADD"]').val()
                ? moment(
                      $('input[name="payment_date_ADD"]').val(),
                      "DD/MM/YYYY"
                  ).format("YYYY-MM-DD")
                : null,
            method: $('select[name="payment_method_ADD"]').val() || null,
            nominal: parseFloat(fixedNominal) || null,
            proof: $('input[name="payment_proof_ADD"]').val() || null,
        };

        $.ajax({
            url: pembayaran_store,
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

                $("form#paymentFormADD").validate({
                    rules: {
                        payment_date_ADD: {
                            required: true,
                        },
                        payment_method_ADD: {
                            required: true,
                        },
                        payment_proof_ADD: {
                            required: true,
                        },
                        payment_nominal_ADD: {
                            required: true,
                            notzero: true,
                        },
                    },
                });
                jQuery.extend(jQuery.validator.messages, {
                    required: "Bagian ini wajib diisi!",
                });

                if (!$("form#paymentFormADD").valid()) {
                    $("div#alertMessageFormPaymentADD").removeClass("d-none");
                    return false;
                } else {
                    $("div#alertMessageFormPaymentADD").addClass("d-none");
                }
            },
            success: function (response) {
                if (response.success) {
                    dtbPayment.ajax.reload();
                    dtbRental.ajax.reload();
                    Swal.fire({
                        title: response.msg,
                        text: "Kembali ke daftar pembayaran...",
                        icon: "success",
                        confirmButtonText: "Lanjutkan",
                        backdrop: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("div#paymentADDModal").modal("hide");
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
    // FUNSGI SUBMIT ADD PAYMENT END::

    // FUNSGI SUBMIT EDIT PAYMENT START::
    $("button#edit-payment-submit-btn").click(function () {
        $("form#paymentFormEDIT").submit();
    });

    $("form#paymentFormEDIT").submit(function (e) {
        e.preventDefault(); // Mencegah pengiriman form secara default
        let fixedNominal = $('input[name="payment_nominal_EDIT"]')
            .val()
            .replace(/\./g, "");
        let formData = {
            _token: $('meta[name="csrf-token"]').attr("content"),
            payment_id: $('input[name="payment_id_EDIT"]').val() || null,
            date: $('input[name="payment_date_EDIT"]').val()
                ? moment(
                      $('input[name="payment_date_EDIT"]').val(),
                      "DD/MM/YYYY"
                  ).format("YYYY-MM-DD")
                : null,
            method: $('select[name="payment_method_EDIT"]').val() || null,
            nominal: parseFloat(fixedNominal) || null,
            proof: $('input[name="payment_proof_EDIT"]').val() || null,
        };

        $.ajax({
            url: updateDataPayment,
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

                $("form#paymentFormEDIT").validate({
                    rules: {
                        payment_date_EDIT: {
                            required: true,
                        },
                        payment_method_EDIT: {
                            required: true,
                        },
                        payment_proof_EDIT: {
                            required: true,
                        },
                        payment_nominal_EDIT: {
                            required: true,
                            notzero: true,
                        },
                    },
                });
                jQuery.extend(jQuery.validator.messages, {
                    required: "Bagian ini wajib diisi!",
                });

                if (!$("form#paymentFormEDIT").valid()) {
                    $("div#alertMessageFormPaymentEDIT").removeClass("d-none");
                    return false;
                } else {
                    $("div#alertMessageFormPaymentEDIT").addClass("d-none");
                }
            },
            success: function (response) {
                if (response.success) {
                    dtbPayment.ajax.reload();
                    dtbRental.ajax.reload();
                    Swal.fire({
                        title: response.msg,
                        text: "Kembali ke daftar pembayaran...",
                        icon: "success",
                        confirmButtonText: "Lanjutkan",
                        backdrop: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("div#paymentEDITModal").modal("hide");
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
    // FUNSGI SUBMIT EDIT PAYMENT END::
});
