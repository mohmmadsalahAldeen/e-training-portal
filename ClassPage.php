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

  <title>Class page</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
  <!-- Custom Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  <!-- Custom Stylesheet -->
  <link href="css/forPageLogIn.css" rel="stylesheet">

  <!--<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">-->
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

  <style>
    .custom-select_1,.custom-select_2,.custom-select_3,.custom-select_4 {
      width:300px;
      height:40px;
      background-color: #EEE;
      position: relative;
      border-radius: 10px;
    }

    .custom-select_1 select ,.custom-select_2 select,.custom-select_3 select,.custom-select_4 select{
      width:100%;
      height:100%;
      border:none;
      background:transparent;
      padding:0 10px;
      position: relative;
      z-index:2;
      -webkit-appearance:none;
      -moz-appearance:none;
      appearance:none;
    }

    .custom-select_1:after , .custom-select_2:after ,.custom-select_3:after ,.custom-select_4:after{
      content: 'S';
      display: block;
      width:20px;
      height:20px;
      line-height: 20px;
      text-align: center;
      background-color: #00F;
      color:#FFF;
      position: absolute;
      top:10px;
      right:10px;
      z-index:1;
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
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Class page</h1>

      <ol class="breadcrumb" style="background-color:#191919;">
        <li class="breadcrumb-item">
          <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item active">Class Page</li>
      </ol>

      <h3>

        <a style="margin-right:10px;" href="ClassPage.php"> Training </a>
         /
        <a style="margin-right:10px;" href="url"> Discation </a>
         /
        <a style="margin-right:10px;" href="url"> Live session </a>
        /
        <a style="margin-right:10px;" href="PerformanceEvaluation.php"> Student evaluation </a>

      </h3>

      <br><br>

      <div style="height:80px;width:1000px;">
           <h1 style ="color:#4cb4dc;">Web Developer</h1>
      </div>

      <div style="width:400;height:800px;border:1px solid #f6f6f6;">

        <form>
          <div class="custom-select_1">
            <select>
                    <option value="1">First week lesson 1</option>
                    <option value="2">First week lesson 2</option>
                    <option vlaue="3">First week lesson 3</option>
                    <option value="4">First week lesson 4</option>
            </select>
          </div>

          <br></br><br><br><br>

          <div class="custom-select_2">
            <select>
                    <option value="1">second week lesson 1</option>
                    <option value="2">second week lesson 2</option>
                    <option vlaue="3">second week lesson 3</option>
                    <option value="4">second week lesson 4</option>
            </select>
          </div>

          <br></br><br><br><br>

          <div class="custom-select_3">
            <select>
                    <option value="1">third week lesson 1</option>
                    <option value="2">third week lesson 2</option>
                    <option vlaue="3">third week lesson 3</option>
                    <option value="4">third week lesson 4</option>
            </select>
          </div>

          <br></br><br><br><br>

          <div class="custom-select_4">
            <select>
                    <option value="1">Fourth week lesson 1</option>
                    <option value="2">Fourth week lesson 2</option>
                    <option vlaue="3">Fourth week lesson 3</option>
                    <option value="4">Fourth week lesson 4</option>
            </select>
          </div>
        </form>

      </div>

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
