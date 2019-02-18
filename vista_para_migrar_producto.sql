create view producto_nuevo as
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
p.`indus_prod` as producto_indistria,
p.`costo_unid` as producto_costo,
p.`prec_unid` as `producto_precio`,
p.`saldo` as producto_comision,
1 as producto_tipocambio,
0 as producto_cantidadminima,
0 as producto_factor,
0 as codigo_factor,
0 as precio_factor,
p.`costo_unid` as producto_ultimocosto

from producto p
