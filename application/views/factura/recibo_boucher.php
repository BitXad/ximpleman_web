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


<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
                                            /*function imprimir()
                                            {
                                                /*$('#paraboucher').css('max-width','7cm !important');*/
                                                /* window.print(); 
                                            }*/
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

<!-------------------------------------------------------->


<table class="table" style="width: 7cm;" >
    <tr>
        <td>
                
            <center>
                               
                    <!--<img src="<?php echo base_url('resources/images/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>-->
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>
                
                    <br>
                    <?php if($venta[0]['venta_tipodoc']==1){ $titulo1 = "FACTURA"; $subtitulo = "ORIGINAL"; }
                         else {  $titulo1 = "NOTA"; $subtitulo = "ORIGINAL"; }?>

                <font size="3" face="arial"><b>NOTA DE ENTREGA</b></font> <br>
                <!--<font size="1" face="arial"><b>ORIGINAL</b></font> <br>-->
                _______________________________________________                
                   

<!--                <table style="width: 6cm;">
                    <tr>
                        <td style="font-family: arial; font-size: 8pt;">

                            <b>NIT:      </b><br>
                            <b>FACTURA No.:  </b><br>
                            <b>AUTORIZACION: </b>

                        </td>
                        <td style="font-family: arial; font-size: 8pt;">
                            <?php echo $factura[0]['factura_nitemisor']; ?> <br>
                            <?php echo $factura[0]['factura_numero']; ?> <br>
                            <?php echo $factura[0]['factura_autorizacion'] ?>           
                        </td>
                    </tr>
                </table>-->


<!--                <br>    
                <font size="1px" face="arial"><?php echo $factura[0]['factura_actividad']?></font>
                <br>_______________________________________________-->
                <br> 
                <?php $fecha = new DateTime($venta[0]['venta_fecha']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                    <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a; ?> <br>
                    <b>CODIGO: </b><?php echo $venta[0]['cliente_codigo']; ?> <br>
                    <b>SEÑOR(ES): </b><?php echo $venta[0]['cliente_razon'].""; ?>
                <br>_______________________________________________

            </center>                      
        </td>
    </tr>
     
</table>

       <table class="table table-striped table-condensed"  style="width: 7cm;" >
           <tr>
               <td align="center"><b>CN</b></td>
                <td align="center"><b>DESCRIPCIÓN</b></td>
                <td align="center"><b>P.UNIT</b></td>
                <td align="center"><b>TOTAL</b></td>               
           </tr>
           <?php $cont = 0;
                 $cantidad = 0;
                 $total_descuento = 0;
                 $total_final = 0;

                 foreach($detalle_venta as $d){;
                        $cont = $cont+1;
                        $cantidad += $d['detalleven_cantidad'];
                        $total_descuento += $d['detalleven_descuento']; 
                        $total_final += $d['detalleven_total']; 
                        ?>
           <tr>
                <td align="center"><?php echo $d['detalleven_cantidad']; ?></td>
                <td><font style="size:5px; font-family: arial narrow;"> <?php echo $d['producto_nombre']; ?></td>
                <td align="right"><?php echo number_format($d['detalleven_precio'],2,'.',','); ?></td>
                <td align="right"><?php echo number_format($d['detalleven_total'],2,'.',','); ?></td>
           </tr>
           <?php } ?>
       </table>
        _____________________________________
<table class="table" style="max-width: 7cm;">
    <tr>
        
        <td align="right">
            
            <font size="1">
                <b><?php echo "SUB TOTAL Bs ".number_format($venta[0]['venta_subtotal'],2,'.',','); ?></b><br>
            </font>
            

            <font size="1">
                <?php echo "TOTAL DESCUENTO Bs ".number_format($total_descuento,2,'.',','); ?><br>
            </font>
            <font size="2">
            <b>
                <?php echo "TOTAL FINAL Bs: ".number_format($venta[0]['venta_total'] ,2,'.',','); ?><br>
            </b>
            </font>
            <font size="1" face="arial narrow">
                <?php echo "SON: ".num_to_letras($total_final,' Bolivianos'); ?><br>            
            </font>
            <font size="1">
                <?php echo "EFECTIVO Bs ".number_format($venta[0]['venta_efectivo'],2,'.',','); ?><br>
                <?php echo "CAMBIO Bs ".number_format($venta[0]['venta_cambio'],2,'.',','); ?>
            </font>
            
        </td>          
    </tr>
<!--    <tr>
        <td nowrap>
            <font size="2">
            
                COD. CONTROL: <b><?php echo $factura[0]['factura_codigocontrol']; ?></b><br>
                 <?php $fecha_lim = new DateTime($factura[0]['factura_fechalimite']); 
                        $fecha_limite = $fecha_lim->format('d/m/Y');
                  ?>    
                LIMITE DE EMISIÓN: <b><?php echo $fecha_limite; ?></b><br>
            </font>
        </td>           
    </tr>-->
<!--    <tr>
        <td>
        <center>
            <img src="<?php echo $codigoqr; ?>" width="100" height="100">
        </center>

        </td>
       

    </tr>    -->
    <tr >
          <td>
               USUARIO: <b><?php echo $venta[0]['usuario_nombre']; ?></b>
            <center>
            <font size="2">
                   
            </font>
            <br>
                    <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>  
            </center>
         </td>
    </tr>    
    
</table>
  