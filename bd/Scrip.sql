CREATE DATABASE SintaxStrong

USE DATABASE SintaxStrong

CREATE TABLE tb_admin(
    id_admin INT PRIMARY KEY AUTO_INCREMENT,
    usuername VARCHAR(50),
    correo_electronico VARCHAR(18),
    pwd VARCHAR(6)
);

CREATE TABLE tb_usuario(
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30),
    ap_paterno VARCHAR(30),
    ap_materno VARCHAR(30),
    curp VARCHAR(18),
    sexo VARCHAR()
    num_celular Int(9)
);

CREATE TABLE tb_membresia(
    id_membresia INT PRIMARY KEY AUTO_INCREMENT,
    tipo_membresia VARCHAR(7),
    precio DECIMAL(5,2)
);

CREATE TABLE tb_estatus(
    id_estatus INT PRIMARY KEY AUTO_INCREMENT,
    estatus VARCHAR(10)
);

CREATE TABLE tb_inscripcion(
    id_inscripcion INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_membresia INT NOT NULL,
    fecha_inicio TIME,
    fecha_fin TIME,
    id_estatus INT NOT NULL,
    /*id_pago*/
    FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id_usuario),
    FOREIGN KEY (id_membresia) REFERENCES tb_membresia(id_membresia),
    FOREIGN KEY (id_estatus) REFERENCES tb_estatus(id_estatus),

);

