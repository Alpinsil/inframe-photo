<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>INFRAME PHOTO</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: Jun 06 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Inframe Photo</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Beranda</a></li>
          <?php if (session()->get('role') != null) { ?>

            <li><a href="#about">Tentang</a></li>
          <?php } ?>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#pricing">Katalog</a></li>

          <?php

          if (session()->get('role') === 'admin') {

          ?>
            <li class="d-lg-none"><a href="/kelola-admin">Kelola Web</a></li>
            <li class="d-lg-none"><a href="/logout">Logout</a></li>
          <?php
          } elseif (session()->get('role') === 'guest') { ?>
            <li class="d-lg-none"><a href="/profile">Profile</a></li>
            <li class="d-lg-none"><a href="/">Home</a></li>
            <li class="d-lg-none"><a href="/chat-to-guest?id=1">Chat</a></li>
            <li class="d-lg-none"><a href="/list-orders-guest">Daftar Pesanan</a></li>
            <li class="d-lg-none"><a href="/logout">Logout</a></li>
          <?php } ?>
          <!-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li> -->
          <!-- <li><a href="#contact">Contact</a></li> -->
          <?php
          if (session()->get('role') === 'guest') { ?>
            <ul>
              <li class="dropdown"><a href="#"><span>Hi, <?= ucfirst(session()->get('user_name')) ?></span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="/profile">Profile</a></li>
                  <li><a href="/">Home</a></li>
                  <li><a href="/chat-to-guest?id=1">Chat</a></li>
                  <li><a href="/list-orders-guest">Daftar Pesanan</a></li>
                  <li><a href="/logout">Logout</a></li>
                </ul>
              </li>
            </ul>
          <?php
          } elseif (session()->get('role') === 'admin') { ?>
            <ul>
              <li class="dropdown"><a href="#"><span>Hi, <?= ucfirst(session()->get('user_name')) ?></span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="/kelola-admin">Kelola Web</a></li>
                  <li><a href="/logout">Logout</a></li>
                </ul>
              </li>
            </ul>
          <?php
          } else { ?>
            <a class="btn-getstarted" href="/login">Login</a>
          <?php } ?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>



      </nav>
    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
            <h1>Abadikan Momenmu</h1>
            <p>Agar dikenang selamanya</p>
            <div class="">
              <?php if (session()->get('role') == null) { ?>

                <a href="/register" class="btn-get-started">Daftar</a>
                <p>Masuk ke akun Anda untuk mengeksplorasi portofolio kami, melihat penawaran eksklusif, dan memesan sesi foto profesional kami. Daftar Sekarang</p>
              <?php } ?>
              <!-- <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> -->
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->


    <?php if (session()->get('role') != null) { ?>

      <!-- About Section -->
      <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Tentang</h2>
        </div><!-- End Section Title -->

        <div class="container">

          <div class="row gy-4">

            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
              <p>
                Menciptakan Karya Visual yang Memukau dengan Pengalaman Profesional Bersama Kam
              </p>
              <ul>
                <li><i class="bi bi-check2-circle"></i> <span>Pengalaman lebih dari 5 tahun dalam industri fotografi.</span></li>
                <li><i class="bi bi-check2-circle"></i> <span>Layanan personalisasi sesuai kebutuhan klien.</span></li>
                <li><i class="bi bi-check2-circle"></i> <span>Fotografer berpengalaman dan kreatif.</span></li>
              </ul>
            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
              <p>Inframe Photo merupakan penyedia layanan fotografi profesional yang berdedikasi untuk mengabadikan setiap momen istimewa . Dengan tim yang berpengalaman dan peralatan canggih, kami menawarkan berbagai layanan fotografi mulai dari prewedding, wedding, dan engagement. Dedikasi kami adalah memastikan setiap klien mendapatkan hasil yang memuaskan sesuai harapan dan impian klien.</p>
              <!-- <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a> -->
            </div>

          </div>

        </div>

      </section><!-- /About Section -->
    <?php } ?>


    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p>Hasil Karya Kami: Dari Inframe Photo.</p>
        <p>Telusuri hasil-hasil terbaik kami dalam berbagai kategori seperti prewedding, wedding, dan engagement. Setiap foto mencerminkan komitmen kami terhadap kualitas dan kreativitas.</p>
        <?php if (session()->get('role') == null) { ?>
        <?php } ?>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <?php if (session()->get('role') != null) { ?>
            <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
              <li data-filter="*" class="filter-active">All</li>

              <?php foreach ($tags as $key) { ?>
                <li data-filter=".<?= $key['slug']; ?>"><?= $key['name']; ?></li>
              <?php } ?>
            </ul><!-- End Portfolio Filters -->
          <?php } ?>


          <?php foreach ($portfolio as  $key) { ?>
            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
              <div class="col-lg-4 col-md-6 portfolio-item isotope-item <?= $key['slug']; ?>">
                <img src="assets/portfolio/<?= $key['image']; ?>" class="rounded-3" alt="" width="400px" height="400px">
                <div class="portfolio-info">
                  <h4><?= $key['name']; ?></h4>
                  <!-- <p>Lorem ipsum, dolor sit</p> -->
                  <!-- <a href="assets/img/masonry-portfolio/masonry-portfolio-1.jpg" title="App 1" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a> -->
                  <!-- <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a> -->
                </div>
              </div><!-- End Portfolio Item -->
            <?php } ?>




            </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->

    <?php if (session()->get('role') != null) { ?>
      <!-- Pricing Section -->
      <section id="pricing" class="pricing section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Katalog</h2>
          <p>Temukan Paket Fotografi yang Sesuai dengan Kebutuhan Anda.</p>
          <p>Kami menawarkan berbagai paket layanan fotografi yang fleksibel sesuai kebutuhan Lihat detail setiap paket di bawah ini:</p>
        </div><!-- End Section Title -->

        <div class="container">

          <div class="row gy-4">

            <?php foreach ($services as $key) {
            ?>
              <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="pricing-item">
                  <h3><?= $key['name']; ?></h3>
                  <h4 class="price"><sup>Rp</sup> <?= $key['price']; ?><span></span></h4>
                  <img src="assets/services/<?= $key['image']; ?>" class=" rounded-3" width="200px" height="200px">
                  <ul>
                    <?php
                    $list_service = explode(',', $key['list_service']);
                    foreach ($list_service as $service) {
                      if (strlen(trim($service)) == 0) {
                        continue;
                      }
                    ?>
                      <li><i class="bi bi-check"></i> <span><?= $service; ?></span></li>
                    <?php } ?>
                    <!-- <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li> -->
                    <!-- <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li> -->
                    <!-- <li class="na"><i class="bi bi-x"></i> <span>Pharetra massa massa ultricies</span></li> -->
                    <!-- <li class="na"><i class="bi bi-x"></i> <span>Massa ultricies mi quis hendrerit</span></li> -->
                  </ul>
                  <a href="/payment/<?= $key['id']; ?>" class="buy-btn">Buy Now</a>
                </div>
              </div><!-- End Pricing Item -->
            <?php } ?>
          </div>

        </div>

      </section><!-- /Pricing Section -->
    <?php } ?>


    <!-- Faq 2 Section -->
    <section id="faq-2" class="faq-2 section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Frequently Asked Questions</h2>
        <p>Pertanyaan yang Sering Diajukan.</p>
        <p>Dapatkan jawaban atas pertanyaan yang sering muncul seputar layanan kami. Jika Anda memiliki pertanyaan lain, jangan ragu untuk menghubungi kami.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-10">

            <div class="faq-container">
              <?php foreach ($faq as $key) { ?>
                <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                  <i class="faq-icon bi bi-question-circle"></i>
                  <h3><?= $key['question']; ?></h3>
                  <div class="faq-content">
                    <p><?= $key['answer']; ?></p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->
              <?php } ?>




            </div>

          </div>

        </div>

      </div>

    </section><!-- /Faq 2 Section -->

  </main>

  <footer id="footer" class="footer">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class="sitename">Inframe Photo</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Beranda</a></li>
            <!-- <li><i class="bi bi-chevron-right"></i> <a href="#">Tentang</a></li> -->
            <li><i class="bi bi-chevron-right"></i> <a href="#">Katalog</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">FAQ</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12">
          <h4>Follow Us</h4>
          <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
          <div class="social-links d-flex">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <!-- <div class="container copyright text-center mt-4"> -->
    <!-- <p>© <span>Copyright</span> <strong class="px-1 sitename">Arsha</strong> <span>All Rights Reserved</span></p> -->
    <!-- <div class="credits"> -->
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you've purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
    <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
    <!-- </div> -->
    <!-- </div> -->

  </footer>

  <!-- <div class="scroll-top d-flex align-items-center justify-content-center top-3">
    <svg fill="#12fe01" height="200px" width="200px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 60 60" xml:space="preserve" stroke="#12fe01">
      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
      <g id="SVGRepo_iconCarrier">
        <path d="M30,1.5c-16.542,0-30,12.112-30,27c0,5.205,1.647,10.246,4.768,14.604c-0.591,6.537-2.175,11.39-4.475,13.689 c-0.304,0.304-0.38,0.769-0.188,1.153C0.276,58.289,0.625,58.5,1,58.5c0.046,0,0.093-0.003,0.14-0.01 c0.405-0.057,9.813-1.412,16.617-5.338C21.622,54.711,25.738,55.5,30,55.5c16.542,0,30-12.112,30-27S46.542,1.5,30,1.5z"></path>
      </g>
    </svg>
  </div> -->

  <!-- Scroll Top -->
  <a href="" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php if (session()->get('role') == 'guest') { ?>
    <a href="chat-to-guest?id=1" class="chat-icon d-flex align-items-center justify-content-center"><i class="bi bi-chat-fill"></i></a>
  <?php } ?>

  <!-- Preloader -->
  <div id="preloader"></div>

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script> -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js">
  </script>
  <script src="assets/js/register_script.js"></script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/jquery.maskMoney.min"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>