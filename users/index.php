<?php include('../_config.php') ?>
<?php

  // Start the session
  if(session_status() == PHP_SESSION_NONE) session_start();
  not_admin_redirect(base_path);

  // Get the users

  include_once(ROOT . '/includes/_connect.php');
  
  // or change this to $users = $conn->query($sql); which will prepare, execute and fetchAll in one command
  $sql = "SELECT * FROM users ORDER BY created_at DESC"; // sql string
  $stmt = $conn->prepare($sql); // prepare the sql and return the prepared statement
  $stmt->execute(); // execute the statement
  $users = $stmt->fetchAll(); // fetch all the records returned
?>

<?php
  $_title = "List All Users - Admin";
  $_active = "users";

include_once(ROOT . '/partials/_header.php'); ?>

    <div class="container">
      <header class="mt-5">
        <h1><?= $_title ?></h1>
        <hr>
        <small>
          <a href="./new.php"><i class="fa fa-plus"></i>&nbsp;New user...</a>
        </small>
      </header>

      <?php if (count($users) > 0): ?>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
            
              <th>Created On</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($users as $user): ?>
              <tr>
                <td><a href="./show?id=<?= $user['id'] ?>"><?= $user['first_name'] ?> <?= $user['last_name'] ?></a></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['phone'] ?></td>
                <td>
                  <?= date("d/m/Y", strtotime($user['created_at'])) ?>
                  <br>
                  <?= date("g:i a", strtotime($user['created_at'])) ?>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="alert alert-warning">
          <h4 class="alert-heading">
            NO USERS!
          </h4>
          <hr>
          <p>Perhaps you should create a new one...</p>
        </div>
      <?php endif ?>
    </div>

  <?php include_once(ROOT . '/partials/_footer.php') ?>