<?php
include_once 'API_functions.php';
session_start();
//check that $_SESSION contains 'role'
if (isset($_SESSION['user'])) {
    $_SESSION["deadlines"] = getAllDeadlines($_SESSION["member"]);
}