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



if(isset($_SESSION['Id'])){

  $valOfID = $_SESSION['Id'];

  $getUser2 = $pd->prepare("SELECT Status FROM account WHERE User_ID = '$valOfID'");
  $getUser2->execute(array($sessionUser));
  $info2 = $getUser2->fetch();

  $valStatus =  $info2['Status'];

   if ($valStatus != 1)
   {
       header('location:PageTrainingRequest.php');
   }
   else
   {
      header('location:ClassPage.php');
   }


}

?>
