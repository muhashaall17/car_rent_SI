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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Transaksi Rental</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mt-2">
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Hari Ini</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="trans_date" id="trans_date" class="form-control" readonly>
                                        <h1 class="card-title" id="trans_data_date">Loading...</h1>
                                        <p class="card-text">Transaksi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Bulan Ini</h5>
                                    </div>
                                    <div class="card-body">
                                        <select id="trans_month" class="form-select">
                                        </select>
                                        <h1 class="card-title" id="trans_data_month">Loading..</h1>
                                        <p class="card-text">Transaksi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Tahun Ini</h5>
                                    </div>
                                    <div class="card-body">
                                        <select id="trans_year" class="form-select">
                                        </select>
                                        <h1 class="card-title" id="trans_data_year">Loading...</h1>
                                        <p class="card-text">Transaksi</p>
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
                        <h4>Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mt-2">
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Hari Ini</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="payment_date" id="payment_date" class="form-control" readonly>
                                        <h1 class="card-title" id="payment_data_date">Loading...</h1>
                                        <p class="card-text">Rupiah</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Bulan Ini</h5>
                                    </div>
                                    <div class="card-body">
                                        <select id="payment_month" class="form-select">
                                        </select>
                                        <h1 class="card-title" id="payment_data_month">Loading...</h1>
                                        <p class="card-text">Rupiah</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Tahun Ini</h5>
                                    </div>
                                    <div class="card-body">
                                        <select id="payment_year" class="form-select">
                                        </select>
                                        <h1 class="card-title" id="payment_data_year">Loading...</h1>
                                        <p class="card-text">Rupiah</p>
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

    <script>
        let getTransDataByDate = "{{ route('getTransDataByDate') }}",
            getPaymentDataByDate = "{{ route('getPaymentDataByDate') }}",
            getTransDataByMonth = "{{ route('getTransDataByMonth') }}",
            getPaymentDataByMonth = "{{ route('getPaymentDataByMonth') }}",
            getTransDataByYear = "{{ route('getTransDataByYear') }}",
            getPaymentDataByYear = "{{ route('getPaymentDataByYear') }}";
    </script>

    <!-- jQuery (Load pertama kali) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI (Versi yang kompatibel dengan jQuery 3.x) -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Bootstrap CSS (Versi 5.3.3) -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> -->

    <!-- Font Awesome (Versi terbaru 6.7.1) -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">

    <!-- Popper.js (Bootstrap dependency) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->

    <!-- Bootstrap JS (Versi 5.3.3) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script> -->

    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>

    <!-- Dexie.js -->
    <!-- <script src="https://unpkg.com/dexie/dist/dexie.js"></script> -->

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>

    <!-- Validasi Form JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <!-- Sweet Alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Money Formatting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script src="./assets/js/adminPage/dashboard/dashboardChart.js"></script>
</body>

</html>