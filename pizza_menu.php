<?php
include_once('connection.php');

// Getting all elements contained in 'Products' table from the DB
// Returns query result
function getPizzaMenu(string $host = 'localhost', string $username = 'root',
                      string $password = '', string $db_name = 'Pizzeria') {
    $mysqli = getMysqli( $host ,  $username ,  $password,  $db_name);
    $query = 'SELECT * FROM Products';
    return $mysqli->query($query);
}

//utilizzato per ricercare l'id dell'utente a partire dal nome oppure dalla sua email
//$name può essere o il nome oppure l'email della persona di cui stiamo ricercando l'id
function getIdUser(mysqli $connection, string $name):string {
    $result= $connection->query("SELECT * FROM Users WHERE name = '$name' OR mail= '$name'");
    return $result->fetch_assoc()["id"];
}
?>
