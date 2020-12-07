<?php
	//Starting Session
	session_start();
	//Checking Session
	if(isset($_SESSION['login_key']) && $_SESSION['login_key']=="RSHAAES7" || $_SESSION['login_key']=="HSHAAES1")
	{
    //Including Header
		include 'header.php';
    //Database Connection
		include 'db.php';
  	?>
  		<h4 class="text-center"><b>Available Blood Samples</b></h4>
  		<div class="text-center">
        <button data-toggle="modal" data-target="#filter_modal" class="btn btn-light" style="width: 100px;color: black"><i class="fa fa-filter" ></i>Filter</button>
        </div>
        <br/>
  		<div class="row justify-content-center" id="filter_result">
  			<?php
  			$email_id=$_SESSION['email_id'];
        //Checking session to get data for different users
  			if($_SESSION['login_key']=="RSHAAES7")
  			{
          //SQL Query to get data
  				$sql="SELECT DISTINCT(bbbd.blood_group),bbud.email_id,bbud.name,bbud.city,bbud.hospital_logo,bbud.contact_no  FROM blood_bank_blood_details bbbd JOIN blood_bank_user_details bbud ON bbbd.hospital_id = bbud.email_id";
  			}
  			else if($_SESSION['login_key']=="HSHAAES1")
  			{
          //SQL Query to get data
  				$sql="SELECT DISTINCT(bbbd.blood_group),bbud.email_id,bbud.name,bbud.city,bbud.hospital_logo,bbud.contact_no  FROM blood_bank_blood_details bbbd JOIN blood_bank_user_details bbud ON bbbd.hospital_id = bbud.email_id WHERE bbbd.hospital_id='$email_id'";
  			}
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
    	                	<table class="table table-bordered ">
    	                		<tr>
    	                			<td colspan="2"><img src="Logo/<?php echo $row['hospital_logo']; ?>" width="100%" height="150px"></td>
    	                		</tr>
    	                		<tr>
    	                			<th>Hospital</th>
    	                			<td><?php echo $row['name']; ?></td>
    	                		</tr>
    	                		<tr>
    	                			<th>Hospital City</th>
    	                			<td><?php echo $row['city']; ?></td>
    	                		</tr>
    	                		<tr>
    	                			<th>Available Blood Group</th>
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
    	                		<?php
                          //Printing data for Receiver Login after checking session
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

	    <!-- Modal for Filter -->
    <div class="modal" id="filter_modal" >
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Filter</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body" >
            <div class="row justify-content-center">
              <div class="col-sm-9">
              <!-- Start of Filter Form -->
                <form id="filter_form">
                  <div class="form-group">
                    <label>City:</label>
                    <select class="form-fields" name="city">
                      <option value="#">None</option>
                      <?php
                        $user_type="H";
                        $sql="SELECT DISTINCT(city) FROM blood_bank_user_details WHERE user_type='H'";
                        $sql_stmt = mysqli_prepare($con, $sql);
                        mysqli_stmt_bind_param($sql_stmt, 's',$user_type);
                        mysqli_stmt_execute($sql_stmt);
                        if($res=mysqli_stmt_get_result($sql_stmt))
                        {
                           echo mysqli_num_rows($res);
                          while($row=mysqli_fetch_array($res))
                          {

                            ?><option value="<?php echo $row['city']; ?>"><?php echo $row['city']; ?></option><?php
                          }
                        }
                        else
                        {
                          mysqli_error($con);
                        }
                      ?>
                    </select>
                    <div class="input_img_login"><i class="fa fa-map-marker"></i></div>
                  </div>
                  <br/>
                  <div class="form-group">
                    <label>Blood Group:</label>
                    <select class="form-fields" name="blood_group">
                      <option value="#">None</option>
                      <?php
                        $sql="SELECT DISTINCT(blood_group) FROM blood_bank_blood_details";
                        $sql_stmt = mysqli_prepare($con, $sql);
                        mysqli_stmt_bind_param($sql_stmt, 's',$user_type);
                        mysqli_stmt_execute($sql_stmt);
                        if($res=mysqli_stmt_get_result($sql_stmt))
                        {
                           echo mysqli_num_rows($res);
                          while($row=mysqli_fetch_array($res))
                          {

                            ?><option value="<?php echo $row['blood_group']; ?>"><?php echo $row['blood_group']; ?></option><?php
                          }
                        }
                        else
                        {
                          mysqli_error($con);
                        }
                      ?>
                    </select>
                    <div class="input_img_login"><i class="fa fa-heartbeat"></i></div>
                  </div>
                  <br/>
                  <input type="hidden" name="key" value="EDMASLFF">
                  <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Apply">
                  </div>
                </form>
                <br/>
              <!-- End of Filter Form -->
            </div>
          </div>
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

    //Filter Form submit function
    $("#filter_form").submit(function(e){
        //To prevent page reloading
        e.preventDefault();
        //Ajax call
        $.ajax({
          url: "search.php",
          type:"POST",
          data:$('#filter_form').serialize(),
          success: function(result){
            $('#filter_result').html(result);
            $('#filter_modal').modal('hide');

        }});
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
