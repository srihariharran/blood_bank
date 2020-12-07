<?php
	//Starting Session
	session_start();
	//Checking Session
	if(isset($_SESSION['login_key']) && $_SESSION['login_key']=="HSHAAES1")
	{
    //Including Header
		include 'header.php';
  	?>
  		<div class="row justify-content-center">
  			<div class="box col-sm-4 text-center">
                <h3><b>Add Blood Info</b></h3>
                <br/>
                <center>
                  <!-- Start of Add Blood Info Form -->
                  <form style="width:300px;" id="add_blood_form">
                    
                    <div class="form-group">
                      <input type="text" class="form-fields" name="donor_name" placeholder="Donar Name" pattern="[a-zA-Z ]{2,30}" title="Should be less than 30 characters" required="">
                      <div class="input_img"><i class="fa fa-user"></i></div>
                    </div>
                    <br/>
                    <div class="form-group">
                      <input type="text" class="form-fields" name="donor_city" placeholder="Donar City" required="">
                      <div class="input_img"><i class="fa fa-map-marker"></i></div>
                    </div>
                    <br/>
                    <div class="form-group">
                      <label>Donar Blood Group:</label>
                      <select name="blood_group" class="form-fields">
                        <option value="A Positive">A Positive</option>
                        <option value="A Negative">A Negative</option>
                        <option value="A Unknown">A Unknown</option>
                        <option value="B Positive">B Positive</option>
                        <option value="B Negative">B Negative</option>
                        <option value="B Unknown">B Unknown</option>
                        <option value="AB Positive">AB Positive</option>
                        <option value="AB Negative">AB Negative</option>
                        <option value="AB Unknown">AB Unknown</option>
                        <option value="O Positive">O Positive</option>
                        <option value="O Negative">O Negative</option>
                        <option value="O Unknown">O Unknown</option>
                        <option value="Unknown">Unknown</option>
                      </select>
                      <div class="input_img"><i class="fa fa-heartbeat"></i></div>
                    </div>
                    <br/>
                    <div class="form-group">
                      <input type="text" class="form-fields" name="donor_contact_no" placeholder="Donar_Contact No" pattern="[0-9]{10}" title="Invalid" required="">
                      <div class="input_img"><i class="fa fa-mobile"></i></div>
                    </div>
                    <br/>
                    <input type="hidden" name="key" value="CBFCBSUSC">
                    <div class="form-group">
                      <input type="submit" class="btn btn-success" value="Add">
                    </div>
                  </form>
                  <br/>
                  <!-- End of Add Blood Info Form -->
              
              </center>
            </div>
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
	      
	      //Add Info Form submit function
	      $("#add_blood_form").submit(function(e){
	          //To prevent page reloading
	          e.preventDefault();
	          //Ajax call
	          $.ajax({
	            url: "add-blood-info.php",
	            type:"POST",
	            data:$('#add_blood_form').serialize(),
	            success: function(result){
	              	$('#add_blood_form')[0].reset();
	                $("#result").html(result);
	                $('#myModal').modal('show');
	              

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
