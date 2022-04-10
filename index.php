<?php
session_start();

// Estabilishing a connection with the DB "sql103.epizy.com", "epiz_31487448", "wScbLHkHAx", "epiz_31487448_pizzeria"
$connection = new mysqli ("localhost", "root", "", "Pizzeria");

if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['phone']) && isset($_POST['user_email']) && isset($_POST['password'])) { // Registration check
    // Checking for DB registration errors
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $email = $_POST['user_email'];
    $passw = $_POST['password']; // Password encryption

    // Checking if user already exists
    $query = "SELECT * FROM Users WHERE mail = '$email'";
    $result = $connection->query($query);

    if ($result !== false && $result->num_rows > 0) {
        $_POST = [];
        echo '<script type="text/javascript"> alert("User already exists"); window.location.href = "index.php";</script>';
    } else {
        $query = "INSERT INTO Users (name, surname, tel, mail, password) VALUES('$name','$surname','$phone','$email','$passw')";
        $connection->query($query);
        echo '<script type="text/javascript"> alert("User has been registered!"); window.location.href = "order.php";</script>';
    }

    $result->close();
    $connection->close();
} elseif (isset($_POST['user_email']) && isset($_POST['password'])) {  // Login check
    // Checking if user already exists
    $query = "SELECT * FROM Users WHERE mail = '{$_POST['user_email']}'";
    // Query result saving
    $result = $connection->query($query);
    // Array containing all the elements of the tupla
    $result = $result->fetch_assoc();

    // Checking for user presence in DB
    if (isset($result['mail'])) {
        if (strcmp($_POST['password'], $result['password']) == 0) {
            header("location: order.php"); // Redirecting to 'order' file
        } else {
            echo '<script type="text/javascript"> alert("Wrong password!"); window.location.href = "index.php";</script>';
        }
    } else {
        echo '<script type="text/javascript"> alert("User not registered!"); window.location.href = "index.php";</script>';
    }

    $_POST = array();
} else {
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <title>Giotto's Pizza</title>
</head>

<body>
<!-- prova del dialog con il form di registrazione e login utenti -->
<div id="loginForm" style="visibility: hidden">
    <dialog class="dialog" open>
        <form method="post" action="index.php">
            <label>Login</label>
            <div>
                <label>Email :</label>
                <input type="email" name="user_email" placeholder="Email" required>
            </div>
            <div>
                <label>Password :</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div>
                <input type="submit" value="SIGN IN">
                <span class="text-muted">Not a member?</span> <a onclick="document.getElementById('registerForm').style.visibility='visible';
                        document.getElementById('loginForm').style.visibility='hidden';">Sign up</a>
            </div>

        </form>

    </dialog>
</div>

<!-- div delle registrazioni -->
<div id="registerForm" style="visibility: hidden">
    <dialog class="dialog" open>
        <form method="post" action="index.php">
            <div>
                <table>
                    <tr>
                        <td><strong> User Registration</strong></td>
                    </tr>
                    <tr>
                        <td><strong>All Field Mark with asterisk (<span class="asterisk">*</span>) must be filled up
                            </strong></td>
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
                <input type="password" name="password" required>
                <strong class="asterisk">*</strong>
            </div>
            <div>
                <input type="submit" value="SIGN UP">
                <a onclick="document.getElementById('registerForm').style.visibility='hidden';
                        document.getElementById('loginForm').style.visibility='visible';">Login</a>
            </div>
        </form>
    </dialog>
</div>

<!-- Home section -->
<section id="home">
    <div class="content">
        <p class="title">Giotto's Pizzeria</p>
        <p class="small-text">The roundest pizza on the market.</p>
    </div>
    <button href="order.php" class="order button" onclick="document.getElementById('loginForm').style.visibility='visible'">ORDER</button>
</section>

<!-- Menu section -->
<section id="menu">
    <div class="content">
        <p class="medium-text">A large choice of flavors</p>

        <?php
        include_once('pizza_menu.php');

        $result = getPizzaMenu();

        if (!$result) {
            echo 'Error: ' . mysqli_errno() . ' - ' . mysqli_error();
        }

        // Horizontal scroller pizzas creation
        echo "<div class=\"carousel\" data-flickity='{\"autoplay\": true, \"freeScroll\": true, \"contain\": true, \"prevNextButtons\": false, \"pageDots\": false}'>";
        while ($pizza = $result->fetch_row()) {
            echo "<div class=\"product-container\">
                    <img class=\"product-img\" src=\"$pizza[4]\" alt=\"$pizza[1]\">
                    <p class=\"product-name\">$pizza[1]</p>
                    <p class=\"small-text product-price\">$pizza[3]€</p>
                </div>";
        }
        echo "</div>";
        ?>
    </div>
</section>

<!-- Info section -->
<section id="info">
    <div class="content">
        <div class="image-container">
            <img src="resources/pizzeria.png" alt="Pizzeria" align="left"/>
        </div>
        <div class="text-container">
            <p class="medium-text title">SINCE <span style="color: #FFC37D">1981</span></p>
            <p class="small-text">We are the best pizzeria, trust us. <br><br>
                You may not like our pizzas but they
                are so perfectly round that you
                won't complain about the taste. <br><br>
                We care about our customers
                satisfaction, that's why we have
                recently started washing our dishes. <br><br>
                We do not accept refunds.</p>
        </div>
    </div>
</section>

<!-- Footer -->
<footer id="footer">
    <h2><a href="">Giotto's Pizzeria</a></h2>
    <p>&copy;<script> document.write(new Date().getFullYear()) </script> All rights reserved.</p>
</footer>

<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
</body>
</html>
<?php } ?>