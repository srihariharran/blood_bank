<?php
  //Including Header
  include 'header.php';

?>
        <br/>
        <div class="row justify-content-center">
          <div class="col-sm-5 box text-center ">
            <br/>
            <div class="hospital-form">
                <h3><b>Hospital Registration</b></h3>
                <br/>
                <center>
                  <!-- Start of Hospital Registration Form -->
                  <form style="width:300px;" id="hospital_form">
                    <div class="form-group">
                      <input type="text" class="form-fields" name="email_id" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" title="Enter Valid Email Id" placeholder="Email" required="">
                      <div class="input_img"><i class="fa fa-envelope"></i></div>
                    </div>
                    <br/>
                    <div class="form-group">
                      <input type="password" class="form-fields" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password" required="">
                      <div class="input_img"><i class="fa fa-lock"></i></div>
                    </div>
                    <br/>
                    <div class="form-group">
                      <input type="text" class="form-fields" name="hospital_name" placeholder="Name of Hospital" pattern="[a-zA-Z0-9 ]{2,30}" title="Should be less than 30 characters" required="">
                      <div class="input_img"><i class="fa fa-university"></i></div>
                    </div>
                    <br/>
                    <div class="form-group">
                      <input type="text" class="form-fields" name="hospital_city" placeholder="City" required="">
                      <div class="input_img"><i class="fa fa-map-marker"></i></div>
                    </div>
                    <br/>
                    <div class="form-group">
                      <label>Upload Hospital Logo:</label>
                      <input type="file" class="form-fields" name="hospital_logo" required="">
                      <div class="input_img"><i class="fa fa-photo"></i></div>
                    </div>
                    <br/>
                    <div class="form-group">
                      <input type="text" class="form-fields" name="hospital_contact_no" placeholder="Contact No" pattern="[0-9 ]{10}" title="Invalid" required="">
                      <div class="input_img"><i class="fa fa-mobile"></i></div>
                    </div>
                    <br/>
                    <input type="hidden" name="key" value="CBFC-USC">
                    <input type="hidden" name="form_type" value="HRF">
                    <div class="form-group">
                      <input type="submit" class="btn btn-success" value="Register">
                    </div>
                  </form>
                  <br/>
                  <div class="text-center text-secondary">Already Registered?<a href="index.php" style="text-decoration: none">Login</a></div>
                  <br/>
                  <!-- End of Hospital Registration Form -->
                
              </center>
            </div>
              <div class="receiver-form">
                <h3><b>Receiver Registration</b></h3>
                <br/>
                <center>
                  <!-- Start of Receiver Registration Form -->
                  <form style="width:300px;" id="receiver_form">
                    <div class="form-group">
                      <input type="text" class="form-fields" name="email_id" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" title="Enter Valid Email Id" required="">
                      <div class="input_img"><i class="fa fa-envelope"></i></div>
                    </div>
                    <br/>
                    <div class="form-group">
                      <input type="password" class="form-fields" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password" required="">
                      <div class="input_img"><i class="fa fa-lock"></i></div>
                    </div>
                    <br/>
                    <div class="form-group">
                      <input type="text" class="form-fields" name="receiver_name" pattern="[a-zA-Z ]{2,30}" title="Should be less than 30 characters" placeholder="Name" required="">
                      <div class="input_img"><i class="fa fa-user"></i></div>
                    </div>
                    <br/>
                    <div class="form-group">
                      <input type="text" class="form-fields" name="receiver_city" placeholder="City" required="">
                      <div class="input_img"><i class="fa fa-map-marker"></i></div>
                    </div>
                    <br/>
                    <div class="form-group">
                      <label>Blood Group:</label>
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
                      <div class="input_img"><i class="fa fa-user"></i></div>
                    </div>
                    <br/>
                    <div class="form-group">
                      <input type="text" class="form-fields" name="contact_no" placeholder="Contact No" pattern="[0-9 ]{10}" title="Should be less than 30 characters" required="">
                      <div class="input_img"><i class="fa fa-mobile"></i></div>
                    </div>
                    <br/>
                    <input type="hidden" name="key" value="CBFC-USC">
                    <input type="hidden" name="form_type" value="RRF">
                    <div class="form-group">
                      <input type="submit" class="btn btn-success " value="Register">
                    </div>
                  </form>
                  <br/>
                  <div class="text-center text-secondary">Already Registered?<a href="index.php" style="text-decoration: none">Login</a></div>
                  <br/>
                  <!-- End of Receiver Registration Form -->
              
              </center>
            </div>
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
      $(".receiver-form").hide();
      $("#receiver-link").click(function()
      {
        $(".receiver-form").show();
        $(".hospital-form").hide();
      });
      $("#hospital-link").click(function()
      {
        $(".receiver-form").hide();
        $(".hospital-form").show();
      });
      //Hospital Form submit function
      $("#hospital_form").submit(function(e){
          //To prevent page reloading
        	e.preventDefault();
          var formData = new FormData($('#hospital_form')[0]);
          //Ajax call
          $.ajax({
            url: "register.php",
            type:"POST",
            data:formData,
            processData: false,
            contentType: false,
            cache : false,
            success: function(result){
              $('#hospital_form')[0].reset();
              
                $("#result").html(result);
                $('#myModal').modal('show');
              

          }});
      });
      //Receiver Form submit function
      $("#receiver_form").submit(function(e){
          //To prevent page reloading
          e.preventDefault();
          //Ajax call
          $.ajax({
            url: "register.php",
            type:"POST",
            data:$('#receiver_form').serialize(),
            success: function(result){
              $('#receiver_form')[0].reset();
              
                $("#result").html(result);
                $('#myModal').modal('show');
              

          }});
      });

    </script>
<?php 
  //Including Footer
  include 'footer.php';
?>
