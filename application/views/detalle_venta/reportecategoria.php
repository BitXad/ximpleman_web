<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/reporteventa.js'); ?>" type="text/javascript"></script>
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
<!----------------------------- fin script buscador --------------------------------------->
<style type="text/css">
    #contieneimg{
        width: 45px;
        height: 45px;
        text-align: center;
    }
    #contieneimg img{
        width: 45px;
        height: 45px;
        text-align: center;
    }
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masg{
        font-size: 12px;
    }
    td div div{
        
    }
</style>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">


<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

<div class="box-header text-center">
    <h2 class="box-title"><b>REPORTE DE VENTAS POR CATEGORIA</b></h2>
</div>
<!-------------------------------------------------------->

<br>
<div class="row no-print">
    
    <div class="col-md-8">
    
        <div class="col-md-3">
            Desde: <input type="date" class="btn btn-primary btn-sm form-control" value="<?php echo date('Y-m-d')?>" id="fecha_desde" name="fecha_desde" required="true">
        </div>
        <div class="col-md-3">
            Hasta: <input type="date" class="btn btn-primary btn-sm form-control" value="<?php echo date('Y-m-d')?>" id="fecha_hasta" name="fecha_hasta" required="true">
        </div>
       
        <div class="col-md-3">
            Categoria:             
            <select class="btn btn-primary btn-sm form-control" name="categoria" id="categoria" required>
                <option value="0">TODOS</option>
                <?php foreach($categoria_producto as $categoria){?>
                <option value="<?php echo $categoria['categoria_id']; ?>"><?php echo $categoria['categoria_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
       
        <div class="col-md-3">
            <br>
            <button class="btn btn-sm btn-soundcloud btn-sm btn-block"  type="submit" onclick="buscarcategorias()" style="height: 34px;">
                <span class="fa fa-search"></span> Buscar
          </button>
            <br>
        </div>
          
        <!--</div>-->
        <!-- *********** INICIO de BUSCADOR select y productos encontrados ****** -->
         <div class="row" id='loader'  style='display:none; text-align: center'>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
        </div>
        <!-- *********** FIN de BUSCADOR select y productos encontrados ****** -->
        
        
    </div>
    
</div>
    
<!-------------------------------------------------------------------------------->

<div class="row">
    <div class="col-md-12">
        
         <div class="row" id='loader'  style='display:none; text-align: center'>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
        </div>
        <!-- *********** FIN de BUSCADOR select y productos encontrados ****** -->

        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                        
                    </tr>
                    <tbody class="buscar" id="categorias">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

