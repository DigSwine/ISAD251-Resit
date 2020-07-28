<?php
include_once 'API_functions.php';
function retriveFam()
{
    //check that $_SESSION contains 'role'
    if (isset($_SESSION["role"])) {
        $_SESSION["Testing"] = getFamilyMembers($_SESSION["family"]);

    }
}