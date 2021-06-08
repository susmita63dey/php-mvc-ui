<?php

include '../db.php';
include '../Item.php';

$datas = array();

$database = new Database();
$db = $database->getConnection();

$item = new Item($db);

$stmt = $item->read();

if($stmt->rowCount() > 0){
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$datas[] = array(
			"status" => true,
			"success" => "Successfully retrieved",
			"item_id" => $row['item_id'],
			"name" => $row['name'],
			"price" => $row['price']
		);
	}
}else{
	$datas = array(
		"status" => false,
		"error" => "Could not retrieve data"
	);
}
echo json_encode($datas);
?>