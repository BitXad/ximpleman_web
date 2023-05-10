<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/inventario.js'); ?>"></script> 

<style type="text/css">
    p {
        font-family: Arial;
        font-size: 7pt;
        line-height: 120%;   /*esta es la propiedad para el interlineado*/
        color: #000;
        padding: 10px;
    }
    div {
        margin-top: 1px;
        margin-right: 1px;
        margin-bottom: 1px;
        margin-left: 10px;
        margin: 1px;
    }
    table{
        width : 17cm;
        margin : 1 1 1px 1;
        padding : 1 1 1 1;
        border-spacing : 0 0;
        border-collapse : collapse;
        font-family: Arial narrow;
        font-size: 7pt;
        td{
            border:hidden;
        }
    }

    td#comentario {
        vertical-align : bottom;
        border-spacing : 1;
    }
</style>

<!----------------------------- fin script buscador --------------------------------------->
    <?php $decimales = $parametro['parametro_decimales']; ?>
    <input type="text" id="decimales" value="<?php echo $decimales; ?>" name="decimales"  hidden>

<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<!--<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php //echo $parametro['moneda_descripcion']; ?>" />-->
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro['moneda_id']; ?>" />
<!--<input type="hidden" name="lamoneda" id="lamoneda" value='<?php //echo json_encode($lamoneda); ?>' />-->
<!-------------------------------------------------------->
<table class="table" style="width: 20cm; padding: 0;" >
    <tr>
        <td style="width: 6cm; padding: 0; line-height:10px;" >
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                

            </center>                      
        </td>
                   
        <td style="width: 6cm; padding: 0" > 
            <center>
                <br>
                <br>
                <font size="2" face="arial"><b>KARDEX DE EXISTENCIA</b></font> <br>
                <!--<font size="1" face="arial"><b>FISICO - VALORADO</b></font> <br>-->
                <font size="1" face="arial"><b><?php echo $producto[0]['producto_codigobarra']." ".$producto[0]['producto_nombre']; ?></b></font>


            </center>
        </td>
        <td style="width: 4cm; padding: 0" >
<!--                ______________________________                
                   
                                
                <div id="datos_recorrido">
                    
                </div>
                
                ______________________________-->
        </td>
    </tr>
     
    
    
</table>


<!--<table class="table" style="width: 18cm;" >
    <tr>
        <td>
                
            <center>

                
                    
                <font size="3" face="arial"><b>KARDEX DE EXISTENCIA</b></font> <br>
                <font size="1" face="arial"><b>FISICO - VALORADO</b></font> <br>
                <font size="1" face="arial"><b>PRODUCTO: <?php echo $producto[0]['producto_codigobarra']." ".$producto[0]['producto_nombre']; ?></b></font>

                <br>    
            </center>                      
        </td>
    </tr>
     
</table>-->


<!---------------------------------- panel oculto para busqueda--------------------------------------------------------->
<!--<form method="post" onclick="ventas_por_fecha()">-->
<div class="panel panel-primary col-md-12 no-print" id='buscador_oculto'    >
    <br>
    <center>            
        <div class="col-md-2">
            Desde: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_desde" value="<?php echo date("Y-m-d");?>" name="fecha_desde" required="true">
        </div>
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_hasta" value="<?php echo date("Y-m-d");?>"  name="fecha_hasta" required="true">
        </div>
        
