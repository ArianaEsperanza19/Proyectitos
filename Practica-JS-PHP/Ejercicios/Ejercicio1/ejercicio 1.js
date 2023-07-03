/*
Revisar el arreglo inicial devolver un arreglo con los dos numeros que sumados den igual a 10
[3, 5, 7, 1, 4] => [3, 7]
*/
//let numeros : number[] = [3, 7, 8, 2];
var numeros = [4, 5, 9, 1];
//let numeros: number[] = [1, 2, 3, 4];
var comparador = 10;
//Repasar todos los numeros.
//En cada iteracion tomar un numero y sumarlo con todos los siguientes.
//Mientras el resultado sea diferente de 10, no guardar el numero de la iteracion y su compa;ero
var sumarDos = function (comparador, arreglo) {
    if (comparador === void 0) { comparador = 10; }
    var sumandos = [];
    var html = "<h1>Titulo</h1>";
    document.write(html);
    arreglo.forEach(function (i) {
        document.write("<h1 style='border: solid 1px black; padding: 5px; width: 20px'>" +
            i.toString() +
            "</h1>");
        arreglo.forEach(function (j) {
            if ((j + i) !== comparador) {
                document.write("<h3>" + i + " + " + j + " es igual a: " + (i + j) + "</h3>");
            }
            if (j !== i) {
                if ((i + j) === comparador) {
                    if (i !== j) {
                        document.write("<h2>" + i + " + " + j + " es igual a: " + (i + j) + "</h2>");
                        sumandos.push(i);
                        sumandos.push(j);
                    }
                }
            }
            else {
                document.write("Los numeros ".concat(i, " y ").concat(j, " son iguales y por lo tanto no son validos"));
            }
        });
    });
    document.write("<h1>Los numeros que sumados dan 10 por resultado son: ".concat(sumandos[0], " y ").concat(sumandos[1]) +
        "</h1>");
};
sumarDos(comparador, numeros);
