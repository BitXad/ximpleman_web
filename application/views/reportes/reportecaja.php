<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/reporte_ventapagrupado.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
        /*$(document).ready(function () {
            (function ($) {
                $('#vender').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
        */
        function imprimir()
        {
            // window.print(); 
        }
</script>   

<style type="text/css">
/* @page { 
        size: landscape;
    }*/
     
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>">
<input type="hidden" name="resproducto" id="resproducto" />
<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php echo $parametro[0]['moneda_descripcion']; ?>" />
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro[0]['moneda_id']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />
<div class="row" >
    <div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' >
        <div class="col-md-3">
            Desde: <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_desde" name="fecha_desde" >
        </div> 
        <div class="col-md-3">
            Hasta: <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_hasta" name="fecha_hasta" >
        </div>
        <div class="col-md-2">
            Tipo Trans.:
            <select id="tipo_transaccion" name="tipo_transaccion" class="btn btn-primary btn-sm form-control"  >
                <option value="0">-TODOS-</option>
                <?php
                    foreach($all_tipo_transaccion as $tipo){ ?>
                        <option value="<?php echo $tipo['tipotrans_id']; ?>"><?php echo $tipo['tipotrans_nombre']; ?></option>                                                   
                <?php } ?>
            </select>
        </div>
        <div class="col-md-2">
            Usuario:
            <select id="usuario_id" name="usuario_id" class="btn btn-primary btn-sm form-control"  >
                <option value="0">-TODOS-</option>
                <?php
                    foreach($all_usuario as $usuario){ ?>
                        <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>                                                   
                <?php } ?>
             </select>
        </div>
        <div class="col-md-2">
            Venta/Preventa:
            <select id="esventa_preventa" name="esventa_preventa" class="btn btn-primary btn-sm form-control"  >
                <!--<option value="0">-TODOS-</option>-->
                <option value="1"> VENTA </option>
                <option value="2"> PREVENTA </option>
             </select>
        </div>
        <div class="col-md-2 no-print">
            <label for="expotar" class="control-label"> &nbsp; </label>
           <div class="form-group">
                <a class="btn btn-facebook btn-sm form-control" onclick="tabla_reporteagrupado()" title="Buscar productos agrupados"><i class="fa fa-search"> </i> Buscar</a>
            </div>
        </div>
        <div class="col-md-2 no-print">
            <label for="expotar" class="control-label"> &nbsp; </label>
           <div class="form-group">
                <a onclick="imprimir()" class="btn btn-success btn-sm form-control" ><i class="fa fa-print"> </i> Imprimir</a>
            </div>
        </div>
        <div class="col-md-2 no-print">
            <label for="expotar" class="control-label"> &nbsp; </label>
           <div class="form-group">
                <a onclick="generarexcel_vagrupado()" class="btn btn-danger btn-sm form-control" ><span class="fa fa-file-excel-o"> </span> Exportar a Excel</a>
            </div>
        </div>
    </div>

</div>




<div class="row no-print" id='loader'  style='display:none;'>
    <center>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >        
    </center>
</div>


<!------------------------------------------------------------------>
<!------------------------------------------------------------------>
<!------------------------------------------------------------------>
<?php $factura = [0=>0]; ?>
<?php $detalle_factura = [0=>0]; ?>
<!--
<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
    });
</script>-->
<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

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


p {
    font-family: Arial;
    font-size: 8pt;
    line-height: 100%;   /*esta es la propiedad para el interlineado*/
    color: #000;
    padding: 10px;
}

div {
margin-top: 0px;
margin-right: 0px;
margin-bottom: 0px;
margin-left: 0px;
margin: 0px;
}


table{
width : 7cm;
margin : 0 0 0px 0;
padding : 0 0 0 0;
border-spacing : 0 0;
border-collapse : collapse;
font-family: Arial narrow;
font-size: 7pt;
td {
border:hidden;

}
}

