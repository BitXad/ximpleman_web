<body onload="mostrar_grafica()">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ximpleman | Sistema Integral de Ventas</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />  
    <script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('resources/js/graficas.js'); ?>"></script>
    <script src="<?php echo base_url('resources/js/pedido_diario.js'); ?>"></script>
    <script src="<?php echo base_url('resources/js/highcharts.js'); ?>"></script>
        
    <!-- Main content -->
    <style>
        #map{
            width: 100%; 
            height: 500px;
        }
    </style>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            
            <div class="col-lg-3 col-xs-6">
            <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner" >
                        <h3><b><fa class="fa fa-cart-plus"></fa></b></h3>
                        <h5><b><?php echo " Bs ".number_format($ventas[0]['total_ventas'],2,'.',','); ?></b></h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cart-plus"></i>              
                    </div>
                    <a href="<?php echo base_url('venta/ventas'); ?>" class="small-box-footer"><?php echo "En ".$ventas[0]['cantidad_ventas']." ventas"; ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner" >
                        <h3><b><i class="fa fa-pencil-square-o" aria-hidden="true"></i></b></h3>
                        <h5><b><?php echo "Bs ".number_format($pedidos[0]['total_pedidos'],2,'.',','); ?><sup style="font-size: 20px"></sup></b></h5>
                    </div>
                    
                    <div class="icon">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>              
                    </div>
                    <a href="<?php echo base_url('pedido'); ?>" class="small-box-footer"><?php echo "En ".$pedidos[0]['cantidad_pedidos']." pedidos"; ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
            <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner" >
                        <h3><b><i class="fa fa-credit-card-alt" aria-hidden="true"></i></b></h3>
                        <h5><b><?= "Bs ".number_format($creditos[0]['total_ventas_credito'],2,'.',','); ?><sup style="font-size: 20px"></sup></b></h5>
                    </div>
                    
                    <div class="icon">
                        <i class="fa fa-credit-card-alt" aria-hidden="true"></i>              
                    </div>
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
                    <a href="<?= base_url('cliente'); ?>" class="small-box-footer"><?= "Clientes"; //$clientes[0]['total_clientes']." Clientes"; ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    
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
                        <a href="<?php echo site_url('pedido'); ?>" class="btn btn-danger btn-sm"><span class="fa fa-list"></span> Pedidos</a>
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
                            
                                punto = ['<?php echo $p['cliente_nombre']; ?>','<?php echo $p['cliente_latitud']; ?>','<?php echo $p['cliente_longitud']; ?>','<?php echo $p['cliente_direccion']; ?>','<?php echo $p['pedido_id']; ?>'];
                                puntos['<?php echo $i; ?>'] = punto;
                            <?php $i++; } ?>       
                    
                        
                //        punto=['Prueba nueva 2',-17.4138,-66.1735,'Micromercado el Papichin'];        
                //        puntos[1]=punto;
                //        
                //        punto=['Mas pruebas 3',-17.4125,-66.1720,'Micromercado el tribilin'];        
                //        puntos[2]=punto;
                //
                //    
                //    
                //    
                //        punto=['Mas pruebas 3',-17.4125,-66.1720,'Micromercado el tribilin'];        
                //        puntos[2]=punto;
                        
                        
                        
                    //funcion para posicionar los marcadores en el mapa
                    function setMarkers(map, puntos) {    
                        //limpiamos el contenido del globo de informacion
                        var infowindow = new google.maps.InfoWindow({
                            content: ''
                        });
                
                        //recorremos cada uno de los puntos
                        for (var i = 0; i < puntos.length; i++) {
                            
                        var place = puntos[i];
                        
                        //propiedades del marcador
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(place[1], place[2]), //posicion
                            map: map,
                            scrollwheel: false,
                            animation: google.maps.Animation.DROP, //animacion           
                            nombre: place[0], //personalizado - nombre del punto
                            info: place[3], //personalizado - informacion adicional
                            link: '<?php echo base_url().'pedido/comprobante/'; ?>'+place[4], //personalizado - informacion adicional              
                            icon:'<?php echo base_url().'resources/images/blue.png'; ?>'
                                    
                        });
                        
                        //se agrega el evento click a cada marcador, asi despliega la
                        //informacion nada uno de los marcadores
                        google.maps.event.addListener(marker, 'click', function() {
                            //html de como vamos a visualizar el contenido del globo
                            var contenido='<div id="content" style="width: auto; height: auto;">' +'<a href="'+this.link+'"><h5>'+this.nombre +'</h5></a>' +  this.info + '</div>';
                            infowindow.setContent(contenido); //asignar el contenido al globo
                            infowindow.open(map, this); //mostrarlo
                        });
                        }
                    }
                    
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
                <?php $user_id = $usuario; ?>
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
    <script> var user_id = '<?php echo $user_id?>'; </script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>  
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: 'Votos',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>  -->
</body>   