<?php
include_once '../API_functions.php';
    //check that $_SESSION contains 'role'
if (isset($_POST["whosnew"])) {
    $fam = $_POST["family"];
    $who = $_POST["whosnew"];
    $pc = $_POST["PorC"];
    $user = $_POST["NewUser"];
    $pass = $_POST["NewPass"];
    $conpass = $_POST["ConPass"];

    //check nothing is null
    if ($who != null){
        if ($pc != null){
            if ($user != null) {
                if ($pass != null) {
                    if ($conpass != null) {
                        if($pass != $conpass){
                            echo "pass";
                        } else {
                            $compuser = getUsercompare($user);
                            if($compuser == null) {
                                createmember($fam, $who, $pc, $user, $pass);
                            } else {
                                echo "user";
                            }
                        }
                    } else {
                        echo "nu";
                    }
                } else {
                    echo "nu";
                }
            } else {
                echo "nu";
            }
        } else {
            echo "nu";
        }
    } else {
        echo "nu";
    }
}