<?php
include_once("connection.php");
session_start();
//aggiunta di un controllo che ridirige alla pagina iniziale
$connect = getMysqli() or die("Database non trovato");

$connection = $_SESSION['connection'] or die("non è presente alcuna connessione col db");

if (isset($_POST["order"])) {

    $userId = $_SESSION["id"] or die("Errore, l'id dell'utente non è stato trovato"); //id user nel db

    //salvo le pizze contenute nell'ordine
    $pizzaList = json_decode($_POST["pizzaList"], true);

    //prezzo totale "calcolato" nel "order.php"
    //quando si clicca il bottone "order" nella schermata "order.php"
    $total = $_POST["totalPrice"];

    //salvo il timestamp dell'ordine
    $timestamp = new DateTime();

    //formatto la data
    $timestamp = $timestamp->format("Y-m-d H:i:s");

    $location = $_POST["address"];

    $status = "delivering";

    //to fix , è necessario controllare a modo i metodi di pagamento all'interno del form

    $payment = $_POST["payment"];

    //aggiunge l'ordine
    $addOrder = "INSERT INTO Orders (amount, time, delivery_address, status, payment_type, FK_users) VALUES
                                                                                               ('$total', '$timestamp', '$location', '$status', '$payment', '$userId')";
    //invia la query
    $connect->query($addOrder);

    // ottiene l'id dell'ordine
    $idOrder = getIdOrder($connect, $timestamp, $userId);

    //manca la ricerca del id dell'ordine, così anche per le pizze

    //scorre tutto l'array per raccogliere i dati delle pizze così da aggiungerli alla
    //tabella "order_products"
    //associa ogni pizza dell'ordine all'ordine stesso in cui sono richieste

    $query = "INSERT INTO Orders_Products (FK_orders, FK_products,quantity) VALUES";
var_dump($pizzaList);
    for ($i = 0; $i < sizeof($pizzaList); $i++) {
        $pizzaId = $pizzaList[$i][0];
        $pizzaQuantity = $pizzaList[$i][1];

        $query .= "($idOrder,$pizzaId,$pizzaQuantity)";

        if($i+1<sizeof($pizzaList)){
            $query.=",";
        }
    }
    //invia la query al server
    $connect->query($query);

    //invio conferma all'utente
    echo '<script type="text/javascript"> alert("L\'ordine è stato inoltrato con successo !"); window.location.href = "index.php";</script>';

    //resetta l'array "$_POST"
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
    <section id="order">
        <div class="content">
            <!-- Menu scroller -->
            <div class="products-container">
                <p class="medium-text">MAKE YOUR ORDER</p>
                <?php
                include_once('pizza_menu.php');

                $result = getPizzaMenu();

<!-- Order section -->
<section id="order">
    <div class="content">
        <p class="medium-text">MAKE YOUR ORDER</p>

        <!-- Menu carousel -->
        <?php
        include_once('menu.php');

        $result = getMenu();
        if (!$result) {
            echo 'Error: ' . mysqli_errno() . ' - ' . mysqli_error();
        }

        // Horizontal products scroller
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

        <!-- Cart -->
        <div id="cart-total-container">
            <form id="order-form" method="post" action="order.php">
                <h4 id="total-price">0</h4>
                <label for="address">What's your address ?</label>
                <input type="text" name="address" value=""/>
                <input id="submit-button" type="submit" name="order" onclick="saveMap()" value="ORDER"/>
            </form>
        </div>
    </div>
</section>



<!-- Order section -->
<section id="order">
        <!-- Menu carousel -->
            <p class="medium-text">MAKE YOUR ORDER</p>

            <div class="pizza-menu-container">
                <?php
                include_once("menu.php");

                $connection = getMenu();
                // Stampa delle pizze = ok
                $i = 0;
                while ($row = $connection->fetch_assoc()) {
                    ?>
                    <!-- codice da modificare-->
                    <div class="pizza-menu-element">
                        <img class="pizza-menu-img" src="<?php echo $row["img_dir"]; ?>"/><br>
                        <div class="pizza-menu-info">
                            <h4 class="pizza-menu-name" name="name"><?php echo $row["name"]; ?></h4>
                            <h4 class="pizza-menu-descript" name="description"><?php echo $row["description"]; ?></h4>
                            <h4 id="price-currency">$</h4><h4 id="<?php echo $row["id"] ?>_price" name="price"><?php echo number_format($row["price"], 2); ?></h4>
                            <h4 type="text" id="<?php echo $row["id"] ?>_quantity">0</h4> <!--- quantità della pizza-->
                            <div class="pizza-menu-buttons">
                                <button class="remove-button" onclick="removeOne('<?php echo $row["id"] . "_quantity"; ?>')">Remove One</button>
                                <button class="add-button" onclick="addOne('<?php echo $row["id"] . "_quantity"; ?>')">Add One</button>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                ?>

            </div>

            <!-- Cart -->
            <div id="cart-total-container">
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
            </div>
<section/>

<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="js/orderHandler.js"></script>
</body>
</html>