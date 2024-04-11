<?php
/*
 
select * 
from venta
where venta_id = (select MAX(venta_id) from venta)

 --------------- SQL ---------------

ALTER TABLE `usuario` ADD COLUMN `usuario_autorizado` INTEGER DEFAULT 0;

  
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
truncate factura_datos;
truncate detalle_factura;
truncate pedido;
truncate detalle_pedido;
truncate cliente;
truncate almacenes;
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
truncate sucursales;
truncate ingresos;
truncate egresos;
truncate servicio;
truncate detalle_serv;
truncate credito;
truncate cuota;
truncate producto;
truncate inventario;
truncate ci_session;
truncate caja;
truncate bitacora_caja;
truncate bitacora;
truncate factura_servicios;
truncate detalle_factura_servicios;
truncate lectura;

update parametros
set 
parametro_numrecing = 0,
parametro_numrecegr = 0;


 truncate cliente;
INSERT INTO `cliente` (`cliente_id`, `estado_id`, `tipocliente_id`, `categoriaclie_id`, `usuario_id`, `cliente_codigo`, `cliente_nombre`, `cliente_ci`, `cliente_direccion`, `cliente_telefono`, `cliente_celular`, `cliente_foto`, `cliente_email`, `cliente_nombrenegocio`, `cliente_aniversario`, `cliente_latitud`, `cliente_longitud`, `cliente_nit`, `cliente_razon`, `cliente_departamento`, `zona_id`, `lun`, `mar`, `mie`, `jue`, `vie`, `sab`, `dom`, `cliente_ordenvisita`, `cliente_clave`, `cliente_codactivacion`, `cliente_fechaactivacion`, `cliente_puntos`, `cdi_codigoclasificador`, `cliente_complementoci`, `cliente_excepcion`, `id_facebook`) VALUES 
  (1,1,1,1,0,'EN45770','ENTIDAD CON PERSONERIA JURIDICA','99001','-','','',NULL,'','-',NULL,NULL,NULL,'99001','ENTIDAD CON PERSONERIA JURIDICA','-',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,5,'',0,NULL),
  (2,1,1,1,0,'CO91862','CONTROL TRIBUTARIO','99002','-','','',NULL,'','-',NULL,NULL,NULL,'99002','CONTROL TRIBUTARIO','-',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,5,'',0,NULL),
  (3,1,1,1,0,'VE33623','VENTAS MENORES DEL DIA','99003','-','','',NULL,'','-',NULL,NULL,NULL,'99003','VENTAS MENORES DEL DIA','-',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,5,'',0,NULL),
  (4,1,1,1,0,'SN84613','SIN NOMBRE','1234','-','','',NULL,'','-',NULL,NULL,NULL,'1234','SIN NOMBRE','-',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'',0,NULL);
COMMIT;
 
truncate usuario;

INSERT INTO `usuario` (`usuario_id`, `estado_id`, `tipousuario_id`, `usuario_nombre`, `usuario_email`, `usuario_login`, `usuario_clave`, `usuario_imagen`, `parametro_id`, `usuario_ci`, `puntoventa_codigo`, `usuario_turno`, `usuario_inicioturno`, `usuario_finturno`, `usuario_autorizado`) VALUES 
  (1,1,1,'Super Usuario','superusuario@micorreo.com','super','1b3231655cebb7a1f783eddf27d254ca','',1,'0',1,'MAсNA','15:00:00','16:00:00',0),
  (2,1,1,'Administrador','admininstrador@micorreo.com','admin','21232f297a57a5a743894a0e4a801fc3','',1,'2323SAFSAF',0,'NOCHE','19:00:00','11:50:00',0);
COMMIT;


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

update sistema
set 
sistema_version = '2.5'
 
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







ALTER TABLE `usuario` ADD COLUMN `usuario_turno` varchar(50) DEFAULT NULL;
ALTER TABLE `usuario` ADD COLUMN `usuario_inicioturno` time DEFAULT NULL;
ALTER TABLE `usuario` ADD COLUMN `usuario_finturno` time DEFAULT NULL;
ALTER TABLE `pedido` ADD COLUMN `mesa_id` int(11) DEFAULT NULL;

update usuario
set 
usuario_turno = 'DIARIO'
,usuario_inicioturno = '08:00'
,usuario_finturno = '18:00';




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

drop table motivo_anulacion_borrar;






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
 
 
 
 
--------------- SQL MESA ---------------

ALTER TABLE `pedido` ADD COLUMN `mesa_id` INTEGER DEFAULT NULL;
 
 
 
 

 
truncate venta;
truncate detalle_venta;
truncate factura;
truncate detalle_factura;
truncate pedido;
truncate detalle_pedido;
truncate cliente;
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

update dosificacion 
set 
dosificacion_sucursal = 11,
dosificacion_numfact = 0,
dosificacion_numerotransmes = 0,
dosificacion_mesactual = 0;

update `empresa`
set

empresa_direccion = 'CALLE NERY ESQ. FOURNIER Nº 3134',
empresa_departamento = 'EL ALTO',
empresa_ubicacion = 'AL ALTO - BOLIVIA',
empresa_nombresucursal = 'LIBRERIA LA ULTIMA LLAMADA *** SUC. 11';

update sucursales set
sucursal_nombre	= 'CAMBIAR A COMERCIAL',
sucursal_url =	'https://www.ximplemanweb.com/ultimallamadacom_suc11/venta/ventas';


 
 
 
 
update detalle_factura set
descip_detfact = 'TASA DE REGULACION AFCOOP',
exento_detfact = 'SI'

where 
descip_detfact = 'AFCOOP' and
id_fact in (select id_fact from factura
where estado_fact = 'PENDIENTE') 
 
 
UPDATE producto
SET producto_nombre = REPLACE(producto_nombre, '"', '``'); 
 
 update producto_almacen p, categoria_producto c
set p.categoria_id = c.categoria_id
where p.producto_marca = c.categoria_nombre

 
 
  
  
update factura
set 
factura_codigoestado = 908,
factura_codigorecepcion = '56jhgj7657-541-11465-654687j8',
factura_transaccion = 1,
factura_codigodescripcion = 'VALIDADA',
factura_enviada = 1,
estado_id = 1,
factura_nit = '1234',
factura_razonsocial = 'SIN NOMBRE',
factura_subtotal =  factura_efectivo,
factura_total = factura_efectivo

where factura_id in 
(select factura_id from factura where factura_numero = 54791)   


truncate estado;

INSERT INTO `estado` (`estado_id`, `estado_descripcion`, `estado_tipo`, `estado_color`) VALUES 
  (1,'ACTIVO',1,''),
  (2,'INACTIVO',1,'b08292'),
  (3,'ANULADO',1,'666666'),
  (4,'ANULADO',3,'666666'),
  (5,'PENDIENTE',3,'ffea00'),
  (6,'TERMINADO',3,'a781ee'),
  (7,'ENTREGADO',3,'3e98f9'),
  (8,'PENDIENTE',4,'ffea00'),
  (9,'CANCELADO',4,'666666'),
  (10,'ABIERTO',5,'36fa00'),
  (11,'PENDIENTE',5,'ffea00'),
  (12,'APROBADO',5,'29AF01'),
  (13,'ENTREGADO',5,'3e98f9'),
  (14,'REBOTADO',5,'FF2E00'),
  (15,'CANCELADO',5,'C06402'),
  (16,'CREDITO',3,'1fc4ae'),
  (17,'PENDIENTE',6,'ffea00'),
  (18,'CORTE',6,'DDF456'),
  (19,'PULIDO',6,'DEFR45'),
  (20,'ENTRANTE',6,'BA4356'),
  (21,'TEMPLADO',6,'BF3415'),
  (22,'PARA ENTREGA',6,'00ffff'),
  (23,'ENTREGADO',6,'3e98f9'),
  (24,'PENDIENTE',7,'ffea00'),
  (25,'EN PROCESO',7,'BA4356'),
  (26,'TERMINADO',7,'a781ee'),
  (27,'ANULADO',4,'666666'),
  (28,'EN PROCESO',3,'ffff00'),
  (29,'PENDIENTE',8,'ffea00'),
  (30,'ABIERTA',8,'36fa00'),
  (31,'CERRADA',8,'00ff00'),
  (32,'ANULADA',8,'666666'),
  (33,'PENDIENTE',9,'ffea00'),
  (34,'ADQUIRIDO',9,'6ed17a'),
  (35,'ANULADO',9,'666666'),
  (36,'PENDIENTE',1,'ffea00'),
  (37,'RESERVADO',1,'6ed17a'),
  (38,'LIBRE',10,'BF3415'),
  (39,'OCUPADA',10,'1fc4ae'),
  (40,'RESERVADA',10,'666666'),
  (41,'MANTENIMIENTO',10,'29AF01');
COMMIT;



INSERT INTO `rol` (`rol_id`, `estado_id`, `rol_nombre`, `rol_descripcion`, `rol_idfk`) VALUES 
  (1,1,'ADMINISTRAR COMPRAS',NULL,0),
  (2,1,'REGISTRAR COMPRAS',NULL,1),
  (3,1,'REGISTRAR PRODUCTO EN COMPRA',NULL,1),
  (4,1,'REGISTRAR/MODIFICAR PROVEEDORES EN COMPRA',NULL,1),
  (5,1,'FINALIZAR COMPRA',NULL,1),
  (6,1,'MODIFICAR DETALLE COMPRA',NULL,1),
  (7,1,'ELIMINAR DETALLE DE UNA COMPRA',NULL,1),
  (8,1,'ANULAR COMPRAS',NULL,1),
  (9,1,'MODIFICAR FECHA DE UNA COMPRA',NULL,1),
  (10,1,'IMPRIMIR LISTA DE COMPRAS',NULL,1),
  (11,1,'VER REPORTES DE COMPRAS',NULL,1),
  (12,1,'ADMINISTRAR VENTAS',NULL,0),
  (13,1,'PEDIDO EN VENTAS',NULL,12),
  (14,1,'VACIAR DETALLE DE UNA VENTA',NULL,12),
  (15,1,'PONER PRECIOS(VENTA Y COSTO) EN 0(CERO)',NULL,12),
  (16,1,'PONER PRECIOS DE VENTA A PRECIOS DE COSTO',NULL,12),
  (17,1,'IMPRIMIR FACTURA',NULL,12),
  (18,1,'MOSTRAR VENTAS REALIZADAS','',12),
  (19,1,'MODIFICAR DATOS GENERALES DE UNA VENTA',NULL,12),
  (20,1,'MODIFICAR DETALLE/CLIENTE DE UNA VENTA',NULL,12),
  (21,1,'IMPRIMIR NOTA DE VENTA(RECIBO)','',12),
  (22,1,'ANULAR VENTA',NULL,12),
  (23,1,'BUSQUEDA DE VENTAS',NULL,12),
  (24,1,'ADMINISTRAR INVENTARIO',NULL,0),
  (25,1,'BUSQUEDA DE PRODUCTOS EN INVENTARIO',NULL,24),
  (26,1,'ACTUALIZAR INVENTARIO',NULL,24),
  (27,1,'MOSTRAR TODO EL INVENTARIO',NULL,24),
  (28,1,'BUSCAR PRODUCTOS DUPLICADOS',NULL,24),
  (29,1,'VER KARDEX DE EXISTENCIA',NULL,24),
  (30,1,'ADMINISTRAR PEDIDOS',NULL,0),
  (31,1,'REGISTRAR PEDIDOS',NULL,30),
  (32,1,'IMPRIMIR COMPROBANTE DE PEDIDO',NULL,30),
  (33,1,'MODIFICAR DATOS DE PEDIDO',NULL,30),
  (34,1,'ANULAR PEDIDO',NULL,30),
  (35,1,'CONSOLIDAR PEDIDO',NULL,30),
  (36,1,'ADMINISTRAR COTIZACIONES',NULL,0),
  (37,1,'REGISTRAR COTIZACION',NULL,36),
  (38,1,'MODIFICAR COTIZACION',NULL,36),
  (39,1,'IMPRIMIR COTIZACION',NULL,36),
  (40,1,'ELIMINAR COTIZACION',NULL,36),
  (41,1,'ADMINISTRAR DEUDAS POR PAGAR',NULL,0),
  (42,1,'VER PLAN DE PAGOS',NULL,41),
  (43,1,'PAGAR CUOTAS',NULL,41),
  (44,1,'VER REPORTE DE DEUDAS',NULL,41),
  (45,1,'MODIFICAR CUOTAS',NULL,41),
  (46,1,'ELIMINAR CUOTAS',NULL,41),
  (47,1,'ADMINISTRAR DEUDAS POR COBRAR',NULL,0),
  (48,1,'VER PLAN DE PAGOS',NULL,47),
  (49,1,'COBRAR CUOTAS',NULL,47),
  (50,1,'VER REPORTE DE DEUDAS',NULL,47),
  (51,1,'MODIFICAR CUOTAS',NULL,47),
  (52,1,'ELIMINAR CUOTAS',NULL,47),
  (53,1,'ADMINISTRAR INGRESOS',NULL,0),
  (54,1,'REGISTRAR INGRESOS',NULL,53),
  (55,1,'MODIFICAR INGRESOS',NULL,53),
  (56,1,'ELIMINAR INGRESOS',NULL,53),
  (57,1,'BUSCAR INGRESOS',NULL,53),
  (58,1,'IMPRIMIR INGRESOS',NULL,53),
  (59,1,'ADMINISTRAR EGRESOS',NULL,0),
  (60,1,'REGISTRAR EGRESOS',NULL,59),
  (61,1,'MODIFICAR EGRESOS',NULL,59),
  (62,1,'ELIMINAR EGRESOS',NULL,59),
  (63,1,'BUSCAR EGRESOS',NULL,59),
  (64,1,'IMPRIMIR EGRESOS',NULL,59),
  (65,1,'ADMINISTRAR CAMBIOS/DEVOLUCIONES',NULL,0),
  (66,1,'REGISTRAR CAMBIO/DEVOLUCION',NULL,65),
  (67,1,'MODIFICAR CAMBIO/DEVOLUCION',NULL,65),
  (68,1,'ANULAR CAMBIO/DEVOLUCION',NULL,65),
  (69,1,'ADMINISTRAR SERVICIOS',NULL,0),
  (70,1,'REGISTRAR SERVICIOS',NULL,69),
  (71,1,'MODIFCAR SERVICIOS',NULL,69),
  (72,1,'TODOS LOS SERVICIOS',NULL,69),
  (73,1,'BUSCAR SERVICIOS POR CODIGO',NULL,69),
  (74,1,'BUSCAR KARDEX DE UN DETALLE DE SERVICIO',NULL,69),
  (75,1,'BUSCAR KARDEX DE UN CLIENTE',NULL,69),
  (76,1,'REPORTE DIARIO',NULL,69),
  (77,1,'ANULAR SERVICIO',NULL,69),
  (78,1,'ELIMINAR SERVICIO',NULL,69),
  (79,1,'IMPRESI??N DE INFORME TECNICO','IMPRIMIR INFORME TECNICO',69),
  (80,1,'REGISTRAR INFORME DEL TECNICO',NULL,69),
  (81,1,'VER/ASIGNAR INSUMOS',NULL,69),
  (82,1,'ANULAR DETALLE DE SERVICIO',NULL,69),
  (83,1,'ELIMINAR DETALLE DE SERVICIO',NULL,69),
  (84,1,'COBRAR SERVICIO',NULL,69),
  (85,1,'PASAR SERVICIO A CREDITO',NULL,69),
  (86,1,'MODIFCAR DETALLE DE SERVICIO',NULL,69),
  (87,1,'COBRAR DETALLE DE SERVICIO',NULL,69),
  (88,1,'PASAR A CREDITO UN DETALLE DE SERVICIO',NULL,69),
  (89,1,'ADMINISTRAR ORDENES DE PAGO',NULL,0),
  (90,1,'GENERAR ORDENES DE PAGO',NULL,89),
  (91,1,'PENDIENTES',NULL,89),
  (92,1,'PAGADAS',NULL,89),
  (93,1,'PAGAR',NULL,89),
  (94,1,'ADMINISTRAR CLIENTES',NULL,0),
  (95,1,'REGISTRAR CLIENTES',NULL,94),
  (96,1,'VER TODOS LOS CLIENTES',NULL,94),
  (97,1,'IMPRIMIR LISTA DE CLIENTES',NULL,94),
  (98,1,'MODIFICAR CLIENTES',NULL,94),
  (99,1,'ELIMINAR CLIENTES',NULL,94),
  (100,1,'GENERAR PEDIDOS',NULL,94),
  (101,1,'VENTA',NULL,94),
  (102,1,'ADMINISTRAR PRODUCTOS',NULL,0),
  (103,1,'REGISTRAR PRODUCTOS',NULL,102),
  (104,1,'VER TODOS LOS PRODUCTOS',NULL,102),
  (105,1,'VER EXISTENCIA MINIMA DE PRODUCTOS',NULL,102),
  (106,1,'IMPRIMIR LISTA DE PRODUCTOS',NULL,102),
  (107,1,'MODIFICAR PRODUCTOS',NULL,102),
  (108,1,'ELIMINAR PRODUCTOS',NULL,102),
  (109,1,'CATALOGO DE IM?GENES',NULL,102),
  (110,1,'ADMINISTRAR PROVEEDORES',NULL,0),
  (111,1,'REGISTRAR PROVEEDORES',NULL,110),
  (112,1,'MODIFICAR PROVEEDORES',NULL,110),
  (113,1,'IMPRIMIR LISTA DE PROVEEDORES',NULL,110),
  (114,1,'ADMINISTRAR CATEGORIA DE CLIENTES/NEGOCIO',NULL,0),
  (115,1,'ADMINISTRAR CLIENTES/ZONAS',NULL,0),
  (116,1,'ADMINISTRAR CATEGORIA EGRESO',NULL,0),
  (117,1,'ADMINSTRAR CATEGORIA INGRESO',NULL,0),
  (118,1,'ADMINISTRAR CATEGORIA DE PRODUCTOS',NULL,0),
  (119,1,'ADMINSTRAR CATEGORIA DE SERVICIOS',NULL,0),
  (120,1,'ADMINSTRAR CATEGORIA DE TRABAJOS',NULL,0),
  (121,1,'ADMINSITRAR EMPRESA',NULL,0),
  (122,1,'ADMINISTRAR ESTADO',NULL,0),
  (123,1,'ADMINSTRAR FORMAS DE PAGO',NULL,0),
  (124,1,'ADMINSTRAR MONEDAS',NULL,0),
  (125,1,'ADMINISTRAR PRESENTACION',NULL,0),
  (126,1,'ADMINISTRAR PROCEDENCIA',NULL,0),
  (127,1,'ADMINISTRAR SUB CATEGORIA  DE SERVICIO',NULL,0),
  (128,1,'REGISTRAR SUB CATEGORIAS',NULL,127),
  (129,1,'ASIGNAR/QUITAR INSUMOS',NULL,127),
  (130,1,'MODIFCAR SUB CATEGORIAS',NULL,127),
  (131,1,'ELIMINAR SUB CATEGORIAS',NULL,127),
  (132,1,'ADMINISTRAR TIPOS DE CLIENTE',NULL,0),
  (133,1,'ADMINISTRAR TIPOS DE TRANSACCION',NULL,0),
  (134,1,'ADMINISTRAR TIPOS DE SERVICIO',NULL,0),
  (135,1,'ADMINISTRAR TIEMPO DE USO',NULL,0),
  (136,1,'ADMINISTRAR UNIDAD',NULL,0),
  (137,1,'ADMINISTRAR REPORTES DE COMPRAS',NULL,0),
  (138,1,'REPORTE DE EGRESOS','REPORTE DE EGRESOS DEL USUARIO LOGUEADO',0),
  (139,1,'DESPACHO','PARA DESPACHAR VENTAS',0),
  (140,1,'REPORTE DE INGRESOS','REPORTE DE INGRESOS DEL USUARIO LOGUEADO',0),
  (141,1,'REPORTE DE MOVIMIENTO DIARIO','SI ES ADMINISTRADOR MUESTRA TODO EL REPORTE, CASO CONTRARIO SOLO EL REPORTE DEL USUARIO LOGUEADO',0),
  (142,1,'REPORTE DE SERVICIOS',NULL,0),
  (143,1,'REPORTE DE COMISIONES',NULL,0),
  (144,1,'REPORTE DE EMBARQUE',NULL,0),
  (145,1,'ADMINISTRAR ROLES',NULL,0),
  (146,1,'ADMINISTRAR ROL USUARIO',NULL,0),
  (147,1,'ADMINISTRAR TIPOS DE USUARIO',NULL,0),
  (148,1,'ADMINISTRAR USUARIOS',NULL,0),
  (149,1,'ADMINISTRAR DOSIFICACION',NULL,0),
  (150,1,'REGISTRAR DOSIFICACION',NULL,149),
  (151,1,'MODIFICAR DOSIFICACION',NULL,149),
  (152,1,'LIBRO DE VENTAS',NULL,0),
  (153,1,'LIBRO DE COMPRAS',NULL,0),
  (154,1,'VERIFICADOR DE FACTURA',NULL,0),
  (155,1,'ADMINISTRAR WEB',NULL,0),
  (156,1,'REPORTE DE VENTAS',NULL,0),
  (157,1,'REPORTE GRAFICO COMPRAS/VENTAS',NULL,0),
  (158,1,'MONITOR DE VENTA','TE MUESTRA EN UN MONITOR EN TIEMPO REAL LAS VENTAS',0),
  (159,1,'TIPO DE RESPUESTA','TIPO DE RESPUESTA DE UN PEDIDO',0),
  (160,1,'PRECIO DE VENTA',NULL,12),
  (161,1,'PRECIO FACTOR',NULL,12),
  (162,1,'PRECIO FACTOR 1',NULL,12),
  (163,1,'PRECIO FACTOR 2',NULL,12),
  (164,1,'PRECIO FACTOR 3',NULL,12),
  (165,1,'PRECIO FACTOR 4',NULL,12),
  (166,1,'ORDENES DE TRABAJO',NULL,0),
  (167,1,'REGISTRAR ORDENES DE TRABAJO',NULL,166),
  (168,1,'PASAR ORDEN DE TRABAJO A VENTAS',NULL,166),
  (169,1,'EDITAR ORDENES DE TRABAJO',NULL,166),
  (170,1,'ANULAR ORDENES DE TRABAJO',NULL,166),
  (171,1,'VER REPORTE DE MOVIMIENTO DIARIO DE OTROS USUARIOS','PUEDE VER EL REPORTE DE MOVIMIENTO DIARIO DE OTROS USUARIOS',141),
  (172,1,'RECEPCIONAR PROCESO',NULL,166),
  (173,1,'TERMINAR PROCESO',NULL,166),
  (174,1,'ADMINISTRAR COCINA','ADMINISTRA PARAMETROS PARA EL MODULO DE COCINA',0),
  (175,1,'DESTINO PRODUCTO',NULL,174),
  (176,1,'ASIGNAR UN USUARIO A UN DESTINO','SE ASIGNA UN USUARIO A UN DESTINO PRODUCTO',174),
  (177,1,'ELIMINAR USUARIO Y DESTINO',NULL,174),
  (178,1,'RECEPCION Y DESPACHO DE PEDIDOS',NULL,174),
  (179,1,'VENTAS ONLINE',NULL,0),
  (180,1,'ENTREGAS',NULL,0),
  (181,1,'PEDIDOS DIARIOS',NULL,0),
  (182,1,'MODIFICAR SERVICIO CUANDO YA FUE ENTREGADO','PERMITE MODIFICAR EL SERVICIO CUANDO YA FUE ENTREGADO EL MISMO',69),
  (183,1,'MODIFICAR PRECIO DEL PRODUCTO','',30),
  (184,1,'CERTIFICADO DE GARANTIA','',12),
  (185,1,'PROMOCIONES','',12),
  (186,1,'IMPRIMIR TODAS LAS NOTAS DE VENTA','DEL RESULTADO DE LA BUSQUEDA EN VENTAS DEL DIA, IMPRIME TODAS LAS NOTAS DE VENTA',12),
  (187,1,'GENERAR FACTURA','',12),
  (188,1,'MODIFICAR FECHA Y HORA','',12),
  (189,1,'PREFERENCIA','',0),
  (190,1,'PRODUCTO PREFERENCIA','',0),
  (191,1,'ADMINISTRAR CLASIFICADOR','',0),
  (192,1,'MOSTRAR INVENTARIO CLASIFICADOR','',191),
  (193,1,'ADMINISTRAR INVENTARIO INDIVIDUAL','',0),
  (194,1,'VER INVENTARIO INDIVIDUAL DE TODOS LOS USUARIOS','',193),
  (195,1,'ELIMINAR INVENTARIO INDIVIDUAL','',193),
  (196,1,'ASIGNAR INVENTARIO INDIVIDUAL','',193),
  (197,1,'ADMINISTRAR MESAS','',0),
  (198,1,'ASIGNAR PRODUCTOS  A UNA MESA',NULL,197),
  (199,1,'IMPRIMIR COMANDA',NULL,197),
  (200,1,'REALIZAR CAMBIOS DE MESA',NULL,197),
  (201,1,'FACTURAR',NULL,197),
  (202,1,'MODIFICAR EL ITEM DE CONSUMO DE UNA MESA',NULL,197),
  (203,1,'ELIMINAR EL ITEM DE CONSUMO DE UNA MESA',NULL,197),
  (204,1,'ELIMINAR MESA',NULL,197);
COMMIT;
 * 
 * * 
 */

