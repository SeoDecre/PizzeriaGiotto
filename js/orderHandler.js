
var totalprice=0;

function removeOne(idcounter){
    // funziona solo con l'innerhtml
    var value = parseInt(document.getElementById(idcounter).innerHTML, 10);
    if(value>0){
        document.getElementById(idcounter).innerHTML =parseInt(document.getElementById(idcounter).innerHTML,10)-1;
    }

    calcTotPrice(idcounter,false);

}
function addOne(idcounter){

    // funziona solo con il value
    var value = parseInt(document.getElementById(idcounter).value, 10);
    if(isNaN(value)){
        document.getElementById(idcounter).innerHTML = parseInt(document.getElementById(idcounter).innerHTML,10 )+1;

    }
    calcTotPrice(idcounter,true);
}

function calcTotPrice(idcounter,operation){
    //salva l'id della pizza
    var pizzaId=idcounter.split("_")[0];

    var pizza_price=parseInt(document.getElementById(pizzaId+"_price").innerHTML,10);

    if(operation){// se va aggiunta una pizza
        totalprice+=pizza_price;
    }else{// se va rimossa una pizza
        totalprice-=pizza_price;
    }

    document.getElementById("total-price").innerHTML=totalprice;

}