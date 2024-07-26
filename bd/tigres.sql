
CREATE TABLE tb_log_usuarios(
    id_log_usuarios INT PRIMARY KEY AUTO_INCREMENT,
    accion VARCHAR(10),
    id_usuario INT,
    nombre_comnpleto VARCHAR(250),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DELIMITER //
CREATE TRIGGER tb_login_usuarios 
AFTER UPDATE ON tb_usuario FOR EACH ROW BEGIN
IF NEW.estado = 'Activo' AND OLD.estado <> 'Inactivo' THEN
INSERT INTO tb_log_usuarios (accion, id_usuario, nombre_completo)
VALUES
    (
        'LOGIN', 
        NEW.id_cliente, 
        CONCAT(
            NEW.nombre, '', NEW.ap_paterno, '', NEW.ap_materno
        )
    );
END IF;
END//

DELIMITER //
CREATE TRIGGER tb_logout_usuarios 
AFTER UPDATE ON tb_usuario FOR EACH ROW BEGIN
IF NEW.estado = 'Inactivo' AND OLD.estado <> 'Activo' THEN
INSERT INTO tb_log_usuarios (accion, id_usuario, nombre_completo)
VALUES
    (
        'LOGOUT', 
        OLD.id_cliente, 
        CONCAT(
            OLD.nombre, '', OLD.ap_paterno, '', OLD.ap_materno
        )
    );
END IF;
END//
