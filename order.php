<?php
include_once ("menu.php");
session_start();

// Issues checking
$connect = getMysqli() or die("Database not found");

if (isset($_POST["order"])) {
    $userId = $_SESSION["id"] or die("Error, user id not found");

    // Saving all the ordered products
    $orderedProductsList = json_decode($_POST["pizzaList"], true);

    if (sizeof($orderedProductsList) == 0) {
        $_POST = array();
        echo '<script type="text/javascript"> alert("Error, no products selected"); window.location.href = "order.php";</script>';
    }

    // Establishing all the order attributes
    $amount = $_POST["totalPrice"];
    $delivery_time = new DateTime();
    $delivery_time = $delivery_time->format("Y-m-d H:i:s");
    $delivery_address = $_POST["address"];

    // Query for order adding
    $addOrder = "INSERT INTO Orders (dollar_amount, delivery_time, delivery_address, FK_users) VALUES ('$amount', '$delivery_time', '$delivery_address', '$userId')";
    $connect->query($addOrder);

    // Getting the order id
    $idOrder = getIdOrder($connect, $delivery_time, $userId);

    // Scrolling the ordered products list to get each product data and add them in the "Order_Products" table
    // Each product is associated with the actual order
    $query = "INSERT INTO Orders_Products (FK_orders, FK_products, amount) VALUES ";
    for ($i = 0; $i < sizeof($orderedProductsList); $i++) {
        $pizzaId = $orderedProductsList[$i][0];
        $productsAmount = $orderedProductsList[$i][1];
        $query .= "($idOrder, $pizzaId, $productsAmount)";

        if ($i + 1 < sizeof($orderedProductsList)) {
            $query .= ",";
        }
    }

    // Sending the query to the server and inform the user
    $connect->query($query);
    echo '<script type="text/javascript"> alert("Your order has been sent!"); window.location.href = "index.php";</script>';
    $_POST = array();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <title>Pizza order </title>
</head>

<body>
<!-- Order section -->
<section id="order">
    <div class="content">
        <p class="medium-text">MAKE YOUR ORDER</p>

        <!-- Menu carousel -->
        <?php
        $connection = getMenu();
        echo "<div class=\"carousel\" data-flickity='{\"autoplay\": true, ...'>";
        while ($row = $connection->fetch_assoc()) {
            ?>
            <div class="product-container">
                <img class="product-img" src="<?php echo $row["img_dir"]; ?>" alt="<?php echo $row["name"]; ?>">
                <p class="product-name"><?php echo $row["name"]; ?></p>
                <p class="small-text product-description"><?php echo $row["description"]; ?></p>
                <p class="small-text product-price" id="<?php echo $row["id"] ?>-price"><?php echo number_format($row["price"], 2); ?>$</p>
                <div class="pizza-menu-buttons">
                    <button class="operation-button" onclick="removeOne('<?php echo $row["id"] . "-amount"; ?>')">-</button>
                    <p class="small-text product-description" id="<?php echo $row["id"] ?>-amount">0</p>
                    <button class="operation-button" onclick="addOne('<?php echo $row["id"] . "-amount"; ?>')">+</button>
                </div>
            </div>;
            <?php
        }
        echo "</div>";
        ?>

        <!-- Cart -->
        <div id="cart-total-container">
            <form id="order-form" method="post" action="order.php">
                <h4 id="total-price">0</h4>
                <label for="address">What's your address ?</label>
                <input type="text" name="address" value="" required/>
                <input id="submit-button" type="submit" name="order" onclick="saveMap()" value="ORDER"/>
            </form>
        </div>
    </div>
</section>

<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="js/orderHandler.js"></script>
</body>
</html>