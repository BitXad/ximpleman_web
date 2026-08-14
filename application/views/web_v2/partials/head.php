<?php
$sysNombre = !empty($sistema['sistema_nombre']) ? $sistema['sistema_nombre'] : 'Ximpleman';
$sysVersion = !empty($sistema['sistema_version']) ? $sistema['sistema_version'] : 'V2';
$titulo = !empty($pagina['pagina_nombre']) ? $pagina['pagina_nombre'] : $sysNombre;
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="theme-color" content="#f7941d">
<title><?php echo html_escape($titulo . ' · ' . $sysNombre . ' ' . $sysVersion); ?></title>
<meta name="description" content="<?php echo html_escape(!empty($pagina['pagina_informacion']) ? $pagina['pagina_informacion'] : $titulo); ?>">
<link rel="icon" href="<?php echo base_url('resources/images/icono.png'); ?>">
<link rel="stylesheet" href="<?php echo base_url('resources/web_v2/css/website-v2.css'); ?>?v=2.1.0">
