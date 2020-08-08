<?php
include_once '../API_functions.php';
//check if $_POST contains whos
if (isset($_POST["whos"])) {
    //get information
    $fam = $_POST["family"];
    $who = $_POST["whos"];
    $loc = $_POST["location"];
    $time = $_POST["time"];
    $date = $_POST["date"];

    //Add appt
    setNewAppt($fam, $who, $loc, $time, $date);
}