-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS gestion_usuarios;

-- Seleccionar la base de datos
USE gestion_usuarios;

-- Crear la tabla 'Perfiles'
CREATE TABLE IF NOT EXISTS Perfiles (
    Id_perfil INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_perfil VARCHAR(100) NOT NULL
);

-- Crear la tabla 'Accesos'
CREATE TABLE IF NOT EXISTS Accesos (
    Id_acceso INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_acceso VARCHAR(100) NOT NULL
);

-- Crear la tabla 'Permisos'
CREATE TABLE IF NOT EXISTS Permisos (
    Id_permisos INT AUTO_INCREMENT PRIMARY KEY,
    Id_perfil INT NOT NULL,
    Id_acceso INT NOT NULL,
    Puede_crear BOOLEAN DEFAULT 0,
    Puede_leer BOOLEAN DEFAULT 0,
    Puede_actualizar BOOLEAN DEFAULT 0,
    Puede_borrar BOOLEAN DEFAULT 0,
    FOREIGN KEY (Id_perfil) REFERENCES Perfiles(Id_perfil) ON DELETE CASCADE,
    FOREIGN KEY (Id_acceso) REFERENCES Accesos(Id_acceso) ON DELETE CASCADE
);

-- Crear la tabla 'Usuarios'
CREATE TABLE IF NOT EXISTS Usuarios (
    Id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_usuario VARCHAR(100) NOT NULL,
    Contraseña VARCHAR(255) NOT NULL,
    Id_perfil INT NOT NULL,
    FOREIGN KEY (Id_perfil) REFERENCES Perfiles(Id_perfil) ON DELETE CASCADE
);

-- Insertar algunos perfiles
INSERT INTO Perfiles (Nombre_perfil) VALUES ('Administrador');
INSERT INTO Perfiles (Nombre_perfil) VALUES ('Editor');
INSERT INTO Perfiles (Nombre_perfil) VALUES ('Usuario');

-- Insertar algunos accesos
INSERT INTO Accesos (Nombre_acceso) VALUES ('Modulo A');
INSERT INTO Accesos (Nombre_acceso) VALUES ('Modulo B');
INSERT INTO Accesos (Nombre_acceso) VALUES ('Modulo C');

-- Insertar algunos permisos
INSERT INTO Permisos (Id_perfil, Id_acceso, Puede_crear, Puede_leer, Puede_actualizar, Puede_borrar) 
VALUES (1, 1, 1, 1, 1, 1);  -- El Administrador tiene permisos completos en Modulo A

INSERT INTO Permisos (Id_perfil, Id_acceso, Puede_crear, Puede_leer, Puede_actualizar, Puede_borrar) 
VALUES (2, 2, 0, 1, 1, 0);  -- El Editor tiene permisos de leer y actualizar en Modulo B

INSERT INTO Permisos (Id_perfil, Id_acceso, Puede_crear, Puede_leer, Puede_actualizar, Puede_borrar) 
VALUES (3, 3, 0, 1, 0, 0);  -- El Usuario solo puede leer en Modulo C

-- Insertar algunos usuarios
INSERT INTO Usuarios (Nombre_usuario, Contraseña, Id_perfil) 
VALUES ('Admin', 'Admin', 1);

INSERT INTO Usuarios (Nombre_usuario, Contraseña, Id_perfil) 
VALUES ('editor', 'editor', 2);

INSERT INTO Usuarios (Nombre_usuario, Contraseña, Id_perfil) 
VALUES ('usuario', 'usuario', 3);
