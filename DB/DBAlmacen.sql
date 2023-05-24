CREATE DATABASE ALMACEN
USE ALMACEN

--	 TABLAS
CREATE TABLE Personas
(
	idpersona 	INT AUTO_INCREMENT PRIMARY KEY,
	nombres		VARCHAR(30)		NOT NULL,
	apellidos	VARCHAR(30)		NOT NULL,
	telefono		VARCHAR(9)		NOT NULL,
	direccion	VARCHAR(30)		NOT NULL,
	email 		VARCHAR(30)		NOT NULL
)ENGINE = INNODB;



CREATE TABLE Usuarios
(
	idusuario 	INT AUTO_INCREMENT PRIMARY KEY,
	idpersona 	INT 				NOT NULL, -- FK
	usuario		VARCHAR(30) 	NOT NULL,
	claveacceso	VARCHAR(30)		NOT NULL,
	CONSTRAINT fk_idpersona FOREIGN KEY (idpersona) REFERENCES Personas(idpersona)
)ENGINE = INNODB;


CREATE TABLE Proveedores
(
	idproveedor		INT AUTO_INCREMENT PRIMARY KEY,
	idpersona 		INT NOT NULL,
	CONSTRAINT fk_idpersona_provee FOREIGN KEY (idpersona) REFERENCES Personas(idpersona)
)ENGINE = INNODB;


CREATE TABLE Categorias
(
	idcategoria 	INT AUTO_INCREMENT PRIMARY KEY,
	nombrecategoria 	VARCHAR(30) 	NOT NULL
)ENGINE = INNODB;


CREATE TABLE Productos
(
	idproducto 			INT AUTO_INCREMENT PRIMARY KEY,
	idcategoria 		INT 				NOT NULL, -- FK
	nombreproducto		VARCHAR(30) 	NOT NULL,
	descripcion			VARCHAR(100) 	NOT NULL,
	precio				DECIMAL(9,2)	NOT NULL,
	stock					INT 				NOT NULL,
	CONSTRAINT fk_idcatego_produc FOREIGN KEY (idcategoria) REFERENCES Categorias(idcategoria)
)ENGINE = INNODB;


CREATE TABLE Entradas
(
	identrada			INT AUTO_INCREMENT PRIMARY KEY,
	idproveedor 		INT 			NOT NULL, -- FK
	idproducto 			INT 			NOT NULL, -- FK
	fechaentrada		DATETIME 	NOT NULL DEFAULT NOW(),
	cantidadentrada	INT			NOT NULL,
	CONSTRAINT fk_idprovee_entra FOREIGN KEY (idproveedor) REFERENCES Proveedores(idproveedor),
	CONSTRAINT fk_idproduc_entra FOREIGN KEY (idproducto) REFERENCES Productos(idproducto)
)ENGINE = INNODB;


CREATE TABLE Requerimientos
(
	idrequerimiento 		INT AUTO_INCREMENT PRIMARY KEY,
	idproducto				INT 				NOT NULL, -- FK
	nombrerequerimiento	VARCHAR(30)		NOT NULL,
	CONSTRAINT fk_idproduc_reque FOREIGN KEY (idproducto) REFERENCES Productos(idproducto)
)ENGINE = INNODB;


CREATE TABLE Salidas 
(
	idsalida				INT AUTO_INCREMENT PRIMARY KEY,
	idrequerimiento	INT 		NOT NULL, -- FK
	idproducto			INT 		NOT NULL, -- FK
	fechasalida			DATETIME NOT NULL DEFAULT NOW(),
	cantidadsalida		INT 		NOT NULL,
	CONSTRAINT fk_idreque_sali FOREIGN KEY (idrequerimiento) REFERENCES Requerimientos(idrequerimiento),
	CONSTRAINT fk_idproduc_sali FOREIGN KEY (idproducto) REFERENCES Productos(idproducto)
)ENGINE = INNODB;

-- PROCEDIMIENTOS ALMACENADOS

-- ***************************************************************************************************************************************
-- SP DE PERSONAS	
-- LISTAR
DELIMITER $$
CREATE PROCEDURE spu_listar_personas()
BEGIN 
	SELECT * FROM Personas;
END

CALL spu_listar_personas

