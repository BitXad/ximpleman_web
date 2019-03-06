<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/inventario.js'); ?>"></script>

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
        $(document).ready(function () {
            (function ($) {
                $('#filtrar2').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar2 tr').hide();
                    $('.buscar2 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });   

</script>   

<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->

<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">

<!-------------------------------------------------------->



<div class="box-header">
            <h3 class="box-title">Inventario</h3>
            <div class="box-tools no-print">
            
                <button class="btn btn-success btn-sm" onclick="actualizar_inventario()"><span class="fa fa-cubes"></span> Actualizar</button>
                <button class="btn btn-primary btn-sm" onclick="tabla_inventario()"><span class="fa fa-list"></span> Mostrar todo</button>
                <button class="btn btn-facebook btn-sm" onclick="mostrar_duplicados()"><span class="fa fa-copy"></span> Prod. Duplicados</button>

            </div>
</div>

<div class="row">
    <div class="col-md-12">
            <!--------------------- parametro de buscador --------------------->
                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código"   onkeypress="validar(event,1)" >
                  </div>
            <!--------------------- fin parametro de buscador ---------------------> 
            <div class="box">
           
                       <!--------------------- inicio loader ------------------------->
                    <div class="row" id='loader'  style='display:none;'>
                        <center>
                            <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                        </center>
                    </div> 
                    <!--------------------- fin inicio loader ------------------------->
                    
                <div class="box-body  table-responsive" >

                    <div id="tabla_inventario">
                        
                    <!-------------------- aqui se muestra la tabla de productos del inventario--------------------->
                    
                    </div>
                </div>
            </div>
</div>
</div>
