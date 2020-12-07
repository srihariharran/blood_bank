<?php
	//Checking Request Method and key
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['key']) && $_POST['key']==="CBFC-USC")
	{
		//Database Connection
		include 'db.php';
		//Checking Form Type
		if($_POST['form_type']=="HRF")
		{
			//Getting Form Values
			$email_id=$_POST['email_id'];
			//Encrypting Password
			$password=password_hash($_POST['password'], PASSWORD_DEFAULT);
			$hospital_name=$_POST['hospital_name'];
			$city=$_POST['hospital_city'];
			$hospital_logo=$email_id.".jpg";
			$hospital_contact_no=$_POST['hospital_contact_no'];
			$user_type="H";
			//Inserting Data into Table
			$sql="INSERT INTO blood_bank_user_details (email_id,password,name,city,hospital_logo,contact_no,user_type) VALUES (?,?,?,?,?,?,?)";
			$sql_stmt = mysqli_prepare($con,$sql);
			mysqli_stmt_bind_param($sql_stmt,'sssssss',$email_id,$password,$hospital_name,$city,$hospital_logo,$hospital_contact_no,$user_type);
			if(mysqli_stmt_execute($sql_stmt))
			{
				$hospital_logo=$_FILES["hospital_logo"]["tmp_name"];
			    $filepath="Logo/".$email_id.".jpg";
			    //Moving Uploaded Logo to Server
				move_uploaded_file($hospital_logo,$filepath);
				echo "Hospital Details Registered Successfully";
			}
			else
			{
				// echo "Some Error Occured ".mysqli_error($con);
				$error=explode(" ",mysqli_error($con));
				if($error[0]=="Duplicate")
				{
					echo "Hospital Already Registered";
				}
				else
				{
					echo "Some Error Occured".mysqli_error($con);
				}
			}

		}
		else if($_POST['form_type']=="RRF")
		{
			//Getting Form Values
			$email_id=$_POST['email_id'];
			//Encrypting Password
			$password=password_hash($_POST['password'], PASSWORD_DEFAULT);;
			$receiver_name=$_POST['receiver_name'];
			$city=$_POST['receiver_city'];
			$blood_group=$_POST['blood_group'];
			$contact_no=$_POST['contact_no'];
			$user_type="R";
			//Inserting Data into Table
			$sql="INSERT INTO blood_bank_user_details (email_id,password,name,city,blood_group,contact_no,user_type) VALUES (?,?,?,?,?,?,?)";
			$sql_stmt = mysqli_prepare($con,$sql);
			mysqli_stmt_bind_param($sql_stmt,'sssssss',$email_id,$password,$receiver_name,$city,$blood_group,$contact_no,$user_type);
			if(mysqli_stmt_execute($sql_stmt))
			{
				echo "Receiver Details Registered Successfully";
			}
			else
			{
				// echo "Some Error Occured ".mysqli_error($con);
				$error=explode(" ",mysqli_error($con));
				if($error[0]=="Duplicate")
				{
					echo "Receiver Already Registered";
				}
				else
				{
					echo "Some Error Occured".mysqli_error($con);
				}
			}

		}
		mysqli_close($con);
	}
	else
	{
		//Redirecting to Registration Form Page
		header("location:registration-form.php");
	}
?>