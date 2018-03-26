<?php
require '../core/init.php';
require '../core/db_connect.php';
require '../core/check_functions.php';
user_sessions();

$user_id = $_SESSION['id'];
$did = $_GET['did'];
$query = "DELETE FROM favorites WHERE destination_id=$did and user_id=$user_id";
$result = mysqli_query($con, $query) or exit("Error in query.");
if (mysqli_affected_rows($con) > 0) {
    $_SESSION['msg'] = "Successfully removed from your favorite destination!";
    header('Location:dashboard.php');
    exit();
}
else{
    echo "Error while redirecting.";
}
?>