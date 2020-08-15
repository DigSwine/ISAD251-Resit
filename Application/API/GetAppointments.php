<?php
include_once 'API_functions.php';
session_start();
//check that $_SESSION contains 'role'
if (isset($_SESSION['user'])) {
    $_SESSION["Fammembers"] = getFamilyMembers($_SESSION["family"]);
    $Appts = getAllAppointments($_SESSION["family"], $_SESSION["member"]);
    getAll($_SESSION['user'], $_SESSION['pass']);
    $_SESSION["Appts"] = $Appts;
}


function getApptName($cell)
{
    return getMemberName($cell);
}