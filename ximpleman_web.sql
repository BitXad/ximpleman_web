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

CREATE TABLE `boton_articulo` (
  `botonartic_id` int(11) NOT NULL AUTO_INCREMENT,
  `articulo_id` int(11) NOT NULL,
  `boton_id` int(11) NOT NULL,
  PRIMARY KEY (`botonartic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `boton_slide` table : 
#

CREATE TABLE `boton_slide` (
  `botonslide_id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_id` int(11) NOT NULL,
  `boton_id` int(11) NOT NULL,
  PRIMARY KEY (`botonslide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `categ_imagen` table : 
#

CREATE TABLE `categ_imagen` (
  `categimg_id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen_id` int(11) NOT NULL,
  `catimg_id` int(11) NOT NULL,
  PRIMARY KEY (`categimg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `categoria_cliente` table : 
#

CREATE TABLE `categoria_cliente` (
  `categoriaclie_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoriaclie_descripcion` varchar(150) DEFAULT NULL,
  `categoriaclie_porcdesc` float DEFAULT NULL,
  `categoriaclie_montodesc` float DEFAULT NULL,
  PRIMARY KEY (`categoriaclie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Structure for the `categoria_egreso` table : 
#

CREATE TABLE `categoria_egreso` (
  `id_categr` int(11) NOT NULL,
  `categoria_categr` varchar(50) NOT NULL,
  `descrip_categr` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_categr`),
  UNIQUE KEY `categoria_categr` (`categoria_categr`),
  UNIQUE KEY `id_categr` (`id_categr`),
  UNIQUE KEY `id_categr_2` (`id_categr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `categoria_imagen` table : 
#

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

CREATE TABLE `categoria_ingreso` (
  `id_cating` int(11) NOT NULL,
  `categoria_cating` varchar(50) NOT NULL,
  `descrip_cating` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_cating`),
  UNIQUE KEY `id_cating` (`id_cating`),
  UNIQUE KEY `id_cating_2` (`id_cating`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `categoria_producto` table : 
#

CREATE TABLE `categoria_producto` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_nombre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Structure for the `cliente` table : 
#

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
  `cliente_nit` int(11) DEFAULT NULL,
  `cliente_razon` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

#
# Structure for the `cliente_usuario` table : 
#

CREATE TABLE `cliente_usuario` (
  `cliente_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `compra` table : 
#

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
  PRIMARY KEY (`compra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

#
# Structure for the `credito` table : 
#

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
  PRIMARY KEY (`credito_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

#
# Structure for the `cuota` table : 
#

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Structure for the `detalle_compra` table : 
#

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
  PRIMARY KEY (`detallecomp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

#
# Structure for the `detalle_pedido` table : 
#

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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

#
# Structure for the `detalle_venta` table : 
#

CREATE TABLE `detalle_venta` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `detalle_venta_aux` table : 
#

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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

#
# Structure for the `documento_respaldo` table : 
#

CREATE TABLE `documento_respaldo` (
  `documento_respaldo_id` int(11) NOT NULL,
  `documento_respaldo_descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`documento_respaldo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `dosificacion` table : 
#

CREATE TABLE `dosificacion` (
  `dosificacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `dosificacion_fechahora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dosificacion_nitemisor` int(11) DEFAULT NULL,
  `dosificacion_autorizacion` int(11) DEFAULT NULL,
  `dosificacion_llave` varchar(250) DEFAULT NULL,
  `dosificacion_numfact` int(11) DEFAULT NULL,
  `dosificacion_leyenda1` varchar(250) DEFAULT NULL,
  `dosificacion_leyenda2` varchar(250) DEFAULT NULL,
  `dosificacion_sucursal` varchar(50) DEFAULT NULL,
  `dosificacion_sfc` varchar(20) DEFAULT NULL,
  `dosificacion_actividad` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`dosificacion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Structure for the `egresos` table : 
#

CREATE TABLE `egresos` (
  `egreso_id` int(11) NOT NULL,
  `egreso_numero` int(11) NOT NULL,
  `usuario_id` varchar(55) NOT NULL,
  `egreso_categoria` text NOT NULL,
  `egreso_nombre` varchar(150) DEFAULT NULL,
  `egreso_monto` float DEFAULT NULL,
  `egreso_moneda` varchar(10) DEFAULT NULL,
  `egreso_concepto` varchar(250) DEFAULT NULL,
  `egreso_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `empresa` table : 
#

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
  PRIMARY KEY (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `empresa_pagina` table : 
#

CREATE TABLE `empresa_pagina` (
  `emppag_id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) DEFAULT NULL,
  `pagina_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`emppag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `estado` table : 
#

CREATE TABLE `estado` (
  `estado_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_descripcion` varchar(50) DEFAULT NULL,
  `estado_tipo` int(11) DEFAULT NULL,
  `estado_color` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`estado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

#
# Structure for the `estado_pagina` table : 
#

CREATE TABLE `estado_pagina` (
  `estadopag_id` int(11) NOT NULL AUTO_INCREMENT,
  `estadopag_descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`estadopag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `factura` table : 
#

CREATE TABLE `factura` (
  `factura_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `factura_fecha` date DEFAULT NULL,
  `factura_hora` time DEFAULT NULL,
  `factura_subtotaltotal` float DEFAULT NULL,
  `factura_ice` float DEFAULT NULL,
  `factura_exento` float DEFAULT NULL,
  `factura_descuento` float DEFAULT NULL,
  `factura_total` float DEFAULT NULL,
  `factura_numero` float DEFAULT NULL,
  `factura_autorizacion` float DEFAULT NULL,
  `factura_llave` varchar(250) DEFAULT NULL,
  `factura_fechalimite` float DEFAULT NULL,
  `factura_codigocontrol` varchar(50) DEFAULT NULL,
  `factura_leyenda` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`factura_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `forma_pago` table : 
#

CREATE TABLE `forma_pago` (
  `forma_id` int(11) NOT NULL AUTO_INCREMENT,
  `forma_nombre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`forma_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Structure for the `galeria` table : 
#

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
# Structure for the `ingresos` table : 
#

CREATE TABLE `ingresos` (
  `ingreso_id` int(11) NOT NULL,
  `ingreso_numero` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `ingreso_categoria` text NOT NULL,
  `ingreso_nombre` varchar(150) DEFAULT NULL,
  `ingreso_monto` float DEFAULT NULL,
  `ingreso_moneda` varchar(10) DEFAULT NULL,
  `ingreso_concepto` varchar(250) DEFAULT NULL,
  `ingreso_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `item` table : 
#

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
  PRIMARY KEY (`parametro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Structure for the `pedido` table : 
#

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

#
# Structure for the `presentacion` table : 
#

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
# Structure for the `producto` table : 
#

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
  PRIMARY KEY (`producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

#
# Structure for the `promocion` table : 
#

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

CREATE TABLE `proveedor` (
  `proveedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `proveedor_codigo` varchar(20) DEFAULT NULL,
  `proveedor_nombre` varchar(150) DEFAULT NULL,
  `proveedor_foto` varchar(250) DEFAULT NULL,
  `proveedor_contacto` varchar(150) DEFAULT NULL,
  `proveedor_direccion` varchar(250) DEFAULT NULL,
  `proveedor_telefono` varchar(150) DEFAULT NULL,
  `proveedor_email` varchar(50) DEFAULT NULL,
  `proveedor_nit` varchar(50) DEFAULT NULL,
  `proveedor_razon` varchar(150) DEFAULT NULL,
  `proveedor_autorizacion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`proveedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

#
# Structure for the `responsable` table : 
#

CREATE TABLE `responsable` (
  `responsable_id` int(11) NOT NULL AUTO_INCREMENT,
  `responsable_nombres` varchar(150) DEFAULT NULL,
  `responsable_apellidos` varchar(150) DEFAULT NULL,
  `responsable_ci` varchar(50) DEFAULT NULL,
  `responsable_cargo` varchar(150) DEFAULT NULL,
  `responsable_telefono` varchar(50) DEFAULT NULL,
  `responsable_direccion` varchar(250) DEFAULT NULL,
  `responsable_imagen` varchar(250) DEFAULT NULL,
  `responsable_latitud` float DEFAULT NULL,
  `responsable_longitud` float DEFAULT NULL,
  PRIMARY KEY (`responsable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Structure for the `rol` table : 
#

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `rol_descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `rol_usuario` table : 
#

CREATE TABLE `rol_usuario` (
  `tipousuario_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `seccion` table : 
#

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

CREATE TABLE `servicio` (
  `servicio_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `servicio_descripcion` varchar(250) DEFAULT NULL,
  `servicio_fecharecepcion` date DEFAULT NULL,
  `servicio_horarecepcion` time DEFAULT NULL,
  `servicio_fechaentrega` date DEFAULT NULL,
  `servicio_horaentrega` time DEFAULT NULL,
  `servicio_fechaentregado` date DEFAULT NULL,
  `servicio_horaentregado` time DEFAULT NULL,
  `servicio_total` float DEFAULT NULL,
  `servicio_acuenta` float DEFAULT NULL,
  `servicio_saldo` float DEFAULT NULL,
  `servicio_problema` varchar(250) DEFAULT NULL,
  `servicio_diagnostico` varchar(250) DEFAULT NULL,
  `servicio_solucion` varchar(250) DEFAULT NULL,
  `servicio_glosa` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`servicio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `slide` table : 
#

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

CREATE TABLE `slide_imagen` (
  `slideimagen_id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_id` int(11) NOT NULL,
  `imagen_id` int(11) NOT NULL,
  PRIMARY KEY (`slideimagen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Structure for the `submenu` table : 
#

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
# Structure for the `tipo_cliente` table : 
#

CREATE TABLE `tipo_cliente` (
  `tipocliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipocliente_descripcion` varchar(150) DEFAULT NULL,
  `tipocliente_porcdesc` float DEFAULT NULL,
  `tipocliente_montodesc` float DEFAULT NULL,
  PRIMARY KEY (`tipocliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Structure for the `tipo_transaccion` table : 
#

CREATE TABLE `tipo_transaccion` (
  `tipotrans_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipotrans_nombre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`tipotrans_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Structure for the `tipo_usuario` table : 
#

CREATE TABLE `tipo_usuario` (
  `tipousuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `tipousuario_descripcion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`tipousuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Structure for the `usuario` table : 
#

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `venta` table : 
#

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
  PRIMARY KEY (`venta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for the `categoria_cliente` table  (LIMIT 0,500)
#

INSERT INTO `categoria_cliente` (`categoriaclie_id`, `categoriaclie_descripcion`, `categoriaclie_porcdesc`, `categoriaclie_montodesc`) VALUES 
  (2,'ALMACEN',0,0),
  (3,'MICROMERCADO',0,0),
  (4,'Distribuidora',0,0);
COMMIT;

#
# Data for the `categoria_egreso` table  (LIMIT 0,500)
#

INSERT INTO `categoria_egreso` (`id_categr`, `categoria_categr`, `descrip_categr`) VALUES 
  (1,'PAGO A PROVEEDOR','-'),
  (2,'REFRIGERIOS','-');
COMMIT;

#
# Data for the `categoria_ingreso` table  (LIMIT 0,500)
#

INSERT INTO `categoria_ingreso` (`id_cating`, `categoria_cating`, `descrip_cating`) VALUES 
  (1,'PAGO POR SERVICIOS',''),
  (2,'PAGO POR MEMBRESIA','');
COMMIT;

#
# Data for the `categoria_producto` table  (LIMIT 0,500)
#

INSERT INTO `categoria_producto` (`categoria_id`, `categoria_nombre`) VALUES 
  (2,'Refrescos'),
  (3,'Bebidas'),
  (4,'Embutidos'),
  (5,'Electronica'),
  (6,'Computación');
COMMIT;

#
# Data for the `cliente` table  (LIMIT 0,500)
#

INSERT INTO `cliente` (`cliente_id`, `estado_id`, `tipocliente_id`, `categoriaclie_id`, `usuario_id`, `cliente_codigo`, `cliente_nombre`, `cliente_ci`, `cliente_direccion`, `cliente_telefono`, `cliente_celular`, `cliente_foto`, `cliente_email`, `cliente_nombrenegocio`, `cliente_aniversario`, `cliente_latitud`, `cliente_longitud`, `cliente_nit`, `cliente_razon`) VALUES 
  (2,3,1,2,1,'4213','Marcela Ponce Salazar','65132156','Av. Blanco Galindo Km 12','4520368','77564189','','n/a','Licoreria Doña Chela','0000-00-00','0','0',5555019,'Garcia'),
  (3,1,1,3,1,'123','Raquel Rojas Loza','873113','Av. 23 de Marzo S/N','4523526','77525864','foto.jpg','raquel@hotmail.com','','0000-00-00','0','0',515236019,'Loza'),
  (4,1,2,2,1,'646131','Ramiro Beltran Waisman','62135','Av. Los condes Nº 45613','4523068','n/a','','n/a','Almacen Beltrais','0000-00-00','0','0',0,'Sin Nombre'),
  (5,1,3,3,2,'45435','Juan Perez','5152377018','','','','','','','0000-00-00','-0.005321502677898499','-0.017337799072265625',0,'sin Nombre'),
  (6,4,2,4,2,'5646','juan','','','','','','','','0000-00-00','-17','-68',0,'sin nombre'),
  (7,1,3,3,2,'421321','Juan Pardo Martinez','542313 CBBA','Calle Los Alamos','4511523','774515562','','','Micromercado Martinez','0000-00-00','','',2147483647,'PARDO'),
  (8,1,3,3,2,'46546','Juan Martinez','5152344 CBBA','Av. San Martin Nº 4512','4511523','7741650','','juan@mail.com','Micromercado Juancito','0000-00-00','','',0,'SIN NOMBRE'),
  (9,1,2,3,3,'35345','Juan perez','461312','','','','','','Micromercado Perez','0000-00-00','','',0,'SIN NOMBRE'),
  (10,1,2,3,3,'6467','Marcial Via','','','','','','','Tienda Don Marcial','0000-00-00','','',0,'SIN NOMBRE'),
  (11,1,1,2,3,'1234','Caros','','24','','','','','Carlitos','0000-00-00','','',0,'SIN NOMBRE'),
  (12,1,3,4,NULL,'2343234','Jhon piropo','2828282828','Las Magnolias ','777777','777777777','','','Restaurant “ugly pilori”','0000-00-00','','',1919808855,'Ugly pilori '),
  (13,1,2,2,NULL,'M122A','Mario Escobar','5123485 CBBA','','754313','','','','Chicharrones Don Mario','0000-00-00','','',0,'SIN NOMBRE'),
  (14,1,1,2,NULL,'4564','Marino Diaz P.','562345 CBBA','Av. Ramon Rivero','4511253','77417658','','','Bar Marino','0000-00-00','','',0,'SIN NOMBRE');
COMMIT;

#
# Data for the `compra` table  (LIMIT 0,500)
#

INSERT INTO `compra` (`compra_id`, `estado_id`, `tipotrans_id`, `usuario_id`, `moneda_id`, `proveedor_id`, `forma_id`, `compra_fecha`, `compra_hora`, `compra_subtotal`, `compra_descuento`, `compra_descglobal`, `compra_total`, `compra_totalfinal`, `compra_efectivo`, `compra_cambio`, `compra_glosa`, `compra_tipocambio`, `compra_chofer`, `compra_placamovil`, `compra_fechallegada`, `compra_horallegada`, `compra_numdoc`, `documento_respaldo_id`) VALUES 
  (1,1,1,1,1,2,1,'2018-10-20','17:08:05',540,0,0,540,540,0,0,'',NULL,NULL,NULL,NULL,NULL,0,0),
  (2,1,2,1,1,14,4,'2018-10-20','11:06:55',334,1,3,333,330,400,70,'nose',NULL,NULL,NULL,NULL,NULL,123,1),
  (3,1,2,1,1,11,3,'2018-10-20','11:11:43',50,0,0,50,50,0,0,'',NULL,NULL,NULL,NULL,NULL,101201,1),
  (4,1,1,1,1,15,3,'2018-10-20','15:12:31',30,3,5,27,22,22,0,'',NULL,NULL,NULL,NULL,NULL,0,0),
  (5,1,2,1,1,16,3,'2018-10-20','15:43:34',0,0,0,0,0,0,0,'',NULL,NULL,NULL,NULL,NULL,0,0),
  (6,1,1,1,1,15,2,'2018-10-21','10:03:49',0,0,0,0,0,0,0,'',NULL,NULL,NULL,NULL,NULL,0,0),
  (7,1,3,1,1,16,4,'2018-10-20','18:36:13',5,0,0,5,5,0,0,'',NULL,NULL,NULL,NULL,NULL,123,2),
  (8,1,2,1,1,19,1,'2018-11-07','12:51:46',1157.82,0,0,1157.82,1157.82,0,0,'',NULL,NULL,NULL,NULL,NULL,0,2),
  (9,1,2,1,1,17,1,'2018-11-07','12:35:43',1156.3,0,0,1156.3,1156.3,0,0,'',NULL,NULL,NULL,NULL,NULL,535,2),
  (10,1,1,1,1,17,1,'2018-11-04','08:53:50',0,0,NULL,0,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0),
  (11,1,1,1,1,15,1,'2018-11-04','09:00:24',0,0,NULL,0,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0),
  (12,1,1,1,1,0,1,'2018-11-05','09:33:59',0,0,NULL,0,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0),
  (13,1,1,1,1,15,1,'2018-11-05','09:34:12',0,0,NULL,0,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0),
  (14,1,1,1,1,0,1,'2018-11-05','09:44:33',0,0,NULL,0,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0),
  (15,1,1,1,1,18,1,'2018-11-05','10:07:33',0,0,NULL,0,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0),
  (16,1,1,1,1,0,1,'2018-11-05','10:32:20',0,0,NULL,0,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0),
  (17,1,2,1,1,0,2,'2018-11-07','12:32:00',0,0,0,0,0,0,0,'0',NULL,NULL,NULL,NULL,NULL,0,2);
COMMIT;

#
# Data for the `credito` table  (LIMIT 0,500)
#

INSERT INTO `credito` (`credito_id`, `estado_id`, `compra_id`, `venta_id`, `credito_monto`, `credito_cuotainicial`, `credito_interesproc`, `credito_interesmonto`, `credito_numpagos`, `credito_fechalimite`, `credito_fecha`, `credito_hora`, `credito_tipo`) VALUES 
  (1,1,3,NULL,50,10,NULL,NULL,NULL,NULL,'2018-10-20','11:16:01',NULL),
  (2,1,2,NULL,330,110,NULL,NULL,NULL,NULL,'2018-10-20','11:39:37',NULL),
  (3,1,4,NULL,0,100,0,0,1,'0000-00-00','2018-10-20','16:00:39','1'),
  (4,1,5,NULL,0,10,0,0,4,'0000-00-00','2018-10-20','16:10:56','1'),
  (5,1,6,NULL,0,11,0,0,1,'0000-00-00','2018-10-21','09:53:52','1'),
  (6,1,6,NULL,0,100,0,0,1,'0000-00-00','2018-10-21','09:56:40','1'),
  (7,1,6,NULL,0,2,0,0,1,'0000-00-00','2018-10-21','10:02:33','1'),
  (8,1,17,NULL,0,0,0,0,1,'2018-11-04','2018-11-07','12:32:00','1'),
  (9,1,9,NULL,1156.3,0,0,0,2,'2018-11-04','2018-11-07','12:35:43','1'),
  (10,1,8,NULL,1157.82,0,0,0,2,'2018-11-20','2018-11-07','12:51:46','1');
COMMIT;

#
# Data for the `cuota` table  (LIMIT 0,500)
#

INSERT INTO `cuota` (`cuota_id`, `credito_id`, `usuario_id`, `estado_id`, `cuota_numcuota`, `cuota_capital`, `cuota_interes`, `cuota_moradias`, `cuota_multa`, `cuota_subtotal`, `cuota_descuento`, `cuota_total`, `cuota_fechalimite`, `cuota_cancelado`, `cuota_fecha`, `cuota_hora`, `cuota_numercibo`, `cuota_saldo`, `cuota_glosa`, `cuota_saldocredito`) VALUES 
  (1,2,1,9,1,650,60,0,0,710,0,710,'2018-11-16',0,NULL,NULL,NULL,0,'0',1420),
  (2,2,1,9,2,650,60,0,0,710,0,710,'2018-12-16',0,NULL,NULL,NULL,0,'0',1420),
  (3,8,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,0,'2018-11-04',NULL,'2018-11-07','12:32:00',NULL,0,NULL,NULL),
  (4,8,1,1,2,NULL,NULL,NULL,NULL,NULL,NULL,0,'2018-11-11',NULL,'2018-11-07','12:32:00',NULL,0,NULL,NULL),
  (5,9,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,578.15,'2018-11-04',NULL,'2018-11-07','12:35:43',NULL,1156.3,NULL,NULL),
  (6,9,1,1,2,NULL,NULL,NULL,NULL,NULL,NULL,578.15,'2018-11-11',NULL,'2018-11-07','12:35:43',NULL,1156.3,NULL,NULL),
  (7,10,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,578.91,'2018-11-20',NULL,'2018-11-07','12:51:46',NULL,1157.82,NULL,NULL),
  (8,10,1,1,2,NULL,NULL,NULL,NULL,NULL,NULL,578.91,'2018-11-27',NULL,'2018-11-07','12:51:46',NULL,1157.82,NULL,NULL);
COMMIT;

#
# Data for the `detalle_compra` table  (LIMIT 0,500)
#

INSERT INTO `detalle_compra` (`compra_id`, `moneda_id`, `producto_id`, `detallecomp_id`, `detallecomp_codigo`, `detallecomp_cantidad`, `detallecomp_unidad`, `detallecomp_costo`, `detallecomp_precio`, `detallecomp_subtotal`, `detallecomp_descuento`, `detallecomp_total`, `detallecomp_descglobal`, `detallecomp_fechavencimiento`, `detallecomp_tipocambio`) VALUES 
  (1,1,1,1,'producto1',9,'Pieza',52,109.2,5678.4,0,5678.4,NULL,NULL,NULL),
  (2,1,2,2,'producto2',9,'Pieza',86,52.8,4540.8,0,4540.8,NULL,NULL,NULL),
  (3,1,3,3,'producto3',9,'Pieza',74,33.6,2486.4,0,2486.4,NULL,NULL,NULL),
  (4,1,4,4,'producto4',9,'Pieza',1,96,96,0,96,NULL,NULL,NULL),
  (5,1,5,5,'producto5',9,'Pieza',59,43.2,2548.8,0,2548.8,NULL,NULL,NULL),
  (6,1,6,6,'producto6',9,'Pieza',58,36,2088,0,2088,NULL,NULL,NULL),
  (7,1,7,7,'producto7',9,'Pieza',43,102,4386,0,4386,NULL,NULL,NULL),
  (8,1,8,8,'producto8',4,'Pieza',41,67.2,164,0,164,NULL,NULL,NULL),
  (9,1,9,9,'producto9',9,'Pieza',67,2.4,160.8,0,160.8,NULL,NULL,NULL),
  (10,1,10,10,'producto10',9,'Pieza',96,88.8,8524.8,0,8524.8,NULL,NULL,NULL),
  (11,1,11,11,'producto11',9,'Pieza',94,90,8460,0,8460,NULL,NULL,NULL),
  (12,1,12,12,'producto12',9,'Pieza',14,85.2,1192.8,0,1192.8,NULL,NULL,NULL),
  (13,1,13,13,'producto13',9,'Pieza',30,15.6,468,0,468,NULL,NULL,NULL),
  (14,1,14,14,'producto14',9,'Pieza',23,9.6,220.8,0,220.8,NULL,NULL,NULL),
  (15,1,15,15,'producto15',9,'Pieza',81,20.4,1652.4,0,1652.4,NULL,NULL,NULL),
  (16,1,16,16,'producto16',10,'Pieza',68,87.6,680,0,680,NULL,NULL,NULL),
  (18,1,18,18,'producto18',9,'Pieza',77,6,462,0,462,NULL,NULL,NULL),
  (19,1,19,19,'producto19',9,'Pieza',26,31.2,811.2,0,811.2,NULL,NULL,NULL),
  (20,1,20,20,'producto20',9,'Pieza',76,21.6,1641.6,0,1641.6,NULL,NULL,NULL),
  (21,1,21,21,'producto21',9,'Pieza',32,103.2,3302.4,0,3302.4,NULL,NULL,NULL),
  (22,1,22,22,'producto22',9,'Pieza',10,63.6,636,0,636,NULL,NULL,NULL),
  (23,1,23,23,'producto23',9,'Pieza',30,51.6,1548,0,1548,NULL,NULL,NULL),
  (24,1,24,24,'producto24',9,'Pieza',16,102,1632,0,1632,NULL,NULL,NULL),
  (25,1,25,25,'producto25',9,'Pieza',3,34.8,104.4,0,104.4,NULL,NULL,NULL),
  (26,1,26,26,'producto26',9,'Pieza',61,85.2,5197.2,0,5197.2,NULL,NULL,NULL),
  (27,1,27,27,'producto27',9,'Pieza',4,36,144,0,144,NULL,NULL,NULL),
  (28,1,28,28,'producto28',9,'Pieza',69,38.4,2649.6,0,2649.6,NULL,NULL,NULL),
  (29,1,29,29,'producto29',9,'Pieza',27,34.8,939.6,0,939.6,NULL,NULL,NULL),
  (30,1,30,30,'producto30',9,'Pieza',37,61.2,2264.4,0,2264.4,NULL,NULL,NULL),
  (31,1,31,31,'producto31',9,'Pieza',19,110.4,2097.6,0,2097.6,NULL,NULL,NULL),
  (11,0,5,32,'AUD005',1,'Pieza',23,35,23,0,23,NULL,NULL,NULL),
  (13,0,3,33,'AUD003',1,'Pieza',25,35,25,0,25,NULL,NULL,NULL),
  (15,0,6,34,'BUS006',1,'Pieza',0.5,15,0.5,0,0.5,NULL,NULL,NULL),
  (8,0,6,35,'BUS006',1,'Pieza',0.5,15,0.5,0,0.5,NULL,NULL,NULL),
  (8,0,14,36,'CAB0014',1,'Pieza',5,15,5,0,5,NULL,NULL,NULL),
  (9,0,7,37,'BUS007',1,'Pieza',0.5,15,0.5,0,0.5,NULL,NULL,NULL),
  (9,0,7,38,'BUS007',100,'Pieza',0.5,15,50,0,50,NULL,NULL,NULL),
  (9,0,5,39,'AUD005',15,'Pieza',23,35,345,0,345,NULL,NULL,NULL),
  (9,0,9,40,'BUS009',120,'Pieza',5,7,600,0,600,NULL,NULL,NULL),
  (8,0,10,41,'CAR0010',10,'Pieza',98.832,150,988.32,0,988.32,NULL,NULL,NULL);
COMMIT;

#
# Data for the `detalle_pedido` table  (LIMIT 0,500)
#

INSERT INTO `detalle_pedido` (`pedido_id`, `producto_id`, `detalleped_id`, `detalleped_codigo`, `detalleped_foto`, `detalleped_nombre`, `detalleped_unidad`, `detalleped_costo`, `detalleped_cantidad`, `detalleped_precio`, `detalleped_descuento`, `detalleped_subtotal`, `detalleped_total`, `detalleped_preferencia`, `detalleped_comision`) VALUES 
  (1,2,6,12346,'2.png','ALARGADOR USB 3MTS','Pieza',10.000,5,25.000,0,125,125,'nada',NULL),
  (1,5,8,12349,'5.png','AUDIFONO MULTIMEDIA','Pieza',23.000,2,35.000,0,70,70,'nada por aqui',NULL),
  (25,1,12,12345,'1.png','ALARGADOR USB 1.5MTS','Pieza',5.000,4,15.000,0,60,60,'',NULL),
  (3,1,15,12345,'1.png','ALARGADOR USB 1.5MTS','Pieza',5.000,2,15.000,0,30,30,'',NULL),
  (3,2,17,12346,'2.png','ALARGADOR USB 3MTS','Pieza',10.000,4,25.000,0.5,100,99.5,'',NULL),
  (25,3,18,12347,'3.png','AUDIFONO SONY','Pieza',25.000,3,35.000,0,105,105,'',NULL),
  (25,4,19,12348,'4.png','AUDIFONO SONYA','Pieza',27.000,3,45.000,0,135,135,'',NULL),
  (29,2,20,12346,'2.png','ALARGADOR USB 3MTS','Pieza',10.000,1,25.000,0,25,25,'',NULL),
  (29,2,21,12346,'2.png','ALARGADOR USB 3MTS','Pieza',10.000,12,25.000,0,300,300,'',NULL),
  (30,1,22,12345,'1.png','ALARGADOR USB 1.5MTS','Pieza',5.000,1,15.000,0,15,15,'',NULL),
  (21,1,23,12345,'1.png','ALARGADOR USB 1.5MTS','Pieza',5.000,1,15.000,0,15,15,'',NULL),
  (21,4,26,12348,'4.png','AUDIFONO SONYA','Pieza',27.000,1,45.000,0,45,45,'',NULL),
  (21,8,27,12352,'8.png','BUS SATA CON SUJETADOR METALICO','Pieza',3.500,5,10.000,0,50,50,'',NULL),
  (34,3,28,12347,'3.png','AUDIFONO SONY','Pieza',25.000,2,35.000,0,70,70,'',NULL),
  (34,3,29,12347,'3.png','AUDIFONO SONY','Pieza',25.000,3,35.000,0,105,105,'',NULL),
  (19,1,30,12345,'1.png','ALARGADOR USB 1.5MTS','Pieza',5.000,1,15.000,0,15,15,'',NULL),
  (19,5,31,12349,'5.png','AUDIFONO MULTIMEDIA','Pieza',23.000,1,35.000,0,35,35,'',NULL),
  (19,4,32,12348,'4.png','AUDIFONO SONYA','Pieza',27.000,1,45.000,0,45,45,'',NULL),
  (34,1,33,12345,'1.png','ALARGADOR USB 1.5MTS','Pieza',5.000,10,15.000,0.5,150,149.5,'',NULL),
  (38,2,38,12346,'2.png','ALARGADOR USB 3MTS','Pieza',10.000,10,25.000,0,250,250,'',NULL),
  (38,2,39,12346,'2.png','ALARGADOR USB 3MTS','Pieza',10.000,1,25.000,0,25,25,'',NULL),
  (40,3,42,12347,'3.png','AUDIFONO SONY','Pieza',25.000,10,35.000,1,350,349,'',NULL),
  (39,6,44,12350,'6.png','BUS DE DATOS IDE FLOPPY','Pieza',0.500,1,15.000,0,15,15,'',NULL),
  (24,5,45,12349,'5.png','AUDIFONO MULTIMEDIA','Pieza',23.000,1,35.000,0,35,35,'',NULL),
  (24,8,46,12352,'8.png','BUS SATA CON SUJETADOR METALICO','Pieza',3.500,1,10.000,0,10,10,'',NULL),
  (32,1,47,12345,'1.png','ALARGADOR USB 1.5MTS','Pieza',5.000,1,15.000,0,15,15,'',NULL),
  (32,3,48,12347,'3.png','AUDIFONO SONY','Pieza',25.000,1,35.000,0,35,35,'',NULL),
  (5,1,49,12345,'1.png','ALARGADOR USB 1.5MTS','Pieza',5.000,1,15.000,0,15,15,'',NULL),
  (5,2,50,12346,'2.png','ALARGADOR USB 3MTS','Pieza',10.000,1,25.000,0,25,25,'',NULL),
  (39,5,51,12349,'5.png','AUDIFONO MULTIMEDIA','Pieza',23.000,1,35.000,0,35,35,'',NULL),
  (39,7,52,12351,'7.png','BUS DE DATOS IDE HDD','Pieza',0.500,1,15.000,0,15,15,'',NULL),
  (39,8,53,12352,'8.png','BUS SATA CON SUJETADOR METALICO','Pieza',3.500,1,10.000,0,10,10,'',NULL),
  (43,7,54,0,'7.png','BUS DE DATOS IDE HDD','Pieza',0.500,1,15.000,0,15,15,'',NULL),
  (43,10,55,0,'10.png','CARTUCHO CANON PG-210','Pieza',98.832,1,150.000,0,150,150,'',NULL),
  (43,10,56,0,'10.png','CARTUCHO CANON PG-210','Pieza',98.832,1,150.000,0,150,150,'',NULL);
COMMIT;

#
# Data for the `detalle_venta_aux` table  (LIMIT 0,500)
#

INSERT INTO `detalle_venta_aux` (`producto_id`, `venta_id`, `moneda_id`, `detalleven_id`, `detalleven_codigo`, `detalleven_cantidad`, `detalleven_unidad`, `detalleven_costo`, `detalleven_precio`, `detalleven_subtotal`, `detalleven_descuento`, `detalleven_total`, `detalleven_caracteristicas`, `detalleven_preferencia`, `detalleven_comision`, `detalleven_tipocambio`, `usuario_id`) VALUES 
  (11,0,1,5,'12355',1,0,129.258,160,160,0,160,'-','-',0,1,1),
  (11,0,1,6,'12355',2,0,129.258,160,320,0,320,'-','-',0,1,1),
  (2,0,1,35,'12346',10,0,10,25,250,0,250,'','',0,1,1),
  (2,0,1,36,'12346',1,0,10,25,25,0,25,'','',0,1,1),
  (2,0,1,38,'12346',10,0,10,25,250,0,250,'','',0,1,1),
  (2,0,1,39,'12346',1,0,10,25,25,0,25,'','',0,1,1),
  (2,0,0,41,'12346',10,0,10,25,250,0,250,'','',0,1,1),
  (2,0,0,42,'12346',1,0,10,25,25,0,25,'','',0,1,1),
  (2,0,0,44,'12346',10,0,10,25,250,0,250,'','',0,1,1),
  (2,0,0,45,'12346',1,0,10,25,25,0,25,'','',0,1,1),
  (5,0,1,62,'AUD005',1,0,23,35,35,0,35,'-','-',0,1,1),
  (8,0,1,63,'BUS008',1,0,41,67.2,67.2,0,67.2,'-','-',0,1,1);
COMMIT;

#
# Data for the `documento_respaldo` table  (LIMIT 0,500)
#

INSERT INTO `documento_respaldo` (`documento_respaldo_id`, `documento_respaldo_descripcion`) VALUES 
  (1,'FACTURA'),
  (2,'RECIBO');
COMMIT;

#
# Data for the `dosificacion` table  (LIMIT 0,500)
#

INSERT INTO `dosificacion` (`dosificacion_id`, `estado_id`, `empresa_id`, `dosificacion_fechahora`, `dosificacion_nitemisor`, `dosificacion_autorizacion`, `dosificacion_llave`, `dosificacion_numfact`, `dosificacion_leyenda1`, `dosificacion_leyenda2`, `dosificacion_sucursal`, `dosificacion_sfc`, `dosificacion_actividad`) VALUES 
  (1,1,2,'0000-00-00 00:00:00',14349024,564314135,'fdf%/)=?dt5646$3=(/&%$·',0,'Aqui va la leyenda','Aqui otra leyenda','1','01','Muy activa');
COMMIT;

#
# Data for the `egresos` table  (LIMIT 0,500)
#

INSERT INTO `egresos` (`egreso_id`, `egreso_numero`, `usuario_id`, `egreso_categoria`, `egreso_nombre`, `egreso_monto`, `egreso_moneda`, `egreso_concepto`, `egreso_fecha`) VALUES 
  (2,15,'1','REFRIGERIOS','juan',200,'Bs','pasaje','2018-09-24 21:15:28'),
  (3,16,'1','','juan',100,'USD','pasaje','2018-09-24 21:25:18');
COMMIT;

#
# Data for the `empresa` table  (LIMIT 0,500)
#

INSERT INTO `empresa` (`empresa_id`, `dosificacion_id`, `empresa_nombre`, `empresa_eslogan`, `empresa_direccion`, `empresa_telefono`, `empresa_imagen`, `empresa_zona`, `empresa_ubicacion`) VALUES 
  (1,NULL,'Easy Market','Compre más, compre mejor..!!!','Argelia S/N casi Av. Libertad','(591)(4) 4229666','logo.jpg','Zona Valle Hermoso','Cochabamba - Bolivia'),
  (2,NULL,'Easy Market','Buy more, for less..!!!','Argelia S/N casi Av. Libertad','(591)(4) 4229666','logo.jpg','Zona Valle Hermoso','Cochabamba - Bolivia');
COMMIT;

#
# Data for the `empresa_pagina` table  (LIMIT 0,500)
#

INSERT INTO `empresa_pagina` (`emppag_id`, `empresa_id`, `pagina_id`) VALUES 
  (1,1,1),
  (2,1,2);
COMMIT;

#
# Data for the `estado` table  (LIMIT 0,500)
#

INSERT INTO `estado` (`estado_id`, `estado_descripcion`, `estado_tipo`, `estado_color`) VALUES 
  (1,'ACTIVO',1,NULL),
  (2,'INACTIVO',1,NULL),
  (3,'ANULADO',1,NULL),
  (4,'CERRADO',2,NULL),
  (5,'PENDIENTE',3,NULL),
  (6,'TERMINADO',3,NULL),
  (7,'ENTREGADO',3,NULL),
  (8,'PENDIENTE',4,NULL),
  (9,'CANCELADO',4,NULL),
  (10,'ABIERTO',5,'A3A3A3'),
  (11,'PENDIENTE',5,'DEBB09'),
  (12,'APROBADO',5,'29AF01'),
  (13,'ENTREGADO',5,'0780C9'),
  (14,'REBOTADO',5,'FF2E00'),
  (15,'CANCELADO',5,'C06402');
COMMIT;

#
# Data for the `estado_pagina` table  (LIMIT 0,500)
#

INSERT INTO `estado_pagina` (`estadopag_id`, `estadopag_descripcion`) VALUES 
  (1,'ACTIVO'),
  (2,'INACTIVO');
COMMIT;

#
# Data for the `forma_pago` table  (LIMIT 0,500)
#

INSERT INTO `forma_pago` (`forma_id`, `forma_nombre`) VALUES 
  (1,'EFECTIVO'),
  (2,'TARJETA DE DEBITO'),
  (3,'BANCO'),
  (4,'TARJETA DE CREDITO');
COMMIT;

#
# Data for the `galeria` table  (LIMIT 0,500)
#

INSERT INTO `galeria` (`galeria_id`, `estadopag_id`, `galeria_titulo`, `galeria_descripcion`, `galeria_texto`) VALUES 
  (1,1,'Galeria1','Galeria para slide','');
COMMIT;

#
# Data for the `idioma` table  (LIMIT 0,500)
#

INSERT INTO `idioma` (`idioma_id`, `idioma_descripcion`, `idioma_imagen`, `idioma_enlace`) VALUES 
  (1,'Español','esp.jpg',''),
  (2,'English','eng.jpg','');
COMMIT;

#
# Data for the `imagen` table  (LIMIT 0,500)
#

INSERT INTO `imagen` (`imagen_id`, `estadopag_id`, `articulo_id`, `imagen_titulo`, `imagen_texto`, `imagen_nombre`) VALUES 
  (1,1,0,'slide1','','slide1.jpg'),
  (2,1,0,'slide2','','slide2.jpg'),
  (3,1,0,'slide3','','slide3.jpg'),
  (4,1,0,'Slide4','','b1.jpg'),
  (5,1,0,'Slide 5','','b2.jpg'),
  (6,1,0,'Slide6','','b3.jpg');
COMMIT;

#
# Data for the `ingresos` table  (LIMIT 0,500)
#

INSERT INTO `ingresos` (`ingreso_id`, `ingreso_numero`, `usuario_id`, `ingreso_categoria`, `ingreso_nombre`, `ingreso_monto`, `ingreso_moneda`, `ingreso_concepto`, `ingreso_fecha`) VALUES 
  (1,16,1,'PAGO POR MEMBRESIA','andres',100,'Bs','pasaje','2018-09-24 15:47:42'),
  (2,1,1,'PAGO POR MEMBRESIA','alejandro',200,'Bs','pasaje','2018-09-24 19:19:51'),
  (3,18,1,'PAGO POR MEMBRESIA','miguel',100,'USD','libro','2018-09-24 19:21:19'),
  (5,20,1,'PAGO POR MEMBRESIA','saul',200,'Bs','pasaje','2018-09-24 19:26:38'),
  (6,21,1,'PAGO POR SERVICIOS','mike',0,'Bs','pasaje','2018-10-15 11:37:41'),
  (0,16,1,'PAGO POR MEMBRESIA','Juan Perez',500,'Bs','Cualquier cosa','2018-10-15 11:37:21');
COMMIT;

#
# Data for the `menu` table  (LIMIT 0,500)
#

INSERT INTO `menu` (`menu_id`, `estadopag_id`, `menup_id`, `menu_nombre`, `menu_tipo`, `menu_descripcion`, `menu_enlace`, `menu_imagen`) VALUES 
  (1,1,1,'Crear cuenta','','Ingrese para registrarse','',''),
  (2,1,1,'Ingresar','','Ingrese si tiene cuentra registrada','login',''),
  (3,1,1,'Ayuda','','Opciones de ayuda','',''),
  (4,1,2,'Create Account','','Login to register','',''),
  (5,1,2,'Login','','Sign in if you have an account','',''),
  (6,1,2,'Help','','Help options','',''),
  (7,1,3,'inicio','','Volver a la pagina principal','',''),
  (8,1,3,'Productos','','Lista de nuestra categorias de productos','',''),
  (9,1,3,'Servicios','','Lista de nuestros servicios','',''),
  (10,1,3,'Pedidos','','Opciones para el registro de pedidos','',''),
  (11,1,3,'Ofertas','','Nuestras ofertas','',''),
  (12,1,3,'Contactos','','Contactese con nosotros','',''),
  (13,1,4,'Home','','Back to the home page','',''),
  (14,1,4,'Products','','List of our product categories','',''),
  (15,1,4,'Services','','List of our services','',''),
  (16,1,4,'Orders','','Options for the registration of orders','',''),
  (17,1,4,'Offers','','Our offers','',''),
  (18,1,4,'Contact','','Contact us','','');
COMMIT;

#
# Data for the `menu_principal` table  (LIMIT 0,500)
#

INSERT INTO `menu_principal` (`menup_id`, `pagina_id`, `estadopag_id`, `menup_nombre`, `menup_descripcion`, `menup_enlace`, `menup_imagen`) VALUES 
  (1,1,1,'Menu registro','menu de cabecera para el registro de usuarios','',''),
  (2,2,1,'Menu register','Header menu for user registration','',''),
  (3,1,1,'Menu principal','Menu de opciones del sistema','',''),
  (4,2,1,'Main menu','System options menu','','');
COMMIT;

#
# Data for the `moneda` table  (LIMIT 0,500)
#

INSERT INTO `moneda` (`moneda_id`, `estado_id`, `moneda_descripcion`, `moneda_tc`) VALUES 
  (1,1,'Bs',1),
  (2,1,'USD',6.96);
COMMIT;

#
# Data for the `pagina_web` table  (LIMIT 0,500)
#

INSERT INTO `pagina_web` (`pagina_id`, `idioma_id`, `estadopag_id`, `empresa_id`, `pagina_nombre`, `pagina_telefono`, `pagina_direccion`, `pagina_informacion`, `pagina_imagen`) VALUES 
  (1,1,1,1,'Ximpleman :: Sistema de distribución online','(591)(4)4511518','www.easymarket.com','Compra más por menos..!!','logo.jpg'),
  (2,2,1,1,'Ximpleman :: Distribution online system','(591)(4)4511518','www.easymarket.com','Buy more, for less...!!','logo.jpg');
COMMIT;

#
# Data for the `parametros` table  (LIMIT 0,500)
#

INSERT INTO `parametros` (`parametro_id`, `parametro_numrecegr`, `parametro_numrecing`, `parametro_copiasfact`, `parametro_tipoimpresora`, `parametro_numcuotas`, `parametro_montomax`, `parametro_diasgracia`, `parametro_diapago`, `parametro_periododias`) VALUES 
  (1,13,16,3,'FACTURADORA',1,1000.000,14,2,7);
COMMIT;

#
# Data for the `pedido` table  (LIMIT 0,500)
#

INSERT INTO `pedido` (`pedido_id`, `usuario_id`, `estado_id`, `cliente_id`, `tipotrans_id`, `pedido_fecha`, `pedido_subtotal`, `pedido_descuento`, `pedido_total`, `pedido_glosa`, `pedido_fechaentrega`, `pedido_horaentrega`) VALUES 
  (1,1,10,6,1,'0000-00-00 00:00:00',750,0,750,'-','0000-00-00','00:00:00'),
  (2,1,11,2,1,'0000-00-00 00:00:00',520,20,500,'Debe entregarse antes de medio dia','0000-00-00','00:00:00'),
  (3,1,10,3,1,'0000-00-00 00:00:00',450.5,0,450.5,'','0000-00-00','00:00:00'),
  (4,1,10,5,1,'2018-08-16 18:18:23',0,0,0,'-','2018-08-16','18:18:23'),
  (5,1,10,3,1,'2018-08-16 18:19:46',0,0,0,'-','2018-08-17','18:19:46'),
  (6,1,10,0,1,'2018-08-16 18:35:08',0,0,0,'-','2018-08-17','18:35:08'),
  (7,1,10,0,1,'2018-08-16 18:36:17',0,0,0,'-','2018-08-17','18:36:17'),
  (8,1,10,0,1,'2018-08-16 18:39:29',0,0,0,'-','2018-08-17','18:39:29'),
  (9,1,10,0,1,'2018-08-16 18:40:02',0,0,0,'-','2018-08-17','18:40:02'),
  (10,1,10,0,1,'2018-08-16 18:40:25',0,0,0,'-','2018-08-17','18:40:25'),
  (11,1,10,3,1,'2018-08-25 05:03:35',0,0,0,'-','2018-08-26','05:03:35'),
  (12,1,10,0,1,'2018-09-28 05:43:29',0,0,0,'',NULL,NULL),
  (13,1,10,0,1,'2018-09-28 05:54:13',0,0,0,'',NULL,NULL),
  (14,1,10,0,1,'2018-09-28 05:54:29',0,0,0,'',NULL,NULL),
  (15,1,10,0,1,'2018-09-28 05:56:55',0,0,0,'',NULL,NULL),
  (16,1,10,0,1,'2018-09-28 05:56:56',0,0,0,'',NULL,NULL),
  (17,1,10,0,1,'2018-09-28 05:57:58',0,0,0,'',NULL,NULL),
  (18,1,10,0,1,'2018-09-28 05:58:05',0,0,0,'',NULL,NULL),
  (19,1,10,7,1,'2018-09-28 05:58:19',0,0,0,'',NULL,NULL),
  (20,1,10,0,1,'2018-09-28 06:00:36',0,0,0,'',NULL,NULL),
  (21,1,10,7,1,'2018-09-28 06:02:48',0,0,0,'',NULL,NULL),
  (22,1,10,0,1,'2018-09-29 00:30:50',0,0,0,'',NULL,NULL),
  (23,1,10,0,1,'2018-09-29 01:54:28',0,0,0,'',NULL,NULL),
  (24,1,11,14,1,'2018-10-19 19:11:58',45,0,45,'','2018-10-19','19:11:16'),
  (25,1,10,10,1,'2018-10-06 14:30:25',0,0,0,'',NULL,NULL),
  (26,1,10,0,1,'2018-10-08 17:32:11',0,0,0,'',NULL,NULL),
  (27,1,10,0,1,'2018-10-08 17:32:46',0,0,0,'',NULL,NULL),
  (28,1,10,0,1,'2018-10-08 17:36:35',0,0,0,'',NULL,NULL),
  (29,1,10,7,1,'2018-10-08 17:42:51',0,0,0,'',NULL,NULL),
  (30,1,11,2,1,'2018-10-20 13:57:37',15,0,15,'','2018-10-20','13:57:32'),
  (31,1,10,0,1,'2018-10-09 08:41:25',0,0,0,'',NULL,NULL),
  (32,1,11,4,1,'2018-10-19 19:13:08',0,0,0,'','2018-10-19','19:13:03'),
  (33,1,10,0,1,'2018-10-11 09:08:20',0,0,0,'',NULL,NULL),
  (34,1,14,4,1,'2018-10-19 17:33:35',324.5,0.5,324.5,'','2018-10-08','15:20:00'),
  (35,1,10,0,1,'2018-10-12 14:51:43',0,0,0,'',NULL,NULL),
  (36,1,10,0,1,'2018-10-12 20:32:51',0,0,0,'',NULL,NULL),
  (37,1,10,0,1,'2018-10-15 18:12:12',0,0,0,'',NULL,NULL),
  (38,1,11,12,1,'2018-10-19 16:54:25',275,0,275,'','2018-02-18','16:45:00'),
  (39,1,11,13,1,'2018-10-24 16:06:47',110,0,110,'','2018-10-24','16:06:38'),
  (40,1,10,0,1,'2018-10-18 12:41:43',0,0,0,'',NULL,NULL),
  (41,1,10,0,1,'2018-10-19 11:23:33',0,0,0,'',NULL,NULL),
  (42,1,10,0,1,'2018-10-22 17:49:05',0,0,0,'',NULL,NULL),
  (43,1,11,4,1,'2018-11-07 19:15:50',315,0,315,'','2018-11-07','19:05:41'),
  (44,1,10,0,1,'2018-10-23 18:32:39',0,0,0,'',NULL,NULL),
  (45,1,10,0,1,'2018-10-24 09:15:20',0,0,0,'',NULL,NULL);
COMMIT;

#
# Data for the `presentacion` table  (LIMIT 0,500)
#

INSERT INTO `presentacion` (`presentacion_id`, `presentacion_nombre`, `presentacion_codigobarra`, `presentacion_contenido`, `presentacion_unidad`, `presentacion_precio`, `producto_id`) VALUES 
  (1,'Unidad',NULL,1,'Pieza',15,1),
  (2,'Unidad',NULL,1,'Pieza',25,1),
  (3,'Unidad',NULL,1,'Pieza',35,1),
  (4,'Unidad',NULL,1,'Pieza',45,2),
  (5,'Unidad',NULL,1,'Pieza',35,2),
  (6,'Unidad',NULL,1,'Pieza',15,3),
  (7,'Unidad',NULL,1,'Pieza',15,3),
  (8,'Unidad',NULL,1,'Pieza',10,3),
  (9,'Unidad',NULL,1,'Pieza',7,4),
  (10,'Unidad',NULL,1,'Pieza',150,4),
  (11,'Unidad',NULL,1,'Pieza',160,4),
  (12,'Unidad',NULL,1,'Pieza',15,5),
  (13,'Unidad',NULL,1,'Pieza',15,5),
  (14,'Unidad',NULL,1,'Pieza',15,5),
  (15,'Unidad',NULL,1,'Pieza',25,6),
  (16,'Unidad',NULL,1,'Pieza',2,6),
  (17,'Unidad',NULL,1,'Pieza',15,6),
  (18,'Unidad',NULL,1,'Pieza',10,7),
  (19,'Unidad',NULL,1,'Pieza',50,7),
  (20,'Unidad',NULL,1,'Pieza',50,7),
  (21,'Unidad',NULL,1,'Pieza',35,7),
  (22,'Unidad',NULL,1,'Pieza',100,9),
  (23,'Unidad',NULL,1,'Pieza',38,9),
  (24,'Unidad',NULL,1,'Pieza',15,9),
  (25,'Unidad',NULL,1,'Pieza',15,11),
  (26,'Unidad',NULL,1,'Pieza',35,11),
  (27,'Unidad',NULL,1,'Pieza',47,11),
  (28,'Unidad',NULL,1,'Pieza',35,14),
  (29,'Unidad',NULL,1,'Pieza',982.73,14),
  (30,'Unidad',NULL,1,'Pieza',99,14);
COMMIT;

#
# Data for the `producto` table  (LIMIT 0,500)
#

INSERT INTO `producto` (`producto_id`, `estado_id`, `categoria_id`, `presentacion_id`, `moneda_id`, `producto_codigo`, `producto_codigobarra`, `producto_foto`, `producto_nombre`, `producto_unidad`, `producto_marca`, `producto_industria`, `producto_costo`, `producto_precio`, `producto_comision`, `producto_tipocambio`) VALUES 
  (3,1,6,1,1,'AUD003','1234712347','3.png','AUDIFONO SONY','Pieza','Toshiba','China',25,35,0,1),
  (5,1,6,1,1,'AUD005','1234912349','5.png','AUDIFONO MULTIMEDIA','Pieza','HP','China',23,35,0,1),
  (6,1,6,1,1,'BUS006','1235012350','6.png','BUS DE DATOS IDE FLOPPY','Pieza','HP','China',0.5,15,0,1),
  (7,1,6,1,1,'BUS007','1235112351','7.png','BUS DE DATOS IDE HDD','Pieza','HP','China',0.5,15,0,1),
  (8,1,6,1,1,'BUS008','1235212352','8.png','BUS SATA CON SUJETADOR METALICO','Pieza','HP','China',41,67.2,0,1),
  (9,1,6,1,1,'BUS009','1235312353','9.png','BUS SATA CON SUJETADOR PLASTICO','Pieza','HP','China',5,7,0,1),
  (10,1,6,1,1,'CAR0010','1235412354','10.png','CARTUCHO CANON PG-210','Pieza','HP','China',98.832,150,0,1),
  (12,1,6,1,1,'CAB0012','1235612356','producto.jpg','CABLE DE ENERGIA PARA IMPRESORA','Pieza','HP','China',3.5,15,0,1),
  (13,1,6,1,1,'CAB0013','1235712357','producto.jpg','CABLE DE ENERGIA PARA PC','Pieza','HP','China',4.42857,15,0,1),
  (14,1,6,1,1,'CAB0014','1235812358','producto.jpg','CABLE USB DE IMPRESORA 1.5MTS','Pieza','HP','China',5,15,0,1),
  (15,1,6,1,1,'CAB0015','1235912359','producto.jpg','CABLE USB DE IMPRESORA 3MTS','Pieza','HP','China',11.6667,25,0,1),
  (16,1,6,1,1,'CAB0016','1236012360','producto.jpg','CABLE DE RED SP UTP CAT.5E','Pieza','HP','China',68,87.6,0,1),
  (17,1,6,1,1,'CAB0017','1236112361','producto.jpg','CABLE DE SVIDEO A COMPUESTO','Pieza','HP','China',3,15,0,1),
  (18,1,6,1,1,'CAB0018','1236212362','producto.jpg','CABLE DE TELEFONO','Pieza','HP','China',3.5,10,0,1),
  (19,1,6,1,1,'CAB0019','1236312363','producto.jpg','CABLE DVI','Pieza','HP','China',3.5,50,0,1),
  (20,1,6,1,1,'CAB0020','1236412364','producto.jpg','CABLE E/S PARA CAPTURADOR DE TV','Pieza','HP','China',3.5,50,0,1),
  (21,1,6,1,1,'CAB0021','1236512365','producto.jpg','CABLE FIREWARE','Pieza','HP','China',3.5,35,0,1),
  (23,1,6,1,1,'CAB0023','1236712367','producto.jpg','CABLE PARALELO PARA IMPRESORA','Pieza','HP','China',25,38,0,1),
  (24,1,6,1,1,'CAB0024','1236812368','producto.jpg','CABLE STEREO A COMPUESTO','Pieza','HP','China',5,15,0,1),
  (25,1,6,1,1,'CAB0025','1236912369','producto.jpg','CABLE S-VIDEO','Pieza','HP','China',3,15,0,1),
  (26,1,6,1,1,'CAB0026','1237012370','producto.jpg','CABLE USB A PARALELO','Pieza','HP','China',14,35,0,1),
  (27,1,4,1,1,'CAB0027','1237112371','producto.jpg','CABLE VGA 15M MACHO A MACHO 3MTS','Pieza','HP','China',13.5,47,0,1),
  (28,1,6,1,1,'CAB0028','1237212372','producto.jpg','CABLE VGA 1.50 MT','Pieza','HP','China',18,35,0,1),
  (29,1,6,1,1,'CAM0029','1237312373','producto.jpg','CAMARA DE VIGILANCIA INALAMBRICA','Pieza','HP','China',636.3,982.73,0,1),
  (30,1,6,30,1,'CAM0030','1237412374','producto.jpg','CAMARA WEB 5MPX PC-CAMERA','Pieza','HP','China',77,99,0,1);
COMMIT;

#
# Data for the `promocion` table  (LIMIT 0,500)
#

INSERT INTO `promocion` (`promocion_id`, `producto_id`, `estado_id`, `promocion_titulo`, `promocion_descripcion`, `promocion_cantidad`, `promocion_preciototal`, `promocion_fecha`) VALUES 
  (1,30,1,'Camara web 5MPX','Dos camaras web por el precio de 1. Solo hasta agotar stock',2,100.000,'2018-05-27'),
  (2,21,1,'CABLE FIREWARE 3X1','Promoción de cable fireware hasta gotar stock',3,30.000,'2018-05-27'),
  (3,7,1,'Buses al 30% de descuento','Liquidacion de buses al 30% de descuento hasta fin de mes.',1,8.000,NULL),
  (4,5,1,'Audifono multimedia Sonia 2.0','Audifonos para juegos de la mejor calidad.',1,39.000,NULL);
COMMIT;

#
# Data for the `proveedor` table  (LIMIT 0,500)
#

INSERT INTO `proveedor` (`proveedor_id`, `estado_id`, `proveedor_codigo`, `proveedor_nombre`, `proveedor_foto`, `proveedor_contacto`, `proveedor_direccion`, `proveedor_telefono`, `proveedor_email`, `proveedor_nit`, `proveedor_razon`, `proveedor_autorizacion`) VALUES 
  (1,1,'11','sass',NULL,'sandro',NULL,'4455445',NULL,'198581','SAS','1010'),
  (2,1,'22','password',NULL,'carlos','uruguay505','4249180',NULL,'665544','pass','2020'),
  (11,1,'2146278160','evo',NULL,'morales','','51511',NULL,'2121','mora','1'),
  (12,1,'2094960121','umss',NULL,'sansi','','292992',NULL,'4444','umss','1'),
  (13,1,'1902405898','mario',NULL,'mario','','122303116',NULL,'2020','ola','1'),
  (14,1,'927793761','hp',NULL,'mario','','7070057',NULL,'22000','hp','1'),
  (15,1,'818451678','intel',NULL,'teresa','','878787',NULL,'550033','intel','1'),
  (16,1,'892801552','samsung',NULL,'coreano','','',NULL,'12345','samsung','1'),
  (17,1,'21308','Intcomex',NULL,'Juan Perez','','4515238',NULL,'141359202','Intcomex','1'),
  (18,1,'17823','Distrib. Mario',NULL,'Mario Escobar','','3446878',NULL,'','Distrib. Mario','1'),
  (19,1,'17629','Importadora Don Ramon',NULL,'na','','4511540',NULL,'141359025','Importadora Don Ramon','1');
COMMIT;

#
# Data for the `responsable` table  (LIMIT 0,500)
#

INSERT INTO `responsable` (`responsable_id`, `responsable_nombres`, `responsable_apellidos`, `responsable_ci`, `responsable_cargo`, `responsable_telefono`, `responsable_direccion`, `responsable_imagen`, `responsable_latitud`, `responsable_longitud`) VALUES 
  (1,'Juan','Perez','5152377 CBBA','Tecnico','4522152 - 7791852','Av. San Martin Nº 451','',0,0);
COMMIT;

#
# Data for the `seccion` table  (LIMIT 0,500)
#

INSERT INTO `seccion` (`seccion_id`, `pagina_id`, `estadopag_id`, `seccion_titulo`, `seccion_descripcion`, `seccion_texto`, `seccion_tipo`) VALUES 
  (1,1,1,'PRODUCTOS MÁS VENDIDOS','Aqui van los productos más vendidos','Te ofrecemos para tu comodidad una gran variedad de producto para tu eleccion y poder comprar desde nuestas sucursales a su casa.',1),
  (2,2,1,'TOP SELLING OFFERS','Here you will find our offers','We have a variety of products that can be delivered directly to your home.',1),
  (3,1,1,'Ofertas','Ofertas de la semana','Reunimos todas nuestras ofertas publicitadas en un solo lugar, por lo que no se perderá una gran oportunidad.',2),
  (4,2,1,'Advertised Offers','Advertised this week','We''ve pulled together all our advertised offers into one place, so you won''t miss out on a great deal.',2),
  (5,1,1,'Ofertas del dia','Ofertas del hoy','Los mejores productos y ofertas para usted y su familiar.',3),
  (6,2,1,'OFFERS TODAY','Today''s offers','The best prices with products of the best quality',3);
COMMIT;

#
# Data for the `slide` table  (LIMIT 0,500)
#

INSERT INTO `slide` (`slide_id`, `estadopag_id`, `pagina_id`, `slide_tipo`, `slide_titulo`, `slide_leyenda1`, `slide_leyenda2`, `slide_leyenda3`, `slide_enlace`, `slide_imagen`) VALUES 
  (1,1,1,1,'Mi titulo 1','Aqui va su subtitulito','Aqui otras cositas mas','Por si acaso una mas','','slide1.jpg'),
  (2,1,1,1,'Titulo 2','Aqui va el titulo 2','Subtitulo 2','','','slide2.jpg'),
  (3,1,1,1,'Titulo de slide 3','Leyenda slide 3','sub titulo leyenda slide 3','','','slide3.jpg'),
  (4,1,2,1,'Title Slide one','Sub Title Slide one','','','','slide1.jpg'),
  (5,1,2,1,'Title Slide Two','subTitle Slide two','','','','slide2.jpg'),
  (6,1,2,1,'Title Slide three','Title Slide three','','','','slide3.jpg'),
  (7,1,1,2,'first-slide','item active','','','','b1.jpg'),
  (8,1,1,2,'second-slide','item','','','','b2.jpg'),
  (9,1,1,2,'third-slide','item',NULL,NULL,NULL,'b3.jpg'),
  (10,1,2,2,'first-slide','item active',NULL,NULL,NULL,'b1.jpg'),
  (11,1,2,2,'second-slide','item',NULL,NULL,NULL,'b2.jpg'),
  (12,1,2,2,'third-slide','item',NULL,NULL,NULL,'b3.jpg');
COMMIT;

#
# Data for the `slide_imagen` table  (LIMIT 0,500)
#

INSERT INTO `slide_imagen` (`slideimagen_id`, `slide_id`, `imagen_id`) VALUES 
  (1,1,1),
  (2,2,2),
  (3,3,3),
  (4,4,1),
  (5,5,2),
  (6,6,3),
  (7,8,0),
  (8,8,0),
  (9,8,0),
  (10,7,0),
  (12,7,0);
COMMIT;

#
# Data for the `tipo_cliente` table  (LIMIT 0,500)
#

INSERT INTO `tipo_cliente` (`tipocliente_id`, `tipocliente_descripcion`, `tipocliente_porcdesc`, `tipocliente_montodesc`) VALUES 
  (1,'MINORISTA',0,0),
  (2,'MAYORISTA',0,0),
  (3,'SUB-DISTRIBUIDOR',0,0);
COMMIT;

#
# Data for the `tipo_transaccion` table  (LIMIT 0,500)
#

INSERT INTO `tipo_transaccion` (`tipotrans_id`, `tipotrans_nombre`) VALUES 
  (1,'CONTADO'),
  (2,'CREDITO'),
  (3,'CONSIGNACION'),
  (4,'BANCO');
COMMIT;

#
# Data for the `tipo_usuario` table  (LIMIT 0,500)
#

INSERT INTO `tipo_usuario` (`tipousuario_id`, `estado_id`, `tipousuario_descripcion`) VALUES 
  (1,1,'ADMINISTRADOR'),
  (2,1,'CAJERO'),
  (3,1,'VENDEDOR'),
  (4,1,'PREVENDEDOR');
COMMIT;

#
# Data for the `usuario` table  (LIMIT 0,500)
#

INSERT INTO `usuario` (`usuario_id`, `estado_id`, `tipousuario_id`, `usuario_nombre`, `usuario_email`, `usuario_login`, `usuario_clave`, `usuario_imagen`) VALUES 
  (1,1,1,'JUAN PEREZ','juan@perez.com','carlos','1a248d7a471ad8d5993aa523c8397ce1d0bafe78','resultados _testing_cruds.xlsx'),
  (2,1,2,'Jonas Perez','Jope@mail.com','jonas','perez','p5.png');
COMMIT;

#
# Data for the `venta` table  (LIMIT 0,500)
#

INSERT INTO `venta` (`venta_id`, `forma_id`, `tipotrans_id`, `usuario_id`, `cliente_id`, `moneda_id`, `estado_id`, `venta_fecha`, `venta_hora`, `venta_subtotal`, `venta_descuento`, `venta_total`, `venta_efectivo`, `venta_cambio`, `venta_glosa`, `venta_comision`, `venta_tipocambio`, `detalleserv_id`) VALUES 
  (1,1,1,5,4,1,1,'0000-00-00','12:20:33',500,50,450,500,50,'NADA',3,6.96,NULL),
  (2,3,1,5,4,1,1,'0000-00-00','13:15:23',475,25,450,500,50,'NADA TAMPOCO',60,6.96,NULL);
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;