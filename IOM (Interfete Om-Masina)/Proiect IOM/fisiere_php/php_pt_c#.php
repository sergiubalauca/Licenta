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

$sql = "SELECT id, value, value2 FROM testare";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Rezultat: " . $row["value"]. " " . $row["value2"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>