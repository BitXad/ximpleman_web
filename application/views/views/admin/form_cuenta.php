<link href="<?php echo site_url('resources/css/formValidation.css')?>" rel="stylesheet">

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Cuenta</h3>
            </div>

            <?php $attributes = array("name" => "cuentaForm", "id"=>"cuentaForm");
            echo form_open_multipart("admin/dashb/setu", $attributes);?>

            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="cliente_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
                        <div class="form-group">
                            <input type="text" name="nombre" value="<?php echo $user['usuario_nombre']; ?>" class="form-control" id="nombre" required />
                            <span class="text-danger"><?php echo form_error('nombre');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="user_email" class="control-label">Email</label>
                        <div class="form-group">
                            <input type="email" name="email" value="<?php echo $user['usuario_email']; ?>" class="form-control" id="email" />
                            <span class="text-danger"><?php echo form_error('email');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="user_clave" class="control-label"><span class="text-danger">*</span>Nuevo Password</label>
                        <div class="form-group">
                            <input type="password" name="clave" value="" class="form-control" id="clave" required />
                            <span class="text-danger"><?php echo form_error('clave');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="user_rclave" class="control-label">Repetir Password</label>
                        <div class="form-group">
                            <input type="password" name="rclave" value="" class="form-control" id="rclave" />
                            <span class="text-danger"><?php echo form_error('email');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="user_login class="control-label">login</label>
                        <div class="form-group">
                            <input type="text" name="login" value="<?php echo $user['usuario_login']; ?>" class="form-control" id="login"  autocomplete="off" />
                            <span class="text-danger"><?php echo form_error('login');?></span>
                            <div id="user-result"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="user_imagen" class="control-label">Actualizar Imagen</label>
                        <div class="form-group">
                            <input type="file" name="chivo"  id="chivox" kl_virtual_keyboard_secure_input="on">
                            <small class="help-block" data-fv-result="INVALID" data-fv-for="chivo" data-fv-validator="notEmpty" style=""></small>
                            <h4 id='loading' ></h4>
                            <div id="message"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="<?php echo site_url('uploads/profile/'.$usuario_imagen)?>" id="previewing" class="img-responsive center-block">
                    </div>

                    <div class="col-md-6">
                        <input type="hidden" name="foto" value="<?php echo $user['usuario_imagen'] ?>">
                        <input type="hidden" id="userid" name="userid" value="<?php echo $user['usuario_id']?>">
                    </div>


                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success" id="boton">
                    <i class="fa fa-check"></i> Guardar
                </button>
                <a href="<?php echo site_url('admin/dashb'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>
            <?php echo form_close(); ?>
        </div>

        <script>
            $(document).ready(function() {

                $('#cuentaForm').formValidation({
                    message: 'This value is not valid',
                    icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        rol:{
                            validators:{
                                notEmpty: {
                                    message: 'Elegir un tipo de usuario'
                                }
                            }
                        },
                        nombre: {
                            validators: {
                                notEmpty: {
                                    message: 'Nombre es un campo requerido'
                                },
                                stringLength: {
                                    min: 3,
                                    max: 150,
                                    message: 'Nombre debe tener al menos 3 caracteres y maximo 150'
                                },
                                regexp: {
                                    regexp: /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u,
                                    message: 'Solo es posible usar letras y espacios en blanco'
                                }
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'Email es un campo requerido'
                                },
                                emailAddress: {
                                    message: 'Entrada no es un email valido'
                                }
                            }
                        },
                        chivo: {
                            validators: {
                                file: {
                                    extension: 'jpeg,jpg,png',
                                    type: 'image/jpeg,image/png',
                                    maxSize: 360800,   // 2048 * 1024
                                    message: 'El archivo seleccionado no es valido, Tamaño Maximo 350 Kb'
                                }
                            }
                        },
                        clave:{
                            validators:{
                                notEmpty: {
                                    message: 'Password es obligatorio'
                                }
                            }
                        },
                        rclave: {
                            validators: {
                                notEmpty: {
                                    message: 'Repetir Password es obligatorio'
                                },
                                identical: {
                                    field: 'clave',
                                    message: 'Los campos no son iguales, vuelva a intentar'
                                }
                            }
                        }
                    }
                });


                $(function() {
                    $("#chivox").change(function() {

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
                    $("#chivox").css("color","green");
                    $('#image_preview').css("display", "block");
                    $('#previewing').attr('src', e.target.result);
                    $('#previewing').attr('width', '50%');
                    $('#previewing').attr('height', '59%');
                };

                var x_timer;
                $("#login").keyup(function (e){
                    clearTimeout(x_timer);
                    var user_login = $(this).val();
                    var user_id = $('#userid').val();
                    //if(  isNaN(user_numero) ){
                    x_timer = setTimeout(function(){
                        check_login_ajax(user_login, user_id);
                    }, 1000);
                    //}
                });

                function check_login_ajax(userlogin, userid){

                    var parametros = {
                        'login':userlogin,
                        'uid': userid
                    };
                    //alert('num:'+usernumero+',iddes:'+useriddes);
                    $.ajax({
                        data:  parametros,
                        url:   '<?php echo base_url('admin/dashb/haylogin')?>',
                        type:  'post',
//                    dataType: "json",
                        beforeSend: function () {
                            /// $("#registrando").html("<h5>Procesando, espere por favor...</h5>");
                            $("#user-result").html('<img src="<?php echo base_url('resources/images/loader.gif')?>" />');
                        },
                        success:  function (response) {
                            console.log(response);
                            if(response=='1'){
                                $("#user-result").html('<small style="color: #f0120a;" class="help-block"><i class="fa fa-close"></i> El login: '+userlogin+' Ya esta en uso, elija otro</small>');
                                $("#cuentaForm").attr('class', 'form-group has-feedback has-error');
                                $("#boton").attr( "disabled","disabled" );
                            }
                            if(response=='0'){
                                $("#user-result").html('<i class="fa fa-check" style="color: #00CC00;"></i>');
                                $("#cuentaForm").attr('class', 'form-group');
                                $("#boton").removeAttr("disabled");
                            }
                        }
                    });
                }
                

            });
        </script>
    </div>
</div>
<script src="<?php echo base_url('resources/js/formValidation.js');?>"></script>
<script src="<?php echo base_url('resources/js/formValidationBootstrap.js');?>"></script>