<?php
require '../core/init.php';
require '../core/db_connect.php';
require '../core/check_functions.php';
user_sessions();

$user_id = $_SESSION['id'];
$did = $_GET['did'];
$query = "INSERT INTO favorites (id, user_id, destination_id) VALUES ('', '$user_id', '$did')";
$result = mysqli_query($con, $query) or exit(mysqli_error($con));
if (mysqli_affected_rows($con) > 0) {
    $_SESSION['msg'] = "Successfully saved as your favorite destination!";
    header('Location:dashboard.php');
    exit();
}
else{
    echo "Error while redirecting.";
}
?>