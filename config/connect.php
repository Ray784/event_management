<?php
	$connection = mysqli_connect('localhost','root','','Event');
	if(!$connection)
	{
		echo "Error unable to connect to database.". PHP_EOL;
		echo "Debugging error number: ".mysqli_connect_errno().PHP_EOL;
		echo "Debugging error: ".mysqli_connect_error().PHP_EOL;
		exit;
	}
	?>