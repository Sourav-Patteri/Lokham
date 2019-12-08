<?php
  // Add the connection script
  include_once(dirname(__DIR__) . '/_config.php');
  // If the user is attempting to create a new user while logged in
  // and they are not an administrator then we'll redirect them
  if (AUTH && !ADMIN) {
    redirect(base_path . '/users/show.php?id=' . $_SESSION['user']['id']);
  }
  include_once(ROOT . "/includes/_connect.php");

  if (session_status() === PHP_SESSION_NONE) session_start();

  $_SESSION['flash'] = [];
  $errors = [];

  
  // Verify the following aren't empty
  $required = ['first_name', 'last_name', 'email', 'password', 'password_confirmation'];
  foreach ($required as $field) {
    if (empty($_POST[$field])) { // Variable variables allow us to use strings to access a variable name
      $formatted = ucfirst(str_replace("_", " ", $field)); // Format it into human readable
      $errors[] = "{$formatted} cannot be empty."; // Add a new error to the array
    }
  }
  //verifying email is in correct format
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "The email entered is not of the right format.";
  }
  
  if ($_POST['password'] !== $_POST['password_confirmation']) {
    $errors[] = "The password and password confirmation do not match";
  }
// regex expressions supposed to filter password but not working please resolve if understand

  // if ( (strlen($_POST['password']) < 6) || (strlen($_POST['password']) > 64) ) {
  //   $errors[] = "The password should contain 6 - 64 charcters";
  // }
  // if (!preg_match("^(?=.*[A-Z]).*$", $_POST['password'])){
  //   $errors[] = "Password must contain a capital letter";
  // } 
  // if (!preg_match("^(?=.*\d).*$", $_POST['password'])) {
  // $errors[] =  "Password must contain a number";
  // }  
  // if (!preg_match("^(?=.*[\@\$\%\^\&\*\(\)\-\+\!\[\]\{\}\|]).*$", $_POST['password'])){
  // $errors[] =  "Password must contain a symbol";
  // }

if (count($errors) > 0) {
    $_SESSION['form_data'] = $_POST;
    redirect_with_errors(base_path . '/users/new.php', $errors);
  }

$sql = "SELECT email FROM users WHERE email = :email";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
$stmt->execute();
$exists = $stmt->fetch();

if ($exists) $errors[] = "This user already exists.";

if (count($errors) > 0) {
    $_SESSION['form_data'] = $_POST;
    redirect_with_errors(base_path . '/users/new.php', $errors);
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
            echo "File is not an image.";
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
    $errors[] = "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      move_uploaded_file($_FILES["uploads"]["tmp_name"], $target_file);
  }

}  
  if(count($errors) > 0 ){
    $_SESSION['form_data'] = $_POST;
    redirect_with_errors(base_path . '/users/new.php', $errors);
  }
  ?>
<?php
  $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  
  foreach (['first_name','middle_name', 'last_name'] as $field) {
    $_POST[$field] = filter_var($_POST[$field], FILTER_SANITIZE_STRING);
  }
  
$sql = "INSERT INTO users (first_name, last_name, middle_name, profile_image, email, password) VALUES (:first_name, :middle_name, :last_name, :profile_image, :email, :password)";
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$stmt = $conn->prepare($sql);
$stmt->bindParam(':first_name', $_POST['first_name'], PDO::PARAM_STR);
$stmt->bindParam(':middle_name', $_POST['middle_name'], PDO::PARAM_STR);
$stmt->bindParam(':last_name', $_POST['last_name'], PDO::PARAM_STR);  
$stmt->bindParam(':profile_image', $target_file, PDO::PARAM_STR);
$stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);
$stmt->execute();

$conn = null;

redirect_with_success(base_path . '/sessions/login.php',  "You have successfully registered at Lokham");
?>