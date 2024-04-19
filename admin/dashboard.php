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
    
    <title>GoToWorkspace | Dashboard</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link rel="icon" href="logo.png" type="image/png">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

    <!-- Responsive CSS -->
    <style>
        /* Styles for mobile */
        @media only screen and (max-width: 767px) {
            /* Add styles for mobile here */
            /* Hide the sidebar */
            #wrapper #sidebar {
                display: none;
            }

            /* Add styles for hamburger icon */
            #wrapper #sidebar-wrapper {
                display: none;
            }

            #wrapper .toggle-btn {
                display: block;
                cursor: pointer;
                position: fixed;
                top: 10px;
                left: 10px;
                z-index: 999;
            }

            #wrapper .toggle-btn .bar {
                width: 25px;
                height: 3px;
                background-color: #333;
                margin: 5px auto;
                transition: all 0.3s ease-in-out;
            }

            #wrapper .toggle-btn .bar:first-child {
                margin-top: 0;
            }

            #wrapper .toggle-btn.active .bar:nth-child(2) {
                opacity: 0;
            }

            #wrapper .toggle-btn.active .bar:first-child {
                transform: translateY(8px) rotate(45deg);
            }

            #wrapper .toggle-btn.active .bar:last-child {
                transform: translateY(-8px) rotate(-45deg);
            }
        }
    </style>

</head>

<body>
    <!--  wrapper -->
    <div style="background-color: rgb(144, 236, 192)" id="wrapper">
        <!-- navbar top -->
      <?php include_once('includes/header.php');?>
        <!-- end navbar top -->

        <!-- navbar side -->
        <div id="sidebar-wrapper">
            <?php include_once('includes/sidebar.php');?>
        </div>
        <!-- end navbar side -->

        <!-- Hamburger Icon -->
        <div class="toggle-btn" onclick="toggleSidebar()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>

        <!--  page-wrapper -->
          <div style="min-height: 2000px; background-color: rgb(173 183 178)" id="page-wrapper">
            <div class="row">
                 <!-- page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!--end page header -->
            </div>

            <div class="row">
                <!--quick info section -->
                <div class="col-lg-4">
                     
                    <div style="color: black; background-color: white;" class="alert alert-danger text-center">
                        <?php 
$sql ="SELECT ID from tblcategory ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalcat=$query->rowCount();
?><div style="background-color: rgb(144, 236, 192)" class="panel-body red">
                        <i class="fa fa-calendar fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: large ; color: black; font-weight: bold;"><?php echo htmlentities($totalcat);?> </b><a style="font-size: large ; color: black; font-weight: bold;" href="manage-category.php">Total Tasks</a> 
</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    
                    <div style="color: black; background-color: white;" class="alert alert-success text-center">
                        <?php 
$sql ="SELECT ID from tblpass";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalpass=$query->rowCount();
?><div style="background-color: rgb(144, 236, 192)" class="panel-body yellow">
                        <i class="fa  fa-beer fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: large ; color: black; font-weight: bold;"><?php echo htmlentities($totalpass);?></b><a style="font-size: large ; color: black; font-weight: bold;" href="manage-pass.php"> Total Members</a>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div style="color: black; background-color: white;" class="alert alert-info text-center">
 <?php 
//todays Pass Generated
 

$sql ="SELECT ID from tblpass where date(PasscreationDate)=CURDATE()";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$today_pass=$query->rowCount();
?>
 <div style="background-color: rgb(144, 236, 192)" class="panel-body red">
                        <i class="fa fa-pencil-square-o fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: large ; color: black; font-weight: bold;"><?php echo htmlentities($today_pass);?></b> <a style="font-size: large ; color: black; font-weight: bold;" href="todays-pass.php">Members added Today</a>
</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div style="color: black; background-color: white;" class="alert alert-warning text-center">
                       <?php 
//Yesterday Pass Generated
 

$sql ="SELECT ID from tblpass where date(PasscreationDate)=CURDATE()-1";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$yes_pass=$query->rowCount();
?><div style="background-color: rgb(144, 236, 192)" class="panel-body yellow">
                        <i class="fa  fa-pencil fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: large ; color: black; font-weight: bold;"><?php echo htmlentities($yes_pass);?></b> <a style="font-size: large ; color: black; font-weight: bold;" href="yesterdays-pass.php">Members added Yesterday </a>
                    </div>
                    </div>
                </div>
                  <div class="col-lg-4">
                    <div style="color: black; background-color: white;" class="alert alert-info text-center">
                       <?php 
//7 days Pass Generated
 

$sql ="SELECT ID from tblpass where date(PasscreationDate)>=(DATE(NOW()) - INTERVAL 7 DAY)";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$seven_pass=$query->rowCount();
?><div style="background-color: rgb(144, 236, 192)" class="panel-body green">
                        <i class="fa  fa-pencil fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: large ; color: black; font-weight: bold;"><?php echo htmlentities($seven_pass);?></b> <a style="font-size: large ; color: black; font-weight: bold;" href="last-7days-pass.php">Members added in Seven Days</a>
</div>
                    </div>
                </div>
                <!--end quick info section -->
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

    <!-- JavaScript for toggling sidebar -->
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar-wrapper');
            sidebar.style.display = (sidebar.style.display === 'none' || sidebar.style.display === '') ? 'block' : 'none';

            var toggleBtn = document.querySelector('.toggle-btn');
            toggleBtn.classList.toggle('active');
        }
    </script>
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