td#comentario {
vertical-align : bottom;
border-spacing : 0;
}
div#content {
background : #ddd;
font-size : 8px;
margin : 0 0 0 0;
padding : 0 0px 0 0px;
/*border-left : 1px solid #aaa;
border-right : 1px solid #aaa;
border-bottom : 1px solid #aaa;*/
}
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->
<?php //$tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"]."cm";
      $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
?>

<table class="table" >
<tr>
<td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" >
    
</td>

<td style="padding: 0;">
    
    
<table class="table" style="width: <?php echo $ancho?>" >
    <tr>
<!--        <td style="padding: 0; width: 0cm">-->
        <td style="padding: 0;" colspan="5">
                
            <center>
                               
                    
                    <!--<img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>-->
                    <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="1" face="Arial narrow"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>                    

                    <font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>
                
                    <br>
                    <?php //if($factura[0]['venta_tipodoc']==1){ $titulo1 = "FACTURA"; $subtitulo = "ORIGINAL"; }
                         //else {  $titulo1 = "NOTA DE VENTA"; $subtitulo = " "; }?>
                    <?php $titulo1 = "REPORTE DE CAJA";  
                            

                    ?>
                    
                <font size="3" face="arial"><b><?php echo $titulo1; ?></b></font>
                
                   
                <!--<div class="panel panel-primary col-md-12" style="width: 6cm;">-->
                <!--<table style="width:<?php echo $ancho?>" >-->
                    <tr  style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;" >
                        <td style="font-family: arial; font-size: 8pt; padding: 0;" colspan="5">
                            <center>
                                    <span id="desde"></span> <span id="hasta"></span><br>
                                    <div id="labusqueda"></div>
                                    <span id="tipotrans"></span>
                                    <span id="esteusuario"></span>
                                    <span id="ventaprev"></span>
<!--                                    <b>DESDE:      </b><br>
                                    <b>FACTURA No.:  </b><br>
                                    <b>AUTORIZACION: </b>                        -->
                            </center>                        
                        </td>
<!--                        <td style="font-family: arial; font-size: 8pt; padding: 0;">

                            
                        </td>-->
                    </tr>
                <!--</table>-->
                
            </center>
        </td>
    </tr>

    
<!--    <tr  style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;" >
        <td colspan="4" style="padding: 0;  font-size: 9pt;">
            
                <?php $fecha = new DateTime($factura[0]['factura_fechaventa']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                    <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a." ".$factura[0]['factura_hora']; ?> <br>
                    <b>NIT/CI: </b><?php echo $factura[0]['factura_nit']; ?> <br>
                    <b>SEÑOR(ES): </b><?php echo $factura[0]['factura_razonsocial'].""; ?>            
        </td>
    </tr>-->
     
<!--</table>

       <table class="table table-striped table-condensed"  style="width: 7cm;" >-->
           <tr  style="border-top-style: solid; border-bottom-style: solid; " >
               
                <td align="center" style="padding: 0;"><b>CANT</b></td>
                <td align="center" style="padding: 0;"><b>DESCRIPCIÓN</b></td>
                <td align="center" style="padding: 0;"><b>P.UNIT</b></td>
                <td align="center" style="padding: 0;"><b>TOTAL</b></td>
                
           </tr>
           <tbody class="buscar" id="reportefechadeventa"></tbody>

           

<!--       </table>
        _____________________________________
<table class="table" style="max-width: 7cm;">
    -->
        
    <tr style="border-top-style: solid; border-top-width: 2px;">
        
            
        <td align="right" style="padding: 0;" colspan="4">
            
            
            
        </td>          
    </tr>
    <tr>
        <td nowrap style="padding: 0;" colspan="4">
            <font size="2">

            
            </font>
        </td>           
    </tr>
    <tr>
        <td style="padding: 0;" colspan="4">
        <center>
            
            
        </center>

        </td>
       

    </tr>    
    <tr >
        <td style="padding: 0;  line-height: 12px;" colspan="4">
               USUARIO: <b></b> / TRANS: 

         </td>
    </tr>    
    
</table>

</td>    
</tr>    
</table>

