<?php
	//Database Connection
	$con=mysqli_connect("localhost","root","","blood_bank");
	if(!$con)
	{
		echo "Database Connection Failed";
	}
?>