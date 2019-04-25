<style type="text/css">

p {
    font-family: Arial;
    font-size: 7pt;
    line-height: 80%;   /*esta es la propiedad para el interlineado*/
    color: #000;
    padding: 5px;
}

interlineado {
    font-family: Arial;
    font-size: 7pt;
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
  //border: 1px solid #000;
  border-collapse: collapse;
  padding: 0;
  margin: 0;
}
td {
  //border: 1px solid #000;
  //text-align: center;
  padding: 0px;
  /* Alto de las celdas */
  height: 10px;
font-family: Arial;
font-size: 7pt;   
margin: 0;
margin-bottom: 0;
margin-top: 0;
padding: 0;


}
tr {
  //border: 1px solid #000;
  //text-align: center;
  padding: 0px;
  /* Alto de las celdas */
  height: 10px;
font-family: Arial;
font-size: 7pt;   
margin: 0;
margin-bottom: 0;
margin-top: 0;
}

td {
  //border: 1px solid #000;
  //text-align: center;
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
<p>
<font face="Arial">

    <table class="table" style="width: 20cm; padding: 0;" >
        <tr style="padding: 0;">
            <td  style="padding: 0;">
                    
                <center>
                
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="80" height="60"><br>                    
                    <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="1" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->                    
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
<!--                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>                    -->
                
                </center>
            </td>
            <td  style="padding: 0;">
                <center>
                 
                        
                    <br>
                    <font size="3" face="Arial"><b><?php echo "NOTA DE PEDIDO"; ?></b></font><br>
                    <font size="3" face="Arial"><b><?php echo "Nº 000".$pedido[0]['pedido_id']; ?></b></font><br>
                    <font size="1" face="Arial"><b><?php echo $pedido[0]['pedido_fecha']; ?></b></font><br>
                    
                </center>                
            </td>
            <td  style="padding: 0;">

                        <font size="1" face="Arial">
                            <br><b>CLIENTE: </b><?php echo $pedido[0]['cliente_nombre']; ?>
                            <br><b>CÓDIGO: </b><?php echo $pedido[0]['cliente_codigo']; ?>
                            <br><b>DIRECCIÓN: </b><?php echo $pedido[0]['cliente_direccion']; ?>
                            <br><b>TELÉF.: </b><?php echo $pedido[0]['cliente_telefono']; ?>                    
                        </font>

              
            </td>
        </tr>
    </table>
 
    <table class="table" style="width: 20cm; height: 1px; padding: 0;" >
    
        <tr  style="border-bottom: solid; padding: 0;">
            <!--<th>#</th>-->
            <th><center>CANT</center></th>
            <th><center>DESCRIPCIÓN</center></th>
            <th><center>PREC.UNIT</th>
            <th><center>TOTAL</th>
        </tr>
        
        <?php 
        
            $i = 1;
            $total_final = 0;
            foreach($pedido as $p){
                $total_final += $p['detalleped_total'];
                
        ?>
        
            <tr style="padding: 0;">
<!--                <td>
                    <?php echo $i++; ?>
                </td>-->
                <td>
                    <center>
                        <?php echo $p['detalleped_cantidad']; ?>
                    </center>
                </td>
                <td>
                    <?php echo $p['producto_nombre']; ?>
                </td>
                <td align="right">
                    
                    <?php echo number_format($p['detalleped_precio'],2,".",","); ?>
                    
                </td>
                <td align="right">
                    <?php echo number_format($p['detalleped_total'],2,".",","); ?>
                </td>
            </tr>
        <?php 
            }
        ?>
        <tr align="right" style="border-top: solid; border-bottom: solid;">
<!--            <th></th>-->
            <td colspan="3"><font size="3"><b>Total Bs</b></font></td>
<!--            <th></th>
            <th></th>-->
            <td align="right"><font size="3"><b> <?php echo number_format($total_final,2,".",","); ?></b></font></td>
        </tr>                        

    </table>    
</font>

<font size="1"><b>NOTA: </b><?php echo $pedido[0]['pedido_glosa']; ?></font>
<table class="table" style="width: 20cm;">
        <tr>
            <td>
                <center>
                    __________________________<br>
                            ENTREGE CONFORME
                </center>  
            </td>
            <td>
            </td>
            <td>
                <center>
                    __________________________<br>
                            RECIBI CONFORME
                </center>  
            </td>
        </tr>
    </table>

</p>