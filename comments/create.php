<?php

  include_once(dirname(__DIR__) . '/_config.php');
  // not_admin_redirect(base_path . '/issues');

  $errors = []; // For errors

  /*
    Validate you have all the required fields:
    title, status, and the user_id (content can be blank)
  */

  // If there are errors, let the user know
  if (count($errors) > 0) {
    $_SESSION['flash']['danger'] = $errors;
    $_SESSION['form_data'] = $_POST;
    redirect(base_path . "/posts/show.php?id={$_POST['issue_id']}");
  }

  /*
    Sanitize our data before validating against
    the database
  */

  $_POST['comment'] = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
  /*
    Sanitizing the HTML is a little trickier. We can't use
    filter_var() because it will strip out ALL tags
    including HTML tags. Instead we'll use preg_replace
    which will allow us to strip out only the script tags.
  */
  $_POST['comment'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_POST['comment']);

  /*
    Create the post
  */
  $sql = "INSERT INTO comments
    (comment, rating_id, user_id, issue_id) VALUES (
      :comment,
      1,
      {$_SESSION['user']['id']},
      {$_POST['issue_id']}
    )";

  // Include our connection and call our defined function
  include_once(ROOT . "/includes/_connect.php");

// var_dump($sql);
  // Prepare, bind and execute our SQL
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
  $stmt->execute();
  $issue_id = $conn->lastInsertId();

  // Send bacn a success message
  $_SESSION['flash']['success'][] = "You have successfully posted an Comment.";
  redirect(base_path . "/issues/show.php?id={$_POST['issue_id']}");