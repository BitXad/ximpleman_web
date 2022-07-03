<script src="<?php echo base_url('resources/js/funcionessin.js'); ?>"></script>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<!----------------------------- script buscador --------------------------------------->
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
    <font size='4' face='Arial'><b>Eventos Significativos</b></font>
    <div class="box-tools no-print">

    <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modaleventos">
            <fa class="fa fa-reddit"> </fa> 
            Registrar evento
        </button>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="row" id='loader'  style='display:none; text-align: center'>
                <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th width="50px">#</th>
                            <th>CODIGO</th>
                            <th>EVENTO</th>
                            <th>FECHA<br>REGISTRO</th>
                            <th>PUNTO<br>VENTA</th>
                            <th>FECHA<br>INICIO</th>
                            <th>FECHA<br>FIN</th>
                            <!--<th width="100px" class="no-print"></th>-->
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php 
                        $i=1;
                        foreach ($eventos_significativos as $evento) {?>
                                              
                            <tr>                                
                                <td><?= $i ?></td>
                                <td><?= $evento['registroeventos_codigo'] ?></td>                            
                                <td><?= $evento['registroeventos_detalle'] ?></td>                            
                                <td><?= $evento['registroeventos_fecha'] ?></td>                            
                                <td><?= $evento['registroeventos_puntodeventa'] ?></td>                            
                                <td><?= $evento['registroeventos_inicio'] ?></td>                            
                                <td><?= $evento['registroeventos_fin'] ?></td>
<!--                                <td>
                                    <button class="btn btn-primary btn-xs" title="ventos <?= strtolower($evento['ces_descripcion']) ?>" onclick="eventos(<?= $evento['ces_id'] ?>)">
                                        <i class="fa-solid fa-arrows-rotate"></i>
                                    </button>
                                    <a class="btn btn-info btn-xs" title="Ver datos" href="<?= site_url("ces_significativos/show_eventos/{$evento['ces_id']}") ?>">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>-->
                            </tr>
                        <?php
                            $i++; 
                        }
                    ?>
                    </tbody>
                </table>                                
            </div>
        </div>
    </div>
</div>

    <a class="btn btn-warning btn-xs" onclick="consulta_EventoSignificativo()"><fa class="fa fa-cart-arrow-down"></fa> Consulta Evento Significativo</a>

    <a class="btn btn-warning btn-xs" onclick="mostrar_modalregistrarpuntoventa()"><fa class="fa fa-cart-arrow-down"></fa> Registrar Punto de Venta</a>
    

    

<!-- Modal -->
<div class="modal fade" id="modaleventos" tabindex="-1" role="dialog" aria-labelledby="modaleventos" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #3399cc">
        <b style="color: white;">REGISTRO DE EVENTOS SIGNIFICATIVOS</b>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
        
      <div class="modal-body">
          
        <div class="col-md-12" style="display:none;">
            <div class="row" id='loader2'  style='text-align: center'>
                <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
            </div>
        </div>
          
          
        <div class="col-md-12">
            <label for="dosificacion_nitemisor" class="control-label">Eventos</label>
            <div class="form-group">
                
                <select id="select_eventos" class="form-control">

                    <?php  foreach ($eventos as $evento) {?>
                
                        <option value="<?= $evento['ces_codigoclasificador']; ?>"><?= $evento['ces_descripcion']; ?></option>

                    <?php } ?>

                </select>
                
            </div>
        </div>
          
        <div class="col-md-6">
            <label for="ces_fechainicio" class="control-label">Fecha Inicio</label>
            <div class="form-group">
                <input type="datetime-local" name="ces_fechainicio" value="<?= Date("d/m/y");  ?>" class="form-control" id="ces_fechainicio" onchange="seleccionar_cufd()"/>
            </div>
        </div>
          
        <div class="col-md-6">
            <label for="ces_fechafin" class="control-label">Fecha Fin</label>
            <div class="form-group">
                <input type="datetime-local" name="ces_fechafin" value="<?= date("d/m/y");  ?>" class="form-control" id="ces_fechafin" />
            </div>
        </div>

        
      </div>

        <div class="col-md-12">
            <label for="dosificacion_cufd" class="control-label">CUFD DEL EVENTO</label>
            <div class="form-group">

                <select id="select_cufd" class="form-control">
                    <option>- NO EXISTEN CUFD SELECCIONADOS -</option>
                </select>

            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
            <button type="button" class="btn btn-success" onclick="registrar_evento()"><fa class="fa fa-floppy-o"></fa> Registrar Evento</button>
        </div>
        
    </div>
  </div>
</div>
<!-- Fin Modal -->
        
    
    
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script>
    
    function registrar_evento(){
        
        let base_url = $("#base_url").val();
        let controlador = `${base_url}eventos_significativos/registroEventoSignificativo`;
        let fecha_inicio =  document.getElementById('ces_fechainicio').value;
        let fecha_fin =  document.getElementById('ces_fechafin').value;
        let cufd_evento =  document.getElementById('select_cufd').value;
        let codigo_evento =  document.getElementById('select_eventos').value;
        let combo = document.getElementById('select_eventos');
        let texto_evento = combo.options[combo.selectedIndex].text;
        
        //alert(fecha_inicio+" ** "+fecha_fin+" ** "+codigo_evento+" ** "+texto_evento);
        fecha_inicio =  fecha_inicio+":"+Math.floor(10+Math.random() * 49)+"."+ Math.floor(Math.random() * 1000);
        fecha_fin =  fecha_fin+":"+Math.floor(10+Math.random() * 49)+"."+ Math.floor(Math.random() * 1000);
        document.getElementById('loader2').style.display = 'block';
        
        $.ajax({
            url: controlador,
            type:"POST",
            data:{
                fecha_inicio: fecha_inicio, fecha_fin:fecha_fin, cufd_evento:cufd_evento,
                codigo_evento:codigo_evento, texto_evento:texto_evento,
            },
            // async: false,
            success: (respuesta)=>{
                
                alert(respuesta);

                document.getElementById('loader2').style.display = 'none';
                
            },
            error: ()=>{
                alert("Ocurrio un error al realizar la verificación del evento, por favor intente en unos minutos")
                document.getElementById('loader').style.display = 'none';
            }
        });
        
        document.getElementById('loader2').style.display = 'none';
    }
    
    function seleccionar_cufd(){
        let base_url = $("#base_url").val();
        let controlador = `${base_url}eventos_significativos/buscar_cufd`;
        let fecha =  document.getElementById('ces_fechainicio').value;
        //document.getElementById('loader').style.display = 'block';
        fecha = fecha.substring(0,10);
       // alert(fecha);
        $.ajax({
            url: controlador,
            type:"POST",
            data:{
                fecha: fecha
            },
            // async: false,
            success: (respuesta)=>{
                let res = JSON.parse(respuesta);
                let html = "";

                for(i=0; i<res.length; i++){                    
                    html += "<option value="+res[i]["cufd_codigo"]+">"+res[i]["cufd_fecharegistro"]+" (PV: "+res[i]["cufd_puntodeventa"]+") "+res[i]["cufd_codigo"]+"</option>"               
                }
                
                $("#select_cufd").html(html);                
                document.getElementById('loader2').style.display = 'none';
            },
            error: ()=>{
                alert("Ocurrio un error al realizar la verificación del evento, por favor intente en unos minutos")
                document.getElementById('loader').style.display = 'none';
            }
        });
    }
</script>