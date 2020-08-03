<?php
include_once 'API_functions.php';
//check if $_POST contains whos
if (isset($_POST["delwho"])) {
    //get information
    $fam = $_POST["family"];
    $who = $_POST["delwho"];
    $loc = $_POST["dellocation"];
    $time = $_POST["deltime"];
    $date = $_POST["deldate"];

    //delete appt
    delAppt($fam, $who, $loc, $time, $date);
}