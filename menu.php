<?php
include_once('connection.php');

// Getting all the elements contained in the 'Products' table
function getMenu() {
    $mysqli = getMysqli();
    $query = 'SELECT * FROM Products ORDER BY Products.price, Products.id';
    return $mysqli->query($query);
}

// Function used to search a specific user id
function getIdOrder(mysqli $connection, string $timeStamp, string $idUser): string {
    $result = $connection->query("SELECT * FROM Orders WHERE delivery_time = '$timeStamp' AND FK_users = '$idUser'");
    return $result->fetch_assoc()["id"];
}