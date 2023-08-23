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
<input type="hidden" id="dosificacion_ambiente" value="<?php echo $dosificacion['dosificacion_ambiente']; ?>" name="dosificacion_ambiente">

<div class="box-header">
    <font size='4' face='Arial'><b>SINCRONIZACION CÓDIGOS Y CATÁLOGOS</b></font>
    <div class="box-tools no-print">
        <button class="btn btn-facebook float-right" onclick="cargar_datos()"><i class="fa-solid fa-arrows-rotate"></i> Cargar Datos</button>
        <button class="btn btn-success float-right" onclick="sincronizar(0,1)"><i class="fa-solid fa-arrows-rotate"></i> Sincronizar Todo</button>
        
            
    </div>
</div>
<div class="row">
    
        <?php if($dosificacion["dosificacion_ambiente"]==2){ ?>
            
            
            <div class="col-md-2">
            <label for="venta_total" class="control-label">Cantidad</label>
                    <div class="form-group">
            
                        <input id="limite" name="limite"  type="number" class="form-control" value="10">

                    </div>
            </div>
    
            <div class="col-md-2">
                    <label for="venta_efectivo" class="control-label">Sincronizar</label>
                    <div class="form-group">
                
                        <button class="btn btn-info float-right form-control" onclick="sincronizar_certificacion()"><i class="fa-solid fa-arrows-rotate"></i> Sincronizar x ciclo</button>

                    </div>
            </div>
            
        <?php } ?>
            
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
                            <th>SINCRONIZACION DE CODIGOS</th>
                            <th width="100px" class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php 
                        $i=1;
                        foreach ($sincronizaciones as $sincronizacion) {?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $sincronizacion['sincronizacion_descripcion'] ?></td>                            
                                <td>
                                    <button class="btn btn-primary btn-xs" title="Sincronizar <?= strtolower($sincronizacion['sincronizacion_descripcion']) ?>" onclick="sincronizar(<?= $sincronizacion['sincronizacion_id'] ?>)">
                                        <i class="fa-solid fa-arrows-rotate"></i>
                                    </button>
                                    <a class="btn btn-info btn-xs" title="Ver datos" href="<?= site_url("sincronizacion/show_sincronizacion/{$sincronizacion['sincronizacion_id']}") ?>">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
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
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script>
    
    function sincronizar(codigo_sincronizar, origen){
        
        let base_url = $("#base_url").val();
        //let dosificacion_ambiente = $("#dosificacion_ambiente").val();
        let controlador = `${base_url}sincronizacion/sincronizar_datos`;
        
        document.getElementById('loader').style.display = 'block';
        
        $.ajax({
            url: controlador,
            type:"POST",
            data:{
                codigo_sincronizar: codigo_sincronizar
            },
            //async: false,
            success: (respuesta)=>{
                
                let res = JSON.parse(respuesta);
                console.log(res)
        
                if(res){
                    
                    if (origen == 1) //Si el origen viene del boton sincronizar
                        alert("Se completo la sincronización");
                
                }else{
                    alert("No se logro completar la sincronización");
                }
                
                document.getElementById('loader').style.display = 'none';
                
            },
            error: ()=>{
                alert("Ocurrio un error al realizar la sincronización, por favor intente en unos minutos")
                document.getElementById('loader').style.display = 'none';
            }
        });
    }

    function sincronizar_certificacion(){
        
        let base_url = $("#base_url").val();
        //let dosificacion_ambiente = $("#dosificacion_ambiente").val();
        let controlador = `${base_url}sincronizacion/sincronizar_datos`;
        var codigo_sincronizar = 0;
        var limite = $("#limite").val();
        //alert(limite);
        
        for(var i = Number(limite); i >= 1 ; i--){
            
                document.getElementById('loader').style.display = 'block';
            
                        $.ajax({
                        url: controlador,
                        type:"POST",
                        data:{
                            codigo_sincronizar: codigo_sincronizar
                        },
                        //async: false,
                        success: (respuesta)=>{

                            let res = JSON.parse(respuesta);
                            console.log(res);
                            document.getElementById('loader').style.display = 'none';

                        },
                        error: ()=>{
                            alert("Ocurrio un error al realizar la sincronización, por favor intente en unos minutos")
                            document.getElementById('loader').style.display = 'none';
                        }
                    });
            
            //delay(5000);
            document.getElementById("limite").value = i;
//            $("#limite").val(i);
           // sleep(500);
        }
        
       
    }

    function cargar_datos(){
        let base_url = $("#base_url").val();
        let controlador = `${base_url}sincronizacion/cargar_datos`;
        document.getElementById('loader').style.display = 'block';
        let codigo_sincronizar = 0;
        
        $.ajax({
            url: controlador,
            type:"POST",
            data:{
                codigo_sincronizar: codigo_sincronizar
            },
            // async: false,
            success: (respuesta)=>{
                let res = JSON.parse(respuesta);
                console.log(res)
                if(res){
                    
                     alert("Se completo la sincronización");
                     location. reload();
                     
                     
                }else{
                    alert("No se logro completar la sincronización");
                }
                document.getElementById('loader').style.display = 'none';
            },
            error: ()=>{
                alert("Ocurrio un error al realizar la sincronización, por favor intente en unos minutos")
                document.getElementById('loader').style.display = 'none';
            }
        });
    }
</script>

<?php /*echo "<br>".date("YmdHis").round(microtime(true) * 1000 %60%60%60); ?>
<?php echo "<br>". round(microtime(true) * 1000 %60%60%60); ?>
<?php echo "<br>". substr(round(microtime(true) * 1000),1,3);*/ ?>