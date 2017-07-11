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
			<table class = "table-hover table" id ="poz" border="2" cellspacing="3" cellpadding="4">
			  <tr>
					<td>ID</td>
					<td>TIMP</td>
					<td>PUTERE</td>
					<td>CURENT</td>
			  </tr>
</div>
<?php
    
    $con=mysqli_connect("93.188.164.20","root","password", "test");
       header("Cache-Control: no-cache, must-revalidate");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Content-Type: application/xml; charset=utf-8");
      
    $result = mysqli_query($con,'SELECT id, time, value, value2 FROM test.sensor ORDER BY id DESC limit 15');
     
    while($row = mysqli_fetch_array($result))
    {      
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
		echo "<td>" . $row['time'] . "</td>";
		echo "<td>" . $row['value'] . "</td>";
		echo "<td>" . $row['value2'] . "</td>";
        echo "</tr>";
    }
        
      
    mysqli_close($con);
?>
</body>
</html>