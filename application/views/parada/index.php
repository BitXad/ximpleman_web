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
                <h3 class="box-title">Parada  Listing</h3>
              <div class="box-tools">
                <a href="<?php echo site_url('parada/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
   <?php echo $this->session->flashdata('alert_msg');?>
            <div class="box-body table-responsive no-padding">
                <table id="example1" class="table table-striped">
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>ESTADO</th>
                    <th>PARADA</th>
                    <th>UBICACION</th>
                    <th>LATITUD</th>
                    <th>LONGITUD</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=$noof_page+1; 
           if(isset($parada) && $parada!=null)
           {
           foreach($parada as $p){ ?>
                    <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $p['parada_id']; ?></td>
                    <td><?php echo $p['estado_descripcion']; ?></td>
                    <td><?php echo $p['parada_nombre']; ?></td>
                    <td><?php echo $p['parada_ubicacion']; ?></td>
                    <td><?php echo $p['parada_latitud']; ?></td>
                    <td><?php echo $p['parada_longitud']; ?></td>
                     <td><a href="<?php echo site_url('parada/edit/'.$p['parada_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                         <a
                            onclick="return confirm('Are you sure You want to delete?')"
                             href="<?php echo site_url('parada/remove/'.$p['parada_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
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

