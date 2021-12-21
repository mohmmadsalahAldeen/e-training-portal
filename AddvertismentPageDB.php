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
    //$valSadd = $_SESSION['Id'];
    $Title = $_POST['Title'];
    $Content = $_POST['Content'];
    $Photo = $_POST['avatar'];

    $STH = $pd -> prepare( "SELECT compAgent_ID FROM companyagent" );
    $STH -> execute();
    $result = $STH -> fetch();

    //echo $result ["compAgent_ID"];

    if(!empty($_POST['Title']) && !empty($_POST['Content']))
    {
    // Upload Variables
    $avatarName = $_FILES['avatar']['name'];
    $avatarSize = $_FILES['avatar']['size'];
    $avatarTmp  = $_FILES['avatar']['tmp_name'];
    $avatarType = $_FILES['avatar']['type'];

    // List of Allowed File typed to upload
    $avatarAllowedExtension = array("jpeg","jpg","png","gif");

    //Get avatar Extension
    $avatarExtension = strtolower(end(explode('.',$avatarName)));

    if(!in_array($avatarExtension,$avatarAllowedExtension)){
      echo "This extension is not allowed";
    }
    if($avatarSize > 4194304) {
      echo "Avatar can't be larger than 4MB";
    }

    $avatar = rand(0,100000) . '_' . $avatarName;

    move_uploaded_file($avatarTmp,"Uploads\avatars\\".$avatar);

    // insert Addvertisments
    $insertIdSQL = <<<EOT
    INSERT INTO advertisment (CompAgent_ID ,Title ,Content ,Photo ,Date)
    VALUES (:CompAgent_ID ,:Title ,:Content ,:Photo ,now());
    EOT;
    $insertIDStatement = $pd-> prepare($insertIdSQL);
    $insertIDStatement -> execute([
     ':CompAgent_ID' => $result ["compAgent_ID"],
     ':Title' => $Title,
     ':Content' => $Content,
     ':Photo' => $avatar
   ]);

     //header("location:index.php");
     //exit();
  }
    header("location:index.php");
    //exit();
}


  ?>
