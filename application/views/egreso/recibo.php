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
        font-size: 15px;
        line-height: 20px;
        padding: 0 20px;
        text-align: justify;
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
        <div class="left1">   
 <td><img src="/ximpleman_web/resources/images/1542385883.png";  style="width:100px;height:100px"> </td></div>
 <div class="medio1" align="center">       <h2 align="center"><b>EMPRESA</b></h2>

 Av. Ballivivian #666 <br>
 Telf: 666666-7777777 <br>
 COCHABAMBA-BOLIVIA</div>
     <div class="right1">        <div class="box1" ><h2><b>Recibo de egreso</b></h2>
             Numero: <b><?php echo $egresos[0]['egreso_id'];?></b>  <br>
             Numero transaccion: <b><?php echo$egresos[0]['egreso_numero'];?></b>  </div>  </div>

            </div>       
           <div class="row" style="padding-left: 17%;">
                       <div class="left">
                Fecha y Hora: 
                            <b><?php echo$egresos[0]['egreso_fecha'];?></b>            
                 
            </div>
            <div class="right">
                Apellidos y Nombre(s): <b><?php echo$egresos[0]['egreso_nombre'];?></b>  
            </div>
        </div>
      
                            
 <div class="box3">            

              <div class="box2">                        
                        
                        <th>MONTO:  </th>
                            
                            <td><?php echo$egresos[0]['egreso_monto'];?><?php echo$egresos[0]['egreso_moneda'];?></td>                      
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
 <div class="right" style="text-align: right">
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