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
    $comp = $_POST["comp"];

    $oldfor = $_POST["oldwhatfor"];
    $oldtime = $_POST["oldforwhen"];
    $olddate = $_POST["olddate"];

//update appt
if($for == null){

} else if($time == null){
    echo "nu";
} else if($date == null){
    echo "nu";
} else if($note == null){
    echo "nu";
} else if($comp == null){
    echo "nu";
} else {
    setEditedDed($fam, $mem, $for, $time, $date, $note, $comp, $oldfor, $oldtime, $olddate);
}
}