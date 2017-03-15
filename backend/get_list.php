<?php
	include 'helper_functions.php';
	$uri = $_SERVER['REQUEST_URI'];
	$uri = explode('/', $uri);
	end($uri);
	$uri = prev($uri);
	
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		if($uri == 'employee') {
			selectSQL("SELECT * FROM Employee");
		}
		if($uri == 'rental_property') {
			selectSQL("SELECT * FROM Rental_Property ORDER BY to_number(rental_id) ASC");
		}
		if($uri == 'manager') {
			selectSQL("SELECT * FROM Manager");
		}
		if($uri == 'supervisor') {
			selectSQL("SELECT * FROM Supervisor");
		}
		if($uri == 'branch') {
			selectSQL("SELECT * FROM Branch");
		}
		if($uri == 'lease') {
			selectSQL("SELECT Lease.*, TO_CHAR(end_date, 'MM/DD/YYYY') as end_date, TO_CHAR(start_date, 'MM/DD/YYYY') as start_date   FROM Lease");
		}
		if($uri == 'property_owner') {
			selectSQL("SELECT *  FROM Property_Owner ORDER BY to_number(owner_id) DESC");
		}
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if($uri == 'user_profile') {
			$postdata = file_get_contents("php://input");
			$postdata = json_decode($postdata, true);
			if(isset($postdata['username']) && isset($postdata['password'])) {
				// Form variables
				$sql = "BEGIN addPropertyOwner(";
				$flag = false;
				foreach($postdata as $value) {
					if($flag) {
						$sql = $sql . ",";
					}
					$sql = $sql . "'" . strip_tags($value) . "'";
					$flag = true;
				}
				$sql = $sql . "); END;";

				insertSQL($sql);
			} else {
				http_response_code(400);
				print "All fields required.";
			}
		}
		if($uri == 'rental_property') {
			$postdata = file_get_contents("php://input");
			$postdata = json_decode($postdata, true);
			if(isset($postdata['street']) && isset($postdata['city']) && isset($postdata['zipcode']) && isset($postdata['rooms']) && 
				isset($postdata['rent']) && isset($postdata['supervisor']) && isset($postdata['owner'])) {
				$sql = "INSERT INTO Rental_Property VALUES(rental_property_sequence.nextval, ";
				$flag = false;
				foreach($postdata as $value) {
					if($flag) {
						$sql = $sql . ",";
					}
					$sql = $sql . "'" . strip_tags($value) . "'";
					$flag = true;
				}
				$sql = $sql . ", 'available')";

				insertSQL($sql);
				$sql = "SELECT * FROM (SELECT * FROM Rental_Property WHERE owner_id='". strip_tags($postdata['owner']) . "' ORDER BY to_number(rental_id) DESC) WHERE ROWNUM=1";
				selectSQL($sql);
			} else {
				http_response_code(400);
				print "All fields required.";
			}
			
		}
		if($uri == 'lease') {
			$postdata = file_get_contents("php://input");
			$postdata = json_decode($postdata, true);
			if(isset($postdata['rental_id']) && isset($postdata['renter_name']) && isset($postdata['home_phone']) && isset($postdata['work_phone']) && 
				isset($postdata['emergency_phone']) && isset($postdata['emergency_name']) && isset($postdata['start_date']) && isset($postdata['end_date'])) { 
				$sql = "BEGIN addLease(lease_sequence.nextval,";
				$flag = false;
				$postdata['start_date'] = "TO_DATE('" . $postdata['start_date'] . "', 'MM/DD/YYYY')";
				$postdata['end_date'] = "TO_DATE('" . $postdata['end_date'] . "', 'MM/DD/YYYY')";
				$sql = $sql . "'" . strip_tags($postdata['rental_id']) . "',";
				$sql = $sql . "'" . strip_tags($postdata['renter_name']) . "',";
				$sql = $sql . "'" . strip_tags($postdata['home_phone']) . "',";
				$sql = $sql . "'" . strip_tags($postdata['work_phone']) . "',";
				$sql = $sql . "'" . strip_tags($postdata['emergency_phone']) . "',";
				$sql = $sql . "'" . strip_tags($postdata['emergency_name']) . "',";
				$sql = $sql . strip_tags($postdata['start_date']) . ",";
				$sql = $sql . strip_tags($postdata['end_date']);
				$sql = $sql . "); END;";

				insertSQL($sql);

				$sql = "SELECT * FROM (SELECT * FROM LEASE WHERE rental_id='". strip_tags($postdata['rental_id']) . "' ORDER BY to_number(lease_id) DESC) WHERE ROWNUM=1";
				selectSQL($sql);
			} else {
				http_response_code(400);
				print "All fields required.";
			}
			
		}
		if($uri == 'login') {
			$postdata = file_get_contents("php://input");
			$postdata = json_decode($postdata, true);
			if(isset($postdata['username']) && isset($postdata['password'])) {
				// Form variables
				$username = strip_tags($postdata['username']);
				$password = strip_tags($postdata['password']);
				$sql = "SELECT User_Profile.user_id, username, owner_id FROM User_Profile LEFT JOIN Property_Owner ON User_Profile.user_id = Property_Owner.user_id WHERE username='" . $username . "' AND password='" . $password . "'";
				selectSQL($sql);
			} else {
				http_response_code(400);
				print "All fields required.";
			}
		}
	}
?>