-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE spu_registrar_personas(
IN _nombres 			VARCHAR(30),
IN _apellidos 			VARCHAR(30),
IN _telefono			VARCHAR(9),
IN _direccion			VARCHAR(30),
IN _email				VARCHAR(30)
)
BEGIN
	INSERT INTO Personas (nombres, apellidos, telefono, direccion, email) VALUES (_nombres, _apellidos, _telefono, _direccion, _email);
END

CALL spu_registrar_personas("Lucio", "Medina Llanos", "970664419", "Jr. Alva maurtua #249", "lucio7329@gmail.com");

-- ***************************************************************************************************************************************
-- SP DE USUARIOS
-- LISTAR
DELIMITER $$
CREATE PROCEDURE spu_listar_usuarios()
BEGIN 
	SELECT * FROM Usuarios;
END

CALL spu_listar_usuarios

-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE spu_registrar_usuarios(
    IN _idpersona INT,
    IN _usuario VARCHAR(30),
    IN _claveacceso VARCHAR(30)
)
BEGIN
    DECLARE user_count INT;
    SELECT COUNT(*) INTO user_count FROM Usuarios WHERE usuario = _usuario;
    
    IF user_count > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Este usuario ya está registrado.';
    ELSE
        INSERT INTO Usuarios (idpersona, usuario, claveacceso) VALUES (_idpersona, _usuario, _claveacceso);
    END IF;
END$$

CALL spu_registrar_usuarios(1, "Lucio", "lucio17")


-- ***************************************************************************************************************************************
-- SP DE CATEGORIAS
-- LISTAR
DELIMITER $$
CREATE PROCEDURE spu_listar_categorias()
BEGIN 
	SELECT * FROM Categorias;
END

CALL spu_listar_categorias

-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE spu_registrar_categorias(
IN _nombrecategoria		VARCHAR(30)
)
BEGIN
	INSERT INTO Categorias (nombrecategoria) VALUES (_nombrecategoria);
END

CALL spu_registrar_categorias("Electrodomésticos")

-- ***************************************************************************************************************************************
-- SP DE PRODUCTOS
-- LISTAR
/*
DELIMITER $$
CREATE PROCEDURE spu_listar_productos()
BEGIN 
	SELECT * FROM Productos;
END
*/

DELIMITER $$
CREATE PROCEDURE spu_listar_productos()
BEGIN
    SELECT P.*, C.nombrecategoria
    FROM Productos P
    INNER JOIN Categorias C ON P.idcategoria = C.idcategoria;
END $$

CALL spu_listar_productos

-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE spu_registrar_productos(
IN _idcategoria		INT,
IN _nombreproducto	VARCHAR(30),
IN _descripcion 		VARCHAR(100),
IN _precio				DECIMAL(9,2),
IN _stock				INT
)
BEGIN
	INSERT INTO Productos(idcategoria, nombreproducto, descripcion, precio, stock) VALUES (_idcategoria, _nombreproducto, _descripcion, _precio, _stock);
END

CALL spu_registrar_productos(1, "Balón de fútbol", "Balón del mundial de Rusia 2018", 100, 30)

-- ELIMINAR
DELIMITER $$
CREATE PROCEDURE spu_eliminar_productos(
	IN _idproducto INT
)
BEGIN
	DELETE FROM Productos WHERE idproducto = _idproducto;
END $$

CALL spu_eliminar_productos(4)

-- ACTUALIZAR
DELIMITER $$
CREATE PROCEDURE spu_actualizar_productos(
	IN _idproducto			INT,
	IN _nombreproducto 	VARCHAR(30),
	IN _descripcion		VARCHAR(100),
	IN _precio				DECIMAL(5,2),
	IN _stock 				INT
)
BEGIN
	UPDATE Productos SET
		nombreproducto = _nombreproducto,
		descripcion = _descripcion,
		precio = _precio,
		stock = _stock
	WHERE idproducto = _idproducto;
END $$

CALL spu_actualizar_productos()

-- OBTENER (Buscador)
DELIMITER $$
CREATE PROCEDURE spu_obtener_productos(
	IN _idproducto 	INT
)
BEGIN
	SELECT * FROM Productos WHERE idproducto = _idproducto;
END $$

CALL spu_obtener_productos(2)

-- LOGIN	
DELIMITER $$
CREATE PROCEDURE spu_verificar_usuarios(
	IN _usuario 	VARCHAR(30),
	IN _claveacceso VARCHAR(30)
)
BEGIN
	SELECT * FROM Usuarios WHERE usuario = _usuario AND claveacceso = _claveacceso;
END $$



