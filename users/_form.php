<?php include_once('../_config.php');
//<!-- redirect block direct access to the form -->
//  if (AUTH && !ADMIN) redirect(base_path) 

//  or you can do thru the request ans $_SERVER variable

// This will redirect if user tries to access the form through url -> can become a function in the helpers
$path = $_SERVER['REQUEST_URI']; // get's request path using superglobal variable server
$path_parts = explode("/", $path); // splits path into parts array
$file_name = end($path_parts); // grabs last element in the array (the filename)

if ($file_name === "_form.php") redirect(base_path . '/users/new.php'); // redirects if filename is the same as the form
 
// If the user is attempting to edit and their not authenticated
  // or they're attempting to edit another user and they're not an admin
  if (isset($_action) && (!AUTH || ($_GET['id'] !== $_SESSION['user']['id'] && !ADMIN))) {
    redirect(base_path);
  } else if (!isset($_action) && AUTH && !ADMIN) { // If the user is attempting to create
    // Only admins can create new users while logged in
    redirect(base_path);
  }
$form_data = $form_data ?? null;
?>

<!-- add hidden id if _action isset but why?? -->

<form action="<?= $_action ?? base_path . "/users/create.php" ?>" method="post" enctype="multipart/form-data">
  <div class="row">
    
    <?php if (isset($_action)): ?>
      <input type="hidden" class="form-control" id="id" name="id" value="<?= $form_data['id'] ?>">
    <?php endif ?>
    
    <div class="form-group col">
      <label for="first_name">First Name:</label>
      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name"  value="<?= $form_data['first_name'] ?? null ?>">
    </div>
    
    <div class="form-group col">
      <label for="first_name">Middle Name:</label>
      <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Enter Middle Name"  value="<?= $form_data['middle_name'] ?? null ?>">
    </div>

    <div class="form-group col">
      <label for="last_name">Last Name:</label>
      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name"  value="<?= $form_data['last_name'] ?? null ?>">
    </div>
  </div>
  <div class="custom-file m-2">
      <input type="file" name="uploads" class="custom-file-input" id="uploads">
      <label for="uploads" class="custom-file-label">Choose Profile Picture:</label>
  </div>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?= $form_data['email'] ?? null ?>">
  </div>

  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>

  <div class="form-group">
    <label for="password_confirmation">Password Confirmation:</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
  </div>

  <button class="btn btn-primary" type="submit">Submit</button>
</form>