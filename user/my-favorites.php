<?php
include '../core/init.php';
include '../core/db_connect.php';
include '../core/check_functions.php';

user_sessions();
$title = "My Favorites";
$my_favroites = "li-active";
$user_id = $_SESSION['id'];
require '../include/usr/head.php';
require '../include/usr/header.php';
require '../include/usr/sidebar.php';

$query = "SELECT * FROM favorites WHERE user_id=$user_id";
$result = mysqli_query($con, $query) or exit("ERROR IN QUERY.");
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
                    <li class="active"><a href="#"><i class="fa fa-dashboard fa-fw"></i> My Favorites</a></li>
                </ol>
                <div class="panel panel-body">
                    <div class="panel-heading">
                        <h4>My Favorites</h4>
                        <hr>
                    </div>
        <div class="panel-body">
            <?php
            if (mysqli_num_rows($result) > 0){
                ?>
                <table class="table table-striped table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <td>Destination ID</td>
                            <td>Destination Category</td>
                            <td>Destination Name</td>
                            <td class="text-center">Address</td>
                            <td>Description</td>    
                            <td>Price</td>    
                            <td>Image</td>    
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row=mysqli_fetch_assoc($result)) {
                            $dest = get_destination($con, $row['destination_id']);
                            ?>
                            <tr>
                                <td><?php echo $dest['id'];?> </td>
                                <td><?php echo $dest['category'];?></td>
                                <td>
                                    <a style="font-weight: bold; color: #1976D2;">
                                        <?php
                                        echo $dest['name'];
                                        ?>
                                    </a>
                                </td>
                                <td><?php echo $dest['address'];?></td>
                                <td><?php echo $dest['description'];?></td>
                                <td><?php echo $dest['price'];?></td>
                                <td class="text-center">
                                <a href="<?php echo "../uploads/" . $dest['image']; ?>" data-lightbox="<?php echo $dest['formatted_address'];?>" data-title="<?php echo $dest['name']; ?>">
                                    <img style="height: 80px; width: 100px;" src="<?php echo "../uploads/" . $dest['image']; ?>">
                                </a>
                                    
                                </td>
                            </tr>
                            <?php 
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            }
            else{
                echo "<tr>
                <td colspan='8'>
                    <div class='text-center m-xs'>
                    <div class='alert alert-warning'>
                    <i class='fa fa-info-circle fa-fw'></i> You don't have any favorites.
                    </div>
                    </div>
                    <td>
                    </tr>";
                }
                ?>
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

<?php
require '../include/adm/footer_js.php';
?>
