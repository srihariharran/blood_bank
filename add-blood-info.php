<?php
	//Starting Session
	session_start();
	//Checking Request Method and key
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['key']) && $_POST['key']=="CBFCBSUSC" && isset($_SESSION['login_key']) && $_SESSION['login_key']=="HSHAAES1")
	{
		//Database Connection
		include 'db.php';
		//Getting Form Values
		$donor_name=$_POST['donor_name'];
		$donor_city=$_POST['donor_city'];
		$donor_contact_no=$_POST['donor_contact_no'];
		$blood_group=$_POST['blood_group'];
		$hospital_id=$_SESSION['email_id'];
		//Inserting Data into Table
		$sql="INSERT INTO blood_bank_blood_details (donor_name,donor_city,blood_group,donor_contact_no,hospital_id) VALUES (?,?,?,?,?)";
		$sql_stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($sql_stmt,'sssss',$donor_name,$donor_city,$blood_group,$donor_contact_no,$hospital_id);
		if(mysqli_stmt_execute($sql_stmt))
		{
			echo "Blood Information Added Successfully";
		}
		else
		{
			echo "Some Error Occured ".mysqli_error($con);
		}
		mysqli_close($con);
	}
	else
	{
		//Redirecting to Add Blood Info Page
		header("location:add-blood-info-form.php");
	}
?>