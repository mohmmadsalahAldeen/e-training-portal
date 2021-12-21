<?php

session_start();

try
{
 $pd = new PDO('mysql:host=localhost;dbname=edutrainingport', 'root','looklook');
 $pd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $pd->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
 $error = 'Unable to connect to the database server.';
 exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Page of change profile</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

  <style>
  .form-control {
    position: relative;
  }

   .asterisk {
     font-size: 20px;
     position: absolute;
     right: 30px;
     top:4px;
     color:#D20707;
   }

  </style>

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
  <div class="container" style="margin-bottom:170px;">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">change profile</h1>

    <ol class="breadcrumb" style="background-color:#3d3d3d;">
      <li class="breadcrumb-item">
        <a href="index.html" style ="color:silver;">Home</a>
      </li>
      <li class="breadcrumb-item active" style="color:white;">page of change profile </li>
    </ol>

   <?php

   //if(isset($_POST['submit']))
   //{
       $valSid = $_SESSION['Id'];

       // Select all data depend on this ID

       $stmt = $pd -> prepare( "SELECT UserName , Email , Password  FROM account  WHERE User_ID = '$valSid' ");

       // Execute query

       $stmt -> execute(array($valSid));

       // Fetch the data

       $row = $stmt -> fetch();

       // The row count

       $count = $stmt->rowCount();

       // If there's such ID show the form

       if( $stmt->rowCount() == 1)
      {

       ?>

    <div class="row"  style="margin-left:17%;">
      <div class="col-lg-8 mb-4">

        <form action="PageChangeProfileUpdateDB.php" method="POST">
          <input type="hidden" name=$valSid value="<?php echo $valSid ?>" />

          <div class="form-group form-group-lg">
              <label class="col-sm-10 control-label">Name :</label>
              <div class="col-sm-10 col-md-10">
                 <input type="text" name="Name" class="form-control" value="<?php echo $row['UserName'] ?>" autocomplete="off" required="required" />
              </div>
          </div>

          <div class="form-group form-group-lg">
              <label class="col-sm-10 control-label">Email :</label>
              <div class="col-sm-10 col-md-10">
                  <input type="email" name="Email" value="<?php echo $row['Email'] ?>" class="form-control" required="required" />
              </div>
          </div>

          <div class="form-group form-group-lg">
              <label class="col-sm-10 control-label">Password :</label>
              <div class="col-sm-10 col-md-10">
                  <input type="hidden" name="oldpassword" value="<?php echo $row['Password'] ?>" />
                  <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="leave blank if you dont want to change" />
             </div>
          </div>

          <!-- For success/fail messages -->
          <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
               <input type="submit" value="Save" class="btn btn-primary btn-lg" />
           </div>
          </div>

        </form>

      </div>
    </div>

    <?php

    // if there's no such ID show error message

  } else{

    echo "Theres no such ID ";

   }

//}

    ?>
    <!-- /.row -->

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

  <script>

   $(function () {

     // 'use strict';
     //
     // // Hide placeholder on form docus
     //
     // $('[placeholder]').focus(function () {
     //
     //   $(this).attr('data-text' , $(this).attr('placeholder'));
     //
     //   $(this).attr('placeholder' , '');
     //
     // }).blur(function () {
     //
     //   $(this).attr('placeholder', $(this).attr('data-text'));
     //
     // });

     // Add asterisk on required field

     $('input').each(function () {

       if ($(this).attr('required') === 'required') {

           $(this).after('<span class="asterisk">*</span>');

       }

     });

   });

  </script>

</body>

</html>
