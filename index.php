<?php
include_once(__DIR__ . '../_config.php');
include_once(ROOT . '/includes/_connect.php');

$_title = "Lokham - Register or Log in";
$_active = "lokham";
include(ROOT . '/partials/_header.php');

if (session_status() === PHP_SESSION_NONE) session_start();
?>
<style type="text/css">
    #home-section {
        background: url(./img/world_tree.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        min-height: 700px;
    }

    #home-section .home-overlay {
        position:inherit;
        top: 0;
        left: 0;
        width: 100%;
        min-height: 700px;
        background: rgba(260, 260, 260, .5)
    }

    #home-section .home-inner {
        padding-top:50px;
    }
</style>
<section id="home-section">
    <div class="home-overlay">
        <div class="home-inner container">
            <header class="m-5 text-center">
                <h1 class="display-3 font-weight-bold">Lokham</h1>
            </header>
            <div class="row">
                <div class="col-lg-8 d-none d-lg-block">
                    <div class="h3">

                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit, accusamus laboriosam obcaecati, fugit voluptatem quasi quas corrupti non explicabo officia amet iste illo voluptatibus quia. Vitae beatae ad illum consequuntur.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, sint. Praesentium numquam, porro, quos ex necessitatibus nihil consectetur, quidem blanditiis iure nisi vitae amet saepe aut incidunt minima facilis quaerat!</p>
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, sint. Praesentium numquam, porro, quos ex necessitatibus nihil consectetur, quidem blanditiis iure nisi vitae amet saepe aut incidunt minima facilis quaerat!</p> -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-secondary text center card-form">
                        <div class="card-body">
                            <h3 class="mb-2" >Talk about whats happening in the world right now</h3>
                            <p>Join Lokham today</p>
                            <div class="d-flex flex-column">
                                    <a class="btn btn-info m-2" href="<?= base_path ?>/users/new.php">Sign-up</a>
                                    <a  class="btn btn-info m-2" href="<?= base_path ?>/sessions/login.php">Login</a>
                            </div> <!-- flex div end -->
                        </div>
                    </div>
                </div> <!-- left div end -->

            </div> <!-- row div end -->
        </div> <!-- homme-inner and container div end -->
    </div>
</section>
<?php include(ROOT . '/partials/_footer.php') ?>