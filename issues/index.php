<?php include_once('../_config.php') ?>

<?php
    // Start the session
    // if(session_status() == PHP_SESSION_NONE) session_start();
    // get the issue( and the user)
    include_once(ROOT . "/includes/_connect.php");
    // $conn = connect();

    $sql = "SELECT *, issue_id as id, issues.updated_at as updated_at FROM issues JOIN users ON issues.user_id = users.id";

    // var_dump($sql);
    $issues = Connect::query($sql);


    var_dump($issues);
?>