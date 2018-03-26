<?php
include 'db_connect.php';
// Checks for the instantaneous feedback for the availability of email for an user.
if(isset($_POST['user_email'])){
    $email=$_POST['user_email'];
    $checkdata=" SELECT email FROM users WHERE email='$email' ";
    $query=mysqli_query($con, $checkdata) or exit("Error in query!");
    if(mysqli_num_rows($query) > 0){
        echo "<i class='fa fa-times-circle fa-fw red-times'></i><small>Email not available.</small>";
    } else{
        echo "<i class='fa fa-check-circle fa-fw green-check'></i><small>Available.</small>";
    }
    exit();
}
?>