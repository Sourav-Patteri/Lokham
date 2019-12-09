<?php include_once(dirname(__DIR__) . '/_config.php');
  // User's can't view their profile unless logged in
  // User's can't view other users profiles unless they're administrators
  if (!AUTH || (AUTH && $_GET['id'] !== $_SESSION['user']['id'] && !ADMIN)) {
    redirect(base_path);
  }

if (session_status() === PHP_SESSION_NONE) session_start();

  // Get the user if admin and they've passed a get request id
  include_once(ROOT . "/includes/_connect.php");

  $sql = "SELECT * FROM users WHERE id = :id"; // sql string
  $stmt = $conn->prepare($sql); // prepare the sql and return the prepared statement
  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
  $stmt->execute(); // execute the statement
  $user = $stmt->fetch(); // fetch the user record returned
?>

<?php
  $_title = "My User Profile";
  $_active = "profile";
?>

<?php include_once(ROOT . '/partials/_header.php') ?>

<div class="container">
  <header class="mt-5">
    <h1>
      User - <?= $user['first_name'] ?> <?= $user['last_name'] ?>
    </h1>
    <hr>
    <!-- Only show the back link if the user is an administrator -->
    <?php if (ADMIN): ?>
      <small>
        <a href="./"><i class="fa fa-chevron-left"></i>&nbsp;Back to users...</a>
      </small>
    <?php endif ?>
  </header>
  
  <div class="row">
  <div class="col-4">
      <img src="<?=$user['profile_image'] ?? base_path . '/img/world_tree.jpg'?>"  height="250px" width="300px">
    </div>
    <div class="col-4">
      <table class="table table-striped">
        <tbody>
          <tr>
            <th>Name:</th>
            <td><?= $user['first_name'] ?> <?= $user['middle_name'] ?> <?= $user['last_name'] ?></td>
          </tr>
          <tr>
            <th>Email:</th>
            <td><?= $user['email'] ?></td>
          </tr>
          <tr>
            <th>Created On:</th>
            <td>
              <?= date("d/m/Y", strtotime($user['created_at'])) ?>
              <br>
              <?= date("g:i a", strtotime($user['created_at'])) ?>
            </td>
          </tr>
          <?php if (ADMIN): ?>
            <tr>
              <th>Role:</th>
              <td><?= $user['role'] ?></td>
            </tr>
          <?php endif ?>
        </tbody>
      </table>
      <div>
        <small>
          <a href="<?= base_path ?>/users/edit.php?id=<?= ADMIN ? $_GET['id'] : $_SESSION['user']['id'] ?>">
            <i class="fa fa-pencil">&nbsp;</i>
            Edit your profile...
          </a>
          &nbsp;|&nbsp;
          <a href="<?= base_path ?>/users/destroy.php?id=<?= ADMIN ? $_GET['id'] : $_SESSION['user']['id'] ?>" onclick="return confirm('Are you sure you want to delete your own profile?')">
            <i class="fa fa-remove">&nbsp;</i>
            Delete your profile...
          </a>
        </small>
      </div>
    </div>
  </div>
</div>

<?php include_once(ROOT . '/partials/_footer.php') ?>
