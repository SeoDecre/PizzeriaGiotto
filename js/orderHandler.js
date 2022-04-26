let priceAmount = 0;
let productsCart = new Map();

// Function used to get a product id number starting from its HTML id name
function getProductId(idCounter) {
    return idCounter.split("-")[0];
}

// Function used to add a product to the cart
function addOne(counterId) {
    let value = parseInt(document.getElementById(counterId).value, 10);
    let productId = getProductId(counterId);

    if (isNaN(value)) {
        document.getElementById(counterId).innerHTML = parseInt(document.getElementById(idcounter).innerHTML, 10) + 1;
        productsCart.set(productId, value); // Updating the amount in the hashmap
        computeTotalPrice(productId, "add");
    }
}

// Function used to remove a product from the cart
function removeOne(counterId) {
    let value = parseInt(document.getElementById(counterId).innerHTML, 10);
    let productId = getProductId(counterId);

    if (value > 0) {
        document.getElementById(counterId).innerHTML = parseInt(document.getElementById(idcounter).innerHTML, 10) - 1;
        productsCart.set(productId, value); // Updating the amount in the hashmap
        computeTotalPrice(productId, "remove");
    }
}

// Function used to update the order price amount
function computeTotalPrice(productId, operation) {
    let productPrice = parseFloat(parseFloat(document.getElementById(productId + "-price").innerHTML).toFixed(2));

    if (operation === "add") {
        priceAmount += productPrice;
        parseFloat(priceAmount).toFixed(2);
    } else if (operation === "remove") {// se va rimossa una pizza
        priceAmount -= productPrice;
        parseFloat(priceAmount).toFixed(2);
    }

    document.getElementById("total-price").innerHTML = parseFloat(totalprice).toFixed(2);
}

// Function used to send the POST order request
function saveMap() {
    // Taking the form from the page DOM
    let form = document.getElementById("order-form");

    // Input tag creation, it contains the spent amount
    let totalPrice = document.createElement('input');

    totalPrice.name = "totalPrice";
    totalPrice.type = "hidden";

    // Storing the spent amount in the order
    totalPrice.value = document.getElementById("total-price").innerHTML;

    // Input tag creation, it contains the json hashmap with all the ordered products
    let pizzaListTag = document.createElement('input');

    pizzaListTag.name = "pizzaList";
    pizzaListTag.type = "hidden";

    // Tag hashmap memorization
    pizzaListTag.value = JSON.stringify(Array.from(productsCart.entries()));

    form.appendChild(totalPrice);
    form.appendChild(pizzaListTag);
}