<style>
  input#dt-search-0 {
    border-radius: 30px;
  }

  input#dt-search-0:focus {
    text-indent: 15px;
  }

  .text-indent-1 {
    text-indent: 10px;
  }
</style>


<?php if (session()->getFlashdata('faq_message')) {
  $msg =  session()->getFlashdata('faq_message');
?>
  <div class="alert alert-<?= $msg[1] ?> alert-dismissible fade show" role="alert">
    <div class=" text-white d-flex justify-content-center"> <strong><?= $msg[0] ?></strong>
    </div>
    <div class="d-flex justify-content-center">
      <a type="button" class="close bg-secondary text-white py-1 px-2 rounded-3 text-xl" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">close</span>
      </a>
    </div>
  </div>
<?php
} ?>


<button type="button" class="btn btn-primary btn-simple p-2 w-20" data-bs-toggle="modal" data-bs-target="#modal-tambah">
  <?= $modal_title['tambah']; ?>
</button>
<div class=" table-responsive">
  <table id="example" class="display table align-items-center mb-0" style="width:100%">
    <thead>
      <tr>
        <th class="text-uppercase text-primary text-xxs font-weight-bolder text-center">No.</th>
        <?php foreach ($cols as $col) { ?>
          <th class="text-uppercase text-primary text-xxs font-weight-bolder text-center"><?= $col; ?></th>
        <?php } ?>
        <th class="text-secondary opacity-7"></th>
      </tr>
    </thead>
    <tbody>

      <?php
      $no = 1;
      foreach ($dataTables  as $data) { ?>
        <tr>
          <td class="text-start text-center"><?= $no; ?></td>
          <?php foreach ($rows as $row) { ?>
            <td class="text-wrap"><?= $data[$row]; ?></td>
          <?php } ?>
          <td class="d-flex justify-content-center gap-4">
            <?php if ($btn_chat) { ?>
              <a href="<?= $btn_chat; ?>" type="button" class="btn btn-warning btn-simple p-2" data-bs-toggle="modal" data-bs-target="#modal-edit<?= $data['id']; ?>">
                chat
              </a>
            <?php } else { ?>
              <button type="button" class="btn btn-warning btn-simple p-2" data-bs-toggle="modal" data-bs-target="#modal-edit<?= $data['id']; ?>">
                Edit
              </button>
            <?php } ?>
            <button type="button" class="btn btn-danger btn-simple p-2" data-bs-toggle="modal" data-bs-target="#modal-delete<?= $data['id']; ?>">
              Delete
            </button>
          </td>
        </tr>

        <!-- Modal Edit -->
        <div class="modal fade" id="modal-edit<?= $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card card-plain">
                  <div class="card-header pb-0 text-left">
                    <h3 class="font-weight-bolder text-info text-gradient"><?= $modal_title['edit']; ?></h3>
                  </div>
                  <div class="card-body">
                    <form role="form text-left" action="" method="POST">
                      <input type="hidden" name="_method" value="PUT">
                      <input type="hidden" name="id" value="<?= $data['id']; ?>">
                      <?php foreach ($modal_field as $row) {
                        $name = $row['name'];
                      ?>
                        <label><?= $name; ?></label>
                        <div class="input-group mb-3">
                          <input type="<?= empty($row['type']) ? 'text' : $row['type'] ?>" class="form-control" name="<?= $name; ?>" value="<?= $data[$name]; ?>">
                        </div>
                      <?php } ?>

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

        <!-- Modal Delete -->
        <div class="modal fade" id="modal-delete<?= $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default"><?= $modal_title['delete']; ?></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p><?= $delete_msg ?></p>
              </div>
              <div class="modal-footer">
                <form role="form text-left" action="" method="POST">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="id" value="<?= $data['id']; ?>">
                  <button type="submit" class="btn bg-gradient-primary">Delete</button>
                </form>
                <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>

        <?php
        $no++;
      } ?>
    </tbody>
  </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card card-plain">
          <div class="card-header pb-0 text-left">
            <h3 class="font-weight-bolder text-info text-gradient"><?= $modal_title['tambah']; ?></h3>
          </div>
          <div class="card-body">
            <form role="form text-left" action="" method="POST">
              <?php foreach ($modal_field as $row) {
                $name = $row['name'];
              ?>
                <label><?= $name; ?></label>
                <div class="input-group mb-3">
                  <input type="<?= empty($row['type']) ? 'text' : $row['type'] ?>" class="form-control" name="<?= $name; ?>">
                </div>
              <?php } ?>
              <div class="text-center">
                <button type="submit" class="btn btn-sm bg-success text-white">Tambah</button>
                <button type="button" class="btn btn-sm bg-secondary text-white" data-bs-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  new DataTable('#example');
  $('.close').on('click', () => {
    $('.alert').remove()

  })
</script>