<style>
/* ====== TICKET 80mm ====== */
@page{
  margin: 3mm;
  /* Si tu motor soporta: size: 80mm auto; */
}

*{
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

.ticket{
  width: 80mm;
  margin: 0;
  font-size: 10px;
  line-height: 1.2;
}

.center{ text-align:center; }
.right{ text-align:right; }

.sep{
  border-top: 1px dashed #000;
  margin: 6px 0;
}

.sep-solid{
  border-top: 1px solid #000;
  margin: 6px 0;
}

.row{
  display:flex;
  justify-content: space-between;
  gap: 6px;
}

.label{ font-weight: bold; }
.big{
  font-size: 14px;
  font-weight: bold;
}

.box{
  border: 1px solid #000;
  padding: 6px;
  margin-top: 6px;
}

.firma{
  margin-top: 10px;
}

.firma .line{
  border-top: 1px solid #000;
  margin: 18px 0 4px 0;
}

@media print{
  *{
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
  }
}
</style>

<div class="ticket">

  <!-- ENCABEZADO -->
  <div class="center">
    <img src="<?php echo base_url('resources/images/empresas/').$empresa['logo_emp']; ?>" width="100px" height="80px"><br>
    <div style="font-size:12px; font-weight:bold;"><?php echo $empresa['nombre_emp']; ?></div>
    <div><?php echo $empresa['direccion_emp']; ?></div>
    <div><?php echo $empresa['telefono_emp']; ?></div>
  </div>

  <div class="sep-solid"></div>

  <div class="center">
    <div class="big">RECIBO DE INGRESO</div>
    <div class="big"><b>Nº: 00<?php echo $ingresos[0]['id_ing']; ?></b></div>
    <div><?php echo date("d/m/Y H:i:s"); ?></div>
  </div>

  <div class="sep"></div>

  <!-- DATOS -->
  <div>
    <b>FECHA:</b>
    <?php echo date('d/m/Y H:i:s',strtotime($ingresos[0]['fechahora_ing']));?>
  </div>

  <div style="margin-top:4px;">
    <b>RECIBI DE: </b><br>
    <?php
      if ($ingresos[0]['id_asoc']>1) {
        echo $ingresos[0]['nombres_asoc'].' '.$ingresos[0]['apellidos_asoc']." (".$ingresos[0]['codigo_asoc'].")";
      } else {
        echo $ingresos[0]['nombre_ing'];
      }
    ?>
  </div>

  <div class="sep"></div>

  <!-- MONTO -->
  <div class="box">
    <div class="row">
      <b>LA SUMA DE:</b>
      <div class="right"><b><?php echo number_format($ingresos[0]['monto_ing'],'2','.',',');?> Bs.</b>
        <br><?php echo num_to_letras($ingresos[0]['monto_ing']);?>
      </div>
    </div>
  </div>

  <!-- CONCEPTO -->
  <div class="box">
    <b>POR CONCEPTO DE:</b>
    <div>
      <?php echo $ingresos[0]['detalle_ing'];?> (<?php echo $ingresos[0]['descripcion_ing'];?>)
    </div>
  </div>

  <!-- SON -->
  <!--div class="box">
    <div class="label">SON:</div>
    <div><?php echo num_to_letras($ingresos[0]['monto_ing']);?></div>
  </div-->

  <!-- CAJERO -->
  <div class="box">
    <b>CAJERO(A):</b>
    <div><?php echo $ingresos[0]['nombre_usu'];?></div>
  </div>

  <!--div class="sep"></div-->

  <!-- FIRMAS -->
  <div class="row firma">
    <div style="width:49%;">
      <div class="line"></div>
      <div class="center"><b>RECIBÍ CONFORME</b></div>
    </div>

    <div style="width:49%;">
      <div class="line"></div>
      <div class="center"><b>ENTREGUÉ CONFORME</b></div>
      <div class="center"><?php echo $ingresos[0]['nombre_ing']; ?></div>
      <div class="center"><?php echo "C.I. ".$ingresos[0]['ci_ing']; ?></div>
    </div>
  </div>

  <!--div class="sep"></div-->

  <!--div class="center">
    <b>Nº Trans.:</b> 00<?php echo $ingresos[0]['id_ing']; ?>
  </div-->

</div>
