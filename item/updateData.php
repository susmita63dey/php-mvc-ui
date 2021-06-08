<?php

include '../db.php';
include '../Item.php';

$database = new Database();
$db = $database->getConnection();

$item = new Item($db);

$item_id = $_POST['item_id'];
$name = $_POST['name'];
$price = $_POST['price'];

if(empty($item_id) || empty($name) || empty($price)){
	if(empty($item_id)){
		echo "Id cannot be empty";
	}

	if(empty($name)){
		echo "Name cannot be empty";
	}

	if(empty($price)){
		echo "Price cannot be empty";
	}
}else{
	$item->item_id = $item_id;
	$item->name = $name;
	$item->price = $price;

	if($item->update()){
		$datas = array(
			"status" => true,
			"success" => "Successfully updated"
		);
	}else{
		$datas = array(
			"status" => false,
			"error" => "Could not update"
		);
	}
	echo json_encode($datas);
}

?>