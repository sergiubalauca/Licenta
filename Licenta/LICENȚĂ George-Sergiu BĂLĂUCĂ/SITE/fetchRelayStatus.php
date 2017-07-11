<?php
   session_start();
    $con=mysqli_connect("93.188.164.20","root","password", "test");
    
    $result = mysqli_query($con,"SELECT status FROM test.RelayStatus");
	
	$num_rows = mysqli_num_rows($result);

    $row = mysqli_fetch_array($result);
         
        echo $row['status'];
		//echo $_SESSION[row['status']];
	
?>