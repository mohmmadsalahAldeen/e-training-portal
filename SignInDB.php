<?php

session_start();

try
{
 $pd = new PDO('mysql:host=localhost;dbname=edutrainingport', 'root','looklook');
 $pd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $pd->exec('SET NAMES "utf8"');
 echo "success connection";
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

      $stmt = $pd->prepare("SELECT UserName , Password FROM account WHERE UserName = '$username' AND Password = '$Password'");
      $stmt->execute(array($username,$hashedPass));
      $count = $stmt->rowCount();

      $FormErrors = array();

      if(isset($_POST['username'])){

           $filterdUser = filter_var($_POST['username'], FILTER_SANITIZE_STRING);

           echo $filterdUser;

      }

   // if($count > 0)
   // {
   //
   //    if($Id  >= 100 && $Id  <=199)
   //    {
   //      $_SESSION['UserName'] = $username;
   //      $_SESSION['Id'] = $Id;
   //      include('interestOfStudent.php');
   //      exit();
   //    }
   //
   //    if($Id >= 200 && $Id <=299)
   //    {
   //      $_SESSION['UserName'] = $username;
   //      $_SESSION['Id'] = $Id;
   //      include('Pageofsupervisor.php');
   //      exit();
   //    }
   // }


}


  ?>
