<?php
include '../core/init.php';
include '../core/db_connect.php';
include '../core/check_functions.php';
admin_sessions();

$query = "SELECT COUNT(id) as count FROM destination";
$result = mysqli_query($con, $query) or exit("Error in query.");
$dest = mysqli_fetch_assoc($result);


$query = "SELECT COUNT(id) as count FROM favorites";
$result = mysqli_query($con, $query) or exit("Error in query.");
$fav = mysqli_fetch_assoc($result);


$title = "Dashboard";
$dashboard_active = "li-active";
require '../include/adm/head.php';
require '../include/adm/header.php';
require '../include/adm/sidebar.php';
?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 no-padding">
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home fa-fw"></i> Home</a>
                    </li>
                    <li class="active"><a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
                </ol>
                <div class="panel panel-body">
                    <div class="panel-heading">
                        <h4>Dashboard</h4>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-6 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <i class="fa fa-map-signs fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><h1><?php echo $dest['count'];  ?></h1></div>
                                            <div><h2>Total Destinations<h2></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <i class="fa fa-star fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><h1><?php echo $fav['count'];  ?></h1></div>
                                            <div><h2>Total Favorites<h2></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a> -->
            </div>
        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->

<?php
require '../include/adm/footer.php';
?>
