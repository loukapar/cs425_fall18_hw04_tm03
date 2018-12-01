<?php
	session_start();
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
	
	$username = null;
	$password = null;
	
	// Instantiate DB & connect
	$database = new Database();	
	$db = $database->connect();
	
	$data = json_decode(file_get_contents("php://input"));
	
	$username = htmlspecialchars(strip_tags($data->password)); 
	$password = htmlspecialchars(strip_tags($data->password)); 
	
	if (!empty($username) && !empty($password)) {
		
		
		
	}
	
	public function validateUser($username, $password) {
		$query = "SELECT "
	}
?>