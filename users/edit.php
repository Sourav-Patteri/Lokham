<?php include_once(dirname(__DIR__) . '/_config.php');

  // We will need the session if we don't have it already
  if (session_status() === PHP_SESSION_NONE) session_start();

  // Check if the GET superglobal has a value called 'id'
  if (isset($_GET['id'])) {
    // Include our connection script
    include_once(ROOT . "/includes/_connect.php");

    // Write the identical SQL we wrote in show to select an existing user based on the ID
    $sql = "SELECT * FROM users WHERE id=:id"; // sql string with a bound parameter
    $stmt = $conn->prepare($sql); // Prepare the sql and return the prepared statement
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT); // Bind the value to our bound parameter
    $stmt->execute(); // Execute the statement
    $_SESSION['form_data'] = $stmt->fetch(); // Get our user and assign their details to the form-data session variable
  }
?>

<?php
  $_title = "Edit " . $_SESSION['user']['first_name'] . " " . $_SESSION['user']['last_name'];
  $_active = "users";
  $_action = base_path . "/users/update.php";
?>

<?php include_once(ROOT . '/partials/_header.php') ?>

<div class="container">
  <header class="mt-5">
    <h1><?= $_title ?></h1>
    <hr>
    <small>
      <a href="<?= base_path ?>/users"><i class="fa fa-chevron-left"></i>&nbsp;Back to users...</a>
    </small>
  </header>

  <div class="row">
    <div class="col-sm-4">
    </div>

    <div class="col-sm-8 border">
      <?php include_once(ROOT . '/users/_form.php') ?>
    </div>
  </div>
</div>

<?php include_once(ROOT . '/partials/_footer.php') ?>