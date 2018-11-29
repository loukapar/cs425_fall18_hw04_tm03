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

		$num = $stmt->rowCount();
		if($num > 0) {
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
		} else {
			$this->pv_id = -1;
		}
    }
	
    // Create pv
    public function create() {
		
		// Create query
		$query = 'INSERT INTO ' . $this->table . ' SET pv_name = :name, pv_address = :address, pv_coordinate_x = :coordinate_x, 
			pv_coordinate_y = :coordinate_y, pv_operator = :operator, pv_date = :date, pv_description = :description, pv_power = :power, 
			pv_annual_production = :annual_production, pv_co2_avoided = :co2_avoided, pv_reimbursement = :reimbursement, 
			pv_solar_panel_module = :solar_panel_module, pv_azimuth_angl = :azimuth_angl, pv_inclination_angl = :inclination_angl, 
			pv_communication = :communication, pv_inverter = :inverter, pv_sensors = :sensor;';

          // Prepare statement
		$stmt = $this->conn->prepare($query);

		$this->pv_name = htmlspecialchars(strip_tags($this->pv_name)); 
		$this->pv_address = htmlspecialchars(strip_tags($this->pv_address));
		$this->pv_coordinate_x = htmlspecialchars(strip_tags($this->pv_coordinate_x));
		$this->pv_coordinate_y = htmlspecialchars(strip_tags($this->pv_coordinate_y));
		$this->pv_operator = htmlspecialchars(strip_tags($this->pv_operator));
		$this->pv_date = htmlspecialchars(strip_tags($this->pv_date));
		$this->pv_description = htmlspecialchars(strip_tags($this->pv_description));
		$this->pv_power = htmlspecialchars(strip_tags($this->pv_power));
		$this->pv_annual_production = htmlspecialchars(strip_tags($this->pv_annual_production));
		$this->pv_co2_avoided = htmlspecialchars(strip_tags($this->pv_co2_avoided));
		$this->pv_reimbursement = htmlspecialchars(strip_tags($this->pv_reimbursement));
		$this->pv_solar_panel_module = htmlspecialchars(strip_tags($this->pv_solar_panel_module));
		$this->pv_azimuth_angl = htmlspecialchars(strip_tags($this->pv_azimuth_angl));
		$this->pv_inclination_angl = htmlspecialchars(strip_tags($this->pv_inclination_angl));
		$this->pv_communication = htmlspecialchars(strip_tags($this->pv_communication));
		$this->pv_inverter = htmlspecialchars(strip_tags($this->pv_inverter));
		$this->pv_sensors = htmlspecialchars(strip_tags($this->pv_sensors));
		  

          // Bind data
		$stmt->bindParam(':name', $this->pv_name);
		$stmt->bindParam(':address', $this->pv_address);
		$stmt->bindParam(':coordinate_x', $this->pv_coordinate_x);
		$stmt->bindParam(':coordinate_y', $this->pv_coordinate_y);
		$stmt->bindParam(':operator', $this->pv_operator);
		$stmt->bindParam(':date', $this->pv_date);
		$stmt->bindParam(':description', $this->pv_description);
		$stmt->bindParam(':power', $this->pv_power);
		$stmt->bindParam(':annual_production', $this->pv_annual_production);
		$stmt->bindParam(':co2_avoided', $this->pv_co2_avoided);
		$stmt->bindParam(':reimbursement', $this->pv_reimbursement);
		$stmt->bindParam(':solar_panel_module', $this->pv_solar_panel_module);
		$stmt->bindParam(':azimuth_angl', $this->pv_azimuth_angl);
		$stmt->bindParam(':inclination_angl', $this->pv_inclination_angl);
		$stmt->bindParam(':communication', $this->pv_communication);
		$stmt->bindParam(':inverter', $this->pv_inverter);
		$stmt->bindParam(':sensor', $this->pv_sensors);

		// Execute query
		$new_pv_id = "-1";
		if($stmt->execute()) {
			$query2 = 'SELECT LAST_INSERT_ID();';
			$stmt2 = $this->conn->prepare($query2);
			$stmt2->execute();
			$num2 = $stmt2->rowCount();
			if($num2 > 0) {
				$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
				$new_pv_id = $row2['pv_id'];
			}
			return "1";
		}

		printf("Error: %s.\n", $stmt->error);

		return "0";
	}
	/*

		if(isset($result) && !(trim($result) === '') && ($result > 0)) {
			$new_pv_id;
			while($row = $result->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$new_pv_id => $pv_id;
			}
			return $new_pv_id;
		}

		// Print error if something goes wrong
		printf("Error: %s.\n", $stmt->error);

		return -1;
    }
	
	
	public function update($data) {
		//create query
		$query = 'UPDATE ' . $this->table . ' SET ';
		for ($i = 1; $i < sizeof($data); $i++) {
			if ($i > 1)
				$query = $query . ', ' . $data[$i][0] . ' = :' . $data[$i][0];
			else 
				$query = $query . $data[$i][0] . ' = :' . $data[$i][0];
		}
		$query = $query . ' WHERE pv_id = :pv_id'; 

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':pv_id', $data[0]);
		for ($i = 1; $i < sizeof($data); $i++) {
			$keyvalue = ':' . $data[$i][0];
			$stmt->bindParam($keyvalue, htmlspecialchars(strip_tags($data[$i][1])));
		}
		
		// Execute query
		if($stmt->execute()) {
			return true;
		}

		// Print error if something goes wrong
		printf("Error: %s.\n", $stmt->error);

		return false;
    }
	
	    // Delete pv
    public function delete($pv_id) {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE pv_id = :pv_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $pv_id = htmlspecialchars(strip_tags($pv_id));

          // Bind data
          $stmt->bindParam(':pv_id', $pv_id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
	*/
}
?>