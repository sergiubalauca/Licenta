<?php
session_start();
?>	

<!DOCTYPE html>
<html lang="en">
<link href="styles.css" type="text/css" rel="stylesheet" />



<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Power Monitor</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="main2.php">Home</a></li>
      <li>	  <a href="http://localhost/myfiles/get_data.php">Live readings</a></li>
      <li><a href="fetchJoin.php">Generate Cost</a></li>
      <li><a href="#">Readings history</a></li>
	  <li><a href="index2.php?action=logout">Logout</a></li>
    </ul>
  </div>
</nav>

<body>

<style>
.jumbotron { 
    background-color: #613181;
    color: #ffffff;
}

.jumbotron2 { 
    background-color: #4D3A59;
    color: #ffffff;
}
</style>

<?php
	require 'calculateConsumption.php';
?>

<div   class="jumbotron2 container page-header"
			<div class="row">
					<div >
							<p class = "box-wrapper h1 container-fluid">
								Average wattage: <?php echo $sum; ?>
							</p>
							
							<p class = "box-wrapper h1 container-fluid">
								Energy consumption: <?php echo $sum * ($num_rows * 5) / 720000; ?> KWh
							</p>
							
							<p class = "box-wrapper h1 container-fluid">
								Cost: <?php echo $sum * ($num_rows * 5) / 720000 * $costKWh; ?> Lei
							</p>
						</div>
						<div class="col-md-4></div">
					</div>
			
		
			
</div>


<div class="jumbotron">
	<div class = "table-responsive">
		<div class = "container">
				<table class = "table-hover table" border="2" cellspacing="3" cellpadding="4">
				  <tr>
						<td>Power</td>
						<td>TIME</td>
						<td>TIME_DEVICE</td>
						<td>Device</td>
						
				 </tr>
		</div>
	</div>
</div>
<?php
    // Connect to database
	
   // IMPORTANT: If you are using XAMPP you will have to enter your computer IP address here, if you are using webpage enter webpage address (ie. "www.yourwebpage.com")
    $con=mysqli_connect("localhost","root","password", "testare");
       
	   $stopTime = date('Y-m-d H:i:s', strtotime('+1 hour'));  /*aici mi-am setat punctul de oprite*/

    // Retrieve all records and display them   
    $result = mysqli_query($con,"SELECT time, value, reg_date, description FROM testare.sensor s JOIN testare.device d 
								ON  s.time > d.reg_date AND s.time < '$stopTime' AND description = '".$_POST["name"]."'");
	
	$num_rows = mysqli_num_rows($result);

    while($row = mysqli_fetch_array($result))
    {      
        echo "<tr>";
        echo "<td>" . $row['value'] . "</td>";
		echo "<td>" . $row['time'] . "</td>";
		echo "<td>" . $row['reg_date'] . "</td>";
		echo "<td>" . $row['description'] . "</td>";
        echo "</tr>";

    }

    mysqli_close($con);
?>
</body>
</html>