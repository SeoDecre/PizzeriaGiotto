<?php
include_once('connection.php');

// Getting all elements contained in 'Products' table from the DB
// Returns query result

/*function getPizzaMenu(string $host = 'localhost', string $username = 'root',
                      string $password = '', string $db_name = 'Pizzeria') {
    $mysqli = getMysqli( $host ,  $username ,  $password,  $db_name);
    $query = 'SELECT * FROM Products';
    return $mysqli->query($query);
}
*/


//non funziona -- Fatal error: Uncaught Error: mysqli object is already closed in C:\xampp\htdocs\giotto\pizza_menu.php:17 Stack trace: #0 C:\xampp\htdocs\giotto\pizza_menu.php(17): mysqli->query('SELECT * FROM P...') #1 C:\xampp\htdocs\giotto\order.php(86): getPizzaMenu(Object(mysqli)) #2 {main} thrown in C:\xampp\htdocs\giotto\pizza_menu.php on line 17

function getPizzaMenu(mysqli $connection): mysqli_result|bool
{
    $query = 'SELECT * FROM Products';
    return $connection->query($query) ;
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

?>
