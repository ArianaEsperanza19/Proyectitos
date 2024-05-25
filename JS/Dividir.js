/*
Dividir un numero sin usar el simbolo de division ni multiplicacion.

1. Método de la resta repetida:

Este método se basa en la idea de restar repetidamente el divisor del dividendo hasta que el 
dividendo sea menor que el divisor. El cociente de la división será el número de veces que se ha 
restado el divisor, y el residuo será la cantidad restante del dividendo.

dividendo
divisor 

cociente
residuo
*/
"use strict";

let dividendo = 54;
let divisor = 7;

let cociente = 0;
let residuo = dividendo;


while(residuo >= divisor){
    dividendo -= divisor;
    residuo = dividendo;    
    cociente++;
}




console.log("El cociente es: ", cociente);
console.log("El residuo es: ", residuo);