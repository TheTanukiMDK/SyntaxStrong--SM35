/* Procedimiento para Insertar un Nuevo Cliente */
DELIMITER //

CREATE PROCEDURE insertar_cliente(
    IN nombre VARCHAR(50),
    IN ap_paterno VARCHAR(50),
    IN ap_materno VARCHAR(50),
    IN curp VARCHAR(18),
    IN fecha_na DATE,
    IN num_celular VARCHAR(10),
    IN sexo ENUM('Femenino', 'Masculino')
)
BEGIN
    INSERT INTO tb_clientes (nombre, ap_paterno, ap_materno, curp, fecha_na, num_celular, sexo)
    VALUES (nombre, ap_paterno, ap_materno, curp, fecha_na, num_celular, sexo);
END;

//

DELIMITER ;

/* Procedimiento para Actualizar el Estado de una Inscripción */

DELIMITER //

CREATE PROCEDURE actualizar_estado_inscripcion(
    IN id_inscripcion INT,
    IN nuevo_estado ENUM('Activo', 'Vencido', 'Cancelado')
)
BEGIN
    UPDATE tb_inscripciones
    SET id_estatus = (SELECT id_estatus FROM tb_estatus WHERE estatus = nuevo_estado)
    WHERE id_inscripcion = id_inscripcion;
END;

//

DELIMITER ;

/* Procedimiento para Eliminar un Cliente y Actualizar sus Inscripciones */

DELIMITER //

CREATE PROCEDURE eliminar_cliente(
    IN id_cliente INT
)
BEGIN
    DELETE FROM tb_clientes_logs WHERE id_cliente = id_cliente;

    UPDATE tb_inscripciones 
    SET id_estatus = (SELECT id_estatus FROM tb_estatus WHERE estatus = 'Cancelado')
    WHERE id_cliente = id_cliente;
    
    DELETE FROM tb_clientes WHERE id_cliente = id_cliente;
END;

//

DELIMITER ;


