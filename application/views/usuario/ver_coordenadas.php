<style>
  #map{
    width: 800px; 
    height: 500px;
  }
</style>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Ver Ubicación de mis Clientes</h3>
            </div>
				<div class="row clearfix">
                                    <div class="col-md-6">
                                        <div id="map"></div> <!-- mapa -->
                                    </div>
                                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5L7UMFw0GxFZgVXCfMLhGVK5Gn7HvG_U"></script>
                                    <script>      
      //coordada inicial del mapa
      var coordenadas= new google.maps.LatLng(-17.4038, -66.1635);
      
      //variable para globos de informacion
      var infowindow = true;
 
      //puntos a ser marcados en el mapa
      var puntos = [];
      
        var punto;
      
       
       <?php    $i=0;
                //$this->load->model('Cliente_model');
                $misclientes = $cliente->Cliente_model->get_all_ubicacion_clientes($usuario['usuario_id']);
                if(isset($misclientes)){
                    foreach ($misclientes as $micliente){
                        $latini = $micliente['cliente_latitud'];
                        $lngini = $micliente['cliente_longitud'];
                        ?>
                        punto=['<?php echo $micliente['cliente_nombre']; ?>','<?php echo $micliente['cliente_latitud']; ?>','<?php echo $micliente['cliente_longitud']; ?>','<?php echo $micliente['cliente_nombrenegocio']; ?>','<?php echo $micliente['cliente_direccion']; ?>','<?php echo $micliente['cliente_telefono']; ?>','<?php echo $micliente['cliente_celular']; ?>','<?php echo $micliente['cliente_id']; ?>'];
                        puntos['<?php echo $i; ?>']=punto;
                <?php $i++; } 
                } ?>
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
              link: '<?php echo base_url().'pedido/index/'; ?>'+place[7] //personalizado - informacion adicional
                     
          });
          
          //se agrega el evento click a cada marcador, asi despliega la
          //informacion nada uno de los marcadores
          google.maps.event.addListener(marker, 'click', function() {
            //html de como vamos a visualizar el contenido del globo
            var contenido='<div id="content" style="width: auto; height: auto;">' +'<a href="'+this.link+'"><h5>'+this.nombre +'</h5></a>Negocio: ' +  this.info+'<br>Dirección: '+place[4]+'<br>Teléfonos:'+place[5]+'&nbsp'+place[6]+ '</div>';
            infowindow.setContent(contenido); //asignar el contenido al globo
            infowindow.open(map, this); //mostrarlo
          });
        }
      }
      
      //funcion para inicializar el mapa
      function initialize() {
        //iniciamos un nuevo mapa el div 'map' y le asignamos propiedades
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(<?php echo $latini ?>, <?php echo $lngini ?>), //coordenada inicial
          zoom: 14, //nivel de zoom
          mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa      
          
        }); 
        
        //llamar a la funcion que escribe los marcadores
        setMarkers(map, puntos);
 
      }
 
      initialize(); //inicializar el mapa
    </script>
	</div>
            <br>
            <a href="<?php echo site_url('usuario/prevendedores'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Atras</a>
</div>