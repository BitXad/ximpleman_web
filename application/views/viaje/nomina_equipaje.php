

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
    line-height: 120%;  /*esta es la propiedad para el interlineado*/
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

}
td{
border:none!important;
}


td#comentario {
vertical-align : bottom;
border-spacing : 0;
}
div#content {
background : #ddd;
font-size : 7px;
margin : 0 0 0 0;
padding : 0 1px 0 1px;
border-left : 1px solid #aaa;
border-right : 1px solid #aaa;
border-bottom : 1px solid #aaa;
}
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->

<!-------------------------------------------------------->
<?php //$tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"]."cm";
      $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
?>
<style>
  .tabla-lineas {
    border-collapse: collapse;
  }
  .tabla-lineas th,
  .tabla-lineas td {
    border: 2px solid #000; /* Puedes ajustar el grosor y color según prefieras */
    padding: 5px; /* Opcional, para agregar espacio interno */
  }
</style>
<table class="table" >
<tr>
<td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" >
    
</td>

<td style="padding: 0;">


<table class="table" style="width: <?php echo $ancho; ?>; margin-bottom: 0px;" class="tabla-lineas">
    <tr>
        <td colspan="5">
                
            <center>
                               
                    <!--<img src="<?php echo base_url('resources/images/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>-->
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font>
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <font size="1" face="Arial"><b><?php // echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>
                    
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>
                
                    <br>
                   

                <font size="3" face="arial"><b>NOMINA DE EQUIPAJE   </b></font> <br>
                <font size="2" face="arial"><b>Nº:  00<?php echo $datos_viaje[0]['viaje_id']; ?> </b></font> <br>            
                             

            </center>                      
     </td>
    </tr>
 
    <tr style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;"> 
        <td colspan="5">           
            <center>                      
                             
                <?php $fecha = new DateTime($datos_viaje[0]['viaje_fechasalida']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                                      
                    
                    <table>
                        <tr><td colspan="2" style="text-align: right;"><b>FECHA : </b></td><td colspan="3"> <?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a; ?> </td></tr>
                        <tr><td colspan="2" style="text-align: right;"><b>DESTINO : </b></td><td colspan="3"> <?php echo $datos_viaje[0]['ruta_nombre']; ?> </td></tr>
                        <tr><td colspan="2" style="text-align: right;"><b>CONDUCTOR : </b></td><td colspan="3"> <?php echo $datos_viaje[0]['conductor_nombres']." ".$datos_viaje[0]['conductor_apellidos']; ?> </td></tr>
                        <tr><td colspan="2" style="text-align: right;"><b>LICENCIA COND. : </b></td><td colspan="3"> <?php echo $datos_viaje[0]['conductor_licencia']; ?> </td></tr>
                        <tr><td colspan="2" style="text-align: right;"><b>COND. RELEVO : </b></td><td colspan="3"> <?php echo $datos_viaje[0]['relevo_nombres']." ".$datos_viaje[0]['relevo_apellidos']; ?> </td></tr>
                        <tr><td colspan="2" style="text-align: right;"><b>LIC. RELEVO : </b></td><td colspan="3"z> <?php echo $datos_viaje[0]['relevo_licencia']; ?> </td></tr>
                        <tr><td colspan="2" style="text-align: right;"><b>AYUDANTE: </b></td><td colspan="3"z> <?php echo $datos_viaje[0]['ayudante_apellidos']." ".$datos_viaje[0]['ayudante_nombres']; ?> </td></tr>
                    </table>
                    

            </center>                      
     </td>
    </tr>

    <tr style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;">
        <td>#</td>
        <td>PASAJERO</td>
        <td>C.I.</td>
        <td>NUM</td>
        <td>EQUIPAJE</td>
    </tr>
        
        
        <?php          
            $i = 0;
            foreach ($lista_pasajeros as $lista){  ?>
            
                    <tr style="border-bottom-style: solid; border-left: solid 1px; border-bottom-style: solid; border-bottom-width: 1px;">
                        <td style="padding: 0; padding-right:3px; text-align: right;"><?php echo ++$i." "; ?></td>
                        <td style="padding: 0; padding-right:3px; "><?php echo $lista["pasaje_nombre"]; ?></td>
                        <td style="padding: 0; padding-right:3px; "><?php echo $lista["pasaje_documento"]; ?></td>
                        <td style="padding: 0; padding-right:3px; text-align: center; "><?php echo $lista["pasaje_numero"]; ?></td>
                        <td style="padding: 0; padding-right:3px; text-align: center;"><?php echo $lista["pasaje_detalleequipaje"]; ?></td>


                    </tr>
            <?php } ?>
    </table>
 
    






</td>    
</tr>    
</table>
