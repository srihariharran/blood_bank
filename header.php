<!DOCTYPE html>
<html>
  <!-- Start of Head Section -->
  <head>
    <!-- Title -->
    <title>Blood Bank</title>
    <!-- Meta Tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap,Jquery and CSS Files -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/canvasjs.min.js"></script>
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <!-- End of Head Section -->
  <!-- Start of Body Section -->
  <body>
    
      <!-- Navbar -->
      <?php
      if($_SERVER['PHP_SELF']=='/Blood_Bank/registration-form.php')
      {
      ?>
      <div class="container bg-white" >
      <nav class="navbar navbar-expand-xl navbar-light bg-white sticky-top" >
        <div class="navbar-nav">
              <a class="nav-item nav-link active text-danger" id="hl" ><b><i class="fa fa-heartbeat"></i>&nbsp;Blood Bank</b></a>
        </div>
        <button class="navbar-toggler text-white" align="right" style="border:none;outline:none;color:white" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span>
        </button>
         <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto" >
              <a class="nav-item nav-link active" id="hospital-link" href="#" style="font-size:18px"><i class="fa fa-plus" ></i>&nbsp;Hospital Registration Form</a>
              <a class="nav-item nav-link active" id="receiver-link" href="#" style="font-size:18px"><i class="fa fa-plus" ></i>&nbsp;Receiver Registration Form</a>
              <a class="nav-item nav-link active" href="index.php" style="font-size:18px"><i class="fa fa-home" ></i>&nbsp;Home</a>
        </div>
        </div>
      </nav>
      <?php
      }
      if($_SERVER['PHP_SELF']=='/Blood_Bank/index.php' || $_SERVER['PHP_SELF']=='/Blood_Bank/')
      {
      ?>
      <div class="container-fluid bg-white" >
      <nav class="navbar navbar-expand-xl navbar-light bg-white sticky-top" >
        <div class="navbar-nav">
              <a class="nav-item nav-link active text-danger" id="hl" ><b><i class="fa fa-heartbeat"></i>&nbsp;Blood Bank</b></a>
        </div>
        <button class="navbar-toggler text-white" align="right" style="border:none;outline:none;color:white" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span>
        </button>
         <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto" >
              <a class="nav-item nav-link active" id="hospital-link" href="#" data-toggle="modal" data-target="#login_modal" style="font-size:18px"><i class="fa fa-sign-in" ></i>&nbsp;Login</a>
              <a class="nav-item nav-link active" id="receiver-link" href="registration-form.php" style="font-size:18px"><i class="fa fa-plus" ></i>&nbsp;New User</a>
              <!-- <a class="nav-item nav-link active" href="index.php" style="font-size:18px"><i class="fa fa-sign-in" ></i>&nbsp;Login</a> -->
        </div>
        </div>
      </nav>
      <br/>
      <?php
      }
      if(isset($_SESSION['login_key']))
      {
      ?>
      <div class="container-fluid bg-white" style="width:100%" >
      <nav class="navbar navbar-expand-xl navbar-light bg-white sticky-top" >
        <div class="navbar-nav">
              <a class="nav-item nav-link active text-danger" id="hl" ><b><i class="fa fa-heartbeat"></i>&nbsp;Blood Bank</b></a>
        </div>
        <button class="navbar-toggler text-white" align="right" style="border:none;outline:none;color:white" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto" >
                <a class="nav-item nav-link active"  href="#" style="font-size:18px"><i class="fa fa-user" ></i>&nbsp;Welcome,<?php echo $_SESSION['name']; ?></a>
                <a class="nav-item nav-link active"  href="home.php" style="font-size:18px"><i class="fa fa-home" ></i>&nbsp;Home</a>
                <?php
                if($_SESSION['login_key']=="HSHAAES1")
                {
                  ?>
                  <a class="nav-item nav-link active"  href="add-blood-info-form.php" style="font-size:18px"><i class="fa fa-plus" ></i>&nbsp;Add Blood Info</a>
                  
                  <?php
                }
                ?>
                <a class="nav-item nav-link active"  href="requested-blood-sample-details.php" style="font-size:18px"><i class="fa fa-eye" ></i>&nbsp;Requested Blood Samples</a>
                <a class="nav-item nav-link active"  href="available-blood-samples.php" style="font-size:18px"><i class="fa fa-eye" ></i>&nbsp;Available Blood Samples</a>
                
                
                <a class="nav-item nav-link active"  href="logout.php" style="font-size:18px"><i class="fa fa-sign-out" ></i>&nbsp;Logout </a>
          </div>
        </div>
      </nav>
      <br/>
      <?php
      }
      ?>

  