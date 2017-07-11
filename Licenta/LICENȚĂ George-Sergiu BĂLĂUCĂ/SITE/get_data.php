

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
      <li class="active"><a href="main2.php">Acasă</a></li>
      <li> <a href="get_data.php">Vezi citiri</a></li>
      <li><a href="#">Calculează cost</a></li>
      <li><a href="fetchForChart.php">Istoricul citirilor</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?action=logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
		
<div class="jumbotron" id="box-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-4>.col-md-4</div">
					<div class="col-md-4></div">
						<div class="page-header">
							<p class = "box-wrapper container-fluid">
								<?php
									session_start();
									echo 'Salut, '.$_SESSION['username'];
								?>	
							</p> </br>
							<p>Aici vei putea vedea ultimele 15 citiri de la senzor, vei putea începe înregistrarea consumului </br>
								atribuind un nume consumatorului și vei putea controla priza. După ce apeși butonul pentru </br>
								începerea înregistrării, trebuie să aștepți 10 secunde, pentru ca senzorul să citească date.
							</p>
						</div>
						<div class="col-md-4></div">
					</div>
			</div>
		</div>
			
</div>
		
	
	<div class="container">	
		<div class="page-header">
			<button type="button" class="btn btn-primary btn-block btn-lg btn-success"  data-toggle="modal" data-target="#myModal" id = "startRec">Începe înregistrarea</button>
		</div>
	</div>
	
	<div class="container">	
		<div class="page-header">
			<button type="button" class="btn btn-primary btn-block btn-lg btn-danger" data-toggle="modal" data-target="#myModal2" style = "display:none;" id = "stopRec">Oprește înregistrarea</button>
		</div>
	</div>
	<div class="container">
		<div class="page-header">
			<form action="updateRelay.php?" method="post">
								<div class="container">
								Name: <input type="text" name="status" placeholder="A (On)/ F (0ff)"/><br><br>
								</div>
								<div class="container">
									<div class="radio">
									  <label><input type="radio" name="status" value="A">On</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="status" value="F">Off</label>
									</div> 
								</div>
								
									
						    <input type="submit" name = "send" value = "Submit" class="btn btn-primary">
						
			</form>
		
	</div>
	
<form action="relay.php" method="POST">
   <input class="big_b" type="submit" name="next" value="Next" /> 
   <input type="submit" name="reset" value="Reset" /> 
</form>

</script>
	
	
	<div class="container">
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-sm">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Începe înregistrarea</h4>
				</div>
				<div class="modal-body">
				  <p>Atribuie un nume consumatorului</p>
					
						Name: <input type="text" id = "deviceName" name="name" placeholder="ex: fier de calcat"/><br><br>
						<br><br>
					
						
				</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  <input type="submit" name = "send" id = "submitValue" data-dismiss="modal" value = "Submit" class="btn btn-primary">
					</div>
				
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
				  <h4 class="modal-title">Oprește înregistrarea</h4>
				</div>
				<div class="modal-body">
				  <p>Oprește înregistrarea</p>
					<form action="fetchJoin.php?" method="post">
						Name: <input type="text" readonly name="name" id = "stopRecName"/> <br><br>
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
			}, 5000);
		});
	</script>
	
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
		var submitButton = $("#submitValue");
			
		submitButton.on("click", function(){
			$.ajax({
				url:"insert.php?", 
				type:"POST", 
				data: {
					name: $("#deviceName").val()
				}
			}).then(function(response){
					$("#stopRecName").val($("#deviceName").val());
					$("#deviceName").val('');
					$('#startRec').css('display', 'none');
					setTimeout(function(){
						$('#stopRec').css('display', 'block');
					}, 10000);
				}, function(error){
					console.log(error);
				});
		});
	</script>
	

</body>
</html>