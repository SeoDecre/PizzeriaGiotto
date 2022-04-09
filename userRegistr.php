
<?php
if (!isset($_POST['name']) || !isset($_POST['surname']) || !isset($_POST['phone']) ||
    !isset($_POST['user_email']) || !isset($_POST['password']) ) {
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <title>User registration</title>
</head>

<body>

<div id="registerForm" style="visibility: visible">
    <dialog class="dialog" open>
        <form method="post" action="userRegistr.php">
            <div>
                <table>
                    <tr>
                        <td> <strong> User Registration</strong></td>
                    </tr>
                    <tr>
                        <td><strong>All Field Mark with asterisk (<span class="asterisk">*</span>) must be filled up </strong></td>
                    </tr>
                </table>
            </div>
            <hr>
            <div>
                <label>Name :</label>
                <input type="text" name="name" placeholder="Name" required>
                <strong class="asterisk">*</strong>
            </div>
            <div>
                <label>Surname :</label>
                <input type="text" name="surname" placeholder="Surname" required>
                <strong class="asterisk">*</strong>
            </div>

            <div>
                <label>Phone number :</label>
                <input type="tel" name="phone" required>
                <strong class="asterisk">*</strong>
            </div>

            <div>
                <label>Email :</label>
                <input type="email" name="user_email" required>
                <strong class="asterisk">*</strong>
            </div>

            <div>
                <label>Password :</label>
                <input type="password" name="password"  required>
                <strong class="asterisk">*</strong>
            </div>

            <div>
                <input type="submit" value="SIGN UP">

            </div>

        </form>

    </dialog>
</div>

</body>
</html>
    <?php
}
else {
            // controlla che la registrazione è andata a buon fine all'interno del DB
?>
    <html>
    <head>
        <title>Nuovo utente</title>
    </head>
    <body>
    <?php
        $name= $_POST['name'];
        $surname= $_POST['surname'];
        $phone= $_POST['phone'];
        $email= $_POST['user_email'];
        $cryptedPassw = crypt($_POST['password'],1); // cifratura della  password

        $connection = new mysqli ( "localhost","root","","Pizzeria");


        //check if user already exist
        $query = "SELECT * FROM Users WHERE name = '$name'";
        $result = $connection->query($query);

        if ($result!==false && $result->num_rows > 0)
            echo " L'utente $name &egrave; gi&agrave;presente nel database.";
        else {


            $query = "INSERT INTO Users (name, surname, tel, mail, password) VALUES('$name','$surname','$phone','$email','$cryptedPassw')";

            $connection->query($query);

            //it's needed a css and a html structure that can contain correctly the messages
            echo " L'utente $name &egrave; stato aggiunto al database.";
            header("location: order.php");

        }

        $result->close();
        $connection->close();

    ?>
    </body>
    </html>
    <?php
}
?>
