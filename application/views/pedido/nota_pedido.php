<style type="text/css">

p {
    font-family: Arial;
    font-size: 8pt;
    line-height: 80%;   /*esta es la propiedad para el interlineado*/
    color: #000;
    padding: 5px;
}

interlineado {
    font-family: Arial;
    font-size: 8pt;
    line-height: 50%;   /*esta es la propiedad para el interlineado*/
    color: #000;
    padding: 5px;
}
/*

div {
line-height: 80%;   esta es la propiedad para el interlineado    
margin-top: 0px;
margin-right: 0px;
margin-bottom: 0px;
margin-left: 10px;
margin: 0px;
}

*/

/*table{
height: 50%;   esta es la propiedad para el interlineado    
width : 8cm;
margin : 0 0 0px 0;
padding : 0 0 0 0;
border-spacing : 0 0;
border-collapse : collapse;
font-family: Arial;
font-size: 7pt; 
marker-attachment: 0;

}

td {
margin : 0px 0px 0px 0px;    
height: 30%;   esta es la propiedad para el interlineado  

}

th {
margin : 0px 0px 0px 0px;    
line-height: 70%;   esta es la propiedad para el interlineado    


}*/

table {
  /*border: 1px solid #000;*/
  border-collapse: collapse;
  padding: 0;
  margin: 0;
}
td {
  /*border: 1px solid #000;
  text-align: center;*/
  padding: 0px;
  /* Alto de las celdas */
  height: 10px;
font-family: Arial;
font-size: 8pt;   
margin: 0;
margin-bottom: 0;
margin-top: 0;
padding: 0;


}
tr {
  /*border: 1px solid #000;
  text-align: center;*/
  padding: 0px;
  /* Alto de las celdas */
  height: 10px;
font-family: Arial;
font-size: 8pt;   
margin: 0;
margin-bottom: 0;
margin-top: 0;
}

td {
  /*border: 1px solid #000;
  text-align: center;*/
  padding: 0px;
  /* Alto de las celdas */
  height: 10px;
font-family: Arial;
font-size: 7pt;   
margin: 0;
margin-bottom: 0;
margin-top: 0;
}



/*td#comentario {
vertical-align : bottom;
border-spacing : 0;
}
div#content {
line-height: 50%;   esta es la propiedad para el interlineado    
background : #ddd;
font-size : 8px;
margin : 0 0 0 0;
padding : 0 0px 0 0px;
border-left : 1px solid #aaa;
border-right : 1px solid #aaa;
border-bottom : 1px solid #aaa;
}*/
</style>

<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/pedido.js'); ?>" type="text/javascript"></script>

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
<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<?php //$tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"]."cm";
      $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
      $decimales = $parametro[0]["parametro_decimales"];

?>
<?php
    if($pedido_titulo == "Pedidos"){
        $labelboton = "Pedido";
    }elseif($pedido_titulo == "Preventas"){
        $labelboton = "Preventa";
    }else{
        $labelboton = "Reserva";
    }
?>


<table class="table table-responsive" >
<tr>
<td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" >

</td>

<td style="padding: 0;">



<!--<div class="container table-responsive" style="padding: 0;">-->
    
