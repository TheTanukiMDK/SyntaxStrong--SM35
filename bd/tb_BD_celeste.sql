CREATE DATABASE SintaxStrong;

USE SintaxStrong;

CREATE TABLE tb_admin (
    id_admin INT PRIMARY KEY AUTO_INCREMENT,
    usuername VARCHAR(20),
    correo_electronico VARCHAR(25),
    pwd VARCHAR(6)
);

CREATE TABLE tb_clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    ap_paterno VARCHAR(50) NOT NULL,
    ap_materno VARCHAR(50) NOT NULL,
    curp VARCHAR(18) NOT NULL UNIQUE,
    fecha_na DATE NOT NULL,
    num_celular VARCHAR(10) NOT NULL,
    sexo ENUM('femenino', 'masculino') NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tb_membresia (
    id_membresia INT PRIMARY KEY AUTO_INCREMENT,
    tipo_membresia ENUM('basico', 'premiun', 'senior'),
    precio DECIMAL(5,2)
);

CREATE TABLE tb_estatus (
    id_estatus INT PRIMARY KEY AUTO_INCREMENT,
    estatus ENUM('activo', 'vencido', 'cancelado')
);

CREATE TABLE tb_inscripcion (
    id_inscripcion INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_membresia INT NOT NULL,
    fecha_inicio DATE, -- Cambiado de TIME a DATE
    fecha_fin DATE, -- Cambiado de TIME a DATE
    id_estatus INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES tb_clientes(id), -- Referencia corregida a tb_clientes(id)
    FOREIGN KEY (id_membresia) REFERENCES tb_membresia(id_membresia),
    FOREIGN KEY (id_estatus) REFERENCES tb_estatus(id_estatus)
);
-.