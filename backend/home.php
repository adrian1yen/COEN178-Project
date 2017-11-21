<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	crossorigin="anonymous">
</head>

<?php
	function selectSQL($conn, $sql) {
		 //create SQL statement
		$sql_statement = OCIParse($conn, $sql);
		$i = OCIExecute($sql_statement);

		// get number of columns for use later
		$num_columns = OCINumCols($sql_statement);


		//// start results formatting
		echo "<div class='container'>";
		echo "<table class='table table-bordered'>";
		echo "<TR>";
		for ($i = 1; $i <= oci_num_fields($sql_statement); ++$i) {
			echo "<TH>" . oci_field_name($sql_statement, $i) . "</TH>";
		}
		while ($row = oci_fetch_array($sql_statement, OCI_ASSOC+OCI_RETURN_NULLS)) {
			echo "<tr>\n";
			foreach ($row as $item) {
				echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
			}
			echo "</tr>\n";
		}
		echo "</TABLE>";
		echo "</div>";

		// free resources and close connection
		OCIFreeStatement($sql_statement);
	}

	$username = '';
	$password = '';
	$conn=oci_connect($username,$password,
	'//dbserver.engr.scu.edu/db11g');
	if($conn) {
		print "<br> Connection to the database successful <br>";
	} else {
		$e = oci_error;
		print "<br> connection failed:";
		print htmlentities($e['message']);
		exit;
	}

	$queries = file_get_contents('../sql/query.sql');
	$queries = explode(';', $queries);

	foreach($queries as $query) {
		if(strlen($query) > 1) {
			selectSQL($conn, $query);
			echo "<br>";
		}
	}

	//selectSQL($conn, "SELECT * FROM Lease");
	//echo "<br>";
	//selectSQL($conn, "SELECT * FROM Rental_Property");
	//echo "<br>";
	//selectSQL($conn, "SELECT * FROM Property_Owner");
	//echo "<br>";
	//selectSQL($conn, "SELECT * FROM Branch");
	//echo "<br>";
	//selectSQL($conn, "SELECT * FROM Supervisor");
	//echo "<br>";
	//selectSQL($conn, "SELECT * FROM Manager");
	//echo "<br>";
	//selectSQL($conn, "SELECT * FROM Employee");
	//echo "<br>";

	OCILogoff($conn);
?>
