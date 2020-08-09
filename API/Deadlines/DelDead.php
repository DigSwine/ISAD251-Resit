<?php
include_once '../API_functions.php';
//check if $_POST contains whos
if (isset($_POST["family"])) {
    $fam = $_POST["family"];
    $mem = $_POST["member"];
    $oldfor = $_POST["delwhat"];
    $oldtime = $_POST["deltime"];
    $olddate = $_POST["deldate"];

//delete old dealdline
    delDead($fam, $mem, $oldfor, $oldtime, $olddate);

}