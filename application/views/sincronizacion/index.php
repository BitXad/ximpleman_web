<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
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
    <font size='4' face='Arial'><b>Sincronizaci&oacute;n c&oacute;digos y cat&aacute;logos</b></font>
    <div class="box-tools no-print">
        <button class="btn btn-success float-right" onclick="sincronizar(0)"><i class="fa-solid fa-arrows-rotate"></i> Sincronizar Todo</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>SINCRONIZACION DE CODIGOS</th>
                            <th>SINCRONIZACION</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php 
                        $i=1;
                        foreach ($sincronizaciones as $sincronizacion) {?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $sincronizacion['sincronizacion_descripcion'] ?></td>
                                <td><div id="sincronizado_<?= $sincronizacion['sincronizacion_id'] ?>"></div></td>
                                <td>
                                    <button class="btn btn-primary btn-xs" title="Sincronizar <?= strtolower($sincronizacion['sincronizacion_descripcion']) ?>" onclick="sincronizar(<?= $sincronizacion['sincronizacion_id'] ?>)">
                                        <i class="fa-solid fa-arrows-rotate"></i>
                                    </button>
                                    <a class="btn btn-info btn-xs" title="Ver datos" href="<?= site_url("sincronizacion/show_sincronizacion/{$sincronizacion['sincronizacion_id']}") ?>">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                            $i++; 
                        }
                    ?>
                    </tbody>
                </table>                                
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script>
    function sincronizar(codigo_sincronizar){
        let base_url = $("#base_url").val();
        let controlador = `${base_url}sincronizacion/sincronizar_datos`;
        $.ajax({
            url: controlador,
            type:"POST",
            data:{
                codigo_sincronizar: codigo_sincronizar
            },
            async: false,
            success: (respuesta)=>{
                res = JSON.parse(respuesta);
                if(res == 'OK'){
                    alert("Se completo la sincronización")
                }else{
                    alert("No se logro completar la sincronización");
                }
            },
            error: ()=>{
                alert("Ocurrio un error al realizar la sincronización, por favor intente en unos minutos")
            }
        });
    }
</script>