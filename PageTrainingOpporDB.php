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
     $valSOpp = $_SESSION['Id'];
     $PlaceOfOppor = $_POST['PlaceOfOppor'] ;
     $OpporType = $_POST['OpporType'] ;

     if(!empty($_POST['PlaceOfOppor']) && !empty($_POST['OpporType']))
     {
      $STH = $pd -> prepare( "SELECT compAgent_ID FROM companyagent WHERE User_ID = '$valSOpp'" );
      $STH -> execute();
      $result = $STH -> fetch();


    // insert trainingopportunity
      $insertIdSQL = <<<EOT
      INSERT INTO trainingopportunity (CompAgent_ID,PlaceOfOpportunity,OpportunityType)
      VALUES (:CompAgent_ID, :PlaceOfOpportunity,:OpportunityType);
      EOT;
      $insertIDStatement = $pd-> prepare($insertIdSQL);
      //$lastId = $pd->lastInsertId();
      $insertIDStatement -> execute([
        ':CompAgent_ID' => $result ["compAgent_ID"],
        ':PlaceOfOpportunity' => $PlaceOfOppor,
        ':OpportunityType' => $OpporType
      ]);
      header('location:index.php');
      exit();
    }
     header('location:PageTrainingOppor.php');
     exit();
}

?>
