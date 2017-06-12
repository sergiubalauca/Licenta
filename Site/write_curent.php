<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "testare2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";


$sql = "INSERT INTO testare2.curent (value) VALUES ('".$_GET["value"]."')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>


