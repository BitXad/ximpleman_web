<body onload="mostrar_grafica()">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ximpleman | Sistema Integral de Ventas</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php if($parametro[0]["parametro_manejocaja"] == "Si"){ echo base_url('resources/js/caja.js');} ?>"></script>
    <script src="<?php echo base_url('resources/js/graficas.js'); ?>"></script>
    <script src="<?php echo base_url('resources/js/pedido_diario.js'); ?>"></script>
    <script src="<?php echo base_url('resources/js/highcharts.js'); ?>"></script>
    <script src="<?= base_url('resources/js/objetivo.js')?>"></script>
    
    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />  
    <input type="hidden" name="caja_id" id="caja_id" value="<?php echo $caja[0]['caja_id']; ?>" />
    <input type="hidden" name="estado_id" id="estado_id" value="<?php echo $caja[0]['estado_id']; ?>" />
    <!-- Main content -->
    <style>
        #map{
            width: 100%; 
            height: 500px;
        }
    </style>
    <section>
        <!-- Small boxes (Stat box) -->
        <div class="row">
            
            <div class="col-lg-3 col-xs-6">
            <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner" >
                        <h3><b><fa class="fa fa-cart-plus"></fa></b></h3>
                        <?php if(isset($objetivo['objetivo_diario'])){ ?>
                            <div>
                                <h5 width="100%"><b><?php echo $parametro[0]['moneda_descripcion']." ".number_format($ventas[0]['total_ventas'],2,'.',','); ?> / <?= number_format($objetivo['objetivo_diario'],2,'.',','); ?></b></h5>
                            </div>
                        <?php }else{ ?>
                                <h5 width="100%"><b><?php echo $parametro[0]['moneda_descripcion']." ".number_format($ventas[0]['total_ventas'],2,'.',','); ?> </b></h5>
                        <?php } ?>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cart-plus"></i>              
                    </div>
                    <!-- Barra de progreso en objetivo -->
                    <?php if(isset($objetivo['objetivo_diario'])){ ?>
                    <div class="progress" style="height:10px; margin-bottom: 2px;">
                        <div class="progress-bar" role="progressbar" style="width: <?= (($ventas[0]['total_ventas']*100)/$objetivo['objetivo_diario']) ?>%; background-color: #00acd7" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <?php }else{ ?>
                        <div style="margin-bottom: 12px"></div>
                    <?php } ?>
                    <a href="<?php echo base_url('venta/ventas'); ?>" class="small-box-footer"><?php echo "En ".$ventas[0]['cantidad_ventas']." ventas"; ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner" >
                        <h3><b><i class="fa fa-pencil-square-o" aria-hidden="true"></i></b></h3>
                        <h5><b><?php echo $parametro[0]['moneda_descripcion']." ".number_format($pedidos[0]['total_pedidos'],2,'.',','); ?><sup style="font-size: 20px"></sup></b></h5>                        
                    </div>
                    
                    <div class="icon">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>              
                    </div>
                    <!-- Barra de progreso en objetivo -->
                    <?php if(isset($objetivo['objetivo_diario'])){ ?>
                        <div class="progress" style="height:10px; margin-bottom: 2px;">
                            <div class="progress-bar" role="progressbar" style="width: <?= (($entregas_dia['pedido_diario']*100)/$objetivo['objetivo_pedido']) ?>%; background-color: #c64333" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    <?php }else{ ?>
                        <div style="margin-bottom: 12px"></div>
                    <?php } ?>
                    <!-- <div style="height: 12px;"></div> -->
                    <a href="<?php echo base_url('pedido'); ?>" class="small-box-footer"><?php echo "En ".$pedidos[0]['cantidad_pedidos']." pedidos"; ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
            <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner" >
                        <h3><b><i class="fa fa-credit-card-alt" aria-hidden="true"></i></b></h3>
                        <h5><b><?= $parametro[0]['moneda_descripcion']." ".number_format($creditos[0]['total_ventas_credito'],2,'.',','); ?><sup style="font-size: 20px"></sup></b></h5>
                    </div>
                    
                    <div class="icon">
                        <i class="fa fa-credit-card-alt" aria-hidden="true"></i>              
                    </div>
                    <div style="margin-bottom: 12px"></div>
                    <!-- <div class="progress" style="height:15px; margin-bottom: 2px;">
                        <div class="progress-bar" role="progressbar" style="width: 50%; background-color: #009551" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> -->
                    <!-- <a href="<?= base_url('pedido'); ?>" class="small-box-footer"><?php echo "En ".$pedidos[0]['cantidad_pedidos']." pedidos"; ?> <i class="fa fa-arrow-circle-right"></i></a> -->
                    <a href="<?= base_url('credito') ?>" class="small-box-footer"><?= "Tiene ".$creditos[0]['cantidad_ventas_credito']." Creditos"; ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
            <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner" >
                        <h3><b><fa class="fa fa-users"></fa></b></h3>
                        <h5><b><?= number_format($clientes[0]['total_clientes_user'],0,'.',','); ?> Clientes<sup style="font-size: 20px"></sup></b></h5>
                    </div>
                    
                    <div class="icon">
                        <i class="fa fa-users"></i>              
                    </div>
                    <div style="margin-bottom: 12px"></div>
                    
                    <a href="<?= base_url('cliente'); ?>" class="small-box-footer"><?= "Clientes"; //$clientes[0]['total_clientes']." Clientes"; ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- ---------------------------------Objetivos del mes------------------------------- -->
    <section class="col-lg-12 connectedSortable">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                <h3 class="box-title">Objetivos del Mes</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <!-- <div class="container"> -->
                <section>
                <div class="container">
                    <div class="row">
                        <?php if(isset($objetivo['objetivo_mes'])){ ?>
                            <div>
                                <h4 class="title" style="display: inline;" >Ventas</h4>
                                <h4 class="text-right mr-0" style="display: inline;">&nbsp;&nbsp;&nbsp; <?php echo $parametro[0]['moneda_descripcion']." ".$ventas_mes['total_mes'] ?> / <?= $objetivo['objetivo_mes'] ?></h4>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" style="width: <?= intval(($ventas_mes['total_mes'] *100)/$objetivo['objetivo_mes']) ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        <?php }else{ ?>
                                <h4 class="title" style="display: inline;">Usted no tiene objetivos de ventas</h4>
                                <br>
                                <br>
                        <?php } ?>
                        <?php if(isset($objetivo['objetivo_pedido_mes'])){ ?>
                            <div>
                                <h4 class="title" style="display: inline;" >Pedidos realizados</h4>
                                <h4 class="text-right mr-0" style="display: inline;">&nbsp;&nbsp;&nbsp;<?= $entregas_mes['pedido_mes'] ?> / <?= $objetivo['objetivo_pedido_mes'] ?></h4>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" style="width: <?= intval(($entregas_mes['pedido_mes']*100)/$objetivo['objetivo_pedido_mes']); ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        <?php }else{ ?>
                            <h4 class="title" style="display: inline;">Usted no tiene objetivos de pedidos </h4>
                        <?php } ?>

                    </div>
                </div>
                </section>
                <!-- </div> -->
            </div>
        </div>
    </section>
    <!-- ---------------------------------Objetivos del mes------------------------------- -->
    
    <!-- ---------------------------------MAPA---------------------------------------- -->
    <section class="col-lg-12 connectedSortable">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-money"></i>
                <h3 class="box-title">Mapa de Visitas</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <div class="container">
                        <h4><b>Entregas para hoy: <?php echo sizeof($all_pedido); ?></b>
                        <a href="<?php echo site_url('cliente/reporte_distribuidor'); ?>" class="btn btn-danger btn-sm"><span class="fa fa-list"></span> Entregas</a>
                        </h4>
                        <div class="col col-md-12 table-responsive">
                            <table class="table">
                                <tr>
                                    <td>
                                                        
                                        <div id="map"></div> <!-- mapa -->
                                        
                                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClNsJugfWI4xOf1Or9Wdg5lD_qUqaik58"></script>
                                        <script>      
                                        //coordada inicial del mapa
                                        var coordenadas= new google.maps.LatLng(-17.4038, -66.1635);
                                        
                                        //variable para globos de informacion
                                        var infowindow = true;
                                    
                                        //puntos a ser marcados en el mapa
                                        var puntos = [];
                                            var punto;
                                                <?php $i = 0;
                                                
                                                foreach($all_pedido as $p){ ?>
                                                
                                                    punto = ['<?= $p['cliente_nombre']; ?>','<?= $p['cliente_latitud']; ?>','<?= $p['cliente_longitud']; ?>','<?= $p['cliente_direccion']; ?>','<?= $p['pedido_id']; ?>','<?= $p['entrega_id'] ?>','<?= $p['venta_id']; ?>','<?= $p['entrega_id'] ?>','<?= $p['venta_id'] ?>','<?= $p['venta_fechaentrega'] ?>', '<?= $p['venta_horaentrega'] ?>'];
                                                    puntos['<?php echo $i; ?>'] = punto;
                                                <?php $i++; } ?>       
                                        //funcion para posicionar los marcadores en el mapa
                                        function setMarkers(map, puntos) {    
                                            //limpiamos el contenido del globo de informacion
                                            var infowindow = new google.maps.InfoWindow({
                                                content: ''
                                            });
                                    
                                            //recorremos cada uno de los puntos
                                            for (var i = 0; i < puntos.length; i++) {
                                                
                                            var place = puntos[i];
                                            if(place[5] == 1){
                                                var color_icon = '<?php echo base_url().'resources/images/blue.png'; ?>';
                                            }else{
                                                var color_icon = '<?php echo base_url().'resources/images/red.png'; ?>';
                                            }
                                            //propiedades del marcador
                                            var marker = new google.maps.Marker({
                                                position: new google.maps.LatLng(place[1], place[2]), //posicion
                                                map: map,
                                                scrollwheel: false,
                                                animation: google.maps.Animation.DROP, //animacion           
                                                nombre: place[0], //personalizado - nombre del punto
                                                info: place[3], //personalizado - informacion adicional
                                                link: '<?php echo base_url().'pedido/comprobante/'; ?>'+place[4], //personalizado - informacion adicional
                                                ven_id:place[6],              
                                                icon: color_icon,
                                                estado: place[5],
                                                entrega_fecha: place[9],
                                                entrega_hora: place[10]
                                            });
                                            
                                            //se agrega el evento click a cada marcador, asi despliega la
                                            //informacion nada uno de los marcadores
                                            google.maps.event.addListener(marker, 'click', function() {
                                                //html de como vamos a visualizar el contenido del globo
                                                
                                                // var contenido='<div id="content" style="width: auto; height: auto;">' 
                                                //                 +'<a class="mr-0" href="'+this.link+'"><h5>'+this.nombre +'</h5></a><button class="btn btn-sm btn-primary" onclick="entregado('+place[5]+')">Entregado</button>' +  this.info
                                                //                 +'<button class="btn btn-sm btn-primary" onclick="entregado('+place[5]+')">Entregado</button>' 
                                                //             + '</div>';
                                                var contenido='<div id="content" style="width: auto; height: auto;">' 
                                                                +'<a class="mr-0" href="'+this.link+'"><h5>'+this.nombre +'</h5></a>' 
                                                                if(this.estado == 1){
                                                                    contenido += this.info
                                                                    +'<br>'
                                                                    +'<button class="btn btn-sm btn-warning" style="width: 100%; margin:auto" onclick="consolidar('+this.ven_id+')">Entregar</button>';
                                                                }else{
                                                                    contenido += '<span style="font-size:8pt;"><b>Fecha de entrega:</b> '+this.entrega_fecha+'<br><b>Hora:</b> '+this.entrega_hora+'</span>';
                                                                }
                                                contenido += '</div>';
                                                infowindow.setContent(contenido); //asignar el contenido al globo
                                                infowindow.open(map, this); //mostrarlo
                                            });
                                            }
                                        }
                                        // function entregado(estado){
                                        //     var base_url    = document.getElementById('base_url').value;
                                        //     var controlador = base_url+'detalle_venta/consolidar/'+venta;

                                        //     console.log (estado)
                                        //     // location.reload();
                                        // }
                                        
                                        //funcion para inicializar el mapa
                                        function initialize() {
                                            //iniciamos un nuevo mapa el div 'map' y le asignamos propiedades
                                            var map = new google.maps.Map(document.getElementById('map'), {
                                            center: new google.maps.LatLng(-17.4038, -66.1635), //coordenada inicial
                                            zoom: 14, //nivel de zoom
                                            mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa      
                                            
                                            }); 
                                            
                                            //llamar a la funcion que escribe los marcadores
                                            setMarkers(map, puntos);
                                    
                                        }
                                        function consolidar(venta){
                                            var base_url    = document.getElementById('base_url').value;
                                            var controlador = base_url+'detalle_venta/consolidar/'+venta;
                                            $.ajax({url: controlador,
                                                type:"POST",
                                                data:{},
                                                success:function(resul){                
                                                    // buscarventasdist();
                                                    location.reload();
                                                }
                                            });   
                                        }   
                                    
                                        initialize(); //inicializar el mapa
                                        </script>
                                        
                                    </td>
                                </tr>
                            </table>
                    
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- ---------------------------------MAPA---------------------------------------- -->

    <section class="col-lg-12 connectedSortable">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-money"></i>
                <h3 class="box-title">Ventas del mes</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <div class="box-body" id="div_grafica_barras" width="100%"></div>
                <?php 
                    // Pasando valores de php a js
                    $user_id = $usuario; 
                    $tipouser_id = $tipousuario_id;
                    // $ob_diario = $objetivo['diario'];
                ?>
            </div>
            <!-- <div class="box-body">
                <canvas id="myChart" width="400" height="150"></canvas>
            </div> -->
        </div>
    </section>

     

    <br>
    <section>
        <br>
            Ximpleman ver 2.0
    </section>
    <script> 
        var user_id = '<?php echo $user_id?>'; 
        var tipouser_id = '<?= $tipousuario_id ?>';
        console.log(tipouser_id);
    </script>
