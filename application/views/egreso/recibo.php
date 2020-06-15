

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
    @media print {
      .bg-danger {
        background-color: #f2dede !important;
      }
    }
</style>


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
font-family: Arial;
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
<?php $tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"];
      //$margen_izquierdo = "col-xs-".$parametro[0]["parametro_margenfactura"];;
      $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
?>

<!--        <div id="myModalAnular" class="modal fade no-print" role="dialog">
          <div class="modal-dialog">

             Modal content
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Anular Factura</h4>
              </div>
              <div class="modal-body">
                  <h3>              
                  <p>
                    ADVERTENCIA: La factura Nº: <?php //echo $factura[0]['factura_numero']; ?>, esta a punto de ser ANULADA. ¿Desea continuar?
                  </p>
                  </h3>
              </div>
              <div class="modal-footer">
                  <a href="<?php //echo base_url('factura/anular_factura/'.$factura[0]['factura_id']."/".$factura[0]['factura_numero']); ?>" type="button" class="btn btn-warning" ><i class="fa fa-times-rectangle"></i> Anular</a>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
              </div>
            </div>

          </div>
        </div>-->
<!-------------------------------------------------------->


<table class="table" >
<tr>
<td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" >
    
</td>
<td style="padding: 0;">
    


            <table class="table" style="width: <?php echo $ancho;?>cm; padding: 0;" >
                <tr>
                    
                    <td style="width: <?php echo $ancho / 3;?>cm;  padding: 0; line-height: 9px;" colspan="3">

                <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="80px" height="60px"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>
                

                </center>                          
                    </td>
                    <td style="width: <?php echo 5;?>cm;  padding: 0; line-height: 12px;">
                        <center>            
                            <br>
                            <br>
                            <br>
                            
                                <font size="3" face="arial"><b>RECIBO DE EGRESO</b></font> <br>
                                <font size="3" face="arial"><b>Nº:  00<?php echo $egresos[0]['egreso_id']; ?> </b></font>                       

                        </center>
                    </td>
                    
                    <td style="width: <?php echo $ancho / 5;?>cm;  padding: 0; line-height: 10px;">
                        

                    </td>
                </tr>
                <tr>
                    <td>
                        
                    </td>
                </tr>
                
                             
                <?php $fecha = new DateTime($egresos[0]['egreso_fecha']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>
                
                <tr style="padding: 0;">
                    <td colspan="5" style="padding: 0;">
                        
                        <table style="font-family: Arial; font-size: 10px; width: <?php echo $ancho;?>cm;" id="mitabla" > 
                            
                                
                            <tr>
                                <td style="width: 2cm;"></td> 
                                <td style="width: 4cm; text-align: right; background-color: #aaa !important; -webkit-print-color-adjust: exact;" nowrap ><b>EN FECHA: </b></td><td></td> <td style="width: 10cm; background-color: #ddd !important; -webkit-print-color-adjust: exact;"><?php echo $fecha_d_m_a; ?></td>
                                <td style="width: 2cm;"></td> 
                            </tr>

                            <tr>
                                <td style="width: 2cm;"></td>
                                <td style="width: 5cm; text-align: right; background-color: #aaa !important; -webkit-print-color-adjust: exact;" nowrap><b>ENTREGUE A: </b></td><td ></td><td style="width: 10cm; background-color: #ddd !important; -webkit-print-color-adjust: exact;"><?php echo $egresos[0]['egreso_nombre'].""; ?></td>
                                <td style="width: 2cm;"></td>
                            </tr>
                           
                        
                        </table>     
                        
                    </td>  

                </tr>

                            <tr>
                            <td class="vacio"> </td>
                            </tr>

                <tr style=" border-style: solid;   border-width: medium; border-color: black; border-width: 2px; padding:0; border-left: white; border-right: white;">
                    <td colspan="5">
                
                <table class="table table-condensed"  style="width: <?php echo $ancho;?>cm; margin: 0;" >

                      
                       <tr>
                                <td style="width: 2cm;"></td> 
                                <td style="width: 4cm; text-align: right; background-color: #aaa !important; -webkit-print-color-adjust: exact;" nowrap >
                                    <b>POR CONCEPTO: </b></td><td></td> 
                                <td style="width: 10cm; background-color: #ddd !important; -webkit-print-color-adjust: exact;">
                                     <?php echo$egresos[0]['egreso_categoria'];?> (<?php echo$egresos[0]['egreso_concepto'];?>)
                                </td>
                                <td style="width: 2cm;"></td> 
                        </tr>
                        
                        <tr>
                            <td class="vacio"></td>
                        </tr>
                       
                       <tr>
                                <td style="width: 2cm;"></td> 
                                <td style="width: 4cm; text-align: right; background-color: #aaa !important; -webkit-print-color-adjust: exact;" nowrap >
                                    <b>LA SUMA DE: </b></td><td></td> 
                                <td style="width: 10cm; background-color: #ddd !important; -webkit-print-color-adjust: exact;">
                                        <?php echo number_format($egresos[0]['egreso_monto'],'2','.',',');?> <?php echo$egresos[0]['egreso_moneda'];?>
                                </td>
                                <td style="width: 2cm;"></td> 
                        </tr>
                        
                        <tr>
                            <td class="vacio"></td>
                        </tr>
                       
                       <tr>
                                <td style="width: 2cm;"></td> 
                                <td style="width: 4cm; text-align: right; background-color: #aaa !important; -webkit-print-color-adjust: exact;" nowrap >
                                    <b>LITERAL: </b></td><td></td> 
                                <td style="width: 10cm; background-color: #ddd !important; -webkit-print-color-adjust: exact;">
                                    <?php echo num_to_letras($egresos[0]['egreso_monto']);?> 
                                </td>
                                <td style="width: 2cm;"></td> 
                        </tr>
            
            </table>
               
            </td>
            </tr>
<!--        </table>

        <table class="table" style="width: <?php echo $ancho;?>cm; margin: 0;">                -->
        <tr>
            <td style="line-height: 8px;" colspan="2"> 
                    <br><br>
                    <br><br>
                    <center>

                        <?php echo "-----------------------------------------------------"; ?><br>
                        <?php echo "ENTREGUE CONFORME"; ?><br><?php echo$egresos[0]['usuario_nombre'];?>

                    </center>
                     <?php echo date("d/m/Y H:i:s");?>
                </td>
                <td>
                </td>
               

                <td style="line-height: 8px;" colspan="2"> 
                    <br><br>
                    <br><br>
                    <center>

                        <?php echo "-----------------------------------------------------"; ?><br>
                        <?php echo "RECIBI CONFORME"; ?><br>   

                    </center>
                </td>
        </tr>   

    </table>


        
</td>
</tr>
</table>






<!--<style> 
             
.lebo {
    border: 2px solid black; border-right: 0px; border-top: 0px; padding-left: 3px;
}

.todo {
    border: 2px solid black; padding:3px !important; margin: 3px !important; 
}

.vacio {
    border: 0px; padding-top:0.5cm; padding-left: 1cm; 
}
.linea {
     width: 2cm; 
}
.linea hr{
      padding:0px; margin: 0px;
}
.box4 {
width:16cm;
margin:0% 0% 0% 0%;
margin-left: 5%;
padding-left:0px;
border:2px solid black;
border-top: 0px;
}
@media print {
  .todo {
    background-color: rgba(127,127,127,0.3) !important;
}
}

</style>
<?php $padding = "style='padding:0; '"; 
    $ancho = "16cm";
    $ancho2 = "17cm"; ?>
<div class="box">
<div class="row" style="padding-left: 5%;"> 
----------------------------------------------------
<table class="table" style="width: <?php echo $ancho; ?>; padding: 0;" >
    <tr>
        <td style="width: 40%; padding: 0; line-height:10px;" >
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="80px" height="60px"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>
                    <font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>
                    <font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>
                

            </center>                      
        </td>
                   
        <td style="width: 40%; padding: 20;line-height:15px;" > 
            <center>
            
                <br>
                <font size="3" face="arial"><b>RECIBO DE EGRESO</b></font> <br>
                <font size="2" face="arial"><b>Nº: 00<?php echo $egresos[0]['egreso_id']; ?></b></font> <br>
                <font size="1" face="arial"><?php echo date("d/m/Y   H:i:s  ") ; ?></font>
                 <br>
                
            </center>
        </td>
        <td style="width: 20%; padding: 0; text-align: left" >
      
        </td>
    </tr>
     
    
    
</table> 
</div> 
    
    <table style="margin-left: 3%;width: <?php echo $ancho2; ?>; font-family: Arial; font-size:10px;">
        <tr>
            <td class="lebo" style="width: 5cm"><b>Fecha y Hora: </b>
            <?php echo date('d/m/Y  H:i:s',strtotime($egresos[0]['egreso_fecha']));?>
            </td>
            <td class="vacio"></td>
            <td class="lebo" style="width: 12cm"><b>Apellidos y Nombre(s): </b>
            <?php echo$egresos[0]['egreso_nombre'];?>
            </td>
        </tr>
    </table>
  
                            
<div class="box4">   
    <table style="margin-left:0; width: 95%; font-family: Arial; font-size:10px;"> 
            <tr>
                <td class="vacio"></td>
            </tr>
            <tr>
                <td class="linea"><hr style="border: 1px solid black"></td>                
                <td class="todo"><b>MONTO: </b>                         
                    <?php echo number_format($egresos[0]['egreso_monto'],'2','.',',');?> <?php echo$egresos[0]['egreso_moneda'];?></td>                      
            </tr>
            <tr>
                <td class="vacio"></td>
            </tr>
            <tr>
                <td class="linea"><hr style="border: 1px solid black"></td>
                <td class="todo"><b>CONCEPTO: </b>   
                    <?php echo$egresos[0]['egreso_categoria'];?> (<?php echo$egresos[0]['egreso_concepto'];?>)</td>
            </tr>
            <tr>
                <td class="vacio"></td>
            </tr>
            <tr>
                <td class="linea"><hr style="border: 1px solid black"></td>
                <td class="todo"><b>SON: </b>   
                    <?php echo num_to_letras($egresos[0]['egreso_monto']);?> </td>
            </tr>
            <tr>
                <td class="vacio"></td>
            </tr>
            <tr>
                <td class="linea"><hr style="border: 1px solid black"></td>    
                <td class="todo"><b>CAJERO: </b> 
                    <?php echo$egresos[0]['usuario_nombre'];?></td>
            </tr>
            <tr>
                <td class="vacio"></td>
            </tr>
    </table>
</div>
<div class="box4">
<table  class="table table-striped table-condensed" style="width: 98%;margin: 1%; font-family: Arial; font-size:10px;">
    <tr style="border: 0"><br>
    </tr>
    
    <tr>
        <td> 
            <center>

                <?php echo "-----------------------------------------------------"; ?><br>
                <?php echo "RECIBI CONFORME"; ?><br>

            </center>
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
<div class="row" style="padding-left: 7%;padding-top: 0.5%">
     <font size="1" face="Arial"><b>Nº Trans.:</b> 00<?php echo $egresos[0]['egreso_numero']; ?></font>              
</div>
</div>-->
