<?php
include_once '../API_functions.php';
//check if $_POST contains AddDedname
if (isset($_POST["AddDedname"])) {
    $fam = $_POST["family"];
    $name = $_POST["AddDedname"];
    $time = $_POST["addtime"];
    $date = $_POST["adddate"];
    $member = $_POST["member"];
    setNewDed($fam, $member, $name, $time, $date, "No note has been made", "No");
}
