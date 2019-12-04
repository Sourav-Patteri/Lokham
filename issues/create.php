<?php
  // Add the connection script
  include_once(dirname(__DIR__) . '/_config.php');
  not_auth_redirect(base_path . '/posts');

  if (session_status() === PHP_SESSION_NONE) session_start();

  $_SESSION['flash'] = [];
  $errors = [];

      /*
        Validation - will ensure the user enters in our required
        fields and in the required format
      */

  // Step 1: Verify the fields aren't empty using a foreach loop
  // Variable variables allow us to use strings to access a variable name
  foreach (['content'] as $field => $value) { // iterate thru $_POST and dump to $field => take the key($field) and assign the value to $value
    if (empty($value)) {
      $formatted = ucwords(str_replace("_", " ", $field)); // Format it into human readable
      $errors[] = "{$formatted} cannot be empty.";  // Add(push) a new error to the array
    }
  }

  //Return to the form if there are errors (we do this here because we don't want to run malicious code against our database)
  // count the $errors array
  if (count($errors) > 0) {
    $_SESSION['issue_data'] = $_POST;
    redirect_with_errors(base_path . '/issues/new.php', $errors);
  }
    /*
      Sanitization - will prevent data that isn't permitted
      from being entered into our database
    */

  // foreach (['content'] as $field) {
  //     $_POST[$field] = filter_var($_POST[$field], FILTER_SANITIZE_STRING);
  //   }
  $_POST['content'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_POST['content']);

  if(count($errors) > 0 ){
    redirect_with_errors(base_path . '/issues/new.php', $errors);
  }

  // Get the Id of the user to pass to the database
  // insert the Issue to the database
  include_once(ROOT . "/includes/_connect.php");

  $sql = "INSERT INTO issues (user_id, content) VALUES (:user_id, :content)";
  $stmt = $conn->prepare($sql);
  // how to pass the user id 
  // the session user id is the user id and we do have a foreign key in issues table so it should be exactly like this??
  $stmt->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
  $stmt->bindParam(':content', $_POST['content'], PDO::PARAM_STR);
  $stmt->execute();
  $issue_id = $conn->lastInsertId();//Returns the ID of the last inserted row or sequence value
  // $conn = null;

  redirect_with_success(base_path . "/issues/show.php?id={$_POST['id']}",  "You have successfully posted your issue");


      