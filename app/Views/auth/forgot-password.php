<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?></title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/register_style.css">
</head>

<body>
  <div class="registration-form">

    <?php if (session()->getFlashdata('otp_send')) { ?>

      <form action="/forgot-password-otp" method="POST">

      <?php } else { ?>
        <form action="/forgot-password" method="POST">

        <?php } ?>
        <?= csrf_field(); ?>

        <?php if (session()->getFlashdata('otp_send')) { ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('otp_send') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php
        } ?>

        <?php if (session()->getFlashdata('failed')) { ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('otp_send') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php
        } ?>

        <?php if (session()->getFlashdata('otp_wrong')) { ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('otp_wrong') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php
        } ?>

        <div>
          <h1 class="text-center"><?= $title ?></h1>
        </div>


        <?php if (!session()->getFlashdata('otp_send') || session()->getFlashdata('otp_wrong') ) { ?>

          <div class="form-group">
            <input type="email" name="email" placeholder="Masukkan email" class="form-control item" value=" <?= old('email') ?> ">
            <div class="invalid-feedback ml-3">
              <?= validation_show_error('email'); ?>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-block create-account">Send OTP</button>
          </div>

        <?php
        } else { ?>

          <div class="form-group">
            <input type="text" name="otp" placeholder="Masukkan OTP" class="form-control item <?= validation_show_error('otp') ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback ml-3">
              <?= validation_show_error('otp'); ?>
            </div>
          </div>


          <div class="form-group">
            <input type="password" name="password" placeholder="Masukkan Password baru" class="form-control item <?= validation_show_error('password') ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback ml-3">
              <?= validation_show_error('password'); ?>
            </div>
          </div>


          <div class="form-group">
            <input type="password" name="password2" placeholder="Konfirmasi Password" class="form-control item <?= validation_show_error('password2') ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback ml-3">
              <?= validation_show_error('password2'); ?>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-block create-account">Ubah Password</button>
          </div>
        <?php } ?>




        <hr>
        <div class="text-center">
          <a href="/login" class="text-center">Sudah punya akun ? Login</a>
        </div>
        </form>
  </div>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js">
  </script>
  <script src="assets/js/register_script.js"></script>
</body>

</html>