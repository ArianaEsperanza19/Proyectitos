#include <iostream>  //Inclusion de la libreria iostream
using namespace std;  //Inclusion del espacio de nombres std

/*
Serie de Fibonacci.
Crear un programa que permita al usuario introducir un numero y se reproducira esa cantidad de numeros
de la secuencia de Fibonacci.
*/

int fibonacci(int num){
    
    int a = 0;
    int b = 1;
    std::cout << "La serie de Fibonacci es: "<< endl;
    for(int i = 0; i <= num; i++){
        int c = a + b;
        std::cout << a << " ";
        a = b;
        b = c;
    }
    std::cout<< "" << endl;
}

int main() {

    int entrada;
    std::cout << "Por favor, ingrese un número: ";
    std::cin >> entrada;
    fibonacci(entrada);

    return 0;
}

