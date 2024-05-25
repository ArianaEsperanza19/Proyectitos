/*
Serie de Fibonacci.
Crear un programa que permita al usuario introducir un numero y se reproducira esa cantidad de numeros
de la secuencia de Fibonacci.
*/
"use strict";
let numero = 12;

function Fibonacci(numero){
    let a = 1;
    let b = 1;
    for(let i=0; i< numero; i++){
        let c = a + b
        console.log(a, " ");
        a = b;
        b = c;
    }
}

Fibonacci(numero);