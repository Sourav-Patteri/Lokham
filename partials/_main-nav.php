<?php include_once(dirname(__DIR__) . '/_config.php')?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?= base_path ?>/">Lokham</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<!-- quick login option in navbar if not logged in -->
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
          <!-- only display if logged in -->
        <a class="nav-link" href="<?= base_path ?>/">Home</span></a>
      </li>
                <!-- only display if logged in -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_path ?>/users/show.php">My Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_path ?>/posts/create.php">Post</a>
      </li>      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Users
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/users/new.php">Create a New User</a>
          <a class="dropdown-item" href="/users">View All Users</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="/sessions/login.php" class="nav-link">
          <i class="fa fa-unlock"></i>&nbsp;Login
        </a>
      </li>
      <li class="nav-item">
        <a href="/sessions/register.php" class="nav-link">
          <i class="fa fa-user"></i>&nbsp;Register
        </a>
      </li>
      <li class="nav-item">
        <a href="/sessions/logout.php" class="nav-link">
          <i class="fa fa-lock"></i>&nbsp;Logout
        </a>
      </li>
    </ul>
  </div>
</nav>