<p>
<font face="Arial">

    <table class="table" style="max-width:<?php echo $ancho; ?>; padding: 0;" >
        <tr style="padding: 0;">
            <td  style="padding: 0; line-height: 10px; width: 30%;">
                    
                <center>
                
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="80" height="60"><br>                    
                    <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="1" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->                    
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
<!--                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>                    -->
                
                </center>
            </td>
            <td  style="padding: 0; line-height: 12px; width: 40%;">
                <center>
                 
                        
                    <br>
                    <font size="3" face="Arial"><b><?php echo "NOTA DE ".strtoupper($labelboton); ?></b></font><br>
                    <font size="3" face="Arial"><b><?php echo "Nº 000".$pedido[0]['pedido_id']; ?></b></font><br>
                    <font size="1" face="Arial"><b><?php echo  date_format(date_create($pedido[0]['pedido_fecha']),'d/m/Y h:i:s'); ?></b></font><br>
                    <font size="1" face="Arial"><b><?php echo  "Expresado en ".$parametro[0]["moneda_descripcion"]; ?></b></font>
                    <br>
                    <?php if($parametro[0]["parametro_mostrarmoneda"] == 1){ ?>
                    <font size="1" face="Arial"><b><?php echo  "T.C. Bs ".number_format($moneda["moneda_tc"],$decimales,".",",");; ?></b></font><br>
                    <?php } ?>
                </center>                
            </td>
            <td  style="padding: 0; line-height: 10px; width:30%;">
                _______________________________________<br>
                        <font size="1" face="Arial">
                            <br><b>CLIENTE: </b><?php echo $pedido[0]['cliente_nombre']; ?>
                            <br><b>CÓDIGO: </b><?php echo $pedido[0]['cliente_codigo']; ?>
                            <br><b>DIRECCIÓN: </b><?php echo $pedido[0]['cliente_direccion']; ?>
                            <br><b>TELÉF.: </b><?php echo $pedido[0]['cliente_telefono']." - ".$pedido[0]['cliente_celular']; ?>
                            <br><b>ZONA: </b><?php echo $pedido[0]['zona_nombre']; ?>
                        </font>
                        <br>
                    _______________________________________

              
            </td>
        </tr>
    </table>
 
    <table class="table" style="width:<?php echo $ancho; ?>; height: 1px; padding: 0;" >
    
        <tr   style="border-top-style: solid; border-bottom-style: solid; padding: 0;">
            <!--<th>#</th>-->
            <th style="padding: 0"><center>CANT</center></th>
            <th style="padding: 0"><center>DESCRIPCIÓN</center></th>
            <th style="padding: 0"><center>UNIDAD</center></th>
            <th style="padding: 0"><center>PREC.UNIT<br><?php echo $parametro[0]["moneda_descripcion"]; ?></center></th>
            <th style="padding: 0"><center>TOTAL<br><?php echo $parametro[0]["moneda_descripcion"]; ?></center></th>
            <?php if($parametro[0]["parametro_mostrarmoneda"] == 1){ ?>
            <th style="padding: 0"><center>TOTAL<br>            
                <?php if ($parametro[0]["moneda_id"]==1){ echo $moneda["moneda_descripcion"]; } 
                    else{ echo "Bs";}
                ?>
            </center>
            </th>
            <?php } ?>
        </tr>
        
        <?php 
        
            $i = 1;
            $total_final = 0;
            foreach($pedido as $p){
                $total_final += $p['detalleped_total'];
        ?>
            <tr style="padding: 0;">
                <td style="padding: 0">
                    <center>
                        <?php echo number_format($p['detalleped_cantidad'],$decimales,".",","); ?>
                    </center>
                </td>
                <td style="padding: 0">
                    <?php echo $p['producto_nombre']; ?>
                </td>
                <td style="padding: 0">
                    <?php echo $p['producto_unidad']; ?>
                </td>
                <td align="right"  style="padding: 0">
                    <?php echo number_format($p['detalleped_precio'],$decimales,".",","); ?>
                </td>
                <td align="right"  style="padding: 0">
                    <?php echo number_format($p['detalleped_total'],$decimales,".",","); ?>
                </td>
                <?php if($parametro[0]["parametro_mostrarmoneda"] == 1){ ?>
                <td align="right"  style="padding: 0">
                
                    <?php 
//                        if ($parametro[0]["moneda_id"]==1 && $p['moneda_id']==1){ //cuando la moneda principal es Bs y la del producto es Bs
//                                   echo number_format($p['detalleped_total'] / $p['detalleped_tc'] ,$decimales,".",","); 
//                        }
//                        
//                        if ($parametro[0]["moneda_id"]==1 && $p['moneda_id']!=1){ //cuando la moneda principal es Bs y la del producto moneda extrangera
//                                   echo number_format($p['detalleped_total'] ,$decimales,".",","); 
//                        }
//                        
//                        if ($parametro[0]["moneda_id"]!=1 && $parametro[0]["moneda_id"]==1){ // cuando la moneda principal es Extrangera y el producto es Bs
//                                   echo number_format($p['detalleped_total'] / $p['moneda_tc'],$decimales,".",","); 
//                        }
//                          
//                        
//                        if ($parametro[0]["moneda_id"]!=1 && $p['moneda_id']!=$parametro[0]["moneda_id"]){ //Cuando la moneda principal es Extragera y el producto tambien
//                                   echo number_format($p['detalleped_total'] * $p['moneda_tc'],$decimales,".",","); 
//                        }
                        if ($parametro[0]["moneda_id"]==1){ //cuando la moneda principal es Bs y la del producto es Bs
                                   echo number_format($p['detalleped_total'] / $p['detalleped_tc'] ,$decimales,".",","); 
                        }
                        else{
                                   echo number_format($p['detalleped_total'] * $p['detalleped_tc'],$decimales,".",","); 
                        }
                        
                    ?>
                    
                
                
                </td>
                <?php } ?>
            </tr>
        <?php 
            }
        ?>
        <tr align="right" style="border-top: solid; border-bottom: solid;">
<!--            <th></th>-->
            <td colspan="3"  style="padding: 0"><font size="3"><b>Total <?php echo $parametro[0]["moneda_descripcion"]; ?></b></font></td>
<!--            <th></th>
            <th></th>-->
            <td align="right"  style="padding: 0" colspan="2"><font size="3">
                <b> 
                    <?php echo number_format($total_final,$decimales,".",","); ?>
                </b></font>
                <?php
                if($parametro[0]["parametro_mostrarmoneda"] == 1){ ?>
                    <br>
                    <?php
                        if ($parametro[0]["moneda_id"]==1){ //cuando la moneda principal es Bs y la del producto es Bs
                            echo $moneda["moneda_descripcion"]." ".number_format($total_final / $p['detalleped_tc'] ,$decimales,".",","); 
                        }
                        else{
                            echo "Bs ".number_format($total_final * $p['detalleped_tc'],$decimales,".",","); 
                        }
                }
                    ?>
            </td>
            <?php if($parametro[0]["parametro_mostrarmoneda"] == 1){ ?>
            <td></td>
            <?php } ?>
        </tr>

    </table>    
</font>

<font size="1">
    <b>NOTA: </b><?php echo $pedido[0]['pedido_glosa']; ?>
    <br><b>PREVED.: </b><?php echo $pedido[0]['usuario_nombre'];
    if($pedido[0]['ingreso_monto'] > 0){
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>RESERVA: </b>".$pedido[0]['ingreso_monto']." ".$pedido[0]['ingreso_moneda'];
    }?>
    
</font>

    <table class="table" style="width: <?php echo $ancho; ?>;">
        <tr>
            <td  style="padding: 0">
                <center>
                    __________________________<br>
                            ENTREGE CONFORME
                </center>  
            </td>
            <td style="padding: 0">
                <center>
                    __________________________<br>
                            DESPACHADO POR
                </center>  
            </td>
            <td  style="padding: 0">
                <center>
                    __________________________<br>
                            RECIBI CONFORME
                </center>  
            </td>
        </tr>
    </table>

</p>
<!--</div>
    -->
    
</td>    
</tr>    
</table>
