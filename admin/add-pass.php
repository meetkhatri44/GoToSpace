<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


 $fname=$_POST['fullname'];
$cnum=$_POST['cnumber'];
$email=$_POST['email'];
$itype=$_POST['identitytype'];
$icnum=$_POST['icnum'];
$cat=$_POST['category'];
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];
$passnum=mt_rand(100000000, 999999999);
$sql="insert into tblpass(PassNumber,FullName,ContactNumber,Email,IdentityType,IdentityCardno,Category,FromDate,ToDate)values(:passnum,:fname,:cnum,:email,:itype,:icnum,:cat,:fdate,:tdate)";
$query=$dbh->prepare($sql);
$query->bindParam(':passnum',$passnum,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':cnum',$cnum,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':itype',$itype,PDO::PARAM_STR);
$query->bindParam(':icnum',$icnum,PDO::PARAM_STR);
$query->bindParam(':cat',$cat,PDO::PARAM_STR);
$query->bindParam(':fdate',$fdate,PDO::PARAM_STR);
$query->bindParam(':tdate',$tdate,PDO::PARAM_STR);

 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Member details has been added.")</script>';
echo "<script>window.location.href ='add-pass.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  

}
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>GoToWorkspace | Add Members</title>
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
                    <h1 class="page-header">Add Members</h1>
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
                                    <form method="post" enctype="multipart/form-data"> 
                                    
    <div class="form-group"> <label style="font-size: 18px; word-spacing: 5px;" for="exampleInputEmail1">Full Name</label> <input type="text" name="fullname" value="" class="form-control" required='true'> </div>
    <div class="form-group"> <label style="font-size: 18px; word-spacing: 5px;" for="exampleInputEmail1">Contact Number</label> <input type="text" name="cnumber" value="" class="form-control" required='true' maxlength="10" pattern="[0-9]+"> </div>
    <div class="form-group"> <label style="font-size: 18px; word-spacing: 5px;" for="exampleInputEmail1">Email Address</label> <input type="email" name="email" value="" class="form-control" required='true'> </div>
    <div class="form-group"> <label style="font-size: 18px; word-spacing: 5px;" for="exampleInputEmail1">Identity Type</label><select type="text" name="identitytype" value="" class="form-control" required='true'>
<option style="font-size: 18px; word-spacing: 5px;" value="">Choose Identity Type</option>
<option style="font-size: 18px; word-spacing: 5px;" value="Voter Card">Voter Card</option>
<option style="font-size: 18px; word-spacing: 5px;" value="PAN Card">PAN Card</option>
<option style="font-size: 18px; word-spacing: 5px;" value="Adhar Card">Adhar Card</option>
<option style="font-size: 18px; word-spacing: 5px;" value="Student Card">Student Card</option>
<option style="font-size: 18px; word-spacing: 5px;" value="Driving License">Driving License</option>
<option style="font-size: 18px; word-spacing: 5px;" value="Passport">Passport</option>
<option style="font-size: 18px; word-spacing: 5px;" value="Any Official Card">Any Official Card</option>
<option style="font-size: 18px; word-spacing: 5px;" value="Any Other Govt Issued Doc">Any Other Govt Issued Doc</option>
     </select></div>
    <div class="form-group"> <label style="font-size: 18px; word-spacing: 5px;" for="exampleInputEmail1">Identity Card No.</label> <input type="text" name="icnum" value="" class="form-control" required='true'> </div>
     <div class="form-group"> <label style="font-size: 18px; word-spacing: 5px;" for="exampleInputEmail1">Tasks</label><select type="text" name="category" value="" class="form-control" required='true'>
<?php 

$sql2 = "SELECT * from   tblcategory";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->CategoryName);?>"><?php echo htmlentities($row->CategoryName);?></option>
 <?php } ?>
     </select></div>
<div class="form-group"> <label style="font-size: 18px; word-spacing: 5px;" for="exampleInputEmail1">From Date</label> <input type="date" name="fromdate" value="" class="form-control" required='true'> </div>
<div class="form-group"> <label style="font-size: 18px; word-spacing: 5px;" for="exampleInputEmail1">To Date</label> <input type="date" name="todate" value="" class="form-control" required='true'> </div>

     <p style="padding-left: 450px"><button type="submit" class="btn btn-primary" name="submit" id="submit">Add</button></p> </form>
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