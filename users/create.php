<?php
  // Add the connection script
  include_once(dirname(__DIR__) . '/_config.php');
  // If the user is attempting to create a new user while logged in
  // and they are not an administrator then we'll redirect them
  if (AUTH && !ADMIN) {
    redirect(base_path . '/users/show.php?id=' . $_SESSION['user']['id']);
  }
  include_once(ROOT . "/includes/_connect.php");

  if (session_status() === PHP_SESSION_NONE) session_start();

  $_SESSION['flash'] = [];
  $errors = [];

  
  // Verify the following aren't empty
  $required = ['first_name', 'last_name', 'email', 'password', 'password_confirmation'];
  foreach ($required as $field) {
    if (empty($_POST[$field])) { // Variable variables allow us to use strings to access a variable name
      $formatted = ucfirst(str_replace("_", " ", $field)); // Format it into human readable
      $errors[] = "{$formatted} cannot be empty."; // Add a new error to the array
    }
  }
  //verifying email is in correct format
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "The email entered is not of the right format.";
  }
  
  if ($_POST['password'] !== $_POST['password_confirmation']) {
    $errors[] = "The password and password confirmation do not match";
  }
// regex expressions supposed to filter password but not working please resolve if understand

  if ( (strlen($_POST['password']) < 6) || (strlen($_POST['password']) > 64) ) {
    $errors[] = "The password should contain 6 - 64 charcters";
  }
  if (!preg_match("^(?=.*[A-Z]).*$", $_POST['password'])){
    $errors[] = "Password must contain a capital letter";
  } 
  if (!preg_match("^(?=.*\d).*$", $_POST['password'])) {
  $errors[] =  "Password must contain a number";
  }  
  if (!preg_match("^(?=.*[\@\$\%\^\&\*\(\)\-\+\!\[\]\{\}\|]).*$", $_POST['password'])){
  $errors[] =  "Password must contain a symbol";
  }

if (count($errors) > 0) {
    $_SESSION['form_data'] = $_POST;
    redirect_with_errors(base_path . '/users/new.php', $errors);
  }

$sql = "SELECT email FROM users WHERE email = :email";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
$stmt->execute();
$exists = $stmt->fetch();

if ($exists) $errors[] = "This user already exists.";

if (count($errors) > 0) {
    $_SESSION['form_data'] = $_POST;
    redirect_with_errors(base_path . '/users/new.php', $errors);
  }
  $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  
  foreach (['first_name','middle_name', 'last_name'] as $field) {
    $_POST[$field] = filter_var($_POST[$field], FILTER_SANITIZE_STRING);
  }
  
$sql = "INSERT INTO users (first_name, last_name, middle_name, email, password) VALUES (:first_name, :middle_name, :last_name, :email, :password)";
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$stmt = $conn->prepare($sql);
$stmt->bindParam(':first_name', $_POST['first_name'], PDO::PARAM_STR);
$stmt->bindParam(':middle_name', $_POST['middle_name'], PDO::PARAM_STR);
$stmt->bindParam(':last_name', $_POST['last_name'], PDO::PARAM_STR);
$stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);
$stmt->execute();

$conn = null;

redirect_with_success(base_path . '/sessions/login.php',  "You have successfully registered at Lokham");