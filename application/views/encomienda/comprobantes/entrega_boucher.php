<?php $this->load->view('encomienda/comprobantes/_print_header');
$entrega = is_array($entrega) ? $entrega : array();
?>
<div class="voucher">
<?php $this->load->view('encomienda/comprobantes/_company'); ?>
<div class="center line"><span class="title">COMPROBANTE DE ENTREGA</span><br><b>GUÍA <?= html_escape($encomienda['encomienda_guia']); ?></b></div>
<table>
<tr><td><b>Fecha:</b></td><td><?= html_escape((isset($entrega['entregaencomienda_fecha'])?$entrega['entregaencomienda_fecha']:'').' '.(isset($entrega['entregaencomienda_hora'])?$entrega['entregaencomienda_hora']:'')); ?></td></tr>
<tr><td><b>Destino:</b></td><td><?= html_escape($encomienda['destino_nombre']); ?></td></tr>
<tr><td><b>Destinatario:</b></td><td><?= html_escape($encomienda['encomienda_destinatarionombre']); ?></td></tr>
<tr><td><b>Recibió:</b></td><td><?= html_escape(isset($entrega['entregaencomienda_nombre'])?$entrega['entregaencomienda_nombre']:''); ?></td></tr>
<tr><td><b>CI:</b></td><td><?= html_escape(isset($entrega['entregaencomienda_ci'])?$entrega['entregaencomienda_ci']:''); ?></td></tr>
<tr><td><b>Relación:</b></td><td><?= html_escape(isset($entrega['entregaencomienda_relacion'])?$entrega['entregaencomienda_relacion']:''); ?></td></tr>
<tr><td><b>Teléfono:</b></td><td><?= html_escape(isset($entrega['entregaencomienda_telefono'])?$entrega['entregaencomienda_telefono']:''); ?></td></tr>
<tr><td><b>Contenido:</b></td><td><?= html_escape($encomienda['encomienda_contenido']); ?></td></tr>
</table>
<div class="status-paid"><?= ((float)$encomienda['encomienda_saldo']>0?'SALDO PENDIENTE Bs '.number_format($encomienda['encomienda_saldo'],2):'PAGO COMPLETO'); ?></div>
<?php if(!empty($entrega['entregaencomienda_observacion'])): ?><p><b>Observación:</b> <?= nl2br(html_escape($entrega['entregaencomienda_observacion'])); ?></p><?php endif; ?>
<div class="center"><img class="qr" src="<?= $codigoqr; ?>"></div>
<div class="signature"></div><div class="center">Firma de quien recibe</div>
<p>USUARIO: <?= html_escape(isset($entrega['usuario_nombre'])?$entrega['usuario_nombre']:$encomienda['usuario_nombre']); ?></p>
</div>
<div class="no-print"><button onclick="window.print()">Imprimir</button> <button onclick="window.close()">Cerrar</button></div>
