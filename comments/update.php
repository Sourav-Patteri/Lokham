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
    $_SESSION['form_data'] = $_comments;
    redirect(base_path . "/issues/new.php");
  }

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
  $sql = "SELECT * FROM comments WHERE comment_id = :id AND user_id = {$_SESSION['user']['id']}";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $_comments['comment_id'], PDO::PARAM_INT);
  $stmt->execute();
  $post = $stmt->fetch();
  // Verify we have a post
  if (!$comments) {
    $_SESSION['flash']['danger'][] = "Please provide a valid comment.";
    // Send them to posts because they're not editing a valid post they own
    redirect(base_path . "/issues");
  }
  /*
    Create the post
  */
  $sql = "UPDATE comments SET
    comment = :comment
    WHERE comment_id = :id";
  // Prepare, bind and execute our SQL
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':comment', $_comments['comment'], PDO::PARAM_STR);
  $stmt->bindParam(':id', $_comments['comment_id'], PDO::PARAM_INT);
  $stmt->execute();
  // Send bacn a success message
  $_SESSION['flash']['success'][] = "You have successfully posted a comment.";
  redirect(base_path . "/issues/show.php?id={$_issues['id']}");