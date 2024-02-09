<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cpmsaid']==0)) {
  header('location:logout.php');
  } else{
    
  ?>
<!DOCTYPE html>
<html>

<head>
    
    <title>GoToWorkSpace | Dashboard</title>
    <!-- Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />


</head>

<body>
    <div id="wrapper">
      <?php include_once('includes/header.php');?>

          <div id="page-wrapper">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>

            <div class="row">
                <div class="col-lg-4">
                     
                    <div class="alert alert-danger text-center">
                        <?php 
$sql ="SELECT ID from tblcategory ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalcat=$query->rowCount();
?><div class="panel-body red">
                        <i class="fa fa-calendar fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;<b style= "color:black; font-size: larger;"> </b><a style= "color:black; font-size: larger;" href="">Total Tasks</a> 
</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    
                    <div class="alert alert-success text-center">
                        <?php 
$sql ="SELECT ID from tblpass";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalpass=$query->rowCount();
?><div class="panel-body yellow">
                        <i class="fa fa-beer fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style= "color:black; font-size: larger;"></b><a style= "color:black; font-size: larger;" href=""> Total team member</a>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="alert alert-info text-center">
 <?php 
//todays task Generated
 

$sql ="SELECT ID from tblpass where date(PasscreationDate)=CURDATE()";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$today_pass=$query->rowCount();
?>
 <div class="panel-body red">
                        <i class="fa fa-pencil-square-o fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style= "color:black; font-size: larger;"></b> <a style= "color:black; font-size: larger;" href="">Task added Today</a>
</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="alert alert-warning text-center">
                       <?php 
//Yesterday task Generated
 

$sql ="SELECT ID from tblpass where date(PasscreationDate)=CURDATE()-1";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$yes_pass=$query->rowCount();
?><div class="panel-body yellow">
                        <i class="fa  fa-pencil fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style= "color:black; font-size: larger;"></b> <a style= "color:black; font-size: larger;" href="">Task added Yesterday </a>
                    </div>
                    </div>
                </div>
                  <div class="col-lg-4">
                    <div class="alert alert-info text-center">
                       <?php 
//7 days task Generated
 

$sql ="SELECT ID from tblpass where date(PasscreationDate)>=(DATE(NOW()) - INTERVAL 7 DAY)";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$seven_pass=$query->rowCount();
?><div class="panel-body green">
                        <i class="fa  fa-pencil fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style= "color:black; font-size: larger;"></b> <a style= "color:black; font-size: larger;" href="">Task added in Seven Days</a>
</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>

</body>

</html>
<?php }  ?>