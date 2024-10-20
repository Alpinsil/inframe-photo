<?php
if (session()->get('role') == 'admin') {
  $data = [
    // ['name' => 'Kelola Admin', 'icon' => 'ni ni-tv-2 text-primary', 'link' => 'kelola-admin'],
    ['name' => 'Daftar Pesanan', 'icon' => 'ni ni-calendar-grid-58 text-warning', 'link' => 'list-order'],
    ['name' => 'Katalog', 'icon' => 'ni ni-single-copy-04 text-primary', 'link' => 'services'],
    ['name' => 'Metode Pembayaran', 'icon' => 'fa-solid fa-dollar-sign text-success', 'link' => 'payment-methods'],
    ['name' => 'FAQ', 'icon' => 'fa-solid fa-circle-question text-primary', 'link' => 'faq-admin'],
    ['name' => 'Tags', 'icon' => 'fa-solid fa-tag text-warning', 'link' => 'tags-admin'],
    ['name' => 'Portfolio', 'icon' => 'fa-solid fa-briefcase text-warning', 'link' => 'portfolio-admin'],
    ['name' => 'Chat', 'icon' => 'fa-solid fa-comments text-success', 'link' => 'chat-admin'],
    ['name' => 'Riwayat', 'icon' => 'fa-solid fa-history text-success', 'link' => 'riwayat-admin'],
  ];
} else {
  $data = [
    ['name' => 'Kelola Admin', 'icon' => 'ni ni-tv-2 text-primary', 'link' => 'dashboard'],
    ['name' => 'Chat', 'icon' => 'fa-solid fa-comments text-success', 'link' => 'chat-guest'],
    ['name' => 'Riwayat Pesanan', 'icon' => 'ni ni-calendar-grid-58 text-warning', 'link' => 'list-orders-guest'],
  ];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>
    <?= $title; ?>
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="assets/js/plugins/flatpickr.min.js"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link href="assets/DataTables/datatables.min.css" rel="stylesheet">

  <script src="assets/DataTables/datatables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap5.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <?php if (session()->get('role') != 'guest') { ?>
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
      <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="/">
          <img src="assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
          <span class="ms-1 font-weight-bold">Dashboard</span>
        </a>
      </div>
      <hr class="horizontal dark mt-0">

      <ul class="navbar-nav">
        <?php
        foreach ($data as $key) { ?>
          <li class="nav-item">
            <a class="nav-link <?= $key['link'] == uri_string() ? 'active' : '' ?>" href="/<?= $key['link']; ?>">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="<?= $key['icon']; ?> text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1"><?= $key['name']; ?></span>
            </a>
          </li>
        <?php
        }
        ?>
      </ul>
      <!-- <div class="sidenav-footer mx-3 ">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto" src="assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration">
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
            <h6 class="mb-0">Need help?</h6>
            <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
          </div>
        </div>
      </div>
      <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
      <a class="btn btn-primary btn-sm mb-0 w-100" href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
    </div> -->
    </aside>
    <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Halaman</a></li>
              <li class="breadcrumb-item text-sm text-white active" aria-current="page"><?= $title_up ?? ucfirst(str_replace('-', ' ', uri_string())); ?></li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0"><?= $title_up ??  ucfirst(str_replace('-', ' ', uri_string())); ?></h6>
          </nav>
          <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
              <div class="input-group">
                <!-- <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span> -->
                <!-- <input type="text" class="form-control" placeholder="Type here..."> -->
              </div>
            </div>
            <ul class="navbar-nav  justify-content-end">




              <li class="nav-item dropdown pe-2 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-white p-0 dropdown-toggle " id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-user me-sm-1"></i>
                  <span class="d-sm-inline d-none text-white"><?= session()->get('user_name'); ?></span>

                </a>
                <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">

                  <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="/profile">
                      Profile
                    </a>
                  </li>

                  <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="/">
                      Home
                    </a>
                  </li>

                  <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="/logout">
                      Logout
                    </a>
                  </li>

                </ul>
              </li>



              <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                  </div>
                </a>
            </ul>
          </div>
        </div>
      </nav>
    <?php } elseif (session()->get('role') == 'guest') { ?>
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Halaman</a></li>
              <li class="breadcrumb-item text-sm text-white active" aria-current="page"><?= $title_up ?? ucfirst(str_replace('-', ' ', uri_string())); ?></li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0"><?= $title_up ?? ucfirst(str_replace('-', ' ', uri_string())); ?></h6>
          </nav>
          <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
              <div class="input-group">
                <!-- <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span> -->
                <!-- <input type="text" class="form-control" placeholder="Type here..."> -->
              </div>
            </div>
            <ul class="navbar-nav  justify-content-end">




              <li class="nav-item dropdown pe-2 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-white p-0 dropdown-toggle " id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-user me-sm-1"></i>
                  <span class="d-sm-inline d-none text-white"><?= session()->get('user_name'); ?></span>

                </a>
                <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">

                  <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="/profile">
                      Profile
                    </a>
                  </li>

                  <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="/">
                      Home
                    </a>
                  </li>

                  <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="/chat-to-guest?id=1">
                      Chat
                    </a>
                  </li>

                  <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="/list-orders-guest">
                      Riwayat Pesanan
                    </a>
                  </li>

                  <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="/logout">
                      Logout
                    </a>
                  </li>

                </ul>
              </li>



              <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <!-- <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                  </div>
                </a> -->
            </ul>
          </div>
        </div>
      </nav>
    <?php } ?>
    <!-- End Navbar -->


    <div class="py-4">
      <?= $this->renderSection('content') ?>
    </div>
    </main>


    <script>
      $('#iconNavbarSidenav').on('click', (e) => {
        $('body').toggleClass('g-sidenav-pinned');
      })
    </script>

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="assets/js/plugins/chartjs.min.js"></script>
</body>


</html>