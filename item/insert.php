<?php
	ini_set('display_errors', 1); 
error_reporting(E_ALL);
	include '../db.php';
	include '../Item.php';

	$database = new Database();
	$db = $database->getConnection();

	$item = new Item($db);

	$name = $_POST['name'];
    $price = $_POST['price'];
    $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
	$created_at = $dateTime->format("Y-m-d h:s:i");

	if(empty($name) || empty($price)) {	

		if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
		
        if(empty($price)) {
            echo "<font color='red'>Price field is empty.</font><br/>";
        }

	}else{	
			$item->name = $name;
			$item->price = $price;
			$item->created_at = $created_at;
			//print_r($item->add());
			if($item->add()){
				$datas = array(
					"status" => true,
					"success" => "Successfully Inserted Values"
				);
			}else{
				$datas = array(
					"status" => false,
					"error" => "Could not insert values"
				);
			}
		
	}
	echo json_encode($datas);	
?>