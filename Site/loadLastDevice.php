
<?php
    
    $con=mysqli_connect("localhost","root","password", "testare");
        
    $result = mysqli_query($con,'SELECT * FROM testare.device d ORDER BY d.id DESC LIMIT 1');
	$name = (mysqli_num_rows($result)==1) ? mysqli_fetch_assoc($result) : null;
    	
    mysqli_close($con);
	
	
?>
