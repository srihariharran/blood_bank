<?php
	//Starting Session
	session_start();
	//Checking Session
	if(isset($_SESSION['login_key']))
	{
    if($_SESSION['login_key']=="HSHAAES1" || $_SESSION['login_key']=="RSHAAES7")
	{
		//Including Header
		include 'header.php';
		//Database Connection
		include 'db.php';
		$blood_group_dataPoints=array();
		?>
		<div class="row justify-content-center">
		<?php
		$email_id=$_SESSION['email_id'];
		$sql="SELECT * FROM blood_bank_user_details WHERE email_id=?";
		$sql_stmt = mysqli_prepare($con, $sql);
	  	mysqli_stmt_bind_param($sql_stmt, 's',$email_id);
	  	mysqli_stmt_execute($sql_stmt);
		if($res=mysqli_stmt_get_result($sql_stmt))
		{
				if(mysqli_num_rows($res)==1)
				{
					$row=mysqli_fetch_array($res);
          ?>
					<br/>
		    			<div class="box col-sm-4">
		    				<table class="table">
		    					<tr><th colspan="2" class="text-center"><h4>Profile</h4></th></tr>
                <?php
								if($_SESSION['login_key']=="HSHAAES1")
								{
                  ?>
								<tr><th colspan="2"><img src="Logo/<?php echo $row['hospital_logo']; ?>" width="100%" class="rounded"></th></tr>
                <?php
								}
	               ?>		    					
		    					<tr><th>Name</th><td><?php echo $row['name']; ?></td></tr>
		    					<tr><th>Email Id</th><td><?php echo $row['email_id']; ?></td></tr>
		    					<tr><th>City</th><td><?php echo $row['city']; ?></td></tr>
                <?php
								if($_SESSION['login_key']=="RSHAAES7")
								{
                ?>
								<tr><th>Blood Group</th><td><?php echo $row['blood_group']; ?></td></tr>
                <?php
								}
	               ?>
		    					<tr><th>Contact No</th><td><?php echo $row['contact_no']; ?></td></tr>
		    					<tr><td colspan="2"><button class="btn btn-danger" data-target="#change_password_modal" data-toggle="modal">Change Password</button></td></tr>
		    				</table>
		    			</div>
		    		</div>

        <?php 
				}
			}
			?>
			<!-- Modal for Change Password -->
		    <div class="modal" id="change_password_modal" >
		      <div class="modal-dialog">
		        <div class="modal-content">

		          <!-- Modal Header -->
		          <div class="modal-header">
		            <h4 class="modal-title">Change Password</h4>
		            <button type="button" class="close" data-dismiss="modal">&times;</button>
		          </div>
		          <!-- Modal body -->
		          <div class="modal-body" >
		            <div class="row justify-content-center">
		              <div class="col-sm-9">
		              <!-- Start of Change Password Form -->
		                <form id="change_password_form">
		                	<input type="hidden" name="email_id" value="<?php echo $_SESSION['email_id']; ?>">
							<div class="form-group">
								<input type="password" class="form-fields" name="old_password" placeholder="Old Password">
								<div class="input_img_login"><i class="fa fa-lock"></i></div>
							</div>
							<br/>
							<div class="form-group">
								<input type="password" class="form-fields" name="new_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="New Password">
								<div class="input_img_login"><i class="fa fa-lock"></i></div>
							</div>
							<br/>
							<input type="hidden" name="key" value="EDMASLFCP">
							<div class="form-group">
							<input type="submit" class="btn btn-success" value="Change">
							</div>
		                </form>
		                <br/>
		                
		              <!-- End of Change Password Form -->
		            </div>
		          </div>
		          </div>
		        </div>
		      </div>
		    </div>
		    <!-- Modal to Print Error Message -->
		    <div class="modal" id="myModal">
		      <div class="modal-dialog">
		        <div class="modal-content">

		          <!-- Modal Header -->
		          <div class="modal-header">
		            <h4 class="modal-title"><i class="fa fa-info-circle">&nbsp;Information</i></h4>
		            <button type="button" class="close" data-dismiss="modal">&times;</button>
		          </div>
		          <!-- Modal body -->
		          <div class="modal-body" id="result">

		          </div>
		        </div>
		      </div>
		    </div>
		    <!-- Jquery Ajax -->
		    <script type="text/javascript">
		      //Form submit function
		      $("#change_password_form").submit(function(e){
		          //To prevent page reloading
		        	e.preventDefault();
		          //Ajax call
		          $.ajax({
		            url: "change-password.php",
		            type:"POST",
		            data:$('#change_password_form').serialize(),
		            success: function(result){
		              $('#change_password_form')[0].reset();
		              
		                $("#result").html(result);
		                $('#myModal').modal('show');
		                $('#change_password_modal').modal('hide');
		              

		          }});
		      });
		  	</script>
			<?php
			//Including Footer
			include 'footer.php';
		}
	}
	else
	{
		//Redirect to Login Page
		header("location:index.php");
	}

  
?>
