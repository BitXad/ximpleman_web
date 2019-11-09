<style>@page 
            body {
                text-align: left;
        }
      
.box1 {
width:100%;
margin:0% 10%;
padding:10px;
align-content:  right;
border:2px solid black;
border-bottom: 0px;
border-right: 0px;
}
.box2 {

margin:2% 15%;
padding:5px;
border:2px solid black;
}

.box3 {
width:100%;
margin:0% 0% 0% 0%;
padding:1px;
border:2px solid black;
}
.box4 {
width:100%;
margin:0% 0% 0% 0%;
padding-top:40px;
border:2px solid black;
border-top: 0px;
}


    .box {
        overflow: hidden;
    }

    .content {
        font-size: 13px;
        line-height: 20px;
        padding: 0 20px;
        /*text-align: justify;*/
    }

    .left {
        float: left;
        width: 50%;
    }

    .left .content {
        border-right: 5px solid #4BB495  ;
    }

    .right {
        float: right;
        width: 50%;
    }

     .left1 {
        float: left;
        width: 25%;
    }
     .medio1 {
        float: left;
        width: 35%;
    }
       .right1 {
        float: right;
        width: 40%;
    }

         </style>
         <div class="box">
        <div class="row"> 
        <link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<table class="table" style="width: 100%; padding: 0;" >
    <tr>
        <td style="width: 25%; padding: 0; line-height:10px;" >
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                

            </center>                      
        </td>
                   
        <td style="width: 25%; padding: 0" > 
            <center>
            
                <br>
                <font size="3" face="arial"><b>RECIBO DE GRESO</b></font> <br>
                <font size="2" face="arial"><b>Numero: <?php echo $egresos[0]['egreso_id']; ?></b></font> <br>
                <font size="2" face="arial"><b>Numero transacción: <?php echo $egresos[0]['egreso_numero']; ?></b></font> <br>
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

            </center>
        </td>
        <td style="width: 25%; padding: 0; text-align: left" >
                
                         
       
                         
         
                   
        </td>
    </tr>
     
    
    
</table>
           <div class="row" style="padding-left: 17%;">
                       <div class="left">
                <font size="2" face="Arial">Fecha y Hora: 
                            <b><?php echo date('d/m/Y  H:i:s',strtotime($egresos[0]['egreso_fecha']));?></b> </font>          
                 
            </div>
            <div class="right">
                <font size="2" face="Arial">Apellidos y Nombre(s): <b><?php echo$egresos[0]['egreso_nombre'];?></b>  </font>
            </div>
        </div>
      
                            
 <div class="box3">            

              <div class="box2">                        
                        
                        <th>MONTO:  </th>
                            
                            <td><?php echo number_format($egresos[0]['egreso_monto'],'2','.',',');?> <?php echo$egresos[0]['egreso_moneda'];?></td>                      
    </div>

              <div class="box2">
                        <th>CONCEPTO:    </th>
                             <td><?php echo$egresos[0]['egreso_categoria'];?></td>
                             <td>(<?php echo$egresos[0]['egreso_concepto'];?>)</td>


              </div> 

              <div class="box2">
                        <th>SON:    </th>
                             <td> <?php echo num_to_letras($egresos[0]['egreso_monto']);?> </td>
                

              </div> 

           
             <div class="box2">          
            <th>CAJERO:  </th>
            <td><?php echo$egresos[0]['usuario_nombre'];?></td>
             </div> 
</div>
 <div class="right" style="text-align: right; padding-right: 10px;">
                 <font size="2" style=""><?php echo date("d/m/Y   H:i:s  .")  ; ?></font>   
                 
            </div>
 <div class="box4" >            

<center>
              <div class="row" style="padding-left: 15%;">
            <div class="left">
                
                <?php echo "---------------------------------"; ?><br>
                    Firma interesado.
               
            </div>
            <div class="left1">
                
                <?php echo "---------------------------------"; ?><br>
                    Firma cajero.
                
            </div>
        </div>
 </center>
</div>
</div>