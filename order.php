<?php
include_once('pizza_menu.php');

//non funziona l'aggiornamento dei counter

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
            $pizza=array_search($_POST["id"], $_SESSION["addPizza"]);
            $_SESSION["addPizza"][$pizza]["item_quantity"]+= 1; //incrementa la quantità della pizza
        }
    }else {
        $item_array = array(
            'item_id' => $_GET["id"], //id della pizza
            'item_price' => $_POST["price"], // il suo corrispettivo prezzo
            'item_quantity' => 0//$_POST["quantity"]
        );
        $_SESSION["addPizza"][0] = $item_array;
    }
}

if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        foreach($_SESSION["addPizza"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["id"])
            {
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

    <title>Pizza order </title>
</head>

<body>

<div class="pizza-menu-container">
    <?php

    $connection = getPizzaMenu();
    //stampa delle pizze = ok
    while ($row = $connection->fetch_assoc()) {
        // width e height sono temporanei nel tag 'img'
        // IMPLEMENTARE i metodi 'removeOne()' e 'addOne()' nel file js
        ?>

        <!-- codice da modificare-->
        <div class="pizza-menu-element">
            <form method="post" action="order.php?action=add&id=<?php echo $row["id"]; ?>">
                <img class="pizza-menu-img" src="<?php echo $row["img_dir"]; ?>"/><br>

                <div class="pizza-menu-info">
                    <input class="hidden-id" name="id" type="hidden" value="<?php echo $row["id"]; ?>"/>

                    <h4 class="pizza-menu-name" name="name"><?php echo $row["name"]; ?></h4>

                    <h4 class="pizza-menu-descript" name="description"><?php echo $row["description"]; ?></h4>

                    <h4 class="pizza-menu-price" name="price">$ <?php echo $row["price"]; ?></h4>

                    <input type="text" name="quantity" value="0" class="form-control"/> <!-- da cambiare con un normale paragrafo che incrementi o devrementi il valore in base al bottone cliccato-->

                    <div class="pizza-menu-buttons">
                        <form method="post" action="order.php?action=delete&id=<?php echo $row["id"]; ?>">
                            <input class="remove-button" type="submit" value="remove" name="remove"/>
                        </form>
                        <input class="add-button" type="submit" value="addButton" name="add"/>
                        <!-- <p id="counter">0</p> -->
                    </div>

                </div>

            </form>
        </div>



        <?php
    }
    ?>

</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th width="40%">Item Name</th>
            <th width="10%">Quantity</th>
            <th width="20%">Price</th>
            <th width="15%">Total</th>
            <th width="5%">Action</th>
        </tr>
        <?php
        if(!empty($_SESSION["addPizza"]))
        {
            $total = 0; //usato per memorizzare il prezzo totale
            foreach($_SESSION["addPizza"] as $keys => $values)
            {
                ?>
                <tr>
                    <td><?php echo $values["item_name"]; ?></td>
                    <td><?php echo $values["item_quantity"]; ?></td>
                    <td>$ <?php echo $values["item_price"]; ?></td>
                    <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                </tr>
                <?php
                $total = $total + ($values["item_quantity"] * $values["item_price"]);
            }
            ?>
            <tr>
                <td colspan="3" align="right">Total</td>
                <td align="right">$ <?php echo number_format($total, 2); ?></td>
                <td></td>
            </tr>
            <?php
        }
        ?>

    </table>
</div>

<!-- carrello-->
<div id="cart-total-container">
    <p>Total :</p>
    <div>
        <p id="cart-total-value">0€</p>
    </div>
</div>


<button onclick="location.href='index.php'">Back to Home</button>
</body>
</html>
