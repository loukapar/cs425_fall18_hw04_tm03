<?php
	session_start();
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
	
	$username = null;
	$password = null;
	
	$data = json_decode(file_get_contents("php://input"));
	if (empty($data->username) && empty($data->password)){
		$_SESSION["authenticated"] = 'false';
		echo json_encode("");
		exit();
	}

	
	include_once '../config/Database.php';
	if((empty($_SESSION["authenticated"])) && ($_SESSION["authenticated"] != 'true') && ($_SESSION["authenticated"] != 'false')){
		$_SESSION['times'] = 0;
		unset($_SESSION['last_login_time']);
	}
		
	
	// Instantiate DB & connect
	$database = new Database();	
	$db = $database->connect();

	
	if (isset($_SESSION['last_login_time'])){
		if (time() - $_SESSION['last_login_time'] > 5*60) {
			$_SESSION['times'] = 0;
			unset($_SESSION['last_login_time']);
		}
	}

	if ($_SESSION['times'] < 3) {
		unset($_SESSION['last_login_time']);
				
		$username = htmlspecialchars(strip_tags($data->username)); 
		$password = htmlspecialchars(strip_tags($data->password)); 
		if (!empty($username) && !empty($password)) {
			if (validateUser($username, $password, $db)) {
				$_SESSION["authenticated"] = 'true';
				echo json_encode(
					array('message' => 'Connected!', 'stat' => 'success')
				);
				
			} else {
				$_SESSION['times'] += 1;
				$_SESSION["authenticated"] = 'false';
				echo json_encode(
					array('message' => 'Something went wrong. Try again!', 'stat' => 'error')
				);
			}
		} else {
			$_SESSION['times'] += 1;
			$_SESSION["authenticated"] = 'false';
						echo json_encode(
				array('message' => 'Something went wrong. Try again!', 'stat' => 'error')
			);
		}
	} else {
			$_SESSION["authenticated"] = 'false';
			if (!isset($_SESSION['last_login_time']))
				$_SESSION['last_login_time'] = time();
			$msg = 'You have exceeded the maximum number of attempts. Try again in 5 minutes';
			echo json_encode(
				array('message' => $msg, 'stat' => 'error')
			);
	}
	
	function validateUser($username, $password, $conn) {
		$dbstoredpassword = null;
		$query = "SELECT password FROM USER WHERE username = '" . $username . "' ";
		$stmt = $conn->prepare($query);
		
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num > 0) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$dbstoredpassword = $row['password'];
			if (password_verify($password, $dbstoredpassword)){
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
?>