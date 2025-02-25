 <!-- DataTables -->
 <link rel="stylesheet" href="<?php echo base_url('resources/plugins/datatables.net-bs');  ?>/css/dataTables.bootstrap.min.css">
<!-- DataTables -->
<script src="<?php echo base_url('resources/plugins/datatables.net');  ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('resources/plugins/datatables.net-bs');  ?>/js/dataTables.bootstrap.min.js"></script>
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
                <h3 class="box-title">Vehiculo  Listing</h3>
              <div class="box-tools">
                <a href="<?php echo site_url('vehiculo/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
   <?php echo $this->session->flashdata('alert_msg');?>
            <div class="box-body table-responsive no-padding">
                <table id="example1" class="table table-striped">
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>APELLIDOS PROPIETARIO</th>
                    <th>NOMBRES PROPIETARIO</th>
                    <th>ESTADO</th>
                    <th>TIPO MOVILIDAD</th>
                    <th>CATEGORIA VEHICULO</th>
                    <th>ASIENTO</th>
                    <th>PLACA</th>
                    <th>CLASE VEHICULO</th>
                    <th>MARCA</th>
                    <th>MODELO</th>
                    <th>AÑO FABRICACION</th>
                    <th>TIPO COMBUSTIBLE</th>
                    <th>CARROCERIA</th>
                    <th>NUM. EJES</th>
                    <th>COLOR</th>
                    <th>NUM. MOTOR</th>
                    <th>NUM. CILINDROS</th>
                    <th>SERIE</th>
                    <th>NUM. RUEDAS</th>
                    <th>PESO SECO</th>
                    <th>PESO BRUTO</th>
                    <th>LONGITUD</th>
                    <th>ALTURA</th>
                    <th>ANCHO</th>
                    <th>NUM. PASAJEROS</th>
                    <th>TIPO SERVICIO</th>
                    <th>NUM. ASIENTOS</th>
                    <th>RUAT</th>
                    <th>LIM. TARJETA</th>
                    <th>TARJETA CIRCULACION</th>
                    <th>IMAGEN</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=$noof_page+1; 
           if(isset($vehiculo) && $vehiculo!=null)
           {
           foreach($vehiculo as $v){ ?>
                    <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $v['vehiculo_id']; ?></td>
                    <td><?php echo $v['vehiculo_apellidospropietario']; ?></td>
                    <td><?php echo $v['vehiculo_nombrespropietario']; ?></td>
                    <td><?php echo $v['estado_id']; ?></td>
                    <td><?php echo $v['tipomovilidad_id']; ?></td>
                    <td><?php echo $v['categoriavehiculo_id']; ?></td>
                    <td><?php echo $v['asiento_id']; ?></td>
                    <td><?php echo $v['vehiculo_placa']; ?></td>
                    <td><?php echo $v['vehiculo_clase']; ?></td>
                    <td><?php echo $v['vehiculo_marca']; ?></td>
                    <td><?php echo $v['vehiculo_modelo']; ?></td>
                    <td><?php echo $v['vehiculo_aniofabricacion']; ?></td>
                    <td><?php echo $v['vehiculo_tipocombustible']; ?></td>
                    <td><?php echo $v['vehiculo_carroceria']; ?></td>
                    <td><?php echo $v['vehiculo_ejes']; ?></td>
                    <td><?php echo $v['vehiculo_color']; ?></td>
                    <td><?php echo $v['vehiculo_numeromotor']; ?></td>
                    <td><?php echo $v['vehiculo_cilindros']; ?></td>
                    <td><?php echo $v['vehiculo_serie']; ?></td>
                    <td><?php echo $v['vehiculo_ruedas']; ?></td>
                    <td><?php echo $v['vehiculo_pesoseco']; ?></td>
                    <td><?php echo $v['vehiculo_pesobruto']; ?></td>
                    <td><?php echo $v['vehiculo_longitud']; ?></td>
                    <td><?php echo $v['vehiculo_altura']; ?></td>
                    <td><?php echo $v['vehiculo_ancho']; ?></td>
                    <td><?php echo $v['vehiculo_pasajeros']; ?></td>
                    <td><?php echo $v['vehiculo_tiposervicio']; ?></td>
                    <td><?php echo $v['vehiculo_asientos']; ?></td>
                    <td><?php echo $v['vehiculo_ruat']; ?></td>
                    <td><?php echo $v['vehiculo_fechatarjeta']; ?></td>
                    <td><?php echo $v['vehiculo_tarjetacirculacion']; ?></td>
                    <td><?php echo $v['vehiculo_imagen']; ?></td>
                     <td><a href="<?php echo site_url('vehiculo/edit/'.$v['vehiculo_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                         <a
                            onclick="return confirm('Are you sure You want to delete?')"
                             href="<?php echo site_url('vehiculo/remove/'.$v['vehiculo_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
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

