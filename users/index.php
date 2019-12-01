<?php include('../_config.php') ?>
<?php

  // Start the session
  if(session_status() == PHP_SESSION_NONE) session_start();
  // Get the users

  include_once(ROOT . '/includes/_connect.php');
  
  // or change this to $users = $conn->query($sql); which will prepare, execute and fetchAll in one command
  $sql = "SELECT * FROM users ORDER BY created_at DESC"; // sql string
  $stmt = $conn->prepare($sql); // prepare the sql and return the prepared statement
  $stmt->execute(); // execute the statement
  $users = $stmt->fetchAll(); // fetch all the records returned
?>

<!DOCTYPE html>
<html>
  <head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Users</title>
  </head>

  <body>
    <div class="container">
      <header class="mt-5">
        <h1>
          Users
        </h1>
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

    <footer class="mb-5"></footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
  </body>
</html>