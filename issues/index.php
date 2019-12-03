<?php include_once('../_config.php') ?>

<?php
// get the posts( and the user)
include_once(ROOT . "/includes/_connect.php");
// $conn = connect();

$sql = "SELECT *, issue.id as id, issues.updated_at as updated_at 
            FROM posts
            JOIN users ON issues.user_id = users.id";
$issues = $conn->query($sql)->fetchAll();

// var_dump($issues);
?>