<?php
include_once('connection.php');

// Getting all the elements contained in the 'Products' table
function getMenu() {
    $mysqli = getMysqli();
    $query = 'SELECT * FROM Products ORDER BY Products.price, Products.id';
    return $mysqli->query($query);
}

//utilizzato per ricercare l'id dell'utente a partire dal nome oppure dalla sua email
//$name può essere o il nome oppure l'email della persona di cui stiamo ricercando l'id
function getIdUser(mysqli $connection, string $name):string {
    $result= $connection->query("SELECT * FROM Users WHERE name = '$name' OR mail= '$name'");
    return $result->fetch_assoc()["id"];
}

function getIdOrder(mysqli $connection,string $timeStamp,string $idUser):string{
    $result= $connection->query("SELECT * FROM Orders WHERE time = '$timeStamp' AND FK_users = '$idUser'");

    return $result->fetch_assoc()["id"];
}