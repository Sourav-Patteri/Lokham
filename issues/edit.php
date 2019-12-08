<?php include_once(dirname(__DIR__) . '/_config.php') ?>
<?php not_auth_redirect(base_path . '/issues') ?>

<?php
  // Get the post
  include_once(ROOT . "/includes/_connect.php");
  $sql = "SELECT * FROM issues WHERE issue_id=:id"; // sql string
  $stmt = $conn->prepare($sql); // prepare the sql and return the prepared statement
  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
  $stmt->execute(); // execute the statement
  $issue = $stmt->fetch();
  $_SESSION['form_data'] = $issue;
?>

<?php
  $_title = "Edit Issue Entry";
  $_active = "issues";
  $_action = base_path . "/issues/update.php";
?>

<?php include_once(ROOT . '/partials/_header.php') ?>

<div class="container">
  <header class="mt-5">
    <h1>
      Create New Blog
    </h1>
  </header>

  <?php include_once(ROOT . "/issues/_form.php") ?>

  <p>
    <a href="<?= base_path ?>/issues">Return to archives...</a>
  </p>
</div>

<hr class="m-5">

<?php include_once(ROOT . '/partials/_footer.php') ?>