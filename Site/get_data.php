

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

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">Power Monitor</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="main2.php">Home</a></li>
      <li> <a href="get_data.php">Live readings</a></li>
      <li><a href="fetchJoin.php">Generate Cost</a></li>
      <li><a href="#">Readings history</a></li>
	  <li><a href="index2.php?action=logout">Logout</a></li>
    </ul>
  </div>
</nav>
		
<div class="jumbotron" id="box-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-4>.col-md-4</div">
					<div class="col-md-4></div">
						<div class="page-header">
							<p class = "box-wrapper h1 container-fluid">
								<?php
									session_start();
									echo 'Welcome, '.$_SESSION['username'];
								?>	
							</p> </br>
							<p>Here you can see the last 15 readings from the sensor</p>
						</div>
						<div class="col-md-4></div">
					</div>
			</div>
		</div>
			
</div>
		
	
	<div class="container">	
		<div class="page-header">
			<button type="button" class="btn btn-primary btn-block btn-lg btn-success" data-toggle="modal" data-target="#myModal" id = "startRec">Start recording</button>
		</div>
	</div>
	
	<div class="container">	
		<div class="page-header">
			<button type="button" class="btn btn-primary btn-block btn-lg btn-danger" data-toggle="modal" data-target="#myModal2" id = "stopRec">Stop recording</button>
		</div>
	</div>
	
	
	<div class="container">
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-sm">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Modal Header</h4>
				</div>
				<div class="modal-body">
				  <p>You have to set up a device name.</p>
					<form action="insert.php?" method="post">
						Name: <input type="text" name="name" /><br><br>
						<br><br>
						 
						
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  <input type="submit" name = "send" value = "Submit" class="btn btn-primary">
				</div>
				</form>
			  </div>
			  
			</div>
		</div>
	</div>
	<?php
		require 'loadLastDevice.php';
	?>
	<div class="container">
		<div class="modal fade" id="myModal2" role="dialog">
			<div class="modal-dialog modal-sm">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Stop Recording</h4>
				</div>
				<div class="modal-body">
				  <p>Stop recording.</p>
					<form action="fetchJoin.php?" method="post">
						Name: <input type="text" readonly name="name" value = "<?php echo $name['description']; ?>"/> <br><br>
						<br><br>
						 
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  <input type="submit" name = "send" value = "Get Results" class="btn btn-primary">
				</div>
				</form>
			  </div>
			  
			</div>
		</div>
	</div>

	
	
	<div id="show">
	
	</div>

	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			setInterval(function () {
				$('#show').load('load.php')
			}, 1000);
		});
	</script>
	
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
		var edit = document.getElementById("startRec");
		var save = document.getElementById("stopRec");

		edit.onclick = function() 
		{
			save.style.visibility = "visible";
		}		
		
		
	</script>
	

</body>
</html>