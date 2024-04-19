<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $adminid=$_SESSION['cpmsaid'];
    $AName=$_POST['adminname'];
  $mobno=$_POST['mobilenumber'];
  $email=$_POST['email'];
  $sql="update tbladmin set AdminName=:adminname,MobileNumber=:mobilenumber,Email=:email where ID=:aid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':adminname',$AName,PDO::PARAM_STR);
     $query->bindParam(':email',$email,PDO::PARAM_STR);
     $query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
     $query->bindParam(':aid',$adminid,PDO::PARAM_STR);
$query->execute();
  echo '<script>alert("Profile has been updated.")</script>';
     
    
  }
  ?>
<!DOCTYPE html>
<html>

<head>
    
    <title>GoToWorkspace | Admin Profile</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />



</head>

<body>
    <!--  wrapper -->
    <div style="background-color: rgb(144, 236, 192)" id="wrapper">
        <!-- navbar top -->
      <?php include_once('includes/header.php');?>
        <!-- end navbar top -->

        <!-- navbar side -->
        <?php include_once('includes/sidebar.php');?>
        <!-- end navbar side -->
        <!--  page-wrapper -->
          <div style="min-height: 2000px; background-color: rgb(173 183 178)" id="page-wrapper">
            <div class="row">
                 <!-- page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Admin Profile</h1>
                </div>
                <!--end page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                       
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post"> 
                                    <?php

$sql="SELECT * from  tbladmin";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
    <div class="form-group"> <label style="font-size: 18px; word-spacing: 5px;" for="exampleInputEmail1">Admin Name</label> <input type="text" name="adminname" value="<?php  echo $row->AdminName;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label style="font-size: 18px; word-spacing: 5px;" for="exampleInputEmail1">User Name</label> <input type="text" name="username" value="<?php  echo $row->UserName;?>" class="form-control" readonly=""> </div>
    <div class="form-group"> <label style="font-size: 18px; word-spacing: 5px;" for="exampleInputEmail1">Contact Number</label><input type="text" name="mobilenumber" value="<?php  echo $row->MobileNumber;?>"  class="form-control" maxlength='10' required='true' pattern="[0-9]+"> </div>
    <div class="form-group"> <label style="font-size: 18px; word-spacing: 5px;" for="exampleInputEmail1">Email address</label> <input type="email" name="email" value="<?php  echo $row->Email;?>" class="form-control" required='true'> </div> 
    <div class="form-group"> <label style="font-size: 18px; word-spacing: 5px;" for="exampleInputPassword1">Admin Registration Date</label> <input type="text" name="" value="<?php  echo $row->AdminRegdate;?>" readonly="" class="form-control"> </div><?php $cnt=$cnt+1;}} ?> 
     <p style="padding-left: 450px"><button type="submit" class="btn btn-primary" name="submit" id="submit">Update</button></p> </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>

    <footer style="color: white;font-size: 24px; padding: 20px; background-color: #04B173;" class="footer-area section-gap">
        <div class="container">
          
            <div class="footer-bottom row align-items-center text-center text-lg-left">
                <p class="footer-text m-0 col-lg-8 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <i class="ti-heart" aria-hidden="true"></i> by <a style="color: blue;" href="" target="_blank">GoToWorkspace</a>
</p>
            </div>
        </div>
    </footer>

</body>

</html>
<?php }  ?>