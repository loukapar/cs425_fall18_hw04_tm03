<?php
	include_once 'Database.php';
	
	$database = new Database();
	$db = $database->connect();
	
	$query = 'SELECT * FROM PVS';
	$stmt = $db->prepare($query);
	$stmt->execute();
	
	$num = $stmt->rowCount();
?>