var svgElement = document.createElementNS("www.w3.org/2000/svg", "svg");
var ajax = new XMLHttpRequest();
ajax.open("GET", "assets/images/sprite.svg", true);
ajax.onload = function() {
    var div = document.createElement("div");
    div.innerHTML = ajax.responseText;
    document.body.insertBefore(div, document.body.childNodes[0]);
}
ajax.send();
