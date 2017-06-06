<?php
$servername = "localhost";
$username = "root";
$password = "rockschool";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";



$value = mysqli_query($con, 'SELECT value FROM testare.sensor');

if(isset($_POST(['value'])))
	$value = $_POST['value']
//$result_query = mysqli_fetch_array($result);


        
     Close the connection   
    mysqli_close($con);
?>