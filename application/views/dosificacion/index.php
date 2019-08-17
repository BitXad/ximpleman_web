<!----------------------------- script buscador --------------------------------------->
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<div class="box-header">
                <h3 class="box-title">Dosificación</h3>
            	<div class="box-tools">
                    <?php
                    if($newdosif == 0){
                    ?>
                        <a href="<?php echo site_url('dosificacion/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                    <?php } ?>
                    <?php
                    if($newdosif == 1){
                    ?>
                        <a href="<?php echo site_url('dosificacion/edit/'.$dosificacion['dosificacion_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span>Editar</a> 
                    <?php } ?>
                </div>
                
</div>

<style type="text/css">
    .linea:hover {
  background-color: #dddddd;
}
</style>
<div class="row">
    <div class="box">
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">Empresa</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['empresa_nombre']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Fecha Limite</label>
            </div>
            <div class="col-md-3">
                <?php
                if($dosificacion['dosificacion_fechalimite']){
                    echo date("d/m/Y",strtotime($dosificacion['dosificacion_fechalimite']));
                }?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Nit Emisor</label>
            </div>
            <div class="col-md-2">
                <?php echo $dosificacion['dosificacion_nitemisor']; ?>
            </div>
        </div>
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">Autorización</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_autorizacion']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Llave</label>
            </div>
            <div class="col-md-3" style="word-break: break-word;">
                <?php echo $dosificacion['dosificacion_llave']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Num. Factura</label>
            </div>
            <div class="col-md-2">
                <?php echo $dosificacion['dosificacion_numfact']; ?>
            </div>
        </div>
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">Sucursal</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_sucursal']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Sfc</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_sfc']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Actividad</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_actividad']; ?>
            </div>
        </div>
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">Leyenda 1</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_leyenda1']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Leyenda 2</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_leyenda2']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Leyenda 3</label>
            </div>
            <div class="col-md-2">
                <?php echo $dosificacion['dosificacion_leyenda3']; ?>
            </div>
        </div>
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">Leyenda 4</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_leyenda4']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Leyenda 5</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_leyenda5']; ?>
            </div>
           <div class="col-md-1">
                <label class="control-label">Estado</label>
            </div>
            <div class="col-md-2">
                <?php echo $dosificacion['estado_descripcion']; ?>
            </div>
             
        </div>
        <div class="col-md-12 linea">
        <div class="col-md-1">
                <label class="control-label">Actividad Secundaria</label>
            </div>
            <div class="col-md-2">
                <?php echo $dosificacion['dosificasion_actividadsec']; ?>
            </div>
        </div>
    </div>

</div>
                            