<script src="<?php echo base_url('resources/js/producir.js'); ?>"></script>
<style type="text/css">
    .contorno{
        padding: 2;
        padding-left: 1px;
        margin: 0;
        line-height: 15px;
    }
</style>
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<input type="hidden" name="laformula" id="laformula" value='<?php echo json_encode($all_formula); ?>' />
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

<div class="panel-group contorno">
    <div class="panel panel-default contorno">
        <div class="panel-heading col-md-12 contorno">
            <div class="col-md-3 contorno">
                <label for="formula_id" class="control-label" style="margin-bottom: 0;">FORMULA</label>           
                <div class="form-group contorno">
                    <select  class="form-control btn btn-warning btn-sm" style='color: black; background: #1221; text-align: left; font-size: 18px; font-family: Arial;' id="formula_id" name="formula_id" onchange="elegirformula()">
                        <option value="">- Elija una formula -</option>
                        <?php
                        foreach($all_formula as $formula){                          
                        ?>                    
                        <option value="<?php echo $formula["formula_id"] ?>"><?php echo $formula['formula_nombre'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3 contorno">
                <label for="formula_unidad" class="control-label" style="margin-bottom: 0;">UNIDAD</label>
                <div class="form-group contorno">
                    <input type="text" name="formula_unidad" class="form-control  btn btn-warning btn-sm" style='color: black; background: #1221; text-align: left; font-size: 18px; font-family: Arial;' id="formula_unidad" />
                </div>
            </div>
            <div class="col-md-3 contorno">
                <label for="formula_cantidad" class="control-label" style="margin-bottom: 0;">CANTIDAD</label>
                <div class="form-group contorno">
                    <input type="number" step="any" min="0" name="formula_cantidad" class="form-control  btn btn-warning btn-sm" style='color: black; background: #1221; text-align: left; font-size: 18px; font-family: Arial;' id="formula_cantidad" value="<?php echo 1; ?>" />
                </div>
            </div>
            <div class="col-md-3 contorno">
                <label for="formula_costounidad" class="control-label" style="margin-bottom: 0;">COSTO UNITARIO</label>
                <div class="form-group contorno">
                    <input type="number" step="any" min="0" name="formula_costounidad" class="form-control  btn btn-warning btn-sm" style='color: black; background: #1221; text-align: left; font-size: 18px; font-family: Arial;' id="formula_costounidad" value="<?php echo 0; ?>" />
                </div>
            </div>
            <div class="col-md-3 contorno">
                <label for="formula_preciounidad" class="control-label" style="margin-bottom: 0;">PRECIO</label>
                <div class="form-group contorno">
                    <input type="number" step="any" min="0" name="formula_preciounidad" class="form-control  btn btn-warning btn-sm" style='color: black; background: #1221; text-align: left; font-size: 18px; font-family: Arial;' id="formula_preciounidad" value="<?php echo 0; ?>" />
                </div>
            </div>
            <div class="col-md-3 contorno">
                <label for="calcularformula" class="control-label" style="margin-bottom: 0;">&nbsp;</label>
                <div class="form-group contorno">
                    <a class="form-control btn btn-soundcloud" onclick="calcularformula()"><span></span> Calcular</a>
                </div>
            </div>
        </div>
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
                        <th>Producto</th>
                        <th>Costo</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                    <tbody id="detalle_deformula"></tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 text-center">
    <!--<label for="producir" class="control-label">&nbsp;</label>-->
    <div class="form-group">
        <a class="btn btn-success" onclick="producir()"><span class="fa fa-cogs"></span> Producir</a>
    </div>
</div>