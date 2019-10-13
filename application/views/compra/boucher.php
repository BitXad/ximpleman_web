

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
.box-body {
padding-top: 0px;
  
}

table{
width : 7cm;
margin : 0 0 0px 0;
padding : 0 0 0 0;
border-spacing : 0 0;
border-collapse : collapse;
font-family: Arial narrow;
font-size: 7pt;  
}
th {
text-align: center;
}
td{
border: none!important;
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
#mitabla td {
    border: none;
    padding-top: 0px;
    padding-bottom: 0px;
    
}
#mitabla th {
    border: none;
    padding-top: 1px;
    padding-bottom: 1px;
    text-align: center;
    background-color: white;
    font-size: 12px;
    font-weight: bold;
}
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->

<!-------------------------------------------------------->


<table class="table" style="width: 7cm; margin-bottom: 0px;" >
    <tr>
        <td style="padding-bottom: 0px;">
                
            <center>
                               
                    <!--<img src="<?php echo base_url('resources/images/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>-->
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    </font><br>
                    
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>
                
                    <br>
                   

                <font size="3" face="arial"><b>COMPRA</b></font> <br>
                <font size="1" face="arial"><b>NUMERO: 00<?php echo $compra[0]['compra_id']; ?></b></font> <br>
                _______________________________________________                
                   
                <!--<div class="panel panel-primary col-md-12" style="width: 6cm;">-->
                <table style="width: 6cm;">
                    <tr>
                        <td style="font-family: arial; font-size: 8pt;">

                            <b>TIPO TRANSACCION:  </b><br>
                            <b>FORMA DE PAGO:</b>
                           

                        </td>
                        <td style="font-family: arial; font-size: 8pt;">
                            
                            <?php echo $compra[0]['tipotrans_nombre']; ?> <br>
                            <?php echo $compra[0]['forma_nombre']; ?>     
                        </td>
                    </tr>
                </table>
<!--                </div>-->

            <!--<center>-->                        
                <!--<div class="panel" style="width: 7cm; ">-->
               
               
                _______________________________________________
                <br> 
                <?php $fecha = new DateTime($compra[0]['compra_fecha']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                    <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a; ?> <br>
                    
                    <b>PROVEEDOR: </b><?php echo $compra[0]['proveedor_nombre'].""; ?>
                <br>_______________________________________________

            </center>                      
        </td>
    </tr>
     
</table>

      
  
           <div class="box-body ">  

        <table class="table table-striped table-condensed" border-bottom="1" id="mitabla" style="width: 7cm;">                        
                        <tr>

                           
                            <th>CAN.</th>
                            
                            <th style="text-align: center;padding-left: 0px;padding-right: 0px;">CONCEPTO</th>
                            
                            
                            <th>UNIT.</th>
                            
                            <?php 

                            $desc = $compra[0]['compra_descuento'];
                            if ($desc!=0) {  ?>
                            <th>SUBT.</th>
                            <th>DESC.</th>
                            <?php } ?>
                            <th>TOTAL</th>
                        
                       
                        </tr>
                    
                         <?php
                                $cont = 0;
                             foreach($detalle_compra as $i[0]) {;
                                 $cont = $cont+1; ?>
                            
             <tr>
                            <td><?php echo $i[0]['detallecomp_cantidad'];?></td>
                            
                            <td style="text-align: left;padding-left: 0px;padding-right: 0px;"><?php echo $i[0]['producto_nombre'];?></td>                            
                            
                            
                            <td style="text-align: right;"><?php echo number_format($i[0]['detallecomp_costo'],'2','.',',');?></td>
                            
                            <?php if ($desc!=0) {  ?>
                            <td style="text-align: right;"><?php echo number_format($i[0]['detallecomp_subtotal'],'2','.',',');?></td>
                            <td style="text-align: right;"><?php echo number_format($i[0]['detallecomp_descuento'],'2','.',',');?></td>
                            <?php } ?>
                            <td style="text-align: right;"><?php echo number_format($i[0]['detallecomp_total'],'2','.',',');?></td>
                          
        </tr> 
                    
                           <?php } ?>

</table>
 
   <div class="box6" style="padding: 0px;">
           <div class="left">
                <div class="row" style="padding-left: 22px; font-size: 11px;">Nota.- 
                            <b><?php echo $compra[0]['compra_glosa'];?> </b>
          </div></div>
          </div>
          <div style="font-family: arial; font-size: 8pt;">
        <br>____________________________________________
        </div>
          
   
<table class="table" style="max-width: 7cm;">
    <tr>
        
        <td align="right">
            
            
            <font size="1">
                 <b>
                <?php echo "SUBTOTAL Bs: ".number_format($compra[0]['compra_subtotal'] ,2,'.',','); ?><br>
            </b>
             <b>
                <?php echo "TOTAL DESCUENTO Bs: ".number_format($compra[0]['compra_descuento'] ,2,'.',','); ?><br>
            </b>
              <b>
                <?php echo "DESC. GLOBAL Bs: ".number_format($compra[0]['compra_descglobal'] ,2,'.',','); ?><br>
            </b>
        </font>
            <font size="2">   
            <b>
                <?php echo "TOTAL FINAL Bs: ".number_format($compra[0]['compra_totalfinal'] ,2,'.',','); ?><br>
            </b>
            </font>
            <font size="1" face="arial narrow">
                <?php echo "SON: ".num_to_letras($compra[0]['compra_totalfinal'],' Bolivianos'); ?><br>      
            </font>
            <?php if ($compra[0]['tipotrans_id']==2) { ?>
                    <font size="1">
                        <b>A CUENTA: <?php echo  number_format($credito['credito_cuotainicial'],'2','.',',');?></b><br>
                   
                        <b>SALDO: <?php echo  number_format($credito['credito_monto'],'2','.',',');?></b>
                    </font> 
                    <?php } ?>  
           
            
        </td>          
    </tr>
   
     
    <tr >
          <td style="padding-top: 0px;">
               USUARIO: <b><?php echo $compra[0]['usuario_nombre']; ?></b>
           
         </td>
    </tr>    
    
</table>
<table class="table" style="max-width: 7cm; margin-top: 15px;">
            <tr>
                <td> <center>
                
                        <?php echo "------------------------------------"; ?><br>
                        <?php echo "RECIBI CONFORME"; ?><br>
                    
                    </center>
                </td>
                <td width="20">
                    <?php echo "     "; ?><br>
                    <?php echo "     "; ?><br>
                </td>
                <td>
                    <center>

                        <?php echo "------------------------------------"; ?><br>
                        <?php echo "ENTREGUE CONFORME"; ?><br>   

                    </center>
                </td>
            </tr>
        </table>