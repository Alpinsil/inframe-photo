<?php

?>
<?= $this->extend('Template/sidebar') ?>

<?= $this->section('content') ?>

<div class="card m-4 p-4">
  <?= $this->include('Template/table') ?>
</div>
<?= $this->endSection(); ?>