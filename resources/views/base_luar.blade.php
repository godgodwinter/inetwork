<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>iNetwork - @yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset("Arsha/") }}/assets/img/favicon.png" rel="icon">
  <link href="{{ asset("Arsha/") }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset("Arsha/") }}/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ asset("Arsha/") }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset("Arsha/") }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset("Arsha/") }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset("Arsha/") }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{ asset("Arsha/") }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ asset("Arsha/") }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset("Arsha/") }}/assets/css/style.css" rel="stylesheet">

  @yield('csshere')
  <!-- =======================================================
  * Template Name: Arsha - v4.1.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="{{ url('/')}}"><I>iNetwork</I></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="{{ asset("Arsha/") }}/assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{ url('/')}}/#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="{{ url('/')}}/#about">Tentang</a></li>
          <li><a class="nav-link scrollto" href="{{ url('/')}}/#services">Penggunaan</a></li>
          {{-- <li><a class="getstarted scrollto" href="{{ url('/')}}/cari">Cari</a></li> --}}

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>SISTEM PENUNJANG USAHA</h1>
          <h2>JARINGAN</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="{{ url('/')}}/login" class="btn-get-started scrollto">Masuk</a>
            {{-- <a href="{{ url('/')}}/cari" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Cari NIK</span></a> --}}
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="{{ asset("Arsha/") }}/assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Cliens Section ======= -->
    <section id="cliens" class="cliens section-bg">
      <div class="container">

        <div class="row" data-aos="zoom-in">

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset("Arsha/") }}/assets/img/clients/malang.svg" class="img-fluid" alt="">
          </div>



        </div>

      </div>
    </section><!-- End Cliens Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Tentang <b><i>Sistem</i></b></h2>
        </div>

        <div class="row content">
          <div class="col-lg-12">
            <p>
                Semakin berkembangnya suatu usaha semakin banyak pula data yang kita milik. Untuk mengelola data-data tersebut.
            </p>
            <p>
               Dengan Sistem iNetwork ini diharapkan dapat membatu dalam usaha anda.
            </p>

          </div>

        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Why Us Section ======= -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Penggunaan</h2>
          {{-- <p>Pengambilan bantuan dapat di ambil oleh orang yang bersangkutan atau diwakilkan orang dalam satu KK.</p> --}}
        </div>

        <div class="row">
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
                <div class="icon"><i class="bx bx-layer"></i></div>
              <h4><a href="">Data</a></h4>
              <p>Siapkan data anda.</p>
            </div>
          </div>


          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Masuk sebagai admin</a></h4>
              <p>Agar dapat mengelola data anda harus masuk sebagai Administrator.</p>
            </div>
          </div>



        </div>

      </div>
    </section><!-- End Services Section -->

  <!-- ======= Footer ======= -->
  <footer id="footer">



    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>2021</span> by TeamFomo</strong>.
        &copy; Copyright Template by <strong><span>Arsha</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset("Arsha/") }}/assets/vendor/aos/aos.js"></script>
  <script src="{{ asset("Arsha/") }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset("Arsha/") }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ asset("Arsha/") }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ asset("Arsha/") }}/assets/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset("Arsha/") }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset("Arsha/") }}/assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset("Arsha/") }}/assets/js/main.js"></script>

</body>

</html>
