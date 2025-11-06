
<?php 

        if($diasdo['dias'] <= 0){ 
?>
<div class="box-body table-responsive">
  <table class="table table-striped table-condensed" >
    <td>
<div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion-alert-circled"></i></span>

                <div class="info-box-content">
                  
                  <span class="info-box-text"><font size="4"><b>EL TOKEN DELEGADO YA ESTA VENCIDO </b></font></span>
                
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    No podra emitir facturas
                  </span>
                </div><!-- /.info-box-content -->
              </div></td>
              </table> 
            </div>

<?php } else {  ?>


<div class="box-body table-responsive">
  <table class="table table-striped table-condensed" style="font-family: Arial;">
    <td>
        <div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion-alert-circled"></i></span>

                <div class="info-box-content">
                               
                    <span class="info-box-text"><font size="4">EL TOKEN DELEGADO VENCERA EN: <font size="5"><b><?php echo $diasdo['dias']; ?></b></font> DIAS</font></span>
                
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    No podrá emitir facturas
                  </span>
                </div><!-- /.info-box-content -->
        </div> 
        
    </td>
    </table> 
</div>


<?php } ?>



<?php 

        if($cuis['dias'] <= 0){ 
?>

<div class="box-body table-responsive">
  <table class="table table-striped table-condensed" >
    <td>
<div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion-alert-circled"></i></span>

                <div class="info-box-content">
                  
                  <span class="info-box-text"><font size="4"><b>EL CUIS (CODIGO UNIDO DE INICIO DE SISTEMA) YA ESTA VENCIDO </b></font></span>
                
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    No podra emitir facturas
                  </span>
                </div><!-- /.info-box-content -->
              </div></td>
              </table> 
            </div>

<?php } else {  ?>


<div class="box-body table-responsive">
  <table class="table table-striped table-condensed" style="font-family: Arial;">
    <td>
        <div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion-alert-circled"></i></span>

                <div class="info-box-content">
                               
                    <span class="info-box-text"><font size="4">EL CUIS (CODIGO UNICO DE INICIO DE SISTEMA) VENCERA EN: <font size="5"><b><?php echo $cuis['dias']; ?></b></font> DIAS</font></span>
                
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    No podrá emitir facturas
                  </span>
                </div><!-- /.info-box-content -->
        </div> 
        
    </td>
    </table> 
</div>


<?php } ?>





