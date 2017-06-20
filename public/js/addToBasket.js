var basket = {};
$('document').ready(function () {
    basket['price'] = 0;
    basket['count'] = 0;
    checkBasket();
    showBasket();
    var button = $('button.add-to-basket');
    var sumProduct = $('span.sumProduct');
    for (var i=0, butL = button.length; i<butL; i++){
        var product = button[i].getAttribute('data-atr');
        var value = button[i].getAttribute('value');
        var newSum = value;
        value = value.split(':')[0];
        newSum = newSum.split(':')[1];
        for (var property in basket){
            if (product === property){
                newSum = newSum - basket[property];
                button[i].setAttribute('value', value + ':' + newSum);
                if(newSum == 0){
                    var clas = button[i].getAttribute('class');
                    button[i].setAttribute('class', clas + ' hidden');
                }
            }
        }
    }
})

$('button.add-to-basket').on('click', addToBasket);

function addToBasket() {
    //товар в корзину
    var id = $(this).attr('data-atr');
    var value = $(this).attr('value');
    var sum = value;
    sum = sum.split(':');
    var price = $(this).attr('price');
    if (basket[id] != undefined) {
        basket[id]++;
    } else {
        basket[id] = 1;
    }
    sum[1]--;
    this.setAttribute('value', sum[0] + ":" + sum[1]);
    basket['price'] = basket['price'] + Number(price);
    basket['count']++;
    if (sum[1] === 0){
        var clas = this.getAttribute('class');
        this.setAttribute('class', clas + ' hidden');
    }
    localStorage.setItem('basket', JSON.stringify(basket));
    showBasket();
}
// }
// function addToBasket() {
//     //товар в корзину
//     var id = $(this).attr('data-atr');
//     var value = $(this).attr('value');
//     var arr = value.split(':');
//     var price = arr[0];
//     var sum = arr[1];
//     if(basket[id] !=  undefined){
//         basket[id]++;
//     } else {
//         basket[id] = 1;
//     }
//     sum--;
//     console.log(this);
//     this.setAttribute('value', price + ":" + sum)
//     basket['price'] = basket['price'] + Number(price);
//     basket['count']++;
//     localStorage.setItem('basket',JSON.stringify(basket));
//     console.log(localStorage);
//     showBasket();
// }

function checkBasket() {
    //проверка наличия корзины в localStorage
    if(localStorage.getItem('basket') != null) {
        basket = JSON.parse(localStorage.getItem('basket'));
    }
}

function showBasket() {
    //прорисовка таблицы
    $('#countBasketProduct').html(basket['count']);
    $('#basketSum').html(basket['price']);
    var inp = document.getElementById('basketData');
    inp.setAttribute('value',JSON.stringify(basket));
}
