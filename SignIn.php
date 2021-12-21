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

if(isset($_POST['submit']))
{
      $Id = $_POST['id'];
      $username = $_POST['username'];
      $Password = $_POST['pass'];
      $hashedPass = sha1($Password);

      if(!empty($_POST['id']) && !empty($_POST['username']) && !empty($_POST['pass']))
      {
       $stmt = $pd->prepare("SELECT UserName , Password , Status FROM account WHERE UserName = '$username' AND Password = '$Password'");
       $stmt->execute(array($username,$hashedPass));
       $count = $stmt->rowCount();

       // $getStatus = $pd->prepare("SELECT Status FROM account WHERE UserName = '$username' ");
       // $getStatus->execute(array($sessionUser));
       // $info = $getStatus->fetchAll();

       $getUser2 = $pd->prepare("SELECT Status FROM account WHERE UserName = '$username'");
       $getUser2->execute(array($sessionUser));
       $info2 = $getUser2->fetch();

       $valStatus =  $info2['Status'];

      $FormErrors = array();

      if(isset($_POST['username'])){

           $filterdUser = filter_var($_POST['username'], FILTER_SANITIZE_STRING);

           if (strlen($filterdUser) < 4){

               $FormErrors[] = 'Username Must Be larger than 4 characters';

           }

      }

   if($count > 0)
   {

      if($Id  >= 100 && $Id  <=199)
      {
          if( $valStatus == 1 )
          {
             $_SESSION['UserName'] = $username;
             $_SESSION['Id'] = $Id;
             header("location:ClassPage.php");
             exit();
          }

         if( $valStatus == 0 )
         {
            $_SESSION['UserName'] = $username;
            $_SESSION['Id'] = $Id;
            header("location:interestOfStudent.php");
            exit();
         }

      }

      if($Id >= 200 && $Id <=299)
      {
         $_SESSION['UserName'] = $username;
         $_SESSION['Id'] = $Id;
         header("location:Pageofsupervisor.php");
         exit();
      }

      if($Id >= 800 && $Id <=899)
      {
        $_SESSION['UserName'] = $username;
        $_SESSION['Id'] = $Id;
        header("location:PageOfCompany.php");
        exit();
      }
   }
 }

 }

?>

<!DOCTYPE html>
<html>
<head>

<title>SingIn page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

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

<style>

body{
  background-color: #F4F4F4;
}

.login {
  width:300px;
  margin: 100px auto;
}

.login h4{
  color:#888;
}

.login input{
  margin-bottom: 10px;
}

.login .form-control{
  background-color: #EAEAEA;
}

.login .btn{
  background-color: #008dde;
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

<div class="container" style="margin-top: 1%;">

    <h2 >Login page</h2>

   <ol class="breadcrumb" style="background-color:#191919;">
      <li class="breadcrumb-item">
         <a href="index.html">Home</a>
      </li>
      <li class="breadcrumb-item active">Login</li>
  </ol>

  <form class="login" action="" method="post">

      <h4 class="text-center">Login</h4>

      <input class="form-control input-lg" type="id" name="id" placeholder="id" required/>

      <input class="form-control input-lg" type="text" name="username" placeholder="username" required  />

      <input minlength = "4" class="form-control input-lg" type="password" name="pass" placeholder="password" autocomplete="new-password" required/>

      <input class="btn btn-primary btn-block" type="submit" name="submit" value="Login" />

 </form>

 <div class="the-errors text-center">

     <?php

       if(!empty($FormErrors)) {

         foreach ($FormErrors as $error) {

             echo $error . '<br>';

         }

       }

       // if(!empty($FormErrors_2)) {
       //
       //   foreach ($FormErrors_2 as $error_2) {
       //
       //       echo $error_2 . '<br>';
       //
       //   }
       //
       // }
     ?>

 </div>

</div>

<!-- Footer -->
<footer class="py-5 bg-dark">
  <div class="container">
    <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020 - 2021</p>
  </div>
</footer>

<!--**********************************
    Scripts
***********************************-->
<script src="plugins/common/common.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/settings.js"></script>
<script src="js/gleek.js"></script>
<script src="js/styleSwitcher.js"></script>

<script>

$(function(){

 'use strict';

 //Hide placeholder

 $('[placeholder]').focus(function(){

   $(this).attr('data-text' , $(this).attr('placeholder'));

   $(this).attr('placeholder','');

 }).blur(function(){

  $(this).attr('placeholder',$(this).attr('data-text'));

  });

});

</script>

<!-- <div class="imgcontainer">
   <img src="image/img_avatar2.png" style="width:300px;height:300px;" alt="Avatar" class="avatar">
</div> -->

<!-- <label><b>ID</b></label>
<input type="text" placeholder="Enter ID" name="ID">

<label><b>password</b></label>
<input type="text" placeholder="Enter password" name="password">

<button type="submit" name="submit">Login</button> -->

<!-- <label>
   <input type="checkbox" checked="checked" name="remember"> Remember me
</label>

<div class="container" style="background-color:#f1f1f1">
  <button type="button" class="cancelbtn">Cancel</button>
  <span class="psw">Forgot <a href="#">password?</a></span>
</div> -->

</body>
</html>
