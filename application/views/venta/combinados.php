
<script src="<?php echo base_url('resources/js/pasar.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    function final(){
  document.getElementById('loader').style.display = 'block';
}
 function imprimir()
        {
             window.print(); 
        }
</script>
<link href="<?php echo base_url('resources/css/mitabladetalleimpresion.css'); ?>" rel="stylesheet">

<div class="box-header">
    <center>
                <h3 class="box-title">REPORTE DE EMBARQUE</h3>
    </center>            
</div>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<div class="row">
    <div class="col-md-12">

<div class="panel panel-primary col-md-12" style="border:none;" >
    <div class="col-md-12">
                        <h4 align="center" class="no-print"><p>
                            Seleccione el/los usuario(s) de los cuales desea buscar las ventas.<br>
                        </p></h4>

                        <div class="col-md-4 no-print">
                            
                            <select name="usu" style=" color: #fff; background-color: #31708f;border-color: #337ab7; width: 100%;" id="usu" size="6" class="panel panel-success no-print">
                                
                                <?php 
                                foreach($all_usuario as $usuario)
                                {
                                    $selected = ($usuario['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4 no-print" align="center">
                            <input type="button" class="btn btn-primary btn-sm" name="pasarA&ntilde;o3" onClick="pasar('usu','usuario_id')" value="A&ntilde;adir -->>" style="margin:  10px;"><br>
                            <input type="button" class="btn btn-primary btn-sm" name="pasarA&ntilde;o4" onClick="pasar('usuario_id','usu')" value="<<-- Quitar" style="margin:  10px;">
                        </div>

                        <div class="col-md-4" style="padding-bottom:-1s0px;font-size: 10px;" id="navTesiss">
                            Usuario(s):<select multiple id="usuario_id"  name="usuario_id"  style="padding-bottom:-10px;color: #fff; background-color: #31708f;border:none; width: 100%;"  >
                                <option value="-" >-</option>
                            </select>
                        </div>

                        
    </div>

               
        <div class="col-md-6" style="padding-left:45px; padding-top:0px;">
            
            <br class="no-print">        
        <div class="row" style="font-size: 10px;">
            Desde: <input type="date" class="btn btn-primary btn-sm " style="border:none;" id="fecha_desde" name="fecha_desde" required="true" value="<?php echo date('Y-m-d')?>">
       
            Hasta: <input type="date" class="btn btn-primary btn-sm" style="border:none;" id="fecha_hasta" name="fecha_hasta" required="true"  value="<?php echo date('Y-m-d')?>">
        </div>
        
          
       </div>
        <div class="col-md-3 no-print" style="padding-top:17px;">
            
<!--            <a href="<?php echo site_url('pedido/crearpedido'); ?>" class="btn btn-success btn-sm"><span class="fa fa-cart-arrow-down"></span> Nuevo pedido</a>-->
            <button class="btn btn-primary btn-sm  no-print" onclick="buscar_fecha_ven(),final()" >
               
                <span class="fa fa-search"></span>   Realizar Busqueda  
                
          </button>
           <div class="row no-print" id='loader'  style='display:none;'>
                        <center>
                            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >        
                        </center>
                    </div> 
        </div>
        <div class="col-md-3 no-print" style="padding-top:17px;">
            <a onclick="imprimir()" class="btn btn-success btn-sm no-print"><i class="fa fa-print"> Imprimir</i></a>
       </div>
      
</div>

</div>
</div>
 
<div class="box" style="margin-top:-25px;">
            
            <div class="box-body table-responsive" >
                <table class="table table-striped table-condensed" id="mitabladetimpresion">
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        
                    </tr>
                    <tbody class="buscar" id="ventacombi">

</table>
</div>
</div>
