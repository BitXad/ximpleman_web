<!--<link href="<?php echo base_url('resources/css/factura_boucher.css'); ?>" rel="stylesheet">
<!DOCTYPE html> 
 
  <div class="ticket">
    <img src="https://yt3.ggpht.com/-3BKTe8YFlbA/AAAAAAAAAAI/AAAAAAAAAAA/ad0jqQ4IkGE/s900-c-k-no-mo-rj-c0xffffff/photo.jpg" alt="Logotipo">
    <p class="centrado">APPS PERFECTAS
      <br>5 de mayo #1006
      <br>23/08/2017 08:22 a.m.</p>
    <table>
      <thead>
        <tr>
          <th class="cantidad">CANT</th>
          <th class="producto">PRODUCTO</th>
          <th class="precio">$$</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="cantidad">1.00</td>
          <td class="producto">CHEETOS VERDES 80 G</td>
          <td class="precio">$8.50</td>
        </tr>
        <tr>
          <td class="cantidad">2.00</td>
          <td class="producto">KINDER DELICE</td>
          <td class="precio">$10.00</td>
        </tr>
        <tr>
          <td class="cantidad">1.00</td>
          <td class="producto">COCA COLA 600 ML</td>
          <td class="precio">$10.00</td>
        </tr>
        <tr>
          <td class="cantidad"></td>
          <td class="producto">TOTAL</td>
          <td class="precio">$28.50</td>
        </tr>
      </tbody>
    </table>
    <p class="centrado">¡GRACIAS POR SU COMPRA!
      <br>appsperfectas.com</p>
  </div>-->


<!--<script type="text/javascript">
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
    font-size: 7pt;
    line-height: 120%;   /*esta es la propiedad para el interlineado*/
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
font-size : 7px;
margin : 0 0 0 0;
padding : 0 5px 0 5px;
border-left : 1px solid #aaa;
border-right : 1px solid #aaa;
border-bottom : 1px solid #aaa;
}
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->

<!---------------------- Modal ---------------------------->
<?php $tipo_factura = 4; //15 tamaño carta ?>

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
<?php $margen_izquierdo = "3cm"; ?>

