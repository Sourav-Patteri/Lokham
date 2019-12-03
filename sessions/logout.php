<?php

  include('../_config.php');
  if (session_status() === PHP_SESSION_NONE) session_start();
  
  // Unset the session variable we're using to check if the user is logged in
  unset($_SESSION['user']);

  // Return the user to the home page of the site
  $_SESSION['flash'] = [];
  redirect_with_success(base_path . '/index.php', "You have logged out successfully");