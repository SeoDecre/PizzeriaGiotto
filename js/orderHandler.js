var totalprice = 0;
var pizzaContainer = new Map();

//viene richiamato per riprendere l'id della pizza a partire dell'identificativo del counter
//es 11_counter --> id pizza : 11
function getPizzaId(idcounter) {
    return idcounter.split("_")[0];
}

//utilizzata per rimuovere una pizza dall'ordine
function removeOne(idcounter) {
    // funziona solo con l'innerhtml
    var value = parseInt(document.getElementById(idcounter).innerHTML, 10);
    let pizzaId = getPizzaId(idcounter);

    if (value > 0) {
        document.getElementById(idcounter).innerHTML = parseInt(document.getElementById(idcounter).innerHTML, 10) - 1;
        pizzaContainer.set(pizzaId, document.getElementById(idcounter).innerHTML); //decrementa il quantitativo la pizza all'interno dell'hashmap
    }

    calcTotPrice(idcounter, false);

}
//utilizzata per aggiungere una pizza dall'ordine
function addOne(idcounter) {

    // funziona solo con il value
    var value = parseInt(document.getElementById(idcounter).value, 10);

    var pizzaId = getPizzaId(idcounter);

    if (isNaN(value)) {
        document.getElementById(idcounter).innerHTML = parseInt(document.getElementById(idcounter).innerHTML, 10) + 1;

        pizzaContainer.set(pizzaId, document.getElementById(idcounter).innerHTML); //aggiunge e incrementa il quantitativo la pizza all'interno dell'hashmap
    }
    calcTotPrice(idcounter, true);
}

//utilizzata per aggionare il prezzo dell'ordine e per memorizzare il numero delle pizze che si vuol
//richiedere nell'ordine

function calcTotPrice(idcounter, operation) {
    //salva l'id della pizza
    var pizzaId = getPizzaId(idcounter);

    let pizza_price = parseFloat(document.getElementById(pizzaId + "_price").innerHTML).toFixed(2);

    if (operation) {// se va aggiunta una pizza
        totalprice += pizza_price;
    } else {// se va rimossa una pizza
        totalprice -= pizza_price;
    }

    document.getElementById("total-price").innerHTML = totalprice;

}

// utilizzata per inoltrare nella richiesta POST anche il prezzo totale e l'array delle pizze selezionate

function saveMap() {

    //invio dei dati con la generazione del tag input
    //richiamo il form dal DOM della pagina
    var form =document.getElementById("order-form");

    //Creo il tag 'input' contenente il valore della spesa totale
    var totalPrice=document.createElement('input');

    //Aggiungo l'attributo 'name' al tag 'input'
    totalPrice.name="totalPrice";
    //rendo nascosto il tag
    totalPrice.type="hidden";

    //memorizzo la spesa totale dell'ordine
    totalPrice.value=document.getElementById("total-price").innerHTML;


    //Creo il tag 'input' contenente il json dell'hashmap contente tutte le pizze inserite
    //all'interno dell'ordine
    var pizzaListTag=document.createElement('input');

    //Aggiungo l'attributo 'name' al tag 'input'
    pizzaListTag.name="pizzaList";
    //rendo nascosto il tag
    pizzaListTag.type="hidden";



    // memorizzo l'hashmap all'interno del tag
    pizzaListTag.value=  JSON.stringify(Array.from(pizzaContainer.entries()));

    form.appendChild(totalPrice);
    form.appendChild(pizzaListTag);

}