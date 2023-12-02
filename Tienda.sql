CREATE DATABASE Digitienda;
USE Digitienda;

DROP TABLE Producto;

CREATE TABLE Usuarios( 
    id INT(255) auto_increment NOT NULL, 
    nombre VARCHAR(100) NOT NULL, 
    apellido VARCHAR(100), 
    rol VARCHAR(20) NOT NULL, 
    email VARCHAR(255) NOT NULL, 
    contrasenya VARCHAR(255) NOT NULL, 
    permisos INT(10) NOT NULL, 
    CONSTRAINT pk_Usuarios PRIMARY KEY(id), 
    CONSTRAINT uq_email UNIQUE(email)
) ENGINE=InnoDB; 

CREATE TABLE Categorias( 
    id INT(255) auto_increment NOT NULL, 
    nombre VARCHAR(100) NOT NULL,
    CONSTRAINT pk_Categorias PRIMARY KEY(id)
) ENGINE=InnoDB; 

CREATE TABLE Productos(
    id INT(255) auto_increment NOT NULL, 
    categoria_id INT(255) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    precio FLOAT(255, 2) NOT NULL,
    descripcion MEDIUMTEXT NOT NULL,
    stock INT(100) NOT NULL,
    imagen VARCHAR(255),
    CONSTRAINT pk_Productos PRIMARY KEY(id),
    CONSTRAINT pf_Productos FOREIGN KEY(categoria_id) REFERENCES Categorias(id)
)ENGINE=InnoDB; 

CREATE TABLE Pedidos(
    id INT(255) auto_increment NOT NULL, 
    usuario_id INT(255) NOT NULL,
    provincia VARCHAR(100),
    localidad VARCHAR(100),
    direccion VARCHAR(255),
    zipCode INT(255),
    coste FLOAT(255,2),
    fecha DATE NOT NULL,
    numero INT(255),
    status VARCHAR(20) NOT NULL,
    CONSTRAINT pk_Pedidos PRIMARY KEY(id), 
    CONSTRAINT pf_Pedidos FOREIGN KEY(usuario_id) REFERENCES Usuarios(id)
) ENGINE=InnoDB; 

CREATE TABLE Lineas_Pedidos( 
    id INT(255) auto_increment NOT NULL, 
    pedido_id INT(255) NOT NULL,    
    producto_id INT(255) NOT NULL,
    unidades INT(255) NOT NULL,
    CONSTRAINT pk_Lineas PRIMARY KEY(id),
    CONSTRAINT pf_pedido FOREIGN KEY(pedido_id) REFERENCES Pedidos(id),
    CONSTRAINT pf_producto FOREIGN KEY(producto_id) REFERENCES Productos(id)
) ENGINE=InnoDB; 