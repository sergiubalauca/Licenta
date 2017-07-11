

<!DOCTYPE html>
<html lang="en">

<link href="styles.css" type="text/css" rel="stylesheet" />

<head>
  <title>Monitorizare consum</title>
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
      <li class="active"><a href="#">Acasă</a></li>
      <li>	  <a href="get_data.php">Vezi citiri</a></li>
      <li><a href="#">Calculează Cost</a></li>
      <li><a href="fetchForChart.php">Istoric citiri</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?action=logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
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
							echo 'Salut, '.$_SESSION['username'];
						?>		</h>	
									
						<p class = "container-fluid box-wrapper" h1>În cadrul acestei interfețe vei putea monitoriza consumului de energie electrică</br>
																	de la o priză și o vei putea controla de la distanță, acționând un releu</p>
					<div class="col-md-4></div">
				</div>
			</div>
		</div>
	</div>

	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		  
		  <ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			
		  </ol>

		  
		  <div class="carousel-inner">
			<div class="item active">
			  <img src="ansamblu2.jpg" alt="ansamblu2">
			  <div class="carousel-caption">
				<h3>Sistemul</h3>
				<p>Vedere asupra componentelor</p>
			  </div>
			</div>

			

			<div class="item">
			  <img src="nano.jpg" alt="nano">
			  <div class="carousel-caption">
				<h3>Unitatea "slave" portabilă</h3>
				<p>Afișare directă a mărimilor măsurate</p>
			  </div>
			</div>
		  </div>

		 
		  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		  </a>
</div>
	
</body>
</html>


