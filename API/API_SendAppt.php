<?php
include_once 'API_functions.php';
//check if $_POST contains whos
if (isset($_POST["whos"])) {
    $who = $_POST["whos"];
    $loc = $_POST["location"];
    $time = $_POST["time"];
    $date = $_POST["date"];

    echo $who;
    echo $loc;
    echo $time;
    echo $date;
    #$datereversed = date("Y-m-d", $date);
   # $finaldate = $datereversed + " " + $time;

    $fam = $_SESSION["faimly"];


    setNewAppt($fam, $who, $loc, $time, $date);

}