<script src="<?php echo base_url('resources/js/dia.js'); ?>" type="text/javascript"></script>
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="cod_dia" id="cod_dia" />
<div class="box-header">
    <h3 class="box-title">Cambio de Dolar y UFV</h3>
    <div class="box-tools">
        <a onclick="mostrarimportarmodal()" class="btn btn-facebook btn-sm"><span class="fa fa-file-excel-o"></span> Importar de Excel</a>
        <a onclick="mostrarnuevomodal()" class="btn btn-success btn-sm"> + Añadir</a>
    </div>
</div>
<div class="row col-md-12" id='loader'  style='display:none; text-align: center'>
    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
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
                    <tbody class="buscar" id="tablaresultados"></tbody>
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

<!------------------------ INICIO modal para mostrar registro de cotizaciones ------------------->
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
                    <div class="col-md-12"><span class="text-danger" id="mensajemodalnuevo"></span></div>
                    <div class="col-md-6">
                        <label for="fecha" class="control-label">Fecha</label>
                        <div class="form-group">
                            <input type="date" name="fecha" value="<?php echo date("Y-m-d"); ?>" class="form-control" id="fecha" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo_cambio" class="control-label">Tipo Cambio $us</label>
                        <div class="form-group">
                            <input type="number" min="0" step="any" name="tipo_cambio" class="form-control" id="tipo_cambio" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo_ufv" class="control-label">Tipo Cambio UFV</label>
                        <div class="form-group">
                            <input type="number" min="0" step="any" name="tipo_ufv" class="form-control" id="tipo_ufv" required />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center">
                <a href="#" class="btn btn-success" onclick="registrarcotizacion()"><span class="fa fa-save"></span> Guardar</a>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para mostrar registro de cotizaciones ------------------->
<!------------------------ INICIO modal para mostrar modifcar registro de cotizaciones ------------------->
<div class="modal fade" id="modalmodificar" tabindex="-1" role="dialog" aria-labelledby="modalmodificarlabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">MODIFICAR REGISTRO DE COTIZACIONES</span>
            </div>
            <div class="modal-body">
                <div class="box-body table-responsive">
                    <div class="col-md-12"><span class="text-danger" id="mensajemodalmodificar"></span></div>
                    <div class="col-md-6">
                        <label for="fecham" class="control-label">Fecha</label>
                        <div class="form-group">
                            <input type="date" name="fecham" value="<?php echo date("Y-m-d"); ?>" class="form-control" id="fecham" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo_cambiom" class="control-label">Tipo Cambio $us</label>
                        <div class="form-group">
                            <input type="number" min="0" step="any" name="tipo_cambiom" class="form-control" id="tipo_cambiom" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo_ufvm" class="control-label">Tipo Cambio UFV</label>
                        <div class="form-group">
                            <input type="number" min="0" step="any" name="tipo_ufvm" class="form-control" id="tipo_ufvm" required />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center">
                <a href="#" class="btn btn-success" onclick="modificarcotizacion()"><span class="fa fa-save"></span> Guardar</a>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para mostrar modificar registro de cotizaciones ------------------->
<!------------------------ INICIO modal para mostrar eliminar registro de cotizaciones ------------------->
<div class="modal fade" id="modaleliminar" tabindex="-1" role="dialog" aria-labelledby="modaleliminarlabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">ELIMINAR REGISTRO DE COTIZACIONES</span>
                <span id="verfecha"></span>
            </div>
            <div class="modal-body">
                <div class="box-body table-responsive">
                    <div class="col-md-12"><span class="text-danger" id="mensajemodaleliminar"></span></div>
                    <div class="col-md-12">
                        <label for="fecham" class="control-label">¿Esta seguro que desea eliminar el registro acotual?</label>
                        <br><span>Al eliminar este registro no podra recuperarlo otra vez</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center">
                <a href="#" class="btn btn-success" onclick="eliminarcotizacion()"><span class="fa fa-check"></span> Aceptar</a>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para mostrar eliminar registro de cotizaciones ------------------->
<!------------------------ INICIO modal para importar archivo excel para registro de cotizaciones ------------------->
<div class="modal fade" id="modalimportar" tabindex="-1" role="dialog" aria-labelledby="modalimportarlabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">IMPORTAR INFORMACION DE TIPOS DE CAMBIO DE DOLAR Y UFV DE EXCEL</span>
            </div>
            <div class="modal-body">
                <div class="box-body table-responsive">
                    <div class="col-md-12"><span class="text-danger" id="mensajemodalimportar"></span></div>
                    <form id="frmArchivo" method="post">
                       <label>Archivo:</label>
                       <input id="archivo" type="file" name="archivo" />
                       <input type="hidden" name="MAX_FILE_SIZE" value="20000" />
                       <input class="boton" type="submit" name="enviar" value="Importar" />
                    </form>
                    
                </div>
            </div>
            <div class="modal-footer" style="text-align: center">
                <a href="#" class="btn btn-success" onclick="modificarcotizacion()"><span class="fa fa-file-excel-o"></span> Importar de Excel</a>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para importar archivo excel para registro de cotizaciones ------------------->