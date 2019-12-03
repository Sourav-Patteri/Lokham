<?php include_once('../_config.php');
//<!-- redirect block direct access to the form -->
//  if (AUTH && !ADMIN) redirect(base_path) 

//  or you can do thru the request ans $_SERVER variable

// This will redirect if user tries to access the form through url
$path = $_SERVER['REQUEST_URI']; // get's request path using superglobal variable server
$path_parts = explode("/", $path); // splits path into parts array
$file_name = end($path_parts); // grabs last element in the array (the filename)

if ($file_name === "_form.php") redirect(base_path . '/users/new.php'); // redirects if filename is the same as the form
$form_data = $form_data ?? null;
?>
<!-- add logic to only allow admins and general public(not logged in to use)  -->

<!-- add hidden id if _action isset -->
<form action="<?= base_path ?>/users/create.php" method="post">
  <div class="row">
    <div class="form-group col">
      <label for="first_name">First Name:</label>
      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name"  value="<?= $form_data['first_name'] ?? null ?>">
    </div>

    <div class="form-group col">
      <label for="last_name">Last Name:</label>
      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name"  value="<?= $form_data['last_name'] ?? null ?>">
    </div>
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