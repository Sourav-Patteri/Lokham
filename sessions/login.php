<?php include('../_config.php') ?>
<?php
  $_title = "Login - Lokham";
  $_active = "login";
?>

<?php include(ROOT . '/partials/_header.php') ?>

<div class="container">
  <header class="mt-5">
    <h1>Login</h1>
  </header>

  <section>
    <form action="./authenticate.php" method="post">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="<?= $form_data['email'] ?? null ?>">
      </div>

      <div class="form-group">
        <label for="email">Password:</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
      </div>
      <button class="btn btn-primary" type="submit">Login</button>
    </form>
  </section>

  <div>
    <small> Haven't signed up yet? No Problemo! <a href="<?= base_path ?>/users/new.php">Click here to Sign Up</a>!</small>
  </div>
</div>

<?php include(ROOT . '/partials/_footer.php') ?>