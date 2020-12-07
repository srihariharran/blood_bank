<?php
	//Starting Session
	session_start();
	//Checking Request Method and key
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['key']) && $_POST['key']=="MDU7" && isset($_SESSION['login_key']) && $_SESSION['login_key']=="RSHAAES7")
	{
		//Database Connection
		include 'db.php';
		//Getting Form Values
		$blood_group=$_POST['blood_group'];
		$hospital_id=$_POST['hospital_id'];
		$receiver_id=$_POST['receiver_email_id'];
		$status="Requested";

		//Inserting Data into Table
		$sql="INSERT INTO blood_bank_requested_blood_samples (receiver_id,blood_group,hospital_id) VALUES (?,?,?)";
		$sql_stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($sql_stmt,'sss',$receiver_id,$blood_group,$hospital_id);
		if(mysqli_stmt_execute($sql_stmt))
		{
			echo "Blood Sample Requested Successfully";
		}
		else
		{
			$error=explode(" ",mysqli_error($con));
			if($error[0]=="Duplicate")
			{
				echo "Already Requested this Blood Sample Today";
			}
			else
			{
				echo "Some Error Occured".mysqli_error($con);
			}
		}
		mysqli_close($con);
	}
	else
	{
		//Redirecting to Available Blood Sample Page
		header("location:available-blood-samples.php");
	}
?>