var button = document.getElementsByClassName('sort')[0].getElementsByTagName('button');
for(var i = 0, bl = button.length; i < bl; i++) {
    button[i].addEventListener('click', doSort);
}

function doSort(ev) {
    var e = window.event || ev, obj = e.target || e.srcElement;
    var param = obj.getAttribute('id');
    var method = param.slice(param.length-1,param.length);
    param = param.slice(0,-1);
    var row = document.getElementById('listView').getElementsByClassName('row');
    var block = document.getElementById('blockView').getElementsByTagName('li');
    var parentRow = row[0].parentNode;
    var parentBlock = block[0].parentNode;
    var tempRow = [];
    var tempBlock = [];
    var titleArray = [];
    var priceArray = [];
    for(var i=0, rowl= row.length; i<rowl; i++) {
        var title = row[i].getElementsByTagName('h5');
        var price = block[i].getElementsByClassName('price')[0].innerHTML;
        price = price.slice(0, price.length-2);
        titleArray[i] = title[0].innerHTML;
        priceArray[i] = price;
    }
    titleArray.sort();
    priceArray.sort(compareReversed);
    if(method !== 'A') {
        titleArray.reverse();
        priceArray.reverse();
    }
    if(param === 'name') {
        for(var i=0, titleArrayl=titleArray.length; i<titleArrayl; i++){
            for(var j=0; j<row.length; j++) {
                if(titleArray[i] === row[j].getElementsByTagName('h5')[0].innerHTML ) {
                    tempRow[i] = row[j];
                    tempBlock[i] = block[j];
                    parentRow.removeChild(row[j]);
                    parentBlock.removeChild(block[j]);
                }
            }
        }
        for (var i=0, templ=tempRow.length; i<templ; i++){
            parentRow.appendChild(tempRow[i]);
            parentBlock.appendChild(tempBlock[i]);
        }
    } else {
        for(var i=0, priceArrayl=priceArray.length; i<priceArrayl; i++){
            for(var j=0; j<row.length; j++) {
                price = block[j].getElementsByClassName('price')[0].innerHTML;
                price = price.slice(0, price.length-2);
                if(priceArray[i] === price) {
                    tempRow[i] = row[j];
                    tempBlock[i] = block[j];
                    parentRow.removeChild(row[j]);
                    parentBlock.removeChild(block[j]);
                }
            }
        }
        for (var i=0, templ=tempRow.length; i<templ; i++){
            parentRow.appendChild(tempRow[i]);
            parentBlock.appendChild(tempBlock[i]);
        }
    }
}
function compareReversed(a, b) {
    return a - b;
}