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
            <div class="box-header">
                <h3 class="box-title">NIVEL</h3>
                <div class="box-tools">
                <a href="<?php echo site_url('nivel_vehiculo/add'); ?>" class="btn btn-success btn-sm">Añadir</a> 
                </div>
            </div>
              
<div class="row">
    <div class="col-md-12">
        <div class="box">
   <?php //echo $this->session->flashdata('alert_msg');?>
            <div class="box-body table-responsive no-padding">
                <table id="mitabla" class="table table-striped">
                    <thead>
                    <tr>
                    <th>#</th>
                    <!--<th>ID</th>-->
                    <th>NOMBRE</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=$noof_page+1; 
           if(isset($nivel_vehiculo) && $nivel_vehiculo!=null)
           {
           foreach($nivel_vehiculo as $n){ ?>
                    <tr>
                    <td><?php echo $i++; ?></td>
                    <!--<td><?php echo $n['nivel_id']; ?></td>-->
                    <td><?php echo $n['nivel_nombre']."<sub>[".$n['nivel_nombre']."]</sub>"; ?></td>
                    <td><a href="<?php echo site_url('nivel_vehiculo/edit/'.$n['nivel_id']); ?>" class="btn btn-info btn-xs" title="Modificar"><span class="fa fa-pencil"></span> </a> 
                         <a
                            onclick="return confirm('Are you sure You want to delete?')"
                             href="<?php echo site_url('nivel_vehiculo/remove/'.$n['nivel_id']); ?>" class="btn btn-danger btn-xs" title="Modificar".><span class="fa fa-trash"></span> </a>
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

