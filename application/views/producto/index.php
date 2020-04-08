<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/funciones_producto.js'); ?>" type="text/javascript"></script>
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
    /*td img{
        width: 50px;
        height: 50px;
        margin-right: 5px; 
    }*/
    #contieneimg{
        width: 50px;
        height: 50px;
        text-align: center;
    }
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masgrande{
        font-size: 12px;
    }
</style>

<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php //echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">-->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="parametro_modulorestaurante" id="parametro_modulorestaurante" value="<?php echo $parametro['parametro_modulorestaurante']; ?>" />
<input type="hidden" name="formaimagen" id="formaimagen" value="<?php  echo $parametro['parametro_formaimagen']; ?>" />
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value="<?php  echo $tipousuario_id; ?>" />
<!--<input type="hidden" name="lapresentacion" id="lapresentacion" value='<?php /*echo json_encode($all_presentacion); ?>' />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($all_moneda); */ ?>' /> -->

<div class="row micontenedorep" style="display: none" id="cabeceraprint" >
    <table class="table" style="width: 100%; padding: 0;" >
    <tr>
        <td style="width: 25%; padding: 0; line-height:10px; text-align: center" >
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
        </td>
                   
        <td style="width: 35%; padding: 0" > 
            <center>
            
                <br><br>
                <font size="3" face="arial"><b>PRODUCTOS</b></font> <br>
                
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

            </center>
        </td>
        <td style="width: 20%; padding: 0" >
                <center>
                    </center>
        </td>
    </tr>
</table>       
        
</div>

<br>
<div class="row no-print">
        <div class="col-md-8">


        <!--este es INICIO del BREADCRUMB buscador-->
<!--        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('admin/dashb')?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="<?php echo site_url('cliente')?>">Clientes</a></li>
                <li class="active"><b>Productos: </b></li>
                <input style="border-width: 0; background-color: #DEDEDE" id="encontrados" type="text"  size="5"  readonly="true">
            </ol>
        </div>-->
        <div class="box-header">
            <font size='4' face='Arial'><b>Productos</b></font>
            <br><font size='2' face='Arial' id="encontrados"></font> 
        </div>

        <!--este es FIN del BREADCRUMB buscador-->
 
        <!--este es INICIO de input buscador-->
        <div class="col-md-12">
            <div class="col-md-7">
                <div class="input-group">
                    <span class="input-group-addon"> Buscar </span>           
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, código, código de barras, marca, industria.." onkeypress="buscarproducto(event)" autocomplete="off">
                </div>
            </div>
            <div class="col-md-3">
                
                <div class="box-tools">
                    <select name="categoria_id" class="btn-primary btn-sm" id="categoria_id" onchange="tablaresultadosproducto(2)">
                        <option value="" disabled selected >-- BUSCAR POR CATEGORIAS --</option>
                        <option value="0"> Todas Las Categorias </option>
                        <?php 
                        foreach($all_categoria as $categoria)
                        {
                            echo '<option value="'.$categoria['categoria_id'].'">'.$categoria['categoria_nombre'].'</option>';
                        } 
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                
                <div class="box-tools">
                    <select name="estado_id" class="btn-primary btn-sm" id="estado_id" onchange="tablaresultadosproducto(2)">
                        <option value="" disabled selected >-- BUSCAR POR ESTADOS --</option>
                        <option value="0">Todos Los Estados</option>
                        <?php 
                        foreach($all_estado as $estado)
                        {
                            echo '<option value="'.$estado['estado_id'].'">'.$estado['estado_descripcion'].'</option>';
                        } 
                        ?>
                    </select>
                </div>
            </div>
           <!-- <div class="col-md-3">
                
                <div class="box-tools">
                    <select name="estado_id" class="btn-primary btn-sm" id="estado_id">
                        <option value="">-- ESTADO --</option>
                        <?php 
                     /*   foreach($all_estado as $estado)
                        {
                                $selected = ($estado['estado_id'] == $producto['estado_id']) ? ' selected="selected"' : "";

                                echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
                        } */
                        ?>
                    </select>
                </div>
            </div>-->
        </div>
           
            
        <!--este es FIN de input buscador-->

        <!-- **** INICIO de BUSCADOR select y productos encontrados *** -->
         <div class="row" id='loader'  style='display:none; text-align: center'>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
        </div>
        <!-- **** FIN de BUSCADOR select y productos encontrados *** -->
        
        
    </div>
    <!---------------- BOTONES --------->
    <div class="col-md-4">
        
            <div class="box-tools text-center">
            <a href="<?php echo site_url('producto/add'); ?>" class="btn btn-success btn-foursquarexs" title="Registrar nuevo Producto"><font size="5"><span class="fa fa-user-plus"></span></font><br><small>Registrar</small></a>
            <button data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs" onclick="tablaresultadosproducto(3)" title="Mostrar todos los Productos" ><font size="5"><span class="fa fa-search"></span></font><br><small>Ver Todos</small></button>
            <a href="<?php echo site_url('producto/existenciaminima'); ?>" class="btn btn-info btn-foursquarexs" target="_blank" ><font size="5" title="Productos con Existencia minima"><span class="fa fa-eye"></span></font><br><small>Exist. Min.</small></a>
            <?php
            if($rol[106-1]['rolusuario_asignado'] == 1){ ?>
            <a onclick="imprimir_producto()" class="btn btn-primary btn-foursquarexs"><font size="5" title="Imprimir Producto"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
            <?php } ?>
            <!--<a href="" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br><small>Productos</small></a>-->            
    </div>
    </div>
    <!---------------- FIN BOTONES --------->
</div>
    

<div class="row">
    <div class="col-md-12">
        
        <div class="box">
                 
            <div class="box-body  table-responsive">
               <table class="table table-condensed" id="mitabla" role="table">
               <!--<table role="table">-->
                    <thead role="rowgroup">
                        <tr role="row">
                            <th  role="columnheader" >#</th>
                            <th  role="columnheader" >Nombre</th>
                            <th  role="columnheader" >Categoria|<br>Presentación</th>
                            <!--<th  role="columnheader" style="width: 20%;" >Caracteristicas</th>-->
                            <th  role="columnheader" >Envase</th>
                            <th  role="columnheader" >Código|<br>Cód. Barra</th>
                            <th  role="columnheader" >Precio</th>
                            <th  role="columnheader" >Moneda</th>
                            <th  role="columnheader" class="no-print">Estado</th>
                            <th  role="columnheader" class="no-print"></th>
                    
                    </tr>
                    </thead>
                    <tbody class="buscar" id="tablaresultados" role="rowgroup">
                                         
                    </tbody>
                </table>
            </div>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
    </div>
</div>
<?php
if($a == 1)
echo '<script type="text/javascript">
    alert("El Producto no puede ser ELIMINADO, \n porque tienen transacciones realizadas");
</script>';
?>