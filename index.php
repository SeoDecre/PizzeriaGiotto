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
        </section>

        <!-- Menu section -->
        <section id="menu">
            <div class="container">
                <!-- Grid -->
                <p>MENU</p>
                <?php
                include_once ('pizzaMenu.php');

                $result = getPizzaMenu();

                while ($pizza = $result->fetch_row()){
                    echo "<div class=\"pizza\" > 
                            <p> $pizza[1] </p>                          <!-- pizza name --> 
                            <p> $pizza[2] </p>                          <!-- pizza description --> 
                            <p> $pizza[3] </p>                          <!-- pizza price-->
                            </div> <br>";
                }
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
            <p>Giotto's Pizza &copy; <script> document.write(new Date().getFullYear()) </script> All rights reserved.</p>
        </footer>
    </body>
</html>
