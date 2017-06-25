
<?php
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

		$sql = "update RelayStatus set status = '".$_POST["status"]."' where id = 1";

		if ($conn->query($sql) === TRUE) {
			header ("Location: get_data.php");
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
			
		$conn->close();
		
		
?>
