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

?>
