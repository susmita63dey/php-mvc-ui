<?php
class Database{
  private $host = "localhost";
  private $db_name = "shop_db";
  private $user = "root";
  private $password = "";
  public $conn;

  //get the database connection
  public function getConnection(){
    $this->conn = null;
    try{
      $this->conn  = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->password);
      //$this->conn->exec("set names utf8");
      //echo "Connection done!";
    }catch(PDOException $e){
      echo "Connection Error: ". $e->getMessage();
    }
    return $this->conn;
  }
}
?>