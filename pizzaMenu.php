<?php
include_once('connection.php');


//get all elements contained inside 'Products' table from database
//return query result

function getPizzaMenu(){
    $mysqli=getMysqli();

    $query= 'SELECT * FROM Products';

    $result= $mysqli->query($query);

    return $result;
}
?>
