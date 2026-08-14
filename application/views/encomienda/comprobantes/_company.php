<div class="center">
<?php if(isset($parametro['parametro_logoenfactura']) && $parametro['parametro_logoenfactura']==1 && !empty($empresa0['empresa_imagen'])): ?>
<img class="logo" src="<?= base_url('resources/images/empresas/'.$empresa0['empresa_imagen']); ?>"><br>
<?php endif; ?>
<?php if(!empty($empresa0['empresa_nombre'])): ?><b><?= html_escape($empresa0['empresa_nombre']); ?></b><br><?php endif; ?>
<?php if(!empty($empresa0['empresa_eslogan'])): ?><?= html_escape($empresa0['empresa_eslogan']); ?><br><?php endif; ?>
<?php if(!empty($empresa0['empresa_direccion'])): ?><?= html_escape($empresa0['empresa_direccion']); ?><br><?php endif; ?>
<?php if(!empty($empresa0['empresa_telefono'])): ?>Telf. <?= html_escape($empresa0['empresa_telefono']); ?><br><?php endif; ?>
<?php if(!empty($empresa0['empresa_ubicacion'])): ?><?= html_escape($empresa0['empresa_ubicacion']); ?><?php endif; ?>
</div>
