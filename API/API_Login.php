<?php
include_once 'API_functions.php';
function sendlogin(){
    //check that $_SESSION contains 'user'
    if (isset($_GET["user"])) {
        //save them username and password into a local variable
        $_SESSION["user"] = $_GET["user"];
        $_SESSION["pass"] = $_GET["pass"];

        $role = getRole($_SESSION["user"], $_SESSION["pass"]);

        if($role == "Parent"){
            $name = getName($_SESSION["user"], $_SESSION["pass"]);
            $_SESSION["name"] = $name;
            $_SESSION["role"] = $role;
        } else if($role == "Child"){
            $name = getName($_SESSION["user"], $_SESSION["pass"]);
            $_SESSION["name"] = $name;
            $_SESSION["role"] = $role;
        }
    }
}