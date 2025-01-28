

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Asiento</h3>&nbsp;&nbsp;
<!--                <button type="button" class="btn btn-success btn-sm" onclick="cambiarcod(this);" title="Generar otro Código Cliente">
			<i class="fa fa-edit"></i>Codigo Cliente
		</button>-->
            </div>

<div class="container">
    <!--<h2 class="text-center">Agregar Asiento</h2>-->
    <form action="<?= site_url('asientos/add') ?>" method="post">
        <div class="box-body">
            <div class="col-md-3">
                <label>Nivel</label>
                <input type="text" class="form-control" name="nivel_id" required>
            </div>
            <div class="col-md-3">
                <label>Número</label>
                <input type="text" class="form-control" name="asiento_numero" required>
            </div>
            <div class="col-md-3">
                <label>Descripción</label>
                <input type="text" class="form-control" name="asiento_descripcion">
            </div>
            <div class="col-md-3">
                <label>Características</label>
                <input type="text" class="form-control" name="asiento_caracteristicas">
            </div>
            <div class="col-md-3">
                <label>Foto</label>
                <input type="text" class="form-control" name="asiento_foto">
            </div>
            <div class="col-md-3">
                <label>Orden</label>
                <input type="number" class="form-control" name="asiento_orden" required>
            </div>
    </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-success mt-3">Guardar</button>
            <a href="<?php echo site_url('asientos/index'); ?>" class="btn btn-danger">
            <i class="fa fa-times"></i> Cancelar</a>
        </div>

    </form>
</div>
      	</div>
    </div>
</div>