<script src="<?php echo base_url('resources/js/servicio_creado.js'); ?>" type="text/javascript"></script>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<script>
        $(document).ready(function() {


        });
        
        function fetch_select(id_cat){

                /*var parametros = {
                    catserv_id:id_cat
                }; */
              /*  $.ajax({
                    data:  parametros,
                    url:   '<?php //echo base_url('servicio/fetch_data')?>',
                    type:  'post',
                    
                    success:  function (response) {
                       
                    var results = JSON.parse(response);
                var subcat = "";
                $.each(results, function(index, value) {
                    
                     subcat = subcat+'<option value="'+value.subcatserv_id+'">'+
                            value.subcatserv_descripcion+
                            '</option>';

                }); *7
                /*
                    subcat = "<select name='subcatserv_id' class='form-control' id='subcatserv_id' onchange='ponerdescripcion(this.value)'>"+
                            "<option value='0'>- MARCA/MODELO -</option>"+
                            subcat+"</select>"
                    $('#subcatserv_id' ).replaceWith(''+subcat); */
            /*    }
                    
                }); */
                
                $('#detalleserv_descripcion').val($('#catserv_id option:selected').text());
                //$('#detalleserv_descripcion').focus();
                
                }
                
    </script>
    
<style type="text/css">
/*    #tamtex{ font-size: 0.1em; }*/
    #recepcion{ background-color: #FFFF33; font-size: small; }
    #entrega{ background-color: #00FF33; font-size: small; }
    #terminado{ background-color: #5C6BC0; font-size: small; }
    #entregado{ background-color: #31b0d5; font-size: small; }
    #alinear{ text-align: right; }
    #numeracion{ text-align: right; }
    #horizontal{ white-space: nowrap; }
    #masgrande{ font-size: 20px; }
    #estilo_div{
  background:#F0F5F0;
  border:solid 10px #F0F5F0;
  border-radius:15px; 
  /*box-shadow: 8px 8px 10px 0px #818181;*/
/*  height:100px;
  width:250px;*/
}
</style>
<script type="text/javascript">
    $(document).ready(function(){
    $("#cliente_nombre").change(function(){
        var nombre = $("#cliente_nombre").val();
        var cad1 = nombre.substring(0,2);
        var cad2 = nombre.substring(nombre.length-1,nombre.length);
        var fecha = new Date();
        var pararand = fecha.getFullYear()+fecha.getMonth()+fecha.getDay();
        var cad3 = Math.floor((Math.random(1001,9999) * pararand));
        var cad = cad1+cad2+cad3;
        $('#cliente_codigo').val(cad);
  });
  });
    
