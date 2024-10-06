<?php

?>
<?= $this->extend('Template/sidebar') ?>

<?= $this->section('content') ?>

<div class="card p-4">
  <?= $this->include('Template/table') ?>
</div>
<?= $this->endSection(); ?>