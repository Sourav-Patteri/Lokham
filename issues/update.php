<?php

  include_once(dirname(__DIR__) . '/_config.php');
  not_auth_redirect(base_path . '/issues');

  $errors = []; // For errors

  /*
    Validate you have all the required fields:
    title, status, and the user_id (content can be blank)
  */
//   foreach(['title', 'status'] as $field) {
//     if (empty($_POST[$field])) {
//       $formatted = str_replace("_", " ", $_POST[$field]);
//       $formatted = ucwords($formatted);
//       $errors[] = "{$formatted} is a required field.";
//     }
//   }

  // If there are errors, let the user know
//   if (count($errors) > 0) {
//     $_SESSION['form_data'] = $_POST;
//     redirect_with_errors(base_path . "/issues/new.php", $errors);
//   }

  /*
    Sanitize our data before validating against
    the database
  */
//   $_POST['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
//   $_POST['status'] = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

  /*
    Sanitizing the HTML is a little trickier. We can't use
    filter_var() because it will strip out ALL tags
    including HTML tags. Instead we'll use preg_replace
    which will allow us to strip out only the script tags.
  */
  $_POST['content'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_POST['content']);

  // Include our connection and call our defined function
  include_once(ROOT . "/includes/_connect.php");
  // Get the post using the id and user id as our clause
  // $sql = "SELECT * FROM issues WHERE issue_id = :id AND user_id = {$_SESSION['user']['id']}";
  // $stmt = $conn->prepare($sql);
  // $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
  // $stmt->execute();
  // $issue = $stmt->fetch();
 
  // Verify we have a post
  // if (!$issue) {
    // $errors[] = "Please provide a valid issue id." ;
    // Send them to issues because they're not editing a valid post they own
  //   redirect_with_errors(base_path . '/issues', "Please provide a valid post id.");
  // }

  /*
    Create the post
  */
  $sql = "UPDATE issues SET
    content = :content
    WHERE issue_id = :id";

  // Prepare, bind and execute our SQL
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':content', $_POST['content'], PDO::PARAM_STR);
  $stmt->bindParam(':id', $_POST['issue_id'], PDO::PARAM_INT);
  $stmt->execute();

  // Send bacn a success message
  redirect_with_success(base_path . "/issues/show.php?id={$_POST['issue_id']}", "You have successfully created a new post.");