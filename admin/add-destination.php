<?php
ob_start();
include '../core/init.php';
include '../core/db_connect.php';
include '../core/check_functions.php';
admin_sessions();

$title = "Add Destination";
$add_destination = "li-active";
require '../include/adm/head.php';
require '../include/adm/header.php';
require '../include/adm/sidebar.php';

$err = array();
$flag = 1;
if (isset($_POST['submit'])) {
    if (empty($_POST['category'])) {
        $err['category'] = '* This field is required field.';
    }
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
    if (empty($_FILES['image']["name"])) {
        $err['image'] = '* This field is required field.';
    }
    elseif($err==null){
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            } else {
                $err['fail'] = "Sorry, there was an error uploading your file.";
            }
        } else {
            $err['na_image'] = "File is not an image.";
            $uploadOk = 0;
        }
        $category = ucwords(trim($_POST['category']));
        $title = ucwords(trim($_POST['name']));
        $address = trim($_POST['address']);
        $price = trim($_POST['price']);
        $description = trim($_POST['description']);
        $image = $_FILES['image']['name'];

        $check = "SELECT * FROM destination";
        $check_destination = mysqli_query($con, $check) or exit("Error in query.");
        while ($row=mysqli_fetch_assoc($check_destination)) {
            if (strcasecmp($title, $row['name']) == 0) {
                $err['duplicate_title'] = " Duplicate destination name. '" . $title . "' already exists in database.";
                $flag = 0;
                break;
            }
            else{
                $flag = 1;
            }
        }
        if ($flag!=0) {
            $insert_query = "INSERT INTO destination (id, category, name, address, price, description, image) 
            VALUES ('', '$category','$title', '$address', '$price', '$description', '$image')";
            $result = mysqli_query($con, $insert_query) or exit(mysqli_error($con));
            if ($result) {
                if (mysqli_affected_rows($con) > 0) {
                    $_SESSION['msg'] = "Destination added successfully!";
                    header('Location:list_destination.php');
                    exit();
                }
                else{
                    echo "Error while redirecting.";
                }
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
                    <li class="active"><a href="#"><i class="fa fa-dashboard fa-fw"></i> Add Destination</a></li>
                </ol>
                <div class="panel panel-body">
                    <div class="panel-heading">
                        <h4>Add Destination</h4>
                        <small class="text-muted">Fill up the form below to add the destination.</small>
                        <hr class="m-b-xs">
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Destination Category</label>
                                        <input name="category" id="" type="text" class="form-control" placeholder="Enter Category" value="<?php echo isset($_POST['category']) ? $_POST['category'] : '' ?>">
                                        <div style="color: red; margin: 10px 0px;">
                                            <?php 
                                            if (isset($err['category'])) {
                                                echo $err['category'];
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        if (isset($err['duplicate_title'])) {
                                            echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" . "<i class='fa fa-info-circle fa-fw'></i>" . $err['duplicate_title'] . "</div>";
                                        }
                                        ?>
                                        <label>Destination Name</label>
                                        <input type="text" name='name' class="form-control" placeholder="Enter Destination Name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
                                        <div style="color: red; margin: 10px 0px;">
                                            <?php 
                                            if (isset($err['title'])) {
                                                echo $err['title'];
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input name="address" id="geocomplete" type="text" class="form-control" id="address" placeholder="Enter Location" value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>">
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
                                        <input name="price" type="text" class="form-control" placeholder="Enter cost price for the destination" value="<?php echo isset($_POST['price']) ? $_POST['price'] : '' ?>">
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
                                        <textarea placeholder="Enter description of the destination" name="description" class="form-control" rows="6"><?php echo isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>
                                        <div style="color: red; margin: 10px 0px;">
                                            <?php 
                                            if (isset($err['description'])) {
                                                echo $err['description'];
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input name="image" type="file" class="form-control-file" id="image">
                                        <small id="fileHelp" class="form-text text-muted">Upload image of destination.</small>
                                        <div style="color: red; margin: 10px 0px;">
                                            <?php 
                                            if (isset($err['image'])) {
                                                echo $err['image'];
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
