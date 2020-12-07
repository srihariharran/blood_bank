<?php
	//Checking Request Method and key
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['key']) && $_POST['key']=="CBFCBSUSC")
	{
		$email_id=$_POST['email_id'];
		//DB Connection
		include 'db.php';
		//Sql Query to get user details
		$sql="SELECT * FROM blood_bank_user_details WHERE email_id=?";
		$sql_stmt=mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($sql_stmt, 's',$email_id);
		mysqli_stmt_execute($sql_stmt);
		if($res=mysqli_stmt_get_result($sql_stmt))
		{
			if(mysqli_num_rows($res)==1)
			{
				$row=mysqli_fetch_array($res);
				$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@!#$%^&*';
			    $pass =array();
			    //Generating random password
			    $alphaLength = strlen($alphabet) - 1; 
			    for ($i = 0; $i < 8; $i++) {
			        $n = rand(0, $alphaLength);
			        $pass[]= $alphabet[$n];
			    }
			    $reset=implode($pass);
			    $password=password_hash($reset, PASSWORD_DEFAULT);
			    //Sql query to update new password in DB table
			    $sql_update="UPDATE blood_bank_user_details SET password=? WHERE email_id=?";
			    $sql_stmt_update = mysqli_prepare($con,$sql_update);
				mysqli_stmt_bind_param($sql_stmt_update,'ss',$password,$email_id);
				if(!mysqli_stmt_execute($sql_stmt_update))
				{
					echo mysqli_error($con);
				}
				else
				{
					//Sending the password through Mail
					$to = $email_id;
					$subject = "Blood Bank Account Password";
					$headers = "Reply-To: <hypertexttechies2020@gmail.com>\r\n";
					$headers .= "Return-Path:<hypertexttechies2020@gmail.com>\r\n";
					$headers .= "From:<hypertexttechies2020@gmail.com>\r\n";
					$headers .= "Organization: KEC\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
					$headers .= "X-Priority: 3\r\n";
					$headers .= "X-Mailer: PHP". phpversion() ."\r\n";
					$message="Hi ".$row['name'].",\r\nYour Blood Bank Account Password is ".$reset."\r\nYou can Login using Your Email id and this Password.";
					 $message.="\r\n";
					$message.="Thank You!";
					//Mail function to send mail
					if(mail($to,$subject,$message,$headers))
					{
						echo "Password Sent to Your E-mail ID.";
					}
					else
					{
						echo "Mail not Sended";
					}
					
					
						
				}
			}
			else
			{
				echo "Invalid Email/Username";
					
			}
		}
		
	
	}
	else
	{
		
		header("location:index.php");
	}
   ?>