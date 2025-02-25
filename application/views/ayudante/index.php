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
                <h3 class="box-title">Ayudante  Listing</h3>
              <div class="box-tools">
                <a href="<?php echo site_url('ayudante/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
   <?php echo $this->session->flashdata('alert_msg');?>
            <div class="box-body table-responsive no-padding">
                <table id="mitabla" class="table table-striped">
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>NOMBRES</th>
                    <th>APELLIDOS</th>
                    <th>CODIGO</th>
                    <th>C.I.</th>
                    <th>LICENCIA</th>
                    <th>CATEGORIA</th>
                    <th>TELEFONO</th>
                    <th>FOTO</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=$noof_page+1; 
           if(isset($ayudante) && $ayudante!=null)
           {
           foreach($ayudante as $a){ ?>
                    <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $a['ayudante_id']; ?></td>
                    <td><?php echo $a['ayudante_nombres']; ?></td>
                    <td><?php echo $a['ayudante_apellidos']; ?></td>
                    <td><?php echo $a['ayudante_codigo']; ?></td>
                    <td><?php echo $a['ayudante_ci']; ?></td>
                    <td><?php echo $a['ayudante_licencia']; ?></td>
                    <td><?php echo $a['ayudante_categoria']; ?></td>
                    <td><?php echo $a['ayudante_telefono']; ?></td>
                    <td><img width="30" height="30" src="<?php echo base_url('resource/ayudante_foto/').$a['ayudante_foto']; ?>"></td>                     <td><a href="<?php echo site_url('ayudante/edit/'.$a['ayudante_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                         <a
                            onclick="return confirm('Are you sure You want to delete?')"
                             href="<?php echo site_url('ayudante/remove/'.$a['ayudante_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
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

