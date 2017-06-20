var basket = {};
$('document').ready(function () {
    checkBasket();
    modifyBasket();
    // var nasklade = document.getElementsByTagName('h4');
    // console.log(nasklade);
})

function modifyBasket() {
    $('.plus').on('click', plusGoods);
    $('.minus').on('click', minusGoods);
    $('.remove').on('click', removeGoods);
    $('.order').on('click', function () {
        localStorage.clear();
    });
    $('#clearBasket').on('click',function () {
        localStorage.clear();
        location.reload();
        basket['count'] = 0;
        basket['price'] = 0;
        showBasket();
    });

    var newCount = document.getElementById('newCount');

    function plusGoods() {
        var articul = $(this).attr('data-article');
        var inp = document.getElementById('appendedInputButtons'+ articul);
        var number = inp.getAttribute('placeholder');
        var sum = $(this).attr('data-sum');
        if (number < sum) {
            number++;
            inp.setAttribute('placeholder', number);
            var price = $(this).attr('data-price');
            basket['count']++;
            newCount.innerHTML = basket['count'];
            basket['price'] = basket['price'] + Number(price);
            basket[articul]++;
            localStorage.setItem('basket', JSON.stringify(basket));
            showBasket();
        }
    }

    function minusGoods() {
        var articul = $(this).attr('data-article');
        console.log(articul);
        var inp = document.getElementById('appendedInputButtons'+articul);
        var number = inp.getAttribute('placeholder');
        var price = $(this).attr('data-price');
        basket['price'] = basket['price'] - Number(price);
        basket['count']--;
        newCount.innerHTML = basket['count'];
        basket[articul]--;
        localStorage.setItem('basket', JSON.stringify(basket));
        if (number>1) {
            number--;
            inp.setAttribute('placeholder', number);
        } else{
            var tr = document.getElementById('remove-tr'+articul);
            delete basket[articul];
            localStorage.setItem('basket', JSON.stringify(basket));
            var par = tr.parentNode;
            par.removeChild(tr);
        }
        showBasket();
    }

    function removeGoods() {
        var articul = $(this).attr('data-article');
        var inp = document.getElementById('appendedInputButtons'+articul);
        var number = inp.getAttribute('placeholder');
        basket['count'] = basket['count'] - Number(number);
        newCount.innerHTML = basket['count'];
        var price = $(this).attr('data-price');
        basket['price'] = basket['price'] - Number(price)*Number(number);
        basket[articul] = 0;
        var tr = document.getElementById('remove-tr'+articul);
        var par = tr.parentNode;
        par.removeChild(tr);
        delete basket[articul];
        localStorage.setItem('basket', JSON.stringify(basket));
        showBasket();
    }
}