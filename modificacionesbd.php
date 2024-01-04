<?php


/*
 
  
update licencia set
`licencia_fechaactivacion` = date(now()),
`licencia_fechalimite` = date_add(now(), INTERVAL 1 YEAR),
`licencia_llave` = '&%k$j%&/jkk$k%k&oyijfhf';
 
truncate subcategoria_producto;
truncate categoria_producto;
   
INSERT INTO `categoria_producto`(`categoria_id`, `categoria_nombre`, `categoria_imagen`) VALUE 
  (1,'PRODUCTOS VARIOS','-');
COMMIT;

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
truncate ingresos;
truncate egresos;
truncate servicio;
truncate detalle_serv;
truncate credito;
truncate cuota;
truncate producto;
truncate inventario;



update empresa set

empresa_nombre = 'OTOGROUP SRL'
,empresa_eslogan = 'COMPRE MAS, COMPRE MEJOR'
,empresa_direccion = '-'
,empresa_telefono = '4511518'
,empresa_imagen = ''
,empresa_zona = 'CENTRAL'
,empresa_ubicacion = 'AV. AMERICA Nº 452'
,empresa_departamento = 'COCHABAMBA'
,empresa_propietario = ''
,empresa_email = ''
,empresa_profesion = ''
,empresa_cargo = ''
,empresa_nombresucursal = 'SUC. PRINCIPAL';

 
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

ALTER TABLE `parametros` ADD COLUMN `parametro_cerrarventanas` INTEGER DEFAULT NULL;



INSERT INTO parametros (parametro_id, parametro_numrecegr, parametro_numrecing, parametro_copiasfact, parametro_tipoimpresora, parametro_numcuotas, parametro_montomax, parametro_diasgracia, parametro_diapago, parametro_periododias, parametro_interes, parametro_tituldoc, parametro_mostrarcategoria, parametro_diagnostico, parametro_solucion, parametro_modoventas, parametro_imprimircomanda, parametro_anchoboton, parametro_altoboton, parametro_colorboton, parametro_anchoimagen, parametro_altoimagen, parametro_formaimagen, parametro_modulorestaurante, parametro_permisocredito, parametro_agruparitems, parametro_diasvenc, parametro_anchofactura, parametro_altofactura, parametro_margenfactura, parametro_imagenreal, parametro_diasentrega, parametro_notaentrega, parametro_segservicio, parametro_apikey, parametro_serviciofact, parametro_sucursales, parametro_logomonitor, parametro_fondomonitor, parametro_cantidadproductos, parametro_datosboton, moneda_id, parametro_numordenproduccion, parametro_factura, parametro_puntos, parametro_mostrarmoneda, parametro_pedidotitulo, parametro_manejocaja, parametro_codcatsubcat, parametro_tiposistema, parametro_tipoemision, parametro_imprimirticket, parametro_decimales, parametro_rangoprecios, parametro_mostrarlogo, parametro_mostrarempresa, parametro_mostrareslogan, parametro_mostrardireccion, parametro_anchobuscador, parametro_tamanioletrasboton, parametro_tamanioletras, parametro_buscadorcodigo, parametro_buscadortexto, parametro_categoria, parametro_subcategoria, parametro_botoninventario, parametro_promociones, parametro_categoriabotones, parametro_buscadordetalle, parametro_herramientassuperior, parametro_herramientasinferior, parametro_preciototal, parametro_asignarinventario, parametro_finalizarventas, parametro_resumenventas, parametro_cierrecaja, parametro_ventasdiarias, parametro_productossinhomologar, parametro_teclasacceso, parametro_informacionbasica, parametro_panelventas, parametro_inventariobuscador, parametro_promocionesbuscador, parametro_logoenfactura, parametro_sininventario, parametro_movimientodiario, parametro_imprimirfactura, parametro_orden, parametro_documentoslista, parametro_tamaniotextocategoria, parametro_colorbotoncategoria, parametro_datosproducto, parametro_cantidadsimple, parametro_botonescontrol, parametro_botonesproducto, parametro_ordendetalle, parametro_tablasencilla, parametro_redireccionusuario, parametro_comprobante, parametro_verificarconexion, parametro_contarventasmes, parametro_numeroventa, parametro_contarventas, parametro_mostrarnumero, parametro_cerrarventanas) VALUES

  (1, 3, 7, 3, 'FACTURADORA', 1, 0, 14, 2, 7, 0, 'PROFORMA', 1, 'REVISION', 'REVISION', 1, 0, 125, 180, 'warning', 123, 140, '', 1, 1, 1, 15, 6.5, 4, 0, 0, 0, 1, 0, 'AIzaSyClNsJugfWI4xOf1Or9Wdg5lD_qUqaik58', 1, NULL, '1662238995.jpg', '', 1, 1, 1, 0, 4, 0, 2, 'Pedidos', 'Si', 0, 2, 1, 0, 2, 2, 1, 1, 1, 1, 6, 12, 12, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 1, 8, 1, 0, 1, 'danger', 1, 0, 1, 1, 1, 1, '', 2, 2, 1, 89, 0, 4, 1),
  (2, 0, 0, 3, 'FACTURADORA', 1, 0, 14, 2, 7, 0, 'PROFORMA', 1, 'REVISION', 'REVISION', 2, 1, 180, 160, 'default', 160, 120, '', 1, 1, 1, 15, 6.5, 4, 0, 0, 0, 1, 1, 'AIzaSyClNsJugfWI4xOf1Or9Wdg5lD_qUqaik58', 1, NULL, '', '', 2, 1, 1, 0, 4, 0, 2, 'Pedidos', 'No', 0, 2, 1, 1, 2, 2, 1, 1, 1, 1, 8, 18, 14, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 0, 0, 1, 0, 0, 0, 1, 1, 1, 1, 0, 0, 1, 1, 0, 6, 2, 0, 18, 'danger', 0, 0, 0, 0, 1, 1, 'venta/ventas', 1, 2, 1, 91, 1, 4, 1),
//reportes de faltantes y sobrantes
 * select p.`producto_nombre`, p.producto_codigo, u.`ubiprod_existencia`,u.`ubiprod_existenciafisico`, u.`ubiprod_faltante`,u.`ubiprod_sobrante`, 
p.producto_ultimocosto,
 (u.`ubiprod_faltante`) * p.producto_ultimocosto as totalfaltante,
 (u.`ubiprod_sobrante`) * p.producto_ultimocosto as totalsobrante
from ubicacion_producto u, producto p
where 
p.producto_id = u.producto_id and
(u.`ubiprod_faltante` + u.`ubiprod_sobrante`) >0






insert into detalle_compra(
compra_id
,moneda_id
,producto_id
,detallecomp_codigo
,detallecomp_cantidad
,detallecomp_unidad
,detallecomp_costo
,detallecomp_precio
,detallecomp_subtotal
,detallecomp_descuento
,detallecomp_total
,detallecomp_descglobal
,detallecomp_tipocambio
,cambio_id
,detallecomp_tc
) 
(
select 
1,
1,
p.producto_id,
p.producto_codigobarra,
p.producto_orden,
p.`producto_unidad`,
p.`producto_costo`,
p.`producto_precio`,
p.`producto_costo` * p.producto_orden,
0,
p.`producto_costo` * p.producto_orden,
0,
1,
1,
6.96


from producto p);

INSERT INTO `proveedor` (`proveedor_id`, `estado_id`, `proveedor_codigo`, `proveedor_nombre`, `proveedor_foto`, `proveedor_contacto`, `proveedor_direccion`, `proveedor_telefono`, `proveedor_telefono2`, `proveedor_email`, `proveedor_nit`, `proveedor_razon`, `proveedor_autorizacion`) VALUES 
  (1,1,'INV410','INVENTARIO INICIAL',NULL,'','','','',NULL,'0','INVENTARIO INICIAL','1');


insert into compra(
`compra_id`
,`estado_id`
,`tipotrans_id`
,`usuario_id`
,`moneda_id`
,`proveedor_id`
,`forma_id`
,`compra_fecha`
,`compra_hora`
,`compra_subtotal`
,`compra_descuento`
,`compra_descglobal`
,`compra_total`
,`compra_totalfinal`
,`compra_efectivo`
,`compra_cambio`
,`compra_glosa`
,`compra_tipocambio`
,`compra_chofer`
,`compra_placamovil`,compra_numdoc,documento_respaldo_id) 
value(
1,1,1,1,1,1,1,date(now()),time(now()),0,0,0,0,0,0,0,'',1,'','',0,0);

update compra set
compra_subtotal = (select sum(detallecomp_total) from detalle_compra where compra_id=1)
,compra_total = (select sum(detallecomp_total) from detalle_compra where compra_id=1)
,compra_totalfinal = (select sum(detallecomp_total) from detalle_compra where compra_id=1)
where compra_id = 1;








CREATE OR REPLACE  ALGORITHM=UNDEFINED DEFINER='root'@'localhost' SQL SECURITY DEFINER VIEW `consventastotales`
AS
select
  `v`.`venta_id` AS `venta_id`,
  `v`.`forma_id` AS `forma_id`,
  `v`.`tipotrans_id` AS `tipotrans_id`,
  `v`.`usuario_id` AS `usuario_id`,
  `v`.`cliente_id` AS `cliente_id`,
  `v`.`moneda_id` AS `moneda_id`,
  `v`.`estado_id` AS `estado_id`,
  `v`.`venta_fecha` AS `venta_fecha`,
  `v`.`venta_hora` AS `venta_hora`,
  `v`.`venta_subtotal` AS `venta_subtotal`,
  `v`.`venta_descuento` AS `venta_descuento`,
  `v`.`venta_total` AS `venta_total`,
  `v`.`venta_efectivo` AS `venta_efectivo`,
  `v`.`venta_cambio` AS `venta_cambio`,
  `v`.`venta_glosa` AS `venta_glosa`,
  `v`.`venta_comision` AS `venta_comision`,
  `v`.`venta_tipocambio` AS `venta_tipocambio`,
  `v`.`detalleserv_id` AS `detalleserv_id`,
  `v`.`venta_tipodoc` AS `venta_tipodoc`,
  `v`.`tiposerv_id` AS `tiposerv_id`,
  `v`.`entrega_id` AS `entrega_id`,
  `v`.`venta_fechaentrega` AS `venta_fechaentrega`,
  `v`.`venta_horaentrega` AS `venta_horaentrega`,
  `v`.`venta_numeroventa` AS `venta_numeroventa`,
  `v`.`venta_numeromesa` AS `venta_numeromesa`,
  `v`.`entrega_usuarioid` AS `entrega_usuarioid`,
  `v`.`entrega_estadoid` AS `entrega_estadoid`,
  `v`.`usuarioprev_id` AS `usuarioprev_id`,
  `v`.`pedido_id` AS `pedido_id`,
  `v`.`orden_id` AS `orden_id`,
  `v`.`banco_id` AS `banco_id`,
  v.venta_numerotransmes as venta_numerotransmes,
  v.venta_numeroventa as venta_numeroventa,
  `t`.`tipotrans_nombre` AS `tipotrans_nombre`,
  `u`.`usuario_nombre` AS `usuario_nombre`,
  `u`.`usuario_imagen` AS `usuario_imagen`,
  `c`.`cliente_nombre` AS `cliente_nombre`,
  `c`.`cliente_razon` AS `cliente_razon`,
  `c`.`cliente_nit` AS `cliente_nit`,
  `c`.`cliente_codigo` AS `cliente_codigo`,
  `c`.`cliente_celular` AS `cliente_celular`,
  `c`.`cliente_telefono` AS `cliente_telefono`,
  `c`.`cliente_nombrenegocio` AS `cliente_nombrenegocio`,
  `c`.`cliente_email` AS `cliente_email`,
  `c`.`cliente_complementoci` AS `complementoci`,
  ifnull(`c`.`cdi_codigoclasificador`, 5) AS `cdi_codigoclasificador`,
  `e`.`estado_descripcion` AS `estado_descripcion`,
  `e`.`estado_tipo` AS `estado_tipo`,
  `e`.`estado_color` AS `estado_color`,
  `m`.`moneda_descripcion` AS `moneda_descripcion`,
  `m`.`moneda_tc` AS `moneda_tc`,
  `f`.`forma_nombre` AS `forma_nombre`,
  `x`.`usuario_nombre` AS `prevendedor`,
  ifnull(`fa`.`factura_enviada`, 0) AS `factura_enviada`
from
  ((((((((`venta` `v`
  left join `forma_pago` `f` on (`f`.`forma_id` = `v`.`forma_id`))
  left join `tipo_transaccion` `t` on (`t`.`tipotrans_id` = `v`.`tipotrans_id`))
  left join `usuario` `u` on (`u`.`usuario_id` = `v`.`usuario_id`))
  left join `cliente` `c` on (`c`.`cliente_id` = `v`.`cliente_id`))
  left join `estado` `e` on (`e`.`estado_id` = `v`.`estado_id`))
  left join `moneda` `m` on (`m`.`moneda_id` = `v`.`moneda_id`))
  left join `usuario` `x` on (`x`.`usuario_id` = `v`.`usuarioprev_id`))
  left join `factura` `fa` on (`fa`.`venta_id` = `v`.`venta_id`))
order by
  `v`.`venta_id` desc;















UPDATE dosificacion
SET
  dosificacion_fechahora = 'now()',
  dosificacion_numfact = 0,
  dosificacion_leyenda1 = 'ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS, EL USO ILÍCITO SERÁ SANCIONADO PENALMENTE DE ACUERDO A LEY.',
  dosificacion_leyenda2 = '',
  dosificacion_leyenda3 = 'ESTE DOCUMENTO ES LA REPRESENTACIÓN GRÁFICA DE UN DOCUMENTO FISCAL DIGITAL EMITIDO EN UNA MODALIDAD DE FACTURACIÓN EN LÍNEA.',
  dosificacion_leyenda4 = '',
  dosificacion_leyenda5 = 'ESTE DOCUMENTO ES LA REPRESENTACIÓN GRÁFICA DE UN DOCUMENTO FISCAL DIGITAL EMITIDO FUERA DE LÍNEA, VERIFIQUE SU ENVÍO CON SU PROVEEDOR O EN LA PÁGINA WEB WWW.IMPUESTOS.GOB.BO',
  dosificacion_sucursal = '0',
  dosificacion_sincronizacion = 'https://siatrest.impuestos.gob.bo/v2/FacturacionSincronizacion?wsdl',
  dosificacion_recepcioncompras = 'https://siatrest.impuestos.gob.bo/v2/ServicioRecepcionCompras?wsdl',
  dosificacion_operaciones = 'https://siatrest.impuestos.gob.bo/v2/FacturacionOperaciones?wsdl',
  dosificacion_obtencioncodigos = 'https://siatrest.impuestos.gob.bo/v2/FacturacionCodigos?wsdl',
  dosificacion_notacredito = 'https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioFacturacionDocumentoAjuste?wsdl',
  dosificacion_factura = 'https://siatrest.impuestos.gob.bo/v2/ServicioFacturacionCompraVenta?wsdl',
  dosificacion_facturaservicios = 'https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioFacturacionServicioBasico?wsdl',
  dosificacion_facturaglp = 'https://pilotosiat.impuestos.gob.bo/consulta/QR?',
  dosificacion_ruta = 'https://siat.impuestos.gob.bo/consulta/QR?',
  dosificacion_cuismasivo = '',
  dosificacion_cufdmasivo = '',
  docsec_codigoclasificador = 1,
  tipofac_codigo = 1,
  dosificacion_cafc = '',
  dosificacion_glpelectronica = 'https://siatrest.impuestos.gob.bo/v2/ServicioFacturacionElectronica?wsdl',
  dosificacion_telecomunicaciones = 'https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioFacturacionTelecomunicaciones?wsdl',
  dosificacion_entidadesfinancieras = '',
  dosificacion_numerotransmes = 2980,
  dosificacion_mesactual = 9
WHERE
  dosificacion_id = 1;


UPDATE dosificacion
SET
  estado_id = 1,
  empresa_id = 1,
  dosificacion_fechahora = 'now()',
  dosificacion_fechalimite = 'now()',
  dosificacion_numfact = ,
  dosificacion_leyenda1 = 'ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS, EL USO ILÍCITO SERÁ SANCIONADO PENALMENTE DE ACUERDO A LEY.',
  dosificacion_leyenda2 = '',
  dosificacion_leyenda3 = 'ESTE DOCUMENTO ES LA REPRESENTACIÓN GRÁFICA DE UN DOCUMENTO FISCAL DIGITAL EMITIDO EN UNA MODALIDAD DE FACTURACIÓN EN LÍNEA.',
  dosificacion_leyenda4 = '',
  dosificacion_leyenda5 = 'ESTE DOCUMENTO ES LA REPRESENTACIÓN GRÁFICA DE UN DOCUMENTO FISCAL DIGITAL EMITIDO FUERA DE LÍNEA, VERIFIQUE SU ENVÍO CON SU PROVEEDOR O EN LA PÁGINA WEB WWW.IMPUESTOS.GOB.BO',
  dosificacion_sucursal = '0',
  dosificacion_sincronizacion = 'https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionSincronizacion?wsdl',
  dosificacion_recepcioncompras = 'https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioRecepcionCompras?wsdl',
  dosificacion_operaciones = 'https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionOperaciones?wsdl',
  dosificacion_obtencioncodigos = 'https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionCodigos?wsdl',
  dosificacion_notacredito = 'https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioFacturacionDocumentoAjuste?wsdl',
  dosificacion_factura = 'https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioFacturacionCompraVenta?wsdl',
  dosificacion_facturaservicios = 'https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioFacturacionServicioBasico?wsdl',
  dosificacion_facturaglp = 'https://pilotosiat.impuestos.gob.bo/consulta/QR?',
  dosificacion_codsucursal = '',
  dosificacion_cuismasivo = '',
  dosificacion_cufdmasivo = '',
  dosificacion_glpelectronica = 'https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioFacturacionElectronica?wsdl',
  dosificacion_telecomunicaciones = 'https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioFacturacionTelecomunicaciones?wsdl',
  dosificacion_entidadesfinancieras = 'https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioFacturacionEntidadFinanciera?wsdl',
  dosificacion_numerotransmes = '11',
  dosificacion_mesactual = '9'
WHERE
  dosificacion_id = 1;



actualizar tabla bitacora detalle compra
--------------- SQL ---------------

ALTER TABLE `detalle_compra_bitacora` ADD COLUMN `codigo_bitacora` VARCHAR(30) DEFAULT NULL;


--------------- SQL ---------------

ALTER TABLE `ingresos` MODIFY COLUMN `ingreso_fecha` DATETIME DEFAULT NULL;

--------------- SQL ---------------

ALTER TABLE `egresos` MODIFY COLUMN `egreso_fecha` DATETIME DEFAULT NULL;


verificar espacio utilizado por la base de datos

SELECT table_schema,
       sum(data_length + index_length) / 1024 / 1024 "Size (MB)"
FROM information_schema.tables
GROUP BY table_schema;
 
 
select * from venta
where venta_id in (select max(venta_id) from venta)
 
 
 
 
 
 
 
 

 
 
 
 
 
 
 
 
 
 
 
 
 * * 
 */

