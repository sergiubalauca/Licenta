<?php
$servername = "localhost";
$username = "root";
$password = "password";


// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";


$sql = "INSERT INTO testare.sensor (value, value2) VALUES ('".$_GET["value"]."', '".$_GET["value2"]."')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}



?>


