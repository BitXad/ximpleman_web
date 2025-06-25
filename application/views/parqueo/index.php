<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/parqueo.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
//        $(document).ready(function () {
//            (function ($) {
//                $('#filtrar').keyup(function () {
//                    var rex = new RegExp($(this).val(), 'i');
//                    $('.buscar tr').hide();
//                    $('.buscar tr').filter(function () {
//                        return rex.test($(this).text());
//                    }).show();
//                })
//            }(jQuery));
//        });
        
function compruebaTecla (e) {
var keyCode = document.all ? e.which : e.keyCode;
 
 
//  if (keyCode == 39)
//alert("flecha derecha")
//  else if (keyCode == 40)
//
//MarcaCheck ();
//  else if (keyCode == 38)
//alert("flecha arriba")
//  else if (keyCode == 37)
//alert("flecha izquierda")
//  return true;

//  if (keyCode == 112) //f1
//  { alert("Tecla F1"); }    

  if (keyCode == 113) //f2
  { //alert("Tecla F2"); 
    $('#placa').focus();
    $('#placa').select();
      
  }    

  if (keyCode == 115) //f4
  {       
    $('#filtrar').focus();
  }

  if (keyCode == 118) //f7
  {       
    $('#nit').focus();
    $('#nit').select();
  }

  if (keyCode == 119) //f8
  {       
    $('#boton_finalizar').click();
  }

  if (keyCode == 120) //f9
  {   
    $('#glosay').click();
      
      
    //$('#imprimir').click();
  }

  if (keyCode == 121) //f9
  {   
      //$("#boton_modal_paquetes").click();
      $("#boton_simulador").click();
      
    //$('#imprimir').click();
  }

  //if (keyCode == 121) //f10
  //{       
    //$('#nit').focus();
    //$('#nit').select();
    
  //}
  
    e = e || event;
  if(e.altKey && String.fromCharCode(e.keyCode) == 'C')
  {
      $("#imprimir").click();
  } 
  
}        

window.onkeydown = compruebaTecla;
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<?php $decimales = $parametro["parametro_decimales"]; ?>
<?php $estilo_div = " style='padding:2; padding-left:1px; margin:0; line-height:12px;' "; ?>
<?php $estilos_facturacion = " style='color: black; background: #fffff; text-align: left; font-size: 18px; font-family: Arial;'"; //estilo para los inputs de facturacion?>
<?php $atributos = " btn btn-default btn-sm";  //atributos para los inputs del clientes?>

<input type="text" id="parametro_decimales" value="<?php echo $parametro['parametro_decimales']; ?>" name="parametro_decimales" hidden>
<input type="hidden" name="registrar_fechalimite" id="registrar_fechalimite" value="0" />
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<style>
/*        table {
            border-collapse: collapse;
            margin: auto;
        }
        td {
            width: 50px;
            height: 30px;
            border: 1px solid black;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
            background-color: #e0e0e0;
        }
        .occupied {
            background-color: red;
            color: white;
        }
        .empty {
            background-color: green;
            color: white;
        }
        .direction {
            background-color: yellow;
            font-size: 24px;
        }*/
    </style>
<!-------------------------------------------------------->
<div class="box-header">
    <h3 class="box-title"><fa class="fa fa-car"></fa> Registro de Ingreso/Salida</h3>
<!--            	<div class="box-tools">
                    <a href="<?php echo site_url('promocion/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>-->
            </div>

