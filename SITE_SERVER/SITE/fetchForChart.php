<?php 
session_start();

$connect = mysqli_connect("93.188.164.20", "root", "password", "test");
$query = "SELECT * FROM device ";
$result = mysqli_query($connect, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
 $chart_data .= "{ Description:'".$row["description"]."', Cost:".$row["cost"].", Consumption:".$row["consumption"]."}, ";
}
$chart_data = substr($chart_data, 0, -2);
?>


<!DOCTYPE html>
<html>
 <head>
	<html lang="en">
	<link href="styles.css" type="text/css" rel="stylesheet" />
 
	<title>Power Monitor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  
 </head>
 <body>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">Power Monitor</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="main2.php">Home</a></li>
      <li>	  <a href="get_data.php">Live readings</a></li>
      <li><a href="#">Generate Cost</a></li>
      <li><a href="fetchForChart.php">Readings history</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?action=logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
		<div class="jumbotron" id="box-wrapper">
			<div class="container-fluid">
			  <div class="container" style="width:1100px;">  
				   <br /><br />
				   <div id="chart"></div>
			  </div>
			</div>
		</div>
 </body>
</html>

<script>
Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'Description',
 ykeys:['Cost', 'Consumption'],
 labels:['Cost', 'Consumption'],
 hideHover:'auto',
 stacked:false
});
</script>
