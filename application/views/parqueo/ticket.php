    
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
font-size: 8pt;  


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
border-left : 1px solid #aaa;
border-right : 1px solid #aaa;
border-bottom : 1px solid #aaa;
}
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->

<!-------------------------------------------------------->
<?php //$tipo_factura = $parametro["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro["parametro_anchofactura"]."cm";
      $margen_izquierdo = $parametro["parametro_margenfactura"]."cm";

      $decimales = $parametro["parametro_decimales"];
?>
<table class="table" >
<tr>
<td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" >
    
</td>

<td style="padding: 0;">


        <table class="table" style="width: <?php echo $ancho; ?>;" >
            <tr>
                <td style="border-bottom: solid 1px #000; padding:0;" colspan="4">        
                    <center style="line-height: 14px;">

                                        <?php if($parametro["parametro_logoenfactura"]==1){ ?>
                                        <center>                                
                                            <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="150" height="90"><br>
                                        </center>
                                        <?php } ?>
                                                                        
              

                                    <?php 
                                    
                                        if($parametro["parametro_mostrarempresa"]==1){ 
                                            echo "<br><b style='font-size: 14px;'>".$empresa[0]['empresa_nombre']."</b>"; 
                                        
                                        }?>
                                    

                                    <?php
                                        if($parametro["parametro_mostrareslogan"]==1){ 
                                            if($empresa[0]['empresa_eslogan'] != "" && $empresa[0]['empresa_eslogan'] != null){
                                                echo "<br><b>".$empresa[0]['empresa_eslogan']."</b>";
                                            }
                                        }   
                                    ?>
                 
                                    
 
                                    
                                    <?php 
                                        if($parametro["parametro_mostrardireccion"]==1){
                                            echo "<br>".$empresa[0]['empresa_direccion'];
                                        }
                                    ?>
                                    
                                    <?php echo "<br>"."Telf. ".$empresa[0]['empresa_telefono']; ?>
                                    
                                    <?php echo "<br>".$empresa[0]['empresa_ubicacion']; ?><br><br>
                           
                            <font size="3" face="arial"><b><?php echo $parametro["parametro_tituldoc"]; ?></b></font> 
                            <font size="3" face="arial"><b>Nº 00<?php echo $registro[0]['registroparqueo_id']; ?></b></font> <br>
                    </center>                      
           
                            <?php if($parametro["parametro_mostrarmoneda"] == 1){ ?>
                            T.C. <?php echo number_format($moneda['moneda_tc'],$decimales,".",","); ?></font> <br>
                            <?php } ?>
                 
                </td>
            </tr>
            <tr>
                <td>
                    <?php 
                        $fecha = new DateTime(); 
                        $fecha_d_m_a = $fecha->format('d/m/Y H:i:s'); // Corregido H:i:s (en vez de H:m:s)

                        // Convertir fecha de ingreso
                        $fechaIngreso = new DateTime($registro[0]['registroparqueo_fechaingreso']);
                        $fechaIngresoFormateada = $fechaIngreso->format('d/m/Y');

                        // Convertir fecha de salida
                        $fechaSalida = new DateTime($registro[0]['registroparqueo_fechasalida']);
                        $fechaSalidaFormateada = $fechaSalida->format('d/m/Y');
                    ?>    

                    <b>FECHA: </b><?php echo $fecha_d_m_a; ?> <br>
                    <b>PLACA/CODIGO: </b><?php echo $registro[0]['cliente_codigo']; ?> <br>
                    <b>NOMBRE: </b><?php echo $registro[0]['cliente_razon'].""; ?><br>
                    <b>TIPO: </b><?php echo $registro[0]['tarifa_tipo'].""; ?> 
                    <b>  MODALIDAD: </b><?php echo $registro[0]['registroparqueo_modalidad'].""; ?><br>
                    <b>INGRESO: </b><?php echo $fechaIngresoFormateada." - ".$registro[0]['registroparqueo_horaingreso']; ?><br>
                    
                    <?php if($registro[0]['registroparqueo_modalidad']=="HORA" || $registro[0]['registroparqueo_modalidad']=="NOCTURNA"){ ?>
                        <b>SALIDA: </b><?php echo $fechaSalidaFormateada." - ".$registro[0]['registroparqueo_horasalida']; ?><br>
                    <?php }else{ 
                        
                        // Convertir fecha limite
                        $fechalimite = new DateTime($registro[0]['registroparqueo_fechalimite']);
                        $fechaLimiteFormateada = $fechalimite->format('d/m/Y'); ?>
                        <b>FEC. LIMITE: </b><?php echo $fechaLimiteFormateada; ?><br>
                        
                    <?php } ?>
                        
                        
                </td>
            </tr>

<!--        </table>

       <table class="table table-striped table-condensed"  style="width: <?php echo $ancho; ?>;" >-->
           <tr style="font-weight: bold;">
               <td align="center" style="border-top: solid 1px #000; border-bottom: solid 1px #000; padding: 0">USO DE PARQUEO:<br> <?= $registro[0]['registroparqueo_tiempoliteral']; ?></td>
                
           </tr>
           
           
    <tr align="right">
        
        <td colspan="5"style="border-top: solid 1px #000; padding: 0; line-height: 17pt; font-family: Arial; font-size: 14pt; font-weight: bold"  >
            
                <?php echo "TOTAL ".$parametro['moneda_descripcion']." ".number_format($registro[0]['registroparqueo_total'],$decimales,'.',','); ?><br>
            
        </td>          
    </tr>
    
    <tr style="">
        <td colspan="3" style="border-bottom: solid 1px #000; padding: 0px; font-size: 10px; font-weight: bold; ">            
            <?php echo "SON: ".num_to_letras($registro[0]['registroparqueo_total'],' Bolivianos'); ?>
        </td>
    </tr>
                <tr>
                    <td style="padding: 0; padding-top: 10px" colspan="4">
                        <center>
                            
                            <img src="<?php echo $codigoqr . '?timestamp=' . time(); ?>" width="100" height="100" alt="Código QR">
                            
                        </center>
                        USUARIO: <?php echo $registro[0]['usuario_nombre']; ?>
                    
                    
                    </td>
                </tr>
    
    <tr >
        <td colspan="5" style="padding:0;">
            
                    <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>  
            </center>
         </td>
    </tr>    
    
</table>
  
</td>
</tr>
</table>


<?php 
$opc = $parametro['parametro_cerrarventanas'];
if($opc==1){ ?>

<script>
  // Función para cerrar la ventana
  function cerrarVentana() {
    window.close();
  }

  // Llamamos a la función cerrarVentana() después de 2000 milisegundos (2 segundos)
  setTimeout(cerrarVentana, 2000);
</script>

<?php } ?>