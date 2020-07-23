<?php
include_once 'API_functions.php';
function getAppts()
{
    //check that $_SESSION contains 'role'
    if (isset($_SESSION["role"])) {
        getAll($_SESSION["user"], $_SESSION["pass"]);

        echo $_SESSION["family"];
        echo $_SESSION["member"];



        $_SESSION["appts"] = getAllAppointments($_SESSION["family"], $_SESSION["member"]);

    }
}