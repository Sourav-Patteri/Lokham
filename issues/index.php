<?php include_once('../_config.php') ?>

<?php
    // Start the session
    // if(session_status() == PHP_SESSION_NONE) session_start();
    // get the issue( and the user)
    include_once(ROOT . "/includes/_connect.php");
    // $conn = connect();

    $current_page = $_GET['page'] ?? 1;
    $num_of_issues = 10;
    $offset = $num_of_issues * ($current_page - 1);

    // $sql = "SELECT *, issues.issue_id, issues.updated_at as updated_at FROM issues 
    //         JOIN users ON issues.user_id = users.id JOIN ratings ON ratings.rating_id = users.id
    //         ORDER BY ratings.rating DESC LIMIT {$offset}, {$num_of_issues}";
    $sql = "SELECT * FROM lokham.issues 
            JOIN users ON issues.user_id = users.id
            LIMIT {$offset}, {$num_of_issues}";

    // $sql = "SELECT *, avg(rating) FROM lokham.issues
    //         JOIN users ON issues.user_id = users.id
    //         JOIN ratings ON ratings.user_id = users.id
    //         GROUP BY ratings.issue_id
    //         ORDER BY avg(rating) desc 
    //         LIMIT {$offset}, {$num_of_issues}";    
            // $sql = "SELECT * FROM issues JOIN users ON issues.user_id = users.id JOIN ratings ON issues.user_id = ratings.user_id  
            // ORDER BY ratings.rating DESC LIMIT {$offset}, {$num_of_issues}";
    $issues = Connect::query($sql);
    $issues = $conn->query($sql);
    $sql = "SELECT * FROM issues";
    $issue_count = $conn->query($sql)->rowCount();
    $num_of_pages = ceil($issue_count / $num_of_issues);
    ?>
<?php include_once(ROOT . '/partials/_header.php') ?>

<div class="container">
  <header class="mt-5">
    <h1>
       Issues (Archives)
      <br>
      <small>Better your tomorrow, TODAY... </small>
    </h1>
  </header>
</div>
<hr class="m-5">
<div class="container">
  <div class="archives">
    <?php foreach ($issues as $issue): ?>
      <div class="card mb-2">
        <div class="card-body d-flex flex-row justify-content-between align-items-center">
          <div class="mr-4">
            <img src="<?=$issue['image'] ?? base_path . '/img/world_tree.jpg'?>" alt="Posted Image" class="img-fluid img-thumbnail" height="300px" width="300px">
          </div>
          <div>
            <div class="card-title">
              <h3>
                <a href="<?= base_path ?>/issues/show.php?id=<?= $issue['issue_id'] ?>">
                <?= $issue['title'] //do it when you add title to each issue?>
              </a>
              </h3>
              <hr>
              <small>Author: <?= $issue['first_name'] ?> <?= $issue['last_name'] ?></small>
            </div>
            <p class="card-text">
              <?= $issue['content'] ?>
              <?= substr($issue['content'], 0, 200) ?>... <a href="<?= base_path ?>/issues/show.php?id=<?= $issue['issue_id'] ?>">  Learn more <i class="fa fa-hand-o-right"></i></a>
            </p>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>

<nav class="mt-5" aria-label="Page navigation">
  <ul class="pagination justify-content-center">
    <li class="page-item <?= $current_page == 1 ? 'disabled' : null ?>">
      <a href="?page=<?= $current_page - 1 ?>" class="page-link">Previous</a>
    </li>

    <?php for ($i = 1; $i <= $num_of_pages; $i++): ?>
      <li class="page-item <?= $i == $current_page ? 'active' : null ?>">
        <a href="?page=<?= $i ?>" class="page-link"><?= $i ?></a>
      </li>
    <?php endfor ?>

    <li class="page-item <?= $current_page == $num_of_pages ? 'disabled' : null ?>">
      <a href="?page=<?= $current_page + 1 ?>" class="page-link">Next</a>
    </li>
  </ul>
</nav>

<?php include_once(ROOT . '/partials/_footer.php') ?>
