<center style='line-height: 10px;'>    
    <h3>LINEA SINDICAL<br>
        <b>FLOTA UNIFICADO</b></h3>
</center>
    <div class="row">
    <div class="col-md-3">
    </div>
        
    <div class="col-md-6">
        <?php
        $buttons = [
            ['url' => 'asientos', 'icon' => 'fa-chair', 'label' => 'Asientos'],
            ['url' => 'ayudante', 'icon' => 'fa-user-friends', 'label' => 'Ayudante'],
            ['url' => 'categoria_vehiculo', 'icon' => 'fa-car', 'label' => 'Categoría Vehículo'],
            ['url' => 'cliente', 'icon' => 'fa-user', 'label' => 'Cliente'],
            ['url' => 'conductor', 'icon' => 'fa-id-badge', 'label' => 'Conductor'],
            ['url' => 'destino', 'icon' => 'fa-map-marker-alt', 'label' => 'Destino'],
            ['url' => 'estado', 'icon' => 'fa-toggle-on', 'label' => 'Estado'],
            ['url' => 'factura', 'icon' => 'fa-file-invoice-dollar', 'label' => 'Factura'],
            ['url' => 'nivel_vehiculo', 'icon' => 'fa-layer-group', 'label' => 'Nivel Vehículo'],
            ['url' => 'origen', 'icon' => 'fa-map-marker', 'label' => 'Origen'],
            ['url' => 'parada', 'icon' => 'fa-stop', 'label' => 'Parada'],
            ['url' => 'pasaje', 'icon' => 'fa-ticket-alt', 'label' => 'Pasaje'],
            ['url' => 'ruta', 'icon' => 'fa-road', 'label' => 'Ruta'],
            ['url' => 'tipo_vehiculo', 'icon' => 'fa-bus-alt', 'label' => 'Tipo Vehículo'],
            ['url' => 'usuario', 'icon' => 'fa-users', 'label' => 'Usuario'],
            ['url' => 'vehiculo', 'icon' => 'fa-truck', 'label' => 'Vehículo'],
            ['url' => 'viaje', 'icon' => 'fa-plane', 'label' => 'Viaje'],
        ];

        foreach ($buttons as $button): ?>
                <div class="col-md-2" style='line-height: 20px;'>

                    <a href="<?php echo base_url($button['url']); ?>" class="btn btn-facebook btn-xs" style="width: 100px; height: 100px;">
                        <br>
                        <br>
                        <i class="fas <?php echo $button['icon']; ?>" style="font-size: 20pt;"></i><br><br>
                        <span><?php echo $button['label']; ?></span>
                    </a>
                    
                </div>
        <?php endforeach; ?>
       
    </div>
        
    <div class="col-md-3">
    </div>
        
    </div>
