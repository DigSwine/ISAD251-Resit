<?php
include_once '../API_functions.php';
//check that $_SESSION contains 'role'
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $conpass = $_POST['conpass'];

    if($pass != $conpass){
        //send alert that password and confirm password does not match
        echo "pass";
    } else {
        //check if the user exists
        $check = getUsercompare($user);
        if($check != NULL){
            //send alert that username is already taken
            echo "exists";
        } else{
            //submit new user
            $famid = 1;
            createfam($famid, $name, "Parent", $user, $pass);
            echo "done";
        }

    }


}
