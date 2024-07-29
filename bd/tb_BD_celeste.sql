CREATE DATABASE SintaxStrong;

USE SintaxStrong;

-- ADMINISTRADOR -- ADMINISTRADOR -- ADMINISTRADOR -- ADMINISTRADOR -- ADMINISTRADOR
-- Tabla para administradores
CREATE TABLE tb_admin (
    id_admin INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    ap_paterno VARCHAR(50),
    ap_materno VARCHAR(50),
    usuario VARCHAR(20),
    correo_electronico VARCHAR(50),
    contraseña VARCHAR(255), -- Se aumenta la longitud para mayor seguridad
    estado ENUM('activo', 'inactivo')
);

-- Tabla para el login de los administradores
CREATE TABLE tb_admin_login (
    id_admin_login INT PRIMARY KEY AUTO_INCREMENT,
    id_administrador INT DEFAULT NULL,
    usuario VARCHAR(20) DEFAULT NULL,
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    accion VARCHAR(50) DEFAULT NULL,
    FOREIGN KEY (id_administrador) REFERENCES tb_admin(id_admin)
);

-- Tabla para las acciones de los administradores
CREATE TABLE tb_admin_logs (
    id_admin_logs INT PRIMARY KEY AUTO_INCREMENT,
    id_administrador INT DEFAULT NULL,
    nombre VARCHAR(50),
    ap_paterno VARCHAR(50),
    ap_materno VARCHAR(50),
    estado ENUM('activo', 'inactivo'),
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    accion VARCHAR(20) DEFAULT NULL,
    FOREIGN KEY (id_administrador) REFERENCES tb_admin(id_admin)
);

-- CLIENTES -- CLIENTES -- CLIENTES -- CLIENTES -- CLIENTES -- CLIENTES -- CLIENTES
-- Tabla para clientes
CREATE TABLE tb_clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    ap_paterno VARCHAR(50) NOT NULL,
    ap_materno VARCHAR(50) NOT NULL,
    curp VARCHAR(18) NOT NULL UNIQUE,
    fecha_na DATE NOT NULL,
    num_celular VARCHAR(10) NOT NULL,
    sexo ENUM('femenino', 'masculino') NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tb_clientes_logs (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    nombre VARCHAR(50),
    ap_paterno VARCHAR(50),
    ap_materno VARCHAR(50),
    curp VARCHAR(18),
    fecha_na DATE,
    num_celular VARCHAR(10),
    sexo ENUM('femenino', 'masculino'),
    fecha_registro TIMESTAMP,
    accion ENUM('INSERT', 'UPDATE', 'DELETE') NOT NULL,
    fecha_accion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES tb_clientes(id_cliente)
);


-- MEMBRESIAS -- MEMBRESIAS -- MEMBRESIAS -- MEMBRESIAS -- MEMBRESIAS -- MEMBRESIAS
-- Tabla para el tipo de membresias
CREATE TABLE tb_tipo_membresias (
    id_tipo_membresia INT PRIMARY KEY AUTO_INCREMENT,
    tipo_membresia ENUM('basico', 'premiun', 'senior'),
    precio DECIMAL(5,2)
);

-- ESTATUS -- ESTATUS -- ESTATUS -- ESTATUS -- ESTATUS -- ESTATUS-- ESTATUS -- ESTATUS
-- Tabla para estatus
CREATE TABLE tb_estatus (
    id_estatus INT PRIMARY KEY AUTO_INCREMENT,
    estatus ENUM('activo', 'vencido', 'cancelado')
);

-- INSCRIPCIONES -- INSCRIPCIONES -- INSCRIPCIONES -- INSCRIPCIONES -- INSCRIPCIONES 
-- Tabla para las inscripciones
CREATE TABLE tb_inscripciones (
    id_inscripcion INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT NOT NULL,
    id_tipo_membresia INT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    id_estatus INT NOT NULL DEFAULT 1, -- Por defecto 'activo'
    FOREIGN KEY (id_cliente) REFERENCES tb_clientes(id_cliente),
    FOREIGN KEY (id_tipo_membresia) REFERENCES tb_tipo_membresias(id_tipo_membresia),
    FOREIGN KEY (id_estatus) REFERENCES tb_estatus(id_estatus)
);





ALTER TABLE tb_clientes_logs DROP FOREIGN KEY tb_clientes_logs_ibfk_1;

ALTER TABLE tb_clientes_logs
ADD CONSTRAINT tb_clientes_logs_ibfk_1 FOREIGN KEY (id_cliente) REFERENCES tb_clientes(id_cliente) ON DELETE CASCADE;