</script>
<!----------------------------- script buscador --------------------------------------->
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar1').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar1 tr').hide();
                    $('.buscar1 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>  
  
<!----------------------------- fin script buscador --------------------------------------->

<!----------------------------- INICIO script para seleccinar sub categorias --------------------------------------->
<script type="text/javascript">
   
</script>
<!----------------------------- FIN script para seleccinar sub categorias --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<script type="text/javascript">
$(document).ready(function(){
  
  function restar(){
    
    var uno, dos, tres, operacion;
  
      uno = $('#detalleserv_total');
      dos = $('#detalleserv_acuenta');
      tres = $('#detalleserv_saldo');
      
      operacion = parseFloat(uno.val()) - parseFloat(dos.val());
      tres.val(operacion);
    
  }
  
  $("#detalleserv_total").keyup(function(){
      
      var dos;
      dos = $('#detalleserv_acuenta').val();
      
      if(dos != ""){
        restar()
      }
      
  });
  
  $("#detalleserv_acuenta").keyup(function(){
      
      var uno;
      uno = $('#detalleserv_total').val();
      
      if(uno != ""){
        restar()
      }
      
  });
  
  $("#detalleserv_acuenta").change(function(){
  if($("#detalleserv_saldo").val() <0){
      alert("Saldo no debe ser negativo");
      $('#detalleserv_acuenta').css('color', 'red');
      $('#detalleserv_saldo').css('color', 'red');
      $('#detalleserv_acuenta').focus();
  }else{
      $('#detalleserv_acuenta').css('color', 'black');
      $('#detalleserv_saldo').css('color', 'black');
  }});
  
})
</script>
<!-- muestra o no la direccion de un tipo de servicio -->
<script type="text/javascript">
    $(document).ready(function()
	    {
	    $("#tiposerv_id").on( "change", function() {	 
	        $('#midirec').toggle();
	         });
	    });
</script>
<script type="text/javascript">
        function ponerfocus(){
            document.getElementById("cliente_nombre").focus();
            //$("#cliente_nombre").focus();
        }
</script>
<div class="box-header with-border">
    <input type="hidden" value="<?php echo $servicio['servicio_id']; ?>" id="esteservicio_id">
    <h3 class="box-title"><b>Detalle del Servicio N°: <?php echo $servicio['servicio_id'] ?></b></h3>
    <div class="container">
        <div class="panel panel-primary col-md-5">
            <h5>
                <b>Cliente: </b><span id="cliente-nombre"><?php if(is_null($servicio['cliente_id'])|| ($servicio['cliente_id'] ==0)){ echo "NO DEFINIDO";} else{ echo $cliente['cliente_nombre']; ?>
                    </span><br>
                <b>Telef.: </b><span id="cliente-telefono"><?php echo $cliente['cliente_telefono']; } ?>
                    </span><br>
                <b>Código Cliente: </b><span id="cliente-codigo"><?php if(is_null($cliente['cliente_codigo'])){ echo "NO DEFINIDO";} else{ echo $cliente['cliente_codigo']; } ?>
                    </span><br>
                <b>Fecha/Hora: </b><?php if(is_null($servicio['servicio_fecharecepcion'])){ echo "NO DEFINIDO";} else{ echo date('d/m/Y', strtotime($servicio['servicio_fecharecepcion'])); echo '|'.$servicio['servicio_horarecepcion']; } ?><br>
                <b>Registrado por: </b><?php if(is_null($usuario['usuario_id'])){ echo "NO DEFINIDO";} else{ echo $usuario['usuario_nombre']; } ?><br>
                <b>Tipo Servicio: </b>
                <span id="mitiposervicio"><?php if(is_null($servicio['tiposerv_id'])){ echo "NO DEFINIDO";} else{ echo $tipo_servicio['tiposerv_descripcion'];
                                            if($servicio['tiposerv_id'] == 2){
                                              echo "<br><b>Dirección: </b>".$servicio['servicio_direccion'];
                                            } } ?>
                </span>
            </h5>
        </div>
        <div class="box-tools">
            <center>
                <a class="btn btn-success btn-foursquarexs" data-toggle="modal" data-target="#modaldetalle" ><font size="5"><span class="fa fa-wrench"></span></font><br><small>Nuevo Servicio</small></a>
                <a class="btn btn-primary btn-foursquarexs" data-toggle="modal" data-target="#myModal" onclick="ponerfocus();"><font size="5"><span class="fa fa-user-plus"></span></font><br><small>Nuevo Clie..</small></a>
                <a class="btn btn-warning btn-foursquarexs" data-toggle="modal" data-target="#modalbuscar" ><font size="5"><span class="fa fa-user-secret"></span></font><br><small>Buscar Clie..</small></a>
                <a class="btn btn-info btn-foursquarexs" data-toggle="modal" data-target="#modalbuscardetalle" ><font size="5"><span class="fa fa-search"></span></font><br><small>Buscar Servicio</small></a>
                <a class="btn btn-soundcloud btn-foursquarexs" data-toggle="modal" data-target="#modaltiposervicio"><font size="5"><span class="fa fa-home"></span></font><br><small>Tipo Serv..</small></a>
            </center>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
            <div class="input-group"> <span class="input-group-addon">Buscar</span>
                <input id="filtrar1" type="text" class="form-control" placeholder="Ingrese detalle, código..">
            </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>#</th>
						<th>Detalle</th>
						<th>Código</th>
						<th>Categoria/<br>Subcategoria</th>
						<th>Tipo<br>Trabajo</th>
						<th>Finalizado</th>
						<th>Entregado</th>
                                                <th>Estado</th>
						<th>Informe</th>
						<th>Peso<br>(Gr.)</th>
						<th>Insumo</th>
						<th>Datos<br>Adicionales</th>
						<th>Total</th>
						<th>A. C.</th>
						<th>Saldo</th>
						
						
						
                                                
						<th></th>
                    </tr>
                    <tbody class="buscar1" id="detalleservicio">
                    <?php /*
                         $i = 1;
                         $total = 0; $acuenta = 0;
                         $saldo = 0; $cont = 0;
                         foreach($detalle_serv as $d){
                             $total = $total + $d['detalleserv_total'];
                             $acuenta = $acuenta + $d['detalleserv_acuenta'];
                             $saldo = $saldo + $d['detalleserv_saldo'];
                             $cont = $cont+1; ?>
                    <tr>
                            <td><?php echo $cont ?></td>
                            <td id="horizontal"><?php 
                                  echo '<font size="1">'.$d['detalleserv_descripcion'].'</font><br>';
                                  if($d['procedencia_id']<>0){ echo '<font size="1"><b>Proc.: </b>'.$d['procedencia_descripcion'].'</font><br>';}
                                  if($d['tiempouso_id']<>0){ echo '<font size="1"><b>T. uso.: </b>'.$d['tiempouso_descripcion'].'</font><br>';}
                                  if($d['detalleserv_reclamo'] == "si"){$res = "Si";}else{$res = "No"; }
                                  echo '<font size="1"><b>¿Recl.?: </b>'.$res.'</font><br>';
                                  echo '<font size="1"><b>Tec.R.: </b>'.$d['responsable_nombres']." ".$d['responsable_apellidos'].'</font><br>';
                                  echo '<font size="1"><b>Reg.: </b>'.$d['usuario_nombre'].'</font><br>';
                                  echo '<font size="1"><b>Entrega: </b>'; $mosfecha = "";
                                                                         if($d['detalleserv_fechaentrega'] <> null){
                                                                         echo date('d/m/Y', strtotime($d['detalleserv_fechaentrega'])) ; echo ' <b>Hrs.: </b>'.$d['detalleserv_horaentrega'].'</font>';}
                                ?>
                            </td>
                            <td><?php echo $d['detalleserv_codigo']; ?></td>
                            <td><?php if($d['catserv_id']<>0){echo $d['catserv_descripcion'].'/'; } if($d['subcatserv_id']<>0){ echo $d['subcatserv_descripcion'];} ?></td>
                            <td><?php if($d['cattrab_id']<>0){echo $d['cattrab_descripcion'];} ?></td>
                            <td><?php if(isset($d['detalleserv_fechaterminado'])){ echo date('d/m/Y', strtotime($d['detalleserv_fechaterminado'])).' <br>'.date('H:i:s', strtotime($d['detalleserv_horaterminado']));}  ?></td>
                            <td><?php if(isset($d['detalleserv_fechaentregado'])){ echo date('d/m/Y', strtotime($d['detalleserv_fechaentregado'])).' <br>'.date('H:i:s', strtotime($d['detalleserv_horaentregado']));}  ?></td>
                            <td style="background-color: #<?php echo $d['estado_color']; ?>"><?php echo $d['estado_descripcion']; ?></td>
                            <td id="horizontal"><?php echo '<font size="1"><b>Falla: </b>'.$d['detalleserv_falla'].'<br><b>Diagnostico: </b>'.$d['detalleserv_diagnostico'].'<br><b>Solucion: </b>'.$d['detalleserv_solucion'].'</font>'; ?></td>
                            <td><?php echo '<font size="1"><b>Entrada: </b>'.$d['detalleserv_pesoentrada'].'</font><br>';
                                      echo '<font size="1"><b>Salida: </b>'.$d['detalleserv_pesosalida'].'</font>'; ?></td>
                            <td><?php echo $d['detalleserv_insumo']; ?></td>
                            <td><?php echo $d['detalleserv_glosa']; ?></td>
                            <td id="alinear"><?php echo number_format($d['detalleserv_total'],'2','.',',') ?></td>
                            <td id="alinear"><?php echo number_format($d['detalleserv_acuenta'],'2','.',',') ?></td>
                            <td id="alinear"><?php echo number_format($d['detalleserv_saldo'],'2','.',',') ?></td>
                            <td>
                            <!------------------------ INICIO modal para confirmar Anulacion ------------------->
                                    <div class="modal fade" id="modalanulado<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3><b><span class="fa fa-minus-circle"></span>¿</b>
                                               Desea Anular el detalle de Servicio con el codigo: <b> <?php echo $d['detalleserv_codigo']; ?>?</b>
                                            </h3>
                                               Al ANULAR este detalle de servicio, sus campos: Total, A cuenta y Saldo seran CERO.
                                           
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a onclick="anulardetalleservicio(<?php echo $servicio['servicio_id']; ?>, <?php echo $d['detalleserv_id']; ?>, <?php echo $i; ?>)" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                        <!------------------------ FIN modal para confirmar Anulacion ------------------->
                        
                        <!------------------------ INICIO modal para confirmar Eliminación ------------------->
                                    <div class="modal fade" id="modaleliminar<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="modaleliminarLabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3><b><span class="fa fa-trash"></span></b>
                                               ¿Desea Eliminar el detalle de servicio con el codigo: <b> <?php echo $d['detalleserv_codigo']; ?></b>?
                                           </h3>
                                           Al eliminar este detalle, se perdera toda la información.
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a onclick="eliminardetalleservicio(<?php echo $servicio['servicio_id']; ?>, <?php echo $d['detalleserv_id']; ?>, <?php echo $i; ?>)" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                        <!------------------------ FIN modal para confirmar Eliminación ------------------->
                            
                                <a href="<?php echo site_url('detalle_serv/modificardetalle/'.$servicio['servicio_id'].'/'.$d['detalleserv_id']); ?>" class="btn btn-info btn-xs" title="editar"><span class="fa fa-pencil"></span> </a>
                                <a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modalanulado<?php echo $i; ?>" title="anular"><span class="fa fa-minus-circle"></span></a>
                                <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modaleliminar<?php echo $i; ?>" title="eliminar" ><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                    <?php $i++; } */ ?>
                </table>
                                
            </div>
        </div>

                <!-- ---------------------- Inicio modal para crear nuevo Cilente ----------------- -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                              <label>Nuevo Cliente:</label>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                            <span id="mensajenew_cliente" class="text-danger"></span>
                                          </div>
                                            
                                            <?php
                                            //echo form_open('cliente/add_new/'.$servicio['servicio_id']);
                                            ?>
                                          <div class="modal-body">
                                              
                                           <!------------------------------------------------------------------->
                                           
                                           <div class="col-md-6">
						<label for="cliente_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
                                                    <input type="text" name="cliente_nombre" value="<?php echo $this->input->post('cliente_nombre'); ?>" class="form-control" id="cliente_nombre" required onKeyUp="this.value = this.value.toUpperCase();" />
							<span class="text-danger"><?php echo form_error('cliente_nombre');?></span>
						</div>
					  </div>
                                        <div class="col-md-6">
						<label for="cliente_codigo" class="control-label"><span class="text-danger">*</span>Código</label>
						<div class="form-group">
							<input type="text" name="cliente_codigo" value="<?php echo $this->input->post('cliente_codigo'); ?>" class="form-control" id="cliente_codigo" required />
						</div>
					  </div>
                                          <div class="col-md-6">
						<label for="cliente_ci" class="control-label">C.I.</label>
						<div class="form-group">
							<input type="text" name="cliente_ci" value="<?php echo $this->input->post('cliente_ci'); ?>" class="form-control" id="cliente_ci" />
						</div>
					  </div>
                                          <div class="col-md-6">
						<label for="cliente_nit" class="control-label">Nit</label>
						<div class="form-group">
                                                    <input type="number" min="0" name="cliente_nit" value="<?php if($this->input->post('cliente_nit') >0){ echo $this->input->post('cliente_nit');}else{ echo 0;} ?>" class="form-control" id="cliente_nit" onclick="this.select();" />
						</div>
					  </div>
                                          <div class="col-md-6">
						<label for="cliente_telefono" class="control-label"><span class="text-danger">*</span>Teléfono</label>
						<div class="form-group">
							<input type="text" name="cliente_telefono" value="<?php echo $this->input->post('cliente_telefono'); ?>" class="form-control" id="cliente_telefono" required onKeyUp="this.value = this.value.toUpperCase();" />
                                                        <span class="text-danger"><?php echo form_error('cliente_telefono');?></span>
						</div>
					</div>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                              <button class="btn btn-success" onclick="registrarnuevocliente(<?php echo $servicio['servicio_id']; ?>)">
                                                    <i class="fa fa-check"></i> Guardar
                                              </button>
                                              <a href="#" class="btn btn-danger" data-dismiss="modal">
                                                    <i class="fa fa-times"></i> Cancelar</a>
                                          </div>
                                            <?php //echo form_close(); ?>
                                        </div>
                                      </div>
                                    </div>
            <!-- ---------------------- Fin modal para crear nuevo Cliente ----------------- -->
            
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-body table-responsive table-condensed">
                <table class="table table-striped table-condensed" >
                    <tbody>
                        <!--<tr>
                            <th>Descripción</th>
                            <th></th>
                        </tr> -->
                        <tr>
                            <td>Total Final</td>
                            <td id="alinear"><span id="totalfinal"><?php echo number_format($servicio['servicio_total'],'2','.',','); ?></span></td>
                        </tr>
                        <tr>
                            <td>A cuenta</td>
                            <td id="alinear"><span id="totalacuenta"><?php echo number_format($servicio['servicio_acuenta'],'2','.',','); ?></span></td>
                        </tr>
                        <tr>
                            <th id="masgrande">Saldo</th>
                            <th id="masgrande" style="text-align: right;"><span id="totalsaldo"><?php echo number_format($servicio['servicio_saldo'],'2','.',','); ?></span></th>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
    <div style="float: right; text-align: center;">
        <?php
        $dir_url = "";
        if($all_parametro[0]['parametro_tipoimpresora'] == "FACTURADORA"){
            $dir_url = site_url('servicio/boletarecepcion_boucher/'.$servicio['servicio_id']);
            $titprint = "Imp. Boucher";
        }else{
            //$dir_url = site_url('servicio/boletarecepcion/'.$servicio['servicio_id']);
            $dir_url = site_url('servicio/boletacomprobanteserv/'.$servicio['servicio_id']);
            $titprint = "Imp. Normal";
        }
        ?>
        
        <!--<a href="<?php //echo site_url('servicio/boletacomprobanteserv/'.$servicio['servicio_id']); ?>" id="imprimir" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;" target="_blank" ><span class="fa fa-print fa-4x"></span><br>Imp. Comprob.</a>
        <a href="<?php //echo $dir_url; ?>" id="imprimir" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;" target="_blank" ><span class="fa fa-print fa-4x"></span><br><?php echo $titprint; ?></a>-->
        <a href="<?php echo site_url('servicio');  ?>" id="cancelar" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important;" ><span class="fa fa-times fa-4x"></span><br>Cancelar</a>
        <?php
        if($a == 3){
            if(is_null($servicio['servicio_codseguimiento'])){ ?>
                <a href="<?php echo $dir_url  ?>" id="finalizar" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;" target="_blank" onclick="finalizarservicio(<?php echo $servicio['servicio_id']; ?>, 2)" ><span class="fa fa-sign-out fa-4x"></span><br>Finalizar</a>
            <?php
            }else{ ?>
                <a href="<?php echo $dir_url  ?>" id="finalizar" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;" target="_blank" onclick="finalizarservicio2(2)" ><span class="fa fa-sign-out fa-4x"></span><br>Finalizar</a>
            <?php
            }
        }else{?>
            <a href="<?php echo $dir_url  ?>" id="finalizar" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;" target="_blank" onclick="finalizarservicio(<?php echo $servicio['servicio_id']; ?>, 0)" ><span class="fa fa-sign-out fa-4x"></span><br>Finalizar</a>
        <?php } ?>
</div>
</div>

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

<!--------------------------------- INICIO MODAL BUSCAR CLIENTES ------------------------------------>
<div class="modal fade" id="modalbuscar" tabindex="-1" role="dialog" aria-labelledby="myModalbuscarLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Clientes</h4>

                <!--este es INICIO de input buscador-->
                <div class="col-md-1">
                        Buscar 
                </div>           
                <div class="col-md-7">
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingresa el nombre, apellidos o ci del Clie..." onkeypress="validar(event,3,<?php echo $servicio['servicio_id']; ?>)" onKeyUp="this.value = this.value.toUpperCase();" />
                </div>
                <!--este es FIN de input buscador-->
                <div class="container col-md-4" id="categoria">    
                    <span class="badge btn-danger">Encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>
                </div>
            </div>
            <div class="modal-body">
                <!--------------------- TABLA---------------------------------------------------->
                <div class="box-body table-responsive">
                    <table class="table table-striped" id="mitabla">
                        <tr>
                            <th>#</th>
                            <th> Nombres
                                <a style="float: right;" class="btn btn-success btn-xs" data-dismiss="modal" data-toggle="modal" href="#myModal"><span class="fa fa-user-plus"></span>&nbsp;Nuevo Cliente</a>
                            </th>
                        </tr>
                        <tbody class="buscar" id="tablaresultados" >

                        </tbody>
                    </table>
                </div>
            <!----------------------FIN TABLA--------------------------------------------------->
            </div>
        </div>
    </div>
</div>
<!--------------------------------- FIN MODAL BUSCAR CLIENTES ------------------------------------>

<!-- ---------------------- Inicio modal para crear Nuevo Detalle de Servicio ----------------- -->
    <div class="modal fade" id="modaldetalle" tabindex="-1" role="dialog" aria-labelledby="modaldetalleLabel">
      <div class="modal-dialog modal-lg" role="document">
            <br><br>
        <div class="modal-content">
          <div class="modal-header">
              <label>Nuevo Detalle del Servicio N° <?php echo $servicio['servicio_id'] ?></label>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            <span id="mensajenew_detalleserv" class="text-danger"></span>
          </div>
            <?php
            //echo form_open('detalle_serv/nuevodetalle/'.$servicio['servicio_id']);
            ?>
          <div class="modal-body">
           <!------------------------------------------------------------------->
           <div class="col-md-12">
                            <div class="col-md-3">
                                <label for="detalleserv_reclamo" class="control-label">¿Reclamo?</label>
                                    <div class="form-group">
                                        <input type="checkbox" name="detalleserv_reclamo" id="detalleserv_reclamo" value="si" />
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <label for="cattrab_id" class="control-label">Tipo de Trabajo</label>
                                    <div class="form-group">
                                        <select name="cattrab_id" class="form-control" id="cattrab_id">
                                                    <!--<option value="">- TIPO TRABAJO -</option>-->
                                                    <?php
                                                    foreach($all_categoria_trabajo as $cat_trabajo)
                                                    {
                                                            $selected = ($cat_trabajo['cattrab_id'] == $this->input->post('cattrab_id')) ? ' selected="selected"' : "";

                                                            echo '<option value="'.$cat_trabajo['cattrab_id'].'" '.$selected.'>'.$cat_trabajo['cattrab_descripcion'].'</option>';
                                                    } 
                                                    ?>
                                            </select>
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <label for="procedencia_id" class="control-label">Procedencia</label>
                                    <div class="form-group">
                                        <select name="procedencia_id" class="form-control" id="procedencia_id">
                                                    <!--<option value="">- PROCEDENCIA -</option>-->
                                                    <?php
                                                    foreach($all_procedencia as $procedencia)
                                                    {
                                                            $selected = ($procedencia['procedencia_id'] == $this->input->post('procedencia_id')) ? ' selected="selected"' : "";

                                                            echo '<option value="'.$procedencia['procedencia_id'].'" '.$selected.'>'.$procedencia['procedencia_descripcion'].'</option>';
                                                    } 
                                                    ?>
                                            </select>
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <label for="tiempouso_id" class="control-label">Tiempo de uso</label>
                                    <div class="form-group">
                                        <select name="tiempouso_id" class="form-control" id="tiempouso_id">
                                                    <!--<option value="">- TIEMPO DE USO -</option>-->
                                                    <?php
                                                    foreach($all_tiempo_uso as $tiempouso)
                                                    {
                                                            $selected = ($tiempouso['tiempouso_id'] == $this->input->post('tiempouso_id')) ? ' selected="selected"' : "";

                                                            echo '<option value="'.$tiempouso['tiempouso_id'].'" '.$selected.'>'.$tiempouso['tiempouso_descripcion'].'</option>';
                                                    } 
                                                    ?>
                                            </select>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <label for="catserv_id" class="control-label">Categoria Producto</label>
                                    <div class="form-group">
                                        <select name="catserv_id" class="form-control" onchange="fetch_select(this.value);" id="catserv_id">
                                            <option value="0">- CATEGORIA -</option>
                                            <?php
                                            foreach($all_categoria_servicio as $categoria_servicio)
                                            {
                                                    $selected = ($categoria_servicio['catserv_id'] == $this->input->post('catserv_id')) ? ' selected="selected"' : "";

                                                    echo '<option value="'.$categoria_servicio['catserv_id'].'" '.$selected.'>'.$categoria_servicio['catserv_descripcion'].'</option>';
                                            } 
                                            ?>
                                        </select>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <label for="subcatserv_id" class="control-label">Marca/Modelo</label>
                                    <div class="form-group" id="new_select">
                                        <input type="search" name="subcatserv_id" list="listasubcatserv" class="form-control" id="subcatserv_id" value="- MARCA/MODELO -" onkeypress="validar2(event,2)"  onchange="seleccionar_subcategoria()" onKeyUp="this.value = this.value.toUpperCase();" onclick="this.select();" />
                                        <datalist id="listasubcatserv">
                                        </datalist>
                                            <!-- <select name="subcatserv_id" class="form-control" id="subcatserv_id" onchange="ponerdescripcion(this.value);">
                                                    <option value="0">- MARCA/MODELO -</option>
                                            </select> -->
                                        <input type="hidden" name="estesubcatserv_id" id="estesubcatserv_id" />
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <label for="detalleserv_descripcion" class="control-label"><span class="text-danger">*</span>Descripción</label>
                                    <div class="form-group">
                                        <input type="text" name="detalleserv_descripcion" value="<?php echo $this->input->post('detalleserv_descripcion'); ?>" class="form-control" id="detalleserv_descripcion" required onKeyUp="this.value = this.value.toUpperCase();" />
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <label for="detalleserv_falla" class="control-label"><span class="text-danger">*</span>Problema/Falla Segun Cliente</label>
                                    <div class="form-group">
                                        <input type="text" name="detalleserv_falla" value="<?php echo $this->input->post('detalleserv_falla'); ?>" class="form-control" id="detalleserv_falla" required onKeyUp="this.value = this.value.toUpperCase();" />
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <label for="detalleserv_diagnostico" class="control-label">Diagnóstico</label>
                                    <div class="form-group">
                                        <input type="text" name="detalleserv_diagnostico" value="<?php if($this->input->post('detalleserv_diagnostico')== null){ echo "VACIO";}else{ $this->input->post('detalleserv_diagnostico'); } ?>" class="form-control" id="detalleserv_diagnostico" onKeyUp="this.value = this.value.toUpperCase();" onclick="this.select();" />
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <label for="detalleserv_solucion" class="control-label">Solución</label>
                                    <div class="form-group">
                                            <input type="text" name="detalleserv_solucion" value="<?php if ($this->input->post('detalleserv_solucion') == null){ echo "RECARGA";}else{ $this->input->post('detalleserv_solucion'); } ?>" class="form-control" id="detalleserv_solucion" onKeyUp="this.value = this.value.toUpperCase();" onclick="this.select();" />
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <label for="detalleserv_pesoentrada" class="control-label">Peso Entrada(Gr.)</label>
                                    <div class="form-group">
                                            <input type="number" step="any" min="0" name="detalleserv_pesoentrada" value="<?php echo number_format($this->input->post('detalleserv_pesoentrada'),'2','.',','); ?>" class="form-control" id="detalleserv_pesoentrada" onclick='this.select();' />
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <label for="detalleserv_glosa" class="control-label">Datos Adicionales</label>
                                    <div class="form-group">
                                            <input type="text" name="detalleserv_glosa" value="<?php echo $this->input->post('detalleserv_glosa'); ?>" class="form-control" id="detalleserv_glosa" onKeyUp="this.value = this.value.toUpperCase();" onclick="this.select();" />
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <label for="detalleserv_total" class="control-label">Total</label>
                                    <div class="form-group">
                                            <input style="background-color: #ffeebc;" type="number" step="any" min="0" name="detalleserv_total" value="<?php echo number_format($this->input->post('detalleserv_total'),'2','.',','); ?>" class="form-control" id="detalleserv_total" onclick='this.select();' />
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <label for="detalleserv_acuenta" class="control-label">A cuenta</label>
                                    <div class="form-group">
                                            <input style="background-color: #ffeebc;" type="number" step="any" min="0" name="detalleserv_acuenta" value="<?php echo number_format($this->input->post('detalleserv_acuenta'),'2','.',','); ?>" class="form-control" id="detalleserv_acuenta" onclick='this.select();' />
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <label for="detalleserv_saldo" class="control-label">Saldo</label>
                                    <div class="form-group">
                                        <input style="background-color: #ffeebc;" type="number" step="any" min="0" name="detalleserv_saldo" value="<?php echo number_format($this->input->post('detalleserv_saldo'),'2','.',','); ?>" class="form-control" id="detalleserv_saldo" readonly onclick='this.select();' />
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <label for="detalleserv_fechaentrega" class="control-label">Fecha Entrega</label>
                                    <div class="form-group">
                                        <input type="date" name="detalleserv_fechaentrega" value="<?php $maniana = time()+(24*60*60); echo date('Y-m-d', $maniana); ?>" class="form-control" id="detalleserv_fechaentrega" />
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <label for="detalleserv_horaentrega" class="control-label">Hora Entrega</label>
                                    <div class="form-group">
                                        <input type="time" name="detalleserv_horaentrega" value="<?php echo date('H:i'); ?>" class="form-control" id="detalleserv_horaentrega" />
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <label for="responsable_id" class="control-label"><span class="text-danger">*</span>Tec. Responsable</label>
                                    <div class="form-group">
                                        <select name="responsable_id" class="form-control" id="responsable_id" required>
                                                    <!--<option value="">- RESPONSABLE -</option>-->
                                                    <?php 
                                                    foreach($all_responsable as $responsable)
                                                    {
                                                            $selected = ($responsable['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";

                                                            echo '<option value="'.$responsable['usuario_id'].'" '.$selected.'>'.$responsable['usuario_nombre'].'</option>';
                                                    } 
                                                    ?>
                                            </select>
                                    </div>
                            </div>
                        </div>
                        <!--    <input type="hidden" name="servicio_id" value="<?php //echo $servicio['servicio_id'] ?>" class="form-control" id="servicio_id" /> -->
           <!------------------------------------------------------------------->
          </div>
          <div class="modal-footer aligncenter">
              <button class="btn btn-success" onclick="registrarnuevodetalleservicio(<?php echo $servicio['servicio_id']; ?>)" >
                    <i class="fa fa-check"></i> Guardar
              </button>
              <a href="#" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cancelar</a>
          </div>
            <?php //echo form_close(); ?>
        </div>
      </div>
    </div>
<!-- ---------------------- Fin modal para crear Nuevo Detalle de Servicio ----------------- -->
<?php
    if($a==1)
    {?>
    <script type="text/javascript">
    alert('El Monto ingresado debe ser menor al Saldo');
    </script>
    <?php
    }elseif($a == 2){
    ?>
    <script type="text/javascript">
    alert('El estado Entregado se cambia cuando el saldo  es 0, verifique sus saldos');
    </script>
    <?php }elseif($a == "no"){ ?>
    <script type="text/javascript">
    alert('No se encontro ningun Detalle de Servicio con ese codigo.');
    </script>
    <?php } ?>
<!-- ---------------------- Inicio modal para asignar Tipo de Servicio ----------------- -->
    <div class="modal fade" id="modaltiposervicio" tabindex="-1" role="dialog" aria-labelledby="modaltiposervicioLabel">
      <div class="modal-dialog" role="document">
            <br><br>
        <div class="modal-content">
          <div class="modal-header">
              <label>Tipo Servicio:</label>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
          </div>
            <?php
            //echo form_open('servicio/asignartiposervicio/'.$servicio['servicio_id']);
            ?>
          <div class="modal-body">

           <!------------------------------------------------------------------->

           <div class="col-md-6">
                <label for="tiposerv_id" class="control-label">Servicio</label>
                    <div class="form-group">
                        <select name="tiposerv_id" class="form-control" required id="tiposerv_id">
                            <?php
                            foreach($all_tipo_servicio as $tipo_servicio)
                            {
                                $selected = ($tipo_servicio['tiposerv_id'] == $servicio['tiposerv_id']) ? ' selected="selected"' : "";

                                echo '<option value="'.$tipo_servicio['tiposerv_id'].'" '.$selected.'>'.$tipo_servicio['tiposerv_descripcion'].'</option>';
                            } 
                            ?>
                            </select>
                    </div>
            </div>
            <?php
                $mos = "";
                if($servicio['tiposerv_id'] == 1)
                {
                    $mos="display: none;";
                }else{
                    $mos="display: block;";
                }
                   
            ?>
            <div class="col-md-6" id="midirec" style="<?php echo $mos; ?>">
                <label for="direccion" class="control-label">Dirección</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $servicio['servicio_direccion']; ?>" onKeyUp="this.value = this.value.toUpperCase();" />
                    </div>
            </div>
           <!-- --------------------------------------------------------------- -->
          </div>
          <div class="modal-footer aligncenter">
              <button class="btn btn-success" onclick="cambiartiposervicio(<?php echo $servicio['servicio_id']; ?>)">
                    <i class="fa fa-check"></i> Guardar
              </button>
              <a href="#" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cancelar</a>
          </div>
            <?php //echo form_close(); ?>
        </div>
      </div>
    </div>
<!-- ---------------------- Fin modal para asignar Tipo de Servicio ----------------- -->

                <!-- ---------------------- Inicio modal para buscar el historial de un servicio ----------------- -->
                                    <div class="modal fade" id="modalbuscardetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                              <label>buscar detalle de servicio:</label>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                            <?php
                                            echo form_open('detalle_serv/buscardetalleserv/'.$servicio['servicio_id']);
                                            ?>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           
                                           <div class="col-md-6">
						<div class="form-group">
                                                    <input type="text" name="codigo" class="form-control" id="codigo" required placeholder="Codigo del Producto" />
						</div>
					  </div>
                                          <div class="col-md-6">
						<button type="submit" class="btn btn-success">
                                                    <i class="fa fa-search"></i> Buscar
                                              </button>
					</div>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter"></div>
                                            <?php echo form_close(); ?>
                                        </div>
                                      </div>
                                    </div>
            <!-- ---------------------- Fin modal para buscar el historial de un servico ----------------- -->