#include<iostream>   //Inclusion de la libreria iostream
using namespace std;  //Inclusion del espacio de nombres std

//chmod +x ./AnyoBisiesto
//./AnyoBisiesto

bool bisiesto(int);
/*
tengo un programa de c++ pero cuando pide los datos con este codigo:
  int year;
    cout << "Introduzca una fecha de cuatro digitos: ";
    cin >> year;
no me permite ingresar informacion por consola.
*/
int main(){

    int year;
    cout << "Introduzca una fecha de cuatro digitos: ";
    cin >> year;
    cout << endl;
    system("clear");

    if(bisiesto(year)){
        cout << year << " El anyo es bisiesto." << endl;
    }else{
        cout << year << " El anyo NO es bisiesto." << endl;
    }

    return 0;

}

bool bisiesto( int year )
// Bisiesto regresa verdadero si year es un año bisiesto y
// falso en cualquier otro caso.
{
if (year % 4 != 0)
return false;
else if (year % 100 != 0)
return true;
else if (year % 400 != 0)
return false;
else
return true;
// ¿Year no es divisible entre 4?
// Si es así, no puede ser bisiesto
// ¿Year no es múltiplo de 100?
// Si es así, es año bisiesto
// ¿Year no es múltiplo de 400?
// Si es así, entonces no es año bisiesto
// Es un año bisiesto
}
