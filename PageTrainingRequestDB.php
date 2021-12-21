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
  if(!empty($_POST['Note']))
  {
     $Note = $_POST['Note'];
     $valSid = $_SESSION['Id'];

     $STH_2 = $pd -> prepare( "SELECT Student_ID FROM student WHERE Student_ID = $valSid ");
     $STH_2 -> execute();
     $result_2 = $STH_2 -> fetch();

     $STH = $pd -> prepare( "SELECT compAgent_ID FROM companyagent WHERE compAgent_ID = 231 ");
     $STH -> execute();
     $result = $STH -> fetch();


    // insert trainingopportunity
      $insertIdSQL = <<<EOT
      INSERT INTO trainingreqest (Student_ID,CompAgent_ID,EvaluationMark,EvaluationReport,Status,Notes)
      VALUES (:Student_ID,:CompAgent_ID,:EvaluationMark,:EvaluationReport,:Status,:Notes);
      EOT;

      $insertIDStatement = $pd-> prepare($insertIdSQL);
      //$lastId = $pd->lastInsertId();
      $insertIDStatement -> execute([
        ':Student_ID' => $result_2 ["Student_ID"],
        ':CompAgent_ID' => $result ["compAgent_ID"],
        ':EvaluationMark' => 'null',
        ':EvaluationReport' => 'null',
        ':Status' => '1',
        ':Notes' => $Note
      ]);
    header('location:ClassPage.php');
    exit();
  }
  header('location:PageTrainingRequest.php');
  exit();
}
  ?>
