<?php

  include('../_config.php');
  include(ROOT . '/includes/_connect.php');

  if (session_status() === PHP_SESSION_NONE) session_start();
  $_SESSION['flash'] = [];

 
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "This email is not in a valid format";
  }
//include a funtion to count and output errors and redirect
  if (count($errors) > 0) {
    $_SESSION['form_data'] = $_POST;
    redirect_with_errors(base_path . '/sessions/login.php', $errors);
  }
   // Sanitize the user supplied email
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

  
  // Check if the user exists in the database
  $sql = "SELECT * FROM users WHERE email = :email"; // using variables to properly bind
  $stmt = $conn->prepare($sql); // preparing our sql
  $stmt->bindParam(":email", $email, PDO::PARAM_STR); // binding our parameter
  $stmt->execute(); // executing the sql statement
  $user = $stmt->fetch(); // forces the return to be a boolean value

  // Check the user exists and the password is correct
  if (!$user || !password_verify($_POST['password'], $user['password'])) { // password_verify will evalute the password against the hash and see if they match
    $_SESSION['form_data']['email'] = $_POST['email'];
    redirect_with_errors(base_path . '/sessions/login.php', "The email or password entered is incorrect.");
  }
  //unset the password from the session for safety
  unset($user['password']);
  // Set a session variable to verify the user is authenticated
  $_SESSION['user'] = $user;

  redirect_with_success(base_path . '/issues/index.php', "You have successfully logged in to Lokham");
