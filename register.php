<?php
include_once ("menu.php");
session_start();

// Establishing a connection with the DB
$connection =getMysqli();
$errorText = "";

if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password'])) {

    // Checking for registration errors
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Password hashing

    // Checking if user already exists
    $query = "SELECT * FROM Users WHERE email = '$email'";
    $result = $connection->query($query);

    if ($result !== false && $result->num_rows > 0) {
        $_POST = [];
        $errorText = "A user with this email already exists!";
    } else {
        $query = "INSERT INTO Users (name, surname, tel, email, password) VALUES('$name', '$surname', '$phone', '$email', '$password')";
        $connection->query($query);
        $_SESSION['id'] = $result["id"];

        $_SESSION['email'] = $result['email'];
        // Server should keep session data for at least 1 week
        ini_set('session.gc_maxlifetime', 3600 * 24 * 7);
        // Each client should remember their session id for exactly 1 week
        session_set_cookie_params(3600 * 24 * 7);
        header("location: order.php"); // Redirecting to order
    }

    $result->close();
    $connection->close();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <title>Giotto's Pizza - Register</title>
</head>

<body>

<!-- Login modal -->
<section id="register">
    <div class="container">
        <p class="title">Register</p>
        <form method="post" action="register.php">
            <div class="content-field">
                <label class="form-field-name">Name:</label> <br>
                <input class="form-input" type="text" name="name" required> <br>
            </div>
            <div class="content-field">
                <label class="form-field-name">Surname:</label> <br>
                <input class="form-input" type="text" name="surname" required> <br>
            </div>
            <div class="content-field">
                <label class="form-field-name">Phone number:</label> <br>
                <input class="form-input" type="tel" name="phone" required> <br>
            </div>
            <div class="content-field">
                <label class="form-field-name">Email:</label> <br>
                <input class="form-input" type="email" name="email" required> <br>
            </div>
            <div class="content-field">
                <label class="form-field-name">Password:</label> <br>
                <input class="form-input" type="password" name="password" required> <br>
            </div>
            <div class="content-field">
                <input class="form-button button" type="submit" value="SIGN UP"> <br>
                <span class="alternative-text">Already a member? <a id="login-linker" href="login.php">Login</a></span>
            </div>
            <span id="login-error-text" class="error-text"><?php echo $errorText ?></span>
        </form>
    </div>
</section>
</body>
</html>
