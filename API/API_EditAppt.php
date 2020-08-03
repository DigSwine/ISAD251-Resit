<?php
include_once 'API_functions.php';
//check if $_POST contains whos
if (isset($_POST["forwho"])) {
    //get information
    $fam = $_POST["family"];
    $oldwho = $_POST["oldforwho"];
    $oldloc = $_POST["oldlocation"];
    $oldtime = $_POST["oldtime"];
    $olddate = $_POST["olddate"];

    $who = $_POST["forwho"];
    $loc = $_POST["location"];
    $time = $_POST["editedtime"];
    $date = $_POST["editeddate"];
    $note = $_POST["apptnote"];

    //delete appt
    delAppt($fam, $oldwho, $oldloc, $oldtime, $olddate);

    //added edited appt
    setEditedAppt($fam, $who, $loc, $time, $date, $note);
}