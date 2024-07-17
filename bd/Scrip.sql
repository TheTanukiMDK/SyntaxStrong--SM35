CREATE DATABASE SintaxStrong

USE DATABASE SintaxStrong

CREATE TABLE Admin(
    id_admin INT PRIMARY KEY AUTO_INCREMENT,
    correo_electronico VARCHAR(18),
    pwd VARCHAR(6)
);




CREATE TABLE tb_clientes(
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(25),
    ap_paterno VARCHAR(25),
    ap_materno VARCHAR(25),
);


CREATE TABLE tb_tarjetas(
    id_tarjeta INT PRIMARY KEY AUTO_INCREMENT,
    n_tarjeta VARCHAR(16),
    nip VARCHAR(4),
    saldo DECIMAL(20,2),
    id_cliente INT NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES tb_clientes(id_cliente)
);