<?php
include_once ("menu.php");
session_start();

// Establishing a connection with the DB
$connection = getMysqli() or die("Database not found");

if (isset($_POST['order-button'])) {
    if (isset($_SESSION['email'])) {
        header("location: order.php");
    } else {
        header("location: login.php");
    }
}

$_POST = array();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <title>Giotto's Pizza</title>
</head>

<body>
<!-- Home section -->
<section id="home">
    <div class="content">
        <p class="title">Giotto's Pizzeria</p>
        <p class="small-text">The roundest pizza on the market.</p>
    </div>
    <form action="index.php" method="post" class="order">
        <input type="submit" id="order-button" class="button" name="order-button" value="ORDER"/>
    </form>
</section>

<!-- Menu section -->
<section id="menu">
    <div class="content">
        <p class="medium-text">A large choice of flavors</p>
        <?php
        $result = getMenu();

        // Horizontal products scroller
        echo "<div class=\"carousel\" data-flickity='{\"autoplay\": true, \"freeScroll\": true, \"contain\": true, \"prevNextButtons\": false, \"pageDots\": false}'>";
        while ($product = $result->fetch_row()) {
            echo "<div class=\"product-container\">
                    <img class=\"product-img\" src=\"$product[4]\" alt=\"$product[1]\">
                    <p class=\"product-name\">$product[1]</p>
                    <p class=\"small-text product-price\">$product[3]€</p>
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
            <img src="resources/pizzeria.png" alt="Pizzeria"/>
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