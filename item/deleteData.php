<?php 

include '../db.php';
include '../Item.php';

$database = new Database();
$db = $database->getConnection();

$item = new Item($db);

$item_id = $_POST['item_id'];

if(empty($item_id)){
	echo "item id cannot be empty";
}else{
	$item->item_id = $item_id;
	if($item->delete()){
		$datas = array(
			"status" => true,
			"success" => "Deleted successfully"
		);
	}else{
		$datas = array(
			"status" => false,
			"error" => "Could not delete"
		);
	}
	echo json_encode($datas);
}
?>