<?php $this->load->view('encomienda/comprobantes/_print_header'); $peso=0;$total=0; ?>
<div class="voucher"><?php $this->load->view('encomienda/comprobantes/_company'); ?>
<div class="center line"><span class="title">MANIFIESTO DE CARGA</span><br>VIAJE Nº <?= (int)$viaje['viaje_id']; ?></div>
<table><tr><td><b>Ruta:</b></td><td><?= html_escape($viaje['ruta_nombre']); ?></td></tr><tr><td><b>Salida:</b></td><td><?= html_escape($viaje['viaje_fechasalida'].' '.$viaje['viaje_horasalida']); ?></td></tr><tr><td><b>Vehículo:</b></td><td><?= html_escape($viaje['vehiculo_placa']); ?></td></tr><tr><td><b>Conductor:</b></td><td><?= html_escape(trim($viaje['conductor_nombres'].' '.$viaje['conductor_apellidos'])); ?></td></tr></table>
<div class="line"></div>
<?php foreach($encomiendas as $i=>$e): $peso+=(float)$e['encomienda_peso'];$total+=(float)$e['encomienda_total']; ?>
<table><tr><td colspan="2"><b><?= $i+1; ?>. <?= html_escape($e['encomienda_guia']); ?></b></td></tr><tr><td><?= html_escape($e['encomienda_destinatarionombre']); ?></td><td class="right"><?= number_format($e['encomienda_peso'],2); ?> Kg</td></tr><tr><td><?= html_escape($e['encomienda_contenido']); ?></td><td class="right"><?= ((float)$e['encomienda_saldo']>0?'COBRAR':'PAGADO'); ?></td></tr></table><div class="line"></div>
<?php endforeach; ?>
<table><tr><td><b>Bultos:</b></td><td class="right"><?= count($encomiendas); ?></td></tr><tr><td><b>Peso total:</b></td><td class="right"><?= number_format($peso,2); ?> Kg</td></tr><tr><td><b>Valor total:</b></td><td class="right">Bs <?= number_format($total,2); ?></td></tr></table>
<div class="center"><img class="qr" src="<?= $codigoqr; ?>"></div><br><div class="signature"></div><div class="center">Firma responsable de despacho</div></div>
<div class="no-print"><button onclick="window.print()">Imprimir</button> <button onclick="window.close()">Cerrar</button></div>