<div class="container">
<div class="col-xs-12">
<!--    <div class="col-xs-1" style="padding: 0;">
        <table style="width: 0cm;">
            <tr>
                <td  style="width: 0cm;">

                </td>
            </tr>
        </table>
        
    </div>-->
    
    <div class="col-xs-10">


            <table class="table" style="width: 18cm; padding: 0;" >
                <tr>
                    
                    <td style="width: 6cm;  padding: 0;" colspan="3">

                        <center>

                                <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                                <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                                <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                                <?php if (sizeof($empresa[0]['empresa_propietario'])>2){ ?>
                                <font size="1" face="Arial"></b>
                                
                                    <?php  echo "<b> DE: ".$empresa[0]['empresa_propietario'] ; ?>
                                    
                                    </b></font><br>
                                <?php } ?>
                                
                                <font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>
                                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>                

                        </center>                      
                    </td>
                    <td style="width: 6cm;  padding: 0;">
                        <center>            
                            <br>
                            <br>
                            <br>
                            <?php $titulo1 = "FACTURA"; $subtitulo=" ORIGINAL " ?>
                            <font size="3" face="arial"><b><?php echo $titulo1; ?></b></font> <br>
                            <font size="1" face="arial"><b><?php echo $subtitulo; ?></b></font> <br>                    
                        </center>
                    </td>
                    
                    <td style="width: 6cm;  padding: 0;">
                            <table style="width: 6cm;">
                                <tr>
                                    <td style="font-family: arial; font-size: 7pt;">

                                        <b>NIT:      </b><br>
                                        <b>FACTURA No.:  </b><br>
                                        <b>AUTORIZACION: </b>

                                    </td>
                                    <td style="font-family: arial; font-size: 7pt;">
                                        <?php echo $factura[0]['factura_nitemisor']; ?> <br>
                                        <?php echo $factura[0]['factura_numero']; ?> <br>
                                        <?php echo $factura[0]['factura_autorizacion'] ?>           
                                    </td>
                                </tr>
                            </table>            

                            <center>
                            _________________________________________________
                                <font size="1px" face="arial"><?php echo $factura[0]['factura_actividad']?></font>
                            _________________________________________________
                            </center>

                    </td>
                </tr>
                <tr style="padding: 0;">
                    <td></td>
                    <td colspan="5" style="font-family: arial; font-size: 8pt; padding: 0;">
                       
                            <?php $fecha = new DateTime($factura[0]['factura_fechaventa']); 
                                    $fecha_d_m_a = $fecha->format('d/m/Y');
                              ?>    
                                <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a." ".$factura[0]['factura_hora'];; ?> <br>
                                <b>NIT/CI: </b><?php echo $factura[0]['factura_nit']; ?> <br>
                                <b>SEÑOR(ES): </b><?php echo $factura[0]['factura_razonsocial'].""; ?>
                    </td>
                </tr>

            </table>

            <table class="table table-condensed"  style="width: 18cm; height: <?php echo $tipo_factura."cm"; ?>; margin: 0; padding: 0;" >
                <tr style=" border-style: solid;   border-width: medium; border-color: black; border-width: 2px; padding:0;">
                <td>
                
            <table class="table table-condensed"  style="width: 18cm; margin: 0;" >


                        <tr style=" border-style: solid; border-width: medium; border-color: black; border-width: 2px; background-color: lightgray">
   
                            <td align="center"><b>CANT</b></td>
                            <td align="center" colspan="2"><b>DESCRIPCIÓN</b></td>
                            <td align="center" ><b>P.UNIT</b></td>
                            <td align="center" ><b></b></td>
                            <td align="center" ><b>TOTAL</b></td>               
                            <td align="center" ><b></b></td>
                        
                       </tr>
                       <?php $cont = 0;
                             $cantidad = 0;
                             $total_descuento = 0;
                             $total_final = 0;

                            if ($factura[0]['estado_id']<>3){ 
                             foreach($detalle_factura as $d){;
                                    $cont = $cont+1;
                                    $cantidad += $d['detallefact_cantidad'];
                                    $total_descuento += $d['detallefact_descuento']; 
                                    $total_final += $d['detallefact_total']; 
                        ?>
                       <tr style="border-top-style: solid;  border-color: black;  border-top-width: 1px;">
                           <td align="center" style="padding: 0;"><font style="size:7px; font-family: arial"> <?php echo $d['detallefact_cantidad']; ?></font></td>
                            <td colspan="2" style="padding: 0;"><font style="size:7px; font-family: arial"> <?php echo $d['detallefact_descripcion']; ?></font></td>
                            <td align="right" style="padding: 0;"><font style="size:7px; font-family: arial"> <?php echo number_format($d['detallefact_precio']+$d['detallefact_descuento'],2,'.',','); ?></font></td>
                            <td></td>
                            <td align="right" style="padding: 0;"><font style="size:7px; font-family: arial"> <?php echo number_format($d['detallefact_subtotal'],2,'.',','); ?></font></td>
                            <td></td>
                       </tr>
                       <?php }} ?>
                </table>
               
                </td>
                </tr>
        </table>
                
                    

                <table class="table" style="width: 18cm; margin: 0;">
                <tr >
                    <td nowrap align="left"  style="width: 3cm;">
                         <img src="<?php echo $codigoqr; ?>" width="100" height="100">
                    </td>

                    <td  align="left" style="width: 11cm;">
                        <font face="Arial">

                            COD. CONTROL: <b><?php echo $factura[0]['factura_codigocontrol']; ?></b><br>
                             <?php $fecha_lim = new DateTime($factura[0]['factura_fechalimite']); 
                                    $fecha_limite = $fecha_lim->format('d/m/Y');
                              ?>    
                            LIMITE DE EMISIÓN: <b><?php echo $fecha_limite; ?></b><br>

                            USUARIO: <b><?php echo $factura[0]['usuario_nombre']; ?></b> / TRANS: 
                            <b><?php 
                                 if ($factura[0]['venta_id']>0) echo $factura[0]['factura_id'].".".$factura[0]['venta_id']."V"; 
                                 if ($factura[0]['credito_id']>0) echo $factura[0]['factura_id'].".".$factura[0]['credito_id']."C"; 
                                 if ($factura[0]['ingreso_id']>0) echo $factura[0]['factura_id'].".".$factura[0]['ingreso_id']."C"; 
                                 if ($factura[0]['servicio_id']>0) echo $factura[0]['factura_id'].".".$factura[0]['servicio_id']."C"; 
                                 if ($factura[0]['cuota_id']>0) echo $factura[0]['factura_id'].".".$factura[0]['cuota_id']."C"; 
                            ?></b>

                        
                        <center>
                                <?php echo $factura[0]['factura_leyenda1'];?> <br>
                        <font size="2">
                                <?php echo $factura[0]['factura_leyenda2']; ?> 
                        </font>
                        <br>
                                <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>  
                        </center>   
                    </td>  
                                        
                    <td align="right" style="width: 4cm;">
                        <font size="1" face="Arial">
                            <b><?php echo "SUB TOTAL Bs ".number_format($factura[0]['factura_subtotal'],2,'.',','); ?></b><br>
                        </font>


                        <font size="1" face="Arial">
                            <?php echo "TOTAL DESCUENTO Bs ".number_format($factura[0]['factura_descuento'],2,'.',','); ?><br>
                        </font>
                        <font size="2" face="Arial">
                        <b>
                            <?php echo "TOTAL FINAL Bs: ".number_format($factura[0]['factura_total'] ,2,'.',','); ?><br>
                        </b>
                        </font>
                        <font size="1" face="arial narrow">
                            <?php echo "SON: ".num_to_letras($total_final,' Bolivianos'); ?><br>            
                        </font>
                        
                        <font size="1" face="Arial">
                            <?php echo "EFECTIVO Bs ".number_format($factura[0]['factura_efectivo'],2,'.',','); ?><br>
                            <?php echo "CAMBIO Bs ".number_format($factura[0]['factura_cambio'],2,'.',','); ?>
                        </font>
                        
                    </td>          
                </tr>

            </table>

            <?php if ($tipousuario_id == 1){ ?>


                <div class="col-md-12 no-print" style="max-width: 7cm;">

                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModalAnular"><i class="fa fa-ban"></i> Anular Factura</button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="window.close();"><i class="fa fa-times"></i> Cerrar</button>

                </div>    


            <?php } ?>

        

    </div>
    
</div>
</div>


