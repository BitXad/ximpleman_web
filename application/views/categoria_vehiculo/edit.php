<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Categoria Vehiculo Edit</h3>
            <?php echo form_open('categoria_vehiculo/edit/'.$categoria_vehiculo['categoriavehiculo_id']); ?>
            <div class="box-body">
              <div class="row clearfix">
           <div class="col-md-6">
               <label for="categoriavehiculo_id" class="control-label">  <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="text" name="categoriavehiculo_id" value="<?php echo ($this->input->post('categoriavehiculo_id') ? $this->input->post('categoriavehiculo_id') : $categoria_vehiculo['categoriavehiculo_id']); ?>" class="form-control" id="categoriavehiculo_id" />
                    <span class="text-danger"><?php echo form_error('categoriavehiculo_id');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="categoriavehiculo_nombre" class="control-label">  <span class="text-danger"></span>NOBRE CATEGORIA</label>
                <div class="form-group">
                  <input type="text" name="categoriavehiculo_nombre" value="<?php echo ($this->input->post('categoriavehiculo_nombre') ? $this->input->post('categoriavehiculo_nombre') : $categoria_vehiculo['categoriavehiculo_nombre']); ?>" class="form-control" id="categoriavehiculo_nombre" />
                    <span class="text-danger"><?php echo form_error('categoriavehiculo_nombre');?></span>
               </div>
             </div> 
                     </div>
      </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> Save
              </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
</div>
