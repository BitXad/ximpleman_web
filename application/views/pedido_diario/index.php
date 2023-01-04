<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('resources/js/pedido_diario.js'); ?>"></script>
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">

<script type="text/javascript">
    $(document).on("ready",inicio);
    function inicio(){
        //alert("jejeje");
        buscar_pedido_index(1);
    }

    
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

<!-------------------------------------------------------->
<div class="box-header" >
    <h3 class="box-title" style="font-family: Arial">Pedidos Diarios</h3>
    
    
    <div class="container">

        <div class=" col-md-3" id="div_select" style="display: block;">

                          <select class="form-control btn btn-warning btn-xs" id="select_fecha" onchange="buscar_pedido_index(1)" >
                              <option value="1">Hoy</option>
                              <option value="2">Mañana</option>
                              <option value="3">Ayer</option>
                              <option value="4">Fecha</option>
                          </select>

        </div>
        
        <div  class="col-md-3" id="div_fecha" style="display: block;">

            <input type="date" id="calendario" value="<?php echo date("Y-m-d"); ?>" class="form-control btn btn-info btn-xs" onchange="buscar_pedido_index(2)" />

        </div>
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-addon"> Buscar </span>           
                <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el proveedor, usuario, fecha, descripción..." onkeypress="buscarproducto(event)" autocomplete="off">
            </div>
        </div>
    </div>
    
    <div class="box-tools">
        <a href="<?php echo site_url('pedido_diario/add'); ?>" class="form-control btn btn-success btn-sm">Añadir</a> 
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
<tr>
                  <th>#</th>
                  <th>Hoy</th>
                  <th>Proveedor/Detalle</th>
                  <th>
                        Bs
                        <!--<a href="<?php echo base_url("pedido_diario/pedido_nuevo"); ?>" class="btn btn-default btn-xs"><fa class="fa fa-cube"></fa> </a>-->
                  </th>
                  <th>Usuario</th>
                </tr>
                    </tr>
                    <tbody class="buscar" id="tabla_index">

                       

                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
