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

function Compareusers($User, $Pass){
    $statement = getConnection()->prepare("SELECT Member_Username, Member_Password FROM tbl_members  WHERE Member_Username = ' . $User . ' AND Member_Password = ' . $Pass .'");
    $statement->execute();
    $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $resultSet;
}

function getRole($User, $Pass){
    $statement = getConnection()->prepare("SELECT Member_Role FROM tbl_members  WHERE Member_Username = ' . $User . ' AND Member_Password = ' . $Pass .'");
    $statement->execute();
    $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $resultSet;
}