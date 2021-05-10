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
          <li><a class="nav-link scrollto" href="{{ url('/')}}/#fitur">Fitur</a></li>
          <li><a class="nav-link scrollto" href="{{ url('/')}}/#pengembangan">Pengembangan</a></li>
          <li><a class="nav-link scrollto" href="{{ url('/')}}/#harga">Harga</a></li>
          <li><a class="nav-link scrollto" href="{{ url('/')}}/#team">Team</a></li>
          <li><a class="getstarted scrollto" href="{{ url('/')}}/login">Mulai</a></li>
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
          <h1>DEMO APLIKASI</h1>
          <h2>USER : admin@gmail.com</h2>
          <h2>PASS : 12345678</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            {{-- <a href="{{ url('/')}}/login" class="btn-get-started scrollto">Masuk</a> --}}
            <a href="https://github.com/godgodwinter/inetwork" class="glightbox btn-watch-video"><i class="ri-github-fill"></i><span>Github iNetwork</span></a>
            <a href="{{ url('/')}}/login" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Coba Sekarang</span></a>
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
                <img src="{{ asset("img/") }}/chrome.png" class="img-fluid" alt="">
              </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset("img/") }}/mikrotik.png" class="img-fluid" alt="">
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
                Sistem untuk membantu mengelola data Keuangan dan Usaha Internet. Menggunakan :
            </p>
            <ul>
                <li><i class="ri-check-double-line"></i> Laravel versi 8.5</li>
                <li><i class="ri-check-double-line"></i> Bootstrap Template Arsha</li>
                <li><i class="ri-check-double-line"></i>  Bootstrap Template Adminty</li>
              </ul>

          </div>
          <div class="row content">
            <div class="col-lg-12">
              <p>
                  Gunakan :
              </p>
              <ul>
                  <li><i class="ri-check-double-line"></i> Chrome Terbaru</li>
                  <li><i class="ri-check-double-line"></i> Nginx</li>
                  <li><i class="ri-check-double-line"></i> Php 7+</li>
                  <li><i class="ri-check-double-line"></i> Composer v2+</li>
                </ul>

            </div>

        </div>

      </div>
    </section><!-- End About Us Section -->


    <!-- ======= Why Us Section ======= -->
    <section id="fitur" class="why-us section-bg">
        <div class="container-fluid" data-aos="fade-up">

          <div class="row">

            <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

              <div class="content">
                <h3><strong>Fitur</strong></h3>
                <p>
                 Sistem masih dalam tahap pengembangan. Beberapa fitur yang sudah ditambahkan :
                </p>
              </div>

              <div class="accordion-list">
                <ul>
                  <li>
                    <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>01</span> Rekap Pemasukan <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                      <p>
                        Pemasukan atau pendapatan selain dari internet dapat di cetak, backup maupun di import apabila data sudah ada.
                      </p>
                    </div>
                  </li>

                  <li>
                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>02</span> Rekap Pengeluaran<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                        <p>
                            Pengeluaran selain dari internet dapat di cetak, backup maupun di import apabila data sudah ada.
                          </p>
                    </div>
                  </li>

                  <li>
                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>03</span> Rekap data Pelanggan Internet <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                      <p>
                        Data Paket Internet, Data Pelanggan Internet dan Pembayaran tagihan dapat di cetak , backup,  maupun di import apabila sudah ada.
                      </p>
                    </div>
                  </li>

                  <li>
                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>04</span> Rekap Pendapatan Bersih<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                      <p>
                       Pendapata bersih dapat di cetak per bulan yang di pilih.
                      </p>
                    </div>
                  </li>

                </ul>
              </div>

            </div>

            <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("{{ asset("Arsha/") }}/assets/img/why-us.png");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
          </div>

        </div>
      </section><!-- End Why Us Section -->


    <!-- ======= Why Us Section ======= -->
    <section id="pengembangan" class="why-us section-bg">
        <div class="container-fluid" data-aos="fade-up">

          <div class="row">

            <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

              <div class="content">
                <h3><strong>Pengembangan</strong></h3>
                <p>
                 Beberapa fitur yang masih dalam proses pengembangan :
                </p>
              </div>

              <div class="accordion-list">
                <ul>
                  <li>
                    <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>01</span> Mobile Version <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                      <p>
                        Bentuk Aplikasi mobile yang terhubung dengan server web ini.(Flutter)
                      </p>
                    </div>
                  </li>

                  <li>
                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>02</span> Setting On/Off PPOE<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                        <p>
                            Untuk memudah kan pengguna RT/RW net dalam disable/mengaktifkan pelanggan yang sudah terlambat membayar atau berhenti. (RouterosOS)
                          </p>
                    </div>
                  </li>

                  <li>
                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>03</span> Buat Halaman pelanggan Internet<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                      <p>
                        Menu pelanggan tanpa login cek rekap pembayaran yang sudah dilakukan di bulan ini atau sebelumnya.
                      </p>
                    </div>
                  </li>

                  <li>
                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>04</span> Rekap Pendapatan Bersih<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                      <p>
                       Pendapata bersih dapat di cetak per bulan yang di pilih.
                      </p>
                    </div>
                  </li>

                </ul>
              </div>

            </div>

            <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("{{ asset("Arsha/") }}/assets/img/why-us.png");' data-aos="zoom-out" data-aos-delay="150">&nbsp;</div>
          </div>

        </div>
      </section><!-- End Why Us Section -->

       <!-- ======= Pricing Section ======= -->
    <section id="harga" class="pricing">
        <div class="container" data-aos="fade-up">

          <div class="section-title">
            <h2>HARGA</h2>
            <p>Gratis untuk menggunakan versi Alpha (Tahap pengembangan awal).</p>
          </div>

          <div class="row">

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
              <div class="box">
                <h3>Gratis Penggunakan</h3>
                <h4><sup>Rp</sup>0<span>versi Alpha</span></h4>
                <ul>
                  <li><i class="bx bx-check"></i> Semua fitur versi ini</li>
                  <li class="na"><i class="bx bx-x"></i> <span>Server</span></li>
                  <li class="na"><i class="bx bx-x"></i> <span>Pemasangan</span></li>
                    <li class="na"><i class="bx bx-x"></i> <span>Support</span></li>
                </ul>
                <a href="#" class="buy-btn">Get Started</a>
              </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
              <div class="box featured">
                <h3>Bantu Installasi</h3>
                <h4><sup>Rp</sup>900.000,00<span>bayar sekali (Sudah termasuk server 1th)</span></h4>
                <ul>
                    <li><i class="bx bx-check"></i> Semua fitur versi ini</li>
                    <li><i class="bx bx-check"></i> <span>Server Kapasitas 3GB + gratis domain 1th</span> (Rp.500.000)</li>
                    <li ><i class="bx bx-check"></i> <span>Pemasangan Installasi SSH, Laravel, debuggin awal 1 bulan</span>(Rp.400.000)</li>
                      <li><i class="bx bx-check"></i> <span>Support 2 minggu setelah pemasangan selesai</span></li>
                </ul>
                <a href="#" class="buy-btn">Get Started</a>
              </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
              <div class="box">
                <h3>Support</h3>
                <h4><sup>Rp</sup>900.000,00<span>bayar sekali (Sudah termasuk server 1th)</span></h4>
                <h4><sup>+Rp</sup>100.000,00<span>per bulan</span></h4>
                <ul>
                    <li><i class="bx bx-check"></i> Semua fitur versi ini</li>
                    <li><i class="bx bx-check"></i> <span>Server Kapasitas 3GB + gratis domain 1th</span> (Rp.500.000)</li>
                    <li ><i class="bx bx-check"></i> <span>Pemasangan Installasi SSH, Laravel, debuggin awal 1 bulan</span>(Rp.400.000)</li>
                      <li><i class="bx bx-check"></i> <span>Support</span></li>
                </ul>
                <a href="#" class="buy-btn">Get Started</a>
              </div>
            </div>

          </div>

        </div>
      </section><!-- End Pricing Section -->

      <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">

          <div class="section-title">
            <h2>TeamFOMO</h2>
            <p>Team Pengembang Saat ini.</p>
          </div>

          <div class="row">

            <div class="col-lg-6">
              <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                <div class="pic"><img src="{{ asset("img/") }}/logo2.png" class="img-fluid" alt=""></div>
                <div class="member-info">
                  <h4>Kukuh Setya N</h4>
                  <span>Developer</span>
                  <p>F**k with fundamental, we love sh*t coin xD</p>
                  <div class="social">
                    <a href="https://github.com/godgodwinter" target="_blank"><i class="ri-github-fill"></i></a>
                    <a href="https://saweria.co/kakadlz" target="_blank"><i class="ri-money-dollar-circle-fill"></i></a>
                    <a href="http://instagram.com/kukuh.sn" target="_blank"><i class="ri-instagram-fill"></i></a>
                    <a href="https://api.whatsapp.com/send?phone=6285736862399" target="_blank"> <i class="ri-whatsapp-fill"></i> </a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mt-4 mt-lg-0">
              <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="200">
                <div class="pic"><img src="{{ asset("img/") }}/logo1.jpg" class="img-fluid" alt=""></div>
                <div class="member-info">
                  <h4>M Yusri F</h4>
                  <span>Developer</span>
                  <p></p>
                  <div class="social">
                    <a href="#"><i class="ri-instagram-fill"></i></a>
                    <a href="#"> <i class="ri-linkedin-box-fill"></i> </a>
                  </div>
                </div>
              </div>
            </div>


          </div>

        </div>
      </section><!-- End Team Section -->

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
