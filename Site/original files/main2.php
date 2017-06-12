

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
      <li><a href="http://localhost/myfiles/get_data.php?data=&data=">Live readings</a></li>
      <li><a href="#">$$$</a></li>
      <li><a href="#">Readings history</a></li>
    </ul>
  </div>
</nav>
  
  <div class="jumbotron" id="box-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-4></div">
					<div class="col-md-4></div">
					<h1><?php
						session_start();
						echo 'Welcome '.$_SESSION['username'];
						echo '<br><a href="index2.php?action=logout">Logout</a>';
						?>			
									</br>
									</br>
									</br>
									</br>
						Here you can see readings from the unit along with spent energy translated into money.</h1>
					<div class="col-md-4></div">
				</div>
			</div>
		</div>


</body>
</html>


