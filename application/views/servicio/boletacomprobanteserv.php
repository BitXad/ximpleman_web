<!----------------------------- script buscador --------------------------------------->
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>   
<style type="text/css">
@page{
    margin-top: 0mm;
    margin-left: 0mm;
    margin-right: 0mm;
}
body {
    font-family: "Arial", Arial, Arial, arial;
    font-size: 11px;
}
    #derechatabla {
    /*font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;*/
    font-family: "Arial", Arial, Arial, arial;
    font-size: 11px;
    border-collapse: collapse;
    width: 100%;
}
#izquierdatabla {
    /*font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;*/
    font-family: "Arial", Arial, Arial, arial;
    font-size: 9px;
}    

</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->

<!-------------------------------------------------------->
 <div class="col-md-12">
     <div class="col-md-4">
     </div><!----------------------------- script buscador --------------------------------------->
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
 
<div class="row">
    <div style="width: 100%;overflow-x:hidden;overflow-y:auto;">
   
<div style="float:left; width:22%;">

    <center style="font-family: 'Arial', Arial, Arial, arial; font-size: 8px;">  <font size="1"><b><u><?php echo $empresa[0]['empresa_nombre']; ?></u></b></font><br>
                        <?php echo $empresa[0]['empresa_zona']; ?><br>
                        <p style="font-size: 7px;margin: 0;"><?php echo $empresa[0]['empresa_direccion']; ?></p>
                        <?php echo $empresa[0]['empresa_telefono']; ?><br>
                        <?php echo date('d/m/Y',strtotime($servicio['servicio_fecharecepcion']))." ".$servicio['servicio_horarecepcion']; ?><br>
                        <font size="1"><b>SERVICIO TECNICO<br>No.: <?php echo $servicio['servicio_id']; ?></b></font>
                     </center>
                     
</div>
<div style="float:right; width:78%;">

    <div class="cuerpo" >
                    <div class="columna_derecha" style="text-align: right;">
                       
                        <b>TIPO SERV.: </b><?php echo $tipo_servicio['tiposerv_descripcion']; ?><br>
                    
                    </div>
                    <div class="columna_izquierda" style="padding-left: 9px;">
                       <center style="font-family: 'Arial', Arial, Arial, arial; font-size: 10px;">  <font size="1"><b><u><?php echo $empresa[0]['empresa_nombre']; ?></u></b></font><br>
                        <?php echo $empresa[0]['empresa_zona']; ?><br>
                        <?php echo $empresa[0]['empresa_direccion']; ?><br>
                        <?php echo $empresa[0]['empresa_telefono']; ?>
                    </div> </center>
                        <div class="columna_central" style="text-align: center">
                        <h4 class="box-title"><b>ORDEN DE SERVICIO TÉCNICO</b></h4>
                        <font size="2"><b>Nro.:  <?php echo "00".$servicio['servicio_id']; ?></b></font>
                        <span><br><?php echo date("d/m/Y h:i:s a"); ?></span>
                    </div>
</div></div></div>
<hr style="border-color: black; margin: 5px;">
<div style="width: 100%;overflow-x:hidden;overflow-y:auto;">
    <div style="float:left; width:22%; text-align: center">
        <font size="1"><?php echo $cliente['cliente_nombre'];?></font>
    </div>
    <div style="float:right; width:78%;">
        <div  style="padding-left: 35px;"><b>CLIENTE: </b><?php echo $cliente['cliente_nombre'];?>
            <b style="margin-left: 100px;">FECHA: </b>
                <?php echo date('d/m/Y',strtotime($servicio['servicio_fecharecepcion']))." ".$servicio['servicio_horarecepcion']; ?> 
        </div>
    </div>
</div>
 <hr style="border-color: black; margin: 5px;">
 <div style="width: 100%;overflow-x:hidden;overflow-y:auto;">
   
