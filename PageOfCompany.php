<?php

session_start();

echo $_SESSION['Id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Page of company</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>
  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">eduTraining Portal</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>

        <!--  <li class="nav-item">
            <a class="nav-link" href="services.php">Services</a>
          </li>-->

          <!--<li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>-->

          <?php
             if(isset($_SESSION['UserName'])){

          ?>
          <li class="nav-item">
            <a class="nav-link" href="LogOut.php">LogOut</a>
          </li>
        <?php
        }

        ?>

          <li class="nav-item">
            <a class="nav-link" href="SignIn.php">Login</a>
          </li>
          <?php
             if(isset($_SESSION['UserName'])){

          ?>
          <li class="nav-item">
            <a class="nav-link" href="email-compose.php">Inbox</a>
          </li>
        <?php
        }

        ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Accounts
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPages">
              <a class="nav-link dropdown-toggle" href="#" style="color:black;padding-left:23px;" id="navbarDropdownPages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Registration
              </a>
                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPages">
                    <a class="dropdown-item" href="SignUpCompany.php">SignUp company</a>
                </div>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPages">
                   <a class="dropdown-item" href="LogOut.php">LogOut</a>
               </div>
            </div>
          </li>
          <?php
             if(isset($_SESSION['UserName'])){

          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              setting
            </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPages">
                      <a class="dropdown-item" href="PageChangeProfile.php">Change profile</a>
                </div>
          </li>
          <?php
          }

          ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Page Content -->
  <div class="container" style="margin-bottom:250px;">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Login company
    </h1>

    <ol class="breadcrumb" style="background-color:#3d3d3d;">
      <li class="breadcrumb-item">
        <a href="index.html">Home</a>
      </li>
      <li class="breadcrumb-item active">Login company</li>
    </ol>

    <div class="row" style="margin-left:17%;">
      <div class="col-lg-8 mb-4">

        <form id="" action="PageTrainingOppor.php" method="post">

          <div class="control-group form-group">
            <div class="controls">
              <input type="submit" value="insert training opportinity" class="form-control" id="" required data-validation-required-message="Please enter your phone number.">
            </div>
          </div>

        </form>

       <form action="AddvertismentPage.php" method="post">

          <div class="control-group form-group">
            <div class="controls">
              <input type="submit" value="insert addvertisment" class="form-control" id="" required data-validation-required-message="Please enter your email address.">
            </div>
          </div>

       </form>

          <form action="index.php" method="post">
            <!-- For success/fail messages -->
            <button type="submit" style="width:100%;" class="btn btn-primary" id="sendMessageButton">Skip</button>
          </form>

      </div>
    </div>
    <!-- /.row -->

    <!-- Contact Form -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020 - 2021</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Contact form JavaScript -->
  <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

</body>

</html>