<div class="row">
    
        <div class="col-md-6">
            <label for="nit" class="control-label" style="margin-bottom: 0; font-size: 10px; color: gray; font-weight: normal;">NUMERO DE PLACA/CODIGO/QR</label>
            <div class="input-group"  <?php echo $estilo_div; ?>>
                                
                <input type="text" name="placa" class="form-control  <?php echo $atributos; ?>" <?php echo $estilos_facturacion; ?> id="placa" value=""  onkeypress="validar(event,1)" onclick="seleccionar(1)" onKeyUp="this.value = this.value.toUpperCase();" />
                <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="validar(13,1)" title="Buscar por número de documento"><span class="fa fa-search" aria-hidden="true" id="span_buscar_cliente"></span></div>
            
            </div>
        </div>
    
        <div class="col-md-2">
            
            <label for="nit" class="control-label" style="margin-bottom: 0; font-size: 10px; color: gray; font-weight: normal;">ABRIR/CERRAR CAJA</label>
            <!--<div class="form-group">-->          
              <a href="<?php echo base_url("admin/dashb"); ?>" target="_blank" name="abrir_caja" class="form-control btn btn-info" ><fa class="fa fa-money"></fa>  Abrir/Cerrar Caja</a>
            <!--</div>-->
        </div>
        <div class="col-md-2">
            
            <label for="nit" class="control-label" style="margin-bottom: 0; font-size: 10px; color: gray; font-weight: normal;">VENTAS/SERVICIOS</label>
            <!--<div class="form-group">-->          
            <a href="<?php echo base_url("venta/ventas"); ?>" target="_blank" name="cliente_telefono" class="form-control btn btn-warning" id="cliente_telefono"><fa class="fa fa-cart-plus"></fa>  Ventas</a>
            <!--</div>-->
        </div>
    
        <div class="col-md-2">
            
            <label for="select" class="control-label" style="margin-bottom: 0; font-size: 10px; color: gray; font-weight: normal;">VER/MOSTRAR</label>
            
            <select class="form-control" id="select_filtro" onchange="mostrar_lista()">
                <option value="1">EN PARQUEO</option>
                <option value="2">SALIDAS DE HOY</option>
                <option value="3">SALIDAS DE AYER</option>
                <option value="4">SALIDAS DE LA SEMANA</option>
                <option value="5">SALIDAS POR FECHA</option>
            </select>
           
            <!--<a href="<?php echo base_url("venta/ventas"); ?>" target="_blank" name="cliente_telefono" class="form-control btn btn-warning" id="cliente_telefono"><fa class="fa fa-cart-plus"></fa>  Ventas</a>-->
      
        </div>
    
        <div class="col-md-12">
            <br>
                <div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' style='display:none;'>

                    <center>            
                        <div class="col-md-2">
                            Desde: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_desde" value="<?php echo date("Y-m-d");?>" name="fecha_desde" required="true">
                        </div>
                        <div class="col-md-2">
                            Hasta: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_hasta" value="<?php echo date("Y-m-d");?>"  name="fecha_hasta" required="true">
                        </div>

                        <div class="col-md-2">
                            Tipo:             
                            <select  class="btn btn-warning btn-sm form-control" id="estado_id" required="true">
                                
                                <option value="0">--TODOS--</option>
                                <?php 
                                    foreach ($tarifa as $t){ ?>
                                        <option value="<?php echo $t["tarifa_id"]; ?>"><?php echo $t["tarifa_tipo"]." - ".$t["tarifa_modalidad"]; ?></option>
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
                        </div>

                        <br>
                        <div class="col-md-3">

                            <button class="btn btn-sm btn-facebook btn-sm btn-block"   onclick="mostrar_lista()">
                                <h4>
                                <span class="fa fa-search"></span>   Buscar
                                </h4>
                            </button>

                            <br>
                        </div>

                    </center>    

                </div>
        </div>
    
            
        <div class="col-md-12">
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        
                        <th>#</th>
                        <th style="width: 350px;">Cliente</th>
                        <th>Descripción</th>
                        <th>Ticket</th>
                        <th>Placa</th>
                        <th>Modalidad</th>
                        <th>Fecha Limite</th>
                        <th>Dias</th>
                        <th>Total</th>
                        <th>Ingreso</th>
                        <th>Salida</th>
                        <th>Estado</th>
                        <th></th>

                    </tr>
                    <tbody id="tabla_registros">

                </table>                                               
            </div>
        </div>
            
<!--            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div> -->
        </div>
    </div>
</div>



<!------------------------------------------------------------------------------->
<!----------------------- INICIO MODAL REGISTRO ------------------------------->
<!------------------------------------------------------------------------------->


<div hidden>
    <button type="button" id="boton_registro" class="btn btn-default" data-toggle="modal" data-target="#modalingreso" >
      Pensionado
    </button>
    
</div>

<div class="modal fade" id="modalingreso" tabindex="-1" role="dialog" aria-labelledby="modalingreso" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">REGISTRAR: INGRESO</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        
            <div class="modal-content" style="font-family: Arial">

                    <div class="box-body">
                        
                        <div class="col-md-12">
                            <center>
                                
                                <label for="cliente_codigo" class="control-label" style="font-size: 15px;">
                                    <fa class="fa fa-car"> </fa>
                                    REGISTRO DE VEHICULOS
                                    <fa class="fa fa-motorcycle"> </fa>
                                </label>
                                
                            </center>
                            
                        </div>
    
                
                    <div class="box-body">
                        
                        <div class="col-md-3">
                            <label for="cliente_codigo" class="control-label">Placa/Codigo</label>
                            <div class="form-group">
                                <input type="text" name="cliente_codigo" value="" class="form-control" id="cliente_codigo" readonly/>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="cliente_nombre" class="control-label">Cliente</label>
                            <div class="form-group">
                                <input type="text" name="cliente_nombre" value="" class="form-control" id="cliente_nombre" onclick="marcar_nombre()" onKeyUp="this.value = this.value.toUpperCase();" required />
                            </div>
                        </div>
                        
                        <div class="col-md-5">
                            <label for="banco_monto" class="control-label">Modalidad</label>
                            <div class="form-group">
                                <select class="form-control" id="producto_id" onchange="mostrar_fecha()">
                                    
                                <?php  
                                        $i = 1;
                                        foreach($modalidad as $mod){ ?>

                                            <option value="<?= $mod["tarifa_id"]; ?>" <?= ($i++ == 1)?"default":""; ?>><?= $mod["tipo"]." "; ?><?= ($mod["tarifa_monto"]>0)?"Bs ".$mod["tarifa_monto"]:" "; ?></option>


                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-7">
                            <label for="cliente_descripcion" class="control-label">Descripción</label>
                            <div class="form-group">
                                <input type="text" name="cliente_descripcion" value="" class="form-control" id="cliente_descripcion" onKeyUp="this.value = this.value.toUpperCase();" required />
                            </div>
                        </div>
                        
                        <div class="col-md-5">
                            <label for="cliente_telefono" class="control-label">Telefono/Celular</label>
                            <div class="form-group">
                                <input type="text" name="cliente_telefono" value="" class="form-control" id="cliente_telefono" onKeyUp="this.value = this.value.toUpperCase();" required />
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="tiempo" class="control-label">Nro Puesto</label>
                            <div class="form-group">
                                <input type="text" name="registroparqueo_puesto" value="10" class="form-control" id="registroparqueo_puesto" onKeyUp="this.value = this.value.toUpperCase();" required />
                            </div>
                        </div>
                        
                        <div class="col-md-4" hidden>
                            <label for="banco_monto" class="control-label">Tipo Movilidad</label>
                            <div class="form-group">
                                
                                <select class="form-control" id="tipocliente_id">
                                    
                                <?php  
                                        $i = 1;
                                        foreach($tipo_cliente as $tipo){ ?>
                                
                                            <option value="<?= $tipo["tipocliente_id"]; ?>" <?= ($i++ ==1)?"default":""; ?>><?= $tipo["tipocliente_descripcion"]; ?></option>
                                
                                
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4" style='display:none' id="div_fechalimite">
                            <label for="fechalimite" class="control-label">Fecha Limite(Mensual)</label>
                            <div class="form-group">
                                <input type="date" name="registroparqueo_fechalimite" value="<?php echo date("Y-m-d"); ?>" class="form-control" id="registroparqueo_fechalimite" onKeyUp="this.value = this.value.toUpperCase();" style="background-color: yellow;" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="imprimir" class="control-label">Ticket</label>
                            <div class="form-group">
                                <input type="checkbox" name="imprimir_ticket" id="imprimir_ticket" value="1" class="form-check-input" checked/>
                                <label for="registroparqueo_puesto">¿Imprimir Ticket?</label>
                            </div>
                        </div>
                                           


                    </div>

                        <div class="modal-footer" style="text-align: center">

                            <button type="button" class="btn btn-success btn-block" value="Registrar Ingreso" data-dismiss="modal" onclick="registrar_ingreso()" id="boton_ingreso"><fa class="fa fa-car"></fa> Registrar Ingreso</button>
                            <button type="button" class="btn btn-danger btn-block" id="boton_cerrar_ventatemporal" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
                        </div>
                

            </div>
    </div>
</div>
</div>

<!------------------------------------------------------------------------------->
<!----------------------- FIN MODAL GUARDAR VENTA ----------------------------------->
<!------------------------------------------------------------------------------->

<!------------------------------------------------------------------------------->
<!----------------------- INICIO MODAL SALIDA ------------------------------->
<!------------------------------------------------------------------------------->


<div hidden>
    <button type="button" id="boton_salida" class="btn btn-default" data-toggle="modal" data-target="#modalsalida" >
      Salida
    </button>
    
</div>

<div class="modal fade" id="modalsalida" tabindex="-1" role="dialog" aria-labelledby="modalsalida" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">REGISTRAR: SALIDA</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        
            <div class="modal-content" style="font-family: Arial">

                    <div class="box-body">
                        
                        <div class="col-md-12">
                            <center>
                                
                                <label for="cliente_codigo" class="control-label" style="font-size: 15px;">
                                    <fa class="fa fa-car"> </fa>
                                    SALIDA DE VEHICULOS
                                    <fa class="fa fa-motorcycle"> </fa>
                                </label>
                                
                            </center>
                            
                        </div>
    
                
                    <div class="box-body">
                                                
                        <div class="col-md-3" hidden>
                            <label for="registroparqueo_id1" class="control-label">Registro ID</label>
                            <div class="form-group">
                                <input type="text" name="registroparqueo_id1" value="" class="form-control" id="registroparqueo_id1" required />
                            </div>
                        </div>
                        
                        <div class="col-md-3" hidden>
                            <label for="cliente_id1" class="control-label">CLIENTE ID</label>
                            <div class="form-group">
                                <input type="text" name="cliente_id1" value="" class="form-control" id="cliente_id1" required />
                            </div>
                        </div>
                        
                        <div class="col-md-3" hidden>
                            <label for="tarifa_id1" class="control-label">TARIFA ID</label>
                            <div class="form-group">
                                <input type="text" name="tarifa_id1" value="" class="form-control" id="tarifa_id1" required />
                            </div>
                        </div>
                        
                        
                        
                        <div class="col-md-3">
                            <label for="cliente_codigo1" class="control-label">Placa/Código</label>
                            <div class="form-group">
                                <input type="text" name="cliente_codigo1" value="" class="form-control" id="cliente_codigo1" readonly/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="cliente_nombre1" class="control-label">Nombre Cliente</label>
                            <div class="form-group">
                                <input type="text" name="cliente_nombre1" value="" class="form-control" id="cliente_nombre1" readonly />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="cliente_nombrenegocio1" class="control-label">Descripción</label>
                            <div class="form-group">
                                <input type="text" name="cliente_nombrenegocio1" value="" class="form-control" id="cliente_nombrenegocio1" readonly />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_ingreso1" class="control-label">Fecha Ingreso</label>
                            <div class="form-group">
                                <input type="text" name="fecha_ingreso1" value="" class="form-control" id="fecha_ingreso1" readonly />
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="hora_ingreso1" class="control-label">Hora Ingreso</label>
                            <div class="form-group">
                                <input type="text" name="hora_ingreso1" value="" class="form-control" id="hora_ingreso1" readonly />
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="fecha_salida1" class="control-label">Fecha Salida</label>
                            <div class="form-group">
                                <input type="text" name="fecha_salida1" value="" class="form-control" id="fecha_salida1" readonly />
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="hora_salida1" class="control-label">Hora Salida</label>
                            <div class="form-group">
                                <input type="text" name="hora_salida1" value="" class="form-control" id="hora_salida1" readonly />
                            </div>
                        </div>
                        

                        <div class="col-md-4">
                            <label for="tiempo" class="control-label">Tiempo</label>
                            <div class="form-group">
                                <input type="text" name="tiempo1" value="" class="form-control" id="tiempo1" readonly />
                            </div>
                        </div>

                        <div class="col-md-8">
                            <label for="literal" class="control-label">Tiempo Literal</label>
                            <div class="form-group">
                                <input type="text" name="literal1" value="" class="form-control" id="literal1" readonly />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="monto_total" class="control-label">Monto Bs</label>
                            <div class="form-group">
                                <input type="text" style="font-size: 24px; color: red;" name="monto_total" value="" class="form-control" id="monto_total" readonly />
                            </div>
                        </div>

                        
                        <div class="col-md-6">
                            <label for="imprimir" class="control-label">Ticket</label>
                            <div class="form-group">
                                <input type="checkbox" name="imprimir_ticket1" id="imprimir_ticket1" value="1" class="form-check-input"/>
                                <label for="registroparqueo_puesto">¿Imprimir Ticket?</label>
                            </div>
                        </div>                        
                                           


                    </div>

                        <div class="modal-footer" style="text-align: center">

                            <button type="button" class="btn btn-facebook btn-block" value="Registrar Pensionado" data-dismiss="modal" onclick="registrar_salida()"><fa class="fa fa-car"></fa> Registrar Salida</button>
                            <button type="button" class="btn btn-danger btn-block" id="boton_cerrar_ventatemporal" data-dismiss="modal"><fa class="fa fa-times"></fa> Cancelar</button>
                        </div>
                

            </div>
    </div>
</div>
</div>

<!------------------------------------------------------------------------------->
<!----------------------- FIN MODAL SALIDA VEHICULO----------------------------------->
<!------------------------------------------------------------------------------->

<script>
/*    let tarifa = <?php echo json_encode($tarifa); ?>;

    tarifa.forEach(function(t) {
        console.log("ID:", t.id, "Precio:", t.precio);
    });*/
    
function mostrar_fecha(){
    
    let tarifa = <?php echo json_encode($modalidad); ?>;
    let seleccionado = document.getElementById("producto_id").value;
    
    //alert (tarifa[0]["tarifa_id"]);
    
    for(let i=0; i<tarifa.length; i++){        
    
        if(tarifa[i]["tarifa_id"] == seleccionado ){
            
            if(tarifa[i]["tarifa_modalidad"] == 'MENSUAL'){
                
                document.getElementById("registrar_fechalimite").value = 1;
                document.getElementById("div_fechalimite").style.display = 'block';
                
            }else{
                
                document.getElementById("registrar_fechalimite").value = 0;
                document.getElementById("div_fechalimite").style.display = 'none';                
            }
    
        }
    }
}
    
    
</script>