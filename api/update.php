<?php
	// Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: PUT');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

	include_once '../config/Database.php';
	// Instantiate DB & connect
	$database = new Database();
	$db = $database->connect();

	// Get raw posted data
	$data = json_decode(file_get_contents("php://input"));
	
	$pv = new Pv();
	echo json_encode($data);
	
	
	// Update post
	/*
	if($pv->update($data)) {
		echo json_encode(
			array('message' => 'PV Updated')
		);
	} else {
		echo json_encode(
			array('message' => 'PV not updated')
		);
	}
	*/
?>