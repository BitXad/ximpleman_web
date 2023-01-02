<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<!--<script src="<?php echo base_url('resources/js/funciones_prestamo.js'); ?>" type="text/javascript"></script>-->

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

<body onload="buscar_pedidos();">


<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<input type="hidden" id="esrol" name="esrol" value="<?php echo $esrol; ?>">
<input type="hidden" id="esrolconsolidar" name="esrolconsolidar" value="<?php echo $esrolconsolidar; ?>">

<input id="usuario_id" name="usuario_id" value="<?php echo $usuario_id; ?>" hidden>
<input id="pedido_id" name="pedido_id" value="0" hidden>
<!--<input id="usuarios" name="usuarios" value='<?php echo json_encode($usuarios); ?>' hidden >-->
<input id='tipo_transaccion' name='tipo_transaccion' value='<?php echo json_encode($tipo_transaccion); ?>' hidden>

<table class="table" style="width: 20cm; padding: 0;" >
    <tr>
        <td style="width: 6cm; padding: 0; line-height:10px;" >
            <center>
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
            </center>                      
        </td>
                   
        <td style="width: 6cm; padding: 0" > 
            <center>
            
                <br><br>
                <font size="3" face="arial"><b>PRESTAMO DE ENVASES</b></font> <br>
                <!--<font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['venta_id']; ?></b></font> <br>-->
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

            </center>
        </td>
        <td style="width: 4cm; padding: 0" >


        </td>
    </tr>     
    
</table>


<!--<div class="container no-print">
    <center>
        
        <div class="col-md-2">
            Tipo: 
            <select class="btn btn-success form-control" id="tipo_prestamo">
                <option value="1">PRESTAMOS</option>
                <option value="2">DEVOLUCIONES</option>
            </select>
        </div>
        
        <?php if ($tipousuario_id == 1){ ?>
        <div class="col-md-2">
            Usuario(s):
            <select  class="btn btn-primary btn-sm form-control" id="select_usuario">
                    <option value="0">-- TODOS --</option>
                <?php foreach($usuario as $us){?>
                    <option value="<?php echo $us['usuario_id']; ?>"><?php echo $us['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
            
        </div>
        <?php }else{ ?>
        <input type="text" id="select_usuario" id="select_usuario" value="<?php echo $usuario_id; ?>" hidden=""/>
        <?php } ?>
        
        <div class="col-md-2">
            Desde: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_desde" value="<?php echo date("Y-m-d");?>" name="fecha_desde" required="true">
        </div>
        
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_hasta" value="<?php echo date("Y-m-d");?>"  name="fecha_hasta" required="true">
        </div>
        
        <div class="col-md-3">

            <br>
            <button class="btn btn-sm btn-facebook btn-sm btn-block form-control"   onclick="buscar_prestamos(0,0)">
                <h4>
                <span class="fa fa-search"></span><b> Buscar</b>
                </h4>
            </button>
            
        </div>        
        
    </center>    
   
</div>-->
<br>


<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el cliente, fecha, total">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th rowspan="2">N</th>
                        <th rowspan="2">Cliente</th>
                        <th rowspan="2">Producto</th>
                        <th rowspan="2" colspan="2">Detalle</th>
                        <th rowspan="2">Garantia<br>Bs</th>
                        <th rowspan="2">Fecha</th>
                    </tr>
                    <tbody class="buscar" id="tabla_prestamos">
                        <?php 
                            $cont = 0;
                            $total_prestamos = 0;
                            $total = 0;
                            
                            foreach($prestamos as $p){ 
                                $cont++;
                                $total_prestamos += $p["detalleven_cantidadenvase"];
                                $total += $p["detalleven_garantiaenvase"];
                            ?>
                            <tr>
                                <td><?php echo $cont;  ?> </td>                            
                                <td><?php echo $p["cliente_nombre"];  ?> </td>                            
                                <td><?php echo $p["producto_nombre"];  ?> </td>                            
                                <td><center><?php echo $p["detalleven_cantidadenvase"];  ?> </center></td>                            
                                <td><?php echo $p["producto_nombreenvase"];  ?> </td>                            
                                <td style="text-align: center;"><?php echo number_format($p["detalleven_garantiaenvase"],2,",",".");  ?> </td>                            
                                <td><?php echo $p["venta_fecha"];  ?> </td>                            
                            </tr>
                        <?php } ?>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?php echo $total_prestamos; ?></th>
                            <th></th>
                            <th><?php echo number_format($total,2,".",","); ?></th>
                            <th></th>
                            
                        </tr>

                        <!-- Aqui de acomoda la tabla de pedidos -->
                        
                    </tbody>
                </table>
                                
            </div>
            
            
            
            <div class="box-body table-responsive" id="tabla_resumen">
                <center>
                    <button class="btn btn-danger btn-sm" onclick="window.close();"><fa class="fa fa-close"></fa> Cerrar</button>                    
                </center>
                                
            </div>

            
            

        </div>
    </div>
</div>
</body>


<!-- Button trigger modal -->
<div hidden="">
    <button type="button" class="btn btn-primary" id="boton_modal" data-toggle="modal" data-target="#modal_devolucion">
      Devolución
    </button>    
</div>

<!-- Modal -->
<div class="modal fade" id="modal_devolucion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel"><b>DEVOLUCION DE GARANTIAS</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
          <input type="text" value="0" id="detalleven_id" hidden/>
          
          <center>
              <input type="text" value="DATOS CLIENTE" id="cliente_nombre" style="border: none" readonly>
              
          </center>
          
          <table class="table-condensed" id="mitabla">
              <tr>
                  <td style="padding: 0; text-align: right;" ><b>Garantia Bs:</b></td><td style="padding: 0;"><input type="text" class="btn btn-secondary btn-xs" style="text-align: left; background-color: #CDCDCD;" value="4.00" id="monto_garantia" readonly></td>
              </tr>    
              <tr>
                  <td style="padding: 0; text-align: right;"><b>Prestamo:</b></td><td style="padding: 0;"><input type="text" class="btn btn-secondary btn-xs" style="text-align: left;  background-color: #CDCDCD;" value="3 Botella" id="cantidad_prestamo" readonly></td>
              </tr>
              <tr>
                  <td colspan="2" style="padding: 0; text-align: left;"><h4><b>- DEVOLUCIONES -</b></h4></td>
              </tr>
              <tr>
                  <td style="padding: 0; text-align: right;"><b>Garantia Bs:</b></td><td style="padding: 0;"><input type="text" style="text-align: left; background-color: #edde34;" class="btn btn-secondary btn-xs" value="0" id="garantia"></td>
              </tr>
              <tr>
                  <td style="padding: 0; text-align: right;"><b>Prestamos:</b></td><td style="padding: 0;"><input type="text" style="text-align: left; background-color: #edde34;" class="btn btn-secondary btn-xs" value="0" id="prestamo"></td>
              </tr>
              <tr>
                  
              </tr>
          </table>
          
          
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-close"></fa> Cerrar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="registrar_devolucion()"><fa class="fa fa-floppy-o"></fa> Registrar</button>
      </div>
    </div>
  </div>
</div>