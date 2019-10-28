<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
    });
</script>
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
margin-left: 10px;
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
padding : 0 5px 0 5px;
/*border-left : 1px solid #aaa;
border-right : 1px solid #aaa;
border-bottom : 1px solid #aaa;*/
}
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->
<?php $ancho = "7cm"; ?>
<!---------------------- Modal ---------------------------->
        <div id="myModalAnular" class="modal fade no-print" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Anular Factura</h4>
              </div>
              <div class="modal-body">
                  <p>
                  <h3>              
                    ADVERTENCIA: La factura Nº: <?php echo $factura[0]['factura_numero']; ?>, esta a punto de ser ANULADA. ¿Desea continuar?
                  </h3>
                  </p>
              </div>
              <div class="modal-footer">
                  <a href="<?php echo base_url('factura/anular_factura/'.$factura[0]['factura_id'].'/'.$factura[0]['venta_id']); ?>" type="button" class="btn btn-warning" ><i class="fa fa-times-rectangle"></i> Anular</a>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
              </div>
            </div>

          </div>
        </div>
<!-------------------------------------------------------->


<table class="table" style="width: <?php echo $ancho?>" >
    <tr>
<!--        <td style="padding: 0; width: 0cm">-->
        <td style="padding: 0;" colspan="4">
                
            <center>
                               
                    
                    <!--<img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>-->
                    <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->                    
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <?php if (sizeof($empresa[0]['empresa_propietario'])>2){ ?>
                    <font size="1" face="Arial"></b>

                        <?php  echo "<b> DE: ".$empresa[0]['empresa_propietario'] ; ?>

                        </b></font><br>
                    <?php } ?>

                    <font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>
                
                    <br>
                    <?php if($venta[0]['venta_tipodoc']==1){ $titulo1 = "FACTURA"; $subtitulo = "ORIGINAL"; }
                         else {  $titulo1 = "NOTA DE VENTA"; $subtitulo = " "; }?>

                <font size="3" face="arial"><b><?php echo $titulo1; ?></b></font> <br>
                <font size="1" face="arial"><b><?php echo $subtitulo; ?></b></font> <br>
                
                   
                <!--<div class="panel panel-primary col-md-12" style="width: 6cm;">-->
                <table style="width:<?php echo $ancho?>" >
                    <tr  style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;" >
                        <td style="font-family: arial; font-size: 8pt; padding: 0;">

                            <b>NIT:      </b><br>
                            <b>FACTURA No.:  </b><br>
                            <b>AUTORIZACION: </b>

                        </td>
                        <td style="font-family: arial; font-size: 8pt; padding: 0;">
                            <?php echo $factura[0]['factura_nitemisor']; ?> <br>
                            <?php echo $factura[0]['factura_numero']; ?> <br>
                            <?php echo $factura[0]['factura_autorizacion'] ?>           
                        </td>
                    </tr>
                </table>
                <br>    
                <font size="1px" face="arial"><?php echo $factura[0]['factura_actividad']?></font>
            </center>
        </td>
    </tr>            
