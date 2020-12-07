<?php
	//Starting Session
	session_start();
	//Destroying Session
	session_destroy();
	//Redirect to Login Page
	header("location:index.php");
?>