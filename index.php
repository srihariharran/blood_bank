<?php
  //Starting Session
  session_start();
  //Checking Session
  if(isset($_SESSION['login_key']))
  {
    if($_SESSION['login_key']=="HSHAAES1" || $_SESSION['login_key']=="RSHAAES7")
    {
      //Redirecting to Home page
      header("location:home.php");
    }
  }
  else
  {
    //Including Header
    include 'header.php';
    //Database Connection
    include 'db.php';
    $blood_group_dataPoints = array();
    $blood_bank_dataPoints = array();
?>    

      
      <div class="col-sm-12">
        <div id="demo" class="carousel slide" data-ride="carousel" >
          <!-- The slideshow -->
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="images/BANNER1.jpg" alt="Blood Bank" >
            </div>
            <div class="carousel-item">
             <img src="images/BANNER2.jpg" alt="Blood Bank">
            </div>
            <div class="carousel-item">
              <img src="images/BANNER3.jpg" alt="Blood Bank">
            </div>
          </div>
        </div>
      </div>
      <br/>
      <!-- Blood Group Graph -->
      <div class="row justify-content-center ">
        <div class="col-sm-4 box border border-dark">
          <div id="blood_group_chart" style="height: 350px; width: 100%;"></div>
        </div>&nbsp;&nbsp;
        <div class="col-sm-4 box border border-dark">
          <div id="blood_bank_chart" style="height: 350px; width: 100%;"></div>
        </div>
      </div>
      <br/>
      <h4 class="text-center"><b>Here,The Available Blood Samples</b></h4>
      <div class="text-center">
        <button data-toggle="modal" data-target="#filter_modal" class="btn btn-light" style="width: 100px;color: black"><i class="fa fa-filter" ></i>Filter</button>
      </div>
      <br/>
      <?php
        //Getting Count for Each Blood Group             
        $sql="SELECT blood_group,COUNT(*) as count FROM blood_bank_blood_details GROUP BY blood_group ORDER BY blood_group";
        if($res=mysqli_query($con,$sql))
        {
            
            while($row=mysqli_fetch_array($res))
            {
                array_push($blood_group_dataPoints,array("y" => $row['count'],"label" => $row['blood_group']));
            }
        }

        $sql="SELECT city,COUNT(*) as count FROM blood_bank_user_details WHERE user_type='H' GROUP BY city ORDER BY city";
        if($res=mysqli_query($con,$sql))
        {
            
            while($row=mysqli_fetch_array($res))
            {
                array_push($blood_bank_dataPoints,array("y" => $row['count'],"label" => $row['city']));
            }
        }
      ?>
      <div class="col-sm-12 text-center">
        <div class="row justify-content-center" id="filter_result">
                  <?php
                  $sql="SELECT DISTINCT(bbbd.blood_group),bbud.email_id,bbud.name,bbud.city,bbud.hospital_logo,bbud.contact_no  FROM blood_bank_blood_details bbbd JOIN blood_bank_user_details bbud ON bbbd.hospital_id = bbud.email_id";
                  if($res=mysqli_query($con,$sql))
                  {
                    if(mysqli_num_rows($res)!=0)
                    {
                    
                      while($row=mysqli_fetch_array($res))
                      {

                        ?>
                        <div class="col-sm-4 p-3">
                          <div class="box text-center p-2">
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
                  ?>
            </div>
          </div>
        

    <!-- Modal for Login -->
    <div class="modal" id="login_modal" >
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Login</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body" >
            <div class="row justify-content-center">
              <div class="col-sm-9">
              <!-- Start of Login Form -->
                <form id="login_form">
                  <div class="form-group">
                    <input type="text" class="form-fields" name="email_id" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" title="Enter Valid Email Id" placeholder="Email" required="">
                    <div class="input_img_login"><i class="fa fa-envelope"></i></div>
                  </div>
                  <br/>
                  <div class="form-group">
                    <input type="password" class="form-fields" name="password" placeholder="Password" required="">
                    <div class="input_img_login"><i class="fa fa-lock"></i></div>
                  </div>
                  <br/>
                  <div class="text-secondary text-right cursor" id="forgot_password" data-toggle="modal" data-target="#forgot_password_modal">Forgot Password?</div>
                  <br/>
                  <input type="hidden" name="key" value="EDMASLF">
                  <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Login">
                  </div>
                </form>
                <br/>
                <div class="text-secondary text-center">New to Blood Bank?<a href="registration-form.php" style="text-decoration: none">Register</a></div>
                <br/>
              <!-- End of Login Form -->
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for Forgot Password -->
    <div class="modal" id="forgot_password_modal" >
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Forgot Password</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body" >
            <div class="row justify-content-center">
              <div class="col-sm-9">
              <!-- Start of Forgot Password Form -->
                <form id="forgot_password_form">
                  <div class="form-group">
                    <input type="text" class="form-fields" name="email_id" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" title="Enter Valid Email Id" placeholder="Email" required="">
                    <div class="input_img_login"><i class="fa fa-envelope"></i></div>
                  </div>
                  <br/>
                  <input type="hidden" name="key" value="CBFCBSUSC">
                  <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Get Password">
                  </div>
                </form>
                <br/>
              <!-- End of Forgot Password Form -->
            </div>
          </div>
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
      //Login Form submit function
      $("#login_form").submit(function(e){
          //To prevent page reloading
        	e.preventDefault();
          //Ajax call
          $.ajax({
            url: "auth.php",
            type:"POST",
            data:$('#login_form').serialize(),
            success: function(result){
              $('#login_form')[0].reset();
              if(result=="Success")
              {
                location.replace("home.php");
              }
              else
              {
                $("#result").html(result);
                $('#myModal').modal('show');
                $('#login_modal').modal('hide');
              }

          }});
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

      //Forgot Password Form submit function
      $("#forgot_password_form").submit(function(e){
        alert("hi");
          //To prevent page reloading
          e.preventDefault();
          //Ajax call
          $.ajax({
            url: "forgot-password.php",
            type:"POST",
            data:$('#forgot_password_form').serialize(),
            success: function(result){
              $('#forgot_password_form')[0].reset();
              $('#result').html(result);
              $('#forgot_password_modal').modal('hide');
              $('#myModal').modal('show');

          }});
      });

      $('#forgot_password').click(function()
      {
        $('#login_modal').modal('hide');
      });
                            
                             
      var blood_group_chart = new CanvasJS.Chart("blood_group_chart", {
          theme: "light2",
          animationEnabled: true,
          title: {
              text: "Available Blood Group",
              fontSize:20
          },
          data: [{
              type: "doughnut",
              indexLabel: "{label} :{y}",
              yValueFormatString: "#,##0",
              showInLegend: true,
              legendText: "{label} : {y}",
              dataPoints: <?php echo json_encode($blood_group_dataPoints, JSON_NUMERIC_CHECK); ?>
          }]
      });
      blood_group_chart.render();

      var blood_bank_chart = new CanvasJS.Chart("blood_bank_chart", {
          theme: "light2",
          animationEnabled: true,
          title: {
              text: "Available Blood Bank in Cities",
              fontSize:20
          },
          data: [{
              type: "doughnut",
              indexLabel: "{label} :{y}",
              yValueFormatString: "#,##0",
              showInLegend: true,
              legendText: "{label} : {y}",
              dataPoints: <?php echo json_encode($blood_bank_dataPoints, JSON_NUMERIC_CHECK); ?>
          }]
      });
      blood_bank_chart.render();
       
      
      </script>
<?php 
  //Including Footer
  include 'footer.php';
  }
  
?>
