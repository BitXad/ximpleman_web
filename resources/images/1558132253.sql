INSERT INTO estado (estado_id, estado_descripcion, estado_tipo, estado_color) VALUES 
  (1,'ACTIVO',1,'6ed17a'),
  (2,'INACTIVO',1,'dd6052'),
  (3,'ANULADO',1,'C06402'),
  (4,'ANULADO',3,'C06402'),
  (5,'PENDIENTE',3,'e26363'),
  (6,'TERMINADO',3,'c9b64a'),
  (7,'ENTREGADO',3,'1cdb62'),
  (8,'PENDIENTE',4,'FF9900'),
  (9,'CANCELADO',4,'b2babb'),
  (10,'ABIERTO',5,'A3A3A3'),
  (11,'PENDIENTE',5,'DEBB09'),
  (12,'APROBADO',5,'29AF01'),
  (13,'ENTREGADO',5,'0780C9'),
  (14,'REBOTADO',5,'FF2E00'),
  (15,'CANCELADO',5,'C06402'),
  (16,'CREDITO',3,'1fc4ae');
  COMMIT;
  INSERT INTO categoria_egreso (id_categr, categoria_categr, descrip_categr) VALUES 
  (1,'PAGO A PROVEEDOR','-'),
  (2,'REFRIGERIOS','-');