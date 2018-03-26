<?php
include_once 'core/init.php';
include_once 'core/db_connect.php';
include_once 'core/check_functions.php';
check_sessions();
$error = array();
if (isset($_POST['login'])) {
    if (empty($_POST['email'])) {
        $error['email'] = "* Please provide your email.";
    }
    if (empty($_POST['password'])) {
        $error['password'] = "* Please provide your password.";
    }
    else{
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($con, $query) or exit("Error in query!");
        $row=mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0){
            $is_valid = password_verify($password, $row['password']);
            if ($is_valid != 1){
                $errmsg['invalid'] = "<i class='fa fa-info-circle fa-fw'></i>Email might not be registered or invalid password.";
            }
            else if($is_valid == 1 and $row['is_admin'] == 1){
                $_SESSION['admin']=$row['fname'];
                $_SESSION['id']=$row['id'];
                header('Location:admin/dashboard.php');
            }
            else if($is_valid == 1 and $row['is_admin'] == 0){
                $_SESSION['user']=$row['fname'];
                $_SESSION['id']=$row['id'];
                header('Location:user/dashboard.php');
            }
        }
        else{
            $errmsg['invalid'] = "<i class='fa fa-info-circle fa-fw'></i>Email might not be registered or invalid password.";
        }
    }
}
$title = "Login";
$active_login = "active_page";
require 'include/head.php';
require 'include/header.php';
?>   
<div class="container" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Log In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST">
                        <?php
                        if (isset($errmsg['invalid'])) {
                            echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" . $errmsg['invalid'] . "</div>";
                        }
                        ?>
                        <fieldset>
                            <?php
                            if (isset($error['email'])) {
                                echo "<div class='err-message'>" . $error['email'] . "</div>";
                            }
                            ?>
                            <div class="form-group">
                                <input id="email" class="form-control" placeholder="E-mail" name="email" type="email" autofocus=""
                                value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                            </div>
                            <?php
                            if (isset($error['password'])) {
                                echo "<div class='err-message'>" . $error['password'] . "</div>";
                            }
                            ?>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <button type="submit" name="login" class="btn btn-md btn-success btn-block validate">Login</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2>New on Crimson Tourism?</h2>
            </div>
            <div class="col-lg-6">
                <ul class="list-inline banner-social-buttons">
                    <li>
                        <a href="sign-up.php" class="btn btn-success btn-lg"><i class="fa fa-map-signs fa-fw"></i> <span class="network-name">Sign Up Now</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
require 'include/footer.php';
?>

<?php
require 'include/footer_js.php';
?>  
