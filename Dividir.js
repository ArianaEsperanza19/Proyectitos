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


/*
2. Método de la aproximación sucesiva:

Este método se basa en la idea de aproximar el cociente de la división dividiendo el dividendo 
por una potencia del divisor lo más cercana posible sin excederlo. Luego, se multiplica el 
cociente por esa potencia del divisor y se resta del dividendo para obtener el residuo. 
El proceso se repite hasta que el residuo sea menor que el divisor.


divisor = 7
dividendo = 54

potencia = 1

cociente = 0
residuo = dividendo

while residuo >= divisor:
  potencia *= 2
  aproximacion = dividendo // potencia

  if aproximacion > 0:
    cociente += aproximacion
    residuo -= aproximacion * potencia

print("Cociente:", cociente)  # Resultado: 7
print("Residuo:", residuo)   # Resultado: 0
*/


console.log("El cociente es: ", cociente);
console.log("El residuo es: ", residuo);