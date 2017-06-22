
<?php
    
    $con=mysqli_connect("93.188.164.20","root","password", "test");
        
    $result = mysqli_query($con,'SELECT * FROM test.device d ORDER BY d.id DESC LIMIT 1');
	$name = (mysqli_num_rows($result)==1) ? mysqli_fetch_assoc($result) : null;
    	
    mysqli_close($con);
	
	
?>
