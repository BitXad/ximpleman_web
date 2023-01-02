<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<!-- ------------------------------------------------------------------------------------ -->
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <h4>PLAN DE CUENTAS</h4>
                <hr>
                <div class="row">
                    <ol style="list-style:none">
                        <?php foreach($p_cuentas as $cuenta) { ?>
                            <!-- <?php if ($cuenta['p_cuenta_nivel'] == 1) {?> -->
                                <li>
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="row"> 
                                                <div class="col-md-8">
                                                    <a onclick="mostrar_hijos(<?= $cuenta['p_cuenta_id'] ?>)" style="cursor: pointer;"><?= $cuenta['p_cuenta_num'] ?>.- <?= $cuenta['p_cuenta_nombre'] ?></a>
                                                </div>
                                                <div class="col-md-4 no-print" id="botones<?= ($cuenta['p_cuenta_num'].$cuenta['p_cuenta_nombre']) ?>">
                                                    <button id="boton_pc2" class="btn btn-success btn-xs" title="Agregar cuenta" onclick="agregar_plan(<?= $cuenta['p_cuenta_tipo'] ?>)" data-toggle="modal" data-target="#exampleModalCenter">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                    <button class="btn btn-primary btn-xs" title="Editar plan de cuenta" data-toggle="modal" data-target="#modal_edit" onclick="get_planes(<?= $cuenta['p_cuenta_tipo'] ?>)">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-xs" title="Borrar plan de cuenta" data-target="#modal_delete" data-toggle="modal" onclick="agregar_plan(<?= $cuenta['p_cuenta_tipo'] ?>,1)">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="listahijos<?= $cuenta['p_cuenta_id'] ?>"></div>
                                    <div>
                                </li>
                            <!-- <?php } ?> -->
                        <?php } ?>
                    </ol>
                </div>
                <div>
                    <button type="button" class="btn btn-primary btn-sm no-print" data-toggle="modal" data-target="#exampleModalCenter" onclick="agregar_plan()">
                        <i class="fa fa-plus" aria-hidden="true"></i> Agregar plan de cuenta
                    </button>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalCenterTitle">Agregar nuevo plan de cuenta</h4>
                            </div>
                            <?php echo form_open('plan_cuentas/add'); ?>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label id="label_cuenta_mayor" for="cuenta_mayor">Cuenta mayor</label>
                                            <div class="form-group">
                                                <select name="cuenta_mayor" id="cuenta_mayor" class="form-control"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-8"></div>
                                        <div class="col-md-12">
                                            <label for="nombre">Nombre</label>
                                            <div class="form-group">
                                                <input id="nombre" name="nombre" type="text" class="form-control" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);">
                                            </div>
                                            <div class="form-group">
                                                <input id="tipo" name="tipo" type="hidden" class="form-control" value="">
                                            </div>

                                        </div>
                                    </div>
                                    
                                </div>  
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
                <!-- Modal Edit -->
                <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalEdit">Editar plan de cuenta</h4>
                            </div>
                            <?php echo form_open('plan_cuentas/edit'); ?>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label id="label_cuenta_mayor" for="cuenta_mayor_edit">Cuenta a Editar</label>
                                            <div class="form-group">
                                                <select name="cuenta_mayor_edit" id="cuenta_mayor_edit" class="form-control" onchange="plan_escogido()"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-8"></div>
                                        <div class="col-md-12">
                                            <label for="new_nombre">Nuevo nombre</label>
                                            <div class="form-group">
                                                <input id="new_nombre" name="new_nombre" type="text" class="form-control" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" value="">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>  
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
                <!-- Borrar -->
                <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalEdit">Borrar plan de cuenta</h4>
                            </div>
                            <?php echo form_open('plan_cuentas/borrar_plan_cuenta'); ?>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label id="label_cuenta_mayor" for="cuenta_mayor_borrar">Cuenta a Editar</label>
                                            <div class="form-group">
                                                <select name="cuenta_mayor_borrar" id="cuenta_mayor_borrar" class="form-control" onchange="plan_escogido()"></select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>  
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Borrar</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url("resources/js/p_cuentas.js") ?>"></script>   