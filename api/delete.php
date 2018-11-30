<?php
  // Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: DELETE');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

	include_once '../../config/Database.php';
	include_once '../models/Pv.php';
	// Instantiate DB & connect
	$database = new Database();
	$db = $database->connect();
	
	$pv = new Pv($db);
	
	// Get raw posted data
	$data = json_decode(file_get_contents("php://input"));
		
	// Delete post
	if($pv->delete($data->pv_id)) {
		echo json_encode(
		array('message' => 'Category deleted')
		);
	} else {
		echo json_encode(
		array('message' => 'Category not deleted')
		);
	}
