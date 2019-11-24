<?php
class Connect {
   public $host = "localhost";
   public $dbname = "lokham";
   public $username = "root";
   public $password = "";

  
    public function connect() {
      $db = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
      $pdo = new PDO($db, $this->username, $this->password);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
      return $pdo;
    }
}

  