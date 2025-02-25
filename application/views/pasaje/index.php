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
                <h3 class="box-title">Pasaje  Listing</h3>
              <div class="box-tools">
                <a href="<?php echo site_url('pasaje/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
   <?php echo $this->session->flashdata('alert_msg');?>
            <div class="box-body table-responsive no-padding">
                <table id="example1" class="table table-striped">
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>FACTURA</th>
                    <th>ASIENTO</th>
                    <th>VIAJE</th>
                    <th>CLIENTE</th>
                    <th>NUMERO</th>
                    <th>PRECIO</th>
                    <th>NOMBRE</th>
                    <th>APELLIDOS</th>
                    <th>FECHA</th>
                    <th>HORA</th>
                    <th>ESTADO</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=$noof_page+1; 
           if(isset($pasaje) && $pasaje!=null)
           {
           foreach($pasaje as $p){ ?>
                    <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $p['pasaje_id']; ?></td>
                    <td><?php echo $p['factura_numero']; ?></td>
                    <td><?php echo $p['asiento_numero']; ?></td>
                    <td><?php echo $p['tipomovilidad_descripcion']; ?></td>
                    <td><?php echo $p['cliente_nombre']; ?></td>
                    <td><?php echo $p['pasaje_numero']; ?></td>
                    <td><?php echo $p['pasaje_precio']; ?></td>
                    <td><?php echo $p['pasaje_nombre']; ?></td>
                    <td><?php echo $p['pasaje_apellido']; ?></td>
                    <td><?php echo $p['pasaje_fecha']; ?></td>
                    <td><?php echo $p['pasaje_hora']; ?></td>
                    <td><?php echo $p['estado_descripcion']; ?></td>
                     <td><a href="<?php echo site_url('pasaje/edit/'.$p['pasaje_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                         <a
                            onclick="return confirm('Are you sure You want to delete?')"
                             href="<?php echo site_url('pasaje/remove/'.$p['pasaje_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
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

