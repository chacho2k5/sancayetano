UPDATE pedidos
	SET estado_nombre = 'CARGADO'
    WHERE estado_id = 1;

UPDATE pedidos
	SET estado_nombre = 'GENERADO'
    WHERE estado_id = 2;

UPDATE pedidos
	SET estado_nombre = 'PRODUCCION'
    WHERE estado_id = 3;

UPDATE pedidos
	SET estado_nombre = 'TERMINADO'
    WHERE estado_id = 4;

UPDATE trabajos
	SET estado_nombre = 'FACTURADO'
    WHERE estado_id = 5;
    
UPDATE trabajos
	SET estado_nombre = 'DESPACHADO'
    WHERE estado_id = 6;

UPDATE trabajos
	SET estado_nombre = 'ENTREGADO'
    WHERE estado_id = 7;

UPDATE pedidos
	SET estado_nombre = 'ANULADA'
    WHERE estado_id = 8;
