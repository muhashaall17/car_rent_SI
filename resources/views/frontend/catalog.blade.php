<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Katalog Mobil</title>
    @include('backend.bandung.layouts.loadLibGlobal')

    <link rel="stylesheet" href="/assets/css/pagination-catalog.css">
</head>

<body>
    <div class="container-fluid" style="--bs-gutter-x: 0;">
        <!-- NAVIGASI START -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top" >
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand fw-bold" href="#">
                    <i class="bi bi-car-front-fill me-2"></i>Car Rental
                </a>

                <!-- Toggle button for mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu Items -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Vehicles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                    </ul>

                    <!-- Contact Info -->
                    <div class="d-none d-lg-flex align-items-center">
                        <i class="bi bi-telephone-fill me-2 text-primary"></i>
                        <span class="fw-bold text-dark">+280 2341-1860</span>
                    </div>
                </div>
            </div>
        </nav>
        <!-- NAVIGASI START -->

        <!-- KATALOG START -->
        <div class="container my-4 text-center">
            <h2 class="mb-4">Select a vehicle group</h2>

            <div class="btn-group mb-4" role="group">
                <a href="{{ route('catalog.index') }}" class="btn btn-outline-primary">All vehicles</a>
                <a href="{{ route('catalog.index', ['merk' => 'honda']) }}" class="btn btn-outline-primary">Honda</a>
                <a href="{{ route('catalog.index', ['merk' => 'toyota']) }}" class="btn btn-outline-primary">Toyota</a>
                <a href="{{ route('catalog.index', ['merk' => 'yamaha']) }}" class="btn btn-outline-primary">Yamaha</a>
                <a href="{{ route('catalog.index', ['merk' => 'daihatsu']) }}" class="btn btn-outline-primary">Daihatsu</a>
                <a href="{{ route('catalog.index', ['merk' => 'minivan']) }}" class="btn btn-outline-primary">Minivan</a>
            </div>
        </div>
        <!-- KATALOG END -->

        <!-- CARD MOBIL START -->
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($cars as $car)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('assets/imgs/' . 'hrv.jpg') }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between">
                                {{ $car->merk }}
                                <span class="text-primary">${{ $car->harga_sewa }}</span>
                            </h5>
                            <p class="card-title d-flex justify-content-between">
                                {{ $car->nama_kendaraan }}
                                <span>per day</span>
                            </p>
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <span><i class="bi bi-gear"></i>Manual</span>
                                <span><i class="bi bi-fuel-pump"></i>Pertamax</span>
                                <span><i class="bi bi-wind"></i> Air Conditioner</span>
                            </div>
                            <a href="#" class="btn btn-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>    
        <!-- CARD MOBIL START -->

        <!-- PAGINATION CARS CATALOG START -->
        <!-- <div id="nav">
            <nav class="d-flex flex-wrap justify-content-center" aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                </ul>
            </nav>
        </div> -->
        <!-- PAGINATION CARS CATALOG END -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>