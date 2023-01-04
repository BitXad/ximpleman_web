<?php
    if($this->session->flashdata('msg')){
        echo '<p>'.$this->session->flashdata('msg').'</p>';
    }
//    echo '<hr>';
//    echo '<h2>Bienvenido </h2>';
?>

<!**************** inicio bashboard ****************************>

<div class="row">
    <div class="col-md-12">
        
        <div class="col-md-3">
            <div class="alert alert-warning" role="alert">
                <div class="container">
                    
                
                <div class="col-md-1">
                    <center>
                        <font size="15"><i class="fa fa-cart-arrow-down"></i> </font>                   
                    </center>
                </div>
                    
                <div class="col-md-2">               
                    
                    <span><font size="3" face="arial black"> <?php echo $ventas[0]['cantidad_ventas']; ?></font></span> <br> Ventas realizadas <br> 
                    <span><font size="3" face="arial black">  <?php echo number_format($ventas[0]['total_ventas'],2,'.',',')." Bs"; ?></font></span> <br>En ventas                 
                
                </div>
                    
                </div>
                  <!--<button type="button" class="btn btn-facebook btn-xs btn-block"><b>Ventas</b></button>-->
                 <a href="<?php echo base_url('venta/ventas');?>" class="btn btn-facebook btn-xs btn-block"> <b>Ventas</b></a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="alert alert-danger" role="alert">
                <div class="container">
                    
                
                <div class="col-sm-1">
                    <center>
                        <font size="15"><i class="fa fa-book"></i> </font>                    
                    </center>
                </div>
                    
                <div class="col-sm-2">               
                    
                    <span><font size="3" face="arial black"> <?php echo $pedidos[0]['cantidad_pedidos']; ?></font></span> <br> Redidos realizados <br> 
                    <span><font size="3" face="arial black"> <?php echo number_format($pedidos[0]['total_pedidos'],2,'.',',')." Bs"; ?></font></span> <br>En pedidos                 
                
                </div>
                    
                </div>
                <a href="<?php echo base_url('pedido');?>" class="btn btn-facebook btn-xs btn-block"> <b>Pedidos</b></a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="alert alert-info" role="alert">
                <div class="container">
                    
                
                <div class="col-sm-1">
                    <center>
                        <font size="15"><i class="fa fa-cubes"></i> </font>                    
                    </center>
                </div>
                    
                <div class="col-sm-2">               
                    
                    <span><font size="3" face="arial black"> <?php echo $compras[0]['cantidad_compras']; ?></font></span> <br> Compras realizados <br> 
                    <span><font size="3" face="arial black"> <?php echo number_format($compras[0]['total_compras'],2,'.',',')." Bs"; ?></font></span> <br>En compras                 
                
                </div>
                    
                </div>
                <a href="<?php echo base_url('Compra');?>" class="btn btn-facebook btn-xs btn-block"> <b>Compras</b></a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="alert alert-success" role="alert">
                <div class="container">
                    
                
                <div class="col-sm-1">
                    <center>
                        <font size="15"><i class="fa fa-group"></i> </font>                    
                    </center>
                </div>
                    
                <div class="col-sm-2">
                    <br> <br>
                    <span><font size="3" face="arial black"> <?php echo $clientes[0]['total_clientes']; ?></font></span> <br> Clientes activos 
                    <!--<span><font size="3" face="arial black"> <?php echo $compras[0]['total_compras']." Bs"; ?></font></span> <br>En compras--> 
                
                </div>
                    
                </div>
                <a href="<?php echo base_url('cliente');?>" class="btn btn-facebook btn-xs btn-block"> <b>Clientes</b></a>
            </div>
        </div>
        
    </div>
</div>

<!--

<h1><span class="grey">1</span>Un circulo gris con un número interior</h1>
 
<h1><span class="red">2</span>Un circulo rojo con un número interior</h1>
 
<h1><span class="blue">3</span>Un circulo azul con un número interior</h1>
 
<h1><span class="green">4</span>Un circulo verde con un número interior</h1>
 
<h1><span class="pink">5</span>Un circulo rosa con un número interior</h1>

<!**************** fin dashboard ****************************>
    
<style type="text/css">

/* Círculos de colores numerados */
span.red {
  background: red;
   border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em; 
}

span.grey {
  background: #cccccc;
  border-radius: 2.8em;
  -moz-border-radius: 2.8em;
  -webkit-border-radius: 2.8em;
  color: #fff;
  display: inline-block;
  font-weight: bold;
  line-height: 5.6em;
  margin-right: 15px;
  text-align: center;
  width: 5.6em; 
}

span.green {
  background: #5EA226;
  border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em; 
}

span.blue {
  background: #5178D0;
  border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em; 
}

span.pink {
  background: #EF0BD8;
  border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em; 
}    
    
</style>-->