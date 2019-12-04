<?php
    include_once(dirname(__DIR__) . "/_config.php");
    if(session_status() === PHP_SESSION_NONE) session_start();
    // assign session variables form data and flash data
    $flash_data = $_SESSION['flash'] ?? null; //null coalescing
    $form_data = $_SESSION['form_data'] ?? null;
    // Clear the session variables so it's blank the next time
    unset($_SESSION['flash']);
    unset($_SESSION['form_data']);
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font awesome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- this works better i guess, cooool thanks -->
    <script src="https://kit.fontawesome.com/461864901a.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
        <title><?= $_title ?? "Lokham"?></title> <! –– null coalescing -->
    </head>
    <body>
<?php 
include(ROOT . '/partials/_main-nav.php');
include(ROOT . '/partials/_flash.php'); 
?>