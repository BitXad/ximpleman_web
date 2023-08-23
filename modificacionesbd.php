<?php

/* 
#TRUNCAR TABLAS#
truncate venta;
truncate detalle_venta;
truncate factura;
truncate detalle_factura;
truncate pedido;
truncate detalle_pedido;
truncate cliente;
truncate proveedor;
truncate compra;
truncate detalle_compra;
truncate cotizacion;
truncate detalle_cotizacion;
truncate registro_eventos;
truncate recepcion_paquetes;
truncate cufd;
truncate cuis;
truncate punto_venta;

 * --------------- SQL ---------------


ALTER TABLE `parametros` ADD COLUMN `parametro_verificarconexion` INTEGER DEFAULT NULL;

ALTER TABLE `parametros` ADD COLUMN `parametro_comprobante` INTEGER DEFAULT NULL;

ALTER TABLE `dosificacion` ADD COLUMN `dosificacion_numerotransmes` INTEGER DEFAULT NULL;

ALTER TABLE `venta` ADD COLUMN `venta_numerotransmes` INTEGER DEFAULT NULL;

ALTER TABLE `parametros` ADD COLUMN `parametro_contarventasmes` INTEGER DEFAULT NULL;

ALTER TABLE `dosificacion` ADD COLUMN `dosificacion_mesactual` INTEGER DEFAULT NULL;

ALTER TABLE `parametros` ADD COLUMN `parametro_numeroventa` INTEGER DEFAULT NULL;

ALTER TABLE `parametros` ADD COLUMN `parametro_contarventas` INTEGER DEFAULT NULL;

ALTER TABLE `parametros` ADD COLUMN `parametro_mostrarnumero` INTEGER DEFAULT NULL;




 */

