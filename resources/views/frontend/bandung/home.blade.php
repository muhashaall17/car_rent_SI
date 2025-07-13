<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jocar Trans Indonesia - Rental Mobil Premium</title>
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/landingpage.css">
</head>

<body class="bg-gray-50">
  <!-- Floating Background Shapes -->
  <div class="floating-shape shape-1"></div>
  <div class="floating-shape shape-2"></div>
  <div class="floating-shape shape-3"></div>

  <!-- Navbar -->
  <nav class="navbar fixed w-full z-50 top-0 left-0 px-6 py-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
      <div class="flex items-center">
        <img src="assets/logo-jocar.png" alt="Jocar Trans Logo" class="h-12 w-auto object-contain  mr-3 my-0" />
        <span class="text-md font-bold text-gray-800">Jocar Trans Indonesia</span>
      </div>
      <div class="hidden lg:flex items-center space-x-6">
        <a href="#home" class="text-gray-700 hover:text-blue-600 font-medium transition hover-grow">Beranda</a>
        <a href="#catalog" class="text-gray-700 hover:text-blue-600 font-medium transition hover-grow">Katalog</a>
        <a href="#services" class="text-gray-700 hover:text-blue-600 font-medium transition hover-grow">Layanan</a>
        <a href="#contact" class="bg-gradient-to-r from-blue-600 to-blue-400 hover:from-blue-700 hover:to-blue-500 text-white px-5 py-2 rounded-full font-medium transition flex items-center shadow-lg hover-grow glow-effect">
          Pesan <i class="ri-arrow-right-line ml-1"></i>
        </a>
      </div>
      <button id="mobile-menu-button" class="lg:hidden text-gray-700 focus:outline-none hover-grow">
        <i class="ri-menu-line text-2xl"></i>
      </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden fixed inset-0 bg-white z-40 flex flex-col items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
      <button id="close-menu" class="absolute top-6 right-6 text-gray-700 hover-grow">
        <i class="ri-close-line text-2xl"></i>
      </button>
      <div class="flex flex-col items-center space-y-6">
        <a href="#home" class="text-gray-700 hover:text-blue-600 text-xl font-medium transition hover-grow">Beranda</a>
        <a href="#catalog" class="text-gray-700 hover:text-blue-600 text-xl font-medium transition hover-grow">Katalog</a>
        <a href="#services" class="text-gray-700 hover:text-blue-600 text-xl font-medium transition hover-grow">Layanan</a>
        <a href="#contact" class="bg-gradient-to-r from-blue-600 to-blue-400 hover:from-blue-700 hover:to-blue-500 text-white px-6 py-3 rounded-full font-medium transition flex items-center shadow-lg hover-grow glow-effect">
          Pesan Sekarang <i class="ri-arrow-right-line ml-2"></i>
        </a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section id="home" class="hero-section px-6 mobile-padding">
    <div class="max-w-7xl mx-auto h-full flex flex-col lg:flex-row items-center justify-center relative z-10">
      <!-- Mobile Image (Top on mobile) -->
      <div class="lg:hidden w-full mt-10 mb-6">
        <img src="https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
          alt="Luxury Cars"
          class="w-full h-auto rounded-xl shadow-lg hover-grow">
      </div>

      <!-- Text Content -->
      <div class="lg:w-1/2 mb-8 lg:mb-0 mobile-text-center lg:text-left">
        <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full inline-flex items-center mb-4 hover-grow">
          <i class="ri-star-fill text-yellow-500 mr-1"></i>
          <span class="font-medium text-sm">Rental Mobil Terpercaya</span>
        </div>
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-4 leading-tight">
          Solusi Transportasi <span class="text-blue-600">Premium</span> untuk Anda
        </h1>
        <p class="text-base lg:text-lg text-gray-600 mb-6 max-w-lg lg:mx-0 mx-auto">
          PT Jocar Trans Indonesia, dengan lebih dari 8 tahun pengalaman sejak 2016, kami hadir untuk memberikan solusi transportasi terbaik, mulai dari kendaraan operasional perusahaan, layanan sewa pribadi, hingga trip organizer profesional
        </p>
        <div class="flex flex-col sm:flex-row gap-3 hero-buttons">
          <a href="#contact" class="bg-gradient-to-r from-blue-600 to-blue-400 hover:from-blue-700 hover:to-blue-500 text-white px-6 py-3 rounded-full font-medium transition flex items-center justify-center shadow-lg hover-grow glow-effect">
            Pesan Sekarang <i class="ri-arrow-right-line ml-2"></i>
          </a>
          <a href="#catalog" class="border-2 border-blue-600 text-blue-600 hover:bg-blue-50 px-6 py-3 rounded-full font-medium transition flex items-center justify-center hover-grow">
            Lihat Armada <i class="ri-car-line ml-2"></i>
          </a>
        </div>

        <div class="mt-8 flex flex-wrap justify-center lg:justify-start gap-4">
          <div class="flex items-center bg-white/80 backdrop-blur-sm p-3 rounded-lg shadow-sm hover-grow">
            <div class="bg-green-100 p-2 rounded-full mr-2">
              <i class="ri-checkbox-circle-fill text-green-600 text-lg"></i>
            </div>
            <div>
              <p class="font-bold text-gray-800 text-sm">100+</p>
              <p class="text-xs text-gray-600">Armada Tersedia</p>
            </div>
          </div>
          <div class="flex items-center bg-white/80 backdrop-blur-sm p-3 rounded-lg shadow-sm hover-grow">
            <div class="bg-purple-100 p-2 rounded-full mr-2">
              <i class="ri-user-heart-fill text-purple-600 text-lg"></i>
            </div>
            <div>
              <p class="font-bold text-gray-800 text-sm">5.000+</p>
              <p class="text-xs text-gray-600">Pelanggan Puas</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Desktop Image -->
      <div class="hidden lg:block lg:w-1/2 relative pl-8">
        <img src="https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
          alt="Luxury Cars"
          class="w-full h-auto rounded-2xl shadow-xl transform hover:scale-105 transition duration-500">
        <div class="absolute -bottom-4 -left-4 bg-white p-3 rounded-xl shadow-lg hover-grow">
          <div class="flex items-center">
            <div class="bg-blue-100 p-2 rounded-full mr-2">
              <i class="ri-star-fill text-yellow-400"></i>
            </div>
            <div>
              <p class="font-bold text-gray-800 text-sm">4.9/5</p>
              <p class="text-xs text-gray-600">Rating</p>
            </div>
          </div>
        </div>

        <div class="absolute -top-6 -right-6 bg-white p-4 rounded-xl shadow-lg hover-grow">
          <div class="flex items-center">
            <div class="bg-green-100 p-2 rounded-full mr-2">
              <i class="ri-roadster-fill text-green-600"></i>
            </div>
            <div>
              <p class="font-bold text-gray-800 text-sm">24/7</p>
              <p class="text-xs text-gray-600">Layanan Darurat</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Top Rekomendasi Mobil -->
  <section id="catalog" class="py-16 px-6 bg-white mobile-padding">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-12">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3 section-title">Armada Pilihan Kami</h2>
        <p class="text-base text-gray-600 max-w-2xl mx-auto">
          Temukan mobil perfect untuk kebutuhan Anda. Armada kami selalu dalam kondisi prima.
        </p>
      </div>

      <div class="divider"></div>

      <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h3 class="text-xl font-semibold text-gray-800">Rekomendasi Terbaik</h3>
        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium flex items-center text-sm hover-grow">
          Lihat semua <i class="ri-arrow-right-line ml-1"></i>
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
        <!-- Mobil 1 (Rank 1) -->
        <div class="relative bg-white rounded-xl overflow-hidden shadow-md card-hover transition duration-300 mobile-card-height hover-grow">
          <div class="ranking-badge">1</div>
          <div class="h-40 sm:h-48 overflow-hidden relative">
            <img src="assets/hrv-2024.png"
              alt="Toyota Alphard"
              class="w-100 h-100 object-cover hover:scale-110 transition duration-500 transform -translate-y-20">
          </div>
          <div class="p-5">
            <div class="flex justify-between items-start mb-2">
              <h4 class="text-lg font-bold text-gray-800">Honda HRV</h4>
              <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">Populer</span>
            </div>
            <p class="text-sm text-gray-600 mb-3">Mewah, nyaman, dan elegan. Perfect untuk perjalanan bisnis atau keluarga.</p>
            <div class="flex justify-between items-center">
              <span class="font-bold text-gray-800 text-sm">Rp 850.000/hari</span>
              <a href="#" class="bg-gradient-to-r from-blue-600 to-blue-400 hover:from-blue-700 hover:to-blue-500 text-white px-3 py-1.5 rounded-full text-xs font-medium transition flex items-center shadow hover-grow">
                Pesan <i class="ri-arrow-right-line ml-1"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Mobil 2 (Rank 2) -->
        <div class="relative bg-white rounded-xl overflow-hidden shadow-md card-hover transition duration-300 mobile-card-height hover-grow">
          <div class="ranking-badge">2</div>
          <div class="h-40 sm:h-48 overflow-hidden relative">
            <img src="assets/briogen2-2022.png"
              alt="Honda Brio"
              class="w-100 h-100 object-cover hover:scale-110 transition duration-500 transform -translate-y-20">
          </div>
          <div class="p-5">
            <div class="flex justify-between items-start mb-2">
              <h4 class="text-lg font-bold text-gray-800">Honda Brio</h4>
              <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Ekonomis</span>
            </div>
            <p class="text-sm text-gray-600 mb-3">Ekonomis, irit bahan bakar, namun tetap nyaman untuk perjalanan harian.</p>
            <div class="flex justify-between items-center">
              <span class="font-bold text-gray-800 text-sm">Rp 400.000/hari</span>
              <a href="#" class="bg-gradient-to-r from-blue-600 to-blue-400 hover:from-blue-700 hover:to-blue-500 text-white px-3 py-1.5 rounded-full text-xs font-medium transition flex items-center shadow hover-grow">
                Pesan <i class="ri-arrow-right-line ml-1"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Mobil 3 (Rank 3) -->
        <div class="relative bg-white rounded-xl overflow-hidden shadow-md card-hover transition duration-300 mobile-card-height hover-grow">
          <div class="ranking-badge">3</div>
          <div class="h-40 sm:h-48 overflow-hidden relative">
            <img src="assets/pajero-2024.png"
              alt="Pajero"
              class="w-100 h-100 hover:scale-110 transition duration-500 transform -translate-y-20">
          </div>
          <div class="p-5">
            <div class="flex justify-between items-start mb-2">
              <h4 class="text-lg font-bold text-gray-800">Mistubishi Pajero</h4>
              <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-medium">Tangguh</span>
            </div>
            <p class="text-sm text-gray-600 mb-3">Tangguh di segala medan dengan interior mewah. Ideal untuk perjalanan jauh.</p>
            <div class="flex justify-between items-center">
              <span class="font-bold text-gray-800 text-sm">Rp 1.350.000/hari</span>
              <a href="#" class="bg-gradient-to-r from-blue-600 to-blue-400 hover:from-blue-700 hover:to-blue-500 text-white px-3 py-1.5 rounded-full text-xs font-medium transition flex items-center shadow hover-grow">
                Pesan <i class="ri-arrow-right-line ml-1"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Layanan Kami -->
  <section id="services" class="py-16 px-6 bg-gradient-to-b from-blue-50 to-indigo-50 mobile-padding">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-12">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3 section-title">Layanan Kami</h2>
        <p class="text-base text-gray-600 max-w-2xl mx-auto">
          Kami menyediakan solusi kendaraan untuk operasional perusahaan, instansi pemerintah, dan sektor swasta.
        </p>
      </div>

      <div class="divider"></div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Layanan 1 -->
        <div class="service-card rounded-lg overflow-hidden shadow-md card-hover transition duration-300 hover-grow">
          <div class="card-image mobile-service-image">
            <img src="assets/layanan-wedding car.png"
              alt="Wedding Car"
              class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
          </div>
          <div class="p-5 flex-grow">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Wedding Car</h3>
            <p class="text-sm text-gray-600 mb-4">
              Kami menyediakan mobil pengantin mewah dengan dekorasi elegan dan pengemudi profesional untuk memastikan perjalanan pernikahan Anda berjalan lancar dan berkesan. Tersedia berbagai pilihan kendaraan sesuai tema dan preferensi Anda—mulai dari sedan premium hingga SUV mewah.
            </p>
            <a href="#" class="text-blue-600 hover:text-blue-700 font-medium flex items-center text-sm hover-grow">
              Selengkapnya <i class="ri-arrow-right-line ml-1"></i>
            </a>
          </div>
        </div>

        <!-- Layanan 2 -->
        <div class="service-card rounded-lg overflow-hidden shadow-md card-hover transition duration-300 hover-grow">
          <div class="card-image mobile-service-image">
            <img src="assets/layanan-triporg.png"
              alt="Trip Organizer"
              class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
          </div>
          <div class="p-5 flex-grow">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Trip Organizer</h3>
            <p class="text-sm text-gray-600 mb-4">
              Tim kami siap merancang perjalanan dari awal hingga akhir sesuai anggaran dan preferensi Anda. Mulai dari destinasi wisata, transportasi, akomodasi, hingga dokumentasi—semua ditangani secara profesional.
            </p>
            <a href="#" class="text-blue-600 hover:text-blue-700 font-medium flex items-center text-sm hover-grow">
              Selengkapnya <i class="ri-arrow-right-line ml-1"></i>
            </a>
          </div>
        </div>

        <!-- Layanan 3 -->
        <div class="service-card rounded-lg overflow-hidden shadow-md card-hover transition duration-300 hover-grow">
          <div class="card-image mobile-service-image">
            <img src="assets/layanan-operasional.jpg"
              alt="Pengadaan Kendaraan Operasional"
              class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
          </div>
          <div class="p-5 flex-grow">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Kendaraan Operasional</h3>
            <p class="text-sm text-gray-600 mb-4">
              Kami menyediakan solusi kendaraan untuk operasional perusahaan, instansi pemerintah, dan sektor swasta. ddKendaraan kami diperiksa secara berkala untuk menjaga performa optimal, dilengkapi dengan asuransi dan pengemudi berpengalaman sesuai kebutuhan Anda.
            </p>
            <a href="#" class="text-blue-600 hover:text-blue-700 font-medium flex items-center text-sm hover-grow">
              Selengkapnya <i class="ri-arrow-right-line ml-1"></i>
            </a>
          </div>
        </div>

        <!-- Layanan 4 -->
        <div class="service-card rounded-lg overflow-hidden shadow-md card-hover transition duration-300 hover-grow">
          <div class="card-image mobile-service-image">
            <img src="assets/layanan-harianbulanan.png"
              alt="Sewa Harian/Bulanan"
              class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
          </div>
          <div class="p-5 flex-grow">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Sewa Harian/Bulanan</h3>
            <p class="text-sm text-gray-600 mb-4">
              Layanan fleksibel untuk kebutuhan pribadi, dinas, hingga keluarga tercinta. Kami menyediakan beragam pilihan kendaraan—mulai dari city car, MPV, hingga SUV—dilengkapi fitur-fitur terbaru. Tanpa ribet, cukup pesan—kendaraan langsung kami antar ke lokasi Anda!
            </p>
            <a href="#" class="text-blue-600 hover:text-blue-700 font-medium flex items-center text-sm hover-grow">
              Selengkapnya <i class="ri-arrow-right-line ml-1"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Cabang Kami -->
  <section class="py-16 px-6 bg-white mobile-padding">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-12">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3 section-title">Cabang Kami</h2>
        <p class="text-base text-gray-600 max-w-2xl mx-auto">
          Dengan tiga kantor cabang yang tersebar di Bandung, Jakarta, dan Purwakarta, kami siap memberikan pelayanan terbaik di setiap wilayah.
      </div>

      <div class="divider"></div>

      <div class="swiper branch-swiper">
        <div class="swiper-wrapper pb-8">

          <!-- Cabang 3 -->
          <div class="swiper-slide">
            <div class="branch-card rounded-xl overflow-hidden shadow-md hover-grow">
              <div class="h-40 sm:h-48 overflow-hidden relative mobile-branch-image">
                <img src="assets/bandungcity.jpeg"
                  alt="Bandung"
                  class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4">
                  <h3 class="text-lg font-bold text-white">Bandung</h3>
                </div>
              </div>
              <div class="p-5">
                <div class="flex items-start mb-3">
                  <i class="ri-map-pin-line text-blue-600 mt-0.5 mr-2"></i>
                  <p class="text-sm text-gray-600">Jl. Sumber Sari No.77, RT.005/RW.008, Cisaranten Kulon, Kec. Arcamanik, Kota Bandung, Jawa Barat 40293</p>
                </div>
                <div class="flex items-start mb-4">
                  <i class="ri-phone-line text-blue-600 mt-0.5 mr-2"></i>
                  <p class="text-sm text-gray-600">+62 813-2153-5220</p>
                </div>
                <a href="https://wa.me/6281234567892" class="bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white px-4 py-2 rounded-full text-sm font-medium transition flex items-center justify-center w-full shadow hover-grow">
                  <i class="ri-whatsapp-line mr-1.5"></i> Hubungi Kami
                </a>
              </div>
            </div>
          </div>

          <!-- Cabang 1 -->
          <div class="swiper-slide">
            <div class="branch-card rounded-xl overflow-hidden shadow-md hover-grow">
              <div class="h-40 sm:h-48 overflow-hidden relative mobile-branch-image">
                <img src="assets/jakartacity.jpeg"
                  alt="Jakarta"
                  class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4">
                  <h3 class="text-lg font-bold text-white">Jakarta</h3>
                </div>
              </div>
              <div class="p-5">
                <div class="flex items-start mb-3">
                  <i class="ri-map-pin-line text-blue-600 mt-0.5 mr-2"></i>
                  <p class="text-sm text-gray-600">Jl. Kemang Dalam XI No.E9 Blok E, RT.5/RW.3, Bangka, Mampang Prapatan, South Jakarta City, Jakarta 12730</p>
                </div>
                <div class="flex items-start mb-4">
                  <i class="ri-phone-line text-blue-600 mt-0.5 mr-2"></i>
                  <p class="text-sm text-gray-600">+62 813-2445-0510</p>
                </div>
                <a href="https://wa.me/6281234567890" class="bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white px-4 py-2 rounded-full text-sm font-medium transition flex items-center justify-center w-full shadow hover-grow">
                  <i class="ri-whatsapp-line mr-1.5"></i> Hubungi Kami
                </a>
              </div>
            </div>
          </div>

          <!-- Cabang 2 -->
          <div class="swiper-slide">
            <div class="branch-card rounded-xl overflow-hidden shadow-md hover-grow">
              <div class="h-40 sm:h-48 overflow-hidden relative mobile-branch-image">
                <img src="assets/purwakartacity.jpeg"
                  alt="Purwakarta"
                  class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4">
                  <h3 class="text-lg font-bold text-white">Purwakarta</h3>
                </div>
              </div>
              <div class="p-5">
                <div class="flex items-start mb-3">
                  <i class="ri-map-pin-line text-blue-600 mt-0.5 mr-2"></i>
                  <p class="text-sm text-gray-600">Kp. Cibendasari RT.005/RW.002, Cipinang, Cibatu, Kab. Purwakarta, Jawa Barat</p>
                </div>
                <div class="flex items-start mb-4">
                  <i class="ri-phone-line text-blue-600 mt-0.5 mr-2"></i>
                  <p class="text-sm text-gray-600">+62 851-7407-2424</p>
                </div>
                <a href="https://wa.me/6281234567891" class="bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white px-4 py-2 rounded-full text-sm font-medium transition flex items-center justify-center w-full shadow hover-grow">
                  <i class="ri-whatsapp-line mr-1.5"></i> Hubungi Kami
                </a>
              </div>
            </div>
          </div>




        </div>
        <div class="swiper-pagination !relative !mt-6"></div>
      </div>
    </div>
  </section>

  <!-- Kenapa Memilih Kami -->
  <section class="py-16 px-6 bg-gradient-to-b from-indigo-50 to-blue-50 mobile-padding">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-col lg:flex-row items-center mobile-flex-col">
        <div class="lg:w-1/2 mb-8 lg:mb-0 lg:pr-8 mobile-w-full">
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1583&q=80"
              alt="Why Choose Us"
              class="w-full h-auto rounded-xl shadow-lg hover-grow">
            <div class="absolute -bottom-3 -right-3 bg-white p-3 rounded-lg shadow-md hover-grow">
              <div class="flex items-center">
                <div class="bg-blue-100 p-2 rounded-full mr-2">
                  <i class="ri-time-line text-blue-600"></i>
                </div>
                <div>
                  <p class="font-bold text-gray-800 text-sm">24/7</p>
                  <p class="text-xs text-gray-600">Layanan Pelanggan</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="lg:w-1/2 mobile-w-full mobile-mt-8">
          <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full inline-flex items-center mb-4 hover-grow">
            <i class="ri-award-fill text-yellow-500 mr-1"></i>
            <span class="font-medium text-sm">Layanan Terbaik 2023</span>
          </div>
          <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Kenapa Memilih Kami?</h2>

          <div class="space-y-4">
            <div class="flex bg-white/90 backdrop-blur-sm p-4 rounded-lg shadow-sm hover-grow">
              <div class="bg-blue-100 w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center mr-3">
                <i class="ri-verified-badge-line text-blue-600"></i>
              </div>
              <div>
                <h4 class="text-base font-semibold text-gray-800 mb-1">Kualitas Armada Premium</h4>
                <p class="text-xs text-gray-600">
                  Unit kendaraan kami selalu dalam kondisi prima dan dilengkapi fitur-fitur modern.
                </p>
              </div>
            </div>

            <div class="flex bg-white/90 backdrop-blur-sm p-4 rounded-lg shadow-sm hover-grow">
              <div class="bg-blue-100 w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center mr-3">
                <i class="ri-user-star-line text-blue-600"></i>
              </div>
              <div>
                <h4 class="text-base font-semibold text-gray-800 mb-1">Tim Profesional</h4>
                <p class="text-xs text-gray-600">
                  Kami memiliki sopir berpengalaman dan tim operasional bersertifikat.
                </p>
              </div>
            </div>

            <div class="flex bg-white/90 backdrop-blur-sm p-4 rounded-lg shadow-sm hover-grow">
              <div class="bg-blue-100 w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center mr-3">
                <i class="ri-shield-check-line text-blue-600"></i>
              </div>
              <div>
                <h4 class="text-base font-semibold text-gray-800 mb-1">Standar Keamanan Tinggi</h4>
                <p class="text-xs text-gray-600">
                  Setiap kendaraan dilengkapi GPS tracker, seatbelt aktif, dan asuransi perjalanan.
                </p>
              </div>
            </div>

            <div class="flex bg-white/90 backdrop-blur-sm p-4 rounded-lg shadow-sm hover-grow">
              <div class="bg-blue-100 w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center mr-3">
                <i class="ri-customer-service-line text-blue-600"></i>
              </div>
              <div>
                <h4 class="text-base font-semibold text-gray-800 mb-1">Layanan Ramah</h4>
                <p class="text-xs text-gray-600">
                  Komunikasi cepat dan solusi fleksibel untuk setiap kebutuhan pelanggan.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Mitra Kami -->
  <section class="py-12 px-6 bg-white mobile-padding">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3 section-title">Mitra Kami</h2>
        <p class="text-base text-gray-600 max-w-2xl mx-auto">
          Kami dipercaya oleh berbagai perusahaan ternama untuk menyediakan solusi transportasi mereka.
        </p>
      </div>

      <div class="divider"></div>

      <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 gap-4 items-center">
        <img src="assets/adhi.jpeg" alt="Toyota" class="h-28 mx-auto opacity-80 hover:opacity-100 transition">
        <img src="assets/wika.jpeg" alt="Honda" class="h-36 mx-auto opacity-80 hover:opacity-100 transition">
        <img src="assets/genpower.jpg" alt="Mitsubishi" class="h-20 mx-auto opacity-80 hover:opacity-100 transition">
      </div>
    </div>
  </section>

  <!-- Testimoni -->
  <section class="py-16 px-6 bg-gradient-to-b from-blue-50 to-indigo-50 mobile-padding">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-12">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3 section-title">Apa Kata Mereka?</h2>
        <p class="text-base text-gray-600 max-w-2xl mx-auto">
          Testimoni dari pelanggan yang telah menggunakan layanan kami.
        </p>
      </div>

      <div class="divider"></div>

      <div class="swiper testimonial-swiper">
        <div class="swiper-wrapper pb-8">
          <!-- Testimoni 1 -->
          <div class="swiper-slide">
            <div class="bg-white rounded-lg p-5 shadow-md testimonial-card h-full mobile-testimonial-padding hover-grow">
              <div class="flex items-center mb-4">
                <img src="assets/defaultprofile.jpeg" alt="User" class="w-12 h-12 rounded-full object-cover mr-3">
                <div>
                  <h4 class="font-bold text-gray-800 text-sm">Sarah Wijaya</h4>
                  <p class="text-xs text-gray-600">Wedding Organizer</p>
                </div>
              </div>
              <p class="text-xs text-gray-600 mb-4">
                "Sangat puas menggunakan layanan wedding car dari Jocar Trans. Mobilnya bersih, sopirnya profesional, dan tepat waktu."
              </p>
              <div class="flex">
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
              </div>
            </div>
          </div>

          <!-- Testimoni 2 -->
          <div class="swiper-slide">
            <div class="bg-white rounded-lg p-5 shadow-md testimonial-card h-full mobile-testimonial-padding hover-grow">
              <div class="flex items-center mb-4">
                <img src="assets/defaultprofile.jpeg" alt="User" class="w-12 h-12 rounded-full object-cover mr-3">
                <div>
                  <h4 class="font-bold text-gray-800 text-sm">Budi Santoso</h4>
                  <p class="text-xs text-gray-600">Business Owner</p>
                </div>
              </div>
              <p class="text-xs text-gray-600 mb-4">
                "Sudah 2 tahun menggunakan layanan pengadaan kendaraan operasional dari Jocar Trans untuk perusahaan kami."
              </p>
              <div class="flex">
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-half-fill text-yellow-400 text-sm"></i>
              </div>
            </div>
          </div>

          <!-- Testimoni 3 -->
          <div class="swiper-slide">
            <div class="bg-white rounded-lg p-5 shadow-md testimonial-card h-full mobile-testimonial-padding hover-grow">
              <div class="flex items-center mb-4">
                <img src="assets/defaultprofile.jpeg" alt="User" class="w-12 h-12 rounded-full object-cover mr-3">
                <div>
                  <h4 class="font-bold text-gray-800 text-sm">Dewi Lestari</h4>
                  <p class="text-xs text-gray-600">Travel Enthusiast</p>
                </div>
              </div>
              <p class="text-xs text-gray-600 mb-4">
                "Liburan keluarga ke Bandung menggunakan Fortuner dari Jocar Trans sangat menyenangkan. Mobilnya nyaman."
              </p>
              <div class="flex">
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
              </div>
            </div>
          </div>

          <!-- Testimoni 4 -->
          <div class="swiper-slide">
            <div class="bg-white rounded-lg p-5 shadow-md testimonial-card h-full mobile-testimonial-padding hover-grow">
              <div class="flex items-center mb-4">
                <img src="assets/defaultprofile.jpeg" alt="User" class="w-12 h-12 rounded-full object-cover mr-3">
                <div>
                  <h4 class="font-bold text-gray-800 text-sm">Andi Pratama</h4>
                  <p class="text-xs text-gray-600">Corporate Employee</p>
                </div>
              </div>
              <p class="text-xs text-gray-600 mb-4">
                "Sewa harian untuk meeting di Jakarta dengan Pajero sangat memuaskan. AC-nya dingin, kursinya nyaman."
              </p>
              <div class="flex">
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-fill text-yellow-400 text-sm"></i>
                <i class="ri-star-line text-yellow-400 text-sm"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-pagination !relative !mt-6"></div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-16 px-6 bg-gradient-to-r from-blue-600 to-blue-400 mobile-padding">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Siap Memesan Armada Impian Anda?</h2>
      <p class="text-base text-blue-100 mb-6">
        Hubungi kami sekarang dan dapatkan penawaran spesial untuk pemesanan pertama Anda!
      </p>
      <div class="flex flex-col sm:flex-row justify-center gap-3">
        <a href="https://wa.me/6281234567890" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-full font-bold transition flex items-center justify-center shadow-lg text-sm hover-grow">
          <i class="ri-whatsapp-line mr-2"></i> WhatsApp Kami
        </a>
        <a href="tel:02112345678" class="bg-blue-800 text-white hover:bg-blue-900 px-6 py-3 rounded-full font-bold transition flex items-center justify-center shadow-lg text-sm hover-grow">
          <i class="ri-phone-line mr-2"></i> Telepon Sekarang
        </a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer id="contact" class="bg-gray-900 text-gray-300 pt-16 pb-8 px-6 mobile-padding">
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
        <div>
          <div class="flex items-center mb-4">
            <img src="assets/logo light.png" alt="Jocar Trans Logo" class="h-20 w-auto object-contain  mr-3 my-0" />
            <span class="text-md font-bold text-white-800">Jocar Trans Indonesia</span>
          </div>
          <p class="mb-4 text-sm">
            Solusi transportasi premium untuk semua kebutuhan perjalanan Anda.
          </p>
          <div class="flex space-x-3">
            <a href="#" class="bg-gray-800 hover:bg-gray-700 w-8 h-8 rounded-full flex items-center justify-center transition hover-grow">
              <i class="ri-facebook-fill text-sm"></i>
            </a>
            <a href="#" class="bg-gray-800 hover:bg-gray-700 w-8 h-8 rounded-full flex items-center justify-center transition hover-grow">
              <i class="ri-instagram-line text-sm"></i>
            </a>
            <a href="#" class="bg-gray-800 hover:bg-gray-700 w-8 h-8 rounded-full flex items-center justify-center transition hover-grow">
              <i class="ri-twitter-x-line text-sm"></i>
            </a>
          </div>
        </div>

        <div>
          <h3 class="text-base font-semibold text-white mb-3">Menu</h3>
          <ul class="space-y-2">
            <li><a href="#home" class="hover:text-white transition text-sm hover-grow">Beranda</a></li>
            <li><a href="#catalog" class="hover:text-white transition text-sm hover-grow">Katalog</a></li>
            <li><a href="#services" class="hover:text-white transition text-sm hover-grow">Layanan</a></li>
            <li><a href="#" class="hover:text-white transition text-sm hover-grow">Cabang</a></li>
            <li><a href="#" class="hover:text-white transition text-sm hover-grow">Tentang Kami</a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-base font-semibold text-white mb-3">Layanan</h3>
          <ul class="space-y-2">
            <li><a href="#" class="hover:text-white transition text-sm hover-grow">Wedding Car</a></li>
            <li><a href="#" class="hover:text-white transition text-sm hover-grow">Trip Organizer</a></li>
            <li><a href="#" class="hover:text-white transition text-sm hover-grow">Pengadaan Kendaraan</a></li>
            <li><a href="#" class="hover:text-white transition text-sm hover-grow">Sewa Harian</a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-base font-semibold text-white mb-3">Kontak Kami</h3>
          <ul class="space-y-2">
            <li class="flex items-start">
              <i class="ri-map-pin-line mt-0.5 mr-2 text-sm"></i>
              <span class="text-sm">Bandung, Jakarta, Purwakarta</span>
            </li>

            <li class="flex items-start">
              <i class="ri-phone-line mt-0.5 mr-2 text-sm"></i>
              <span class="text-sm">+62 813-2153-5220</span>
            </li>
            <li class="flex items-start">
              <i class="ri-mail-line mt-0.5 mr-2 text-sm"></i>
              <span class="text-sm">jocartransindonesia@gmail.com</span>
            </li>
            <li class="flex items-start">
              <i class="ri-time-line mt-0.5 mr-2 text-sm"></i>
              <span class="text-sm">08.00 - 22.00 WIB</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="pt-6 border-t border-gray-800 text-center text-xs">
        <p>&copy; 2023 Jocar Trans Indonesia. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Back to Top Button -->
  <button id="back-to-top" class="fixed bottom-6 right-6 bg-gradient-to-r from-blue-600 to-blue-400 hover:from-blue-700 hover:to-blue-500 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg transition opacity-0 invisible floating-button">
    <i class="ri-arrow-up-line text-sm"></i>
  </button>
</body>
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/scrollreveal"></script>
<script src="assets/js/landing-page.js"></script>

</html>