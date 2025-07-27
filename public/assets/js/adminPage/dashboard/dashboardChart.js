function Rupiah(angka) {
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for (var i = 0; i < angkarev.length; i++)
        if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
    return rupiah.split('', rupiah.length - 1).reverse().join('');
}

$('input[name="trans_date"]').datepicker({
    dateFormat: "dd/mm/yy",
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true,
    onSelect: function (dateText) {
        let c_trans_date = moment(dateText, "DD/MM/YYYY").format("YYYY-MM-DD");
        transDataByDate(c_trans_date)
    },
});

$('input[name="payment_date"]').datepicker({
    dateFormat: "dd/mm/yy",
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true,
    onSelect: function (dateText) {
        let c_payment_date = moment(dateText, "DD/MM/YYYY").format(
            "YYYY-MM-DD"
        );
        paymentDataByDate(c_payment_date)
    },
});

$('input[name="trans_date"]').val(moment().format("DD/MM/YYYY"));
$('input[name="payment_date"]').val(moment().format("DD/MM/YYYY"));

function transDataByDate(tanggal) {
    $.ajax({
        url: getTransDataByDate, // ganti sesuai route kamu
        method: "GET",
        data: {
            tanggal: tanggal,
        },
        success: function (response) {
            // Misalnya kita tampilkan datanya ke dalam #data-container
            $("#trans_data_date").text(response.data); // pastikan backend kirim 'html'
        },
        error: function () {
            $("#trans_data_date").text("Tidak Dapat Mendapat Data");
        },
    });
}

// Set tanggal awal = hari ini
const todayTransDate = moment(
    $('input[name="trans_date"]').val(),
    "DD/MM/YYYY"
).format("YYYY-MM-DD");
transDataByDate(todayTransDate); // load pertama kali

function paymentDataByDate(tanggal) {
    $.ajax({
        url: getPaymentDataByDate, // ganti sesuai route kamu
        method: "GET",
        data: {
            tanggal: tanggal,
        },
        success: function (response) {
            // Misalnya kita tampilkan datanya ke dalam #data-container
            $("#payment_data_date").text(Rupiah(response.data)); // pastikan backend kirim 'html'
        },
        error: function () {
            $("#payment_data_date").text("Tidak Dapat Mendapat Data");
        },
    });
}

// Set tanggal awal = hari ini
const todayPaymentDate = moment(
    $('input[name="payment_date"]').val(),
    "DD/MM/YYYY"
).format("YYYY-MM-DD");
paymentDataByDate(todayPaymentDate); // load pertama kali

const bulanSelectTrans = document.getElementById("trans_month");
const bulanSelectPayment = document.getElementById("payment_month");

const bulanSekarang = moment().month(); // 0 = Januari, 11 = Desember
const bulanList = [
    "Januari",
    "Februari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember",
];

bulanList.forEach((namaBulan, index) => {
    const option = document.createElement("option");
    option.value = index; // value: 1 sampai 12
    option.text = namaBulan;
    if (index === bulanSekarang) {
        option.selected = true;
    }
    bulanSelectTrans.appendChild(option);
});

bulanList.forEach((namaBulan, index) => {
    const option = document.createElement("option");
    option.value = index; // value: 1 sampai 12
    option.text = namaBulan;
    if (index === bulanSekarang) {
        option.selected = true;
    }
    bulanSelectPayment.appendChild(option);
});

function transDataByMonth(bulanIndex) {
    const tahun = moment().year();
    const startDate = moment([tahun, bulanIndex])
        .startOf("month")
        .format("YYYY-MM-DD");
    const endDate = moment([tahun, bulanIndex])
        .endOf("month")
        .format("YYYY-MM-DD");

    $.ajax({
        url: getTransDataByMonth,
        type: "GET",
        data: {
            tanggal_awal: startDate,
            tanggal_akhir: endDate,
        },
        success: function (response) {
            if (response.success) {
                $("#trans_data_month").text(response.data);
            } else {
                $("#trans_data_month").text("ERROR!");
            }
        },
        error: function () {
            $("#trans_data_month").text("ERROR!");
        },
    });
}

transDataByMonth(bulanSekarang);

bulanSelectTrans.addEventListener("change", function () {
    const selectedIndex = parseInt($(this).val());
    transDataByMonth(selectedIndex);
});

function paymentDataByMonth(bulanIndex) {
    const tahun = moment().year();
    const startDate = moment([tahun, bulanIndex])
        .startOf("month")
        .format("YYYY-MM-DD");
    const endDate = moment([tahun, bulanIndex])
        .endOf("month")
        .format("YYYY-MM-DD");

    $.ajax({
        url: getPaymentDataByMonth,
        type: "GET",
        data: {
            tanggal_awal: startDate,
            tanggal_akhir: endDate,
        },
        success: function (response) {
            if (response.success) {
                $("#payment_data_month").text(Rupiah(response.data));
            } else {
                $("#payment_data_month").text("ERROR!");
            }
        },
        error: function () {
            $("#payment_data_month").text("ERROR!");
        },
    });
}

paymentDataByMonth(bulanSekarang);

bulanSelectPayment.addEventListener("change", function () {
    const selectedIndex = parseInt($(this).val());
    paymentDataByMonth(selectedIndex);
});

const tahunSelectTrans = document.getElementById("trans_year");
const tahunSelectPayment = document.getElementById("payment_year");
const tahunIni = moment().year(); // contoh: 2025

for (let i = 0; i < 3; i++) {
    const tahun = tahunIni - i; // 2025, 2024, 2023
    const option = document.createElement("option");
    option.value = tahun;
    option.text = tahun;
    if (tahun === tahunIni) {
        option.selected = true;
    }
    tahunSelectTrans.appendChild(option);
}

for (let i = 0; i < 3; i++) {
    const tahun = tahunIni - i; // 2025, 2024, 2023
    const option = document.createElement("option");
    option.value = tahun;
    option.text = tahun;
    if (tahun === tahunIni) {
        option.selected = true;
    }
    tahunSelectPayment.appendChild(option);
}

function transDataByYear(tahun) {
    $.ajax({
        url: getTransDataByYear,
        type: "GET",
        data: {
            tahun: tahun,
        },
        success: function (response) {
            if (response.success) {
                $("#trans_data_year").text(response.data);
            } else {
                $("#trans_data_year").text("ERROR!");
            }
        },
        error: function () {
            $("#trans_data_year").text("ERROR!");
        },
    });
}

tahunSelectTrans.addEventListener("change", function () {
    const tahunDipilih = parseInt(this.value);

    // Panggil fungsi untuk ambil data
    transDataByYear(tahunDipilih);
});

transDataByYear(moment().format("YYYY"));

function paymentDataByYear(tahun) {
    $.ajax({
        url: getPaymentDataByYear,
        type: "GET",
        data: {
            tahun: tahun,
        },
        success: function (response) {
            if (response.success) {
                $("#payment_data_year").text(Rupiah(response.data));
            } else {
                $("#payment_data_year").text("ERROR!");
            }
        },
        error: function () {
            $("#payment_data_year").text("ERROR!");
        },
    });
}

tahunSelectPayment.addEventListener("change", function () {
    const tahunDipilih = parseInt(this.value);

    // Panggil fungsi untuk ambil data
    paymentDataByYear(tahunDipilih);
});

paymentDataByYear(moment().format("YYYY"));
