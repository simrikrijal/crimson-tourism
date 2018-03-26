<?php

// This function validates the signup.


require 'db_connect.php';
include 'check_functions.php';

function validate_signup($fname, $lname, $email, $password, $phone, $age, $terms, $con){
    $error = array();
    if (empty($fname)) {
        $error['fname'] = "* Please provide your first name.";
    }
    if (!empty($fname) and (!ctype_alpha($fname))) {
        $error['num_fname'] = "* First name having numeric value is not valid.";
    }
    if (empty($lname)) {
        $error['lname'] = "* Please provide your last name.";
    }
    if (!empty($lname) and (!ctype_alpha($lname))) {
        $error['num_lname'] = "* Last name having numeric value is not valid.";
    }
    if (empty($email)) {
        $error['email'] = "* Please provide your email address.";
    }
    if (!empty($email) and (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $error['email-validate-err'] = "* Invalid email address.";
    }
    if (empty($password)) {
        $error['password'] = "* Please provide your password.";
    }
    if (empty($phone)) {
        $error['phone_err'] = "* Please provide your phone number.";
    }elseif (!is_numeric($phone)) {
        $error['phone_alpha_err'] = "* Phone number must be numeric.";
    }
    if (empty($age)) {
        $error['age'] = "* Please provide your age.";
    }
    if (empty($terms)) {
        $error['terms'] = "* You have not accepted the terms and conditions. Please go through it.";
    }

    if (!empty($password)) {
        if (!preg_match("/^(?=.*[\p{Ll}])(?=.*[\p{Lu}])(?=.*\d)(?=.*[$@$!%*?&#])[\p{Ll}‌​\p{Lu}\d$@$!%*?&]{3,10}/", $_POST['password'])) {
            $error['adj_password'] = "* Password must contain at least 1 capital letter, a number and a symbol with at least 3 letters.";
        }
    }
    if (!empty($email)) {
        $check_email = check_email_exists($con, $email);
        if ($check_email == 0) {
            $error['email_exists'] = "* This email already exists in the database.";
        }
    }

    return $error;
}


?>