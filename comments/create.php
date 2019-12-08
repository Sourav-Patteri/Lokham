<?php

  include_once(dirname(__DIR__) . '/_config.php');
  not_admin_redirect(base_path . '/issues');

  $_SESSION['flash'] = [];
  $errors = []; // For errors

  /*
    Validate you have all the required fields:
    title, status, and the user_id (content can be blank)
  */
    // Validate
    foreach(['comment'] as $field) {
      if (empty($_issue[$field])) {
        $formatted = str_replace("_", " ", $_issue[$field]);
        $formatted = ucwords($formatted);
        $errors[] = "{$formatted} is a required field.";
      }
    }

  // If there are errors, let the user know
  if (count($errors) > 0) {
    $_SESSION['flash']['danger'] = $errors;
    $_SESSION['form_data'] = $_issue;
    redirect(base_path . "/issues/show.php?id={$issue_id}");
  }

  /*
    Sanitize our data before validating against
    the database
  */
  
  /*
    Sanitizing the HTML is a little trickier. We can't use
    filter_var() because it will strip out ALL tags
    including HTML tags. Instead we'll use preg_replace
    which will allow us to strip out only the script tags.
  */
  $_comments['comment'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_comments['comment']);

    
  // Include our connection and call our defined function
  include_once(ROOT . "/includes/_connect.php");
  $conn = connect();

    // Get the post using the id and user id as our clause
    $sql = "SELECT * FROM issue WHERE id = :id AND status = 'published'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $_issue['issue_id'], PDO::PARAM_INT);
    $stmt->execute();
    $issue = $stmt->fetch();

    /*
    write comments
  */
  $sql = "INSERT INTO comments
    (user_id, comment) VALUES (
      :comment,
      {$_SESSION['user']['id']}
    )";


  // Prepare, bind and execute our SQL
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':comment', $_comments['comment'], PDO::PARAM_STR);
  $stmt->execute();
  $post_id = $conn->lastInsertId();


  
  // Send bacn a success message
  $_SESSION['flash']['success'][] = "Your comment has been posted successfully.";
  redirect(base_path . "/issues/show.php?id={$issue_id}");