<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.

--------------- SQL ---------------

ALTER TABLE `dosificacion` ADD COLUMN `dosificacion_numerotransmes` INTEGER DEFAULT NULL;

ALTER TABLE `venta` ADD COLUMN `venta_numerotransmes` INTEGER DEFAULT NULL;

ALTER TABLE `parametros` ADD COLUMN `parametro_contarventasmes` INTEGER DEFAULT NULL;

ALTER TABLE `dosificacion` ADD COLUMN `dosificacion_mesactual` INTEGER DEFAULT NULL;

ALTER TABLE `parametros` ADD COLUMN `parametro_numeroventa` INTEGER DEFAULT NULL;

ALTER TABLE `parametros` ADD COLUMN `parametro_contarventas` INTEGER DEFAULT NULL;

ALTER TABLE `parametros` ADD COLUMN `parametros_mostrarnumero` INTEGER DEFAULT NULL;




 */

