<!DOCTYPE html>
<html>
<style>

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

</style>

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<?php
session_start();
if(isset($_POST['bttLogin']))
{
	require 'connect.php';
	$username = $_POST['username'];
	$password = $_POST['password'];
	$result = mysqli_query($con, 'select * from users where username = "'.$username.'" and password = "'.$password.'"');
	if(mysqli_num_rows($result)==1)
	{
		$_SESSION['username'] = $username;
		header('Location: main2.php');
	}
	else echo "<script>alert('Account invalid!');</script>";
}
if(isset($_GET['logout']))
{	
	//session_unregister('username');
	unset($_SESSION['username']);
}
?>

<body>



<div class="container" id="box-wrapper">
  <h2>Welcome</h2>
  <form method = "POST">
	<div class="imgcontainer">
		<img src="https://www.arduino.cc/en/uploads/Guide/ArduinoNanoUSBCable.jpg" alt="Avatar" class="avatar">
	</div>
	
    <div class="form-group">
      <label for="username">Email:</label>
      <input type="text" class="form-control" placeholder="Enter Username" id="username" name="username">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div>
    <button type="submit" name="bttLogin" class="btn btn-default">Login</button>
  </form>
</div>


</body>
</html>



