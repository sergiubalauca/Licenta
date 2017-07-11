<?php
$servername = "93.188.164.20";
$username = "root";
$password = "password";



$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";


$sql = "INSERT INTO test.sensor (value, value2) VALUES ('".$_GET["value"]."', '".$_GET["value2"]."')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}



?>


