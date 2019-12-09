<?php include_once(dirname(__DIR__) . '/_config.php') ?>

<?php
  // Get the posts (but we'll also need the author)
  include_once(ROOT . "/includes/_connect.php");

  $sql = "SELECT *, issues.issue_id as id FROM lokham.issues
    JOIN users ON issues.user_id = users.id
    WHERE issues.issue_id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
  $stmt->execute();
  $issue = $stmt->fetch();

  $sql = "SELECT *, comments.comment_id as id FROM comments
    JOIN users ON comments.user_id = users.id  
    WHERE comments.issue_id = {$issue['id']}";
  $comments = Connect::query($sql);




?>

<?php include_once(ROOT . '/partials/_header.php') ?>

<article class="container">
  <header class="mt-5">
    <div style="width: 100%;" class="clearfix mt-3">
      <small class="pull-right"><?= $issue['updated_at'] ?></small>
    </div>

    <h1>
    <?= $issue['title'] ?>
      <br>
      <small>By <?= $issue['first_name'] ?> <?= $issue['last_name'] ?></small>
    </h1>
  </header>

  <hr class="m-5">

  <section class="ml-5">
    <div class="row">
      <div class="col-4">
        <img src="<?=$issue['image'] ?? base_path . '/img/world_tree.jpg'?>" alt="Posted Image" class="mr-4 img-fluid">
      </div>

      <div class="col-8">
        <?= $issue['content'] ?>
      </div>
    </div>
  </section>  

  <hr class="m-5">

  <p class="ml-5">
    <a href="<?= base_path ?>/issues/">Return to archives...</a>
    <?php if (ADMIN || isset($_SESSION['user']['id']) && $_SESSION['user']['id'] === $issue['user_id']): ?>
      |
      <a href="<?= base_path ?>/issues/edit.php?id=<?= $issue['id'] ?>">
        <i class="fa fa-pencil"></i>
        edit
      </a>
      |
      <a href="<?= base_path ?>/issues/destroy.php?id=<?= $issue['id'] ?>" onclick="return confirm('Are you sure you want to delete this issue?')">
        <i class="fa fa-trash"></i>
        delete
      </a>
    <?php endif ?>
  </p>
</article>

<hr class="m-5">

<div class="container">
  <?php
    if (AUTH) {
      include_once(ROOT . "/comments/_form.php");
    }
  ?>
</div>

<?php if (isset($comments) && count($comments) > 0): ?>
  <div class="container" id="comments">
    <h2>Comments</h2>

    <div class="mt-5">
      <ul class="list-group">
        <?php foreach ($comments as $comment): ?>
          <li class="list-group-item">
            <h5 class="mb-4">
     
              <small>&nbsp;&mdash;&nbsp;<?= $comment['first_name'] ?> <?= $comment['last_name'] ?></small>
            </h5>
            <hr>
            <div class="ml-5 d-flex flex-row justify-content-between align-items-center">
            <img src="<?= $comment['profile_image'] ?? base_path . '/img/world_tree.jpg'?>" alt="placeholder" class="img-fluid img-thumbnail mr-2" style="max-width: 150px; border-radius: 150px;">
              <p class="lead">
                <!-- sorry, thats how we made it work, will  change it soon :) -->
                <?php 
                 $sql = "SELECT rating FROM ratings
                 WHERE ratings.issue_id = {$comment['issue_id']} AND 
                 ratings.user_id = {$comment['user_id']}";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $rating = $stmt->fetch();
                  // var_dump($rating);
                ?>
                Rating :
              <?= $rating['rating'][0] ?>/5
              </p>
              <p>
                <?= $comment['comment'] ?>
              </p>
            </div>
          </li>
        <?php endforeach ?>
      </ul>
    </div>
  </div>
<?php endif ?>

<?php include_once(ROOT . '/partials/_footer.php') ?>