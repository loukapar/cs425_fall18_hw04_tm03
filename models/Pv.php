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
	public $encoded_image;
	
	public function __construct($db) {
		$this->conn = $db;
    }
	
	public function IsNullOrEmptyString($str){
		return (!isset($str) || trim($str) === '');
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
	
	public function loadImage(){
		$data = $this->encoded_image;
		if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
			$data = substr($data, strpos($data, ',') + 1);
			$type = strtolower($type[1]); // jpg, png, gif

			if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
				return false;
				//throw new \Exception('invalid image type');
			}

			$data = base64_decode($data);

			if ($data === false) {
				return false;
				//throw new \Exception('base64_decode failed');
			}
		} else {
			return false;
			//throw new \Exception('did not match data URI with image data');
		}
		$file_name = "pv" . $this->pv_id . "." . $type;
		$file_dir = "../resources/" . $file_name;
		file_put_contents($file_dir, $data);
		
		$update_image_pv = array (
			$this->pv_id,
			array("pv_photo", $file_name)
		);
		
		return $this->update($update_image_pv);
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
		
		if($stmt->execute()) {
			$this->pv_id = $this->conn->lastInsertId();
			if ($this->IsNullOrEmptyString($this->encoded_image) == true){
				$array = array ("img_response" => "", "pv_id" => $this->pv_id);
				return $array;
			} else {
				$res = $this->loadImage();
				if ($res == true){
					$array = array ("img_response" => "Image uploaded successfully!", "pv_id" => $this->pv_id);
					return $array;
				} else {
					$array = array ("img_response" => "Something went wrong with the image. Try upload again in edit section!", "pv_id" => $this->pv_id);
					return $array;
				}
			}
		}
			
		$array = array ("img_response" => "Something went wrong! Try again", "pv_id" => -1);
		return $array;
		
	}

	public function update($data) {
		//create query
		
		$query = 'UPDATE ' . $this->table . ' SET ';
		for ($i = 1; $i < sizeof($data); $i++) {
			if ($data[$i][0] == "encoded_image") {
				if ($this->IsNullOrEmptyString($data[$i][1]) == false) {
					$this->pv_id = $data[0];
					$this->encoded_image = $data[$i][1];
					$this->loadImage();
				}
			} else {
				if ($i > 1)
					$query = $query . ', ' . $data[$i][0] . ' = :' . $data[$i][0];
				else 
					$query = $query . $data[$i][0] . ' = :' . $data[$i][0];
			}
		}
		$query = $query . ' WHERE pv_id = :pv_id'; 
		
		// Prepare statement
		$stmt = $this->conn->prepare($query);
		//return $query;
		
		$stmt->bindParam(':pv_id', $data[0]);
		for ($i = 1; $i < sizeof($data); $i++) {
			if (($data[$i][0] == "encoded_image")) {
			
			} else {
				$keyvalue = ':' . $data[$i][0];
				$stmt->bindParam($keyvalue, htmlspecialchars(strip_tags($data[$i][1])));
			}
		}
		
		// Execute query
		if($stmt->execute()) {
			return true;
		}

		// Print error if something goes wrong
		//printf("Error: %s.\n", $stmt->error);
		return true;
    }
	
	
	    // Delete pv
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE pv_id = :pv_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->pv_id = htmlspecialchars(strip_tags($this->pv_id));

          // Bind data
          $stmt->bindParam(':pv_id', $this->pv_id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          //printf("Error: %s.\n", $stmt->error);

          return false;
    }
}
?>