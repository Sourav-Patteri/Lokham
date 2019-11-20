<?php
$db_config = new stdClass;
$db_config->host = "localhost";
$db_config->dbname = "lokham";
$db_config->username = "root";
$db_config->password = "";

$conn = new PDO("mysql:host={$db_config->host};dbname={$db_config->dbname}", $db_config->username, $db_config->password);

// class Connect {
//     public $connection;
  
//     function __construct ($host, $dbname, $username, $password) {
//       $self->connection = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
//     }
//   }
  
//   $conn = (new Connect('localhost', 'lokham', 'root', ''))->connection;