document.addEventListener("DOMContentLoaded", function () {
    renderInvoiceDetails(); // Render data saat halaman dimuat
});

function Rupiah(angka) {
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for (var i = 0; i < angkarev.length; i++)
        if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
    return rupiah.split('', rupiah.length - 1).reverse().join('');
}

$('input[name="tgl_invoice"]').val(moment().format('DD/MM/YYYY'));

function generateInvoiceNumberF() {
    //GENERATE INVOICE NUMBER
    let tgl_invoice = moment($('input[name="tgl_invoice"]').val(), 'DD/MM/YYYY').format('YYYY-MM-DD');

    // Kirim AJAX request ke server
    $.ajax({
        url: generateInvoiceNumber,
        type: 'POST',
        data: {
            date: tgl_invoice,
            _token: $('meta[name="csrf-token"]').attr('content') // Tambahkan CSRF token untuk keamanan
        },
        success: function (response) {
            if (response.status === 'success') {
                // Tampilkan nomor invoice di input field
                $('input[name="no_invoice"]').val(response.no_invoice);
            } else {
                alert('Gagal membuat nomor invoice');
            }
        },
        error: function (xhr) {
            alert('Terjadi kesalahan!');
        }
    });
}
generateInvoiceNumberF();

var db = new Dexie("itemInvoiceDexie");
db.version(1).stores({
    details: `++id, id_drv_vch, type, deskripsi, harga, tgl_sewa, tgl_kembali, subtotal, status_ketersediaan`
});
// Pastikan Dexie sudah terbuka dengan benar
db.open().catch(function (error) {
    console.error("Error saat membuka database:", error);
});

// SELECT2 DRV/VCH
$(document).ready(function () {
    $('select[name="vehicleSelect2"]').select2({
        width: '100%',
        placeholder: "Cari Nama Kendaraan...",
        allowClear: true,
        ajax: {
            url: getVehicles, // Rute ke API kendaraan
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    term: params.term, // Kirim input pencarian ke server
                    cabang_id: $('#cabang_id').val()
                };
            },
            processResults: function (data) {
                return {
                    results: data.results // Format hasil dari server
                };
            },
            cache: true
        }
    });

    // Event saat kendaraan dipilih
    $('select[name="vehicleSelect2"]').on('select2:select', function (e) {
        let data = e.params.data;
        $('select[name="vehicleSelect2"]').val(null).trigger('change');
        addItemInvoice(data)
    });

    $('select[name="driverSelect2"]').select2({
        width: '100%',
        placeholder: "Cari Nama Driver...",
        allowClear: true,
        ajax: {
            url: getDrivers, // Rute ke API kendaraan
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    term: params.term, // Kirim input pencarian ke server
                    cabang_id: $('#cabang_id').val()
                };
            },
            processResults: function (data) {
                return {
                    results: data.results // Format hasil dari server
                };
            },
            cache: true
        }
    });

    // Event saat kendaraan dipilih
    $('select[name="driverSelect2"]').on('select2:select', function (e) {
        let data = e.params.data;
        $('select[name="driverSelect2"]').val(null).trigger('change');
        addItemInvoice(data)
    });

    $('input[name="tgl_invoice"]').datepicker({
        dateFormat: "dd/mm/yy",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        onSelect: function (dateText) {
            generateInvoiceNumberF();
        }
    });
});

function addItemInvoice(data) {
    // Tanggal hari ini dalam format dd/mm/yyyy
    let today = moment().format('YYYY-MM-DD'),
        todayPlus1 = moment().add(1, 'days').format('YYYY-MM-DD'),
        durasi = moment().add(1, 'days').diff(moment(), 'days'),
        subTotal = data.harga * durasi;
    // Tambahkan data ke IndexedDB
    db.details.add({
        id_drv_vch: data.id,
        type: data.type,
        deskripsi: data.text,
        harga: data.harga,
        tgl_sewa: today,
        tgl_kembali: todayPlus1,
        subtotal: subTotal,
        status_ketersediaan: false
    }).then(() => {
        renderInvoiceDetails();
    }).catch(function (error) {
        console.error("Error saat menambah data ke IndexedDB:", error);
    });
}

function deleteDetailInv(id) {
    let idIndex = id;
    // Pastikan bahwa data dengan ID yang ingin dihapus ada dalam IndexedDB
    db.details.delete(idIndex).then(() => {
        renderInvoiceDetails(); // Memuat ulang data setelah penghapusan
    }).catch(function (error) {
        console.error("Error saat menghapus data dari IndexedDB:", error);
    });
}

