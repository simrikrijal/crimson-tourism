<?php
include '../core/init.php';
include '../core/db_connect.php';
include '../core/check_functions.php';

if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
}
user_sessions();
$user_id = $_SESSION['id'];
$title = "Dashboard";
$dashboard_user = "li-active";
require '../include/usr/head.php';
require '../include/usr/header.php';
require '../include/usr/sidebar.php';


$query = "SELECT * FROM destination";
$result = mysqli_query($con, $query) or exit("ERROR IN QUERY.");


$query2 = "SELECT * FROM favorites WHERE user_id=$user_id";
$check_fav = mysqli_query($con, $query2) or exit("Error in query.");
$fav = mysqli_fetch_assoc($check_fav);

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
                        <h4>User Dashboard</h4>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <?php
                        if (isset($msg)) {
                            ?>
                            <div class="alert alert-success">
                                <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                <i class='fa fa-info-circle fa-fw'></i>
                                <?php
                                echo $msg;
                            }
                            ?>
                        </div>
                        <?php
                        if (mysqli_num_rows($result) > 0){
                            ?>
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="myTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Destination Category</th>
                                        <th>Destination Name</th>
                                        <th width="300px">Address</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th class="text-center"><i class="fa fa-cog fa-spin"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row=mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['category']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo "Nrs." . $row['price']; ?></td>
                                            <td><?php echo $row['description']; ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo "../uploads/" . $row['image']; ?>" data-lightbox="<?php echo $row['name'];?>" data-title="<?php echo $row['address']; ?>">
                                                    <img style="height: 80px; width: 100px;" src="<?php echo "../uploads/" . $row['image']; ?>">
                                                </a>
                                            </td>
                                            <td class="text-center" style="vertical-align: center;">
                                            <?php
                                            if ($row['id']!=$fav['destination_id']) {
                                                ?>
                                            <a href="mark_favorite.php?did=<?php echo $row['id']; ?>" data-toggle="tooltip" title="Favorite this destination.">
                                            <button class="btn btn-default">
                                                <i class="fa fa-star" style="color: #FDD544;"></i>
                                            </button>
                                            </a>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <a href="remove_favorite.php?did=<?php echo $row['id']; ?>" data-toggle="tooltip" title="Remove this from favorites.">
                                            <button class="btn btn-default">
                                                <i class="fa fa-ban" style="color: red;"></i>
                                            </button>
                                            </a>
                                                <?php
                                                }
                                            ?>
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
                            echo "<div class='text-center m-xs'>
                            <h4 class='text-muted' style='padding: 20px 0px;'>No data found.</h4>
                            <hr>
                            <i class='fa fa-cogs text-xmuted' style='font-size: 15em; margin: 30px; padding: 0px;'></i>
                        </div>";
                    }
                    ?>
                    </div>
                </div>
                <!-- <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a> -->
            </div>
        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->

<?php
require '../include/usr/footer.php';
require '../include/usr/footer_js.php';
?>
