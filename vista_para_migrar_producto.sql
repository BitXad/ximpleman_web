create view ximpleman_producto as
select 
p.`id_prod` as producto_id,
1 as estado_id,
p.`id_cat` as categoria_id,
1 as presentacion_id,
1 as moneda_id,
p.`codb_unid` as producto_codigo,
p.`codb_unid` as producto_codigobarra,
'producto.png' as producto_foto,
p.`desc_prod` as producto_nombre,
p.`unidad_prod`as producto_unidad,
p.`marca_prod` as producto_marca,
p.`indus_prod` as producto_industria,
p.`costo_unid` as producto_costo,
p.`prec_unid` as `producto_precio`,
p.`saldo` as producto_comision,
1 as producto_tipocambio,
0 as producto_cantidadminima,
0 as producto_factor,
0 as producto_codigofactor,
0 as producto_preciofactor,
p.`costo_unid` as producto_ultimocosto

from producto p



create view ximpleman_categoria_producto as 
select 
c.`id_cat` as categoria_id,
c.`nom_cat` as categoria_nombre
 from categoria c
 order by id_cat
 
 
 
create view ximpleman_detalle_compra as

SELECT 
  1 AS compra_id,
  1 AS moneda_id,
  d.id_prod AS producto_id,
  d.id_prod AS detallecomp_id,
  d.`cod_prod` as detallecomp_codigo,
  d.saldo as detallecomp_cantidad,
  d.`unidad_prod` as detallecomp_unidad,
  d.`costo_unid` as detallecomp_costo,
  d.`prec_unid` as detallecomp_precio,
  (d.`costo_unid` * d.`saldo`) as detallecomp_subtotal,
  0 as detallecomp_descuento,
  (d.`costo_unid` * d.`saldo`) as detallecomp_total,
  0 as detallecomp_descglobal,
  1 as detallecomp_tipocambio,
  1 as cambio_id
FROM
  producto d
  
  
  

create view ximpleman_proveedor as
select 
p.`id_prov` as proveedor_id,
p.`nom_prov` as proveedor_nombre,
p.`dir_prov` as proveedor_direccion,
p.`telf_prov` as proveedor_telefono,
p.`cel_prov` as proveedor_telefono2,
p.`email_prov` as proveedor_email,
p.`contacto_prov` as proveedor_contacto,
p.`razonsoc_prov` as proveedor_razon,
p.`nit_prov` as proveedor_nit,
p.`autoriz_prov` as proveedor_autorizacion

from proveedor p
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  