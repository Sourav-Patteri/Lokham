<?php 
 include_once(__DIR__ . '../_config.php');
 include_once(ROOT . '/includes/_connect.php');

    $_title = "Lokham - Register or Log in";
    $_active = ""; // what is active?
    include(ROOT . '/partials/_header.php');

    if(session_status() === PHP_SESSION_NONE) session_start();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="well">
            <header class="mt-5">
            <center><h1>Lokham</h1></center>
            </header>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <img src=".\img\world_tree.jpg" alt="World as a tree" class="img-rounded" title="Lokham" height="550px" width="750px">
    </div>
        <div class="d-flex justify-content-center">
            <div class="btn-group-vertical" role="group" aria-label="...">
                <div class="well">
                    <a href="<?= base_path ?>/users/new.php"><button type="button" class="btn btn-info">Sign-up</button></a>
                </div>
                --------------
                <div class="well">
                    <a href="<?= base_path ?>/sessions/login.php"><button type="button" class="btn btn-info">Login</button></a>
                </div>
            </div>
        </div>
</div>

<?php include(ROOT . '/partials/_footer.php') ?>