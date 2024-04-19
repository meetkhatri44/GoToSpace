<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {

$mpmsaid=$_SESSION['cpmsaid'];
 $catname=$_POST['catname'];
$ret="select CategoryName from tblcategory where CategoryName=:catname";
 $query= $dbh -> prepare($ret);
$query->bindParam(':catname',$catname,PDO::PARAM_STR);

$query-> execute();
     $results = $query -> fetchAll(PDO::FETCH_OBJ);
     if($query -> rowCount() == 0)
{
$sql="insert into tblcategory(CategoryName)values(:catname)";
$query=$dbh->prepare($sql);
$query->bindParam(':catname',$catname,PDO::PARAM_STR);

 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Task has been added.")</script>';
echo "<script>window.location.href ='add-category.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}

else
{

echo "<script>alert('Category Name Already Exist. Please try again');</script>";
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
    <div style="background-color: rgb(144, 236, 192)"  id="wrapper">
        <!-- navbar top -->
      <?php include_once('includes/header.php');?>
        <!-- end navbar top -->

        <!-- navbar side -->
        <?php include_once('includes/sidebar.php');?>
        <!-- end navbar side -->
        <!--  page-wrapper -->
          <div style="min-height: 2000px; background-color: rgb(173 183 178)"  id="page-wrapper">
            <div class="row">
                 <!-- page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Add Tasks</h1>
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
                                    
    <div class="form-group"> <label style="font-size: 18px; word-spacing: 5px;" for="exampleInputEmail1">Tasks Name</label> <input type="text" name="catname" value="" class="form-control" required='true'> </div>
   
     
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