<!--        <div class="col-md-2">
            Tipo:             
            <select  class="btn btn-warning btn-sm form-control" id="estado_id" required="true">
                <?php foreach($estado as $es){?>
                    <option value="<?php echo $es['estado_id']; ?>"><?php echo $es['estado_descripcion']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <div class="col-md-2">
            Usuario:             
            <select  class="btn btn-warning btn-sm form-control" id="usuario_id">
                    <option value="0">-- TODOS --</option>
                <?php foreach($usuario as $us){?>
                    <option value="<?php echo $us['usuario_id']; ?>"><?php echo $us['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>-->
        
        <br>
        <div class="col-md-2">

            <button class="btn btn-sm btn-facebook btn-sm btn-block"  onclick="mostrar_kardex(<?php echo $producto_id;?>)">
                <h4>
                <span class="fa fa-search"></span>   Buscar
                </h4>
          </button>
            <br>
        </div>
        
        <div class="col-md-2">

            <button class="btn btn-sm btn-info btn-sm btn-block"  onclick="mostrar_kardex_global()">
                <h4>
                <span class="fa fa-list"></span>   Inventario Global
                </h4>
          </button>
            <br>
        </div>
        
        <div class="col-md-2">
<!--            &nbsp;
            <a class="btn btn-sm btn-success btn-sm btn-block" onclick="imprimir()"><span class="fa fa-print"></span> Imprimir</a>-->
            <button class="btn btn-sm btn-success btn-sm btn-block"  onclick="imprimir()">
                <h4>
                <span class="fa fa-print"></span>   Imprimir
                </h4>
          </button>
            <br>
        </div>
        
    </center>    
    <br>    
</div>
<!--</form>-->
<!------------------------------------------------------------------------------------------->



<!--<div class="box-body table-responsive">-->
    <!--<table class="table table-condensed" id="mitabla" style="font-size:10px" style="width: 17cm;">-->
<div class="container  table-responsive" style='padding: 0;' >
    

    <table class="table table-responsive" id="mitabla" style="font-size:10px" style="width: 18cm;" >
    <tr style="font-family: Arial narrow">
        <th rowspan="2">
            FECHA
        </th>
        <th colspan="4">
            ENTRADAS
        </th>
        <th colspan="4">
            SALIDAS 
        </th>
        <th colspan="3">
           SALDOS   
        </th>
        <th rowspan="2">
             OBSERV.                       
        </th>


    </tr>
    <tr style="font-family: Arial narrow">
        <th>
            Nº<br>INGRESO              
        </th>
        <th>
            UNIDAD<br>COMP.
        </th>
        <th>
            COSTO<br>UNIT.(<?php echo $parametro['moneda_descripcion']; ?>)
        </th>
        <th>
            IMPORTE<br>(<?php echo $parametro['moneda_descripcion']; ?>)
        </th>
        <th>
            Nº DOC.<br>VENTA                            
        </th>
        <th>
            UNIDAD<br>VEND.                            
        </th>
        <th>
            COSTO<br>UNIT.(<?php echo $parametro['moneda_descripcion']; ?>)
        </th>
        <th>
            IMPORTE<br>(<?php echo $parametro['moneda_descripcion']; ?>)
        </th>
        <th>
            UNIDs.                            
        </th>
        <th>
            SALDO<br>(<?php echo $parametro['moneda_descripcion']; ?>)
        </th>
        <th>SALDO<br>(<?php
                        if($parametro["moneda_id"] == 1){
                            echo $lamoneda[1]['moneda_descripcion'];
                        }else{
                            echo $lamoneda[0]['moneda_descripcion'];
                        }
                    ?>)
        </th>


    </tr>
    <tbody id="tabla_kardex">

    </tbody>
</table>
</div>
<!--</div>-->
<div class="row no-print">
    <div class="col-md-12">
        <a class="btn btn-soundcloud" onclick="ver_operacionproceso(<?php echo $producto_id;?>)" title="Ver las operaciones en proceso"><span class="fa fa-eye"></span> Operaciones en proceso </a>
    </div>
    <div id='loader'  style='display:none; text-align: center'>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
    </div>
    <span style="font-size: 15px; font-weight: bold; text-align: center; display: block" id="tituloresventaaux"></span>
    <div class="col-md-12">
        <div class="col-md-3"></div>
        <div class="col-md-6" id="resventaaux"></div>
        <div class="col-md-3"></div>
    </div>
    <span style="font-size: 15px; font-weight: bold; text-align: center; display: block" id="titulores_pedido_nofin"></span>
    <div class="col-md-12">
        <div class="col-md-3"></div>
        <div class="col-md-6" id="res_pedido_nofin"></div>
        <div class="col-md-3"></div>
    </div>
</div>