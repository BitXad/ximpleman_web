<script src="<?php echo base_url('resources/js/token.js'); ?>" type="text/javascript"></script>
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

<style type="text/css">
    #contieneimg{
        width: 50px;
        height: 50px;
        text-align: center;
    }
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masgrande{
        font-size: 12px;
    }
</style>

<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php //echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">-->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<div class="box-header" style="padding-left: 0px">
    <font size='4' face='Arial'><b>Tokens</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <span id="encontrados">0</span></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('token/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Token</a> 
    </div>
</div>
<div class="row no-print">
    <div class="col-md-5">
        <div class="input-group">
            <span class="input-group-addon"> Buscar </span>           
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el token, fecha, estado..." onkeypress="buscar_token(event)" autocomplete="off">
            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaresultadostoken(2)" title="Buscar"><span class="fa fa-search"></span></div>
            <div style="border-color: #d58512; background: #e08e0b !important; color: white" class="btn btn-warning input-group-addon" onclick="tablaresultadostoken(3)" title="Mostrar todos los tokens"><span class="fa fa-globe"></span></div>
        </div>
    </div>
    <!--<div class="col-md-3">
        <div class="box-tools">
            <select name="estado_id" class="btn-primary btn-sm btn-block" id="estado_id" onchange="tablaresultadosproducto(2)">
                <option value="" disabled selected >-- BUSCAR POR ESTADOS --</option>
                <option value="0">Todos Los Estados</option>
                <?php 
                foreach($all_estado as $estado)
                {
                    echo '<option value="'.$estado['estado_id'].'">'.$estado['estado_descripcion'].'</option>';
                } 
                ?>
            </select>
        </div>
    </div>-->
    
    <!---------------- FIN BOTONES --------->
    <!-- **** INICIO de BUSCADOR select y productos encontrados *** -->
     <div class="row col-md-12" id='loader'  style='display:none; text-align: center'>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
    </div>
    <!-- **** FIN de BUSCADOR select y productos encontrados *** -->
</div>
    

<div class="row">
    <div class="col-md-12">
        
        <div class="box">
                 
            <div class="box-body  table-responsive">
               <table class="table table-condensed" id="mitabla" role="table">
                    <thead>
                        <tr role="row">
                            <th >#</th>
                            <th>Token Delegado</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                            <th>Estado</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tablaresultados"></tbody>
                </table>
            </div>             
        </div>
    </div>
</div>







<!------------------------ INICIO modal para confirmar ejecutar orden compra ------------------->
<div class="modal fade" id="modal_ejecutarordencompra" tabindex="-1" role="dialog" aria-labelledby="modal_ejecutarordencompralabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">EJECUTAR ORDEN DE COMPRA</span><br>
                <span class="text-bold">No. <span id="laordencompra_id"></span></span>
            </div>
            <div class="modal-body">
                <span>
                    Esta seguro de ejecutar esta orden de compra?
                </span>
            </div>
            <div class="modal-footer" style="text-align: center">
                <a class="btn btn-success" onclick="ejecutarordencompra()"><span class="fa fa-check"></span> Ejecutar</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para confirmar ejecutar orden compra ------------------->
<!------------------------ INICIO modal para confirmar anunlar orden compra ------------------->
<div class="modal fade" id="modal_anularordencompra" tabindex="-1" role="dialog" aria-labelledby="modal_anularordencompralabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">ANULAR ORDEN DE COMPRA</span><br>
                <span class="text-bold">No. <span id="anularordencompra_id"></span></span>
            </div>
            <div class="modal-body">
                <span>
                    Esta seguro de anular esta orden de compra?
                </span>
            </div>
            <div class="modal-footer" style="text-align: center">
                <a class="btn btn-success" onclick="anularordencompra()"><span class="fa fa-minus-circle"></span> Anular</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para confirmar anular orden compra ------------------->
