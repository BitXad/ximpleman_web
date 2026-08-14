<?php $this->load->view('encomienda/comprobantes/_print_header'); ?>
<div class="voucher">
<?php $this->load->view('encomienda/comprobantes/_company'); ?>
<div class="center line"><span class="title">GUÍA DE ENCOMIENDA</span><br><b>Nº <?= html_escape($encomienda['encomienda_guia']); ?></b></div>
<table>
<tr><td class="label">Fecha:</td><td><?= date('d/m/Y',strtotime($encomienda['encomienda_fecha'])); ?> <?= html_escape($encomienda['encomienda_hora']); ?></td></tr>
<tr><td class="label">Origen:</td><td><?= html_escape($encomienda['origen_nombre']); ?></td></tr>
<tr><td class="label">Destino:</td><td><?= html_escape($encomienda['destino_nombre']); ?></td></tr>
<tr><td class="label">Remitente:</td><td><?= html_escape($encomienda['encomienda_remitentenombre']); ?><br>CI: <?= html_escape($encomienda['encomienda_remitenteci']); ?> Tel: <?= html_escape($encomienda['encomienda_remitentetelefono']); ?></td></tr>
<tr><td class="label">Destinatario:</td><td><?= html_escape($encomienda['encomienda_destinatarionombre']); ?><br>CI: <?= html_escape($encomienda['encomienda_destinatarioci']); ?> Tel: <?= html_escape($encomienda['encomienda_destinatariotelefono']); ?></td></tr>
</table>
<div class="line"><b>CONTENIDO:</b> <?= html_escape($encomienda['encomienda_contenido']); ?></div>
<table>
<tr><td>Cantidad</td><td class="right"><?= (int)$encomienda['encomienda_cantidad']; ?></td></tr>
<tr><td>Peso</td><td class="right"><?= number_format($encomienda['encomienda_peso'],2,'.',','); ?> Kg</td></tr>
<tr><td>Valor declarado</td><td class="right">Bs <?= number_format($encomienda['encomienda_valordeclarado'],2,'.',','); ?></td></tr>
<tr><td class="bold">TOTAL</td><td class="right bold">Bs <?= number_format($encomienda['encomienda_total'],2,'.',','); ?></td></tr>
<tr><td>A cuenta</td><td class="right">Bs <?= number_format($encomienda['encomienda_acuenta'],2,'.',','); ?></td></tr>
<tr><td class="bold">Saldo</td><td class="right bold">Bs <?= number_format($encomienda['encomienda_saldo'],2,'.',','); ?></td></tr>
</table>
<div class="status-paid"><?= ($encomienda['encomienda_pagadoen']==='DESTINO' || (float)$encomienda['encomienda_saldo']>0) ? 'POR PAGAR AL RECOGER' : 'PAGADO EN ORIGEN'; ?></div>
<?php if(!empty($encomienda['encomienda_observacion'])): ?><p><b>Observación:</b> <?= nl2br(html_escape($encomienda['encomienda_observacion'])); ?></p><?php endif; ?>
<div class="center"><img class="qr" src="<?= $codigoqr; ?>"><br><span class="muted"><?= html_escape($cadenaqr); ?></span></div>
<p>USUARIO: <?= html_escape($encomienda['usuario_nombre']); ?></p>
<div class="signature"></div><div class="center">Firma del remitente</div>
</div>
<div class="no-print"><button onclick="window.print()">Imprimir</button> <button onclick="window.close()">Cerrar</button></div>
