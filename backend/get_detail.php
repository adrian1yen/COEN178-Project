<?php
	include 'helper_functions.php';
	$uri = $_SERVER['REQUEST_URI'];
	$uri = explode('/', $uri);
	end($uri);
	$id = prev($uri);
	$uri = prev($uri);
	
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		if($uri == 'property_owner') {
			selectSQL("SELECT * FROM Property_Owner WHERE owner_id='" . $id . "'");
		}
		if($uri == 'rental_property') {
			selectSQL("SELECT * FROM Rental_Property WHERE rental_id='" . $id . "' ORDER BY to_number(rental_id) DESC");
		}
		if($uri == 'owner_rental_property') {
			selectSQL("SELECT * FROM Rental_Property WHERE owner_id='" . $id . "' ORDER BY to_number(rental_id) DESC");
		}
		if($uri == 'lease') {
			selectSQL("SELECT Lease.*, TO_CHAR(end_date, 'MM/DD/YYYY') as end_date, TO_CHAR(start_date, 'MM/DD/YYYY') as start_date   FROM Lease LEFT JOIN Rental_Property ON Lease.rental_id = Rental_Property.rental_id  WHERE Rental_Property.owner_id='" . $id . "'");
		}
		if($uri == 'rental_lease') {
			selectSQL("SELECT Lease.*, TO_CHAR(end_date, 'MM/DD/YYYY') as end_date, TO_CHAR(start_date, 'MM/DD/YYYY') as start_date   FROM Lease WHERE rental_id= '" . $id . "'");
		}
	}
	if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
		if($uri == 'rental_property') {
			insertSQL("DELETE FROM Rental_Property WHERE rental_id='" . $id . "'");
		}
		if($uri == 'lease') {
			insertSQL("BEGIN deleteLease('" . $id . "'); END;");
		}
	}
?>
