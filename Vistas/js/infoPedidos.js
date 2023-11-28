"use strict";

const boton = document.getElementById("TerminarPedido");

boton.addEventListener("mouseover",function (event) {
    boton.className = "PushOver";
    //boton.style.color = "wheat";
});

boton.addEventListener("mouseout",function (event) {
    boton.className = "Push";
    //boton.style.color = "white";
});



const boton2 = document.getElementById("AgregarProducto");

boton2.addEventListener("mouseover",function (event) {
    boton2.className = "PushOver";
    //boton.style.color = "wheat";
});

boton2.addEventListener("mouseout",function (event) {
    boton2.className = "Push";
    //boton.style.color = "white";
});
