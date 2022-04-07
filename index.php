<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <title>Giotto's Pizza</title>
</head>

<body>
<!-- Home section -->
<section id="home">
    <div class="content">
        <h1 class="title">GIOTTO'S<br>PIZZERIA</h1>
        <p class="subtitle">The roundest pizza on the market</p>
        <p><?php echo 'PHP version: ' . phpversion(); ?></p>
        <a href="order.php" class="button"></a>
    </div>

    <!-- prova del dialog con il form di registrazione e login utenti -->
    <div id="loginForm" style="visibility: visible">
        <dialog class="dialog" open>
            <form method="post" action="order.php">
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

                    <span class="text-muted">Not a member?</span> <a href="userRegistr.php">Sign up</a>

                </div>

            </form>

        </dialog>
    </div>
</section>

<!-- Menu section -->
<section id="menu">
    <div class="container">
        <!-- Grid -->
        <p>MENU</p>
        <?php
        include_once('pizzaMenu.php');

        $result = getPizzaMenu();

        //inizializzazione nuova sessione
        session_start();
        $_SESSION['connection']= $result;

        //scroller orizzontale
        echo "<div class=\"pizza-scroller\" >";
        while ($pizza = $result->fetch_row()) {
            echo "  <div class=\"product-container\">
                            <img class=\"product-img\"src=\"$pizza[4]\" alt=\"$pizza[1]\">
                             <p>$pizza[1]</p>                          <!-- pizza name --> 
                             <p>$pizza[2]</p>                          <!-- pizza description --> 
                             <p>$pizza[3]€</p>                         <!-- pizza price-->
                             <br>
                            </div>";
        }
        echo "</div>";
        ?>


    </div>
</section>

<!-- Info section -->
<section id="info">
    <div class="container">
        <h1 class="title">SINCE 1666</h1>
        <p>Bla bla bla bla bla bla bla bla bla bla bla</p>
    </div>
</section>

<!-- Footer -->
<footer id="footer">
    <h2><a href="">Contact us</a></h2>
    <p>Terms of service</p>
    <p>Privacy policy</p>
    <p>Giotto's Pizza &copy;
        <script> document.write(new Date().getFullYear()) </script>
        All rights reserved.
    </p>
</footer>
</body>
</html>
