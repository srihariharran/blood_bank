<?php
	//Starting Session
	session_start();
	//Checking Session
	if(isset($_SESSION['login_key']) && $_SESSION['login_key']=="HSHAAES1" || $_SESSION['login_key']=="RSHAAES7")
	{
		//Including Header
		include 'header.php';
		//Database Connection
		include 'db.php';
  	?>
  		<h4 class="text-center"><b>Requested Blood Samples</b></h4>
  		<div class="row justify-content-center">
  			<?php
  			//Storing Session Value
  			$email_id=$_SESSION['email_id'];
  			if($_SESSION['login_key']=="HSHAAES1")
  			{
  				//Getting Data form db
	  			$sql="SELECT bbrbs.blood_group,bbrbs.date,bbud.email_id,bbud.name,bbud.city,bbud.contact_no  FROM blood_bank_requested_blood_samples bbrbs JOIN blood_bank_user_details bbud ON bbrbs.receiver_id = bbud.email_id WHERE bbrbs.hospital_id='$email_id'";
	  			if($res=mysqli_query($con,$sql))
	  			{
	  				if(mysqli_num_rows($res)!=0)
          			{
      				
		  				$i=0;
		  				while($row=mysqli_fetch_array($res))
		  				{
		  					//Printing Data
		  					?>
		  					<div class="col-sm-4 p-3">
			  					<div class="box  text-center p-2">
			                	<table class="table table-bordered">
			                		<tr>
			                			<th>Name</th>
			                			<td><?php echo $row['name']; ?></td>
			                		</tr>
			                		<tr>
			                			<th>City</th>
			                			<td><?php echo $row['city']; ?></td>
			                		</tr>
			                		<tr>
			                			<th>Requested Blood Group</th>
			                			<td><?php echo $row['blood_group']; ?></td>
			                		</tr>
			                		<tr>
			                			<th>Email Id</th>
			                			<td><?php echo $row['email_id']; ?></td>
			                		</tr>
			                		<tr>
			                			<th>Contact No</th>
			                			<td><?php echo $row['contact_no']; ?></td>
			                		</tr>
			                		<tr>
			                			<th>Date</th>
			                			<td><?php echo  date("d-m-Y", strtotime($row['date'])) ?></td>
			                		</tr>
			                		<?php
			                		//Checking Session to display request button
			                		if($_SESSION['login_key']=="RSHAAES7")
			                		{
			                			?>
			                		<tr>
			                			<td colspan="2">
			                				<form class="request_form" id="request-form<?php echo $i; ?>">
			                					<input type="hidden" name="hospital_id" value="<?php echo $row['email_id']; ?>" />
			                					<input type="hidden" name="blood_group" value="<?php echo $row['blood_group'] ?>" />
			                					<input type="hidden" name="receiver_email_id" value="<?php echo $email_id ?>" />
			                					<input type="hidden" name="key" value="MDU7" />
			                					<input type="submit" id="<?php echo $i; ?>" class="btn btn-success" value="Request Blood Sample">
			                				</form>
			                			</td>
			                		</tr>
			                		<?php
			                		}
			                		?>
			                	</table>
			            		</div>
			            	</div>
		  					<?php
		  					$i++;
		  				}
		  			}
		  			else
			        {
			            ?>
			            <div class="col-sm-4 p-3">
			                  <div class="box  text-center p-2">
			                    Sorry! No Records Found
			                  </div>
			            </div>
			            <?php
			        }
	  			}
	  		}
	  		else if($_SESSION['login_key']=="RSHAAES7")
	  		{
	  			// $sql="SELECT bbrbs.blood_group,bbrbs.date,bbud.email_id,bbud.name,bbud.city,bbud.contact_no  FROM blood_bank_requested_blood_samples bbrbs JOIN blood_bank_user_details bbud ON bbrbs.receiver_id = bbud.email_id WHERE bbrbs.hospital_id='$email_id'";
	  			$sql="SELECT hospital_id,date,blood_group FROM blood_bank_requested_blood_samples WHERE receiver_id='$email_id' ORDER BY date";
	  			if($res=mysqli_query($con,$sql))
	  			{
	  				if(mysqli_num_rows($res)!=0)
          			{
		  				while($row=mysqli_fetch_array($res))
		  				{
		  					//Printing Data
		  					?>
		  					<div class="col-sm-4 p-3">
			  					<div class="box  text-center p-2">
			                	<table class="table table-bordered">
			                		<tr>
			                			<th>Date of Request</th>
			                			<td><?php echo date("d-m-Y", strtotime($row['date'])); ?></td>
			                		</tr>
			                		<tr>
			                			<th>Requested Blood Group</th>
			                			<td><?php echo $row['blood_group']; ?></td>
			                		</tr>
			                		<tr>
			                			<th>Hospital Details</th>
			                			<td>
			                				<?php
			                				$hospital_id=$row['hospital_id'];
			                				$sql_hospital_details="SELECT * FROM blood_bank_user_details WHERE email_id='$hospital_id'";
			                				if($res_hospital_details=mysqli_query($con,$sql_hospital_details))
			                				{
			                					while($row_hospital_details=mysqli_fetch_array($res_hospital_details))
			                					{
			                						?>
			                						<table class="table"> 
			                							<tr><td><?php echo $row_hospital_details['name']; ?></td></tr>
			                							<tr><td><?php echo $row_hospital_details['city']; ?></td></tr>
			                							<tr><td><?php echo $row_hospital_details['email_id']; ?></td></tr>
			                							<tr><td><?php echo $row_hospital_details['contact_no']; ?></td></tr>
			                						</table>
			                						<?php
			                					}
			                				}

			                				?>
			                			</td>
			                		</tr>
			                		
			                	</table>
			            		</div>
			            	</div>
		  					<?php
		  					
		  				}
		  			}
		  			else
			        {
			            ?>
			            <div class="col-sm-4 p-3">
			                  <div class="box  text-center p-2">
			                    Sorry! No Records Found
			                  </div>
			            </div>
			            <?php
			        }
	  			}
	  		}
  			?>
  			
        </div>
        <!-- Modal to Print Information -->
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
	    //Request Form submit function
	    $(document).on("submit", ".request_form", function(e){
	    	//To prevent page reloading
		    e.preventDefault();
		    //Get Current attribute id
		    var f_id = $(this).attr("id");
		    // alert(f_id);
	        // var idf=$('#id1'+f_id+'').val();
	        //Ajax Call
	        $.ajax({
	            url: 'request-blood-sample.php',
	            type: "POST",
	            data:$('#'+f_id).serialize(),     
	            success:function(result){
	            	$("#result").html(result);
	                $('#myModal').modal('show');
		          },
	            
		      });
		});

	    </script>

  	<?php
  		//Including Footer
		include 'footer.php';
	}
	else
	{
		//Redirect to Login Page
		header("location:index.php");
	}

  
?>
