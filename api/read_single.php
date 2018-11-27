<?php 
	// Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../config/Database.php';
	include_once '../models/Pv.php';

	// Instantiate DB & connect
	$database = new Database();
	$db = $database->connect();

	// Instantiate blog post object
	$pv = new Pv($db);

	// Get ID
	$pv->pv_id = isset($_GET['pv_id']) ? $_GET['pv_id'] : die();

	// Get pv
	$pv->read_single();
  
	if ($pv->pv_id > 0) {
	// Create array
		$pv_array = array(  
			'pv_id' => $pv->pv_id,
			'pv_name' => $pv->pv_name,
			'pv_photo' => $pv->pv_photo,
			'pv_address' => $pv->pv_address,
			'pv_coordinate_x' => $pv->pv_coordinate_x,
			'pv_coordinate_y' => $pv->pv_coordinate_y,
			'pv_operator' => $pv->pv_operator,
			'pv_date' => $pv->pv_date,
			'pv_description' => $pv->pv_description,
			'pv_power' => $pv->pv_power,
			'pv_annual_production' => $pv->pv_annual_production,
			'pv_co2_avoided' => $pv->pv_co2_avoided,
			'pv_reimbursement' => $pv->pv_reimbursement,
			'pv_solar_panel_module' => $pv->pv_solar_panel_module,
			'pv_azimuth_angl' => $pv->pv_azimuth_angl,
			'pv_inclination_angl' => $pv->pv_inclination_angl,
			'pv_communication' => $pv->pv_communication,
			'pv_inverter' => $pv->pv_inverter,
			'pv_sensors' => $pv->pv_sensors
		);
	// Make JSON
	echo json_encode($pv_array);
  } else {
		echo json_encode(
			array('message' => 'No PV Found')
		);
  }
  
  
  ?>