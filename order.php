<?php
include_once('pizza_menu.php');

// Non funziona l'aggiornamento dei counter
session_start();

$connection = $_SESSION['connection'] or die("non è presente alcuna connessione col db");

if (isset($_POST['addButton'])) {
    if (isset($_SESSION['addPizza'])) { // addPizza == counter delle singole pizze
        $item_array_id = array_column($_SESSION["addPizza"], "item_id");

        if (!in_array($_POST["id"], $item_array_id)) {
            $count = count($_SESSION["addPizza"]);

            // item array è temporaneo
            $item_array = array(
                'item_id' => $_GET["id"],
                'item_price' => $_POST["price"],
                'item_quantity' => $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        } else {
            //echo '<script>alert("Item Already Added")</script>';
            $pizza = array_search($_POST["id"], $_SESSION["addPizza"]);
            $_SESSION["addPizza"][$pizza]["item_quantity"] += 1; //incrementa la quantità della pizza
        }
    } else {
        $item_array = array(
            'item_id' => $_GET["id"], //id della pizza
            'item_price' => $_POST["price"], // il suo corrispettivo prezzo
            'item_quantity' => 0 //$_POST["quantity"]
        );
        $_SESSION["addPizza"][0] = $item_array;
    }
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["addPizza"] as $keys => $values) {
            if ($values["item_id"] == $_GET["id"]) {
                unset($_SESSION["addPizza"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="order.php"</script>';
            }
        }
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <script type="text/javascript" src="script/orderHandler.js"></script>
    <title>Giotto's Pizza - Order</title>
</head>

<body>
    <section id="order">
        <div class="content">
            <!-- Menu scroller -->
            <div class="products-container">
                <p class="medium-text">MAKE YOUR ORDER</p>
                <?php
                include_once('pizza_menu.php');

                $result = getPizzaMenu();

                if (!$result) {
                    echo 'Error: ' . mysqli_errno() . ' - ' . mysqli_error();
                }

                // Vertical products scroller
                echo "<div class=\"carousel\" data-flickity='{\"freeScroll\": true, \"contain\": true, \"prevNextButtons\": false, \"pageDots\": false}'>";
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

            <!-- Cart -->
            <div id="cart-container">
                <p>Total:</p>
                <div>
                    <p id="cart-amount">0€</p>
                </div>
            </div>
        </div>
    </section>

    <button onclick="location.href='index.php'">Back to Home</button>
</body>

</html>