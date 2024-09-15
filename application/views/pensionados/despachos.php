<script src="<?php echo base_url('resources/js/pensionado.js'); ?>"></script>
<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
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
<?php $decimales = $parametro["parametro_decimales"]; ?>

<!-------------------------------------------------------->
<div class="box-header">
                <h3 class="box-title">Despachos</h3>
            	<div class="box-tools">
                    <!--<a href="<?php echo site_url('pensionados/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a>--> 
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el título, cantidad, precio total">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                            <th style="padding: 0;">#</th>
                            <th style="padding: 0;">CLIENTE</th>
                            <th style="padding: 0;">C.I.</th>
                            <th style="padding: 0;">COD.CONSUMO</th>
                            <th style="padding: 0;">FECHA</th>
                            <th style="padding: 0;">HORA</th>
                            <th style="padding: 0;">TOTAL</th>
                            <th style="padding: 0;">ESTADO</th>
                            <th style="padding: 0;"></th>

                    </tr>
                    
                    <tbody class="buscar">
                    
                            <?php  $i = 1; $estilo = "";
                            
                                foreach ($despachos as $d){  
                                    
                                    if($d["estado_id"]==3){
                                        $estilo = "style='background-color: lightgray;'";
                                    }else{ $estilo = ""; }
                                    
                                    ?>
                                    <tr <?php echo $estilo; ?>>
                                        <td style="text-align: right;"> <?php echo $i++; ?></td>
                                        <td style="width: 250px; overflow-wrap: break-word;"> <?php echo $d["cliente_nombre"]; ?></td>
                                        <td><?php echo $d["cliente_ci"]; ?></td>
                                        <td><?php echo $d["consumo_id"]; ?></td>
                                        <td><?php echo $d["consumo_fecha"]; ?></td>
                                        <td><?php echo $d["consumo_hora"]; ?></td>
                                        <td style="text-align: right;"> <?php echo number_format($d["consumo_total"],2,".",","); ?></td>
                                        <td><?php echo $d["estado_descripcion"]; ?></td>
                                        <td>
                                            <a href="<?php echo base_url("pensionados/comanda_boucher/".$d["consumo_id"]) ?>" class="btn btn-success btn-xs" target="_blank"><fa class="fa fa-print"></fa></a>
                                            <button class="btn btn-danger btn-xs" onclick="anular_consumo(<?php echo $d["consumo_id"]; ?>)" ><fa class="fa fa-trash"></fa></button>
                                        </td>

                                    </tr>
                            
                                <?php } ?>
                    </tbody>
                    
                    
                </table>
                               
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div> 
        </div>
    </div>
</div>


<!------------------------------------------------------------------------------->
<!----------------------- INICIO MODAL PENSIONADO ------------------------------->
<!------------------------------------------------------------------------------->


<div hidden>
    <button type="button" id="boton_pensionado" class="btn btn-default" data-toggle="modal" data-target="#modalpensionado" >
      Pensionado
    </button>
    
</div>

<div class="modal fade" id="modalpensionado" tabindex="-1" role="dialog" aria-labelledby="modalpensionado" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">REGISTRAR: PENSIONADO</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        
            <div class="modal-content" style="font-family: Arial">

    
                
                    <div class="box-body">
                        <div class="col-md-12" id="tabla_modal">
                            
                        </div>
 
                    </div>

                        <div class="modal-footer" style="text-align: center">

                            <button type="button" class="btn btn-success btn-block" value="Registrar Pensionado" onclick="registrar_pensionado()"><fa class="fa fa-cutlery"></fa> Registrar Pensionado</button>
                            <button type="button" class="btn btn-danger btn-block" id="boton_cerrar_ventatemporal" data-dismiss="modal""><fa class="fa fa-times"></fa> Cerrar</button>
                        </div>
                

            </div>
    </div>
</div>

<!------------------------------------------------------------------------------->
<!----------------------- FIN MODAL GUARDAR VENTA ----------------------------------->
<!------------------------------------------------------------------------------->
