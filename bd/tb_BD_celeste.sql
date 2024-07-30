-- ADMINISTRADOR -- ADMINISTRADOR -- ADMINISTRADOR -- ADMINISTRADOR -- ADMINISTRADOR
-- Tabla para administradores
CREATE TABLE tb_admin (
    id_admin INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    ap_paterno VARCHAR(50) NOT NULL,
    ap_materno VARCHAR(50) NOT NULL,
    usuario VARCHAR(20) NOT NULL UNIQUE,
    correo_electronico VARCHAR(50) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo'
);

-- Tabla para el login de los administradores
CREATE TABLE tb_admin_login (
    id_admin_login INT PRIMARY KEY AUTO_INCREMENT,
    id_administrador INT,
    usuario VARCHAR(20),
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    accion VARCHAR(50),
    FOREIGN KEY (id_administrador) REFERENCES tb_admin(id_admin)  ON DELETE CASCADE
);

-- Tabla para las acciones de los administradores
CREATE TABLE tb_admin_logs (
    id_admin_logs INT PRIMARY KEY AUTO_INCREMENT,
    id_administrador INT,
    nombre VARCHAR(50),
    ap_paterno VARCHAR(50),
    ap_materno VARCHAR(50),
    estado ENUM('activo', 'inactivo'),
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    accion VARCHAR(20),
    FOREIGN KEY (id_administrador) REFERENCES tb_admin(id_admin)  ON DELETE CASCADE
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
    sexo ENUM('Femenino', 'Masculino') NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla para registros de logs de clientes
CREATE TABLE tb_clientes_logs (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    nombre VARCHAR(50),
    ap_paterno VARCHAR(50),
    ap_materno VARCHAR(50),
    curp VARCHAR(18),
    fecha_na DATE,
    num_celular VARCHAR(10),
    sexo ENUM('Femenino', 'Masculino'),
    fecha_registro TIMESTAMP,
    accion ENUM('INSERT', 'UPDATE', 'DELETE') NOT NULL,
    fecha_accion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES tb_clientes(id_cliente) ON DELETE CASCADE
);

-- MEMBRESIAS -- MEMBRESIAS -- MEMBRESIAS -- MEMBRESIAS -- MEMBRESIAS -- MEMBRESIAS
-- Tabla para el tipo de membresías
CREATE TABLE tb_tipo_membresias (
    id_tipo_membresia INT PRIMARY KEY AUTO_INCREMENT,
    tipo_membresia ENUM('Clasic', 'Premiun', 'Senior') NOT NULL,
    precio DECIMAL(5,2) NOT NULL
);

-- ESTATUS -- ESTATUS -- ESTATUS -- ESTATUS -- ESTATUS -- ESTATUS-- ESTATUS -- ESTATUS
-- Tabla para estatus
CREATE TABLE tb_estatus (
    id_estatus INT PRIMARY KEY AUTO_INCREMENT,
    estatus ENUM('Activo', 'Vencido', 'Cancelado') NOT NULL
);

-- INSCRIPCIONES -- INSCRIPCIONES -- INSCRIPCIONES -- INSCRIPCIONES -- INSCRIPCIONES 
-- Tabla para las inscripciones
CREATE TABLE tb_inscripciones (
    id_inscripcion INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT NOT NULL,
    id_tipo_membresia INT NOT NULL,
    tipo_membresia ENUM('Clasic', 'Premiun', 'Senior') NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    id_estatus INT NOT NULL DEFAULT 1, -- Por defecto 'activo'
    pago DECIMAL(5,2) NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES tb_clientes(id_cliente) ON DELETE CASCADE,
    FOREIGN KEY (id_tipo_membresia) REFERENCES tb_tipo_membresias(id_tipo_membresia) ON DELETE CASCADE,
    FOREIGN KEY (id_estatus) REFERENCES tb_estatus(id_estatus) ON DELETE CASCADE
);

CREATE TABLE tb_inscripciones_log (
    id_log INT PRIMARY KEY AUTO_INCREMENT,
    id_inscripcion INT,
    id_cliente INT,
    id_tipo_membresia INT,
    tipo_membresia ENUM('Clasic', 'Premiun', 'Senior'),
    fecha_inicio DATE,
    fecha_fin DATE,
    id_estatus INT,
    pago DECIMAL(5,2),
    accion ENUM('INSERT', 'UPDATE', 'DELETE'),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario VARCHAR(255)
);