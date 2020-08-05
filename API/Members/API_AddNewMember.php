<?php
include_once 'API_functions.php';
    //check that $_SESSION contains 'role'
if (isset($_POST["whosnew"])) {
    $fam = $_POST["family"];
    $who = $_POST["whosnew"];
    $pc = $_POST["PorC"];
    $user = $_POST["NewUser"];
    $pass = $_POST["NewPass"];

    createmember($fam, $who, $pc, $user, $pass);
}