<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/Database.php';
  include_once '../models/Pv.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate pv object
  $pv = new Pv($db);

  // PV query
  $result = $post->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Pv array
    $pv_array = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		
		$pv_item = array(
			'pv_id' => $pv_id,
			'pv_coordinate_x' => $pv_coordinate_x,
			'$pv_coordinate_y' => $pv_coordinate_y
		);
		array_push($pv_array, $pv_item);
    }

    // Turn to JSON & output
    echo json_encode($pv_array);

  } else {
    echo json_encode(
      array('message' => 'No PV Found')
    );
  }
