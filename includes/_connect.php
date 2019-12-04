<?php
// using a constructor
 class Connect {
  public $pdo;

  function __construct ($host, $dbname, $username, $password) {
    try{
    $db = 'mysql:host='.$host.';dbname='.$dbname;
    $this->pdo = new PDO($db, $username, $password);
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $ex){
      echo 'Connection failed: ' . $ex->getMessage();
      exit; 
    }
  }
  public static function query($query, $params = array()) {
    $statement = ((new Connect("localhost", "lokham", "root", ""))->pdo)->prepare($query);
    $statement->execute($params);
    if (explode(' ', $query)[0] == 'SELECT') {
      $data = $statement->fetchAll();
      return $data;
    }
  }
  //to do and implement
  public static function query_bind($query, $params = array()) {
    $statement = ((new Connect("localhost", "lokham", "root", ""))->pdo)->prepare($query);
    $statement->execute($params);
    if (explode(' ', $query)[0] == 'SELECT') {
      $data = $statement->fetchAll();
      return $data;
    }
  }
}

$conn = (new Connect("localhost", "lokham", "root", ""))->pdo;