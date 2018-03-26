<?php
require '../core/init.php';
require '../core/db_connect.php';
require '../core/check_functions.php';
admin_sessions();

$id = $_GET['id'];
$query = "DELETE FROM destination WHERE id=$id";
$result = mysqli_query($con, $query) or exit(mysqli_error($con));
if (mysqli_affected_rows($con) > 0) {
    $_SESSION['msg'] = "Destination deleted successfully!";
    header('Location:list_destination.php');
    exit();
}
else{
    echo "Error while redirecting.";
}

?>