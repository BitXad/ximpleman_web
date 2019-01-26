
<!--<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
                                            /*function imprimir()
                                            {
                                                /*$('#paraboucher').css('max-width','7cm !important');*/
                                                /* window.print(); 
                                            }*/
    });
</script>-->
<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
 

<style type="text/css">


p {
    font-family: Arial;
    font-size: 7pt;
    line-height: 120%;   /*esta es la propiedad para el interlineado*/
    color: #000;
    padding: 10px;
}

div {
margin-top: 1px;
margin-right: 1px;
margin-bottom: 1px;
margin-left: 10px;
margin: 1px;
}


table{
width : 17cm;
margin : 1 1 1px 1;
padding : 1 1 1 1;
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
border-spacing : 1;
}

</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<!-------------------------------------------------------->


<table class="table" style="width: 18cm;" >
    <tr>
        <td>
                
            <center>
                               
<!--                    <img src="<?php echo base_url('resources/images/').$producto[0]['producto_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $producto[0]['producto_nombre']; ?></b></font><br>
                    <font size="2" face="Arial"><b><?php echo $producto[0]['producto_marca']; ?></b></font><br>
                    <font size="1" face="Arial"><b><?php echo "De: ".$producto[0]['producto_industria']; ?></b></font><br>

                    <font size="1" face="Arial"><?php echo $producto[0]['producto_costo']; ?><br>
                    <font size="1" face="Arial"><?php echo $producto[0]['producto_precio']; ?></font><br>
 -->
                    <br>

                    
                <font size="3" face="arial"><b>KARDEX DE EXISTENCIA</b></font> <br>
                <font size="1" face="arial"><b>FISICO - VALORADO</b></font> <br><br>
                <font size="1" face="arial"><b>PRODUCTO: <?php echo $producto[0]['producto_codigobarra']." ".$producto[0]['producto_nombre']; ?></b></font> <br>

                <!--<div class="panel panel-primary col-md-12" style="width: 6cm;">-->
<!--                <table style="width: 6cm;">
                    <tr>
                        <td style="font-family: arial; font-size: 8pt;">

                            <b>NIT:      </b><br>
                            <b>FACTURA No.:  </b><br>
                            <b>AUTORIZACION: </b>

                        </td>
                        <td style="font-family: arial; font-size: 8pt;">
                            <?php //echo $factura[0]['factura_autorizacion'] ?>           
                        </td>
                    </tr>
                </table>-->
<!--                </div>-->

            <!--<center>-->                        
                <!--<div class="panel" style="width: 7cm; ">-->
                <br>    
                <!--<font size="1px" face="arial"><?php echo $factura[0]['factura_actividad']?></font>-->


            </center>                      
        </td>
    </tr>
     
</table>


<!--<div class="box-body table-responsive">-->
    <!--<table class="table table-condensed" id="mitabla" style="font-size:10px" style="width: 17cm;">-->
<div class="container  table-responsive" >
    

    <table class="table table-responsive" id="mitabla" style="font-size:10px" style="width: 18cm;" >
    <tr style="font-family: Arial narrow">
        <th rowspan="2">
            FECHA
        </th>
        <th colspan="4">
            ENTRADAS
        </th>
        <th colspan="4">
            SALIDAS 
        </th>
        <th colspan="2">
           SALDOS   
        </th>
        <th rowspan="2">
             OBSERV.                       
        </th>


    </tr>
    <tr style="font-family: Arial narrow">
        <th>
            Nº<br>INGRESO              
        </th>
        <th>
            UNIDAD<br>COMP.
        </th>
        <th>
            COSTO<br>UNIT.                            
        </th>
        <th>
            IMPORTE<br>Bs.
        </th>
        <th>
            Nº DOC.<br>VENTA                            
        </th>
        <th>
            UNIDAD<br>VEND.                            
        </th>
        <th>
            COSTO<br>UNIT.                            
        </th>
        <th>
            IMPORTE<br>Bs.                            
        </th>
        <th>
            UNIDs.                            
        </th>
        <th>
            SALDO<br>Bs.
        </th>
    
            
        
        


    </tr>
    <?php $saldo = 0; $total_compras = 0; $total_ventas = 0;
        foreach($kardex as $k){ 
            $saldo += $k['unidad_comp'] - $k['unidad_vend'];
            $total_compras += $k['unidad_comp']; 
            $total_ventas += $k['unidad_vend'];
        ?>
    <tr align="center">    
       
 
            <td>
                <?php 
                
                echo $k['fecha']." - ".$k['hora']; ?>
            </td>
            <td>              
                <?php  if ($k['num_ingreso']<>0) echo $k['num_ingreso']; ?>
            </td>
            <td>
                <b> <?php   if ($k['unidad_comp']<>0) echo $k['unidad_comp']; ?></b>
            </td>
            <td>
                <?php   if ($k['costoc_unit']<>0) echo $k['costoc_unit']; ?>                
            </td>
            <td>
                <?php   if ($k['importe_ingreso']<>0) echo $k['importe_ingreso']; ?>
            </td>
            <td>
                <?php   if ($k['num_salida']<>0) echo $k['num_salida']; ?>              
            </td>
            <td>
                <b><?php   if ($k['unidad_vend']<>0) echo $k['unidad_vend']; ?></b>          
            </td>
            <td>
                <?php   if ($k['costov_unit']<>0) echo $k['costov_unit']; ?>                
            </td>
            <td>
                <?php   if ($k['importe_salida']<>0) echo $k['importe_salida']; ?>                
            </td>
            <td>
                <b><?php   echo $saldo; ?></b>
            </td>
            <td>
                <?php  echo $saldo * $k['costoc_unit']; ?>
            </td>
            <td>
                
            </td>
            
        </tr>
    <?php } ?> 
<tr>
        <th>
             
        </th>
        <th>
                         
        </th>
        <th>
            <small>ENTRADAS</small><br>
            <h5><b> <?php echo $total_compras; ?></b></h5>
        </th>
        <th>
                                      
        </th>
        <th>
           
        </th>
        <th>
                                       
        </th>
        <th>
            <small>SALIDAS</small><br>
            <h5><b><?php echo $total_ventas; ?></b></h5>                          
        </th>
        <th>
                                 
        </th>
        <th>
                                      
        </th>
        <th>
                                    
        </th>
        <th>
            <small>SALDOS</small><br>
            <h5><b><?php echo $saldo; ?></b></h5>
        </th>
        <th>
            
        </th>

    </tr>
        
        
</table>
</div>
<!--</div>-->

