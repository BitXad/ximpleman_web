    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    
    <!-- Styles for datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <!-- JQuery include -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
    <!-- Javascrips for datatables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> 
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Clasificador</h3>
            </div>
            <?php echo form_open('clasificador/add'); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="clasificador_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
                        <div class="form-group">
                            <input type="text" name="clasificador_nombre" value="<?php echo $this->input->post('clasificador_nombre'); ?>" class="form-control" id="clasificador_nombre" required autocomplete="off" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            <span class="text-danger"><?php echo form_error('clasificador_nombre');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="clasificador_codigo" class="control-label">Código</label>
                        <div class="form-group">
                            <input type="text" name="clasificador_codigo" value="<?php echo $this->input->post('clasificador_codigo'); ?>" class="form-control" id="clasificador_codigo" autocomplete="off" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            <span class="text-danger"><?php echo form_error('clasificador_codigo');?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> Guardar
            </button>
             <a href="<?php echo site_url('clasificador'); ?>" class="btn btn-danger">
                <i class="fa fa-times"></i> Cancelar</a>
            </div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>