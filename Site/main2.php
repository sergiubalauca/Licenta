

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
      <li class="active"><a href="#">Home</a></li>
      <li>	  <a href="http://localhost/myfiles/get_data.php">Live readings</a></li>
      <li><a href="fetchJoin.php">Generate Cost</a></li>
      <li><a href="#">Readings history</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
        <li><a href="index2.php?action=logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
  
  <div class="jumbotron" id="box-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-4></div">
					<div class="col-md-4></div">
						<p class = "container-fluid box-wrapper h1">
						<?php
							session_start();
							echo 'Welcome, '.$_SESSION['username'];
						?>		</h>	
									</br>
									</br>
									</br>
									</br>
						<p class = "container-fluid box-wrapper" h1>Here you can see readings from the unit along with spent energy translated into money.</p>
					<div class="col-md-4></div">
				</div>
			</div>
		</div>
	</div>

</body>
</html>


