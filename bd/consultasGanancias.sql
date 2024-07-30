--Total de usuarios
SELECT count(*) AS total_clientes FROM tb_clientes;

--Total de mujeres
SELECT count(*) AS total_mujeres FROM tb_clientes WHERE sexo = 'femenino';

--Total de hombres
SELECT count(*) AS total_mujeres FROM tb_clientes WHERE sexo = 'masculino';

--Total venta de membresias
SELECT SUM(pago) AS total_venta FROM tb_inscripciones WHERE id_tipo_membresia = 1;
SELECT SUM(pago) AS total_venta FROM tb_inscripciones WHERE id_tipo_membresia = 2;
SELECT SUM(pago) AS total_venta FROM tb_inscripciones WHERE id_tipo_membresia = 3;

--Total de inscritos
SELECT count(*) AS total_inscritos FROM tb_inscripciones;
SELECT count(*) AS total_activos FROM tb_inscripciones WHERE id_estatus = 1;

--Total de venta por mes


--Insertar con intervalo de mes
INSERT INTO tb_inscripciones (
    id_cliente,
    id_tipo_membresia,
    fecha_inicio,
    fecha_fin,
    pago
) VALUES (
    20,      --usuario de ejemplo             
    2,       
    CURDATE(),           
    DATE_ADD(CURDATE(), INTERVAL 31 DAY),               
    149.00               
);