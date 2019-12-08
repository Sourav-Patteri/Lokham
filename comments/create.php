<?php

  include_once(dirname(__DIR__) . '/_config.php');
  not_admin_redirect(base_path . '/issues');

  $errors = []; // For errors

  /*
    Validate you have all the required fields:
    title, status, and the user_id (content can be blank)
  */

  // If there are errors, let the user know
  if (count($errors) > 0) {
    $_SESSION['flash']['danger'] = $errors;
    $_SESSION['form_data'] = $_issue;
    redirect(base_path . "/issues/new.php");
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
  $_issue['content'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_issue['content']);

  /*
    Create the post
  */
  $sql = "INSERT INTO issues
    (content, user_id) VALUES (
      :content,
      {$_SESSION['user']['id']}
    )";

  // Include our connection and call our defined function
  include_once(ROOT . "/includes/_connect.php");
  // Prepare, bind and execute our SQL
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':content', $_issue['content'], PDO::PARAM_STR);
  $stmt->execute();
  $post_id = $conn->lastInsertId();

  // Send bacn a success message
  $_SESSION['flash']['success'][] = "You have successfully posted an Issue.";
  redirect(base_path . "/issues/show.php?id={$issue_id}");