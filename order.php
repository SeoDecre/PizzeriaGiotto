
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">


    <title>Pizza order </title>
</head>

<body>
    <section id="order">
        <div class="content">
            <!-- Menu scroller -->
            <div class="products-container">
                <p class="medium-text">MAKE YOUR ORDER</p>
                <?php
                include_once('pizza_menu.php');

<div class="pizza-menu-container">
    <?php
    include_once ("pizza_menu.php");

    $connection = getPizzaMenu();
    //stampa delle pizze = ok
    $i = 0;
    while ($row = $connection->fetch_assoc()) {
        // width e height sono temporanei nel tag 'img'
        // IMPLEMENTARE i metodi 'removeOne()' e 'addOne()' nel file js
        ?>

        <!-- codice da modificare-->
        <div class="pizza-menu-element">
            <img class="pizza-menu-img" src="<?php echo $row["img_dir"]; ?>"/><br>

            <div class="pizza-menu-info">

                <h4 class="pizza-menu-name" name="name"><?php echo $row["name"]; ?></h4>

                <h4 class="pizza-menu-descript" name="description"><?php echo $row["description"]; ?></h4>

                <h4 id="price-currency">$</h4><h4 id="<?php echo $row["id"]?>_price" name="price"><?php echo $row["price"]; ?></h4>

                <h4 type="text" id="<?php echo $row["id"]?>_quantity" >0</h4> <!--- quantità della pizza-->

                <div class="pizza-menu-buttons">


                    <button class="remove-button" onclick="removeOne('<?php echo $row["id"]."_quantity"; ?>')">Remove One</button>

                    <button class="add-button" onclick="addOne('<?php echo $row["id"]."_quantity"; ?>')">Add One</button>

                </div>

            </div>


        </div>


        <?php
        $i++;
    }

    ?>

</div>

<!-- carrello-->
<div id="cart-total-container">

</div>

<form method="post" action="order.php">
    <h4 id="total-price" name="totalPrice">0</h4>
    <input type="button" name="order" value="ORDER"/>

</form>


<button onclick="location.href='index.php'">Back to Home</button>
</body>
<script type="text/javascript" src="js/orderHandler.js"></script>
</html>

</html>