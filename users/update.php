<?php
  // Add the connection script
  if (session_status() === PHP_SESSION_NONE) session_start();
  include_once(dirname(__DIR__) . '/_config.php');
  include_once(ROOT . "/includes/_connect.php");
  /*
    Validation will ensure the user enters in our required
    fields and in the required format
  */
  $errors = [];

  // Verify the following aren't empty
  $required = ['first_name', 'last_name', 'email'];
  foreach ($required as $field) {
    if (empty($_POST[$field])) { // Variable variables allow us to use strings to access a variable name
      $formatted = ucfirst(str_replace("_", " ", $field)); // Format it into human readable
      $errors[] = "{$formatted} cannot be empty."; // Add a new error to the array
    }
  }

  // Verify that the email is in the correct format
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $errors[] = "Your email is not in a valid format";

  // Return to the form if there are errors (we do this here because we don't want to run malicious code against our database)
  if (count($errors) > 0) { // count the array
    $_SESSION['form_data'] = $_POST;
    redirect_with_errors(base_path . "/users/edit.php?id=" . $_POST['id'], $errors);
  }
  /* End of validation */

  /*
    Sanitization will prevent data that isn't permitted
    from being entered into our database
  */
  // Sanitize the email
  $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

  // Sanitize the other two fields
  // (Below is a single line foreach statement. This can be done if the block only has one statement)
  foreach(['first_name', 'last_name'] as $field) $_POST[$field] = filter_var($_POST[$field], FILTER_SANITIZE_STRING);
  /* End of sanitization */

  // Get the user we're editing
  $sql = "SELECT * FROM users WHERE id = :id"; // a string containing our SQL
  $stmt = $conn->prepare($sql); // prepare the statement to avoid SQL injection attacks
  $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_STR); // bind the parameter (enforce it's a string)
  $stmt->execute(); // execute our statement
  $user = $stmt->fetch(); // fetch the results

  
  // If we're attempting to change the email, we need to verify it doesn't already exist
  if ($_POST['email'] !== $user['email'] && !ADMIN) { // does that mean an admin can edit and let two users have the same email?
    $sql = "SELECT email FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt->execute();
    if (!empty($stmt->fetch())) $errors[] = "Sorry, this email cannot be used.";
  }

  $stmt->closeCursor(); // close the connection cursor so it can await a new statement. To free the server cannot run fetch again but can do other statements. 
 
  // Return errors
  if (count($errors) > 0) { // count the array
    $_SESSION['form_data'] = $_POST;
    redirect_with_errors(base_path . "/users/edit?id=" . $_POST['id'], $errors);
  }

  // Attempt to write the user to the database
  $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name, middle_name = :middle_name, email = :email"; // a string containing our SQL
  if (!empty($_POST['password'])) {
    if ($_POST['password'] === $_POST['password_confirmation']) {
      $sql = $sql . ", password = :password";
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    } else {
      $errors[] = "The entered password must match password confirmation";
      redirect_with_errors(base_path . "/users/edit.php?id=" . $_POST['id'], $errors);
    }
  }
  $sql = $sql . " WHERE id = :id";

  
  // Bind Parameters
  $stmt = $conn->prepare($sql); // prepare the statement
  $stmt->bindParam(':first_name', $_POST['first_name'], PDO::PARAM_STR); // bind the parameter
  $stmt->bindParam(':last_name', $_POST['last_name'], PDO::PARAM_STR); // bind the parameter
  $stmt->bindParam(':middle_name', $_POST['middle_name'], PDO::PARAM_STR); // bind the parameter
  $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR); // bind the parameter
  $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
  if (isset($password)) $stmt->bindParam(':password', $password, PDO::PARAM_STR);
  $stmt->execute(); // execute

  // Close our connection
  $conn = null;
  unset($_POST['password']);
  if ($_POST['id'] === $_SESSION['user']['id']) {// repulling the users data but isn't this redundant if they haven't updated anything?
    $_SESSION['user'] = array_merge($_SESSION['user'], $_POST);
  }  
  redirect_with_success(base_path . "/users/show.php?id=" . $_POST['id'], "User was updated successfully");