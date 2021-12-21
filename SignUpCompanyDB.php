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

  if(!empty($_POST['Email']) && !empty($_POST['Address']) && !empty($_POST['NameOfAgentCompany']) && !empty($_POST['Location']))
  {

     $NameOfAgentCompany = $_POST['NameOfAgentCompany'] ;
     $Location = $_POST['Location'] ;
     $Email = $_POST['Email'] ;
     $Address = $_POST['Address'] ;


     // $FormErrors = array();
     //
     // if(isset($_POST['NameOfAgentCompany'])){
     //
     //      $filterdUser = filter_var($_POST['NameOfAgentCompany'], FILTER_SANITIZE_STRING);
     //
     //      if (strlen($filterdUser) < 10){
     //
     //          $FormErrors[] = 'Username Must Be larger than 10 characters';
     //
     //      }
     //
     // }

     if ($Email)
     {
     // insert user
     $insertUserSQL = "
     INSERT INTO user (Email, Address)
     VALUES (:Email, :Address)";

     $insertUserStatement = $pd->prepare($insertUserSQL);
     $insertUserStatement->execute([
       ':Email' => $Email,
       ':Address' => $Address
     ]);

     // insert company agent
     $insertIdSQL = "
     INSERT INTO companyagent (User_ID,NameOfAgentComp,Location)
     VALUES (:User_ID, :NameOfAgentComp,:Location)";

     $insertIDStatement = $pd-> prepare($insertIdSQL);
     $lastId = $pd->lastInsertId();
     $insertIDStatement -> execute([
       ':User_ID' => $lastId,
       ':NameOfAgentComp' => $NameOfAgentCompany,
       ':Location' => $Location
     ]);

     //include('PageOfCompany.php');
     header("location:PageOfCompany.php");
     exit();
   }

 }
else{
  //echo "all fields required";
  header('SignUpCompany.php');
  exit();
}

}
  ?>
