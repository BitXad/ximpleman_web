 <script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
 <!--<script type="text/javascript">
    $(document).ready(function()
{
   var hola = document.getElementById('compra_id').value;
        if(hola!=null){
             window.print(); 
        }
});
</script>-->
 <style>
            body {
                text-align: left;
                 
        }
       hr {
  height: 2px;
  color: black;
  margin:0% 0% 0% 0%;
}
h3 {
  margin-bottom: 0;
  padding-bottom: 0;
  text-indent: 0; }
.box1 {
width:100%;
margin:0% 12%;

}
.box2 {

margin:0%;
border-top:2px solid black;
font-family: "Arial", Arial, Arial, arial;
    font-size: 11px;
    padding: 0px;
}


.box4 {
width:100%;
margin:0% 0% 0% 0%;
font-family: "Arial", Arial, Arial, arial;
    font-size: 11px;
border-bottom:1px solid black;
 padding: 0px;
}



    .box {
        overflow: hidden;
       
    }

    .content {
        min-height: 0;
     padding: 0;
       padding-left: 15px;
       font-family: "Arial", Arial, Arial, arial;
    font-size: 12px;
        text-align: justify;
    }

    .left {
        float: left;
        width: 50%;
    }

    .left .content {
       
    }

    .right {
        float: right;
        width: 50%;
    }

     .left1 {
        float: left;
        font-family: "Arial", Arial, Arial, arial;
    font-size: 11px;
        width: 25%;
      min-height: 0;
      text-indent: 0px;
    }
     .medio1 {
        float: left;
        width: 35%;
    }
       .right1 {
        float: right;
        width: 40%;
    }
    table th {
     
     background: rgb(234, 237, 237);
    text-align: center;
}
 table td {
     
    text-align: right;
    font-size: 10px;
    padding: 1px;
    margin: 1px;
    border: 1px;
}

#mitabla {
    /*font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;*/
    font-family: "Arial", Arial, Arial, arial;
    font-size: 11px;
    border-collapse: collapse;
    width: 100%;
}

#mitabla td {
    border: none;
    padding-top: 0px;
    padding-bottom: 0px;
    
}
#mitabla th {
    border-top:2px solid black;
    border-bottom:2px solid black;
    padding-top: 1px;
    padding-bottom: 1px;
    text-align: center;
    background-color: white;
    font-size: 12px;
    font-weight: bold;
}

#mitabla2 {
    /*font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;*/
    font-family: "Arial", Arial, Arial, arial;
    font-size: 11px;
    border-collapse: collapse;
    width: 100%;
}

#mitabla2 td {
    border: none;
    padding-top: 0px;
    padding-bottom: 0px;
    
}
#mitabla2 th {
    border: none;
    padding-top: 1px;
    padding-bottom: 1px;
    text-align: center;
    background-color: white;
    font-size: 12px;
    font-weight: bold;
}



         </style>
         
<?php $decimales = $parametro['parametro_decimales']; ?>
<input type="text" id="decimales" value="<?php echo $decimales; ?>" name="decimales"  hidden>
         
<table class="table table-striped" padding: 0;" >
    <tr>
        <td style="width: 25%; padding: 0; line-height:10px;" colspan="3">
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="80" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                

            </center>                      
        </td>
                   
        <td style="width: 50%; padding: 0" colspan="3"> 
            <center>
            
                <br><br>
                <font size="3" face="arial"><b>NOTA DE INGRESO DE MERCADERIA</b></font> <br>
                <font size="3" face="arial"><b>Nº 00<?php echo $compra[0]['compra_id']; ?></b></font> <br>
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

            </center>
        </td>
        <td style="width: 25%; padding: 0; text-align: left" >
                
                         
        <br><br><br><font size="2" face="Arial"> <b>PROVEEDOR: </b><?php echo $compra[0]['proveedor_nombre'];?><br>
        <b>FORMA DE PAGO: </b><?php echo $compra[0]['tipotrans_nombre'];?><br>
        <b>FECHA: </b><?php echo date('d/m/Y',strtotime($compra[0]['compra_fecha'])) ; ?> <?php echo $compra[0]['compra_hora'];?>      
        <?php //if ($compra[0]['documento_respaldo_id']==1){ ?>
        <br><b>FACTURA Nº: </b><?php echo $compra[0]['compra_numdoc'];?></font>
        <?php //} ?>
         
                   
        </td>
    </tr>
     
    
    
