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
                <h3 class="box-title">Rol</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('rol/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese la descripción">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    

    <?php foreach($rol as $r){ if ($r['rol_idfk']==0)  { ?>
    <tr>             <th>Rol Id</th>
                        <th>Rol Superior</th>
                        <th>Estado Id</th>
                        <th>Rol Descripcion</th>
                        <th></th>
                      </tr>
                        <td><?php echo $r['rol_id']; ?></td>
                        <td><?php echo $r['Rol_superior']; ?></td>
                        <td><?php echo $r['estado_descripcion']; ?></td>
                        <td><b><?php echo $r['rol_descripcion']; ?></td></b>
                   
                         <?php foreach($rol as $rh){  if ($r['rol_id']==$rh['rol_idfk'])  { ?> 
                            <tr>
                       
</tr>  
                        
                        <td><?php echo $rh['rol_id']; ?></td>
                        <td><?php echo $rh['Rol_superior']; ?></td>
                        <td><?php echo $rh['estado_descripcion']; ?></td>
                        <td><?php echo $rh['rol_descripcion']; ?></td>
                        <td>
                            <a href="<?php echo site_url('rol/edit/'.$r['rol_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                           
                        </td>
                  
                    <?php } } } } ?>
                </table>
                               
            </div>
             
        </div>
    </div>
</div>
