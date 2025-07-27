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
    <div class="container-fluid">

    
        <!-- TEXT START -->
        <div class="container-fluid text mb-4">
            <h1 style="color:white;">Autorent Cars</h1>
        </div>
        <!-- TEXT END -->

        <!-- DROPDOWN START -->
        <div class="d-flex justify-content-between mb-5">

            <!-- DROPDOWN CATEGORY BUTTON START -->
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                    Category
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>
            <!-- DROPDOWN CATEGORY BUTTON END -->

            <!-- DROPDOWN MODEL BUTTON START -->
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Model
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>
            <!-- DROPDOWN MODEL BUTTON END -->

            <!-- DROPDOWN BRAND BUTTON START -->
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Brand
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>
            <!-- DROPDOWN BRAND BUTTON END -->

            <!-- DROPDOWN DATE BUTTON START -->
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Date
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>
            <!-- DROPDOWN DATE BUTTON END -->

            <!-- DROPDOWN DATE PRICE START -->
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Price
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>
            <!-- DROPDOWN DATE PRICE END -->
            
            <!-- DROPDOWN ALL FILLTERS PRICE START -->
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    All Filters
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>
            <!-- DROPDOWN ALL FILLTERS PRICE END -->

            <!-- DROPDOWN RECOMMENDED PRICE START -->
            <div class="btn-group">
                <button type="button" class="btn" aria-expanded="false">
                    Recommended
                </button>
            </div>
            <!-- DROPDOWN RECOMMENDED PRICE END -->
        </div>
        <!-- DROPDOWN END -->

        <!-- CARS CATALOG START -->
        <div id="carsCatalogue" class="container text-center">
            <div class="d-flex flex-wrap">
                @foreach (array_keys($images) as $key)
                    <div class="row">
                        <div class="col p-4">

                            <div class="image-car mb-3">
                                <img src="{{ asset('assets/imgs/'. 'hrv.jpg') }}" class="img-fluid rounded"
                                    alt="hrv" width="400px;">
                            </div>
                            
                            <div class="d-flex justify-content-between brand">
                                <h3>
                                    {{ $brands[$key] }}
                                </h3>
                                <h3 class="price">
                                    <?php echo 'Rp'. number_format(rand(100000, 2000000), 0, ',', '.'); ?>
                                </h3>
                            </div>    
                            
                            <div class="d-flex justify-content-between cars">
                                <h3>
                                    {{ $cars[$key] }}
                                </h3>
                                <h3 class="price-per-day">per day</h3>
                            </div>    
                            
                            <div class="d-flex justify-content-start feature">
                                <img src="assets/icons/catalog/gear.png" alt="" width="30px" height="30px"> Automat
                            </div>    
                               
                            <div class="d-grid gap-2 d-md-block mx-auto">
                                <button class="btn" type="button">Rent Now</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- CARS CATALOG END -->

        <!-- PAGINATION CARS CATALOG START -->
        <div id="nav">
            <nav class="d-flex flex-wrap justify-content-center" aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                </ul>
            </nav>
        </div>
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