<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/credito.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#proveedor_id').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
        function imprimir()
        {
            $('#ocultar').css('display','block');
            window.print(); 
            $('#ocultar').css('display','none');
        }
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
<!--<link href="<?php //echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->
<!-------------------------------------------------------->
<?php $decimales = $parametro['parametro_decimales']; ?>
<input type="text" id="decimales" value="<?php echo $decimales; ?>" name="decimales"  hidden>

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<input type="hidden" name="cd" id="cd" value="d">
<div class="box-header">
   <div class="col-md-6 no-print">
       <font size='4' face='Arial'><b>Deudas por Pagar</b></font>
       <br><font size='2' face='Arial' id="pillados1">Registros Econtrados: </font>
   </div>  
    <div class="col-md-6 no-print">
        <!--<form action="<?php //echo site_url('credito/repoDeudas'); ?>"  target="_blank" method="POST">
            <input type="hidden" name="usu" id="usu">
            <input type="hidden" name="feini" id="feini">
            <input type="hidden" name="fefin" id="fefin">
            <input type="hidden" name="esti" id="esti" value="8">
            <input type="hidden" name="vendedor" id="vendedor" value="">-->
            <?php if($rol[44-1]['rolusuario_asignado'] == 1){ ?>
            <a class="btn btn-success btn-md" style="float: right;margin-left: 10px" onclick="imprimir()"><span class="fa fa-print"></span> Imprimir</a>
            <?php } ?>
            <label class="btn btn-info btn-md" style="float: right;"> <input  class="btn btn-xs" type="checkbox"  id="agrupar" name="agrupar" value="1"> Agrupar</label>
        <!--</form>-->
    </div>
</div>
<div class="col-md-12 no-print">
    <div class="col-md-3">
        <!--------------------- parametro de buscador --------------------->
        <label for="fecha_desde" class="control-label">Proveedor</label>
       <input id="proveedor_id" type="text" style="width: 100%;" onkeypress="buscardeuda(event)" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"  class="form-control" placeholder="Ingrese el Proveedor">
        <!--------------------- fin parametro de buscador --------------------->
    </div>
     <div class="col-md-2" style="padding-left: -30px;"  >
        <label for="fecha_desde" class="control-label">Desde</label>
        <input type="date" class="form-control btn btn-primary" id="fecha_desde" name="fecha_desde" required="true" value="">
    </div>
    <div class="col-md-2" style="padding-left: -30px;">
        <label for="fecha_desde" class="control-label">Hasta</label>
        <input type="date" class="form-control btn btn-primary" id="fecha_hasta" name="fecha_hasta" required="true" value="">
    </div>
    <div class="col-md-2">
        <label for="estado_id" class="control-label">Estado</label>
        <!--------------------- parametro de buscador --------------------->
            <select  class="form-control btn btn-success "  id="estado_id" >
                <option value="8">PENDIENTE</option>
                <option value="9">CANCELADO</option>
                <option value="27">ANULADO</option>
                <option value="">TODOS</option>
            </select>
        <!--------------------- fin parametro de buscador --------------------->
    </div>
    <div class="col-md-2" >
        <label for="usuario_id" class="control-label">Usuario</label>           
        <select  name="usuario_id" id="usuario_id"  class="form-control btn btn-warning"  >
            <option value="">-TODOS-</option>
            <?php 
            foreach($all_usuario as $usuario)
            {
                $selected = ($usuario['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";

                echo '<option  value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
            } 
            ?>
        </select>
    </div>
    <div class="col-md-1" style="padding-bottom: 20px;padding-top: 5px;">
        <br>
        <button class="btn btn-facebook no-print" onclick="buscar_fecha_deuda()">
            <span class="fa fa-search"></span>   Busqueda  
        </button>
    </div>
    <!-- *********** INICIO de BUSCADOR select y productos encontrados ****** -->
    <div class="row col-md-12" id='loader'  style='display:none; text-align: center'>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
    </div>
    <!-- *********** FIN de BUSCADOR select y productos encontrados ****** -->
</div>
<div class=" col-md-12 cuerpo" id="ocultar" style="display: none">
    <div class="columna_derecha">
        <center> 
            <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60">
        </center>
    </div>
    <div class="columna_izquierda">
        <center>  <font size="4"><b><u><?php echo $empresa[0]['empresa_nombre']; ?></u></b></font><br>
        <?php echo $empresa[0]['empresa_zona']; ?><br>
        <?php echo $empresa[0]['empresa_direccion']; ?><br>
        <?php echo $empresa[0]['empresa_telefono']; ?>
        </center>
    </div>
    <div class="columna_central">
        <center><h3 class="box-title"><u>DEUDAS POR PAGAR</u></h3>
            <b>COMPRAS AL CREDITO</b> <br>
            <?php echo date('d/m/Y H:i:s'); ?>
        </center>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead id="titulos">

                    </thead>
                    <tbody class="buscar" id="tabladeudas"></tbody>
                </table>
            </div>
            <div class="pull-right">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>
