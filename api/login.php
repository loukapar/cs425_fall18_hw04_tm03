<?php
	session_start();
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
	
	$username = null;
	$password = null;
	
	include_once '../config/Database.php';
	
	if((empty($_SESSION["authenticated"])) && ($_SESSION["authenticated"] != 'true') && ($_SESSION["authenticated"] != 'false'))
		$_SESSION["times"] = 0;
	
	
	// Instantiate DB & connect
	$database = new Database();	
	$db = $database->connect();

	
	if ($_SESSION["times"] < 3) {
		$_SESSION["times"] += 1;
		$data = json_decode(file_get_contents("php://input"));
		
		$username = htmlspecialchars(strip_tags($data->password)); 
		$password = htmlspecialchars(strip_tags($data->password)); 
		if (!empty($username) && !empty($password)) {
		
							echo json_encode(
					array('message' => $data)
				);	
				
		} else {
						echo json_encode(
				array('message' => 'Something went wrong. Try again!')
			);
		}
	} else {
				echo json_encode(
			array('message' => 'You have exceeded the maximum number of attempts. Try again later')
		);
	}
	
		/*
		

		
		if (!empty($username) && !empty($password)) {
			if (validateUser($username, $password, $db)) {
				$_SESSION["authenticated"] = 'true';
				header('Location: ../front_end/map.html');
			} else {
				$_SESSION["authenticated"] = 'false';
				$_SESSION["times"] = $_SESSION["times"] + 1;
				echo json_encode(
					array('message' => 'Something went wrong. Try again!')
				);
			}
		} 
		else {
			$_SESSION["authenticated"] = 'false';
			$_SESSION["times"] = $_SESSION["times"] + 1;

		}
		
	} else {

	}
	*/
	
	//public function validateUser($username, $password, $conn) {
		/*
		$dbstoredpassword = null;
		$query = 'SELECT password FROM USER WHERE username = ?';
		$stmt = $conn->prepare($query);
		$stmt->bindParam(1, $username);
		
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num > 0) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$dbstoredpassword = $row['password'];
			if ($dbstoredpassword == $password)
				return true;
			else
				return false;
		} else {
			return false;
		}
		*/
	//	return true;
	//}

?>