<?php
ob_start();
include '../core/init.php';
include '../core/db_connect.php';
include '../core/check_functions.php';
admin_sessions();

$title = "Update Destination";
$view_destination = "li-active";
$id = $_GET['id'];
$err=array();
$query = "SELECT * FROM destination WHERE id=$id";
$result = mysqli_query($con, $query) or exit(mysqli_error($con));
$row = mysqli_fetch_assoc($result);

require '../include/adm/head.php';
require '../include/adm/header.php';
require '../include/adm/sidebar.php';

$err = array();
$flag = 1;
if (isset($_POST['submit'])) {
    if (empty($_POST['name'])) {
        $err['title'] = '* This field is required field.';
    }
    if (empty($_POST['address'])) {
        $err['address'] = '* This field is required field.';
    }
    if (empty($_POST['description'])) {
        $err['description'] = '* This field is required field.';
    }
    if (empty($_POST['price'])) {
        $err['price'] = '* This field is required field.';
    }elseif (!is_numeric($_POST['price'])) {
        $err['price_err'] = "* Price must be numeric.";
    }
    elseif($err==null){
        $title = ucwords(trim($_POST['name']));
        $address = trim($_POST['address']);
        $price = trim($_POST['price']);
        $description = trim($_POST['description']);

        $update_query = "UPDATE destination 
        SET name='$title', address='$address', description='$description', 
        price='$price' WHERE id=$id";
        $update_result = mysqli_query($con, $update_query) or exit(mysqli_error($con));
        if ($update_result) {
         if (mysqli_affected_rows($con) > 0) {
            $_SESSION['msg'] = "Destination updated successfully!";
            header('Location:list_destination.php');
            exit();
        }
        else{
            echo "Error while redirecting.";
        }
    }
}
}
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
                    <li class="active"><a href="#"><i class="fa fa-dashboard fa-fw"></i> Update Destination</a></li>
                </ol>
                <div class="panel panel-body">
                    <div class="panel-heading">
                        <h4>Update Destination</h4>
                        <small class="text-muted">Fill up the form below to update your destination.</small>
                        <hr class="m-b-xs">
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <?php
                                        if (isset($err['duplicate_title'])) {
                                            echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" . "<i class='fa fa-info-circle fa-fw'></i>" . $err['duplicate_title'] . "</div>";
                                        }
                                        ?>
                                        <label>Destination Name</label>
                                        <input type="text" name='name' class="form-control" placeholder="Enter Destination Name" value="<?php echo $row['name']; ?>">
                                        <div style="color: red; margin: 10px 0px;">
                                            <?php 
                                            if (isset($err['name'])) {
                                                echo $err['name'];
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input name="address" id="geocomplete" type="text" class="form-control" id="address" placeholder="Enter Location" value="<?php echo $row['address']; ?>">
                                        <div style="color: red; margin: 10px 0px;">
                                            <?php 
                                            if (isset($err['address'])) {
                                                echo $err['address'];
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input name="price" type="text" class="form-control" placeholder="Enter cost price for the destination" value="<?php echo $row['price']; ?>">
                                        <div style="color: red; margin: 10px 0px;">
                                            <?php 
                                            if (isset($err['price'])) {
                                                echo $err['price'];
                                            }elseif (isset($err['price_err'])) {
                                                echo $err['price_err'];
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea placeholder="Enter description of the destination" name="description" class="form-control" rows="6"><?php echo $row['description']; ?></textarea>
                                        <div style="color: red; margin: 10px 0px;">
                                            <?php 
                                            if (isset($err['description'])) {
                                                echo $err['description'];
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button name='submit' type="submit" class="btn btn-primary">Save</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </div>
                                </form>
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
