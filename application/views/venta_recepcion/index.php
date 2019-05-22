<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<!--<script src="<?php // echo base_url('resources/js/funciones.js'); ?>" type="text/javascript"></script>-->


<script type="text/javascript">
function cargar(){
    opener.location.reload();
    window.close();
}
</script>
<form method="GET">
    <input type="text" name="Apellidos" id="Apellidos" />
    <input type="submit" id="actualizar" value="Actualizar Datos" onclick="cargar()"/>
</form>

<h1>Abrir Ventana hijo popup </h1>
<div>
    <button onclick="window.open('<?php echo base_url(); ?>venta_recepcion/venta_proceso','nv','width=500,height=500')">ventana</button>
    <button onclick="window.open('<?php echo base_url(); ?>venta_recepcion/venta_proceso','nv','width=500,height=500')">ventana</button>
    <!--<button onclick="opener.location.href='<?php echo base_url(); ?>venta_recepcion/venta_proceso'; self.close();">Cerrar</button>-->
    <button onclick="opener.location.href='<?php echo base_url(); ?>venta_recepcion/venta_proceso'; self.close();">Cerrar</button>
    <script>opener.window.location.reload();</script>
</div>

<div class="row">
    <div class="col-md-12">
        
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese usuario, cliente, fecha">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
            
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
						<th>Totales</th>						
						<th>Trans.</th>
						<th>Tipo</th>
						<th>Fecha</th>
						<th></th>

                    </tr>

                    <tbody class="buscar" id="tabla_ventas">

                    </tbody>
                </table>               
            </div>
        </div>
    </div>
</div>

