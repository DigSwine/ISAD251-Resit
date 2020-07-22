<?php
include_once 'API_functions.php';
function sendlogin(){
    //check that $_SESSION contains 'user'
    if (isset($_GET["user"])) {
        //save them username and password into a local variable
        $user = $_GET["user"];
        $pass = $_GET["pass"];

        $role = getRole($user, $pass);

        
    }
}