<?php

  include_once(dirname(__DIR__) . '/_config.php');
  // not_admin_redirect(base_path . '/issues');

    // Step 2: Include our connection and call our defined function
    include_once(ROOT . "/includes/_connect.php");
  // Get the post using the id and user id as our clause
  $sql = "SELECT * FROM issues WHERE issue_id = :id AND user_id = {$_SESSION['user']['id']}";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
  $stmt->execute();
  $issue = $stmt->fetch();

  // Verify we have a issue
  if (!$issue && !ADMIN) {
    $_SESSION['flash']['danger'][] = "Please provide a valid Issue you own.";
    // Send them to issues because they're not editing a valid issue they own
    redirect(base_path . "/issues");
  }

  /*
    Create the post
  */
  $sql = "DELETE FROM issues WHERE issue_id = :id";

  // Prepare, bind and execute our SQL
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
  $stmt->execute();

  // Send back a success message
  $_SESSION['flash']['success'][] = "You have successfully delete an issue.";
  redirect(base_path . "/issues");