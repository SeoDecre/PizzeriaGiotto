<?php
include_once('connection.php');

// Getting all the elements contained in the 'Products' table
function getMenu() {
    $mysqli = getMysqli();
    $query = 'SELECT * FROM Products ORDER BY Products.price, Products.id';
    return $mysqli->query($query);
}

