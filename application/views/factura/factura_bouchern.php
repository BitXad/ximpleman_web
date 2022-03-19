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
                  <a href="<?php echo base_url('factura/anular_factura/'.$factura[0]['factura_id']."/".$factura[0]['factura_numero']); ?>" type="button" class="btn btn-warning" ><i class="fa fa-times-rectangle"></i> Anular</a>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
              </div>
            </div>

          </div>
        </div>
<!-------------------------------------------------------->


<table class="table" >
    <tr>
        <td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" ></td>
        <td style="padding: 0;">
            <table class="table" style="width: <?php echo $ancho?>" >
                <tr>
                    <!--<td style="padding: 0; width: 0cm">-->
                    <td style="padding: 0;" colspan="4">
                        <center>
                            <?php $titulo1 = "FACTURA";  
                            if ($tipo==1) $subtitulo = "CON DERECHO A CREDITO FISCAL"; //$subtitulo = "ORIGINAL";
                            else $subtitulo = "CON DERECHO A CREDITO FISCAL"; //$subtitulo = "COPIA";
                            ?>
                            <font size="3" face="arial"><b><?php echo $titulo1; ?></b></font> <br>
                            <font size="2" face="arial"><b><?php echo $subtitulo; ?></b></font> <br>
                    <!--<img src="<?php //echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>-->
                    <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="1" face="Arial narrow"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>                    
                    <!--<font size="1" face="Arial"><b><?php //echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <?php if (isset($empresa[0]['empresa_propietario']) && ($empresa[0]['empresa_propietario']!="")){ ?>
                    <font size="1" face="Arial"><b>
                        <?php  echo "<b> DE: ".$empresa[0]['empresa_propietario'] ; ?>
                        </b></font><br>
                    <?php } ?>
                    <font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>
                    <br>
                    <?php //if($factura[0]['venta_tipodoc']==1){ $titulo1 = "FACTURA"; $subtitulo = "ORIGINAL"; }
                         //else {  $titulo1 = "NOTA DE VENTA"; $subtitulo = " "; }?>
                    
                <!--<div class="panel panel-primary col-md-12" style="width: 6cm;">-->
                <table style="width:<?php echo $ancho?>" >
                    <tr  style="border-top-style: solid; border-top-width: 2px;" >
                        <td class="text-center text-bold" style="font-family: arial; font-size: 8pt; padding: 0;"><b>NIT:</b></td>
                    </tr>
                    <tr>
                        <td class="text-center" style="font-family: arial; font-size: 8pt; padding: 0;"><?php echo $factura[0]['factura_nitemisor']; ?></td>
                    </tr>
                    <tr>
                        <td class="text-center" style="font-family: arial; font-size: 8pt; padding: 0;"><b>FACTURA N&deg;</b></td>
                    </tr>
                    <tr>
                        <td class="text-center" style="font-family: arial; font-size: 8pt; padding: 0;"><?php echo $factura[0]['factura_numero']; ?></td>
                    </tr>
                    <tr>
                        <td class="text-center" style="font-family: arial; font-size: 8pt; padding: 0;"><b>C&Oacute;D. AUTORIZACI&Oacute;N</b></td>
                    </tr>
                    <tr>
                        <td class="text-center" style="font-family: arial; font-size: 8pt; padding: 0;"><?php echo $factura[0]['factura_autorizacion'] ?></td>
                    </tr>
                </table>
                <!--<br>    
                <font size="1px" face="arial"><?php //echo $factura[0]['factura_actividad']?></font>-->
            </center>
        </td>
    </tr>            
