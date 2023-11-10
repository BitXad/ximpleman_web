<link href="<?php echo site_url('resources/css/formValidation.css')?>" rel="stylesheet">

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Usuario</h3>
            </div>

<!--            <ol class="breadcrumb">
                <li><a href="<?php //echo site_url('admin/dashb')?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="<?php //echo site_url('usuario')?>">Usuarios</a></li>
                <li class="active">Editar Usuario</li>
            </ol>-->

            <?php $attributes = array("name" => "usuarioForm", "id"=>"usuarioForm");
            echo form_open_multipart("usuario/set", $attributes);?>
			<div class="box-body">
				<div class="row clearfix">
                                    
                                        <div class="col-md-5">
						<label for="usuario_nombre" class="control-label">Nombre(s) y Apellido(s)</label>
						<div class="form-group">
							<input type="text" name="usuario_nombre" value="<?php echo $usuario['usuario_nombre'] ?>" class="form-control" id="usuario_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"autocomplete="off" />
							<span class="text-danger"><?php echo form_error('usuario_nombre');?></span>
						</div>
					</div>
                                        <div class="col-md-4">
						<label for="usuario_ci" class="control-label">C.I.</label>
						<div class="form-group">
							<input type="text" name="usuario_ci" value="<?php echo $usuario['usuario_ci'] ?>" class="form-control" id="usuario_ci" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
							<span class="text-danger"><?php echo form_error('usuario_ci');?></span>
						</div>
					</div>
                                    
					<div class="col-md-3">
						<label for="tipousuario_id" class="control-label">Tipo</label>
						<div class="form-group">
							<select name="tipousuario_id" class="form-control">
								<option value="">seleccionar tipo de usuario</option>
								<?php 
								foreach($all_tipo_usuario as $tipo_usuario)
								{
									$selected = ($tipo_usuario['tipousuario_id'] == $usuario['tipousuario_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$tipo_usuario['tipousuario_id'].'" '.$selected.'>'.$tipo_usuario['tipousuario_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
				
					<div class="col-md-6">
						<label for="usuario_email" class="control-label">Email</label>
						<div class="form-group">
                            <input type="email" minlength="5" maxlength="250" name="usuario_email" value="<?php echo $usuario['usuario_email'] ?>" class="form-control" id="usuario_email" autocomplete="off"/>
							<span class="text-danger"><?php echo form_error('usuario_email');?></span>
						</div>
					</div>
                    <div class="col-md-3">
                        <label for="parametro_id" class="control-label">Perfil</label>
                        <div class="form-group">
                            <select name="parametro_id" id="parametro_id" class="form-control">
                                <!--<option value="1">ACTIVO</option>-->
                                <?php 
                                foreach($all_parametros as $parametro)
                                {
                                    $selected = ($parametro['parametro_id'] == $usuario['parametro_id']) ? ' selected="selected"' : "";
                                    echo '<option value="'.$parametro['parametro_id'].'" '.$selected.'>'.$parametro['parametro_id'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="punto_venta" class="control-label">Punto de venta</label>
                        <div class="form-group">
                            <select name="punto_venta" id="punto_venta" class="form-control">
                                <?php
                                if($all_parametros['parametro_tiposistema'] == 1){
                                ?>
                                    <option value="0">NINGUNO</option>
                                <?php
                                }else{
                                    foreach($puntos_venta as $pv){
                                        $selected = ($pv['puntoventa_codigo'] == $usuario['puntoventa_codigo']) ? ' selected="selected"' : "";
                                        echo "<option value='{$pv['puntoventa_codigo']}'$selected>{$pv['puntoventa_codigo']}. {$pv['tipopuntoventa_descripcion']}: {$pv['puntoventa_nombre']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                                    
                    <div class="col-md-3">
                        <label for="usuario_login" class="control-label">Nombre de usuario</label>
                        <div class="form-group">
                                <input type="text" name="usuario_login" value="<?php echo $usuario['usuario_login'] ?>" class="form-control" id="usuario_login" required/>
                                <span class="text-danger"><?php echo form_error('usuario_login');?></span>
                            <div id="user-result"></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                            <label for="usuario_turno" class="control-label">Turno</label>
                            <div class="form-group">
                                    <input type="text" name="usuario_turno" value="<?php echo $usuario['usuario_turno'] ?>" class="form-control" id="usuario_turno" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                    <span class="text-danger"><?php echo form_error('usuario_turno');?></span>
                            </div>
                    </div>

                    <div class="col-md-3">
                            <label for="usuario_inicioturno" class="control-label">Inicio</label>
                            <div class="form-group">
                                    <input type="time" name="usuario_inicioturno" value="<?php echo $usuario['usuario_inicioturno'] ?>" class="form-control" id="usuario_inicioturno" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                    <span class="text-danger"><?php echo form_error('usuario_inicioturno');?></span>
                            </div>
                    </div>
                                    
                    <div class="col-md-3">
                            <label for="usuario_finturno" class="control-label">Fin</label>
                            <div class="form-group">
                                    <input type="time" name="usuario_finturno" value="<?php echo $usuario['usuario_finturno'] ?>" class="form-control" id="usuario_finturno" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                    <span class="text-danger"><?php echo form_error('usuario_finturno');?></span>
                            </div>
                    </div>
                                    
                    <div class="col-md-4">
                        <label for="estado_id" class="control-label">Estado</label>
                        <div class="form-group">
                            <select name="estado_id" class="form-control">
                                <!--<option value="1">ACTIVO</option>-->
                                <?php 
                                foreach($all_estado as $estado)
                                {
                                    $selected = ($estado['estado_id'] == $usuario['estado_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="user_imagen" class="control-label">Imagen</label>
                        <div class="form-group">
                            <input type="file" name="usuario_imagen"  id="usuario_imagen" kl_virtual_keyboard_secure_input="on" class="form-control.input"  value="">
                            <small class="help-block" data-fv-result="INVALID" data-fv-for="chivo" data-fv-validator="notEmpty" style=""></small>
                            <h4 id='loading' ></h4>
                            <div id="message"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="<?php echo site_url('resources/images/usuarios/'.$usuario['usuario_imagen'])?>" id="previewing" class="img-responsive center-block">
                        <input type="hidden" value="<?php echo $usuario['usuario_id'] ?>" name="userid" id="userid">
                        <input type="hidden" value="<?php echo $usuario['usuario_imagen'] ?>" name="foto">
                    </div>

				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" id="boton" class="btn btn-success">
                        <i class="fa fa-check"></i> Guardar
                </button>
                <a href="<?php echo site_url('usuario'); ?>" class="btn btn-danger">
                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#usuarioForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                tipousuario_id:{
                    validators:{
                        notEmpty: {
                            message: 'Elegir un tipo de usuario'
                        }
                    }
                },

                usuario_nombre: {
                    validators: {
                        notEmpty: {
                            message: 'Nombre es un campo requerido'
                        },
                        stringLength: {
                            min: 3,
                            max: 150,
                            message: 'Nombre debe tener al menos 3 caracteres y maximo 150'
                        }
                    }
                },
                usuario_email: {
                    validators: {
                        notEmpty: {
                            message: 'Email es un campo requerido'
                        },
                        emailAddress: {
                            message: 'Entrada no es un email valido'
                        }
                    }
                },
                usuario_imagen: {
                    validators: {
                        file: {
                            extension: 'jpeg,jpg,png',
                            type: 'image/jpeg,image/png',
                            maxSize: 3600800,   // 2048 * 1024
                            message: 'El archivo seleccionado no es valido, Tamaño Maximo 350 Kb'
                        }
                    }
                }
            }
        });


        $(function() {
            $("#usuario_imagen").change(function() {

                $("#message").empty(); // To remove the previous error message
                var file = this.files[0];
                var imagefile = file.type;
                var match= ["image/jpeg","image/png","image/jpg"];
                if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                {
                    $('#previewing').attr('src','default.png');
                    $("#message").html("<p id='error'>Seleccione archivo valido</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                    return false;
                }
                else
                {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        function imageIsLoaded(e) {
            $("#usuario_imagen").css("color","green");
            $('#image_preview').css("display", "block");
            $('#previewing').attr('src', e.target.result);
            $('#previewing').attr('width', '50%');
            $('#previewing').attr('height', '59%');
        };

        var x_timer;
        $("#usuario_login").keyup(function (e){
            clearTimeout(x_timer);
            var user_login = $(this).val();
            var user_id = $('#userid').val();
            //if(  isNaN(user_numero) ){
            x_timer = setTimeout(function(){
                check_login_ajax(user_login, user_id);
            }, 1000);
            //}
        });

        function check_login_ajax(userlogin,userid){

            var parametros = {
                'login':userlogin,
                'uid': userid
            };

            //console.log('log:'+userlogin+' ,uid:'+userid);

            $.ajax({
                data:  parametros,
                url:   '<?php echo base_url('admin/dashb/haylogin2')?>',
                type:  'post',
//                    dataType: "json",
                beforeSend: function () {
                    /// $("#registrando").html("<h5>Procesando, espere por favor...</h5>");
                    $("#user-result").html('<img src="<?php echo base_url('resources/images/usuarios/loader.gif')?>" />');
                },
                success:  function (response) {
                    console.log(response);
                    if(response=='1'){
                        $("#user-result").html('<small style="color: #f0120a;" class="help-block"><i class="fa fa-close"></i> El login: '+userlogin+' Ya esta en uso, elija otro</small>');
                        $("#usuarioForm").attr('class', 'form-group has-feedback has-error');
                        $("#boton").attr( "disabled","disabled" );
                    }
                    if(response=='0'){
                        $("#user-result").html('<i class="fa fa-check" style="color: #00CC00;"></i>');
                        $("#usuarioForm").attr('class', 'form-group');
                        $("#boton").removeAttr("disabled");
                    }
                }
            });
        }


    });
</script>

<script src="<?php echo base_url('resources/js/formValidation.js');?>"></script>
<script src="<?php echo base_url('resources/js/formValidationBootstrap.js');?>"></script>