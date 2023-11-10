    
<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
    });
</script>
<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->

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
        border-left : 1px solid #aaa;
        border-right : 1px solid #aaa;
        border-bottom : 1px solid #aaa;
    }
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php //echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->

<!-------------------------------------------------------->
<?php $tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $decimales = $parametro[0]["parametro_decimales"];
      $ancho = $parametro[0]["parametro_anchofactura"];
      $margen_izquierdo = "col-xs-".$parametro[0]["parametro_margenfactura"];

?>

<!--<div class="<?php echo $margen_izquierdo; ?>" style="padding: 0; max-width:5cm;">
    
</div>-->
 
<div class="col-xs-10" style="padding: 0;">

    <table class="table" style="width: <?php echo $ancho;?>cm; padding: 0; " >
        <tr>
            <td style="max-width: 6cm; padding: 0; line-height: 10px;" colspan="2">
                <center>
                    <font size="2" face="Arial black"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <?php if (isset($empresa[0]['empresa_eslogan'])){ ?>
                    <small>
                        <font size="1" face="Arial narrow"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>                                    
                    </small> 
                    <?php } ?>
                    <font size="1" face="Arial narrow">
                        <small>
                            <?php echo $empresa[0]['empresa_direccion']; ?><br>
                            <?php echo $empresa[0]['empresa_telefono']; ?><br>
                            <?php echo $empresa[0]['empresa_ubicacion']; ?>
                        </small>                                
                    </font>
                </center>
            </td>
            <td style="width: 55%; padding: 0; line-height: 12px; " colspan="2"> 
                <center>
                    <br>
                    <?php if($venta[0]['venta_tipodoc']==1){ $titulo1 = "FACTURA"; $subtitulo = "ORIGINAL"; }
                         else {  $titulo1 = "NOTA"; $subtitulo = "ORIGINAL"; }?>
                
                    <?php $fecha = new DateTime($venta[0]['venta_fecha']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                    ?>
                    <font size="4" face="arial"><b>CERTIFICADO DE GARANTIA</b></font> <br>
                    <font size="4" face="arial"><b>Nº 00<?php echo $venta[0]['venta_id']; ?></b></font> <br>
                    <font size="1" face="arial"><b><?php echo $fecha_d_m_a." ".$venta[0]['venta_hora']; ?></b></font> <br>
                </center>
            </td>

        </tr>
        <tr>
            <td colspan="4" style="text-align: center;">
                <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a; ?> <br>
                <b>CODIGO: </b><?php echo $venta[0]['cliente_codigo']." / NIT: ".$venta[0]['cliente_nit']; ?> <br>
                <b>SEÑOR(ES): </b><?php echo $venta[0]['cliente_razon'].""; ?><br>
            </td>
        </tr>
        <tr style="border-top-style: solid; border-color: #000;">
            <td colspan="4" style="text-align: justify;">
                <?php echo $empresa[0]['empresa_nombre']; ?>, como distribuidor de productos y servicios, hace constar que el (los) producto(s) y 
                sus especificaciones establecidas, garantizan la calidad de componentes y mano de obra de nuestros equipos dentro de su uso normal.
                <br><br>
                <?php echo $empresa[0]['empresa_nombre']; ?>, se hace responsable durante el periodo de DOCE MESES, contra cualquier defecto de 
                fabricación y/o funcionamiento a partir de la entrega.
                <br><br>
                Para hacer efectiva esta garantía el usuario final deberá comunicarse a nuestras oficinas, al/los teléfono(s): <?php echo $empresa[0]['empresa_telefono']; ?>,
                o aproximarse por nuestros centros de servicio autorizados, siempre y cuando cumpla con las condiciones anexas.
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <center>        
                    <font face="Arial" size="3"><b>INFORMACIÓN DEL PRODUCTO</b></font>
                </center>
            </td>
        </tr>
<!--    </table>
   <table class="table"  style="width: <?php echo $ancho;?>cm; border-left-style: solid; border-right-style: solid; border-top-style: solid; border-right-color: #000;   border-width: thin;" >-->
        <tr  >
            <td align="center" style="padding: 0; -webkit-print-color-adjust: exact; border-left: #000 solid 1px; border-top: #000 solid 1px; border-bottom: #000 solid 1px;"><b>ITEM</b></td>
            <td align="center" style="padding: 0; -webkit-print-color-adjust: exact; border-left: #000 solid 1px; border-top: #000 solid 1px; border-bottom: #000 solid 1px;"><b>DESCRIPCIÓN</b></td>
            <td align="center" style="padding: 0; -webkit-print-color-adjust: exact; border-left: #000 solid 1px; border-top: #000 solid 1px; border-bottom: #000 solid 1px;"><b>CANT.</b></td>
            <td align="center" style="padding: 0; -webkit-print-color-adjust: exact; border-left: #000 solid 1px; border-top: #000 solid 1px; border-bottom: #000 solid 1px; border-right: #000 solid 1px;"><b>SERIE(S)</b></td>
        </tr>
        <?php
        $cont = 0;
        $cantidad = 0;
        $total_descuento = 0;
        $total_final = 0;
        foreach($detalle_venta as $d){
            $cont = $cont+1;
            $cantidad += $d['detalleven_cantidad'];
            $total_descuento += $d['detalleven_descuento']; 
            $total_final += $d['detalleven_total']; 
        ?>
        <tr style="border-bottom-style: solid; border-bottom-color: #000; border-width: thin;">
            <td align="center" style="padding: 0; border-left: #000; border-style: solid; border-width: thin;"><?php echo $cont; ?></td>
            <td style="padding: 0;  border-left: #000; border-style: solid; border-width: thin;"><font style="font-size:10px; font-family: arial;"><b> <?php echo $d['producto_nombre'];?></b>
                <?php
                $caracteristicas = $d['detalleven_caracteristicas'];
                if ($caracteristicas!="null" && $caracteristicas!='-')
                    echo "<br>".nl2br($caracteristicas);
                ?>
            </td>
            <td align="center" style="padding: 0;  border-left: #000; border-style: solid; border-width: thin;">
                <?php
                $partes = explode(".",$d['detalleven_cantidad']); 
                if ($partes[1] == 0) { 
                    $lacantidad = $partes[0]; 
                }else{ 
                    $lacantidad = number_format($d['detalleven_cantidad'],$decimales,'.',','); 
                } 
                echo $lacantidad;
                ?>
            </td>
            <td style="padding: 0;  border-left: #000; border-style: solid; border-width: thin;">
                <?php 
                $preferencia = $d['detalleven_preferencia'];
                if ($preferencia !="null" && $preferencia!='-')
                    echo $preferencia;
                ?>
            </td>
        </tr>
        <?php } ?>
<!--    </table>
    <table class="table" style="width: <?php echo $ancho;?>cm;">-->
        <tr>
            <!--<td align="center" style="padding: 0; border-left: #000; border-style: solid; border-width: thin;"><?php echo $cont; ?></td>-->
            <td colspan="4" style="text-align: justify;">
                <center><b>IMPORTANTE</b></center>
                <br>
                - La limpieza de virus y el mantenimiento correctivo, No son considerados como parte de la GARANTÍA y el usuario es 
                responsable de los daños al equipo en caso de hacer caso omiso a las indicaciones de mantenimiento.
                <br><br>
                - Los accesorios menores (teclado, mouse, parlantes) e insumos (tintas, cintas, toners) no forman parte de la garantía.
                <br><br>
                - La garantía se invalida por daños ocasionados por choques eléctricos, agua, malas conexiones, golpes, 
                caídas o roturas de cualquier naturaleza.
            </td>
        </tr>
        <tr>
            <td colspan="4" style="text-align: justify;">
                <center>
                    EN CASO DE RECLAMO POR GARANTIA <br>
                    ESTE CERTIFICADO DEBE CONSERVARLO EL USUARIO FINAL
                </center>
                <small>
                    <?php echo date("d/m/Y H:n:s"); ?>
                </small>
            </td>
        </tr>
        
        <!--<tr>-->
            
        <!--</tr>-->
<!--        <tr>
            <td  style="padding: 0">
                <center>
                    __________________________<br>
                            ENTREGE CONFORME
                </center>  
            </td>
            <td style="padding: 0">
            </td>
            <td  style="padding: 0">
                <center>
                    __________________________<br>
                            RECIBI CONFORME
                </center>  
            </td>
        </tr>-->
    </table>

</div>

<?php 
$opc = $parametro[0]['parametro_cerrarventanas'];
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