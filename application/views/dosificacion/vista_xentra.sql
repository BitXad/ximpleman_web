-- bolivia_asapavs.ingreso_egreso source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `bolivia_asapavs`.`ingreso_egreso` AS
select
    `bolivia_asapavs`.`ingreso`.`id_ing` AS `id_ing`,
    `bolivia_asapavs`.`ingreso`.`id_usu` AS `id_usu`,
    `bolivia_asapavs`.`ingreso`.`detalle_ing` AS `detalle_ing`,
    `bolivia_asapavs`.`ingreso`.`nombre_ing` AS `nombre_ing`,
    `bolivia_asapavs`.`ingreso`.`fechahora_ing` AS `fechahora_ing`,
    `bolivia_asapavs`.`ingreso`.`monto_ing` AS `monto_ing`,
    `bolivia_asapavs`.`ingreso`.`descripcion_ing` AS `descripcion_ing`,
    `bolivia_asapavs`.`ingreso`.`estado_ing` AS `estado_ing`,
    `bolivia_asapavs`.`ingreso`.`tipo_ing` AS `tipo_ing`,
    `bolivia_asapavs`.`ingreso`.`numrec_ing` AS `numrec_ing`,
    `bolivia_asapavs`.`ingreso`.`numrec_egr` AS `numrec_egr`
from
    `bolivia_asapavs`.`ingreso`;