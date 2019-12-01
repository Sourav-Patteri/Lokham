<?php
    if(session_status() === PHP_SESSION_NONE) session_start();
    // assign and unset session variable
    $flash_data = $_SESSION['flash'] ?? null; //null coalescing
    // Clear the session variables so it's blank the next time
    unset($_SESSION['flash']);
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title><?= $_title ?? "Lokham"?></title> <! –– null coalescing -->
    </head>
    <body>
<?php 
include(ROOT . '/partials/_main-nav.php');
include(ROOT . '/partials/_flash.php'); 
?>