<?php include('../_config.php') ?>
<?php not_auth_redirect(base_path)?>

<?php
  $_title = "Post a New Issue";
  $_active = "issues";
?>

<?php include(ROOT . '/partials/_header.php') ?>

<div class="container">
  <header class="mt-5">
    <h1>Post a New Issue</h1>
    <hr>
    <small>
      <a href="<?= base_path ?>/users/"><i class="fa fa-chevron-left"></i>&nbsp;Back to users...</a>
    </small>
  </header>
  <p>
    <a href="<?= base_path?>/issues/index.php">Return to archives</a>
  </p>
  <div class="row">

    <!-- <div class="col-sm-4">

    </div> -->
    <div class="col-sm-12 border p-4">
      <?php include(ROOT . '/issues/_form.php') ?>
    </div>
  </div>
</div>

<?php include(ROOT . '/partials/_footer.php') ?>