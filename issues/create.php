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
    $_SESSION['form_data'] = $_POST;
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
  ?>

  <?php
  $target_dir = "../uploads/";
  $target_file = $target_dir . basename($_FILES["uploads"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_FILES["uploads"])) {
      $check = getimagesize($_FILES["uploads"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
        $errors[] = "File is not an image.";
          $uploadOk = 0;
      }
  
  // Check if file already exists
  if (file_exists($target_file)) {
    $errors[] = "Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["uploads"]["size"] > 5000000) {
    $errors[] =  "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    $errors[] = "Sorry, your file was not uploaded. If you have not chosen a profile image please choose one";
  // if everything is ok, try to upload file
  } else {
      move_uploaded_file($_FILES["uploads"]["tmp_name"], $target_file);
  }
}
  if(count($errors) > 0 ){
    $_SESSION['form_data'] = $_POST;
    redirect_with_errors(base_path . '/issues/new.php', $errors);
  }
  ?>

  <?php
  // Get the Id of the user to pass to the database
  // insert the Issue to the database
  include_once(ROOT . "/includes/_connect.php");
  $sql = "INSERT INTO issues (title, image, content, user_id) VALUES (
    :title,
    :image,
    :content,
    {$_SESSION['user']['id']}
  )";
  $stmt = $conn->prepare($sql);
  // how to pass the user id 
  // the session user id is the user id and we do have a foreign key in issues table so it should be exactly like this??
  $stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
  $stmt->bindParam(':image', $target_file, PDO::PARAM_STR);
  $stmt->bindParam(':content', $_POST['content'], PDO::PARAM_STR);
  $stmt->execute();
  $issue_id = $conn->lastInsertId();//Returns the ID of the last inserted row or sequence value
  //do it using sql properly
  // $conn = null;

  // $sql = "INSERT INTO issues (user_id, content) VALUES ({$_SESSION['user']['id']}, :content)";
  // $stmt = $conn->prepare($sql);
  // $stmt->bindParam(':content', $_POST['content'], PDO::PARAM_STR);
  // $stmt->execute();
  // $issue_id = $conn->lastInsertId();//Returns the ID of the last inserted row or sequence value
  
  redirect_with_success(base_path . "/issues",  "You have successfully posted your issue");

?>
      