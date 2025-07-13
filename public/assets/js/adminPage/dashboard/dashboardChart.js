// CHART CASHFLOW START:::

const pieChartConfig = {
    chart: {
        type: 'pie',
    },
    plotOptions: {
        pie: {
            customScale: 0.95,
            expandOnClick: true,
        }
    },
    colors: ['#188754', '#dc3546'], // Cash In: Green, Cash Out: Red
    series: [22100000, 21100000], // Total Cash In and Cash Out
    labels: ['Cash In', 'Cash Out'],
};


const cashflowMonthlyConfig = {
    chart: {
        type: 'bar',
        height: 300,
        width: '100%',
    },
    series: [
        {
            name: 'Cash In',
            data: [1300000, 1400000, 1500000, 1700000, 1600000, 1900000, 1800000, 2000000, 2100000, 2300000, 2200000, 2100000] // Cash In data
        },
        {
            name: 'Cash Out',
            data: [1200000, 1300000, 1400000, 1500000, 1500000, 1800000, 1700000, 1900000, 2000000, 2400000, 2300000, 2200000] // Cash Out data
        }
    ],
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] // Nama kategori hingga Desember
    },
    plotOptions: {
        bar: {
            columnWidth: '70%', // Ukuran bar
            endingShape: 'rounded' // Gaya bar
        },
    },
    dataLabels: {
        enabled: false,
    },
    colors: ['#188754', '#dc3546'],
};

const cashflowAccumulativeConfig = {
    chart: {
        type: 'line',
        height: 300,
        width: '100%',
    },
    series: [
        {
            name: 'Net Cash Flow (Cash In - Cash Out)',
            data: [100000, 200000, 300000, 500000, 600000, 700000, 800000, 900000, 1000000, 900000, 800000, 700000] // Akumulasi Cash In - Cash Out
        }
    ],
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] // Nama kategori hingga Desember
    },
    plotOptions: {
        bar: {
            columnWidth: '70%', // Ukuran bar
            endingShape: 'rounded' // Gaya bar
        },
    },
    dataLabels: {
        enabled: false,
    },
    colors: ['#188754'], // Hijau untuk Net Cash Flow
};



const pieChart = new ApexCharts(document.getElementById('pieChart'), pieChartConfig);

const cashflowMonthly = new ApexCharts(document.getElementById("cashflowMonthly"), cashflowMonthlyConfig);

const cashflowAccumulative = new ApexCharts(document.getElementById("cashflowAccumulative"), cashflowAccumulativeConfig);

pieChart.render();
cashflowMonthly.render();
cashflowAccumulative.render();

// CHART CASHFLOW END:::

// CHART TRANSAKSI START:::
const rentalMonthlyBarConfig = {
    chart: {
        type: 'bar',
        height: 300,
        width: '100%',
    },
    series: [
        {
            name: 'Drivers',
            data: [12, 10, 15, 14, 16, 13, 18, 17, 14, 16, 15, 12] // Jumlah driver sewaan per bulan
        },
        {
            name: 'Vehicles',
            data: [48, 40, 60, 56, 64, 52, 72, 68, 56, 64, 60, 48] // Jumlah kendaraan sewaan per bulan
        }
    ],
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] // Nama kategori hingga Desember
    },
    plotOptions: {
        bar: {
            columnWidth: '70%', // Ukuran bar
            endingShape: 'rounded' // Gaya bar
        },
    },
    dataLabels: {
        enabled: false,
    },
    colors: ['#fec107', '#0d6efd'], // Hijau untuk Driver, Merah untuk Kendaraan
};

const vehicleMonthlyConfig = {
    chart: {
        type: 'line',
        height: 300,
        width: '100%',
    },
    series: [
        {
            name: 'Vehicles',
            data: [48, 40, 60, 56, 64, 52, 72, 68, 56, 64, 60, 48] // Jumlah kendaraan sewaan per bulan
        }
    ],
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] // Nama kategori hingga Desember
    },
    plotOptions: {
        bar: {
            columnWidth: '70%', // Ukuran bar
            endingShape: 'rounded' // Gaya bar
        },
    },
    dataLabels: {
        enabled: false,
    },
    colors: ['#0d6efd'], // Hijau untuk Driver, Merah untuk Kendaraan
};

const driverMonthlyConfig = {
    chart: {
        type: 'line',
        height: 300,
        width: '100%',
    },
    series: [
        {
            name: 'Drivers',
            data: [12, 10, 15, 14, 16, 13, 18, 17, 14, 16, 15, 12] // Jumlah driver sewaan per bulan
        }
    ],
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] // Nama kategori hingga Desember
    },
    plotOptions: {
        bar: {
            columnWidth: '70%', // Ukuran bar
            endingShape: 'rounded' // Gaya bar
        },
    },
    dataLabels: {
        enabled: false,
    },
    colors: ['#fec107'] // Hijau untuk Driver, Merah untuk Kendaraan
};

const rentalMonthlyBar = new ApexCharts(document.getElementById("rentalMonthlyBar"), rentalMonthlyBarConfig);

const vehicleMonthly = new ApexCharts(document.getElementById("vehicleMonthly"), vehicleMonthlyConfig);

const driverMonthly = new ApexCharts(document.getElementById("driverMonthly"), driverMonthlyConfig);

rentalMonthlyBar.render();
vehicleMonthly.render();
driverMonthly.render();
// CHART TRANSAKSI END:::