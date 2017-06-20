var inputListView = document.getElementById('listView').getElementsByTagName ('input');
var inputBlockView = document.getElementById('blockView').getElementsByTagName ('input');
var list_compare = document.getElementById('compare').getElementsByTagName('ul')[0];
var b_style = document.getElementById('compare').getElementsByTagName('button')[0];
for(var i = 0, l_i = inputListView.length; i < l_i; i++) {
    inputListView[i].addEventListener('click', addToCompare);
    inputBlockView[i].addEventListener('click', addToCompare);
}

function addToCompare(ev) {
    var e = window.event || ev, obj = e.target || e.srcElement;
    if(list_compare.children.length > 0)
        b_style.setAttribute('class', "btn btn-block btn-success");
    var li = document.createElement("li");
    if(list_compare.children.length < 1) {
        li.setAttribute('href', 'list-group-item active');
    }else {
        li.setAttribute('href', 'list-group-item');
    }
    var but = document.createElement("button");
    but.setAttribute('type', 'button');
    but.setAttribute('class', 'btn btn-danger btn-xs');
    but.innerHTML = "x";
    but.setAttribute('name', obj.name);

    var a = document.createElement("a");
    li.appendChild(but);
    var link = obj.name.split(':');
    var input = document.createElement('input');
    input.setAttribute('name', link[1]);
    input.setAttribute('value', link[0]);
    input.setAttribute('class', 'hidden');
    li.appendChild(input);
    a.setAttribute('href', link[1]);
    a.setAttribute('class', 'block link link-default');
    a.innerHTML =  "  " + link[0] + '  ';
    li.appendChild(a);
    list_compare.appendChild(li);
    for (i=0,li=inputListView.length; i<li; i++) {
        if (inputListView[i].getAttribute('name') === obj.name){
            inputListView[i].setAttribute('class', 'hidden');
            inputBlockView[i].setAttribute('class', 'hidden');
        }
    }
    but = document.getElementById('compare').getElementsByTagName('button');
    for(var i = 0, l_a = but.length; i < l_a; i++) {
        but[i].addEventListener('click', moveFromCompare);
    };
};

function moveFromCompare(e) {
    var e = window.event || e, obj = e.target || e.srcElement;
    var li = obj.parentNode;
    for(var i=0, l_i = inputListView.length; i < l_i; i++) {
        var attr = inputListView[i].getAttribute('name');
        if (attr == obj.name){
            inputListView[i].setAttribute("class", "btn btn-primary");
            inputBlockView[i].setAttribute("class", "btn btn-primary");
        }
    }
    list_compare.removeChild(li);
    if(list_compare.children.length == 1) {
        b_style.setAttribute('class', "hidden");
    }
}