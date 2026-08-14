<?php $this->load->view('encomienda/comprobantes/_print_header');
$entrega = is_array($entrega) ? $entrega : array();
?>
<div class="paper">
<table class="noborder"><tr><td style="width:30%"><?php $this->load->view('encomienda/comprobantes/_company'); ?></td><td class="center"><span class="title">ACTA / COMPROBANTE DE ENTREGA DE ENCOMIENDA</span><br><b>GUÍA <?= html_escape($encomienda['encomienda_guia']); ?></b></td><td class="center"><img class="qr" src="<?= $codigoqr; ?>"></td></tr></table>
<table>
<tr><td><b>Fecha de entrega:</b> <?= html_escape((isset($entrega['entregaencomienda_fecha'])?$entrega['entregaencomienda_fecha']:'').' '.(isset($entrega['entregaencomienda_hora'])?$entrega['entregaencomienda_hora']:'')); ?></td><td><b>Destino:</b> <?= html_escape($encomienda['destino_nombre']); ?></td></tr>
<tr><td><b>Remitente:</b> <?= html_escape($encomienda['encomienda_remitentenombre']); ?></td><td><b>Destinatario:</b> <?= html_escape($encomienda['encomienda_destinatarionombre']); ?></td></tr>
<tr><td><b>Persona que recibe:</b> <?= html_escape(isset($entrega['entregaencomienda_nombre'])?$entrega['entregaencomienda_nombre']:''); ?></td><td><b>CI:</b> <?= html_escape(isset($entrega['entregaencomienda_ci'])?$entrega['entregaencomienda_ci']:''); ?></td></tr>
<tr><td><b>Relación / parentesco:</b> <?= html_escape(isset($entrega['entregaencomienda_relacion'])?$entrega['entregaencomienda_relacion']:''); ?></td><td><b>Teléfono:</b> <?= html_escape(isset($entrega['entregaencomienda_telefono'])?$entrega['entregaencomienda_telefono']:''); ?></td></tr>
<tr><td colspan="2"><b>Contenido entregado:</b> <?= html_escape($encomienda['encomienda_contenido']); ?><br><b>Cantidad:</b> <?= (int)$encomienda['encomienda_cantidad']; ?> &nbsp; <b>Peso:</b> <?= number_format($encomienda['encomienda_peso'],2); ?> Kg</td></tr>
<tr><td><b>Ubicación:</b> <?= html_escape((isset($entrega['entregaencomienda_latitud'])?$entrega['entregaencomienda_latitud']:'').' '.(isset($entrega['entregaencomienda_longitud'])?$entrega['entregaencomienda_longitud']:'')); ?></td><td class="status-paid"><?= ((float)$encomienda['encomienda_saldo']>0?'SALDO PENDIENTE Bs '.number_format($encomienda['encomienda_saldo'],2):'PAGO COMPLETO'); ?></td></tr>
<?php if(!empty($entrega['entregaencomienda_observacion'])): ?><tr><td colspan="2"><b>Observación:</b> <?= nl2br(html_escape($entrega['entregaencomienda_observacion'])); ?></td></tr><?php endif; ?>
</table>
<p>Declaro haber recibido la encomienda descrita en conformidad, salvo las observaciones consignadas.</p><br>
<table class="noborder"><tr><td class="center"><div class="signature"></div>Firma de quien recibe<br><?= html_escape(isset($entrega['entregaencomienda_nombre'])?$entrega['entregaencomienda_nombre']:''); ?></td><td class="center"><div class="signature"></div>Responsable de entrega<br><?= html_escape(isset($entrega['usuario_nombre'])?$entrega['usuario_nombre']:$encomienda['usuario_nombre']); ?></td></tr></table>
</div>
<div class="no-print"><button onclick="window.print()">Imprimir</button> <button onclick="window.close()">Cerrar</button></div>
