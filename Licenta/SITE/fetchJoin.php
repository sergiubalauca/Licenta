<?php
	session_start();
?>	

<!DOCTYPE html>
<html lang="en">
<link href="styles.css" type="text/css" rel="stylesheet" />



<head>
  <title>Power Monitor</title>
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
      <a class="navbar-brand">Power Monitor</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="main2.php">Acasă</a></li>
      <li>	  <a href="get_data.php">Vezi citiri</a></li>
      <li><a href="#">Calculează cost</a></li>
      <li><a href="fetchForChart.php">Istoricul citirilor</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?action=logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
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
									Puterea medie: <?php echo $sum; ?>
								</p>
								
								<p class = "box-wrapper h1 container-fluid">
									Energia consumată: <?php echo $sum * ($num_rows * 5) / 720000; ?> KWh
								</p>
								
								<p class = "box-wrapper h1 container-fluid">
									Cost: <?php echo $sum * ($num_rows * 5) / 720000 * $costKWh; ?> Lei
								</p>
								
								<p class = "box-wrapper h1 container-fluid">
									Timpul de măsurare: <?php echo ($num_rows / 12); ?> Minute
								</p>
								<div class="container">	
									<div class="page-header">
										<input type="button" class="btn btn-primary btn-lg btn-info" data-toggle="modal" value="Back" onclick="goBack()"></button>
									</div>
								</div>
						</div>
								<div class="col-md-4></div">
								
								
			</div>
		
			
</div>


<div class="jumbotron">
	<div class = "table-responsive">
		<div class = "container">
				<table class = "table-hover table" border="2" cellspacing="3" cellpadding="4">
				  <tr>
						<td>PUTERE</td>
						<td>TIMP DE ÎNREGISTRARE</td>
						<td>TIMP DISPOZITIV</td>
						<td>NUME DISPOZITIV</td>
						
				 </tr>
		</div>
	</div>
</div>
<?php
	require 'loadLastDevice.php';
	$id = $name['id'];
?>
<?php
    
    $con=mysqli_connect("93.188.164.20","root","password", "test");
       
	   $stopTime = date('Y-m-d H:i:s', strtotime('+3 hour'));  /*aici mi-am setat punctul de oprite*/
	
       
    $result = mysqli_query($con,"SELECT time, value, reg_date, description FROM test.sensor s JOIN test.device d 
								ON  s.time > d.reg_date AND s.time < '$stopTime' AND d.id = '$id' AND description = '".$_POST["name"]."'");
	
	$num_rows = mysqli_num_rows($result);

	$sql = "UPDATE device SET Cost = $sum * ($num_rows * 5) / 720000 * $costKWh, Consumption = $sum * ($num_rows * 5) / 720000 where id = '$id'";
	if ($con->query($sql) === TRUE) {
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}
		
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

<script>
	function goBack() {
		window.history.back()
	}
</script>

</body>
</html>