</table>       
<div class="box-body table-responsive"> 

        <table class="table" border-bottom="1" id="mitabla" style="padding: 0;">                        
                        <tr>
                            <th>#</th>
                            <th style="max-width: 10cm;">PRODUCTO</th>
                            <th>CODIGO</th>
                            <th>UNIDAD</th>
                            <th>CANT</th>
                            <th>COSTO</th>
                            <th>PRECIO</th>
                            <th>UTILIDAD</th>
                            <th>% UTILIDAD</th>
                            <th>SUBTOTAL</th>
                            <th>DESC.</th>
                            <th>D.GLOB</th>
                            <th>TOTAL</th>                        
                        </tr>
                    
                         <?php
                                $cont = 0;
                                $utilidad = 0;
                                $porcentaje_utilidad = 0;
                                $utilidad_total = 0;
                                $total_productos = 0;
                                
                             foreach($detalle_compra as $dc) {;
                                 $cont = $cont+1; ?>
                            
             <tr>
                            <td><?php echo $cont;?></td>
                            <td style="text-align: left; max-width: 10cm;"><?php echo $dc['producto_nombre'];?></td>                            
                            <td style="text-align: center;"><?php echo $dc['detallecomp_codigo'];?></td>

                            <?php
                            $cantidad = explode(".",$dc['detallecomp_cantidad']);

                             if ($cantidad[1] == 0) {  
                                 $lacantidad = $cantidad[0];  
                             }else{  
                                 $lacantidad = number_format($dc['detallecomp_cantidad'],$decimales,'.',',');  
                             }  
                             //echo $lacantidad;                             
                            
                            ?>
                            
                            <td><?php echo $dc['detallecomp_unidad'];?></td>
                            <td><?php 
                                    $total_productos += $dc['detallecomp_cantidad'];
                                    echo $lacantidad;?></td>
                            <td><?php echo number_format($dc['detallecomp_costo'],$decimales,'.',',');?></td>
                            <td><?php echo number_format($dc['detallecomp_precio'],$decimales,'.',',');?></td>
                            <td><?php 
                                    $utilidad = ($dc['detallecomp_precio'] - $dc['detallecomp_costo']) * $dc['detallecomp_cantidad'];
                                    $utilidad_total += $utilidad;
                                    echo number_format($utilidad,$decimales,'.',',');?></td>
                            <td><?php
                                if($dc['detallecomp_costo'] > 0){
                                    $porcentaje_utilidad = ($dc['detallecomp_precio'] - $dc['detallecomp_costo']) / $dc['detallecomp_costo'] * 100;
                                }else{
                                    $porcentaje_utilidad = 0;
                                }
                                echo number_format($porcentaje_utilidad,'2','.',',')."%";?></td>
                            <td><?php echo number_format($dc['detallecomp_subtotal'],$decimales,'.',',');?></td>
                            <td><?php echo number_format($dc['detallecomp_descuento'],$decimales,'.',',');?></td>
                            <td><?php echo number_format($dc['detallecomp_descglobal'],$decimales,'.',',');?></td>
                            <td><?php echo number_format($dc['detallecomp_total'],$decimales,'.',',');?></td>
                          
        </tr> 
                    
                           <?php } ?>

                        <tr>
                            <th colspan="2">TOTALES</th>
                            <th></th>
                            <th></th>
                            <th><?php echo number_format($total_productos,$decimales,'.',',');?></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?php echo number_format( $compra[0]['compra_subtotal'],$decimales,'.',',');?></th>
                        </tr>
</table>
 
</div>
   <!--<hr style="border:1px solid black;width: 18cm; margin: 0;padding: 0">-->
   <font size="1" face="arial"><b>Nota.- </b><?php echo $compra[0]['compra_glosa'];?></font> 
        
        

<div class="box-body table-responsive"> 

       <table class="table table-striped" border-bottom="0" id="mitabla2" style="width: 18cm; padding: 0;"> 
                    <tr>
                        <td>TOTAL COMPRA: </td><td><?php echo number_format( $compra[0]['compra_subtotal'],$decimales,'.',',');?></td>
                    </tr>                      
                    <tr>
                       <td>TOTAL DESCUENTO: </td><td><?php echo number_format( $compra[0]['compra_descuento'],$decimales,'.',',');?></td>
                    </tr>
                    <tr>
                        <td>DESC. GLOBAL: </td><td><?php echo  number_format($compra[0]['compra_descglobal'],$decimales,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><b>TOTAL FINAL: </b></td> <td><b><?php echo  number_format($compra[0]['compra_totalfinal'],$decimales,'.',',');?></b></td>
                    </tr>
                    <tr>
                        <td><b>UTILIDAD TOTAL: </b></td> <td><b> <?php echo number_format($utilidad_total,$decimales,'.',',');?></b></td>
                    </tr>
                    <tr>
                        <td><b>MARGEN UTILIDAD PROM.: </b></td> <td><b> <?php echo number_format($utilidad_total/$compra[0]['compra_totalfinal'] * 100,'2','.',',')." %";?></b></td>
                    </tr>
                    <?php if ($compra[0]['tipotrans_id']==2) { ?>
                    <tr>
                        <td><b>A CUENTA: </b></td> <td><b><?php echo  number_format($credito['credito_cuotainicial'],$decimales,'.',',');?></b></td>
                    </tr>
                    <tr>
                        <td><b>SALDO: </b></td> <td><b><?php echo  number_format($credito['credito_monto'],$decimales,'.',',');?></b></td>
                    </tr> 
                    <?php } ?>  
                                 
 
</table>

</div>
<br>
<table class="table" style="width: 20cm;">
        <tr>
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
        </tr>
</table>
 