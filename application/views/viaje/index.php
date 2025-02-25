 <!-- DataTables -->
 <link rel="stylesheet" href="<?php echo base_url('resources/plugins/datatables.net-bs');  ?>/css/dataTables.bootstrap.min.css">
<!-- DataTables -->
<script src="<?php echo base_url('resources/plugins/datatables.net');  ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('resources/plugins/datatables.net-bs');  ?>/js/dataTables.bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    
     <!--Styles for datatables--> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
     <!--JQuery include--> 
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
     <!--Javascrips for datatables--> 
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> 
    
     <link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet"> 

 <script>
                  $(function () {
                    $('#example1').DataTable()
                    $('#example2').DataTable({
                      'paging'      : true,
                      'lengthChange': false,
                      'searching'   : false,
                      'ordering'    : true,
                      'info'        : true,
                      'autoWidth'   : false
                    })
                  })
                  </script>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Viajes</h3>
              <div class="box-tools">
                <a href="<?php echo site_url('viaje/add'); ?>" class="btn btn-success btn-sm">Añadir</a> 
                </div>
   <?php //echo $this->session->flashdata('alert_msg');?>
            <div class="box-body table-responsive no-padding">
                <!--<table id="example1" class="table table-striped">-->
                <table id="mitabla" class="table table-striped">
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>RUTA</th>
                    <th>COD</th>
                    <th>VEHICULO</th>
                    <th>CONDUCTOR</th>
                    <th>AYUDANTE</th>
                    <th>FECHA SALIDA</th>
                    <th>HORA SALIDA</th>
                    <th>FECHA LLEGADA</th>
                    <th>HORA LLEGADA</th>
                    <th>USUARIO</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=$noof_page+1; 
           if(isset($viaje) && $viaje!=null)
           {
               //var_dump($viaje);
               
           foreach($viaje as $v){ ?>
                    <tr>
                    <td><?php echo $i++; ?></td>
                    <td>
                        <?php echo "<fa class='fa fa-bus'></fa> ".$v['ruta_nombre']; ?>
                    
                    </td>
                    <td style="text-align: center;"><?php echo "00".$v['viaje_id']; ?></td>
                    <td><?php echo $v['vehiculo_modelo']; ?></td>
                    <td><?php echo $v['conductor_apellidos']." ".$v['conductor_nombres']; ?></td>
                    <td><?php echo $v['ayudante_apellidos']." ".$v['ayudante_nombres']; ?></td>
                    <td style="text-align: center;"><?php echo $v['viaje_fechasalida']; ?></td>
                    <td style="text-align: center;"><?php echo $v['viaje_horasalida']; ?></td>
                    <td style="text-align: center;"><?php echo $v['viaje_fechallegada']; ?></td>
                    <td style="text-align: center;"><?php echo $v['viaje_horallegada']; ?></td>
                    <td><?php echo $v['usuario_nombre']; ?></td>
                     <td><a href="<?php echo site_url('viaje/edit/'.$v['viaje_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> </a> 
                         <a
                            onclick="return confirm('Are you sure You want to delete?')"
                             href="<?php echo site_url('viaje/remove/'.$v['viaje_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> </a>
                     </td>
                    </tr>
                     <?php }
                    
                           }else{
                                  echo 'No data found';
                             }

          ?>
                    </tbody>
                </table>
                <div class="pull-right">
                      <?php echo $this->pagination->create_links(); ?> 
                </div>
            </div>

        </div>
    </div>

</div>

