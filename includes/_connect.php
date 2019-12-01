<?php
// using a class with default values
// class Connect {
//    private $host = "localhost";
//    private $dbname = "lokham";
//    private $username = "root";
//    private $password = "";

  
//     public function connect() {
//       $db = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
//       $pdo = new PDO($db, $this->username, $this->password);
//       $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
//       return $pdo;
//     }
// }
//  $conn = (new Connect())->connect();

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
    $statement = self::connect()->prepare($query);
    $statement->execute($params);
    if(explode($query, ' ')[0] == 'SELECT'){
      $data = $statement->fetchAll();
      return $data;
    }
  }
}

$conn = (new Connect("localhost", "lokham", "root", ""))->pdo;