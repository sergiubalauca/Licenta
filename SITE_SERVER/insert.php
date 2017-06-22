
<?php
		require 'defineVariable.php';
	
		$servername = "93.188.164.20";
		$username = "root";
		$password = "password";
		$dbname = "test";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "INSERT INTO device (description) VALUES ('".$_POST["name"]."');";
		/* $sql .= "INSERT INTO sensor (ID_Device) VALUES (LAST_INSERT_ID())"; */
		$sql .= "INSERT INTO sensor (ID_Device) SELECT id FROM device WHERE id = LAST_INSERT_ID()";
		
		if (mysqli_multi_query($conn, $sql)) {
					
						header ("Location: get_data.php");
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
					header ("Location: get_data.php");
				}
			
		$conn->close();
		
		
?>
