<!-- --------------------------- script buscador ------------------------------------- -->
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
<style type="text/css">
    #contieneimg{
        width: 100px;
        height: 100px;
        text-align: center;
    }
</style>
<!-- --------------------------- fin script buscador ------------------------------------- -->
<!-- ---------------- ESTILO DE LAS TABLAS --------------- -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-- ---------------------------------------------------- -->
<div class="box-header">
<!--                <h3 class="box-title">Usuarios</h3>-->
            	<div class="box-tools">
                    <a href="<?php echo site_url('usuario/add'); ?>" class="btn btn-success btn-sm"><fa class="fa fa-user-plus"> </fa> Nuevo Usuario</a> 
                </div>
        
            <font size='4' face='Arial'><b>Usuarios</b></font>
            <br><font size='2' face='Arial' id="encontrados">Registros Encontrados:<?php echo sizeof($usuario);  ?></font> 
        
</div>


<div class="row">
    
    <!--<p style="margin-left: 20px;" class="text-danger">      <?php //echo $mensaje; ?></p>-->
    <div class="col-md-12">
        <!---- ----------------- parametro de buscador ------------------- -->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, login, email">
                  </div>
            <!-- ------------------- fin parametro de buscador ------------------- -->
        <div class="box">
            <?php if($this->session->flashdata('msg')): ?>
                <p><?php echo $this->session->flashdata('msg'); ?></p>
            <?php endif; ?>
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th></th>
                        <th>Nombre/Usuario</th>
                        <!--<th>Tipo</th>-->
                        <th>Email</th>
                        <th>Login</th>
                        <th>Perfil</th>
                        <th>Punto Venta</th>
                        <th>Horario</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <!--<th>Imagen</th>-->
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar">
                  <?php
                      $i=1;
                      $cont = 0;

                      foreach($usuario as $u) {
                      $cont = $cont+1;
                     /* $path_parts = pathinfo('./resources/images/usuarios/' .$u['usuario_imagen']);
                      $thumb = $path_parts['filename'] . '_thumb.' . $path_parts['extension'];
                      */
                      $thumb_default  = "thumb_default.jpg";
                      if ($u['usuario_imagen'] <> null && $u['usuario_imagen'] <> "") {
                          $thumb_default = "thumb_".$u['usuario_imagen'];
                      }
                  ?>

                    <tr>
                        <td style="background-color: #<?php echo $u['estado_color']; ?>"><?php echo $cont ?></td>
                        <td style="background-color: #<?php echo $u['estado_color']; ?>"><center> <?php echo "<img src='".site_url()."/resources/images/usuarios/".$thumb_default."' width='40' height='40' class='img-circle'"; ?></center></td>
                        <td style="background-color: #<?php echo $u['estado_color']; ?>"><font face="Arial" size="3"><b><?php echo $u['usuario_nombre']; ?></b></font>
                            <br>
                            <?php echo $u['tipousuario_descripcion']; ?></td>
                      	<td style="background-color: #<?php echo $u['estado_color']; ?>"><?php echo $u['usuario_email']; ?></td>
                        <td style="background-color: #<?php echo $u['estado_color']; ?>"><?php echo $u['usuario_login']; ?></td>
                        <td class="text-center" style="background-color: #<?php echo $u['estado_color']; ?>"><?php echo $u['parametro_id']; ?></td>
                        <td class="text-center" style="background-color: #<?php echo $u['estado_color']; ?>"><?php echo $u['puntoventa_codigo']; ?></td>
                        <td style="background-color: #<?php echo $u['estado_color']; ?>"><?php echo $u['usuario_turno']; ?></td>
                        <td style="background-color: #<?php echo $u['estado_color']; ?>"><?php echo $u['usuario_inicioturno']; ?></td>
                        <td style="background-color: #<?php echo $u['estado_color']; ?>"><?php echo $u['usuario_finturno']; ?></td>
                        <td style="background-color: #<?php echo $u['estado_color']; ?>"><?php echo $u['estado_descripcion']; ?></td>
                        <td style="background-color: #<?php echo $u['estado_color']; ?>">
                            
                            <a href="<?php echo site_url('usuario/editar/'. $u['usuario_id']); ?>" class="btn btn-info btn-xs" title="Modificar datos de usuario"><span class="fa fa-pencil"></span></a>
                            <!--<a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php //echo $i; ?>"  title="Eliminar"><em class="fa fa-trash"></em></a>-->
                            <?php
                            if($tipo_usuario_id == 1){
                            ?>
                            <a class="btn btn-soundcloud btn-xs" data-toggle="modal" data-target="#modalcambiar<?php echo $i; ?>"  title="Cambiar contraseña"><em class="fa fa-gear"></em></a>
                                <?php
                                if($u['estado_id'] == 1){
                                ?>
                                    <a onclick="return confirm('Esta seguro que quiere dar de baja a este Usuario del sistema?')" href="<?php echo site_url('usuario/dar_debajausuario/'.$u['usuario_id']); ?>" class="btn btn-xs" style='background-color: #00e765; color: white;' title="Dar de baja a este usuario del sistema"><span class="fa fa-toggle-on"></span></a>
                                <?php
                                }else{
                                ?>
                                    <a onclick="return confirm('Esta seguro que quiere dar de alta a este Usuario del sistema?')" href="<?php echo site_url('usuario/dar_dealtausuario/'.$u['usuario_id']); ?>" class="btn btn-xs" style='background-color: #8e8e91; color: black;' title="Dar de alta a este usuario del sistema"><span class="fa fa-toggle-off"></span></a>
                                <?php
                                }
                            }
                            ?>
                            
                            <!--<a href="<?php //echo site_url('usuario/password/'.$u['usuario_id']); ?>" class="btn btn-success btn-xs" title="Cambiar contraseña"><span class="fa fa-asterisk"></span></a>-->
                            <!------------------------ INICIO modal para cambiar PASSWORD ------------------->
                            <div class="modal fade" id="modalcambiar<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="modalcambiarlabel<?php echo $i; ?>">
                                <div class="modal-dialog" role="document">
                                    <br><br>
                                    <div class="modal-content">
                                        <div class="modal-header text-center text-bold" style="font-size: 12pt">
                                            <label>CAMBIAR CONTRASEÑA</label>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                        </div>
                                        <?php
                                            echo form_open('usuario/nueva_clave/'.$u['usuario_id']);
                                        ?>
                                        <div class="modal-body" style="font-size: 10pt">
                                            <!------------------------------------------------------------------->
                                            <div class="col-md-6">
						<label for="nuevo_pass<?php echo $u['usuario_id'] ?>" class="control-label">Nueva Contraseña</label>
						<div class="form-group">
                                                    <input type="password" name="<?php echo "nuevo_pass".$u['usuario_id'] ?>" class="form-control" id="nuevo_pass<?php echo $u['usuario_id'] ?>" />
                                                    <span class="text-danger"><?php echo form_error('nuevo_pass'.$u['usuario_id']);?></span>
						</div>
                                            </div>
                                            <div class="col-md-6">
						<label for="repita_pass<?php echo $u['usuario_id'] ?>" class="control-label">Repita Contraseña</label>
						<div class="form-group">
                                                    <input type="password" name="<?php echo "repita_pass".$u['usuario_id'] ?>" class="form-control" id="repita_pass<?php echo $u['usuario_id'] ?>" />
                                                    <span class="text-danger"><?php echo form_error('repita_pass'.$u['usuario_id']);?></span>
						</div>
                                            </div>
                                            <!------------------------------------------------------------------->
                                        </div>
                                        <div class="modal-footer aligncenter">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-check"></i> Cambiar
                                            </button>
                                            <!--<a href="<?php //echo site_url('usuario/nueva_clave/'.$u['usuario_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Cambiar </a>-->
                                            <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar </a>
                                        </div>
                                        <?php
                                        echo form_close();
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!------------------------ FIN modal para cambiar PASSWORD ------------------->
                            
                        </td>
                    </tr>
                  
                             <!-- ---------------------- modal para eliminar el producto ----------------- -->
                                    <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                    <!--        <h4 class="modal-title" id="myModalLabel">LISTA DE PRODUCTOS</h4>-->
                                          </div>
                                          <div class="modal-body">

                                           <!-- --------------------------------------------------------------- -->

                                           <h1><b> <em class="fa fa-trash"></b></em> 
                                               ¿Desea eliminar el usuario <b> <?php echo $u['usuario_nombre']; ?></b> seleccionado?
                                           </h1>
                                           <!-- --------------------------------------------------------------- -->
                                          </div>
                                          <div class="modal-footer aligncenter">


                                                      <a href="<?php echo site_url('usuario/remove/'.$u['usuario_id']); ?>" class="btn btn-danger"><em class="fa fa-pencil"></em> Si </a></a>

                                                      <a href="#" class="btn btn-success" data-dismiss="modal"><em class="fa fa-times"></em> No </a>
                                          </div>

                                        </div>
                                      </div>
                                    </div>

                                    
                   <td hidden="hidden"><?php echo $i++; ?></td>
                    <?php  }?>  
                </table>
                
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
    </div>
</div>

<?php
if(isset($mensaje)){
    if($mensaje == "a"){
?>
<script type="text/javascript">
    alert("Contraseña modificada con exito");
</script>
<?php
$mensaje = "";
    }elseif($mensaje == "b"){
?>
<script type="text/javascript">
    alert("Las contraseñas no coinciden");
</script>
<?php
$mensaje = "";
    }
}
?>