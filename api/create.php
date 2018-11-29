<?php 
	// Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

	include_once '../config/Database.php';
	include_once '../models/Pv.php';
	
	// Instantiate DB & connect
	$database = new Database();	
	$db = $database->connect();

	// Instantiate blog post object
	$pv = new Pv($db);

	// Get raw posted data
	$data = json_decode(file_get_contents("php://input"));

	$pv->pv_name = $data->pv_name;
	$pv->pv_address = $data->pv_address;
	$pv->pv_coordinate_x = $data->pv_coordinate_x;
	$pv->pv_coordinate_y = $data->pv_coordinate_y;
	$pv->pv_operator = $data->pv_operator;
	$pv->pv_date = $data->pv_date;
	$pv->pv_description = $data->pv_description;
	$pv->pv_power = $data->pv_power;
	$pv->pv_annual_production = $data->pv_annual_production;
	$pv->pv_co2_avoided = $data->pv_co2_avoided;
	$pv->pv_reimbursement = $data->pv_reimbursement;
	$pv->pv_solar_panel_module = $data->pv_solar_panel_module;
	$pv->pv_azimuth_angl = $data->pv_azimuth_angl;
	$pv->pv_inclination_angl = $data->pv_inclination_angl;
	$pv->pv_communication = $data->pv_communication;
	$pv->pv_inverter = $data->pv_inverter;
	$pv->pv_sensors = $data->pv_sensors;
	$pv->encoded_image = $data->encoded_image;


	// Create pv
	$result = $pv->create();
	echo "done";
	/*
	if ($result[0] == true) {
		echo json_encode {
			array (	'img_response' => 'Image uploaded successfully',
					'pv_id' => $result[1])
		};
	} else {
		echo json_encode {
			array (	'img_response' => 'Something went wrong with the image. Try upload again in edit section!',
					'pv_id' => $result[1])
		};
	}
	*/
	
?>