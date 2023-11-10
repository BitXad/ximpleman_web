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
    <font size='4' face='Arial'><b>Categoria Cliente</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($categoria_cliente); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('categoria_cliente/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Categoria</a> 
    </div>
</div>
    

<?php
//echo $grid_html; 

?>
<?php
//echo $grid2_html; 

?>



<!--    <div class="container table-responsive">
        <div class="page-header">
            <h1>SmartGrid for CodeIgniter with Bootstrap - Example with DataTables</h1>
        </div>
        
         Print the SmartGrid html 
        <?php echo isset($grid2_html) ? $grid2_html : ''; ?>
        <br />
    </div>-->
    
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
	<title>Lista de Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
</head>
<body>

    <!--<div class="container">-->
<!--        <div class="page-header">
            <h1>Lista de Productos</h1>
        </div>-->

<!--        <form class="form-inline no-print" method="POST">
            <div class="form-group">
              <label for="producto_nombre">Producto</label>
              <input type="text" class="form-control" id="producto_nombre" name="producto_nombre" placeholder="Producto" value="<?php echo isset($producto_nombre) ? $producto_nombre : ''; ?>">
            </div>
            <button type="submit" class="btn btn-default">Buscar</button>
        </form>-->
        <hr />

        <div class="table-responsive">
            <?php echo isset($grid2_html) ? $grid2_html : ''; ?>
            
        </div>
        <!-- Print the SmartGrid html -->
        
  

</body>
</html>