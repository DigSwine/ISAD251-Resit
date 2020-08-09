<?php
include_once '../API_functions.php';
//check if $_POST contains whos
if (isset($_POST["family"])) {
    $fam = $_POST["family"];
    $mem = $_POST["member"];
    $for = $_POST["whatfor"];
    $time = $_POST["forwhen"];
    $date = $_POST["fordate"];
    $note = $_POST["dednote"];

    $oldfor = $_POST["oldwhatfor"];
    $oldtime = $_POST["oldforwhen"];
    $olddate = $_POST["olddate"];

    //delete old dealdline
    delDead($fam, $mem, $oldfor, $oldtime, $olddate);

    //add new deadline
    setNewDed($fam, $mem, $for, $time, $date, $note);
}