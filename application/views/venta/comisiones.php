<script src="<?php echo base_url('resources/js/comisiones.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    function final(){
        document.getElementById('loader').style.display = 'block';
    }
    function imprimir()
    {
        window.print(); 
    }
    
    $(document).ready(function () {
        $("#busca").click(function () {
            var fecha1 = document.getElementById('fecha_desde').value;
            var fechauno = moment(fecha1).format('DD/MM/YYYY');
            var fecha2 = document.getElementById('fecha_hasta').value;
            var fechados = moment(fecha2).format('DD/MM/YYYY');
            $("#fecha_inicio").html(fechauno);
            $("#fecha_fin").html(fechados);
        });
    });

</script>

<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet" type="text/css">
 
<div class="box-header"  align="center">
    <h4><b><u>COMISIONES</u></b></h4>
</div>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<!--<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php //echo $parametro[0]['moneda_descripcion']; ?>" />-->
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro[0]['moneda_id']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />
<!--<div class="row">-->
<div class="col-md-12">
    <div class="panel panel-default col-md-12" >
        <div class="col-md-12 no-print" >
            <br class="no-print">
            <div class="row" >
                Desde: <input type="date" class="btn btn-primary btn-sm " id="fecha_desde" name="fecha_desde" required="true" value="<?php echo date('Y-m-d')?>">
                Hasta: <input type="date" class="btn btn-primary btn-sm" id="fecha_hasta" name="fecha_hasta" required="true"  value="<?php echo date('Y-m-d')?>">
            </div><br>
       </div>
       <div class="col-md-6" style="font-size: 12px; padding-left: 30px;">
            <div class="row">
                VENDEDOR: 
                <select name="usuario_id" id="usuario_id"  style="font-size: 12px; border: none;" class="btn btn-primary btn-sm no-print"  >
                    <?php 
                    foreach($all_usuario as $usuario)
                    {
                        $selected = ($usuario['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";
                        echo '<option  value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary btn-sm no-print" onclick="buscar_fecha_ven(),final()" >
                <span class="fa fa-search"></span>   Realizar  Busqueda
            </button>
            <br class="no-print">   
        </div>
         <div class="col-md-3">
            <a onclick="imprimir()" class="btn btn-success btn-sm no-print"><i class="fa fa-print"> Imprimir</i></a>
        </div>
        <div class="col-md-4">
            DESDE: <label class="ol" id="fecha_inicio"><?php echo date('d/m/Y'); ?></label>    
            HASTA: <label class="ol" id="fecha_fin"><?php echo date('d/m/Y'); ?></label>
        </div>
    </div>
</div>
<div class="container no-print" id="categoria">
    <!--------------------- indicador de resultados --------------------->
    <span class="badge btn-primary">Productos encontrados: <span class="badge btn-facebook"><input  id="pillados" type="text" value="0" readonly="true"> </span></span>
</div>
<div class="row" id='loader'  style='display:none;'>
    <center>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >        
    </center>
</div>
<div class="box">
    <div class="box-body table-responsive" >
        <table class="table table-striped table-condensed" id="mitabla">
            <tr>
                <th>#</th>
                <th>PRODUCTO</th>
                <th>UNIDAD</th>
                <th>PRECIO (<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                <th>CANTIDAD</th>
                <th>TOTAL (<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                <th>%<br>PORC.</th>
                <th>TOTAL<br>COMISION (<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                <th>TOTAL<br>COMISION (<?php
                                        if($parametro[0]["moneda_id"] == 1){
                                            echo $lamoneda[1]['moneda_descripcion'];
                                        }else{
                                            echo $lamoneda[0]['moneda_descripcion'];
                                        }
                                    ?>)
                </th>

            </tr>
            <tbody class="buscar" id="ventacombi">
        </table>
    </div>
</div>
<br><br>
<center>
    <div class="col-md-12" style="margin-top: 50px; ">
        <table>
            <tr>
                <td> <center>
                
                    <?php echo "-----------------------------------------------------"; ?><br>
                    <?php echo "RECIBI CONFORME"; ?><br>
                    </center>
                </td>
                <td width="100">
                    <?php echo "     "; ?><br>
                    <?php echo "     "; ?><br>
                </td>
                <td>
                    <center>
                    <?php echo "-----------------------------------------------------"; ?><br>
                    <?php echo "ENTREGUE CONFORME"; ?><br>                    
                    </center>
                </td>
            </tr>
        </table>
    </div>
</center>
       