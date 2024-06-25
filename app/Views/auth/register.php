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

    <form action="/register" method="POST">
      <?= csrf_field(); ?>
      <div>
        <h1 class="text-center"><?= $title ?></h1>
      </div>
      <?php
      foreach ($input_fields as $key) { ?>
        <div class="form-group">
          <input type="<?= $key[1] ?>" class="form-control item <?= validation_show_error($key[0]) ? 'is-invalid' : ''; ?>" name="<?= $key[0] ?>" id="<?= $key[0] ?>" placeholder="<?= $key[0] == 'password2' ? 'Confirm Password' : ucwords($key[0]) ?>" value="<?= old($key[0]) ?>">
          <div class="invalid-feedback ml-3">
            <?= validation_show_error($key[0]); ?>
          </div>
        </div>
      <?php
      } ?>

      <div class="form-group">
        <button type="submit" class="btn btn-block create-account">Create Account</button>
      </div>
      <hr>
      <div class="text-center">
        <a href="/login" class="text-center">Already have account ? Login</a>
      </div>
    </form>
  </div>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js">
  </script>
  <script src="assets/js/register_script.js"></script>
</body>

</html>