<?php

// Establishing a connection towards database
// Returns a 'mysqli' object that contains the DB connection
function getMysqli(string $host = 'localhost', string $username = 'root', string $password = '', string $db_name = 'PizzeriaGiotto') {
    $mysqli = new mysqli($host, $username, $password, $db_name);

    // Output any connection error
    if ($mysqli->connect_error) {
        die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }

    return $mysqli;
}