</body>


<!-- --------------------- INICIO Modal mensaje caja ------------------- -->
<div id="modal_mensajecaja" class="modal fade" role="dialog">
  <div class="modal-dialog" style="font-family: Arial">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #CC660E">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title"><fa class="fa fa-frown-o"></fa><b> ADVERTENCIA</b></h2>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
            <label for="monto_caja" class="control-label" style="font-size:12pt;">
                <fa class="fa fa-money fa-2x"></fa>
                Existe una caja iniciada/abierta
            </label>
            <br><b>Fecha apertura: </b><?php
                    $date = date_create($caja[0]["caja_fechaapertura"]);
                    $fechaapertura =  date_format($date,"d/m/Y");
                    echo $fechaapertura." ".$caja[0]["caja_horaapertura"] ?>
            <!--- br><b>Usuario:</b --> <?php //echo $nombre_usuario; ?>
                    
            <br><b>¿Desea cerrar la caja?</b>
        </div>  
        <div class="col-md-4">
            <!--<button class="btn btn-info btn-block" onclick="cerrar_caja()"><fa class="fa fa-money"></fa> Cierre de Caja</button>-->
            <a href="<?= base_url("caja/cierre_caja/".$caja[0]["caja_id"]) ?>" class="btn btn-info btn-block"><fa class="fa fa-money"></fa> Cierre de Caja</a>
            <a href="<?= base_url("venta/ventas") ?>" class="btn btn-facebook btn-block"><fa class="fa fa-cart-plus"></fa> Vender</a>
            <button class="btn btn-danger btn-block" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
        </div>  
      
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- --------------------- F I N Modal mensaje caja ------------------- -->

