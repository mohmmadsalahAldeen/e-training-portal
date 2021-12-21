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
  //if(!empty($_POST['FieldName']) && !empty($_POST['NameOfTheSpecialty']))
  //{
     $valSid = $_SESSION['Id'];
     $FieldName = $_POST['FieldName'] ;
     $NameOfTheSpecialty = $_POST['NameOfTheSpecialty'] ;

     $STH = $pd -> prepare( "SELECT Student_ID FROM student WHERE Student_ID =$valSid" );
     $STH -> execute();
     $result = $STH -> fetch();


    // insert trainingopportunity
      $insertIdSQL = <<<EOT
      INSERT INTO interest (Student_ID,FiledName,NameOfTheSpecially)
      VALUES (:Student_ID,:FiledName,:NameOfTheSpecially);
      EOT;
      $insertIDStatement = $pd-> prepare($insertIdSQL);
      //$lastId = $pd->lastInsertId();
      $insertIDStatement -> execute([
        ':Student_ID' => $result ["Student_ID"],
        ':FiledName' => $FieldName,
        ':NameOfTheSpecially' => $NameOfTheSpecialty
      ]);

       header('location:displaycompany.php');
       exit();
   //}
   //include('interestOfStudent.php');
   //exit();
}


?>
