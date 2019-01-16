<!----------------------------- script buscador --------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
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
<script type="text/javascript">
    function buscarproveedor(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13){
            var base_url = document.getElementById('base_url').value;
            var filtro = document.getElementById('filtrar').value;
            location.href=base_url+"proveedor/buscarproveedor/"+filtro;
        }
    }
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<style type="text/css">
    td img{
        width: 70px;
        height: 70px;
        margin-right: 5px;
    }
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masg{
        font-size: 12px;
    }
    td div div{
        
    }
</style>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
                <h3 class="box-title">Proveedor</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('proveedor/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                      <input id="filtrar" type="text" class="form-control" onkeypress="buscarproveedor(event)" placeholder="Ingrese el código, nombre, contacto, nit">
                  </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>N°</th>
						
						<th>Nombre</th>
						<th>Dirección</th>
						<th>Email</th>
						<th>Nit</th>
						<th>Razón</th>
						<th>Estado</th>
						<!--<th>Autorización</th>-->
						<th></th>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($proveedor as $p){;
                                 $cont = $cont+1; ?>
                    <tr>
                            <td><?php echo $cont; ?></td>
                            <td><div id="horizontal">
                                    <div>
                                    <?php echo '<img src="'.site_url('/resources/images/proveedores/'.$p['proveedor_foto']).'" />'; ?>
                                    </div>
                                    <div><?php
                                        echo $p['proveedor_nombre']."<br>";
                                        echo "<b>Cod: </b>".$p['proveedor_codigo']."<br>";
                                        echo "<b>Cont.: </b>".$p['proveedor_contacto']."<br>";
                                        echo "<b>Tel.: </b>".$p['proveedor_telefono']."-".$p['proveedor_telefono2'];
                                        ?>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $p['proveedor_direccion']; ?></td>
                            <td><?php echo $p['proveedor_email']; ?></td>
                            <td><?php echo $p['proveedor_nit']; ?></td>
                            <td><?php echo $p['proveedor_razon']; ?></td>
                            <td style="background-color: #<?php echo $p['estado_color']; ?>"><?php echo $p['estado_descripcion']; ?></td>

                            <!--<td><?php //echo $p['proveedor_autorizacion']; ?></td>-->
                            <td>
                            <a href="<?php echo site_url('proveedor/edit/'.$p['proveedor_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <!--<a href="<?php echo site_url('proveedor/remove/'.$p['proveedor_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>
        </div>
        <?php
            if($a =="1"){
                ?>
                <a href="<?php echo site_url('proveedor'); ?>" class="btn btn-danger">
                                <i class="fa fa-arrow-left"></i> Atras</a>
            <?php
            }
            ?>
    </div>
</div>
