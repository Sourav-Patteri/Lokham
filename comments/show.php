<?php include_once(dirname(__DIR__) . '/_config.php') ?>

<?php
  // Get the posts (but we'll also need the author)
  include_once(ROOT . "/includes/_connect.php");
   
  $sql = "SELECT *, comments.comment_id as id FROM comments
    JOIN users ON comments.user_id = users.id
    WHERE comments.comment_id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
  $stmt->execute();
  $comment = $stmt->fetch();
?>


<?php include_once(ROOT . '/partials/_header.php') ?>

    <article class="container">
        <div>
          <header class="mt-5">
            <h1>
              <br>
              <small>&nbsp;&mdash;&nbsp;~<?= $comment['first_name'] ?> <?= $comment['last_name'] ?></small>
            </h1>
          </header>
                <hr>
                  <div class="ml-5 d-flex flex-row justify-content-between align-items-center">
                    
          
                <div class="col-8">
                  <section>
                    <p><?= $comment['comment'] ?></p>
                  </section>

                  <p>
                    <a href="<?= base_path ?>/issues/show.php?id=<?= $comment['issue_id'] ?>#comments">Return to Issue...</a>
                  </p>
                </div>
                    |
                    <a href="<?= base_path ?>/comments/edit.php?id=<?= $comment['issue_id'] ?>">
                      edit
                    </a>
                    |
                    <a href="<?= base_path ?>/comments/destroy.php?id=<?= $comment['issue_id'] ?>" onclick="return confirm('Are you sure you want to delete this issue?')">
                      Delete
                    </a>
                </p>
              </div>
            </li>
         
        </ul>
      </div>
    </div>

</article>

<?php include_once(ROOT . '/partials/_footer.php') ?>