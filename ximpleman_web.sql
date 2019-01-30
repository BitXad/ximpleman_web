# SQL Manager 2010 for MySQL 4.5.0.9
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : ximpleman_web


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;

SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `ximpleman_web`
    CHARACTER SET 'latin1'
    COLLATE 'latin1_swedish_ci';

USE `ximpleman_web`;

#
# Structure for the `articulo` table : 
#

DROP TABLE IF EXISTS `articulo`;

CREATE TABLE `articulo` (
  `articulo_id` int(11) NOT NULL AUTO_INCREMENT,
  `estadopag_id` int(11) DEFAULT NULL,
  `seccion_id` int(11) DEFAULT NULL,
  `slide_id` int(11) DEFAULT NULL,
  `articulo_titulo` varchar(150) DEFAULT NULL,
  `articulo_descripcion` varchar(250) DEFAULT NULL,
  `articulo_texto` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`articulo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `boton` table : 
#

DROP TABLE IF EXISTS `boton`;

CREATE TABLE `boton` (
  `boton_id` int(11) NOT NULL AUTO_INCREMENT,
  `estadopag_id` int(11) DEFAULT NULL,
  `boton_titulo` varchar(250) DEFAULT NULL,
  `boton_descripcion` varchar(250) DEFAULT NULL,
  `boton_enlace` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`boton_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `boton_articulo` table : 
#

DROP TABLE IF EXISTS `boton_articulo`;

CREATE TABLE `boton_articulo` (
  `botonartic_id` int(11) NOT NULL AUTO_INCREMENT,
  `articulo_id` int(11) NOT NULL,
  `boton_id` int(11) NOT NULL,
  PRIMARY KEY (`botonartic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `boton_slide` table : 
#

DROP TABLE IF EXISTS `boton_slide`;

CREATE TABLE `boton_slide` (
  `botonslide_id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_id` int(11) NOT NULL,
  `boton_id` int(11) NOT NULL,
  PRIMARY KEY (`botonslide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `cambio_producto` table : 
#

DROP TABLE IF EXISTS `cambio_producto`;

CREATE TABLE `cambio_producto` (
  `cambio_producto_id` int(11) NOT NULL AUTO_INCREMENT,
  `cambio_producto_fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cambio_egreso` float NOT NULL,
  `cambio_ingreso` float NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cambio_producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

#
# Structure for the `categ_imagen` table : 
#

DROP TABLE IF EXISTS `categ_imagen`;

CREATE TABLE `categ_imagen` (
  `categimg_id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen_id` int(11) NOT NULL,
  `catimg_id` int(11) NOT NULL,
  PRIMARY KEY (`categimg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `categoria_cliente` table : 
#

DROP TABLE IF EXISTS `categoria_cliente`;

CREATE TABLE `categoria_cliente` (
  `categoriaclie_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoriaclie_descripcion` varchar(150) DEFAULT NULL,
  `categoriaclie_porcdesc` float DEFAULT NULL,
  `categoriaclie_montodesc` float DEFAULT NULL,
  PRIMARY KEY (`categoriaclie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Structure for the `categoria_clientezona` table : 
#

DROP TABLE IF EXISTS `categoria_clientezona`;

CREATE TABLE `categoria_clientezona` (
  `categoriacliezona_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `categoriacliezona_descripcion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`categoriacliezona_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Structure for the `categoria_egreso` table : 
#

DROP TABLE IF EXISTS `categoria_egreso`;

CREATE TABLE `categoria_egreso` (
  `id_categr` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_categr` varchar(50) NOT NULL,
  `descrip_categr` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_categr`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `categoria_imagen` table : 
#

DROP TABLE IF EXISTS `categoria_imagen`;

CREATE TABLE `categoria_imagen` (
  `catimg_id` int(11) NOT NULL AUTO_INCREMENT,
  `estadopag_id` int(11) DEFAULT NULL,
  `galeria_id` int(11) DEFAULT NULL,
  `catimg_nombre` varchar(250) DEFAULT NULL,
  `catimg_descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`catimg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `categoria_ingreso` table : 
#

DROP TABLE IF EXISTS `categoria_ingreso`;

CREATE TABLE `categoria_ingreso` (
  `id_cating` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_cating` varchar(50) NOT NULL,
  `descrip_cating` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_cating`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `categoria_insumo` table : 
#

DROP TABLE IF EXISTS `categoria_insumo`;

CREATE TABLE `categoria_insumo` (
  `catinsumo_id` int(11) NOT NULL AUTO_INCREMENT,
  `subcatserv_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`catinsumo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

#
# Structure for the `categoria_producto` table : 
#

DROP TABLE IF EXISTS `categoria_producto`;

CREATE TABLE `categoria_producto` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_nombre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

#
# Structure for the `categoria_servicio` table : 
#

DROP TABLE IF EXISTS `categoria_servicio`;

CREATE TABLE `categoria_servicio` (
  `catserv_id` int(11) NOT NULL AUTO_INCREMENT,
  `catserv_descripcion` varchar(80) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`catserv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Structure for the `categoria_trabajo` table : 
#

DROP TABLE IF EXISTS `categoria_trabajo`;

CREATE TABLE `categoria_trabajo` (
  `cattrab_id` int(11) NOT NULL AUTO_INCREMENT,
  `cattrab_descripcion` varchar(150) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cattrab_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Structure for the `ci_session` table : 
#

DROP TABLE IF EXISTS `ci_session`;

CREATE TABLE `ci_session` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `cliente` table : 
#

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `tipocliente_id` int(11) DEFAULT NULL,
  `categoriaclie_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cliente_codigo` varchar(20) DEFAULT NULL,
  `cliente_nombre` varchar(150) DEFAULT NULL,
  `cliente_ci` varchar(50) DEFAULT NULL,
  `cliente_direccion` varchar(250) DEFAULT NULL,
  `cliente_telefono` varchar(50) DEFAULT NULL,
  `cliente_celular` varchar(50) DEFAULT NULL,
  `cliente_foto` varchar(250) DEFAULT NULL,
  `cliente_email` varchar(50) DEFAULT NULL,
  `cliente_nombrenegocio` varchar(250) DEFAULT NULL,
  `cliente_aniversario` date DEFAULT NULL,
  `cliente_latitud` varchar(50) DEFAULT NULL,
  `cliente_longitud` varchar(50) DEFAULT NULL,
  `cliente_nit` bigint(20) DEFAULT NULL,
  `cliente_razon` varchar(150) DEFAULT NULL,
  `cliente_departamento` varchar(50) DEFAULT NULL,
  `zona_id` int(11) DEFAULT NULL,
  `lun` tinyint(1) DEFAULT NULL,
  `mar` tinyint(1) DEFAULT NULL,
  `mie` tinyint(1) DEFAULT NULL,
  `jue` tinyint(1) DEFAULT NULL,
  `vie` tinyint(1) DEFAULT NULL,
  `sab` tinyint(1) DEFAULT NULL,
  `dom` tinyint(1) DEFAULT NULL,
  `categoriacliezona_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5600 DEFAULT CHARSET=latin1;

#
# Structure for the `cliente_usuario` table : 
#

DROP TABLE IF EXISTS `cliente_usuario`;

CREATE TABLE `cliente_usuario` (
  `cliente_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `compra` table : 
#

DROP TABLE IF EXISTS `compra`;

CREATE TABLE `compra` (
  `compra_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `tipotrans_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `moneda_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `forma_id` int(11) DEFAULT NULL,
  `compra_fecha` date DEFAULT NULL,
  `compra_hora` time DEFAULT NULL,
  `compra_subtotal` float DEFAULT NULL,
  `compra_descuento` float DEFAULT NULL,
  `compra_descglobal` float DEFAULT NULL,
  `compra_total` float DEFAULT NULL,
  `compra_totalfinal` float DEFAULT NULL,
  `compra_efectivo` float DEFAULT NULL,
  `compra_cambio` float DEFAULT NULL,
  `compra_glosa` varchar(250) DEFAULT NULL,
  `compra_tipocambio` float DEFAULT NULL,
  `compra_chofer` varchar(100) DEFAULT NULL,
  `compra_placamovil` varchar(20) DEFAULT NULL,
  `compra_fechallegada` date DEFAULT NULL,
  `compra_horallegada` time DEFAULT NULL,
  `compra_numdoc` int(11) NOT NULL,
  `documento_respaldo_id` int(11) NOT NULL,
  `compra_caja` int(11) DEFAULT NULL,
  PRIMARY KEY (`compra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=558 DEFAULT CHARSET=latin1;

#
# Structure for the `cotizacion` table : 
#

DROP TABLE IF EXISTS `cotizacion`;

CREATE TABLE `cotizacion` (
  `cotizacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `cotizacion_fecha` date DEFAULT NULL,
  `cotizacion_validez` varchar(40) DEFAULT NULL,
  `cotizacion_formapago` varchar(40) DEFAULT NULL,
  `cotizacion_tiempoentrega` varchar(40) DEFAULT NULL,
  `cotizacion_fechahora` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cotizacion_total` float DEFAULT NULL,
  `cotizacion_glosa` varchar(255) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cotizacion_cliente` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`cotizacion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=1170;

#
# Structure for the `credito` table : 
#

DROP TABLE IF EXISTS `credito`;

CREATE TABLE `credito` (
  `credito_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `compra_id` int(11) DEFAULT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `credito_monto` float DEFAULT NULL,
  `credito_cuotainicial` float DEFAULT NULL,
  `credito_interesproc` float DEFAULT NULL,
  `credito_interesmonto` float DEFAULT NULL,
  `credito_numpagos` float DEFAULT NULL,
  `credito_fechalimite` date DEFAULT NULL,
  `credito_fecha` date DEFAULT NULL,
  `credito_hora` time DEFAULT NULL,
  `credito_tipo` varchar(50) DEFAULT NULL,
  `credito_tipointeres` int(11) DEFAULT NULL,
  PRIMARY KEY (`credito_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

#
# Structure for the `cuota` table : 
#

DROP TABLE IF EXISTS `cuota`;

CREATE TABLE `cuota` (
  `cuota_id` int(11) NOT NULL AUTO_INCREMENT,
  `credito_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `cuota_numcuota` int(11) DEFAULT NULL,
  `cuota_capital` float DEFAULT NULL,
  `cuota_interes` float DEFAULT NULL,
  `cuota_moradias` float DEFAULT NULL,
  `cuota_multa` float DEFAULT NULL,
  `cuota_subtotal` float DEFAULT NULL,
  `cuota_descuento` float DEFAULT NULL,
  `cuota_total` float DEFAULT NULL,
  `cuota_fechalimite` date DEFAULT NULL,
  `cuota_cancelado` float DEFAULT NULL,
  `cuota_fecha` date DEFAULT NULL,
  `cuota_hora` time DEFAULT NULL,
  `cuota_numercibo` int(11) DEFAULT NULL,
  `cuota_saldo` float DEFAULT NULL,
  `cuota_glosa` varchar(250) DEFAULT NULL,
  `cuota_saldocredito` int(11) DEFAULT NULL,
  PRIMARY KEY (`cuota_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

#
# Structure for the `detalle_compra` table : 
#

DROP TABLE IF EXISTS `detalle_compra`;

CREATE TABLE `detalle_compra` (
  `compra_id` int(11) NOT NULL,
  `moneda_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `detallecomp_id` int(11) NOT NULL AUTO_INCREMENT,
  `detallecomp_codigo` varchar(20) DEFAULT NULL,
  `detallecomp_cantidad` float DEFAULT NULL,
  `detallecomp_unidad` varchar(50) DEFAULT NULL,
  `detallecomp_costo` float DEFAULT NULL,
  `detallecomp_precio` float DEFAULT NULL,
  `detallecomp_subtotal` float DEFAULT NULL,
  `detallecomp_descuento` float DEFAULT NULL,
  `detallecomp_total` float DEFAULT NULL,
  `detallecomp_descglobal` float DEFAULT NULL,
  `detallecomp_fechavencimiento` date DEFAULT NULL,
  `detallecomp_tipocambio` float DEFAULT NULL,
  `cambio_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`detallecomp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36270 DEFAULT CHARSET=latin1;

#
# Structure for the `detalle_compra_aux` table : 
#

DROP TABLE IF EXISTS `detalle_compra_aux`;

CREATE TABLE `detalle_compra_aux` (
  `compra_id` int(11) NOT NULL,
  `moneda_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `detallecomp_id` int(11) NOT NULL AUTO_INCREMENT,
  `detallecomp_codigo` varchar(20) DEFAULT NULL,
  `detallecomp_cantidad` float DEFAULT NULL,
  `detallecomp_unidad` varchar(50) DEFAULT NULL,
  `detallecomp_costo` float DEFAULT NULL,
  `detallecomp_precio` float DEFAULT NULL,
  `detallecomp_subtotal` float DEFAULT NULL,
  `detallecomp_descuento` float DEFAULT NULL,
  `detallecomp_total` float DEFAULT NULL,
  `detallecomp_descglobal` float DEFAULT NULL,
  `detallecomp_fechavencimiento` date DEFAULT NULL,
  `detallecomp_tipocambio` float DEFAULT NULL,
  `cambio_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`detallecomp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=latin1;

#
# Structure for the `detalle_cotizacion` table : 
#

DROP TABLE IF EXISTS `detalle_cotizacion`;

CREATE TABLE `detalle_cotizacion` (
  `detallecot_id` int(11) NOT NULL AUTO_INCREMENT,
  `detallecot_descripcion` varchar(55) DEFAULT NULL,
  `detallecot_precio` float DEFAULT NULL,
  `detallecot_cantidad` int(11) DEFAULT NULL,
  `detallecot_descuento` float DEFAULT NULL,
  `detallecot_subtotal` float DEFAULT NULL,
  `detallecot_descglobal` float DEFAULT NULL,
  `detallecot_total` float DEFAULT NULL,
  `detallecot_caracteristica` varchar(55) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cotizacion_id` int(11) NOT NULL,
  PRIMARY KEY (`detallecot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

#
# Structure for the `detalle_pedido` table : 
#

DROP TABLE IF EXISTS `detalle_pedido`;

CREATE TABLE `detalle_pedido` (
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `detalleped_id` int(11) NOT NULL AUTO_INCREMENT,
  `detalleped_codigo` float DEFAULT NULL,
  `detalleped_foto` varchar(250) DEFAULT NULL,
  `detalleped_nombre` varchar(250) DEFAULT NULL,
  `detalleped_unidad` varchar(50) DEFAULT NULL,
  `detalleped_costo` float(9,3) DEFAULT NULL,
  `detalleped_cantidad` float DEFAULT NULL,
  `detalleped_precio` float(9,3) DEFAULT NULL,
  `detalleped_descuento` float DEFAULT NULL,
  `detalleped_subtotal` float DEFAULT NULL,
  `detalleped_total` float DEFAULT NULL,
  `detalleped_preferencia` varchar(250) DEFAULT NULL,
  `detalleped_comision` float(9,3) DEFAULT NULL,
  PRIMARY KEY (`detalleped_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `detalle_serv` table : 
#

DROP TABLE IF EXISTS `detalle_serv`;

CREATE TABLE `detalle_serv` (
  `detalleserv_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `catserv_id` int(11) DEFAULT NULL,
  `servicio_id` int(11) DEFAULT NULL,
  `subcatserv_id` int(11) DEFAULT NULL,
  `procedencia_id` int(11) DEFAULT NULL,
  `cattrab_id` int(11) DEFAULT NULL,
  `tiempouso_id` int(11) DEFAULT NULL,
  `detalleserv_descripcion` varchar(250) DEFAULT NULL,
  `detalleserv_codigo` varchar(20) DEFAULT NULL,
  `detalleserv_falla` varchar(250) DEFAULT NULL,
  `detalleserv_diagnostico` varchar(250) DEFAULT NULL,
  `detalleserv_solucion` varchar(250) DEFAULT NULL,
  `detalleserv_glosa` varchar(350) DEFAULT NULL,
  `detalleserv_reclamo` varchar(2) DEFAULT NULL,
  `detalleserv_total` float DEFAULT NULL,
  `detalleserv_acuenta` float DEFAULT NULL,
  `detalleserv_saldo` float DEFAULT NULL,
  `detalleserv_fechaterminado` date DEFAULT NULL,
  `detalleserv_horaterminado` time DEFAULT NULL,
  `detalleserv_fechaentrega` date DEFAULT NULL,
  `detalleserv_horaentrega` time DEFAULT NULL,
  `detalleserv_fechaentregado` date DEFAULT NULL,
  `detalleserv_horaentregado` time DEFAULT NULL,
  `detalleserv_insumo` varchar(400) DEFAULT NULL,
  `detalleserv_pesoentrada` float DEFAULT NULL,
  `detalleserv_pesosalida` float DEFAULT NULL,
  `detalleserv_fpagoacuenta` datetime DEFAULT NULL,
  `usuariopacuenta_id` int(11) DEFAULT NULL,
  `detalleserv_fpagosaldo` datetime DEFAULT NULL,
  `usuariopsaldo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`detalleserv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

#
# Structure for the `detalle_venta` table : 
#

DROP TABLE IF EXISTS `detalle_venta`;

CREATE TABLE `detalle_venta` (
  `producto_id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `moneda_id` int(11) NOT NULL,
  `detalleven_id` int(11) NOT NULL AUTO_INCREMENT,
  `detalleven_codigo` varchar(20) DEFAULT NULL,
  `detalleven_cantidad` float DEFAULT NULL,
  `detalleven_unidad` varchar(20) DEFAULT NULL,
  `detalleven_costo` float DEFAULT NULL,
  `detalleven_precio` float DEFAULT NULL,
  `detalleven_subtotal` float DEFAULT NULL,
  `detalleven_descuento` float DEFAULT NULL,
  `detalleven_total` float DEFAULT NULL,
  `detalleven_caracteristicas` text,
  `detalleven_preferencia` varchar(250) DEFAULT NULL,
  `detalleven_comision` float DEFAULT NULL,
  `detalleven_tipocambio` float DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cambio_id` int(11) DEFAULT NULL,
  `detalleserv_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`detalleven_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23027 DEFAULT CHARSET=latin1;

#
# Structure for the `detalle_venta_aux` table : 
#

DROP TABLE IF EXISTS `detalle_venta_aux`;

CREATE TABLE `detalle_venta_aux` (
  `producto_id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `moneda_id` int(11) NOT NULL,
  `detalleven_id` int(11) NOT NULL AUTO_INCREMENT,
  `detalleven_codigo` varchar(20) DEFAULT NULL,
  `detalleven_cantidad` float DEFAULT NULL,
  `detalleven_unidad` float DEFAULT NULL,
  `detalleven_costo` float DEFAULT NULL,
  `detalleven_precio` float DEFAULT NULL,
  `detalleven_subtotal` float DEFAULT NULL,
  `detalleven_descuento` float DEFAULT NULL,
  `detalleven_total` float DEFAULT NULL,
  `detalleven_caracteristicas` text,
  `detalleven_preferencia` varchar(250) DEFAULT NULL,
  `detalleven_comision` float DEFAULT NULL,
  `detalleven_tipocambio` float DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`detalleven_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16301 DEFAULT CHARSET=latin1;

#
# Structure for the `documento_respaldo` table : 
#

DROP TABLE IF EXISTS `documento_respaldo`;

CREATE TABLE `documento_respaldo` (
  `documento_respaldo_id` int(11) NOT NULL,
  `documento_respaldo_descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`documento_respaldo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `dosificacion` table : 
#

DROP TABLE IF EXISTS `dosificacion`;

CREATE TABLE `dosificacion` (
  `dosificacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `dosificacion_fechahora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dosificacion_nitemisor` bigint(20) DEFAULT NULL,
  `dosificacion_autorizacion` varchar(30) DEFAULT NULL,
  `dosificacion_llave` varchar(250) DEFAULT NULL,
  `dosificacion_fechalimite` date DEFAULT NULL,
  `dosificacion_numfact` int(11) DEFAULT NULL,
  `dosificacion_leyenda1` varchar(250) DEFAULT NULL,
  `dosificacion_leyenda2` varchar(250) DEFAULT NULL,
  `dosificacion_leyenda3` varchar(250) DEFAULT NULL,
  `dosificacion_leyenda4` varchar(250) DEFAULT NULL,
  `dosificacion_sucursal` varchar(50) DEFAULT NULL,
  `dosificacion_sfc` varchar(20) DEFAULT NULL,
  `dosificacion_actividad` varchar(250) DEFAULT NULL,
  `dosificasion_actividadsec` varchar(250) DEFAULT NULL,
  `dosificacion_leyenda5` varchar(350) DEFAULT NULL,
  PRIMARY KEY (`dosificacion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Structure for the `egresos` table : 
#

DROP TABLE IF EXISTS `egresos`;

CREATE TABLE `egresos` (
  `egreso_id` int(11) NOT NULL AUTO_INCREMENT,
  `egreso_numero` int(11) NOT NULL,
  `usuario_id` varchar(55) NOT NULL,
  `egreso_categoria` text NOT NULL,
  `egreso_nombre` varchar(150) DEFAULT NULL,
  `egreso_monto` float DEFAULT NULL,
  `egreso_moneda` varchar(10) DEFAULT NULL,
  `egreso_concepto` varchar(250) DEFAULT NULL,
  `egreso_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`egreso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=297 DEFAULT CHARSET=latin1;

#
# Structure for the `empresa` table : 
#

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `empresa_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosificacion_id` int(11) DEFAULT NULL,
  `empresa_nombre` varchar(150) DEFAULT NULL,
  `empresa_eslogan` varchar(250) DEFAULT NULL,
  `empresa_direccion` varchar(250) DEFAULT NULL,
  `empresa_telefono` varchar(150) DEFAULT NULL,
  `empresa_imagen` varchar(250) DEFAULT NULL,
  `empresa_zona` varchar(150) DEFAULT NULL,
  `empresa_ubicacion` varchar(150) DEFAULT NULL,
  `empresa_departamento` varchar(50) DEFAULT NULL,
  `empresa_propietario` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `empresa_pagina` table : 
#

DROP TABLE IF EXISTS `empresa_pagina`;

CREATE TABLE `empresa_pagina` (
  `emppag_id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) DEFAULT NULL,
  `pagina_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`emppag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `estado` table : 
#

DROP TABLE IF EXISTS `estado`;

CREATE TABLE `estado` (
  `estado_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_descripcion` varchar(50) DEFAULT NULL,
  `estado_tipo` int(11) DEFAULT NULL,
  `estado_color` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`estado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

#
# Structure for the `estado_pagina` table : 
#

DROP TABLE IF EXISTS `estado_pagina`;

CREATE TABLE `estado_pagina` (
  `estadopag_id` int(11) NOT NULL AUTO_INCREMENT,
  `estadopag_descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`estadopag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `factura` table : 
#

DROP TABLE IF EXISTS `factura`;

CREATE TABLE `factura` (
  `factura_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `factura_fechaventa` date DEFAULT NULL,
  `factura_fecha` date DEFAULT NULL,
  `factura_hora` time DEFAULT NULL,
  `factura_subtotaltotal` float DEFAULT NULL,
  `factura_ice` float DEFAULT NULL,
  `factura_exento` float DEFAULT NULL,
  `factura_descuento` float DEFAULT NULL,
  `factura_total` float DEFAULT NULL,
  `factura_numero` float DEFAULT NULL,
  `factura_autorizacion` varchar(30) DEFAULT NULL,
  `factura_llave` varchar(250) DEFAULT NULL,
  `factura_fechalimite` date DEFAULT NULL,
  `factura_codigocontrol` varchar(50) DEFAULT NULL,
  `factura_leyenda1` varchar(250) DEFAULT NULL,
  `factura_leyenda2` varchar(250) DEFAULT NULL,
  `factura_nit` bigint(20) DEFAULT NULL,
  `factura_razonsocial` varchar(150) DEFAULT NULL,
  `factura_nitemisor` bigint(20) DEFAULT NULL,
  `factura_sucursal` varchar(150) DEFAULT NULL,
  `factura_sfc` varchar(20) DEFAULT NULL,
  `factura_actividad` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`factura_id`),
  KEY `venta_id` (`venta_id`,`estado_id`),
  KEY `factura_fk` (`estado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1627 DEFAULT CHARSET=latin1;

#
# Structure for the `forma_pago` table : 
#

DROP TABLE IF EXISTS `forma_pago`;

CREATE TABLE `forma_pago` (
  `forma_id` int(11) NOT NULL AUTO_INCREMENT,
  `forma_nombre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`forma_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Structure for the `galeria` table : 
#

DROP TABLE IF EXISTS `galeria`;

CREATE TABLE `galeria` (
  `galeria_id` int(11) NOT NULL AUTO_INCREMENT,
  `estadopag_id` int(11) DEFAULT NULL,
  `galeria_titulo` varchar(250) DEFAULT NULL,
  `galeria_descripcion` varchar(250) DEFAULT NULL,
  `galeria_texto` text,
  PRIMARY KEY (`galeria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Structure for the `idioma` table : 
#

DROP TABLE IF EXISTS `idioma`;

CREATE TABLE `idioma` (
  `idioma_id` int(11) NOT NULL AUTO_INCREMENT,
  `idioma_descripcion` varchar(250) DEFAULT NULL,
  `idioma_imagen` varchar(250) DEFAULT NULL,
  `idioma_enlace` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idioma_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `imagen` table : 
#

DROP TABLE IF EXISTS `imagen`;

CREATE TABLE `imagen` (
  `imagen_id` int(11) NOT NULL AUTO_INCREMENT,
  `estadopag_id` int(11) DEFAULT NULL,
  `articulo_id` int(11) DEFAULT NULL,
  `imagen_titulo` varchar(250) DEFAULT NULL,
  `imagen_texto` text,
  `imagen_nombre` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`imagen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Structure for the `imagen_producto` table : 
#

DROP TABLE IF EXISTS `imagen_producto`;

CREATE TABLE `imagen_producto` (
  `imagenprod_id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `imagenprod_titulo` varchar(120) DEFAULT NULL,
  `imagenprod_archivo` varchar(70) DEFAULT NULL,
  `imagenprod_descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`imagenprod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `ingresos` table : 
#

DROP TABLE IF EXISTS `ingresos`;

CREATE TABLE `ingresos` (
  `ingreso_id` int(11) NOT NULL AUTO_INCREMENT,
  `ingreso_numero` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `ingreso_categoria` text NOT NULL,
  `ingreso_nombre` varchar(150) DEFAULT NULL,
  `ingreso_monto` float DEFAULT NULL,
  `ingreso_moneda` varchar(10) DEFAULT NULL,
  `ingreso_concepto` varchar(250) DEFAULT NULL,
  `ingreso_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ingreso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

#
# Structure for the `inventario` table : 
#

DROP TABLE IF EXISTS `inventario`;

CREATE TABLE `inventario` (
  `producto_id` int(11) NOT NULL DEFAULT '0',
  `estado_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `presentacion_id` int(11) DEFAULT NULL,
  `moneda_id` int(11) DEFAULT NULL,
  `producto_codigo` varchar(50) DEFAULT NULL,
  `producto_codigobarra` varchar(50) DEFAULT NULL,
  `producto_foto` varchar(250) DEFAULT NULL,
  `producto_nombre` varchar(250) DEFAULT NULL,
  `producto_unidad` varchar(50) DEFAULT NULL,
  `producto_marca` varchar(50) DEFAULT NULL,
  `producto_industria` varchar(150) DEFAULT NULL,
  `producto_costo` float DEFAULT NULL,
  `producto_precio` float DEFAULT NULL,
  `producto_comision` float DEFAULT NULL,
  `producto_tipocambio` float DEFAULT NULL,
  `producto_cantidadminima` float(9,3) DEFAULT NULL,
  `compras` float(9,3) DEFAULT NULL,
  `ventas` float(9,3) DEFAULT NULL,
  `pedidos` float(9,3) DEFAULT NULL,
  `existencia` float(9,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `item` table : 
#

DROP TABLE IF EXISTS `item`;

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `estadopag_id` int(11) DEFAULT NULL,
  `submenu_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `item_nombre` varchar(150) DEFAULT NULL,
  `item_descripcion` varchar(250) DEFAULT NULL,
  `item_enlace` varchar(250) DEFAULT NULL,
  `item_imagen` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `mapa` table : 
#

DROP TABLE IF EXISTS `mapa`;

CREATE TABLE `mapa` (
  `mapa_id` int(11) NOT NULL AUTO_INCREMENT,
  `pagina_id` int(11) DEFAULT NULL,
  `estadopag_id` int(11) DEFAULT NULL,
  `mapa_titulo` varchar(250) DEFAULT NULL,
  `mapa_descripcion` varchar(250) DEFAULT NULL,
  `mapa_latitud` float DEFAULT NULL,
  `mapa_longitud` float DEFAULT NULL,
  `mapa_indicador` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`mapa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `menu` table : 
#

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `estadopag_id` int(11) DEFAULT NULL,
  `menup_id` int(11) DEFAULT NULL,
  `menu_nombre` varchar(150) DEFAULT NULL,
  `menu_tipo` varchar(150) DEFAULT NULL,
  `menu_descripcion` varchar(250) DEFAULT NULL,
  `menu_enlace` varchar(250) DEFAULT NULL,
  `menu_imagen` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

#
# Structure for the `menu_principal` table : 
#

DROP TABLE IF EXISTS `menu_principal`;

CREATE TABLE `menu_principal` (
  `menup_id` int(11) NOT NULL AUTO_INCREMENT,
  `pagina_id` int(11) DEFAULT NULL,
  `estadopag_id` int(11) DEFAULT NULL,
  `menup_nombre` varchar(150) DEFAULT NULL,
  `menup_descripcion` varchar(150) DEFAULT NULL,
  `menup_enlace` varchar(250) DEFAULT NULL,
  `menup_imagen` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`menup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Structure for the `moneda` table : 
#

DROP TABLE IF EXISTS `moneda`;

CREATE TABLE `moneda` (
  `moneda_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `moneda_descripcion` varchar(50) DEFAULT NULL,
  `moneda_tc` float DEFAULT NULL,
  PRIMARY KEY (`moneda_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `pagina_web` table : 
#

DROP TABLE IF EXISTS `pagina_web`;

CREATE TABLE `pagina_web` (
  `pagina_id` int(11) NOT NULL AUTO_INCREMENT,
  `idioma_id` int(11) DEFAULT NULL,
  `estadopag_id` int(11) DEFAULT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `pagina_nombre` varchar(150) DEFAULT NULL,
  `pagina_telefono` varchar(150) DEFAULT NULL,
  `pagina_direccion` varchar(150) DEFAULT NULL,
  `pagina_informacion` varchar(150) DEFAULT NULL,
  `pagina_imagen` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`pagina_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `parametros` table : 
#

DROP TABLE IF EXISTS `parametros`;

CREATE TABLE `parametros` (
  `parametro_id` int(11) NOT NULL AUTO_INCREMENT,
  `parametro_numrecegr` int(11) DEFAULT NULL,
  `parametro_numrecing` int(11) DEFAULT NULL,
  `parametro_copiasfact` int(11) DEFAULT NULL,
  `parametro_tipoimpresora` varchar(20) DEFAULT NULL,
  `parametro_numcuotas` int(11) DEFAULT NULL,
  `parametro_montomax` float(9,3) DEFAULT NULL,
  `parametro_diasgracia` int(11) DEFAULT NULL,
  `parametro_diapago` int(11) DEFAULT NULL,
  `parametro_periododias` int(11) DEFAULT NULL,
  `parametro_interes` int(11) DEFAULT NULL,
  `parametro_tituldoc` varchar(150) NOT NULL,
  PRIMARY KEY (`parametro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Structure for the `pedido` table : 
#

DROP TABLE IF EXISTS `pedido`;

CREATE TABLE `pedido` (
  `pedido_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `tipotrans_id` int(11) DEFAULT NULL,
  `pedido_fecha` datetime DEFAULT NULL,
  `pedido_subtotal` float DEFAULT NULL,
  `pedido_descuento` float DEFAULT NULL,
  `pedido_total` float DEFAULT NULL,
  `pedido_glosa` varchar(250) DEFAULT NULL,
  `pedido_fechaentrega` date DEFAULT NULL,
  `pedido_horaentrega` time DEFAULT NULL,
  PRIMARY KEY (`pedido_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Structure for the `pedidos` table : 
#

DROP TABLE IF EXISTS `pedidos`;

CREATE TABLE `pedidos` (
  `pedidos_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) NOT NULL,
  `pedidos_montototal` float NOT NULL,
  `pedidos_fecha` date NOT NULL,
  `pedidos_resumen` text NOT NULL,
  `pedidos_estado` varchar(15) NOT NULL,
  `pedidos_fecharegistro` datetime NOT NULL,
  PRIMARY KEY (`pedidos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Structure for the `presentacion` table : 
#

DROP TABLE IF EXISTS `presentacion`;

CREATE TABLE `presentacion` (
  `presentacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `presentacion_nombre` varchar(250) DEFAULT NULL,
  `presentacion_codigobarra` varchar(50) DEFAULT NULL,
  `presentacion_contenido` float DEFAULT NULL,
  `presentacion_unidad` varchar(20) DEFAULT NULL,
  `presentacion_precio` float DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`presentacion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

#
# Structure for the `procedencia` table : 
#

DROP TABLE IF EXISTS `procedencia`;

CREATE TABLE `procedencia` (
  `procedencia_id` int(11) NOT NULL AUTO_INCREMENT,
  `procedencia_descripcion` varchar(150) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`procedencia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Structure for the `producto` table : 
#

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `producto_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `presentacion_id` int(11) DEFAULT NULL,
  `moneda_id` int(11) DEFAULT NULL,
  `producto_codigo` varchar(50) DEFAULT NULL,
  `producto_codigobarra` varchar(50) DEFAULT NULL,
  `producto_foto` varchar(250) DEFAULT NULL,
  `producto_nombre` varchar(250) DEFAULT NULL,
  `producto_unidad` varchar(50) DEFAULT NULL,
  `producto_marca` varchar(50) DEFAULT NULL,
  `producto_industria` varchar(150) DEFAULT NULL,
  `producto_costo` float DEFAULT NULL,
  `producto_precio` float DEFAULT NULL,
  `producto_comision` float DEFAULT NULL,
  `producto_tipocambio` float DEFAULT NULL,
  `producto_cantidadminima` float DEFAULT NULL,
  PRIMARY KEY (`producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19065 DEFAULT CHARSET=latin1;

#
# Structure for the `promocion` table : 
#

DROP TABLE IF EXISTS `promocion`;

CREATE TABLE `promocion` (
  `promocion_id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `promocion_titulo` varchar(250) DEFAULT NULL,
  `promocion_descripcion` text,
  `promocion_cantidad` int(11) DEFAULT NULL,
  `promocion_preciototal` float(9,3) DEFAULT NULL,
  `promocion_fecha` date DEFAULT NULL,
  PRIMARY KEY (`promocion_id`),
  UNIQUE KEY `promocion_id` (`promocion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Structure for the `proveedor` table : 
#

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor` (
  `proveedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `proveedor_codigo` varchar(20) DEFAULT NULL,
  `proveedor_nombre` varchar(150) DEFAULT NULL,
  `proveedor_foto` varchar(250) DEFAULT NULL,
  `proveedor_contacto` varchar(150) DEFAULT NULL,
  `proveedor_direccion` varchar(250) DEFAULT NULL,
  `proveedor_telefono` varchar(150) DEFAULT NULL,
  `proveedor_telefono2` varchar(150) DEFAULT NULL,
  `proveedor_email` varchar(50) DEFAULT NULL,
  `proveedor_nit` varchar(50) DEFAULT NULL,
  `proveedor_razon` varchar(150) DEFAULT NULL,
  `proveedor_autorizacion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`proveedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

#
# Structure for the `responsable` table : 
#

DROP TABLE IF EXISTS `responsable`;

CREATE TABLE `responsable` (
  `responsable_id` int(11) NOT NULL AUTO_INCREMENT,
  `responsable_nombres` varchar(150) DEFAULT NULL,
  `responsable_apellidos` varchar(150) DEFAULT NULL,
  `responsable_ci` varchar(50) DEFAULT NULL,
  `responsable_cargo` varchar(150) DEFAULT NULL,
  `responsable_telefono` varchar(50) DEFAULT NULL,
  `responsable_direccion` varchar(250) DEFAULT NULL,
  `responsable_imagen` varchar(250) DEFAULT NULL,
  `responsable_latitud` varchar(50) DEFAULT NULL,
  `responsable_longitud` varchar(50) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`responsable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Structure for the `rol` table : 
#

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `rol_descripcion` varchar(250) DEFAULT NULL,
  `rol_idfk` int(11) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

#
# Structure for the `rol_usuario` table : 
#

DROP TABLE IF EXISTS `rol_usuario`;

CREATE TABLE `rol_usuario` (
  `id_rol_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipousuario_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`id_rol_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=219 DEFAULT CHARSET=latin1;

#
# Structure for the `seccion` table : 
#

DROP TABLE IF EXISTS `seccion`;

CREATE TABLE `seccion` (
  `seccion_id` int(11) NOT NULL AUTO_INCREMENT,
  `pagina_id` int(11) DEFAULT NULL,
  `estadopag_id` int(11) DEFAULT NULL,
  `seccion_titulo` varchar(250) DEFAULT NULL,
  `seccion_descripcion` varchar(250) DEFAULT NULL,
  `seccion_texto` text,
  `seccion_tipo` int(11) DEFAULT '0',
  PRIMARY KEY (`seccion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Structure for the `servicio` table : 
#

DROP TABLE IF EXISTS `servicio`;

CREATE TABLE `servicio` (
  `servicio_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `tiposerv_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `servicio_fecharecepcion` date DEFAULT NULL,
  `servicio_horarecepcion` time DEFAULT NULL,
  `servicio_fechafinalizacion` date DEFAULT NULL,
  `servicio_horafinalizacion` time DEFAULT NULL,
  `servicio_total` float DEFAULT NULL,
  `servicio_acuenta` float DEFAULT NULL,
  `servicio_saldo` float DEFAULT NULL,
  `servicio_direccion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`servicio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

#
# Structure for the `slide` table : 
#

DROP TABLE IF EXISTS `slide`;

CREATE TABLE `slide` (
  `slide_id` int(11) NOT NULL AUTO_INCREMENT,
  `estadopag_id` int(11) DEFAULT NULL,
  `pagina_id` int(11) DEFAULT NULL,
  `slide_tipo` int(11) DEFAULT NULL,
  `slide_titulo` varchar(250) DEFAULT NULL,
  `slide_leyenda1` varchar(250) DEFAULT NULL,
  `slide_leyenda2` varchar(250) DEFAULT NULL,
  `slide_leyenda3` varchar(250) DEFAULT NULL,
  `slide_enlace` varchar(250) DEFAULT NULL,
  `slide_imagen` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Structure for the `slide_imagen` table : 
#

DROP TABLE IF EXISTS `slide_imagen`;

CREATE TABLE `slide_imagen` (
  `slideimagen_id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_id` int(11) NOT NULL,
  `imagen_id` int(11) NOT NULL,
  PRIMARY KEY (`slideimagen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Structure for the `subcategoria_servicio` table : 
#

DROP TABLE IF EXISTS `subcategoria_servicio`;

CREATE TABLE `subcategoria_servicio` (
  `subcatserv_id` int(11) NOT NULL AUTO_INCREMENT,
  `subcatserv_descripcion` varchar(80) DEFAULT NULL,
  `catserv_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`subcatserv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

#
# Structure for the `submenu` table : 
#

DROP TABLE IF EXISTS `submenu`;

CREATE TABLE `submenu` (
  `submenu_id` int(11) NOT NULL AUTO_INCREMENT,
  `estadopag_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `submenu_nombre` varchar(150) DEFAULT NULL,
  `submenu_enlace` varchar(250) DEFAULT NULL,
  `submenu_imagen` varchar(250) DEFAULT NULL,
  `submenu_descipcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`submenu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `sucursales` table : 
#

DROP TABLE IF EXISTS `sucursales`;

CREATE TABLE `sucursales` (
  `sucursal_id` int(11) NOT NULL AUTO_INCREMENT,
  `sucursal_nombre` varchar(150) NOT NULL,
  `sucursal_url` text NOT NULL,
  `sucursal_token` varchar(255) NOT NULL,
  PRIMARY KEY (`sucursal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Structure for the `tabla` table : 
#

DROP TABLE IF EXISTS `tabla`;

CREATE TABLE `tabla` (
  `tabla_id` int(11) NOT NULL AUTO_INCREMENT,
  `tabla_nombre` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`tabla_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

#
# Structure for the `tiempo_uso` table : 
#

DROP TABLE IF EXISTS `tiempo_uso`;

CREATE TABLE `tiempo_uso` (
  `tiempouso_id` int(11) NOT NULL AUTO_INCREMENT,
  `tiempouso_descripcion` varchar(150) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tiempouso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Structure for the `tipo_cliente` table : 
#

DROP TABLE IF EXISTS `tipo_cliente`;

CREATE TABLE `tipo_cliente` (
  `tipocliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipocliente_descripcion` varchar(150) DEFAULT NULL,
  `tipocliente_porcdesc` float DEFAULT NULL,
  `tipocliente_montodesc` float DEFAULT NULL,
  PRIMARY KEY (`tipocliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Structure for the `tipo_servicio` table : 
#

DROP TABLE IF EXISTS `tipo_servicio`;

CREATE TABLE `tipo_servicio` (
  `tiposerv_id` int(11) NOT NULL AUTO_INCREMENT,
  `tiposerv_descripcion` varchar(150) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tiposerv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `tipo_transaccion` table : 
#

DROP TABLE IF EXISTS `tipo_transaccion`;

CREATE TABLE `tipo_transaccion` (
  `tipotrans_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipotrans_nombre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`tipotrans_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Structure for the `tipo_usuario` table : 
#

DROP TABLE IF EXISTS `tipo_usuario`;

CREATE TABLE `tipo_usuario` (
  `tipousuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `tipousuario_descripcion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`tipousuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Structure for the `usuario` table : 
#

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `tipousuario_id` int(11) DEFAULT NULL,
  `usuario_nombre` varchar(150) DEFAULT NULL,
  `usuario_email` varchar(250) DEFAULT NULL,
  `usuario_login` varchar(50) DEFAULT NULL,
  `usuario_clave` varchar(50) DEFAULT NULL,
  `usuario_imagen` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

#
# Structure for the `venta` table : 
#

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta` (
  `venta_id` int(11) NOT NULL AUTO_INCREMENT,
  `forma_id` int(11) DEFAULT NULL,
  `tipotrans_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `moneda_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `venta_fecha` date DEFAULT NULL,
  `venta_hora` time DEFAULT NULL,
  `venta_subtotal` float DEFAULT NULL,
  `venta_descuento` float DEFAULT NULL,
  `venta_total` float DEFAULT NULL,
  `venta_efectivo` float DEFAULT NULL,
  `venta_cambio` float DEFAULT NULL,
  `venta_glosa` varchar(250) DEFAULT NULL,
  `venta_comision` float DEFAULT NULL,
  `venta_tipocambio` float DEFAULT NULL,
  `detalleserv_id` int(11) DEFAULT NULL,
  `venta_tipodoc` int(11) DEFAULT NULL,
  PRIMARY KEY (`venta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7840 DEFAULT CHARSET=latin1;

#
# Structure for the `zona` table : 
#

DROP TABLE IF EXISTS `zona`;

CREATE TABLE `zona` (
  `zona_id` int(11) NOT NULL AUTO_INCREMENT,
  `zona_nombre` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`zona_id`),
  UNIQUE KEY `zona_id` (`zona_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;