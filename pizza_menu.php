<?php
include_once('connection.php');

// Getting all elements contained in 'Products' table from the DB
// Returns query result
function getPizzaMenu() {
    $mysqli = getMysqli();

    $query = 'SELECT * FROM Products';

    return $mysqli->query($query);
}

?>
