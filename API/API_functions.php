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
    $statement = getConnection()->prepare("SELECT * FROM tbl_appointments  WHERE Family_ID = '". $Family . "' AND Member_ID = '" . $Member . "'");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
function getDeadlines($Family, $Member){

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