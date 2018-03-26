<?php
$title = "Sign Up";
$active_signup = "active_page";
require 'core/db_connect.php';
require 'core/validator.php';

require 'include/head.php';
require 'include/header.php';

if (isset($_POST['sign_up'])) {
    $fname = ucwords(trim($_POST['fname']));
    $lname = ucwords(trim($_POST['lname']));
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $phone = trim($_POST['phone']);
    $age = trim($_POST['age']);
    if (empty($_POST['terms'])){
        $terms = 0;
    }
    else{
        $terms = $_POST['terms'];
    }

    $error = validate_signup($fname, $lname, $email, $password, $phone, $age, $terms, $con);
    if ($error==null) {
        if ($_POST['terms'] == 'on') {
            $terms = 1;
        }
        $hpassword = password_hash("$password", PASSWORD_DEFAULT);
        $query = "INSERT INTO users (id, fname, lname, email, phone, password, age , terms, is_admin) VALUES ('', '$fname', '$lname', '$email', '$phone', '$hpassword', '$age', '$terms', '0')";
        $result = mysqli_query($con, $query) or exit("ERROR IN QUERY");
        if ($result){
            $msg = "<i class='fa fa-info-circle fa-fw'></i>Sucessfully registered new user.";
        }
    }
}

?>   
<div class="container" style="margin-top: 100px; margin-bottom: 50px;">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Sign Up</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if (isset($msg)) {
                        echo "<div class='alert alert-success'><a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" . $msg . "</div>";
                    }
                    ?>
                    <form role="form" action="" method="POST">
                        <fieldset>
                            <?php
                            if (isset($error['fname'])) {
                                echo "<div class='err-message'>" . $error['fname'] . "</div>";
                            } elseif (isset($error['num_fname'])) {
                                echo "<div class='err-message'>" . $error['num_fname'] . "</div>";
                            }
                            ?>
                            <div class="form-group">
                                <input class="form-control" placeholder="First Name" name="fname" type="text" autofocus value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : '' ?>">
                            </div>
                            <?php
                            if (isset($error['lname'])) {
                                echo "<div class='err-message'>" . $error['lname'] . "</div>";
                            } elseif (isset($error['num_lname'])) {
                                echo "<div class='err-message'>" . $error['num_lname'] . "</div>";
                            }
                            ?>
                            <div class="form-group">
                                <input class="form-control" placeholder="Last Name" name="lname" type="text" value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : '' ?>">
                            </div>
                            <?php
                            if (isset($error['email'])) {
                                echo "<div class='err-message'>" . $error['email'] . "</div>";
                            }
                            elseif (isset($error['email-validate-err'])) {
                                echo "<div class='err-message'>" . $error['email-validate-err'] . "</div>";
                            }
                            elseif (isset($error['email_exists'])) {
                                echo "<div class='err-message'>" . $error['email_exists'] . "</div>";
                            }
                            ?>
                            <span id="email_status"></span>
                            <div class="form-group">
                                <input id="email" onkeyup="checkemail();" class="form-control" placeholder="E-mail" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" />
                            </div>

                            <?php
                            if (isset($error['password'])) {
                                echo "<div class='err-message'>" . $error['password'] . "</div>";
                            }
                            elseif (isset($error['adj_password'])) {
                                echo "<div class='err-message'>" . $error['adj_password'] . "</div>";
                            }
                            ?>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password">
                            </div>
                            <?php
                            if (isset($error['phone_err'])) {
                                echo "<div class='err-message'>" . $error['phone_err'] . "</div>";
                            } elseif (isset($error['phone_alpha_err'])) {
                                echo "<div class='err-message'>" . $error['phone_alpha_err'] . "</div>";
                            }
                            ?>
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" placeholder="Phone Number"
                                    value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>">
                            </div>
                            <?php
                            if (isset($error['terms'])) {
                                echo "<div class='err-message'>" . $error['terms'] . "</div>";
                            }
                            ?>
                            <div class="checkbox">
                                <label>
                                    <input name="terms" type="checkbox">Yes, I agree to <a href="" style="">terms and conitions.</a>
                                </label>
                            </div>
                            <?php
                            if (isset($error['age'])) {
                                echo "<div class='err-message'>" . $error['age'] . "</div>";
                            }
                            ?>
                            <div class="form-group">
                                <p class="help-block text-xs">Choose your age.</p>
                                <select class="form-control" id="age" name="age">
                                </select>
                            </div>

                            <button name="sign_up" type="submit" class="btn btn-md btn-success btn-block validate">Sign Up</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require 'include/footer.php';
?>

<!-- JS -->
<script type="text/javascript">
    function checkemail(){
        var email=document.getElementById("email").value;
        if(email){
            $.ajax({
                type: 'post',
                url: 'core/check_email.php',
                data: {
                    user_email:email,
                },
                success: function (response) {
                    var testEmail = /^[ ]*([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})[ ]*$/i;
                    $('#email').bind('input propertychange', function() {
                        if (testEmail.test($(this).val())) {
                            $(this).css({ 'border':'1px solid green'});
                            $('button.validate').prop("disabled",false);
                        } else {
                            $(this).css({ 'border':'1px solid red'});
                            $('button.validate').prop("disabled",true);
                        }
                    });
                    $('#email_status').html(response);
                    if(response=="OK"){
                        return true;    
                    }
                    else{
                        return false;   
                    }
                }
            });
        }else
        {
            $('#email_status').html("");
            return false;
        }
    }
    checkemail();
</script>

<script type="text/javascript">
        var initAge = 16;
        var endAge = 99;
        var options = "";
        var a;
        for (a=initAge; a<=endAge; a++){
            options += "<option>" + a + "</option>"
        }
        document.getElementById("age").innerHTML = options;

</script>

<?php
require 'include/footer_js.php';
?>  
