<form action="<?= base_path ?>/users/create.php" method="post">
  <div class="row">
    <div class="form-group col">
      <label for="first_name">First Name:</label>
      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name">
    </div>

    <div class="form-group col">
      <label for="last_name">Last Name:</label>
      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
    </div>
  </div>

  <div class="form-group">
    <label for="email">Email:</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
  </div>

  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>

  <div class="form-group">
    <label for="password_confirmation">Password:</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
  </div>

  <button class="btn btn-primary" type="submit">Submit</button>
</form>