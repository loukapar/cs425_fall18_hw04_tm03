<?php
  // Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: DELETE');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

	include_once '../config/Database.php';
	include_once '../models/Pv.php';
	// Instantiate DB & connect
	$database = new Database();
	$db = $database->connect();
	
	$pv = new Pv($db);
	
	// Get raw posted data
	$data = json_decode(file_get_contents("php://input"));
	//$pv->pv_id = $data->pv_id;
	// Delete post
	echo json_encode("arxidia: " . $data);
	/*
	if($pv->delete()) {
		echo json_encode(
		array('message' => 'PV deleted')
		);
	} else {
		echo json_encode(
		array('message' => 'PV deleted')
		);
	}
	*/
?>