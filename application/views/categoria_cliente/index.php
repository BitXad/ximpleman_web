<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<div class="box-header">
    <font size='4' face='Arial'><b>Categoria Negocio</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($categoria_cliente); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('categoria_cliente/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Categoria</a> 
    </div>
</div>
    <div class="col-md-12">
                    <!--------------------- parametro de buscador --------------------->
                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese la descripción , porcentaje  o monto">
                  </div>
            <!--------------------- fin parametro de buscador ---------------------> 
        
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>#</th>
						<th>Descripción</th>
						<th>Porc.<br>Desc.</th>
						<th>Monto<br>Desc.</th>
                                                <th class="no-print"></th>
                    </tr>
                    <tbody class="buscar">
                    <?php
                         $i = 0;
                         foreach($categoria_cliente as $c){;
                            $i = $i+1;
                         ?>
                    <tr>
                        <td><?php echo $i ?></td>
						<!--<td><?php //echo $c['categoriaclie_id']; ?></td>-->
						<td><?php echo $c['categoriaclie_descripcion']; ?><sub> [<?php echo $c['categoriaclie_id']; ?>]</sub></td>
						<td><?php echo $c['categoriaclie_porcdesc']; ?></td>
						<td><?php echo $c['categoriaclie_montodesc']; ?></td>
                                                <td class="no-print">
						<!------------------------ INICIO modal para confirmar eliminación ------------------->
                                    <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3><b> <span class="fa fa-trash"></span></b>
                                               ¿Desea eliminar la categoria de Cliente <b> <?php echo $c['categoriaclie_descripcion']; ?></b>?
                                           </h3>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a href="<?php echo site_url('categoria_cliente/remove/'.$c['categoriaclie_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                        <!------------------------ FIN modal para confirmar eliminación ------------------->
                            <a href="<?php echo site_url('categoria_cliente/edit/'.$c['categoriaclie_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <!--<a data-toggle="modal" data-target="#myModal<?php //echo $i; ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                        </td>
                    </tr>
                    <?php } //$cont = 0; ?>
                </table>
                               
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
            </div> 
        </div>
    </div>
</div>

<?php
//echo $grid_html; 

?>
<?php
//echo $grid2_html; 

?>



    <div class="container table-responsive">
        <div class="page-header">
<!--            <h1>SmartGrid for CodeIgniter with Bootstrap - Example with DataTables</h1>-->
        </div>
        
        <!-- Print the SmartGrid html -->
        <?php echo isset($grid2_html) ? $grid2_html : ''; ?>
        <br />
    </div>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    
    <!-- Styles for datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <!-- JQuery include -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
    <!-- Javascrips for datatables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>    
    <!-- Now make the SmartGrid work with datatables 
         'sg-table' is the id of the main table in SmartGrid -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sg-table').DataTable();
        });
    </script> 

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SmartGrid for CodeIgniter - Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
</head>
<body>

    <div class="container">
        <div class="page-header">
            <h1>SmartGrid for CodeIgniter with Bootstrap - Example</h1>
        </div>

        <form class="form-inline" method="POST">
            <div class="form-group">
              <label for="employee_name">Employee Name</label>
              <input type="text" class="form-control" id="employee_name" name="employee_name" placeholder="Employee Name" value="<?php echo isset($employee_name) ? $employee_name : ''; ?>">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
        </form>
        <hr />

        <!-- Print the SmartGrid html -->
        <?php echo isset($grid2_html) ? $grid2_html : ''; ?>
        
    </div>

</body>
</html>