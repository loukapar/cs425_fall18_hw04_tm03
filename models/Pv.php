<?php
class Pv {
	private $conn;
    private $table = 'PVS';
	
	//object fields
	public $pv_id;
	public $pv_name;
	public $pv_photo;
	public $pv_address;
	public $pv_coordinate_x;
	public $pv_coordinate_y;
	public $pv_operator;
	public $pv_date;
	public $pv_description;
	public $pv_power;
	public $pv_annual_production;
	public $pv_co2_avoided;
	public $pv_reimbursement;
	public $pv_solar_panel_module;
	public $pv_azimuth_angl;
	public $pv_inclination_angl;
	public $pv_communication;
	public $pv_inverter;
	public $pv_sensors;
	
	public function __construct($db) {
		$this->conn = $db;
    }
	
	//get pvs
	public function read() {
		$query = 'SELECT pv_id, pv_coordinate_x, pv_coordinate_y FROM ' . $this->table;
		// Prepare statement
		$stmt = $this->conn->prepare($query);
		// Execute query
		$stmt->execute();
		return $stmt;
	}
	
	//get single pv_address
    public function read_single() {
		// Create query
		$query = 'SELECT * FROM ' . $this->table . ' WHERE pv_id = ?';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Bind ID
		$stmt->bindParam(1, $this->pv_id);

		// Execute query
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->pv_id = $row['pv_id'];
		$this->pv_name = $row['pv_name'];
		$this->pv_photo = $row['pv_photo'];
		$this->pv_address = $row['pv_address'];
		$this->pv_coordinate_x = $row['pv_coordinate_x'];
		$this->pv_coordinate_y = $row['pv_coordinate_y'];
		$this->pv_operator = $row['pv_operator'];
		$this->pv_date = $row['pv_date'];
		$this->pv_description = $row['pv_description'];
		$this->pv_power = $row['pv_power'];
		$this->pv_annual_production = $row['pv_annual_production'];
		$this->pv_co2_avoided = $row['pv_co2_avoided'];
		$this->pv_reimbursement = $row['pv_reimbursement'];
		$this->pv_solar_panel_module = $row['pv_solar_panel_module'];
		$this->pv_azimuth_angl = $row['pv_azimuth_angl'];
		$this->pv_inclination_angl = $row['pv_inclination_angl'];
		$this->pv_communication = $row['pv_communication'];
		$this->pv_inverter = $row['pv_inverter'];
		$this->pv_sensors = $row['pv_sensors'];
    }
}
?>