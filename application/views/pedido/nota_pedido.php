<style type="text/css">


p {
    font-family: Arial;
    font-size: 7pt;
    line-height: 120%;   /*esta es la propiedad para el interlineado*/
    color: #000;
    padding: 10px;
}
interlineado {
    font-family: Arial;
    font-size: 7pt;
    line-height: 80%;   /*esta es la propiedad para el interlineado*/
    color: #000;
    padding: 10px;
}

div {
line-height: 80%;   /*esta es la propiedad para el interlineado*/    
margin-top: 0px;
margin-right: 0px;
margin-bottom: 0px;
margin-left: 10px;
margin: 0px;
}


table{
line-height: 80%;   /*esta es la propiedad para el interlineado*/    
width : 7cm;
margin : 0 0 0px 0;
padding : 0 0 0 0;
border-spacing : 0 0;
border-collapse : collapse;
font-family: Arial narrow;
font-size: 7pt;  

}

td {
margin : 0px 0px 0px 0px;    
line-height: 80%;   /*esta es la propiedad para el interlineado*/    

}

th {
margin : 0px 0px 0px 0px;    
line-height: 80%;   /*esta es la propiedad para el interlineado*/    

}

td#comentario {
vertical-align : bottom;
border-spacing : 0;
}
div#content {
line-height: 80%;   /*esta es la propiedad para el interlineado*/    
background : #ddd;
font-size : 7px;
margin : 0 0 0 0;
padding : 0 5px 0 5px;
border-left : 1px solid #aaa;
border-right : 1px solid #aaa;
border-bottom : 1px solid #aaa;
}
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

<font face="Arial">

    <table class="table" style="width: 18cm;">
        <tr>
            <td>
                    
                <center>
                <p>
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="80" height="60"><br>                    
                    <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="1" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->                    
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
<!--                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>                    -->
                </p>
                </center>
            </td>
            <td>
                <center>
                    <p>
                        
                    <br>
                    <font size="3" face="Arial"><b><?php echo "NOTA DE PEDIDO"; ?></b></font><br>
                    <font size="3" face="Arial"><b><?php echo "Nº 000".$pedido[0]['pedido_id']; ?></b></font><br>
                    <font size="1" face="Arial"><b><?php echo $pedido[0]['pedido_fecha']; ?></b></font><br>
                    </p>
                </center>                
            </td>
            <td>
                <p>
                    
                <font size="1" face="Arial">
                    <br><b>CLIENTE: </b><?php echo $pedido[0]['cliente_nombre']; ?>
                    <br><b>CÓDIGO: </b><?php echo $pedido[0]['cliente_codigo']; ?>
                    <br><b>DIRECCIÓN: </b><?php echo $pedido[0]['cliente_direccion']; ?>
                    <br><b>TELÉF.: </b><?php echo $pedido[0]['cliente_telefono']; ?>                    
                </font>
                </p>
            </td>
        </tr>
    </table>

    <table class="table" id = "mitabla" style="width: 18cm; border-width:10px" cellpadding="0" cellspacing="0">
        <tr>
            <th>#</th>
            <th>Descripción</th>
            <th>Cant</th>
            <th>P.Unit</th>
            <th>Total</th>
        </tr>
        
        <?php 
        
            $i = 1;
            $total_final = 0;
            foreach($pedido as $p){
                $total_final += $p['detalleped_total'];
                
        ?>
        
            <tr style="height:10px;">
                <td>
                    <?php echo $i++; ?>
                </td>
                <td>
                    <?php echo $p['producto_nombre']; ?>
                </td>
                <td>
                    <center>
                        <?php echo $p['detalleped_cantidad']; ?>
                    </center>
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
        <tr>
            <th></th>
            <th colspan="3"><font size="2"> Total Bs</font></th>
<!--            <th></th>
            <th></th>-->
            <th><font size="2"> <?php echo number_format($total_final,2,".",","); ?></font></th>
        </tr>                        
    </table>    
</font>

<font size="1"><b>NOTA: </b><?php echo $pedido[0]['pedido_glosa']; ?></font>
<table class="table" style="width: 18cm;">
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