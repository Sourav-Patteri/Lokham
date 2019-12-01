<?php include_once(dirname(__DIR__) . '/_config.php') ?>

<?php
  // Get the user if admin and they've passed a get request id
  include_once(ROOT . "/includes/_connect.php");

  $sql = "SELECT * FROM users WHERE id = :id"; // sql string
  $stmt = $conn->prepare($sql); // prepare the sql and return the prepared statement
  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
  $stmt->execute(); // execute the statement
  $user = $stmt->fetch(); // fetch the user record returned
?>

<?php include_once(ROOT . '/partials/_header.php') ?>

<div class="container">
  <header class="mt-5">
    <h1>
      User
    </h1>
    <hr>
  </header>
  
  <div class="row">
    <div class="col-4">
      
    </div>

    <div class="col-4">
      <table class="table table-striped">
        <tbody>
          <tr>
            <th>Name:</th>
            <td></td>
          </tr>
          <tr>
            <th>Email:</th>
            <td></td>
          </tr>
          <tr>
            <th>Created On:</th>
            <td>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    
  </div>
</div>

<?php include_once(ROOT . '/partials/_footer.php') ?>
