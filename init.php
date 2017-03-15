<html>
<?php
	$create_sql_content = file_get_contents('create.sql');
	$trigger_sql_content = file_get_contents('trigger.sql');
	$procdeure_sql_content = file_get_contents('procedure.sql');
	$insert_sql_content = file_get_contents('insert.sql');

	$username = 'ayen';
	$password = 'password12345!';
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

	//create SQL statement
	$sql = "SELECT employee_id, name, phone_number, start_date FROM Employee";
	echo "<strong>CREATING TABLES:</strong><br>";
	$create_sql = explode(';', $create_sql_content);

	for($i = 0; $i < count($create_sql) - 1; $i++) {
		echo $create_sql[$i] . "<br>";
		// parse SQL statement
		$sql_statement = OCIParse($conn, $create_sql[$i]);

		// execute SQL query
		OCIExecute($sql_statement);
	}

	echo "<br><br><strong>CREATING TRIGGERS:</strong><br>";
	$trigger_sql = explode("Show Errors;", $trigger_sql_content);

	for($i = 0; $i < count($trigger_sql) - 1; $i++) {
		echo substr($trigger_sql[$i], 0, -2) . "<br>";
		$sql_statement = OCIParse($conn, $trigger_sql[$i]);
		OCIExecute($sql_statement);
		$e = oci_error($sql_statement);  // For oci_execute errors pass the statement handle
		echo htmlentities($e['message']);
	}
	
	// free resources and close connection
	OCIFreeStatement($sql_statement);
	OCILogoff($conn);
?>
</html>
