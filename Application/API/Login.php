<?php
include_once 'API_functions.php';
session_start();
//check if $_POST contains user
if (isset($_POST["user"])) {
    //get information
    $_SESSION['user'] = $_POST["user"];
    $_SESSION['pass'] = $_POST["pass"];

    $role = getRole($_SESSION['user'], $_SESSION['pass']);
    $_SESSION['name'] = getName($_SESSION['user'], $_SESSION['pass']);
    getAll($_SESSION['user'], $_SESSION['pass']);

    if($role == "Parent"){
       echo "P";
    } elseif ($role == "Child") {
       echo "C";
    }
}