<!--------------------- modal apertura de caja ---------------->

<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalmensaje">Open Modal</button>-->

<!-- Modal -->
<div id="modalmensaje" class="modal fade" role="dialog">
  <div class="modal-dialog" style="font-family: Arial">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #CC660E">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title"><fa class="fa fa-frown-o"></fa><b> APERTURA DE CAJA</b></h2>
      </div>
      <div class="modal-body">
      
        
        <div class="col-md-6">
            <label for="monto_caja" class="control-label"><fa class="fa fa-money"></fa> <p> No realizó la apertura de caja..!</p></label>
<!--            <div class="form-group">
                <input type="text" name="monto_caja" value="0.00" class="form-control" id="monto_caja" onclick="this.select();" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
            </div>-->
        </div>  

        <div class="col-md-6">
<!--            <label for="producto_marca" class="control-label"><p>Monto Registrado en Caja Bs</p></label>
            <div class="form-group">
                <input type="text" name="producto_marca" value="S/N" class="form-control" id="producto_marca" onclick="this.select();" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
            </div>-->
            <button class="btn btn-info btn-block" data-dismiss="modal" onclick="modal_cajaabierta()"><fa class="fa fa-money"></fa> Registrar Caja</button>
            <button class="btn btn-danger btn-block" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
        </div>  
      
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>


<!--------------------- fin modal Mensaje ------------>


<!--------------------- modal apertura de caja ---------------->

<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="font-family: Arial">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c0ef">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><fa class="fa fa-money"></fa><b> APERTURA DE CAJA</b></h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12 text-bold">
          <span class="text-danger" id="elmensaje"></span>
        </div>
        <div class="col-md-6">
            <label for="monto_caja" class="control-label"><p>Monto inicial en caja Bs</p></label>
            <div class="form-group">
                <input type="text" name="monto_caja" id="monto_caja" value="0.00" class="form-control" id="monto_caja" onclick="this.select();" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
            </div>
        </div>  

        <div class="col-md-6">
<!--            <label for="producto_marca" class="control-label"><p>Monto Registrado en Caja Bs</p></label>
            <div class="form-group">
                <input type="text" name="producto_marca" value="S/N" class="form-control" id="producto_marca" onclick="this.select();" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
            </div>-->
            <button class="btn btn-warning btn-block" onclick="abrir_lacaja()"><fa class="fa fa-money"></fa> Registrar</button>
            <button class="btn btn-danger btn-block" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
        </div>  
      
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>


<!--------------------- fin modal apertura de caja ------------>
