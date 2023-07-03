/*
Revisar el arreglo inicial devolver un arreglo con los dos numeros que sumados den igual a 10
[3, 5, 7, 1, 4] => [3, 7]
*/
import * as ts from 'typescript';
//let numeros : number[] = [3, 7, 8, 2];
let numeros: number[] = [4, 5, 9, 1];
//let numeros: number[] = [1, 2, 3, 4];
let comparador: number = 10;
//Repasar todos los numeros.
//En cada iteracion tomar un numero y sumarlo con todos los siguientes.
//Mientras el resultado sea diferente de 10, no guardar el numero de la iteracion y su compa;ero

const sumarDos = (comparador: number = 10, arreglo: number[]) => {
    let sumandos: number[] = [];
    let html: string = `<h1>Titulo</h1>`;
    document.write(html);
    arreglo.forEach((i) => {
        document.write(
            `<h1 style='border: solid 1px black; padding: 5px; width: 20px'>` +
            i.toString() +
            `</h1>`
        );

        arreglo.forEach((j) => {
            if ((j + i) !== comparador) {
                document.write(`<h3>` + i + ` + ` + j + ` es igual a: ` + (i + j) + `</h3>`);
            }

            if (j !== i) {
                if ((i + j) === comparador) {

                    if (i !== j) {
                        document.write(`<h2>` + i + ` + ` + j + ` es igual a: ` + (i + j) + `</h2>`);
                        sumandos.push(i);
                        sumandos.push(j);
                    }
                }
            } else {
                document.write(`Los numeros ${i} y ${j} son iguales y por lo tanto no son validos`);
            }

        });
    });

    document.write(
        `<h1>Los numeros que sumados dan 10 por resultado son: ${sumandos[0]} y ${sumandos[1]}` +
        `</h1>`
    );
};

sumarDos(comparador, numeros);
