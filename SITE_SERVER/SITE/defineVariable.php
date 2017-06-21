<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<div class = "table-responsive">
			<table class = "table-hover table" border="2" cellspacing="3" cellpadding="4">
			  <tr>
					<td>stopTime</td>
			  </tr>
</div>
</body>
</html>

<?php
function getDateTimeNow()
{
	$stopTime = date('Y-m-d H:i:s', strtotime('+1 hour'));
	echo "<tr>";
        echo "<td>" . $stopTime . "</td>";
	echo "</tr>";
	
	return $stopTime;
}

getDateTimeNow();
?>