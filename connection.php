<?php
// Establishing a connection with the DB
function getMysqli() {
    // Instantiation of mysqli object, it opens the connection to the DB
    $mysqli = new mysqli('localhost', 'pizzeriagiotto', 'jdmRutwwr4e4', 'my_pizzeriagiotto');

    // Issue any connection errors
    if ($mysqli->connect_error) {
        die('Error ' . $mysqli->connect_errno . ' - ' . $mysqli->connect_error);
    }
    return $mysqli;
}
