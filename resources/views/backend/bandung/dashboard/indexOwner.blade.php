<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <!-- ========================= Main ==================== -->
    @include('backend.bandung.layouts.sidebar')
    <div class="content-wrapper">
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="card p-2 bg-success" style="max-width: 560px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="/assets/icons/money/cash.png" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h2 class="card-title text-white">Cash In OWNER<i class="fa-solid fa-arrow-down"></i></h2>
                                                <br>
                                                <h2 class="card-text  text-white">Rp.2.000.000</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card p-2 bg-danger" style="max-width: 560px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="/assets/icons/money/cash.png" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h2 class="card-title text-white">Cash Out <i class="fa-solid fa-arrow-up"></i></h2>
                                                <br>
                                                <h2 class="card-text  text-white">Rp.1.350.000</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card p-2 bg-primary" style="max-width: 560px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="/assets/icons/money/invoice.png" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h2 class="card-title text-white">Transaction</h2>
                                                <br>
                                                <h2 class="card-text  text-white">33</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Cashflow</h1>
                    </div>
                    <div class="card-body">
                        <div class="row mt-2">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Cashflow Monthly</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="cashflowMonthly"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Cashflow Accumulative</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="cashflowAccumulative"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Cashflow Percentage</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="pieChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Rent</h1>
                    </div>
                    <div class="card-body">
                        <div class="row mt-2">
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Rental Product</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="rentalMonthlyBar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Vehicle Monthly</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="vehicleMonthly"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Driver Monthly</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="driverMonthly"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="container py-4">
        <div class="row d-flex flex-wrap justify-content-center mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="d-flex card-body" id="cash-in">
                        <div class="icon">
                            <img src="/assets/icons/money/cash-in.png" width="80px" height="80px" alt="">
                        </div>
                        <div class="metrix-text my-4 mx-auto">
                            <h5 class="card-title ">Cash In</h5>
                            <h6>Rp1.200.000</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="d-flex card-body" id="cash-out">
                        <div class="icon">
                            <img src="/assets/icons/money/cash-in.png" width="80px" height="80px" alt="">
                        </div>
                        <div class="metrix-text my-4 mx-auto">
                            <h5 class="card-title ">Cash Out</h5>
                            <h6>Rp1.600.000</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="charts" class="row">
            <div class="card-body text-bg-info col-md-6">
                <div class="card-header">Report</div>
                <div class="card-body">
                    <div id="barChart"></div>
                </div>
            </div>
            <div class="card-body text-bg-info col-md-4">
                <div class="card-header">Analytics</div>
                <div class="card-body">
                    <div id="pieChart"></div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <link rel="stylesheet" href="/assets/css/dashboard.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="./assets/js/adminPage/dashboard/dashboardChart.js"></script>
</body>

</html>