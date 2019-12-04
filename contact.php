<?php include(__DIR__ . '/_config.php') ?>
<?php
$_title = "Contact Lokham Team";
$_active = "contact";
?>
<?php include(ROOT . '/partials/_header.php') ?>

<section class="py-5">
  <div class="container">
    <div class="row">
      <header class="">
        <h1>
          Contact Lokham Team
        </h1>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia ipsum laboriosam asperiores eum itaque quis.
        </p>
      </header>
      <div class="col-lg-8">

        <form action="mail.php" method="POST">

          <div class="input-group input-group-lg mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fa fa-user"></i>
              </span>
            </div>
            <input type="text" name="contact_name" placeholder="name" class="form-control">
          </div>
          <div class="input-group input-group-lg mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fa fa-envelope"></i>
              </span>
            </div>
            <input type="text" name="contact_email" placeholder="email" class="form-control">
          </div>

          <div class="input-group input-group-lg mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">
               <i class="fa fa-pencil"></i>
              </span>
            </div>
            <textarea placeholder="Message" name="contact_message" rows="5" class="form-control"></textarea>
          </div>
          <input type="Submit" value="Submit" class="btn btn-dark btn-block btn-lg">

        </form>
      </div>
    </div>
  </div>
</section>

<?php include(ROOT . '/partials/_footer.php') ?>