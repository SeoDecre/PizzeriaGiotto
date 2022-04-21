<?php
include_once("connection.php");
session_start();



if (isset($_POST['pizzaList']) && isset($_POST['totalPrice'])) {

    $userId=$_SESSION["id"] or exit("Errore sulla SESSION"); //id user nel db

    $connect=getMysqli();

    //salvo le pizze contenute nell'ordine
    $pizzaList = json_decode($_POST["pizzaList"],true );

    //prezzo totale "calcolato" nel "order.php"
    //quando si clicca il bottone "order" nella schermata "order.php"
    $total = $_POST["totalPrice"];

    //salvo il timestamp dell'ordine
    $timestamp=new DateTime();

    //formatto la data
    $timestamp=$timestamp->format("Y-m-d H:i:s");

    $location=$_POST["address"];

    $status="delivering";

    //to fix , è necessario controllare a modo i metodi di pagamento all'interno del form

    $payment=$_POST["paymentType"];

    //aggiunge l'ordine
    $addOrder="INSERT INTO Orders (amount, time, delivery_address, status, payment_type, FK_users) VALUES
                                                                                               ('$total', '$timestamp', '$location', '$status', '$payment', '$userId')";
    //invia la query
    $connect->query($addOrder);
/*
 //manca la ricerca del id dell'ordine, così anche per le pizze

    //scorre tutto l'array per raccogliere i dati delle pizze così da aggiungerli alla
    //tabella "order_products"
    //associa ogni pizza dell'ordine all'ordine stesso in cui sono richieste

    for($i=0;$i<sizeof($pizzaList);$i++){
        $pizzaId=$pizzaList[$i][0];
        var_dump($pizzaId);

      //  $query="INSERT INTO Orders_Products (FK_orders, FK_products) VALUES ('$idOrder','$pizzaId'),";
        //invia la query al server
      //  $connect->query($query);
    }*/

    //resetta l'array "$_POST"
    $_POST=array();
}
?>

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

            <div class="pizza-menu-container">
                <?php
                include_once("pizza_menu.php");

                $connection = getPizzaMenu();
                //stampa delle pizze = ok
                $i = 0;
                while ($row = $connection->fetch_assoc()) {
                    ?>

                    <!-- codice da modificare-->
                    <div class="pizza-menu-element">
                        <img class="pizza-menu-img" src="<?php echo $row["img_dir"]; ?>"/><br>

                        <div class="pizza-menu-info">

                            <h4 class="pizza-menu-name" name="name"><?php echo $row["name"]; ?></h4>

                            <h4 class="pizza-menu-descript" name="description"><?php echo $row["description"]; ?></h4>

                            <h4 id="price-currency">$</h4><h4 id="<?php echo $row["id"] ?>_price"
                                                              name="price"><?php echo number_format($row["price"],2); ?></h4>

                            <h4 type="text" id="<?php echo $row["id"] ?>_quantity">0</h4> <!--- quantità della pizza-->

                            <div class="pizza-menu-buttons">


                                <button class="remove-button"
                                        onclick="removeOne('<?php echo $row["id"] . "_quantity"; ?>')">
                                    Remove One
                                </button>

                                <button class="add-button" onclick="addOne('<?php echo $row["id"] . "_quantity"; ?>')">
                                    Add One
                                </button>

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

            <form id="order-form" method="post" action="order.php">
                <h4 id="total-price">0</h4>

                <label for="address">What's your address ?</label>
                <input type="text" name="address" value=""/>

                <!-- da modificare -->
                <label for="address">Choose payment type</label>
                <div id="payment-container">
                    <input type="radio" name="payment" value="CARD"/>
                    <input type="radio" name="cash" value="Cash"/>
                </div>

                <input id="submit-button" type="submit" name="order" onclick="saveMap()" value="ORDER"/>
            </form>


            <button onclick="location.href='index.php'">Back to Home</button>
</body>
<script type="text/javascript" src="js/orderHandler.js"></script>
</html>

</html>