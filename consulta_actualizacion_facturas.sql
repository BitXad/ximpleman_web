INSERT INTO
  detalle_factura(
  producto_id,
  venta_id,
  factura_id,
  detallefact_cantidad,
  detallefact_codigo,
  detallefact_unidad,
  detallefact_descripcion,
  detallefact_precio,
  detallefact_subtotal,
  detallefact_descuento,
  detallefact_total,
  detallefact_preferencia,
  detallefact_caracteristicas,
  usuario_id)
SELECT 
  d.producto_id,
  d.venta_id,
  f.factura_id,
  d.detalleven_cantidad,
  d.detalleven_codigo,
  d.detalleven_unidad,
  p.producto_nombre,
  d.detalleven_precio,
  d.detalleven_subtotal,
  d.detalleven_descuento,
  d.detalleven_total,
  d.detalleven_preferencia,
  d.detalleven_caracteristicas,
  v.usuario_id
FROM
  detalle_venta d,
  factura f,
  producto p,
  venta v
WHERE
  v.venta_id = f.venta_id AND 
  v.venta_id = d.venta_id AND 
  p.producto_id = d.producto_id