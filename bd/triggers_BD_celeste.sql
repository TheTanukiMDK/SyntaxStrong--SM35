-- Trigger para INSERT en tb_admin
DELIMITER //
CREATE TRIGGER trg_after_insert_tb_admin
AFTER INSERT ON tb_admin
FOR EACH ROW
BEGIN
    INSERT INTO tb_admin_logs (id_administrador, nombre, ap_paterno, ap_materno, estado, accion)
    VALUES (NEW.id_admin, NEW.nombre, NEW.ap_paterno, NEW.ap_materno, NEW.estado, 'INSERT');
END;
//
DELIMITER ;

-- Trigger para UPDATE en tb_admin
DELIMITER //
CREATE TRIGGER trg_after_update_tb_admin
AFTER UPDATE ON tb_admin
FOR EACH ROW
BEGIN
    INSERT INTO tb_admin_logs (id_administrador, nombre, ap_paterno, ap_materno, estado, accion)
    VALUES (NEW.id_admin, NEW.nombre, NEW.ap_paterno, NEW.ap_materno, NEW.estado, 'UPDATE');
END;
//
DELIMITER ;

-- Trigger para DELETE en tb_admin
DELIMITER //
CREATE TRIGGER trg_after_delete_tb_admin
AFTER DELETE ON tb_admin
FOR EACH ROW
BEGIN
    INSERT INTO tb_admin_logs (id_administrador, nombre, ap_paterno, ap_materno, estado, accion)
    VALUES (OLD.id_admin, OLD.nombre, OLD.ap_paterno, OLD.ap_materno, OLD.estado, 'DELETE');
END;
//
DELIMITER ;

-- Trigger para login
DELIMITER //
CREATE TRIGGER tg_login_admin
AFTER UPDATE ON tb_admin
FOR EACH ROW 
BEGIN
    IF NEW.estado = 'activo' AND OLD.estado <> 'activo' THEN
        INSERT INTO tb_admin_login (id_administrador, usuario, accion) 
        VALUES (NEW.id_admin, NEW.usuario, 'LOGIN');
    END IF;
END;
//
DELIMITER ;

-- Trigger para logout
DELIMITER //
CREATE TRIGGER tg_logout_admin
AFTER UPDATE ON tb_admin
FOR EACH ROW 
BEGIN
    IF NEW.estado = 'inactivo' AND OLD.estado <> 'inactivo' THEN
        INSERT INTO tb_admin_login (id_administrador, usuario, accion) 
        VALUES (OLD.id_admin, OLD.usuario, 'LOGOUT');
    END IF;
END;
//
DELIMITER ;


-- CLIENTES -- CLIENTES -- CLIENTES -- CLIENTES -- CLIENTES -- CLIENTES -- CLIENTES -- CLIENTES -- CLIENTES 
DELIMITER //

CREATE TRIGGER tg_insert_cliente
AFTER INSERT ON tb_clientes
FOR EACH ROW
BEGIN
    INSERT INTO tb_clientes_logs (id_cliente, nombre, ap_paterno, ap_materno, curp, fecha_na, num_celular, sexo, fecha_registro, accion)
    VALUES (NEW.id_cliente, NEW.nombre, NEW.ap_paterno, NEW.ap_materno, NEW.curp, NEW.fecha_na, NEW.num_celular, NEW.sexo, NEW.fecha_registro, 'INSERT');
END;
//

CREATE TRIGGER tg_update_cliente
AFTER UPDATE ON tb_clientes
FOR EACH ROW
BEGIN
    INSERT INTO tb_clientes_logs (id_cliente, nombre, ap_paterno, ap_materno, curp, fecha_na, num_celular, sexo, fecha_registro, accion)
    VALUES (NEW.id_cliente, NEW.nombre, NEW.ap_paterno, NEW.ap_materno, NEW.curp, NEW.fecha_na, NEW.num_celular, NEW.sexo, NEW.fecha_registro, 'UPDATE');
END;
//

CREATE TRIGGER tg_delete_cliente
AFTER DELETE ON tb_clientes
FOR EACH ROW
BEGIN
    INSERT INTO tb_clientes_logs (id_cliente, nombre, ap_paterno, ap_materno, curp, fecha_na, num_celular, sexo, fecha_registro, accion)
    VALUES (OLD.id_cliente, OLD.nombre, OLD.ap_paterno, OLD.ap_materno, OLD.curp, OLD.fecha_na, OLD.num_celular, OLD.sexo, OLD.fecha_registro, 'DELETE');
END;
//

DELIMITER ;

