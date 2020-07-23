<?php
include_once 'API_functions.php';
function getAppts()
{
    echo "here";
    //check that $_SESSION contains 'role'
    if (isset($_SESSION["role"])) {
        echo $_SESSION["role"];
        echo $_SESSION["user"];
    }
}