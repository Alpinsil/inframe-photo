<?php ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title; ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js">
  </script>

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

  <div class="container">
    <main>
      <div class="py-5 text-center">
        <h2>Formulir Pesanan</h2>
      </div>

      <div class="row g-5 d-flex justify-content-center">
        <div class="col-md-5 col-lg-4 order-md-last">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Detail paket</span>
            <!-- <span class="badge bg-primary rounded-pill">3</span> -->
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <div>
                <h6 class="my-0">Nama Paket: <span class="text-primary"><?= $service_data['name']; ?></span> </h6>
                <small class="text-muted">
                  <ul>
                    <?php
                    $list_service = explode(',', $service_data['list_service']);
                    foreach ($list_service as $service) {
                      if (strlen(trim($service)) == 0) {
                        continue;
                      }
                    ?>
                      <li><i class="bi bi-check"></i> <span><?= $service; ?></span></li>
                    <?php } ?>
                  </ul>

                </small>
              </div>
              <span class="text-muted d-inline-flex">
                Rp
                <p class="price"><?= $service_data['price']; ?></p>
              </span>
            </li>
            <!-- <li class="list-group-item d-flex justify-content-between lh-sm">
              <div>
                <h6 class="my-0">Second product</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted">$8</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <div>
                <h6 class="my-0">Third item</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted">$5</span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>EXAMPLECODE</small>
              </div>
              <span class="text-success">−$5</span>
            </li> -->
            <!-- <li class="list-group-item d-flex justify-content-between">
              <span>Total Rp</span>
              <strong>$20</strong>
            </li> -->
          </ul>
          <!-- 
          <form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code">
              <button type="submit" class="btn btn-secondary">Redeem</button>
            </div>
          </form> -->
          <img src="/assets/services/<?= $service_data['image']; ?>" class=" rounded-3" width="400px" height="500px">
        </div>




        <div class="col-md-7 col-lg-8">
          <form class="needs-validation" novalidate="" method="POST" enctype="multipart/form-data">
            <div class="row g-3">

              <div class="col-12">
                <label for="address" class="form-label">Nama</label>
                <input type="text" class="form-control <?= validation_show_error('name') ? 'is-invalid' : ''; ?>" id="name" value="<?= $user_data['name']; ?>" required="true">
                <div class="invalid-feedback">
                  <?= validation_show_error('name'); ?>
                </div>
              </div>

              <div class="col-8">
                <label for="address" class="form-label">Pilih Tanggal</label>
                <!-- <input type="date" class="form-control" id="name" name="date"  required="true"> -->
                <p>Date: <i class="fa-regular fa-calendar-days"></i> <input class="form-control <?= validation_show_error('date') ? 'is-invalid' : ''; ?>" type="text" name="date" id="datepicker"></p>

                <div class="invalid-feedback">
                  <?= validation_show_error('date'); ?>
                </div>
              </div>


              <!-- <div class="col-md-5">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" id="country" required="">
                  <option value="">Choose...</option>
                  <option>United States</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div> -->

              <!-- <div class="col-md-4">
                <label for="state" class="form-label">State</label>
                <select class="form-select" id="state" required="">
                  <option value="">Choose...</option>
                  <option>California</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>

              <div class="col-md-3">
                <label for="zip" class="form-label">Zip</label>
                <input type="text" class="form-control" id="zip" placeholder="" required="">
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div> -->
              <!-- 
              <hr class="my-4">

              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="same-address">
                <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
              </div>

              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="save-info">
                <label class="form-check-label" for="save-info">Save this information for next time</label>
              </div> -->

              <hr class="my-4">

              <h4 class="mb-3">Payment</h4>

              <div class="my-3">
                <?php foreach ($payment_methods_data as $key) { ?>
                  <div class="form-check">
                    <input id="credit" name="paymentMethod" value="<?= $key['id']; ?>" type="radio" class="form-check-input" checked="" required="">
                    <label class="form-check-label" for="credit"><?= $key['name']; ?> | <?= $key['norek']; ?> </label>
                  </div>
                <?php } ?>

              </div>

              <div class="col-12">
                <label for="address" class="form-label">Bukti Pembayaran</label>
                <input type="file" class="form-control" name="bukti_pembayaran" required="true">
                <div class="invalid-feedback">
                  Please enter your shipping address.
                </div>
              </div>

              <!-- <div class="row gy-3">
                <div class="col-md-6">
                  <label for="cc-name" class="form-label">Name on card</label>
                  <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                  <small class="text-muted">Full name as displayed on card</small>
                  <div class="invalid-feedback">
                    Name on card is required
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="cc-number" class="form-label">Credit card number</label>
                  <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                  <div class="invalid-feedback">
                    Credit card number is required
                  </div>
                </div>

                <div class="col-md-3">
                  <label for="cc-expiration" class="form-label">Expiration</label>
                  <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                  <div class="invalid-feedback">
                    Expiration date required
                  </div>
                </div>

                <div class="col-md-3">
                  <label for="cc-cvv" class="form-label">CVV</label>
                  <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                  <div class="invalid-feedback">
                    Security code required
                  </div>
                </div>
              </div>  -->

              <!-- <hr class="my-4"> -->

              <button class="w-100 btn btn-primary btn-lg" type="submit">Proses Pembayaran</button>
          </form>
        </div>
      </div>
    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">©2024 Inframe-photo</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="https://getbootstrap.com/docs/5.0/examples/checkout/#">Privacy</a></li>
        <li class="list-inline-item"><a href="https://getbootstrap.com/docs/5.0/examples/checkout/#">Terms</a></li>
        <li class="list-inline-item"><a href="https://getbootstrap.com/docs/5.0/examples/checkout/#">Support</a></li>
      </ul>
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>


  <script>
    var unavailableDates = <?= json_encode($date_array); ?>;
    // var unavailableDates = ["23-06-2024", "24-07-2024", "25-09-2022"];

    console.log(unavailableDates);
    $(function() {
      $("#datepicker").datepicker({
        format: 'yyyy-mm-dd',
        beforeShowDay: function(date) {
          var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
          return [unavailableDates.indexOf(string) == -1]
        }
      });
    });

    $(document).ready(function() {
      $('.price').mask('000.000.000.000');
    });
  </script>
</body>

</html>