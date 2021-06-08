<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
class Item{

	private $conn;
	private $table_name = "items";

	public $item_id;
	public $name;
	public $price;
	public $created_at;


	public function __construct($db){
		$this->conn = $db;
	} 

	public function add(){
		$query = "INSERT INTO " . $this->table_name . " SET name= :name, price= :price, created_at= :created_at";
		$stmt = $this->conn->prepare($query);

		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->price=htmlspecialchars(strip_tags($this->price));
		$this->created_at=htmlspecialchars(strip_tags($this->created_at));

		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":price", $this->price);
		$stmt->bindParam(":created_at", $this->created_at);

		try{
			$stmt->execute();
			return true;
		}catch(PDOException $e){
			echo "Error". $e->getMessage();
			return false;
		}
	}

	public function read(){
		$query = "SELECT * FROM ".$this->table_name." ORDER BY name ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
        return $stmt;
	}

	public function read_single(){
		$query = "SELECT * FROM ".$this->table_name." WHERE item_id ='".$this->item_id."'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
        return $stmt;
	}

	public function update(){
		$query = "UPDATE " . $this->table_name . " SET name= :name, price= :price WHERE  item_id = :item_id";
		$stmt = $this->conn->prepare($query);

		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->price=htmlspecialchars(strip_tags($this->price));
		$this->item_id=htmlspecialchars(strip_tags($this->item_id));

		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":price", $this->price);
		$stmt->bindParam(":item_id", $this->item_id);

		try{
			$stmt->execute();
			return true;
		}catch(PDOException $e){
			echo "Error". $e->getMessage();
			return false;
		}
	}
}

?>