<!--                <br>_______________________________________________
                <br> -->
    <tr  style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;" >
        <td colspan="4" style="padding: 0;  font-size: 9pt;">
            <table style="width:<?php echo $ancho?>" >
                <tr>
                    <td class="text-right text-bold" style="font-family: arial; font-size: 8pt; padding: 0;">NOMBRE/RAZ&Aacute;N SOCIAL:</td>
                    <td style="font-family: arial; font-size: 8pt; padding: 0; padding-left: 3px"><?php echo $factura[0]['factura_razonsocial'].""; ?></td>
                </tr>
                <tr>
                    <td class="text-right text-bold" style="font-family: arial; font-size: 8pt; padding: 0;">NIT/CI/CEX:</td>
                    <td style="font-family: arial; font-size: 8pt; padding: 0; padding-left: 3px"><?php echo $factura[0]['factura_nit']; ?></td>
                </tr>
                <tr>
                    <td class="text-right text-bold" style="font-family: arial; font-size: 8pt; padding: 0;">COD. CLIENTE:</td><!-- PONER CODIGO DE CLIENTE -->
                    <td style="font-family: arial; font-size: 8pt; padding: 0; padding-left: 3px"><?php echo "GFRJHDEs"; //$factura[0]['cliente_codigo']; ?> <br></td>
                </tr>
                <tr>
                    <td class="text-right text-bold" style="font-family: arial; font-size: 8pt; padding: 0;">FECHA DE EMISI&Oacute;N:</td>
                    <td style="font-family: arial; font-size: 8pt; padding: 0; padding-left: 3px">
                        <?php $fecha = new DateTime($factura[0]['factura_fechaventa']); 
                            $fecha_d_m_a = $fecha->format('d/m/Y');
                            echo $fecha_d_m_a." ".$factura[0]['factura_hora'];
                        ?>
                    </td>
                </tr>
            </table>           
        </td>
    </tr>
    <tr>
        <td colspan="4" align="center" style="font-family: arial; font-size: 8pt; padding: 0;"><b>DETALLE</b></td>
    </tr>
    <tr style="font-size: 8pt;">
        <td colspan="4">
        <table style="width:<?php echo $ancho?>" >
        <?php
        $cont = 0;
        $cantidad = 0;
        $total_descuento = 0;
        $total_final = 0;
        if($factura[0]['estado_id']<>3){
            foreach($detalle_factura as $d){;
                $cont = $cont+1;
                $cantidad += $d['detallefact_cantidad'];
                $total_descuento += $d['detallefact_descuento']; 
                $total_final += $d['detallefact_total']; 
        ?>
                <tr>
                    <td align="center" style="padding: 0;">
                        <?php echo $d['detallefact_descripcion']; ?>
                        <?php if ($d['detallefact_unidadfactor'] != "-" && $d['detallefact_unidadfactor'] != "") echo " [".$d['detallefact_unidadfactor']."]";?>

                        <?php if(isset($d['detallefact_preferencia']) && $d['detallefact_preferencia']!='null' && $d['detallefact_preferencia']!='-' ) {
                            echo  $d['detallefact_preferencia']; }
                        ?>
                        <?php if(isset($d['detallefact_caracteristicas']) && $d['detallefact_caracteristicas']!='null' && $d['detallefact_caracteristicas']!='-' ) {
                            echo  "<br>".nl2br($d['detallefact_caracteristicas']); }
                            //echo  "<br><textarea rows='5' cols='100%' readonly='true'>".$d['detallefact_caracteristicas']."</textarea>"; }

                        ?>
                        
                        <?php //echo $d['detallefact_cantidad']; ?>
                    </td>
                </tr>
                <tr>
                    <td align="right" style="padding: 0;"><?php echo number_format($d['detallefact_precio'],2,'.',','); ?></td>
                    <td align="right" style="padding: 0;"><?php echo number_format($d['detallefact_subtotal'],2,'.',','); ?></td>
                </tr>
                
                <!--<td align="right" style="padding: 0;"><?php //echo number_format($d['detallefact_precio']+$d['detallefact_descuento'],2,'.',','); ?></td>-->
                
        <?php
            }
        }
        ?>
        </table>
        </td>
    </tr>
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
                <?php echo "EFECTIVO Bs ".number_format($factura[0]['factura_efectivo'],2,'.',','); ?><br>
                <?php echo "CAMBIO Bs ".number_format($factura[0]['factura_cambio'],2,'.',','); ?>
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
               USUARIO: <b><?php echo $factura[0]['usuario_nombre']; ?></b> / TRANS: 
               <b><?php 
                    if ($factura[0]['venta_id']>0) echo $factura[0]['factura_id'].".".$factura[0]['venta_id']."V"; 
                    if ($factura[0]['credito_id']>0) echo $factura[0]['factura_id'].".".$factura[0]['credito_id']."Cr"; 
                    if ($factura[0]['ingreso_id']>0) echo $factura[0]['factura_id'].".".$factura[0]['ingreso_id']."I"; 
                    if ($factura[0]['servicio_id']>0) echo $factura[0]['factura_id'].".".$factura[0]['servicio_id']."S"; 
                    if ($factura[0]['cuota_id']>0) echo $factura[0]['factura_id'].".".$factura[0]['cuota_id']."C"; 
               ?></b>
               <?php
                if ($factura[0]['venta_id']>0){
                    if($parametro[0]['parametro_puntos'] >0){
                        echo " / PUNTOS: <b>".$venta[0]['cliente_puntos']."</b>";
                    }
                }
                ?>
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