function renderInvoiceDetails() {
    // Ambil semua data dari IndexedDB
    db.details.toArray().then(function (items) {
        // Kosongkan elemen view (supaya tidak duplikat data saat dirender ulang)
        let tbody = document.getElementById("detailInvoiceTr");
        tbody.innerHTML = "";

        let grandTotal = 0;

        if (items.length > 0) {
            // Loop setiap item untuk ditambahkan ke tabel
            items.forEach(item => {
                grandTotal += parseFloat(item.subtotal);

                let row = `
                    <tr data-id="${item.id}" id="itemData${item.id}">
                        <td>${item.deskripsi + " (" + item.type + ")"}</td>
                        <td class="text-end">${Rupiah(item.harga)}</td>
                        <td class="text-center">
                            <input type="text" value="${moment(item.tgl_sewa, 'YYYY-MM-DD').format('DD/MM/YYYY')}" 
                                name="start_date${item.id}" id="startDate${item.id}" class="datepickerStart" readonly>
                        </td>
                        <td class="text-center">
                            <input type="text" value="${moment(item.tgl_kembali, 'YYYY-MM-DD').format('DD/MM/YYYY')}" 
                                name="end_date${item.id}" id="endDate${item.id}" class="datepickerEnd" readonly>
                        </td>
                        <td class="text-end">${Rupiah(item.subtotal)}</td>
                        <td class="availability-status text-center" id="status${item.id}">Memeriksa...</td>
                        <td class="text-center">
                            <a type="button" class="btn btn-danger deleteItem" href="javascript:;">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>`;
                tbody.insertAdjacentHTML("beforeend", row);

                // Cek ketersediaan menggunakan data dari IndexedDB
                cekKetersediaanVchDrv(item.type, item.id_drv_vch, item.tgl_sewa, item.tgl_kembali).then(status => {
                    let statusElement = document.getElementById(`status${item.id}`);
                    let statusElementTr = document.getElementById(`itemData${item.id}`);
                    if (status === 'tersedia') {
                        statusElement.textContent = "Tersedia";
                        statusElement.style.color = "green";

                        db.details.update(item.id, {
                            status_ketersediaan: true
                        });

                    } else {
                        statusElement.textContent = "Tidak Tersedia";
                        statusElement.style.color = "red";
                        statusElementTr.classList.add("table-warning");

                        db.details.update(item.id, {
                            status_ketersediaan: false
                        });
                    }
                }).catch(err => {
                    console.error(`Gagal memeriksa ketersediaan untuk ID: ${item.id}`, err);
                    let statusElement = document.getElementById(`status${item.id}`);
                    statusElement.textContent = "Error";
                    statusElement.style.color = "orange";

                    db.details.update(item.id, {
                        status_ketersediaan: false
                    });
                });
            });
        } else {
            // Jika tidak ada item, tampilkan pesan
            let row = `
                <tr>
                    <td colspan="7" class="text-center">Masukkan Pesanan Rental Anda...</td>
                </tr>`;
            tbody.insertAdjacentHTML("beforeend", row);
        }

        // Tambahkan baris Grand Total
        let grandTotalRow = `
            <tr id="grandTotalRow">
                <td colspan="4" style="text-align: right; font-weight: bold;">Grand Total :</td>
                <td id="grandTotalValue" style="font-weight: bold;" colspan="3">${Rupiah(grandTotal)}</td>
            </tr>`;
        tbody.insertAdjacentHTML("beforeend", grandTotalRow);
        $('input#grandTotalInput').val(grandTotal);

        // Jika tidak ada item, tetap tampilkan Grand Total = 0
        if (items.length === 0) {
            document.getElementById('grandTotalValue').textContent = "0";
        }

        // Setup datepickers
        $('input.datepickerStart').datepicker({
            dateFormat: "dd/mm/yy",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            onSelect: function (dateText) {
                let dateTextFormatted = moment(dateText, 'DD/MM/YYYY').format('YYYY-MM-DD');
                let inputId = this.id;
                let row = this.closest('tr');
                let id = parseInt(row.getAttribute('data-id'));
                let field = 'tgl_sewa';

                // Validasi tanggal sewa
                let tgl_invoice = moment($('input[name="tgl_invoice"]').val(), 'DD/MM/YYYY').format('YYYY-MM-DD');
                if (moment(dateTextFormatted).isBefore(tgl_invoice)) {
                    Swal.fire({
                        title: 'Tanggal tidak valid',
                        text: 'Tanggal sewa tidak dapat diisi sebelum tanggal invoice',
                        icon: 'warning'
                    });
                    dateTextFormatted = tgl_invoice;
                    this.value = moment(tgl_invoice, 'YYYY-MM-DD').format('DD/MM/YYYY');
                }

                let startDate = dateTextFormatted;
                let endDate = moment(row.querySelector(`#endDate${id}`).value, 'DD/MM/YYYY').format('YYYY-MM-DD');

                if (moment(startDate).isAfter(endDate)) {
                    let newEndDate = moment(startDate).add(1, 'days').format('YYYY-MM-DD');
                    row.querySelector(`#endDate${id}`).value = moment(newEndDate, 'YYYY-MM-DD').format('DD/MM/YYYY');
                    endDate = newEndDate;
                }

                let harga = items.find(item => item.id === id).harga;
                let duration = moment(endDate).diff(moment(startDate), 'days');
                let subtotal = duration > 0 ? duration * harga : 0;

                db.details.update(id, {
                    tgl_sewa: startDate,
                    tgl_kembali: endDate,
                    subtotal: subtotal
                }).then(() => renderInvoiceDetails());
            }
        });

        $('input.datepickerEnd').datepicker({
            dateFormat: "dd/mm/yy",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            onSelect: function (dateText) {
                let dateTextFormatted = moment(dateText, 'DD/MM/YYYY').format('YYYY-MM-DD');
                let row = this.closest('tr');
                let id = parseInt(row.getAttribute('data-id'));
                let startDate = moment(row.querySelector(`#startDate${id}`).value, 'DD/MM/YYYY').format('YYYY-MM-DD');

                if (moment(dateTextFormatted).isBefore(startDate)) {
                    Swal.fire({
                        title: 'Tanggal tidak valid',
                        text: 'Tanggal kembali tidak dapat diisi sebelum tanggal sewa',
                        icon: 'warning'
                    });
                    dateTextFormatted = moment(startDate).add(1, 'days').format('YYYY-MM-DD');
                    this.value = moment(dateTextFormatted, 'YYYY-MM-DD').format('DD/MM/YYYY');
                }

                let harga = items.find(item => item.id === id).harga;
                let duration = moment(dateTextFormatted).diff(moment(startDate), 'days');
                let subtotal = duration > 0 ? duration * harga : 0;

                db.details.update(id, {
                    tgl_kembali: dateTextFormatted,
                    subtotal: subtotal
                }).then(() => renderInvoiceDetails());
            }
        });

        // Event listener untuk tombol hapus
        document.querySelectorAll('.deleteItem').forEach(button => {
            button.addEventListener('click', function () {
                let row = button.closest('tr');
                let id = parseInt(row.getAttribute('data-id'));
                deleteDetailInv(id);
                row.remove();
            });
        });
    }).catch(function (error) {
        console.error("Error saat mengambil data dari IndexedDB:", error);
    });
}

