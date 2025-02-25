<div class="row">
    <div class="col-md-12">
            <?php echo form_open('vehiculo/add'); ?>
             <div class="col-md-6">
               <label for="vehiculo_id" class="control-label"> <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_id" value="<?php echo $this->input->post('vehiculo_id'); ?>" class="form-control " id="vehiculo_id" />
                   <span class="text-danger"><?php echo form_error('vehiculo_id');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_apellidospropietario" class="control-label"> <span class="text-danger"></span>APELLIDOS PROPIETARIO</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_apellidospropietario" value="<?php echo $this->input->post('vehiculo_apellidospropietario'); ?>" class="form-control " id="vehiculo_apellidospropietario" />
                   <span class="text-danger"><?php echo form_error('vehiculo_apellidospropietario');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_nombrespropietario" class="control-label"> <span class="text-danger"></span>NOMBRES PROPIETARIO</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_nombrespropietario" value="<?php echo $this->input->post('vehiculo_nombrespropietario'); ?>" class="form-control " id="vehiculo_nombrespropietario" />
                   <span class="text-danger"><?php echo form_error('vehiculo_nombrespropietario');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="estado_id" class="control-label"> <span class="text-danger"></span>ESTADO</label>
                <div class="form-group">
                  <input type="text" name="estado_id" value="<?php echo $this->input->post('estado_id'); ?>" class="form-control " id="estado_id" />
                   <span class="text-danger"><?php echo form_error('estado_id');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="tipomovilidad_id" class="control-label"> <span class="text-danger"></span>TIPO MOVILIDAD</label>
                <div class="form-group">
                  <input type="text" name="tipomovilidad_id" value="<?php echo $this->input->post('tipomovilidad_id'); ?>" class="form-control " id="tipomovilidad_id" />
                   <span class="text-danger"><?php echo form_error('tipomovilidad_id');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="categoriavehiculo_id" class="control-label"> <span class="text-danger"></span>CATEGORIA VEHICULO</label>
                <div class="form-group">
                  <input type="text" name="categoriavehiculo_id" value="<?php echo $this->input->post('categoriavehiculo_id'); ?>" class="form-control " id="categoriavehiculo_id" />
                   <span class="text-danger"><?php echo form_error('categoriavehiculo_id');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="asiento_id" class="control-label"> <span class="text-danger"></span>ASIENTO</label>
                <div class="form-group">
                  <input type="text" name="asiento_id" value="<?php echo $this->input->post('asiento_id'); ?>" class="form-control " id="asiento_id" />
                   <span class="text-danger"><?php echo form_error('asiento_id');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_placa" class="control-label"> <span class="text-danger"></span>PLACA</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_placa" value="<?php echo $this->input->post('vehiculo_placa'); ?>" class="form-control " id="vehiculo_placa" />
                   <span class="text-danger"><?php echo form_error('vehiculo_placa');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_clase" class="control-label"> <span class="text-danger"></span>CLASE VEHICULO</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_clase" value="<?php echo $this->input->post('vehiculo_clase'); ?>" class="form-control " id="vehiculo_clase" />
                   <span class="text-danger"><?php echo form_error('vehiculo_clase');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_marca" class="control-label"> <span class="text-danger"></span>MARCA</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_marca" value="<?php echo $this->input->post('vehiculo_marca'); ?>" class="form-control " id="vehiculo_marca" />
                   <span class="text-danger"><?php echo form_error('vehiculo_marca');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_modelo" class="control-label"> <span class="text-danger"></span>MODELO</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_modelo" value="<?php echo $this->input->post('vehiculo_modelo'); ?>" class="form-control " id="vehiculo_modelo" />
                   <span class="text-danger"><?php echo form_error('vehiculo_modelo');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_aniofabricacion" class="control-label"> <span class="text-danger"></span>AÑO FABRICACION</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_aniofabricacion" value="<?php echo $this->input->post('vehiculo_aniofabricacion'); ?>" class="form-control " id="vehiculo_aniofabricacion" />
                   <span class="text-danger"><?php echo form_error('vehiculo_aniofabricacion');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_tipocombustible" class="control-label"> <span class="text-danger"></span>TIPO COMBUSTIBLE</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_tipocombustible" value="<?php echo $this->input->post('vehiculo_tipocombustible'); ?>" class="form-control " id="vehiculo_tipocombustible" />
                   <span class="text-danger"><?php echo form_error('vehiculo_tipocombustible');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_carroceria" class="control-label"> <span class="text-danger"></span>CARROCERIA</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_carroceria" value="<?php echo $this->input->post('vehiculo_carroceria'); ?>" class="form-control " id="vehiculo_carroceria" />
                   <span class="text-danger"><?php echo form_error('vehiculo_carroceria');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_ejes" class="control-label"> <span class="text-danger"></span>NUM. EJES</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_ejes" value="<?php echo $this->input->post('vehiculo_ejes'); ?>" class="form-control " id="vehiculo_ejes" />
                   <span class="text-danger"><?php echo form_error('vehiculo_ejes');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_color" class="control-label"> <span class="text-danger"></span>COLOR</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_color" value="<?php echo $this->input->post('vehiculo_color'); ?>" class="form-control " id="vehiculo_color" />
                   <span class="text-danger"><?php echo form_error('vehiculo_color');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_numeromotor" class="control-label"> <span class="text-danger"></span>NUM. MOTOR</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_numeromotor" value="<?php echo $this->input->post('vehiculo_numeromotor'); ?>" class="form-control " id="vehiculo_numeromotor" />
                   <span class="text-danger"><?php echo form_error('vehiculo_numeromotor');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_cilindros" class="control-label"> <span class="text-danger"></span>NUM. CILINDROS</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_cilindros" value="<?php echo $this->input->post('vehiculo_cilindros'); ?>" class="form-control " id="vehiculo_cilindros" />
                   <span class="text-danger"><?php echo form_error('vehiculo_cilindros');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_serie" class="control-label"> <span class="text-danger"></span>SERIE</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_serie" value="<?php echo $this->input->post('vehiculo_serie'); ?>" class="form-control " id="vehiculo_serie" />
                   <span class="text-danger"><?php echo form_error('vehiculo_serie');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_ruedas" class="control-label"> <span class="text-danger"></span>NUM. RUEDAS</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_ruedas" value="<?php echo $this->input->post('vehiculo_ruedas'); ?>" class="form-control " id="vehiculo_ruedas" />
                   <span class="text-danger"><?php echo form_error('vehiculo_ruedas');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_pesoseco" class="control-label"> <span class="text-danger"></span>PESO SECO</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_pesoseco" value="<?php echo $this->input->post('vehiculo_pesoseco'); ?>" class="form-control " id="vehiculo_pesoseco" />
                   <span class="text-danger"><?php echo form_error('vehiculo_pesoseco');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_pesobruto" class="control-label"> <span class="text-danger"></span>PESO BRUTO</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_pesobruto" value="<?php echo $this->input->post('vehiculo_pesobruto'); ?>" class="form-control " id="vehiculo_pesobruto" />
                   <span class="text-danger"><?php echo form_error('vehiculo_pesobruto');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_longitud" class="control-label"> <span class="text-danger"></span>LONGITUD</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_longitud" value="<?php echo $this->input->post('vehiculo_longitud'); ?>" class="form-control " id="vehiculo_longitud" />
                   <span class="text-danger"><?php echo form_error('vehiculo_longitud');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_altura" class="control-label"> <span class="text-danger"></span>ALTURA</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_altura" value="<?php echo $this->input->post('vehiculo_altura'); ?>" class="form-control " id="vehiculo_altura" />
                   <span class="text-danger"><?php echo form_error('vehiculo_altura');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_ancho" class="control-label"> <span class="text-danger"></span>ANCHO</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_ancho" value="<?php echo $this->input->post('vehiculo_ancho'); ?>" class="form-control " id="vehiculo_ancho" />
                   <span class="text-danger"><?php echo form_error('vehiculo_ancho');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_pasajeros" class="control-label"> <span class="text-danger"></span>NUM. PASAJEROS</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_pasajeros" value="<?php echo $this->input->post('vehiculo_pasajeros'); ?>" class="form-control " id="vehiculo_pasajeros" />
                   <span class="text-danger"><?php echo form_error('vehiculo_pasajeros');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_tiposervicio" class="control-label"> <span class="text-danger"></span>TIPO SERVICIO</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_tiposervicio" value="<?php echo $this->input->post('vehiculo_tiposervicio'); ?>" class="form-control " id="vehiculo_tiposervicio" />
                   <span class="text-danger"><?php echo form_error('vehiculo_tiposervicio');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_asientos" class="control-label"> <span class="text-danger"></span>NUM. ASIENTOS</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_asientos" value="<?php echo $this->input->post('vehiculo_asientos'); ?>" class="form-control " id="vehiculo_asientos" />
                   <span class="text-danger"><?php echo form_error('vehiculo_asientos');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_ruat" class="control-label"> <span class="text-danger"></span>RUAT</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_ruat" value="<?php echo $this->input->post('vehiculo_ruat'); ?>" class="form-control " id="vehiculo_ruat" />
                   <span class="text-danger"><?php echo form_error('vehiculo_ruat');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_fechatarjeta" class="control-label"> <span class="text-danger"></span>LIM. TARJETA</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_fechatarjeta" value="<?php echo $this->input->post('vehiculo_fechatarjeta'); ?>" class="has-datepicker form-control" data-date-format='YYYY-MM-DD' id="vehiculo_fechatarjeta" />
                   <span class="text-danger"><?php echo form_error('vehiculo_fechatarjeta');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_tarjetacirculacion" class="control-label"> <span class="text-danger"></span>TARJETA CIRCULACION</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_tarjetacirculacion" value="<?php echo $this->input->post('vehiculo_tarjetacirculacion'); ?>" class="form-control " id="vehiculo_tarjetacirculacion" />
                   <span class="text-danger"><?php echo form_error('vehiculo_tarjetacirculacion');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="vehiculo_imagen" class="control-label"> <span class="text-danger"></span>IMAGEN</label>
                <div class="form-group">
                  <input type="text" name="vehiculo_imagen" value="<?php echo $this->input->post('vehiculo_imagen'); ?>" class="form-control " id="vehiculo_imagen" />
                   <span class="text-danger"><?php echo form_error('vehiculo_imagen');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for=" " class="control-label"> </label>
                <div class="form-group">
                   <button type="submit" class="btn btn-success">  
                   <i class="fa fa-check"></i> Save 
                        </button> 
               </div>
             </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
