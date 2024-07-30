/* Trigger para actualizar el estado de la membresía al realizar un pago (Activo)*/

DELIMITER //

CREATE TRIGGER after_payment_update
AFTER UPDATE ON tb_inscripciones
FOR EACH ROW
BEGIN
    DECLARE current_date DATE;
    SET current_date = CURDATE();
    IF NEW.pago > 0 AND NEW.fecha_inicio <= current_date THEN
        UPDATE tb_inscripciones
        SET id_estatus = (SELECT id_estatus FROM tb_estatus WHERE estatus = 'Activo')
        WHERE id_inscripcion = NEW.id_inscripcion;
    END IF;
END;

//

DELIMITER ;

-- Trigger para actualizar el estado de la membresía basado en los pagos (ActInactivoivo) --

DELIMITER //

CREATE TRIGGER after_inscripcion_insert
AFTER INSERT ON tb_inscripciones
FOR EACH ROW
BEGIN
    DECLARE current_date DATE;
    SET current_date = CURDATE();
    IF NEW.fecha_fin < current_date THEN
        UPDATE tb_inscripciones
        SET id_estatus = (SELECT id_estatus FROM tb_estatus WHERE estatus = 'Inactivo')
        WHERE id_inscripcion = NEW.id_inscripcion;
    END IF;
END;

//

DELIMITER ;

/* Trigger para registrar acciones de clientes */
-- Un trigger para registrar automáticamente las acciones de inserción, actualización o eliminación en la tabla tb_clientes --

DELIMITER //

CREATE TRIGGER after_cliente_action
AFTER INSERT OR UPDATE OR DELETE ON tb_clientes
FOR EACH ROW
BEGIN
    DECLARE action ENUM('INSERT', 'UPDATE', 'DELETE');
    IF INSERTING THEN
        SET action = 'INSERT';
    ELSIF UPDATING THEN
        SET action = 'UPDATE';
    ELSIF DELETING THEN
        SET action = 'DELETE';
    END IF;

    INSERT INTO tb_clientes_logs (id_cliente, nombre, ap_paterno, ap_materno, curp, fecha_na, num_celular, sexo, fecha_registro, accion)
    VALUES (NEW.id_cliente, NEW.nombre, NEW.ap_paterno, NEW.ap_materno, NEW.curp, NEW.fecha_na, NEW.num_celular, NEW.sexo, NEW.fecha_registro, action);
END;

//

DELIMITER ;

/* Trigger para registrar logins de administradores */

DELIMITER //

CREATE TRIGGER after_admin_login
AFTER INSERT ON tb_admin_login
FOR EACH ROW
BEGIN
    INSERT INTO tb_admin_logs (id_administrador, nombre, ap_paterno, ap_materno, estado, accion)
    SELECT id_administrador, nombre, ap_paterno, ap_materno, estado, 'LOGIN'
    FROM tb_admin
    WHERE id_admin = NEW.id_administrador;
END;

//

DELIMITER ;

/* Trigger para Registrar Logouts de Administradores */

DELIMITER //

CREATE TRIGGER after_admin_logout
AFTER INSERT ON tb_admin_login
FOR EACH ROW
BEGIN
    IF NEW.accion = 'LOGOUT' THEN
        INSERT INTO tb_admin_logs (id_administrador, nombre, ap_paterno, ap_materno, estado, accion)
        SELECT id_admin, nombre, ap_paterno, ap_materno, estado, 'LOGOUT'
        FROM tb_admin
        WHERE id_admin = NEW.id_administrador;
    END IF;
END;

//

DELIMITER ;

/* Trigger para asegurar la unicidad del CURP en clientes */
-- Asegúrate de que no se puedan insertar clientes con CURP duplicados, además del constraint único que ya tienes. --

DELIMITER //

CREATE TRIGGER before_cliente_insert
BEFORE INSERT ON tb_clientes
FOR EACH ROW
BEGIN
    IF (SELECT COUNT(*) FROM tb_clientes WHERE curp = NEW.curp) > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El CURP ya existe.';
    END IF;
END;

//

DELIMITER ;

/* Trigger para Actualizar el Estado de las Inscripciones */
-- actualiza el estado de las inscripciones cuando un cliente es eliminado. -- 

DELIMITER //

CREATE TRIGGER after_cliente_delete
AFTER DELETE ON tb_clientes
FOR EACH ROW
BEGIN
    UPDATE tb_inscripciones 
    SET id_estatus = (SELECT id_estatus FROM tb_estatus WHERE estatus = 'Cancelado')
    WHERE id_cliente = OLD.id_cliente;

    DELETE FROM tb_clientes_logs WHERE id_cliente = OLD.id_cliente;
END;

//

DELIMITER ;