/* Procedimiento para Insertar un Nuevo Cliente */
DELIMITER //

CREATE PROCEDURE insertar_cliente(
    IN p_nombre VARCHAR(50),
    IN p_ap_paterno VARCHAR(50),
    IN p_ap_materno VARCHAR(50),
    IN p_curp VARCHAR(18),
    IN p_fecha_na DATE,
    IN p_num_celular VARCHAR(10),
    IN p_sexo ENUM('Femenino', 'Masculino')
)
BEGIN
    INSERT INTO tb_clientes (nombre, ap_paterno, ap_materno, curp, fecha_na, num_celular, sexo)
    VALUES (p_nombre, p_ap_paterno, p_ap_materno, p_curp, p_fecha_na, p_num_celular, p_sexo);
END;

//

DELIMITER ;

/* Procedimiento para Actualizar el Estado de una Inscripción */

DELIMITER //

CREATE PROCEDURE actualizar_estado_inscripcion(
    IN p_id_inscripcion INT,
    IN p_nuevo_estado ENUM('Activo', 'Vencido', 'Cancelado')
)
BEGIN
    UPDATE tb_inscripciones
    SET id_estatus = (SELECT id_estatus FROM tb_estatus WHERE estatus = p_nuevo_estado)
    WHERE id_inscripcion = p_id_inscripcion;
END;

//

DELIMITER ;

/* Procedimiento para Eliminar un Cliente y Actualizar sus Inscripciones */

DELIMITER //

CREATE PROCEDURE eliminar_cliente(
    IN p_id_cliente INT
)
BEGIN
    DELETE FROM tb_clientes_logs WHERE id_cliente = p_id_cliente;

    UPDATE tb_inscripciones 
    SET id_estatus = (SELECT id_estatus FROM tb_estatus WHERE estatus = 'Cancelado')
    WHERE id_cliente = p_id_cliente;
    
    DELETE FROM tb_clientes WHERE id_cliente = p_id_cliente;
END;

//

DELIMITER ;


