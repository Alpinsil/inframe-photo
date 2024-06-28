<?php

?>
<?= $this->extend('Template/sidebar') ?>

<?= $this->section('content') ?>



<div class="card m-4 p-4">



  <?php if (session()->getFlashdata('message')) {
    $msg =  session()->getFlashdata('message');
  ?>
    <div class="alert alert-<?= $msg[1] ?> alert-dismissible fade show" role="alert">
      <div class=" text-white d-flex justify-content-center"> <strong> <?= $msg[0]; ?></strong>
      </div>
      <div class="d-flex justify-content-center">
        <a type="button" class="close bg-secondary text-white py-1 px-2 rounded-3 text-xl" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">close</span>
        </a>
      </div>
    </div>
  <?php
  } ?>

  <button type="button" class="btn btn-success btn-simple w-lg-5" data-bs-toggle="modal" data-bs-target="#modal-tambah">
    <i class="fa fa-pencil me-sm-1"></i>
  </button>


  <!-- Modal Edit -->
  <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <div class="card card-plain">
            <div class="card-header pb-0 text-left">
              <h3 class="font-weight-bolder text-info text-gradient">Edit Profile</h3>
            </div>
            <div class="card-body">
              <form role="form text-left" action="" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="<?= $user['id']; ?>">

                <div class="mb-3">
                  <label> Fullname </label>
                  <input type="text" class="form-control" name="name" value="<?= $user['name']; ?>">
                </div>

                <div class="mb-3">
                  <label> Phone </label>
                  <input type="text" class="form-control" name="nohp" value="<?= $user['nohp']; ?>">
                </div>

                <div class="mb-3">
                  <label> Address </label>
                  <input type="text" class="form-control" name="alamat" value="<?= $user['alamat']; ?>">
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-sm bg-success text-white">Update</button>
                  <button type="button" class="btn btn-sm bg-secondary text-white" data-bs-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <section style="background-color: #eee; border-radius: 15px;" class="pb-3">
    <div class="container">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 mb-4">
            <!-- <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol> -->
          </nav>
        </div>
      </div>

      <div class="row mx-auto">
        <!-- <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3">John Smith</h5>
              <p class="text-muted mb-1">Full Stack Developer</p>
              <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
              <div class="d-flex justify-content-center mb-2">
                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Follow</button>
                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary ms-1">Message</button>
              </div>
            </div>
          </div>
          <div class="card mb-4 mb-lg-0">
            <div class="card-body p-0">
              <ul class="list-group list-group-flush rounded-3">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fas fa-globe fa-lg text-warning"></i>
                  <p class="mb-0">https://mdbootstrap.com</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fab fa-github fa-lg text-body"></i>
                  <p class="mb-0">mdbootstrap</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                  <p class="mb-0">@mdbootstrap</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                  <p class="mb-0">mdbootstrap</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                  <p class="mb-0">mdbootstrap</p>
                </li>
              </ul>
            </div>
          </div>
        </div> -->
        <div class="col-lg">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Full Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?= $user['name']; ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?= $user['email']; ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Phone</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?= $user['nohp']; ?></p>
                </div>
              </div>
              <hr>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Address</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?= $user['alamat']; ?></p>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-md-6">
              <div class="card mb-4 mb-md-0">
                <div class="card-body">
                  <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                  </p>
                  <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                  <div class="progress rounded mb-2" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-4 mb-md-0">
                <div class="card-body">
                  <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                  </p>
                  <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                  <div class="progress rounded mb-2" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </section>
</div>


<script>
  new DataTable('#example');
  $('.close').on('click', () => {
    $('.alert').remove()

  })
</script>
<?= $this->endSection(); ?>