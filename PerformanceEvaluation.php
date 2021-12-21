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

if(isset($_SESSION['UserName']) || isset($_SESSION['Id']))
{

$valName = $_SESSION['UserName'];

$valId = $_SESSION['Id'];

$getUser = $pd->prepare("SELECT User_ID , UserName , Timestamp FROM account WHERE User_ID = '$valId'");

$getUser->execute(array($sessionUser));

$info = $getUser->fetch();

$getUser2 = $pd->prepare("SELECT Supervisor_ID FROM student WHERE User_ID = '$valId'");

$getUser2->execute(array($sessionUser));

$info2 = $getUser2->fetch();

if(isset($_POST["submit"]))
{

 $val_11 = $_POST['radio_1'];
 $val_22 = $_POST['radio_2'];
 $val_33 = $_POST['radio_3'];
 $val_44 = $_POST['radio_4'];

  $data_2 = [
      ["The ability to learn :", "Work in progress :" , "Relationship with colleagues :" , "Production Quantity :"],
      ["Radio_1" => "$val_11"],
      ["Radio_2" => "$val_22"],
      ["Radio_3" => "$val_33"],
      ["Radio_4" => "$val_44"]
    ];
     $filename_2 = "Export_excel.xls";
     header("Content-Type: application/vnd.ms-excel");
     header("Content-Disposition: attachment; filename=\"$filename_2\"");

     $flag_2 = false;
     foreach($data_2 as $row_2) {
      if(!$flag_2) {
        // display field/column names as first row
        echo implode("\t", array_keys($row_2)) . "\r\n";
       $flag_2 = true;
    }
     echo implode("\t", array_values($row_2)) . "\r\n";
  }
  if(! empty($info)){
    //foreach ($info as $row) {
      if(! $isPrintHeader) {
        echo implode("\t", array_keys($info)) . "\n";
        $isPrintHeader = true;
      }
       echo implode("\t", array_values($info)) . "\n";
    //}
  }
  exit;
}

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Page of Performance Evaluation</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

</head>

<body >

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
    <h1 class="mt-4 mb-3">Performance Evaluation
    </h1>

    <ol class="breadcrumb" style="background-color:#3d3d3d;">
      <li class="breadcrumb-item">
        <a href="index.html">Home</a>
      </li>
      <li class="breadcrumb-item active">Performance Evaluation</li>
    </ol>


  <table class="table">
   <tbody>
     <tr>
       <th scope="row">Name of student : <?php echo $info['UserName']; ?></th>
     </tr>
     <tr>
       <th scope="row">Id of student : <?php echo $info['User_ID']; ?></th>
     </tr>
     <tr>
       <th scope="row">Id of supervisor : <?php echo $info2['Supervisor_ID']; ?></th>
     </tr>
     <tr>
       <th scope="row">Date of evaluation : <?php echo $info['Timestamp']; ?></th>
     </tr>
   </tbody>
 </table>

   <table class="table">
  <thead>
    <tr>
      <th scope="col">Num</th>
      <th scope="col">Element of evaluation</th>
      <th scope="col">Excelant</th>
      <th scope="col">Very good</th>
      <th scope="col">Good</th>
      <th scope="col">Acceptable</th>
    </tr>
  </thead>
  <tbody>

 <form action="" method="post" class="mb-3">
    <tr class="item">
      <th scope="row">1</th>
      <td>The ability to learn :</td>
      <td><input type="radio" id="myRadio" name="radio_1" value="Excelant"/></td>
      <td><input type="radio" id="myRadio" name="radio_1" value="Very good" /></td>
      <td><input type="radio" id="myRadio" name="radio_1" value="Good" /></td>
      <td><input type="radio" id="myRadio" name="radio_1" value="Acceptable" /></td>
    </tr>

    <tr class="item">
      <th scope="row">2</th>
      <td>Work in progress :</td>
      <td><input type="radio" id="" name="radio_2" value="Excelant"/></td>
      <td><input type="radio" id="" name="radio_2" value="Very good"/></td>
      <td><input type="radio" id="" name="radio_2" value="Good"/></td>
      <td><input type="radio" id="" name="radio_2" value="Acceptable"/></td>
    </tr>

    <tr class="item">
      <th scope="row">3</th>
      <td>Relationship with colleagues :</td>
      <td><input type="radio" id="" name="radio_3" value="Excelant"/></td>
      <td><input type="radio" id="" name="radio_3" value="Very good"/></td>
      <td><input type="radio" id="" name="radio_3" value="Good"/></td>
      <td><input type="radio" id="" name="radio_3" value="Acceptable"/></td>
    </tr>

    <tr class="item">
      <th scope="row">4</th>
      <td>Production Quantity :</td>
      <td><input type="radio" id="" name="radio_4" value="Excelant"/></td>
      <td><input type="radio" id="" name="radio_4" value="Very good"/></td>
      <td><input type="radio" id="" name="radio_4" value="Good"/></td>
      <td><input type="radio" id="" name="radio_4" value="Acceptable"/></td>
    </tr>

      <button type = "submit" id = "" name='submit' value="submit" class="btn btn-info">
             Export to Excel
      </button>

   </form>
  </tbody>
</table>

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
