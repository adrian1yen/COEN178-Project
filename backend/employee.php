<?php
	include 'helper_functions.php';
	$uri = $_SERVER['REQUEST_URI'];
	$uri = explode('/', $uri);
	end($uri);
	$uri = prev($uri);
	
	if($uri == 'employees') {
		selectSQL("SELECT * FROM Employee");
	}
	if($uri == 'rental_properties') {
		selectSQL("SELECT * FROM Rental_Property");
	}
	if($uri == 'rental_properties') {
		selectSQL("SELECT * FROM Rental_Property");
	}
?>
