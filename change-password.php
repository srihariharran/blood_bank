<?php
	//Starting Session
	session_start();
	//Checking Session
	if((isset($_SESSION['login_key']) && $_SESSION['login_key']=="HSHAAES1") || (isset($_SESSION['login_key']) && $_SESSION['login_key']=="RSHAAES7"))
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['key']) && $_POST['key']=="EDMASLFCP" )
		{
  		
  		include 'db.php';
      //Getting Form values
      $email_id=$_POST['email_id'];
      $old_password=$_POST['old_password'];
      //Encryting the Password
      $new_password=$_POST['new_password'];
      //Checking the old and new password values
      if($old_password == $new_password)
      {
        echo "Old & New Password are Same";
      }
      else
      {
        //Sql query to get the password form DB table
        $sql="SELECT password FROM blood_bank_user_details WHERE email_id=?";
        $sql_stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($sql_stmt, 's',$email_id);
        mysqli_stmt_execute($sql_stmt);   
        if($res=mysqli_stmt_get_result($sql_stmt))
        {
            if(mysqli_num_rows($res)==1)
            {
              $row=mysqli_fetch_array($res);
              if(password_verify($old_password, $row['password'])) 
              {
                $password=password_hash($new_password, PASSWORD_DEFAULT);;
                //Sql query to update the password form DB table
                $sql1="UPDATE blood_bank_user_details SET password=? WHERE email_id=?";
                $sql_stmt1 = mysqli_prepare($con,$sql1);
                mysqli_stmt_bind_param($sql_stmt1,'ss',$password,$email_id);
                if(!mysqli_stmt_execute($sql_stmt1))
                {
                  echo mysqli_error($con);
                }
                else
                {
                  echo "Password Changed Successfully.";
                  
                }
              }
              else
              {
                echo "Invalid Old Password";
              }
            }
            else
            {
                echo "Invalid Credentials";
            }
        }
        else
        {
          echo mysqli_error($con);
        }
      }
			
		}
    else
    {
      header("location:home.php");
    }
	}
	else
	{
		//Redirect to Login Page
		header("location:index.php");
	}

  
?>
