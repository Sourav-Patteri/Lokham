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
    $_SESSION['flash']['danger'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header('Location: ' . base_path . '/sessions/login.php');
    exit;
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
    $_SESSION['flash']['danger'][] = "The email or password entered is incorrect."; // Security by obscurity! Don't give more information than absolutely necessary
    $_SESSION['form_data']['email'] = $_POST['email'];
    header('Location: ' . base_path . '/sessions/login.php'); // redirect back to the form
    exit; // we must exit or the script will continue to run
  }
  //unset the password from the session for safety
  unset($user['password']);
  // Set a session variable to verify the user is authenticated
  $_SESSION['user'] = $user;

  // Return the user to their profile page
  $_SESSION['flash']['success'][] = "You have successfully logged in to Lokham";
  header('Location: ' . base_path . '/index.php'); // redirect to an index page
  exit; // we must exit or the script will continue to run