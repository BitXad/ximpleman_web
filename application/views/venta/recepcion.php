<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/recepcion.js'); ?>" type="text/javascript"></script>    
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
 
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<input type="text" id="decimales" value="<?php echo $parametro['parametro_decimales']; ?>" name="decimales"  hidden>
<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<input id="ventas" name="ventas" hidden>
<audio id="timbre" src="<?php echo base_url('resources/sonidos/timbre.wav'); ?>" preload="audio"></audio>
<input type="text" value="" id="parametro" hidden>

<div class="col-md-12">
    <div class="col-md-2">
    <font size="4"><b>Recepcion de pedidos</b></font>
</div>
    <div class="col-md-6">
            <!--------------------- parametro de buscador --------------------->
                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese cliente">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
    </div>
            <div class="col-md-2">
                <div class="box-tools">
                    <select name="entrega_id" class="btn-primary btn-sm btn-block" id="entrega_id" onchange="buscar_por_entrega()">
                      
                        <?php 
                        foreach($all_entrega as $entrega)
                        {
                            echo '<option value="'.$entrega['entrega_id'].'">'.$entrega['entrega_nombre'].'</option>';
                        } 
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="box-tools">
                    <select name="destino_id" class="btn-primary btn-sm btn-block" id="destino_id" onchange="buscar_por_entrega()">
                      
                        <?php 
                        foreach($all_destino as $destino)
                        {
                            echo '<option value="'.$destino['destino_id'].'">'.$destino['destino_nombre'].'</option>';
                        } 
                        ?>
                    </select>
                </div>
            </div>                     
</div>                

<div class="row">
    <div class="col-md-12">

            
<!--------------------- inicio loader ------------------------->
<div class="row" id='oculto'  style='display:none;'>
    <center>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
    </center>
</div> 
<!--------------------- fin inicio loader ------------------------->
            
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>#</th>					
                                                <th>Cliente</th>
						<th>Pedido</th>						
						<th>Orden</th>
						<th></th>

                    </tr>

                    <tbody class="buscar" id="tabla_recepcion">

                    </tbody>
                </table>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
            </div>
        </div>
    </div>
</div>

