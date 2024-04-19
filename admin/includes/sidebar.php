<?php

error_reporting(0);

include('includes/dbconnection.php');
?>
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div  style="background-color: #04B173" class="user-section">
                            
                            <div class="user-section-inner">
                                <img src="assets/img/user.jpg" alt="">
                            </div>
                            <div class="user-info">
                                <?php
$aid=$_SESSION['cpmsaid'];
$sql="SELECT AdminName from  tbladmin where ID=:aid";
$query = $dbh -> prepare($sql);
$query->bindParam(':aid',$aid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                <div><strong><?php  echo $row->AdminName;?></strong></div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                            <?php $cnt=$cnt+1;}} ?>
                        </div>
                        
                        <!--end user image section-->
                    </li>

                    <li style="font-size: 18px; word-spacing: 5px; background-color: #04B173 " class="selected">
                        <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                    </li>
                    <li style="font-size: 18px; word-spacing: 5px; background-color: #04B173">
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Tasks<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add-category.php">Add Task</a>
                            </li>
                            <li>
                                <a href="manage-category.php">Manage Tasks</a>
                            </li>
                        </ul>
                        <!-- second-level-items -->
                    </li>
                    <li style="font-size: 18px; word-spacing: 5px; background-color: #04B173">
                        <a href="#"><i class="fa fa-files-o fa-fw"> </i>Members<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add-pass.php">Add Member</a>
                            </li>
                            <li>
                                <a href="manage-pass.php">Manage Members</a>
                            </li>
                        </ul>
                        <!-- second-level-items -->
                    </li>
                    
                    
                    <li style="font-size: 18px; word-spacing: 5px; background-color: #04B173">
                        <a href="search-pass.php"><i class="fa fa-search"></i>  Search<span class="fa arrow"></span></a>
                        
                        </li>
                        <li>
                        <a style="font-size: 18px; word-spacing: 5px; background-color: #04B173" href="pass-bwdates-report.php"><i class="fa fa-folder"></i>  Report of Member<span class="fa arrow"></span></a>
                        
                        </li>
                      

                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>