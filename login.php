<?php
include_once ("menu.php");

session_start();
$connection = getMysqli(); // Establishing a connection with the DB
$errorText = "";

if (isset($_POST['email']) && isset($_POST['password'])) {
    // Checking if user exists
    $query = "SELECT * FROM Users WHERE email = '{$_POST['email']}'";
    // Saving and fetching the query result
    $result = $connection->query($query);
    $result = $result->fetch_assoc();

    if (isset($result['email'])) {
        // Comparing inserted password with hashed password
        if (password_verify($_POST['password'], $result['password'])) {
            if (isset($_POST['remember'])) {
                $_SESSION['email'] = $result['email'];
                // Server should keep session data for at least 1 week
                ini_set('session.gc_maxlifetime', 3600 * 24 * 7);
                // Each client should remember their session id for exactly 1 week
                session_set_cookie_params(3600 * 24 * 7);
            }

            $_SESSION['id'] = $result['id'];
            header("location: order.php"); // Redirecting to order
        } else {
            $errorText = "Password is wrong";
        }
    } else {
        $errorText = "User not registered";
    }

    // $result->close();
    $connection->close();
    $_POST = array();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <title>Giotto's Pizza - Login</title>
</head>

<body>
<!-- Login section -->
<section id="login">
    <div class="container">
        <p class="title">Login</p>
        <form method="post" action="login.php">
            <div class="content-field">
                <label class="form-field-name">Email:</label> <br>
                <input class="form-input" type="email" name="email" required> <br>
            </div>
            <div class="content-field">
                <label class="form-field-name">Password:</label> <br>
                <input class="form-input" type="password" name="password" required> <br>
            </div>
            <label class="form-field-name">Remember me <input class="checkbox" type="checkbox" name="remember"></label>
            <br>
            <div class="content-field">
                <input class="button" type="submit" value="SIGN IN"> <br>
                <span class="alternative-text">Not a member? <a id="register-linker" href="register.php">Register</a></span>
            </div>
            <span id="login-error-text" class="error-text"><?php echo $errorText ?></span>
        </form>
    </div>
</section>
</body>
</html>