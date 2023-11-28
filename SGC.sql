CREATE DATABASE sgc;
USE sgc;
CREATE TABLE CLIENTES( 
    id INT(255) auto_increment NOT NULL, 
    nombre VARCHAR(100) NOT NULL, 
    pedido MEDIUMTEXT NOT NULL, 
    fecha DATE NOT NULL, 
    quincena DATE NOT NULL, 
    CONSTRAINT pk_Clientes PRIMARY KEY(id) 
) ENGINE=InnoDB; 

CREATE TABLE PRODUCTOS(
    id INT(255) auto_increment NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    precio FLOAT NOT NULL,
    costo_pack VARCHAR(255) NOT NULL,
    existencias INT(255) NOT NULL,
    CONSTRAINT pk_Productos PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE REGISTRO_VENTAS( 
    id INT(255) auto_increment NOT NULL, 
    nombre VARCHAR(100) NOT NULL, 
    pedido MEDIUMTEXT NOT NULL, 
    fecha DATE NOT NULL,  
    CONSTRAINT pk_Clientes PRIMARY KEY(id) 
) ENGINE=InnoDB; 

/*
$sql = "INSERT INTO PRODUCTOS(id, nombre, precio, costo_pack) VALUES(NULL, 'Popetas', '1', '1.5')";

exportar base de datos
*/