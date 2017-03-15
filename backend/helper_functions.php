<?php
	function connectSQL() {
		$username = 'ayen';
		$password = 'password12345!';
		$conn=oci_connect($username,$password,
		'//dbserver.engr.scu.edu/db11g');

		return $conn;
	}
	function selectSQL($sql) {
		$conn = connectSQL();
		if($conn) {
			 //create SQL statement
			$sql_statement = OCIParse($conn, $sql);
			$r = OCIExecute($sql_statement);
			if(!$r) {
				$e = oci_error($sql_statement);  // For oci_execute errors pass the statement handle
				print htmlentities($e['message']);
				print "\n<pre>\n";
				print htmlentities($e['sqltext']);
				printf("\n%".($e['offset']+1)."s", "^");
				print  "\n</pre>\n";
				http_response_code(400);
				exit;
			}

			// get number of columns for use later
			$num_columns = OCINumCols($sql_statement);

			$data = array();
			//// start results formatting
			while ($row = oci_fetch_array($sql_statement, OCI_ASSOC+OCI_RETURN_NULLS)) {
				$data[] = $row;
			}

			// free resources and close connection
			OCIFreeStatement($sql_statement);

			print json_encode($data);

			OCILogoff($conn);
		} else {
			$e = oci_error;
			print "<br> connection failed:";
			print htmlentities($e['message']);
			http_response_code(400);
		}
	}

	function insertSQL($sql) {
		$conn = connectSQL();
		if($conn) {
			$sql_statement = OCIParse($conn, $sql);
			$r = OCIExecute($sql_statement);
			if(!$r) {
				$e = oci_error($sql_statement);  // For oci_execute errors pass the statement handle
				print htmlentities($e['message']);
				print "\n<pre>\n";
				print htmlentities($e['sqltext']);
				printf("\n%".($e['offset']+1)."s", "^");
				print  "\n</pre>\n";
				http_response_code(400);
			}
		}
		else {
			$e = oci_error;
			print "<br> connection failed:";
			print htmlentities($e['message']);
			http_response_code(400);
		}
	}
?>
