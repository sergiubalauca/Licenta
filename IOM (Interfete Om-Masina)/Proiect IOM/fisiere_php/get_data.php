<?php
$url=$_SERVER['REQUEST_URI'];
header("Refresh: 5; URL=$url");  // Refresh the webpage every 5 seconds
?>
<html>
<head>
    <title>Current Sensor</title>
</head>
    <body>
        <h1>Informatii din baza de date</h1>
    <table border="2" cellspacing="3" cellpadding="4">
      <tr>
            <td>ID</td>
			<td>TIME</td>
            <td>Curent</td>
            <td>Tensiune</td>
      </tr>
      
<?php
    // Connect to database

   // IMPORTANT: If you are using XAMPP you will have to enter your computer IP address here, if you are using webpage enter webpage address (ie. "www.yourwebpage.com")
    $con=mysqli_connect("localhost","root","password");
       
    // Retrieve all records and display them   
    $result = mysqli_query($con,'SELECT id, time, value, value2 FROM testare.sensor ORDER BY id DESC');
      
    // Process every record
    
    while($row = mysqli_fetch_array($result))
    {      
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
		echo "<td>" . $row['time'] . "</td>";
        echo "<td>" . $row['value'] . "</td>";
        echo "<td>" . $row['value2'] . "</td>";
        echo "</tr>";
        
    }
        
    // Close the connection   
    mysqli_close($con);
?>
    </table>
    </body>
</html>