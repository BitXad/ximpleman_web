 <!-- DataTables -->
 <link rel="stylesheet" href="<?php echo base_url('resources/plugins/datatables.net-bs');  ?>/css/dataTables.bootstrap.min.css">
<!-- DataTables -->
<script src="<?php echo base_url('resources/plugins/datatables.net');  ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('resources/plugins/datatables.net-bs');  ?>/js/dataTables.bootstrap.min.js"></script>
 <link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet"> 
 

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
                <h3 class="box-title">Asientos</h3>
              <div class="box-tools">
                <a href="<?php echo site_url('asientos/add'); ?>" class="btn btn-success btn-sm">Añadir</a> 
                </div>
   <?php //echo $this->session->flashdata('alert_msg');?>
            <div class="box-body table-responsive no-padding">
                <table id="mitabla" class="table table-striped">
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>NIVEL</th>
                    <th>NUMERO</th>
                    <th>DESCRIPCION</th>
                    <th>CARACTERISTICAS</th>
                    <th>FOTO</th>
                    <th>ORDEN</th>
                    <th>POS. X</th>
                    <th>POS. Y</th>
                    <th>VEHICULO</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=$noof_page+1; 
           if(isset($asientos) && $asientos!=null)
           {
           foreach($asientos as $a){ ?>
                    <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $a['asiento_id']; ?></td>
                    <td><?php echo $a['nivel_nombre']; ?></td>
                    <td><?php echo $a['asiento_numero']; ?></td>
                    <td><?php echo $a['asiento_descripcion']; ?></td>
                    <td><?php echo $a['asiento_caracteristicas']; ?></td>
                    <td><img width="30" height="30" src="<?php echo base_url('resources/asiento_foto/').$a['asiento_foto']; ?>"></td>                    <td><?php echo $a['asiento_orden']; ?></td>
                    <td><?php echo $a['asiento_x']; ?></td>
                    <td><?php echo $a['asiento_y']; ?></td>
                    <td><?php echo $a['vehiculo_marca']; ?></td>
                    <td><a href="<?php echo site_url('asientos/edit/'.$a['asiento_id']); ?>" class="btn btn-info btn-xs" title="Modificar"><span class="fa fa-pencil"></span> </a> 
                         <a
                            onclick="return confirm('Are you sure You want to delete?')"
                            href="<?php echo site_url('asientos/remove/'.$a['asiento_id']); ?>" class="btn btn-danger btn-xs" title="Eliminar"><span class="fa fa-trash"></span> </a>
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

