<?php
  // Add the connection script
  include_once(dirname(__DIR__) . '/_config.php');
  include_once(ROOT . "/includes/_connect.php");

  if (session_status() === PHP_SESSION_NONE) session_start();

  $_SESSION['flash'] = [];
  $errors = [];

      /*
        Validation - will ensure the user enters in our required
        fields and in the required format
      */

  // Step 1: Verify the fields aren't empty using a foreach loop
  // Variable variables allow us to use strings to access a variable name
  // foreach ($_POST as $field => $value) { // iterate thru $_POST and dump to $field => take the key($field) and assign the value to $value
  //   if (empty($value)) {
  //     $formatted = ucwords(str_replace("_", " ", $field)); // Format it into human readable
  //     $errors[] = "{$formatted} cannot be empty.";  // Add(push) a new error to the array
  //   }
  // }

  //Return to the form if there are errors (we do this here because we don't want to run malicious code against our database)
  // count the $errors array
  if (count($errors) > 0) {
    $_SESSION['flash']['danger'] = $errors;
    $_SESSION['issue_data'] = $_POST;
    header('Location: ' . base_path . '/issues/new.php'); // redirect to form
    exit;   // we must exit or the script will continue to run
  }
    /*
      Sanitization - will prevent data that isn't permitted
      from being entered into our database
    */
  foreach (['content'] as $field) {
      $_POST[$field] = filter_var($_POST[$field], FILTER_SANITIZE_STRING);
    }

  if(count($errors) > 0 ){
    redirect_with_errors(base_path . '/issues/new.php', $errors);
  }

  // insert the Issue to the database

  $sql = "INSERT INTO issues (user_id, content) VALUES (:user_id, :content)";
  $stmt = $conn->prepare($sql);
  // how to pass the user id??
  // $stmt->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);
  $stmt->bindParam(':content', $_POST['content'], PDO::PARAM_STR);
  var_dump($stmt);
  $stmt->execute();

  $conn = null;

  redirect_with_success(base_path . '/issues/index.php',  "You have successfully posted your issue");


      