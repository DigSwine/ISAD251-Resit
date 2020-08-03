<?php

const SeverHTML = 'proj-mysql.uopnet.plymouth.ac.uk';
const User = 'ISAD251_MWilsonSlider';
const Pass = 'ISAD251_22201420';
const DataBase = 'ISAD251_MWilsonSlider';

function getConnection()
{
    $dataSourceName = 'mysql:dbname='.DataBase.';host='.SeverHTML;
    $dbConnection = null;
    try
    {
        $dbConnection = new PDO($dataSourceName, User, Pass);

    }  catch (PDOException $err)
    {
        echo 'Connection failed: ', $err->getMessage();
    }
    return $dbConnection;
}

//Getters
function getAll($User, $Pass){
    $_SESSION["role"] = getRole($User, $Pass);
    $_SESSION["name"] = getName($User, $Pass);
    $_SESSION["member"] = getMember($User, $Pass);
    $_SESSION["family"] = getFamily($_SESSION["member"]);
}
function getRole($User, $Pass){
    $statement = getConnection()->prepare("SELECT Member_Role FROM tbl_members  WHERE Member_Username = '". $User . "' AND Member_Password = '" . $Pass . "'");
    $statement->execute();
    $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);
    return tosend($resultSet);
}
function getName($User, $Pass){
    $statement = getConnection()->prepare("SELECT Member_Name FROM tbl_members  WHERE Member_Username = '". $User . "' AND Member_Password = '" . $Pass . "'");
    $statement->execute();
    $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);
    return tosend($resultSet);
}
function getAllAppointments($Family, $Member){
    $statement = getConnection()->prepare("SELECT * FROM tbl_appointments  WHERE Family_ID = '". $Family . "'");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
function getMember($User, $Pass){
    $statement = getConnection()->prepare("SELECT Member_ID FROM tbl_members  WHERE Member_Username = '". $User . "' AND Member_Password = '" . $Pass . "'");
    $statement->execute();
    $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);
    return tosend($resultSet);
}
function getFamily($Mem){
    $statement = getConnection()->prepare("SELECT Family_ID FROM tbl_familys WHERE Member_ID = '" . $Mem . "'");
    $statement->execute();
    $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);
    return tosend($resultSet);
}
function getMemberName($input){
    $statement = getConnection()->prepare("SELECT Member_Name FROM tbl_members WHERE Member_ID = '" . $input . "'");
    $statement->execute();
    $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);
    return tosend($resultSet);
}
function getMemberID($mem, $fam){
    $statement = getConnection()->prepare("SELECT Member_ID FROM tbl_members WHERE Member_Name = '" . $mem . "' AND Family_ID = '" . $fam . "'");
    $statement->execute();
    $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);
    return tosend($resultSet);
}
function getFamilyMembers($fam){
    $statement = getConnection()->prepare("SELECT Member_Name FROM tbl_members WHERE Family_ID = '" . $fam . "'");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
function getTheNote($ApptID){
    $statement = getConnection()->prepare("SELECT 	Appointment_Note FROM tbl_appointments WHERE Appointment_ID = '" . $ApptID . "'");
    $statement->execute();
    return tosend($statement->fetchAll(PDO::FETCH_ASSOC));
}

//deletes
function delAppt($fam, $who, $loc, $time, $date){
    $whoid = getMemberID($who, $fam);
    $statement = getConnection()->prepare("DELETE FROM tbl_appointments WHERE Family_ID = '".$fam."' AND Member_ID = '".$whoid."' AND Appointment_Location = '".$loc."' AND Appointment_Time = '".$time."' AND Appointment_Date = '".$date."'");
    $statement->execute();
}

//senders
function setNewAppt($fam, $who, $loc, $time, $date){
    $whoid = getMemberID($who, $fam);
    $statement = getConnection()->prepare("INSERT INTO `tbl_appointments` (`Appointment_ID`, `Member_ID`, `Family_ID`, `Appointment_Location`, `Appointment_Time`, `Appointment_Date`) VALUES (NULL, '" . $whoid . "', '" . $fam . "', '" . $loc . "', '" . $time . "', '" . $date . "')");
    $statement->execute();
}
function setEditedAppt($fam, $who, $loc, $time, $date, $note){
    $whoid = getMemberID($who, $fam);
    $statement = getConnection()->prepare("INSERT INTO `tbl_appointments` (`Appointment_ID`, `Member_ID`, `Family_ID`, `Appointment_Location`, `Appointment_Time`, `Appointment_Date`, `Appointment_Note`) VALUES (NULL, '" . $whoid . "', '" . $fam . "', '" . $loc . "', '" . $time . "', '" . $date . "', '" . $note . "')");
    $statement->execute();
}




//useful functions
function tosend($resultSet){
    if ($resultSet != null) {
        $columns = empty($resultSet) ? array() : array_keys($resultSet[0]);
        $idColumn = $columns[0];
        $tableString = '<table border="1"><tr>';
        $inputString = '';
        $insertString = '';
        if ($columns != "placeholder") {
            foreach ($columns as $column) {
                $tableString .= '<h5>' . $column . '</h5>';
                $inputString .= '<h5>' . $column . '</h5>';
                $insertString .= '<td><input type=\'text\' name=\'' . $column . '\'/></td>';
            }
            foreach ($resultSet as $row) {
                foreach ($row as $cell) {
                    $send = $cell;
                }
            }
        }
        return $send;
    }
}