<?php 

include '../db.php';
include '../Item.php';

$database = new Database();
$db = $database->getConnection();

$item = new Item($db);

$item->item_id = $_POST['item_id'];

if(empty($_POST['item_id'])){
	echo "Item id cannot be empty";
}else{
	$stmt = $item->read_single();
	if($stmt->rowCount() > 0){
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$datas = array(
				"item_id" => $row['item_id'],
				"name" => $row['name'],
				"price" => $row['price']
			);
		}
	}else{
		$datas = array(
			"status" => false,
			"error"  => "Error occured"
		);
	}
}
echo json_encode($datas);
?>