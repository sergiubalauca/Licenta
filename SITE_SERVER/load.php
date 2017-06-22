<!DOCTYPE html>
<html lang="en">

		<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link href="styles.css" type="text/css" rel="stylesheet" />

<head>
    <title>Power Consumption</title>
	
</head>
<body>

<div class = "table-responsive">
			<table class = "table-hover table poz" border="2" cellspacing="3" cellpadding="4">
			  <tr>
					<td>ID</td>
					<td>TIME</td>
					<td>Power</td>
					<td>Current</td>
			  </tr>
</div>
<?php
    // Connect to database

   // IMPORTANT: If you are using XAMPP you will have to enter your computer IP address here, if you are using webpage enter webpage address (ie. "www.yourwebpage.com")
    $con=mysqli_connect("93.188.164.20","root","password", "test");
       
    // Retrieve all records and display them   
    $result = mysqli_query($con,'SELECT id, time, value, value2 FROM test.sensor ORDER BY id DESC limit 15');
     
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
</body>
</html>