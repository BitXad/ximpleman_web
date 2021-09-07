<script src="<?php echo base_url('resources/js/dia.js'); ?>" type="text/javascript"></script>
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<div class="box-header">
    <h3 class="box-title">Cambio de Dolar y UFV</h3>
    <div class="box-tools">
        <a onclick="mostrarnuevomodal()" class="btn btn-success btn-sm"> + Añadir</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>T.C. USD</th>
                        <th>T.C. Ufv</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar"></tbody>
                    <?php /*foreach($dia as $d){ ?>
                    <tr>
                        <td><?php echo $d['cod_dia']; ?></td>
                        <td><?php echo $d['fecha']; ?></td>
                        <td><?php echo $d['tipo_cambio']; ?></td>
                        <td><?php echo $d['tipo_ufv']; ?></td>
                        <td>
                            <a href="<?php echo site_url('dia/edit/'.$d['cod_dia']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('dia/remove/'.$d['cod_dia']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php }*/ ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>

<!------------------------ INICIO modal para Seleccionar nuevo asociado ------------------->
<div class="modal fade" id="modalnuevomodal" tabindex="-1" role="dialog" aria-labelledby="modalnuevomodallabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">REGISTRO DE COTIZACIONES</span>
            </div>
            <div class="modal-body">
                <div class="box-body table-responsive">
                    <div class="col-md-6">
                        <label for="fecha" class="control-label">Fecha</label>
                        <div class="form-group">
                            <input type="date" name="fecha" value="<?php echo date("Y-m-d"); ?>" class="form-control" id="fecha" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo_cambio" class="control-label">Tipo Cambio $us</label>
                        <div class="form-group">
                            <input type="number" min="0" step="any" name="tipo_cambio" value="<?php echo $this->input->post('tipo_cambio'); ?>" class="form-control" id="tipo_cambio" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo_ufv" class="control-label">Tipo Cambio UFV</label>
                        <div class="form-group">
                            <input type="number" min="0" step="any" name="tipo_ufv" value="<?php echo $this->input->post('tipo_ufv'); ?>" class="form-control" id="tipo_ufv" required />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center">
                <a href="#" class="btn btn-success" data-dismiss="modal"><span class="fa fa-save"></span> Guardar</a>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para Seleccionar nuevo asociado ------------------->