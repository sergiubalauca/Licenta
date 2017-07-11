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
	
	
	
		
		
		
	
	$sum = 0;
	$costKWh = 0.3741;
    while($row = mysqli_fetch_array($result))
    {      
        
		$sum = ($sum + $row['value']);
		
    }
        $sum = $sum / $num_rows;
    
    mysqli_close($con);
?>