<!--                <br>_______________________________________________
                <br> -->
    <tr  style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;" >
        <td colspan="4" style="padding: 0;  font-size: 9pt;">
            
                <?php $fecha = new DateTime($venta[0]['venta_fecha']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                    <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a." ".$venta[0]['venta_hora']; ?> <br>
                    <b>NIT/CI: </b><?php echo $factura[0]['factura_nit']; ?> <br>
                    <b>SEÑOR(ES): </b><?php echo $factura[0]['factura_razonsocial'].""; ?>            
        </td>
    </tr>
     
<!--</table>

       <table class="table table-striped table-condensed"  style="width: 7cm;" >-->
           <tr  style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;" >
                <td align="center" style="padding: 0;"><b>CN</b></td>
                <td align="center" style="padding: 0;"><b>DESCRIPCIÓN</b></td>
                <td align="center" style="padding: 0;"><b>P.UNIT</b></td>
                <td align="center" style="padding: 0;"><b>TOTAL</b></td>               
           </tr>
           <?php $cont = 0;
                 $cantidad = 0;
                 $total_descuento = 0;
                 $total_final = 0;

                if ($factura[0]['estado_id']<>3){ 
                 foreach($detalle_venta as $d){;
                        $cont = $cont+1;
                        $cantidad += $d['detallefact_cantidad'];
                        $total_descuento += $d['detallefact_descuento']; 
                        $total_final += $d['detallefact_total']; 
                        ?>
           <tr style="font-size: 8pt;">
                <td align="center" style="padding: 0;"><?php echo $d['detallefact_cantidad']; ?></td>
                <td style="padding: 0;"><font style="size:5px; font-family: arial narrow;" style="padding: 0;"> <?php echo $d['detallefact_descripcion']; ?></td>
                <!--<td align="right" style="padding: 0;"><?php echo number_format($d['detallefact_precio']+$d['detallefact_descuento'],2,'.',','); ?></td>-->
                <td align="right" style="padding: 0;"><?php echo number_format($d['detallefact_precio'],2,'.',','); ?></td>
                <td align="right" style="padding: 0;"><?php echo number_format($d['detallefact_subtotal'],2,'.',','); ?></td>
           </tr>
           <?php }} ?>
<!--       </table>
        _____________________________________
<table class="table" style="max-width: 7cm;">-->
    
        
    <tr style="border-top-style: solid; border-top-width: 2px;">
        
            
        <td align="right" style="padding: 0;" colspan="4">
            
            <font size="1">
                <b><?php echo "SUB TOTAL Bs ".number_format($factura[0]['factura_subtotal'],2,'.',','); ?></b><br>
            </font>
            

            <font size="1">
                <?php echo "TOTAL DESCUENTO Bs ".number_format($factura[0]['factura_descuento'],2,'.',','); ?><br>
            </font>
            <font size="2">
            <b>
                <?php echo "TOTAL FINAL Bs: ".number_format($factura[0]['factura_total'] ,2,'.',','); ?><br>
            </b>
            </font>
            <font size="1" face="arial narrow">
                <?php echo "SON: ".num_to_letras($factura[0]['factura_total'],' Bolivianos'); ?><br>            
            </font>
            
            <font size="1">
                <?php echo "EFECTIVO Bs ".number_format($venta[0]['venta_efectivo'],2,'.',','); ?><br>
                <?php echo "CAMBIO Bs ".number_format($venta[0]['venta_cambio'],2,'.',','); ?>
            </font>
            
        </td>          
    </tr>
    <tr>
        <td nowrap style="padding: 0;" colspan="4">
            <font size="2">
            
                COD. CONTROL: <b><?php echo $factura[0]['factura_codigocontrol']; ?></b><br>
                 <?php $fecha_lim = new DateTime($factura[0]['factura_fechalimite']); 
                        $fecha_limite = $fecha_lim->format('d/m/Y');
                  ?>    
                LIMITE DE EMISIÓN: <b><?php echo $fecha_limite; ?></b><br>
            </font>
        </td>           
    </tr>
    <tr>
        <td style="padding: 0;" colspan="4">
        <center>
            <img src="<?php echo $codigoqr; ?>" width="100" height="100">
        </center>

        </td>
       

    </tr>    
    <tr >
        <td style="padding: 0;  line-height: 12px;" colspan="4">
               USUARIO: <b><?php echo $venta[0]['usuario_nombre']; ?></b> / TRANS: <b><?php echo "00".$factura[0]['venta_id']; ?></b>
            <center>
                    <?php echo $factura[0]['factura_leyenda1'];?> <br>
            <font size="1">
                    <?php echo $factura[0]['factura_leyenda2']; ?> 
            </font>
            <br>
                    <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>  
            </center>
         </td>
    </tr>    
    
</table>
  
<?php if ($tipousuario_id == 1){ ?>
        
            
    <div class="col-md-12 no-print" style="max-width:<?php echo $ancho?>;">

        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModalAnular"><i class="fa fa-ban"></i> Anular Factura</button>
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="window.close();"><i class="fa fa-times"></i> Cerrar</button>

    </div>    
    
        
<?php } ?>

        
          
        
<?php //if($parametro[0]['parametro_imprimircomanda']==1){  ?>

<!--        //aqui va la comanda-->
<?php //} ?>