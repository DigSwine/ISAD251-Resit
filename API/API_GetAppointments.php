<?php
include_once 'API_functions.php';
function getAppts()
{
    //check that $_SESSION contains 'role'
    if (isset($_SESSION["role"])) {
        getAll($_SESSION["user"], $_SESSION["pass"]);

        $_SESSION["Testing"] = getFamilyMembers($_SESSION["family"]);
        $Appts = getAllAppointments($_SESSION["family"], $_SESSION["member"]);

        $_SESSION["Appts"] = $Appts;
    }
}

function getApptName($cell)
{
    return getMemberName($cell);
}