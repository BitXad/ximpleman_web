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

.box3 {
width:100%;
margin:0% 0% 0% 0%;
font-family: "Arial", Arial, Arial, arial;
    font-size: 11px;
border-bottom:2px solid black;
border-top:2px solid black;
 padding: 0px;
}
.box4 {
width:100%;
margin:0% 0% 0% 0%;
font-family: "Arial", Arial, Arial, arial;
    font-size: 11px;
border-bottom:2px solid black;
 padding: 0px;
}
.box6 {
width:100%;
margin:0% 0% 0% 0%;
font-family: "Arial", Arial, Arial, arial;
    font-size: 11px;
border:2px solid black;
border-top: 0px;
border-bottom: 0px;
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

         </style>
    <link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">     
       <div class="box" > 
        <div class="row"> 
       
<div class="cuerpo">
                    <div class="columna_derecha">
                        <center>
                          <table>
                            <tr>
                              <td> Proveedor: <b><?php echo $compra[0]['proveedor_nombre'];?></b><br>
                          Forma de Pago: <b><?php echo $compra[0]['tipotrans_nombre'];?></b><br>
                          Fecha: <b><?php echo date('d/m/Y',strtotime($compra[0]['compra_fecha'])) ; ?> <?php echo $compra[0]['compra_hora'];?></b></td>
                          <td width="2%"></td>
                          <td><img src="<?php echo base_url('resources/images/empresas/'.$empresa[0]["empresa_imagen"].''); ?>"  style="width:80px;height:80px"></td>
                            </tr>
                          </table>
                         
                        
                    </center>
                    </div>
                    <div class="columna_izquierda">
                       <center>  <font size="4"><b><u><?php echo $empresa[0]['empresa_nombre']; ?></u></b></font><br>
                        <?php echo $empresa[0]['empresa_zona']; ?><br>
                        <?php echo $empresa[0]['empresa_direccion']; ?><br>
                        <?php echo $empresa[0]['empresa_telefono']; ?>
                    </div> </center>
                    <div class="columna_central">
                        <center>      <h3 class="box-title"><u>BOLETA DE COMPRA</u></h3>
                           <font size="3">Numero: <b><?php echo $compra[0]['compra_id'];?></b></font> <br>
                           <?php echo date('d/m/Y H:i:s'); ?> <br>
                           

                </center>
                    </div>

            </div>       
      
          </div>
         <div class="row">               
 <div class="box3">

  
           <div class="box-body table-responsive">  

        <table class="table" border-bottom="1" id="mitabla">                        
                        <tr>

                            
                            <th>ITEM</th>
                            <th>CODIGO</th>
                            <th>CONCEPTO</th>
                            <th>UNIDAD</th>
                            <th>CANT.</th>
                            <th>UNIT.</th>
                            <th>SUBTOTAL</th>
                            <th>DESC.</th>
                            <th>D.GLOB</th>
                            <th>TOTAL</th>
                        
                       
                        </tr>
                    
                         <?php
                                $cont = 0;
                             foreach($detalle_compra as $i[0]) {;
                                 $cont = $cont+1; ?>
                            
             <tr>
                            <td><?php echo $cont;?></td>
                            <td style="text-align: center;"><?php echo $i[0]['detallecomp_codigo'];?></td>
                            <td style="text-align: left;"><?php echo $i[0]['producto_nombre'];?></td>                            
                            <td><?php echo $i[0]['detallecomp_unidad'];?></td>
                            <td><?php echo $i[0]['detallecomp_cantidad'];?></td>
                            <td><?php echo number_format($i[0]['detallecomp_costo'],'2','.',',');?></td>
                            <td><?php echo number_format($i[0]['detallecomp_subtotal'],'2','.',',');?></td>
                            <td><?php echo number_format($i[0]['detallecomp_descuento'],'2','.',',');?></td>
                            <td><?php echo number_format($i[0]['detallecomp_descglobal'],'2','.',',');?></td>
                            <td><?php echo number_format($i[0]['detallecomp_total'],'2','.',',');?></td>
                          
        </tr> 
                    
                           <?php } ?>

</table>
 </div>
 </div>
   <div class="box6">
           <div class="left">
                <div class="content">Nota.- 
                            <b><?php echo $compra[0]['compra_glosa'];?> </b>
          </div></div>
          </div>
<div class="box4">
<div class="box-body table-responsive"> 

       <table class="table table-striped table-condensed" border-bottom="0"> 
                    <tr>
                        <td>TOTAL COMPRA</td><td><?php echo number_format( $compra[0]['compra_subtotal'],'2','.',',');?></td>
                    </tr>                      
                    <tr>
                       <td>TOTAL DESCUENTO</td><td><?php echo number_format( $compra[0]['compra_descuento'],'2','.',',');?></td>
                    </tr>
                    <tr>
                        <td>DESC. GLOBAL</td><td><?php echo  number_format($compra[0]['compra_descglobal'],'2','.',',');?></td>
                    </tr>
                    <tr>
                        <td><b>TOTAL FINAL  <?php echo $compra[0]['moneda_descripcion'];?>.</b></td> <td><b><?php echo  number_format($compra[0]['compra_totalfinal'],'2','.',',');?></b></td>
                    </tr>
                    <?php if ($compra[0]['tipotrans_id']==2) { ?>
                    <tr>
                        <td><b>A CUENTA</b></td> <td><b><?php echo  number_format($credito['credito_cuotainicial'],'2','.',',');?></b></td>
                    </tr>
                    <tr>
                        <td><b>SALDO</b></td> <td><b><?php echo  number_format($credito['credito_monto'],'2','.',',');?></b></td>
                    </tr> 
                    <?php } ?>  
                                 
 
</table>

</div></div>
<center>
                    <div class="col-md-12" style="margin-top: 50px; ">

                    <?php echo "-----------------------------------------------------"; ?><br>
                    <?php echo "RESPONSABLE"; ?><br>
                    <?php echo $compra[0]['usuario_nombre']; ?>
                    </div></center>
</div></div>