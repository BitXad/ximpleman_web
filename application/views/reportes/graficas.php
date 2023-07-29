<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/graficas.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/highcharts.js'); ?>"></script>
<!--<script src="https://code.highcharts.com/highcharts.js"></script>-->


<?php  $nombremes=array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"); ?>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="empresa_nombre" id="empresa_nombre" value="<?php echo $empresa[0]['empresa_nombre']; ?>" />
<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php echo $parametro['moneda_descripcion']; ?>" />
<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>" />
<input type="hidden" name="tipouser" id="tipouser" value="<?php echo $tipousuario_id; ?>" />
<input type="hidden" name="sistema_moduloventas" id="sistema_moduloventas" value="<?php echo $sistema["sistema_moduloventas"]; ?>" />
<div  class="row" >
    <div class="col-md-6">
        <label>Año</label>
        <select class="form-control" id="anio_sel" onchange="cambiar_fecha_grafica();">
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
            <option value="2022" >2022</option>
            <option value="2023" >2023</option>
            <option value="2024" >2024</option>
            <option value="2025" >2025</option>
            <option value="2026" >2026</option>
            <option value="2027" >2027</option>
            <option value="2028" >2028</option>
            <option value="2029" >2029</option>
            <option value="2030" >2030</option>
            <option value="2031" >2031</option>
            <option value="2032" >2032</option>
            <option value="2033" >2033</option>
            <option value="2034" >2034</option>
            <option value="2035" >2035</option>
            <option value="2036" >2036</option>
        </select>
    </div>
<div class="col-md-6">
                  <label>Mes</label>
                  <select class="form-control" id="mes_sel" onchange="cambiar_fecha_grafica();" >
                  
                    <option value="1">ENERO</option>
                    <option value="2">FEBRERO</option>
                    <option value="3">MARZO</option>
                    <option value="4">ABRIL</option>
                    <option value="5">MAYO</option>
                    <option value="6">JUNIO</option>
                    <option value="7">JULIO</option>
                    <option value="8">AGOSTO</option>
                    <option value="9">SEPTIEMBRE</option>
                    <option value="10">OCTUBRE</option>
                    <option value="11">NOVIEMBRE</option>
                    <option value="12">DICIEMBRE</option>
                  
                  </select>

</div>
</div>

<div  class="row" >
<br/>
	<div class="box box-primary">
		<div class="box-header">
		</div>

		<div class="box-body" id="div_grafica_barras">
		</div>

                <div class="box-footer">
                </div>
	</div>

        <br/>
	<div class="box box-primary">
		<div class="box-header">
		</div>

		<div class="box-body" id="div_grafica_lineas">
		</div>

                <div class="box-footer">
                </div>
	</div>


	<br/>
        
	<div class="box box-primary">
		<div class="box-header">
		</div>

		<div class="box-body" id="div_grafica_pie">
		</div>

                <div class="box-footer">
                </div>
	</div>


</div>



