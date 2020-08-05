<?php
include_once 'API_functions.php';

//check if $_POST contains user
if (isset($_POST["user"])) {
    //get information
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    $role = getRole($user, $pass);
    $_SESSION["name"] = getName($user, $pass);
    if($role == "Parent"){
        echo "P";
    } elseif ($role == "Child") {
        echo "C";
    }
}