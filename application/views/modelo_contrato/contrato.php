<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="venta_id" id="venta_id" value="<?= $venta[0]['venta_id']; ?>" />
<style type="text/css">

    p {
        font-family: Arial;
        font-size: 10pt;
        line-height: 120%;   /*esta es la propiedad para el interlineado*/
        color: #000;
        padding: 2px;
    }

    div {
        margin-top: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
        margin-left: 10px;
        margin: 0px;
    }

    table{
        width : 7cm;
        margin : 0 0 0px 0;
        padding : 0 0 0 0;
        border-spacing : 0 0;
        border-collapse : collapse;
        font-family: Arial;
        font-size: 8pt;  
    }

    td {
        border:hidden;
    }

    td#comentario {
        vertical-align : bottom;
        border-spacing : 0;
    }
    div#content {
        background : #ddd;
        font-size : 8px;
        margin : 0 0 0 0;
        padding : 0 5px 0 5px;
        border-left : 1px solid #aaa;
        border-right : 1px solid #aaa;
        border-bottom : 1px solid #aaa;
    }
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!-------------------------------------------------------->
<?php 
    $tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
    $ancho = $parametro[0]["parametro_anchofactura"];
    $margen_izquierdo = "col-xs-".$parametro[0]["parametro_margenfactura"];
?>

<div class="<?php echo $margen_izquierdo; ?>" style="padding: 0; max-width:5cm;"></div>

<form class="form-inline">
    <div class="form-group mb-2" >
        <label class="no-print" for="contrato_id">Información 2do comprador </label>
        <!-- <select name="contrato_id" id="contrato_id" class="form-control no-print" onchange="cambiar_contrato()">
            <?php foreach ($modelo_contratos as $modcontrato) {
                echo "<option value='{$modcontrato['modcontrato_id']}'>{$modcontrato['modcontrato_nombre']}</option>";
            } ?>
        </select> -->
        <input type="text" class="form-control no-print" id="segundoComprador_nombre" placeholder="Nombre" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus>
        <input type="text" class="form-control no-print" id="segundoComprador_ci" placeholder="C.I." onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus>
    </div>
    <br>
    <!-- <sp class="no-print">Colindancias </span> -->
    <div class="form-group mb-2" >
        <label for="" class="no-print">Colindancias </label>
        <input type="text" class="form-control no-print" id="colindancia_norte" placeholder="NORTE" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus>
        <input type="text" class="form-control no-print" id="colindancia_sur" placeholder="SUR" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus>
        <input type="text" class="form-control no-print" id="colindancia_este" placeholder="ESTE" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus>
        <input type="text" class="form-control no-print" id="colindancia_oeste" placeholder="OESTE" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus>
    </div>
    <a id="segundoComprador_a" class="btn btn-success no-print" onClick="agregar_segundo()" ><i class="fa fa-plus-square-o" aria-hidden="true"></i> Cambiar</a>
</form>
<br>
<div class="col-xs-10" style="padding: 0; display: contents;">
    <div style="width: <?php echo $ancho;?>cm; padding: 0;">
        <div id="contrato">
            <?= $contrato['modcontrato_contrato'] ?>
        </div>
    </div>
</div>

<script>
    function cambiar_contrato(){
        let base_url = $('#base_url').val();
        let controlador  = `${base_url}modelo_contrato/cambiar_contrato`
        let contrato = $('#contrato_id').val();
        // contrato != 1 ? campos(true):campos(false);
        let venta_id = $('#venta_id').val();
        $.ajax({
            url: controlador,
            type: 'POST',
            async: false,
            data: {
                contrato:contrato,
                venta_id:venta_id,
            },
            success: (respuesta)=>{
                let c = JSON.parse(respuesta);
                $('#contrato').empty();
                $('#contrato').html(c['modcontrato_contrato']);
            },
            error:()=>{
                alert("Error: No se pudo cambiar el contrato, intente nuevamente.")
            }
        });
    }

    function agregar_segundo(){
        let contrato = `${$('#contrato').html()}`;
        let segundoComprador_nombre = $('#segundoComprador_nombre').val();
        let segundoComprador_ci = $('#segundoComprador_ci').val();
        let colindancia_norte = $('#colindancia_norte').val()
        let colindancia_sur = $('#colindancia_sur').val()
        let colindancia_este = $('#colindancia_este').val()
        let colindancia_oeste = $('#colindancia_oeste').val()
        let comandos = [
            `#cliente2_nombre#`,
            `#cliente2_ci#`,
            `#colindancia_norte#`,
            `#colindancia_sur#`,
            `#colindancia_este#`,
            `#colindancia_oeste#`
        ];
        let datos = [
            segundoComprador_nombre,
            segundoComprador_ci,
            colindancia_norte,
            colindancia_sur,
            colindancia_este,
            colindancia_oeste
        ];
        
        for(let i = 0; i < comandos.length; i++)
            contrato = contrato.replace(new RegExp(comandos[i],"g") ,datos[i]);
        $('#contrato').empty();
        $('#contrato').html(`${contrato}`);
        
    }
</script>