function cekKetersediaanVchDrv(type, id_item, tgl_sewa, tgl_kembali) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: checkDriverAndVehicleAvailability,
            method: 'POST',
            data: {
                type: type,
                id_item: id_item,
                start_date: tgl_sewa,
                end_date: tgl_kembali,
                _token: $('meta[name="csrf-token"]').attr('content') // Token CSRF
            },
            success: function (response) {
                resolve(response.status); // Kembalikan status (tersedia/tidak_tersedia)
            },
            error: function (xhr) {
                console.error(xhr.responseJSON.message); // Tampilkan pesan error jika ada
                reject(xhr.responseJSON.message);
            }
        });
    });
}

function submitRental() {
    $('form#rentalForm').validate({
        rules: {
            no_invoice: {
                required: true
            },
            tgl_invoice: {
                required: true
            },
            cabang_id: {
                required: true
            },
            nama_pelanggan: {
                required: true
            },
            alamat: {
                required: true
            },
            email: {
                required: true
            },
            nomor_hp: {
                required: true
            },
            sim: {
                required: true
            },
            ktp: {
                required: true
            },
            kk: {
                required: true
            }
        }
    });
    jQuery.extend(jQuery.validator.messages, {
        required: "Bagian ini wajib diisi!"
    });

    if (!$('form#rentalForm').valid()) {
        Swal.fire({
            title: 'Gagal Menyimpan Invoice',
            text: 'Terdapat isian form yang harus diisi, Harap periksa kembali',
            icon: 'warning'
        });
        return false;
    }

    db.details.toArray().then((rentalItems) => {

        if (rentalItems.length === 0) {
            Swal.fire({
                title: 'Gagal Menyimpan Invoice',
                text: 'Tidak ada item yang ditambahkan. Harap tambahkan item sebelum menyimpan',
                icon: 'warning'
            });
            return false;
        }

        const hasFalse = rentalItems.some(item => item.status_ketersediaan === false);
        if (hasFalse) {
            Swal.fire({
                title: 'Gagal Menyimpan Invoice',
                text: 'Terdapat item yang tidak valid. Harap periksa kembali',
                icon: 'warning'
            });
            return false;
        }

        // Ambil data dari form
        const formData = new FormData(document.getElementById('rentalForm'));

        // add inv items dalam bentuk JSON
        formData.append('rentalItems', JSON.stringify(rentalItems));

        // Kirim data ke server using Fetch API
        fetch(rental_store, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then((data) => {
                if (data.success) {
                    db.details.clear();
                    Swal.fire({
                        title: 'Berhasil Menyimpan Invoice',
                        text: 'Kembali ke halaman utama...',
                        icon: 'success',
                        confirmButtonText: 'Lanjutkan'
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.href = rental_index; // Redirect ke halaman rental
                        }
                    });
                } else {
                    alert(data.message || "Terjadi kesalahan saat menyimpan rental.");
                }
            })
            .catch((error) => {
                console.error("Error saat mengirim data ke server:", error);
                alert("Terjadi kesalahan saat menyimpan data. Silakan coba lagi.");
            });
    }).catch((error) => {
        console.error("Error saat membaca data dari IndexedDB:", error);
    });
}

document.getElementById('submitRentalButton').addEventListener('click', function () {
    submitRental();
});