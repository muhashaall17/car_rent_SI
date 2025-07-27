<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
        rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/assets/css/profile-page.css" />
</head>

<body>
    <header>
        <nav>
            <div class="nav__header">
                <div class="nav__logo">
                    <a href="#" class="logo">
                        <img src="assets/logo light.png" alt="logo" class="logo-white" />
                        <img src="assets/logo dark.png" alt="logo" class="logo-dark" />
                        <span>Autorent</span>
                    </a>
                </div>
                <div class="nav__menu__btn" id="menu-btn">
                    <i class="ri-menu-line"></i>
                </div>
            </div>
            <ul class="nav__links" id="nav-links">
                <li><a href="{{ route('index') }}">Beranda</a></li>
                <li><a href="{{ route('catalog.index') }}">Katalog</a></li>
                <li><a href="{{ route('catalog.index') }}">Profil</a></li>
                <li><a href="#">Testimoni</a></li>
                <li><a href="https://wa.me/+6281321535220">Pesan Sekarang</a></li>
            </ul>
            <div class="nav__btns">
                <a href="https://wa.me/+6281321535220" class="btn">Pesan Sekarang <i class="ri-arrow-right-line"></i></a>
            </div>
        </nav>
    </header>
    <section class="section__container deals__container" id="about">
        <h2 class="section__header">Tentang Kami</h2>
        <p class="section__description">
            Autorent Indonesia adalah perusahaan jasa transportasi yang fokus pada kualitas layanan, keselamatan, dan kepuasan pelanggan. Berdiri sejak 2016, kami telah dipercaya oleh berbagai institusi—pemerintah, BUMN, BUMD, serta perusahaan swasta—untuk menyediakan layanan transportasi handal dan profesional.
            Kami juga melayani kebutuhan harian masyarakat umum dengan standar pelayanan yang sama, demi memastikan semua pelanggan merasakan kenyamanan dan kepercayaan penuh.
        </p>
    </section>
    <section class="subscribe__container">
        <div class="subscribe__image">
            <img src="assets/deals-5.png" alt="subscribe" />
        </div>
        <div class="subscribe__content">
            <h2 class="section__header">
                VISI
            </h2>
            <p class="section__description">
                Menjadi penyedia jasa transportasi terdepan di Indonesia yang mengedepankan kualitas, keamanan, dan kepuasan pelanggan.
            </p>
        </div>
    </section>
    <section class="choose__container" id="choose">
        <div class="choose__image">
            <img src="assets/choose.png" alt="choose" />
        </div>
        <div class="choose__content">
            <h2 class="section__header">MISI</h2>
            <div class="choose__grid">
                <div class="choose__card">
                    <h4><span><i class="ri-verified-badge-line"></i></span>Menyediakan armada kendaraan modern dan berkualitas tinggi.</h4>
                </div>
                <div class="choose__card">
                    <h4><span><i class="ri-verified-badge-line"></i></span>Memberikan layanan profesional dan ramah pelanggan.</h4>
                </div>
                <div class="choose__card">
                    <h4><span><i class="ri-verified-badge-line"></i></span>Mengutamakan keamanan dan kenyamanan dalam setiap perjalanan.</h4>
                </div>
                <div class="choose__card">
                    <h4><span><i class="ri-verified-badge-line"></i></span>Berinovasi dalam setiap aspek layanan transportasi.</h4>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="section__container footer__container">
            <div class="footer__col">
                <div class="footer__logo">
                    <a href="#" class="logo">
                        <img src="assets/logo light.png" alt="logo" />
                        <span>Autorent</span>
                    </a>
                </div>
                <p>
                    Kami di sini untuk menyediakan kendaraan terbaik dan pengalaman penyewaan yang mulus.
                    Tetap terhubung untuk pembaruan, penawaran spesial, dan lainnya.
                </p>
                <ul class="footer__socials">
                    <!-- <li>
              <a href="#"><i class="ri-facebook-fill"></i></a>
            </li> -->
                    <!-- <li>
              <a href="#"><i class="ri-twitter-fill"></i></a>
            </li> -->
                    <!-- <li>
              <a href="#"><i class="ri-linkedin-fill"></i></a>
            </li> -->
                    <li>
                        <a href="https://wa.me/+6281321535220"><i class="ri-whatsapp-line"></i></a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/ptjocartransindonesia_rentcar?igsh=MXMyMjRqaGFhN2tiMQ=="><i class="ri-instagram-line"></i></a>
                    </li>
                    <!-- <li>
              <a href="#"><i class="ri-youtube-fill"></i></a>
            </li> -->
                </ul>
            </div>
            <div class="footer__col">
                <h4>Our Websites</h4>
                <ul class="footer__links">
                    <li><a href="{{ route('index') }}">Beranda</a></li>
                    <li><a href="{{ route('catalog.index') }}">Katalog</a></li>
                    <li><a href="{{ route('profile.index') }}">Profil</a></li>
                    <li><a href="#choose">Testimoni</a></li>
                </ul>
            </div>
            <!-- <div class="footer__col">
          <h4>Vehicle Model</h4>
          <ul class="footer__links">
            <li><a href="#">Toyota Corolla</a></li>
            <li><a href="#">Toyota Noah</a></li>
            <li><a href="#">Toyota Allion</a></li>
            <li><a href="#">Toyota Premio</a></li>
            <li><a href="#">Mistubishi Pajero</a></li>
          </ul>
        </div> -->
            <div class="footer__col">
                <h4>Contact</h4>
                <ul class="footer__links">
                    <li>
                        <a href="https://wa.me/+6281321535220">
                            <span><i class="ri-phone-fill"></i></span> +62 813-2153-5220
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span><i class="ri-map-pin-fill"></i></span> Autorent Bandung
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span><i class="ri-map-pin-fill"></i></span> Autorent Jakarta
                        </a>
                    </li>
                    <li>
                        <a href="mailto:autorentindonesia@gmail.com">
                            <span><i class="ri-mail-fill"></i></span> autorentindonesia@gmail.com
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer__bar">
            Copyright © 2024 Autorent. All rights reserved.
        </div>
    </footer>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="/assets/js/contoh.js"></script>
</body>

</html>