<div style="float:left; width:22%;">
    <table id="izquierdatabla">
            <tr>
                <td>TOTAL:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"> <?php echo $servicio['servicio_total']; ?></td>
            </tr>
            <tr>
                <td>A CUENTA:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo $servicio['servicio_acuenta']; ?></td>
            </tr>
            <tr>
                <td>SALDO:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo $servicio['servicio_saldo']; ?></td>
            </tr>
            <!--<tr>
               <td style="text-align: right;">_________________</td> 
               <td></td> 
               <td style="text-align: right;">_____</td> 
            </tr>
            <tr>
                <td>SALDO PARC:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php //echo $cuota[0]['cuota_total']-$cuota[0]['cuota_cancelado']; ?></td>
            </tr>
            <tr>
                <td>SALDO DEUDOR:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php //echo $cuota[0]['cuota_saldo']-$cuota[0]['cuota_cancelado']+$cuota[0]['cuota_interes']; ?></td>
            </tr>-->

        </table>
    <!--<br>
<center  style="text-align: right; width: 80%;">
        CANCELADO:....................<br><br>
                   SALDO:....................<br>
                   </center> -->
</div>
<div style="float:right; width:78%;">
<div style="float:left; width:70%;">
        <table id="derechatabla">
             <tr>
                <td style="text-align: right;">TOTAL:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"> <?php echo $servicio['servicio_total']; ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">A CUENTA:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo $servicio['servicio_acuenta']; ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">SALDO:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo $servicio['servicio_saldo']; ?></td>
            </tr>
         <!--   <tr>
                <td style="text-align: right;">MONTO CANCELADO:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php //echo $cuota[0]['cuota_cancelado']; ?></td><td style="width: 40px;"></td>
                <td style="text-align: right;">CANCELADO:....................</td>
            </tr>
            <tr>
               <td style="text-align: right;">_________________</td> 
               <td></td> 
               <td style="text-align: right;">_____</td> 
            </tr>
            <tr>
                <td style="text-align: right;">SALDO PARC:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php //echo $cuota[0]['cuota_total']-$cuota[0]['cuota_cancelado']; ?></td><td></td>
                <td style="text-align: right;">SALDO:........................</td>
            </tr>
            <tr>
                <td style="text-align: right;">SALDO DEUDOR:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php //echo $cuota[0]['cuota_saldo']-$cuota[0]['cuota_cancelado']+$cuota[0]['cuota_interes']; ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">GLOSA:</td><td style="width: 10px;"></td>
                <td style="text-align: right;"><?php //echo $cuota[0]['cuota_glosa']; ?></td>
            </tr>-->
                           
        </table>
        </div>
       <!-- <div style="float:right; width:30%;">
            <center> <u>ESTRACTO DE PAGOS</u>
        <table id="izquierdatabla">
            <?php /* $i=1; foreach($credito as $c){ ?>
             <tr>
                 <td style="text-align: center;"><?php if ($c['cuota_fecha']=='0000-00-00') { echo ("");
                         
                        } else{ echo $fecha_format = date('d/m/Y', strtotime($c['cuota_fecha'])); } ?> </td>
                         <td style="width: 22px; text-align: center;"><?php if ($c['cuota_fecha']=='0000-00-00') { echo (""); }else{ echo "Bs."; }  ?></td>
                <td style="text-align: right;"><b><?php if ($c['cuota_fecha']=='0000-00-00') { echo ("");
                         
                        } else{ echo number_format($c['cuota_cancelado'], 2, ".", ","); }?></b></td>
                <?php  } $i++; */ ?>
            </tr>
        </table></center>
        </div> -->
</div>
    </div>
      <hr style="border-color: black; margin: 1px;">             
<div style="text-align: left;">
                  <p style="font-family: 'Arial', Arial, Arial, arial; font-size: 8px;"><?php echo date("d/m/Y   H:i:s"); ?></p><br>
                  
</div>
<div style="width: 100%;overflow-x:hidden;overflow-y:auto;">
   
<div style="float:left; width:22%;">
    <center>ENTREGUE CONFORME</center>
    </div>
    <div style="float:right; width:38%;">
        <center>ENTREGUE CONFORME</center>
    </div>
    <div style="float:right; width:38%;">
        <center>RESPONSABLE</center>
    </div>
</div>
</div>


    
      
  
    