<?php

        // Ruta al archivo .p12
        $archivop12 = $dosificacion["dosificacion_contenedorp12"];
        $clavep12 = $dosificacion["dosificacion_clavep12"];
        $p12File = base_url("resources/xml/certificados/{$archivop12}");

        // Contraseña del archivo .p12
        $password = $clavep12;
       
        // Leer el contenido del archivo .p12
        $p12Content = file_get_contents($p12File);
        //echo $p12Content;
        // Array para almacenar la información extraída
        $certs = [];

        // Cargar el certificado desde el .p12
        if (openssl_pkcs12_read($p12Content, $certs, $password)) {

            // Parsear la información del certificado
            $certData = openssl_x509_parse($certs['cert']);

            // Fechas de validez
            $validFrom = $certData['validFrom_time_t'];
            $validTo   = $certData['validTo_time_t'];

            // Convertir a formato legible
            $validFromStr = date('Y-m-d H:i:s', $validFrom);
            $validToStr   = date('Y-m-d H:i:s', $validTo);



            // Verificar estado del certificado
            $now = time();
            $diasRestantes = floor(($validTo - $now) / (60 * 60 * 24));
            //$diasRestantes = -2;

        //    if ($now < $validFrom) {
        //        echo "⚠️ El certificado (Firma Digital) aún no es válido.\n";
        //    } elseif ($now > $validTo) {
        //        echo "❌ El certificado (Firma Digital) ha expirado.\n";
        //    } else {
        //        echo "✅ El certificado (Firma Digital) está vigente.\n";
        //        
                // Avisar si faltan menos de 30 días
                if ($diasRestantes >=1 && $diasRestantes <=5) { ?>

                        <div class="box-body table-responsive">
                          <table class="table table-striped table-condensed" style="font-family: Arial;">
                            <td>
                                <div class="info-box bg-red">
                                        <span class="info-box-icon"><i class="ion-alert-circled"></i></span>

                                        <div class="info-box-content">

                                            <span class="info-box-text"><font size="4">LA FIRMA DIGITAL EXPIRA EN: <font size="5"><b><?php echo $diasRestantes; ?></b></font> DIAS</font></span>

                                          <span class="info-box-number"></span>
                                          <div class="progress">
                                            <div class="progress-bar" style="width: 100%"></div>
                                          </div>
                                          <span class="progress-description">
                                                <?php echo "📜 Certificado válido desde: {$validFromStr}, válido hasta: {$validToStr}\n"; ?>

                                          </span>
                                        </div><!-- /.info-box-content -->
                                </div> 

                            </td>
                            </table> 
                        </div>

        <?php            
                } else {
                    if($diasRestantes <= 0){ ?>

                        <div class="box-body table-responsive">
                          <table class="table table-striped table-condensed" style="font-family: Arial;">
                            <td>
                                <div class="info-box bg-red">
                                        <span class="info-box-icon"><i class="ion-alert-circled"></i></span>

                                        <div class="info-box-content">

                                            <span class="info-box-text"><font size="4">LA FIRMA DIGITAL HA EXPIRADO</font></span>

                                          <span class="info-box-number"></span>
                                          <div class="progress">
                                            <div class="progress-bar" style="width: 100%"></div>
                                          </div>
                                          <span class="progress-description">
                                                <?php echo "📜 Certificado válido desde: {$validFromStr}, válido hasta: {$validToStr}\n"; ?>
                                              <br>No podrá emitir facturas
                                          </span>
                                        </div><!-- /.info-box-content -->
                                </div> 

                            </td>
                            </table> 
                        </div>

        <?php
                    }else{
                        
                        if ($now > $validTo) { echo "❌ El certificado (Firma Digital) ha expirado.\n";
                        } else { echo "<h3>📜 El certificado (Firma Digital) ✅ está vigente.\n </h3>";  echo "<br>Certificado válido desde: {$validFromStr}, válido hasta: {$validToStr}\n";   }
                        
                    }

                }
        //    }

        } else {
            echo "<h3>❌ No se pudo leer el archivo .p12 o la contraseña es incorrecta, o no cuenta con firma digital.\n</h3>";
        }

?>




<center>
    
    <a href="<?php echo base_url("venta/ventas"); ?>" class="btn btn-info btn-sm" style="font-family: Arial; font-size: 12px; width: 120px;"><span class="fa fa-cart-arrow-down" aria-hidden="true" ></span> 
    <br><!-- comment -->
    Ir a Ventas
    <br><!-- comment -->
    </a>
    
    <a href="<?php echo base_url("token"); ?>" class="btn btn-facebook btn-sm" style="font-family: Arial; font-size: 12px;  width: 120px;"><span class="fa fa-codepen" aria-hidden="true" ></span> 
    <br><!-- comment -->
    Actualizar Token 
    <br><!-- comment -->
    </a>
    
    <a href="<?php echo base_url("punto_venta"); ?>" class="btn btn-warning btn-sm" style="font-family: Arial; font-size: 12px;  width: 120px;"><span class="fa fa-code" aria-hidden="true" ></span> 
    <br><!-- comment -->
    Actualizar C.U.I.S.
    <br><!-- comment -->
    </a>
    
    <a href="<?php echo base_url("dosificacion/edit/1"); ?>" class="btn btn-success btn-sm" style="font-family: Arial; font-size: 12px;  width: 120px;"><span class="fa fa-key" aria-hidden="true" ></span> 
    <br><!-- comment -->
    Registrar Firma Dig.
    <br><!-- comment -->
    </a>

</center>