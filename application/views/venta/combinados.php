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
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<style>
    .labj {
        border-bottom: 2px solid black; border-right: 0px; border-top: 0px; padding-right: 3px;
    }
    @media print {
        
        .pintado {
            background-color: rgba(169,175,232) !important;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }
        .boxtabla {
            background-color: rgba(169,175,232) !important;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }
    }

</style>

<div class="container">
    
<table>
    <tr>
        <td width="300">

                     <center>  
                        <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="80" height="60"><br>
                        <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                        <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                        <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    </center>           
        </td>
        <td width="300">
            <center>
                <font size="3" face="arial"><b>REPORTE DE EMBARQUE</b></font><br>
                <font size="2" face="arial"><b><?php echo date('d/m/Y'); ?></b></font>
            </center>
            
        </td>
        <td width="300">

        
        </td>            
    </tr>    
</table>
</div>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<!--<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php //echo $parametro[0]['moneda_descripcion']; ?>" />-->
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro[0]['moneda_id']; ?>" />
<input type="hidden" name="parametro_mostrarmoneda" id="parametro_mostrarmoneda" value="<?php echo $parametro[0]['parametro_mostrarmoneda']; ?>" />
<!--<input type="hidden" name="lamoneda" id="lamoneda" value='<?php //echo json_encode($lamoneda); ?>' />-->
<div class="row">
<div class="col-md-12">

    <div class="panel panel-primary col-md-12" style="border:none;" >
        <div class="col-md-12 no-print">
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
                            <input type="button" class="btn btn-primary btn-sm" name="pasarA&ntilde;o3" onClick="pasar('usu','usuario_id')" value="A&ntilde;adir -->>" style="margin:  11px;"><br>
                            <input type="button" class="btn btn-primary btn-sm" name="pasarA&ntilde;o4" onClick="pasar('usuario_id','usu')" value="<<-- Quitar" style="margin:  11px;">
                        </div>

                        <div class="col-md-4"  id="navTesiss">
                            Usuario(s):<select multiple id="usuario_id"  name="usuario_id"  style="padding-bottom:-11px;color: #fff; background-color: #31708f;border:none; width: 100%;"  >
                                <option value="-" >-</option>
                            </select>
                        </div>

                        
        </div>
        <div class="col-md-12" >
<span id="usus" style="font-size: 11px;"><b>Vendedor(es): </b></span> <br><br>
</div>
     <div class="col-md-12" >          
        <div class="col-md-5" >
            
              
        <div class="row" style="font-size: 11px;">
            <b>Desde: </b><input type="date" class="btn btn-primary btn-sm " style="font-size: 11px;" id="fecha_desde" name="fecha_desde" required="true" value="<?php echo date('Y-m-d')?>">
       
            <b>Hasta: </b><input type="date" class="btn btn-primary btn-sm" style="font-size: 11px;" id="fecha_hasta" name="fecha_hasta" required="true"  value="<?php echo date('Y-m-d')?>">
        </div>
        
          
       </div>
       <div class="col-md-2 no-print">
           <select class="btn btn-primary btn-sm" id="tipousu">
               <option value="1">VENDEDORES</option>
               <option value="2">PREVENDEDORES</option>
           </select>
       </div>
        <div class="col-md-2 no-print" style="padding-top:0;">
            
        <!--            <a href="<?php echo site_url('pedido/crearpedido'); ?>" class="btn btn-success btn-sm"><span class="fa fa-cart-arrow-down"></span> Nuevo pedido</a>-->
            <button class="btn btn-primary btn-sm  no-print" onclick="buscar_fecha_ven(),final()" >
               
                <span class="fa fa-search"></span> Buscar
                
          </button>
           <div class="row no-print" id='loader'  style='display:none;'>
                        <center>
                            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >        
                        </center>
                    </div> 
        </div>
         
        <div class="col-md-3 no-print" style="padding-top:0;">
            <div class="box-tools">
                <center>            

                    <a href="#" onclick="imprimir()" class="btn btn-success btn-foursquarexs"><font size="5"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
                    <a  class="btn btn-warning btn-foursquarexs" data-toggle="modal" data-target="#myModal"><font size="5"><span class="fa fa-truck"></span></font><br><small> Asignar </small></a>
                </center>            
            </div>
        </div>
        
       
       
<!--        Asignar productos inventario individual    -->

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header"><b style="font-size: 14px;">Asignar Productos</b>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                            
                    <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                          Si este usuario ya tiene productos asignados en esta fecha, los productos seran reasignados.<div class="col-md-8 no-print"> 
                            <label for="cliente_foto" class="control-label">Asignar a:</label>
                            <select name="inv_usu" id="inv_usu"  class="form-control">
                                
                                <?php 
                                foreach($all_usuario as $usuario)
                                {
                                    $selected = ($usuario['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
                                } 
                                ?>
                            </select>
                        </div><div style='display:none;'>
                            <input type="date" name="fecha" id="fecha" value="<?php echo date("Y-m-d") ?>">
                            <input type="time" name="hora" id="hora" value="<?php echo date("H:i:s") ?>">
                        </div>
                        <div class="row no-print" id='asigloader'  style='display:none;'>
                        <center>
                            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >        
                        </center>
                        </div> 
                                           <!------------------------------------------------------------------->
                    </div>
                                          <div class="modal-footer aligncenter" id="botoness">
                                                      <a onclick="asignar()" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
            </div>

<!--    Fin asignar productos inventario individual    -->
            
       </div>
   </div>
      
</div>

</div>
 
<div class="box" style="margin-top:-25px;">
            
           <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla"  border="1">
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Precio (<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                        <th>Cantidad</th>
                        <th>Total (<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                        <?php if($parametro[0]["parametro_mostrarmoneda"] == 1){ ?>
                        <th>Total (<?php
                                        if($parametro[0]["moneda_id"] == 1){
                                            echo $lamoneda[1]['moneda_descripcion'];
                                        }else{
                                            echo $lamoneda[0]['moneda_descripcion'];
                                        }
                                    ?>)
                        </th>
                        <?php } ?>
                    </tr>
                    <tbody class="buscar" id="ventacombi">

</table>
</div>
</div>
