<?php
	//Starting Session
	session_start();
	//Checking Request Method and key
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['key']) && $_POST['key']==='EDMASLF')
	{
		//Database Connection
		include 'db.php';
		//Getting Login Details
		$email_id=$_POST['email_id'];
		$password=$_POST['password'];
		//Getting Values from Database
		$sql="SELECT password,user_type,name FROM blood_bank_user_details WHERE email_id=?";
		$sql_stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($sql_stmt, 's',$email_id);
 		mysqli_stmt_execute($sql_stmt);
		if($res=mysqli_stmt_get_result($sql_stmt))
		{
			if(mysqli_num_rows($res)==1)
			{
				$row=mysqli_fetch_array($res);
				//Verifying Password
				if(password_verify($password, $row['password'])) 
				{
					//Setting Session Variables
					$_SESSION['name']=$row['name'];
					$_SESSION['email_id']=$email_id;
					//Setting Session Key Values for different users
					if($row['user_type']=="H")
					{
						$_SESSION['login_key']="HSHAAES1";
					}
					else
					{
						$_SESSION['login_key']="RSHAAES7";
					}
					echo "Success";
				}
				else
				{
					echo "Invalid Password";
				}
			 	
			}
			else
			{
				echo "Invalid Login Credentials";
			}
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
		//Redirect to Login Page
		header("location:index.php");
	}

?>