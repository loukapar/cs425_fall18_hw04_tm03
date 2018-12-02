<?php 
	// Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
	
	include_once '../config/Database.php';
	
	// Instantiate DB & connect
	$database = new Database();	
	$db = $database->connect();
	
	// Get raw posted data
	$data = json_decode(file_get_contents("php://input"));
	
	$username = htmlspecialchars(strip_tags($data->username)); 
	$password = htmlspecialchars(strip_tags($data->password)); 
	
	$query = 'INSERT INTO USER SET username = :username, password = :password;';
	$stmt = $db->prepare($query);
	
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':password', password_hash($password,PASSWORD_DEFAULT));
	
	if($stmt->execute()) {
		echo json_encode(
			array('message' => 'Account created successfully!', 'stat' => true)
		);
	} else {
		echo json_encode(
			array('message' => 'Something went wrong. Try again!', 'stat' => false)
		);
		
	}
?>