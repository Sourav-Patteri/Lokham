<?php include_once(dirname(__DIR__) . '/_config.php') ?>
<?php not_auth_redirect(base_path . '/issues') ?>

<?php
  // Get the comments
  include_once(ROOT . "/includes/_connect.php");
  $sql = "SELECT * FROM comments WHERE comment_id=:id"; // sql string
  $stmt = $conn->prepare($sql); // prepare the sql and return the prepared statement
  $stmt->bindParam(':id', $_GET['comment_id'], PDO::PARAM_INT);
  $stmt->execute(); // execute the statement
  $comments = $stmt->fetch();

  // !Admins can only edit their own comments
  if ($_SESSION['user']['id'] !== $comments['user_id']) {
    redirect_with_errors(base_path . "/issues","You may only edit comments you own.");
  }
  $_SESSION['form_data'] = $comments;
?>

<?php
  $_title = "Edit Comments";
  $_active = "comment";
  $_action = base_path . "/comments/update.php";
?>

<?php include_once(ROOT . '/partials/_header.php') ?>

<div class="container">
  <header class="mt-5">
    <h1>
      Comments
    </h1>
  </header>

  <?php include_once(ROOT . "/comments/_form.php") ?>

  <p>
    <a href="<?= base_path ?>/issues">Return to archives...</a>
  </p>
</div>

<hr class="m-5">

<?php include_once(ROOT . '/partials/_footer.php') ?>