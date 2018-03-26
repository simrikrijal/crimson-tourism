<?php

// This check_functions checks the user sessions for login purposes.
function check_sessions(){
    if (!empty($_SESSION['user'])) {
        header('Location:user/dashboard.php');
    }
    elseif (!empty($_SESSION['admin'])) {
        header('Location:admin/dashboard.php');
    }
}

function admin_sessions(){
    if (!empty($_SESSION['admin'])){
    }
    else{
        header('Location:../login.php');
    }
}

function user_sessions(){
    if (!empty($_SESSION['user'])){
    }
    else{
        header('Location:../login.php');
    }
}

function get_destination(mysqli $con, $id){
    $query = "SELECT * FROM destination WHERE id=$id";
    $result = mysqli_query($con, $query) or exit("Error in query.");
    $dest = mysqli_fetch_assoc($result);
    return $dest;
}

function check_email_exists(mysqli $con, $email){
    $query = "SELECT * FROM users";
    $result = mysqli_query($con, $query) or exit("Error in query.");
    $value = 1;
    $row_num = mysqli_num_rows($result);
    if ($row_num > 0) {
            while ($row=mysqli_fetch_assoc($result)) {
            if ($email==$row['email'] and ($row['is_admin']==1 || $row['is_admin']==0)) {
                $value = 0; // Throws error if email already exists.
            }
            else{
                $value = 1; // New user is created.
            }
        }
    }
    return $value;
}

?>