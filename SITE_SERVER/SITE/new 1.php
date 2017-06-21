<?php
function getDateTimeNow()
{
	$stopTime = date('Y-m-d H:i:s', strtotime('+3 hour'));
	echo "<tr>";
        echo "<td>" . $stopTime . "</td>";
	echo "</tr>";
	
	return $stopTime;
}

getDateTimeNow();
?>