<?php
	require 'loadLastDevice.php';
	$id = $name['id'];
?>

<?php
    // Connect to database
	
   // IMPORTANT: If you are using XAMPP you will have to enter your computer IP address here, if you are using webpage enter webpage address (ie. "www.yourwebpage.com")
    $con=mysqli_connect("localhost","root","password", "testare");
       
	   $stopTime = date('Y-m-d H:i:s', strtotime('+1 hour'));  /*aici mi-am setat punctul de oprite*/

    // Retrieve all records and display them   
    $result = mysqli_query($con,"SELECT time, value, reg_date, description FROM testare.sensor s JOIN testare.device d 
								ON  s.time > d.reg_date AND s.time < '$stopTime' AND d.id = '$id' AND description = '".$_POST["name"]."'");
	
	$num_rows = mysqli_num_rows($result);
	
	
	
		
		
		
	
	$sum = 0;
	$costKWh = 0.3741;
    while($row = mysqli_fetch_array($result))
    {      
        
		$sum = ($sum + $row['value']);
		
    }
        $sum = $sum / $num_rows;
    // Close the connection   
    mysqli_close($con);
?>