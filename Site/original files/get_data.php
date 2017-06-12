<?php
$url=$_SERVER['REQUEST_URI'];
header("Refresh: 5; URL=$url");  // Refresh the webpage every 5 seconds
?>
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
	
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
				  <a class="navbar-brand">Power Monitor</a>
				</div>
				<ul class="nav navbar-nav">
				  <li class="active"><a href="main2.html">Home</a></li>
				  <li><a href="http://localhost/myfiles/get_data.php?data=&data=">Live readings</a></li>
				  <li><a href="#">$$$</a></li>
				  <li><a href="">Readings history</a></li>
				</ul>
			</div>
		</nav>
		
		<div class="jumbotron" id="box-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-4></div">
					<div class="col-md-4></div">
					<h1>Ultimele citiri la intervale de 5 secunde</h1>
					<div class="col-md-4></div">
				</div>
			</div>
		</div>
		
		
        
    

 
	
		
    <table class = "pozitieTabelTensiune" border="2" cellspacing="3" cellpadding="4">
      <tr>
            <td>ID</td>
			<td>TIME</td>
            <td>Tensiune</td>
			<td>Curent</td>
      </tr>

<?php
    // Connect to database

   // IMPORTANT: If you are using XAMPP you will have to enter your computer IP address here, if you are using webpage enter webpage address (ie. "www.yourwebpage.com")
    $con=mysqli_connect("localhost","root","password", "testare");
       
    // Retrieve all records and display them   
    $result = mysqli_query($con,'SELECT id, time, value, value2 FROM testare.sensor ORDER BY id DESC limit 35');
     
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