<?php

class Connect {

  private $host = 'localhost';
  private $user = 'root';
  private $password = '';
  private $dbname = 'database';

  public function connect(){
    $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  }
}




 ?>
