<script src="<?php echo base_url('resources/js/funcionessin.js'); ?>"></script>
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

<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php //echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">-->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

<div class="box-header" style="padding-left: 0px">
    <font size='4' face='Arial'><b>Puntos de Venta</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <span id="encontrados">0</span></font>
    <div class="box-tools no-print" style="display: none" id="pventa_cero">
        <a class="btn btn-success btn-sm" onclick="modal_puntoventa()" title="Registrar punto de venta 0"><fa class='fa fa-pencil-square-o'></fa> Registrar Punto de Venta</a> 
    </div>
</div>

<div class="box-header">
    <!--<h3 class="box-title">Dosificación</h3>-->
    <!--<button class="btn btn-info btn-xs" onclick="verificarComunicacion()"><fa class="fa fa-chain"></fa> Verificar Conexión</button>-->
    <!--<a class="btn btn-danger btn-xs" onclick="registroFirmaRevocada()"><fa class="fa fa-chain-broken"></fa> Firma Rebocada</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="cierre_OperacionesSistema()"><fa class="fa fa-briefcase"></fa> Cierre de Operaciones</a>-->
    <a class="btn btn-warning btn-xs" onclick="mostrar_modalregistrarpuntoventa()"><fa class="fa fa-cart-arrow-down"></fa> Registrar Punto de Venta</a>
    <a class="btn btn-warning btn-xs" onclick="consulta_PuntoVenta()"><fa class="fa fa-cart-arrow-down"></fa> Consulta Puntos de Venta</a>
    <a class="btn btn-warning btn-xs" onclick="cierre_PuntoVenta()"><fa class="fa fa-cart-arrow-down"></fa> Cierre Punto de Venta</a>
    <!--<a class="btn btn-warning btn-xs" onclick="consulta_EventoSignificativo()"><fa class="fa fa-cart-arrow-down"></fa> Consulta Evento Significativo</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="registro_EventoSignificativo()"><fa class="fa fa-cart-arrow-down"></fa> Registro de Evento Significativo</a>-->
    <a class="btn btn-warning btn-xs" onclick="mostrar_modalregistrarpuntoventacomisionista()"><fa class="fa fa-cart-arrow-down"></fa> Registrar Punto de Venta Comisionista</a>
    
</div>
<div class="row no-print">    
    <div class="row col-md-12" id='loader_revocado' style='display:none; text-align: center'>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
    </div>
</div>
<div class="modal fade" id="modalregistrarpventa" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="text-align: center !important">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <span style="font-size: 16px"><b> REGISTRAR NUEVO PUNTO DE VENTA</b></span>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <span class="text-danger" id="mensaje"></span>
                    <label for="codigoTipoPuntoVenta" class="control-label">Tipo Punto de Venta</label>
                    <div class="form-group">
                        <select name="codigoTipoPuntoVenta" class="form-control" id="codigoTipoPuntoVenta">
                            <?php 
                            foreach($all_tipopuntoventa as $tipopuntoventa){ ?>
                                <option value="<?php echo $tipopuntoventa['tipopuntoventa_codigo']; ?>"> <?php echo $tipopuntoventa['tipopuntoventa_descripcion']; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="nombrePuntoVenta" class="control-label">Nombre de Punto de Venta</label>
                    <div class="form-group">
                        <input type="text" name="nombrePuntoVenta" class="form-control" id="nombrePuntoVenta" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="descripcion" class="control-label">Descripción</label>
                    <div class="form-group">
                         <input type="text" name="descripcion" class="form-control" id="descripcion" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center !important">
                <!--<div class="col-md-4 text-center">-->
                    <button class="btn btn-success" onclick="registroPuntoVenta()"><fa class="fa fa-check"></fa> Registrar</button>
                <!--</div>-->
                <!--<div class="col-md-4 text-center">-->
                    <button class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cancelar</button>
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_puntoventa_cero" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="text-align: center !important">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <span style="font-size: 16px"><b> REGISTRAR PUNTO DE VENTA 0</b></span>
            </div>
            <div class="modal-body">
                <div class="col-md-6">
                    <span class="text-danger" id="mensaje"></span>
                    <label for="codigoTipoPuntoVenta0" class="control-label">Tipo Punto de Venta</label>
                    <div class="form-group">
                        <select name="codigoTipoPuntoVenta0" class="form-control" id="codigoTipoPuntoVenta0">
                            <option value="0"> PUNTO DE VENTA 0 </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <span class="text-danger" id="mensaje"></span>
                    <label for="cuis0" class="control-label">CUIS</label>
                    <div class="form-group">
                        <input type="text" name="cuis0" class="form-control" id="cuis0" required />
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="nombrePuntoVenta0" class="control-label">Nombre de Punto de Venta</label>
                    <div class="form-group">
                        <input type="text" name="nombrePuntoVenta0" class="form-control" id="nombrePuntoVenta0" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="descripcion0" class="control-label">Descripción</label>
                    <div class="form-group">
                         <input type="text" name="descripcion0" class="form-control" id="descripcion0" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center !important">
                <!--<div class="col-md-4 text-center">-->
                    <button class="btn btn-success" onclick="registroPuntoVenta_cero()"><fa class="fa fa-check"></fa> Registrar</button>
                <!--</div>-->
                <!--<div class="col-md-4 text-center">-->
                    <button class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cancelar</button>
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body  table-responsive">
               <table class="table table-condensed" id="mitabla" role="table">
                    <thead>
                        <tr role="row">
                            <th >#</th>
                            <th>C&oacute;digo</th>
                            <th>Tipo Punto de Venta</th>
                            <th>Nombre</th>
                            <th>Descripci&oacute;n</th>
                            <th>CUIS</th>
                            <th>Fecha Vigencia<br>CUIS</th>
                            <th>CUFD</th>
                            <th>Fecha Vigencia<br>CUFD</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tabla_puntos_venta"></tbody>
                </table>
            </div>             
        </div>
    </div>
</div>
<script>
    window.onload = function(){
        dibujar_tabla_puntos_venta();
    }
</script>

<!--<script src="<?php //echo base_url('resources/js/verificar_conexion.js'); ?>"></script>-->
<!--<style type="text/css">
    .online, .offline{
      display: inline-block;
      padding: 0.5rem;
      border-radius: 5px;
      margin: 1rem;
    }

    .online{
      border: 3px solid green;
      color: green;
    }

    .offline{
      border: 3px solid red;
      color: red;
    }
</style>-->

<!--<p id="status" class="online">online</p>-->

<?php
/*$base_url = explode('/', base_url());
$llave_privada_url = "{$_SERVER['DOCUMENT_ROOT']}/{$base_url[3]}/resources/firmaDigital/ROBERTOCARLOSSOTOSIERRA.p12";
$archivo_xml = "{$_SERVER['DOCUMENT_ROOT']}/{$base_url[3]}/resources/xml/entel.xml";
//echo $llave_privada_url;
if (!$almacén_cert = file_get_contents($llave_privada_url)) {
    echo "Error: No se puede leer el fichero del certificado\n";
    exit;
}else{
    
    if (openssl_pkcs12_read($almacén_cert, $info_cert, "5152377")) {
    //echo "Información del certificado\n";
         //print_r($info_cert);
         //echo "<br><br>";
         
         $certificado = $info_cert["cert"];
         echo $certificado;
         echo "<br><br>";
         
         $llave_privada = $info_cert["pkey"];
         echo $llave_privada;
         echo "<br><br>";
    
         $certificado_extra1 = $info_cert["extracerts"][0];
         echo $certificado_extra1;
         echo "<br><br>";
    
    
         $certificado_extra2 = $info_cert["extracerts"][1];
         echo $certificado_extra2;
         echo "<br><br>";
    
    
          //echo "LLAVE PUBLICA: ".openssl_pkey_get_public($certificado);
          
                
          $certificado  = "-----BEGIN CERTIFICATE----- MIIHNjCCBR6gAwIBAgIIIoXBsnAmisUwDQYJKoZIhvcNAQELBQAwSzEsMCoGA1UEAwwjRW50aWRh
ZCBDZXJ0aWZpY2Fkb3JhIFB1YmxpY2EgQURTSUIxDjAMBgNVBAoMBUFEU0lCMQswCQYDVQQGEwJC
TzAeFw0yMjAzMzExNDA0MDBaFw0yMzAzMjQyMDA0MDBaMIHdMQswCQYDVQQuEwJDSTEgMB4GA1UE
AwwXUk9RVUUgUk9ZIE1FTkRFWiBTT0xFVE8xEzARBgNVBAUTCjEwMjA3MDMwMjMxGDAWBgNVBAwM
D0dlcmVudGUgR2VuZXJhbDEZMBcGA1UECwwQR0VSRU5DSUEgR0VORVJBTDETMBEGA1UECgwKRU5U
RUwgUy5BLjELMAkGA1UEBhMCQk8xFDASBgcrBgEBAQEADAcyODA3MTA3MSowKAYDVQQNDCFQZXJz
b25hIEp1cmlkaWNhIEZpcm1hIEF1dG9tYXRpY2EwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEK
AoIBAQCz9tKYWMnpRajPblj3LECB6yrxvqdLlx+dhDxgloy+prqmC9aOsnE6V1xdcN8OLeac4yOc
4BqSg5scUr5nOC7oGHwmL+j4GURv51+PsyvPHdjekFnrR4Ds7Kyz+9WU0iiK+TOdR8wrs9655xZp
xjD4aqCMYaP4O4sd/pHIqzVXcPP+xPi2WqkNcyJs41HziH9sk8cB9bgqYotYD+xCyfIzLuq5VtCf
6HpJSK/21yv43eO5RBwLOrXuK/wMUHzAaiUVbPkhtduX4UavGmZaNXsOD33ISdVYgoBPYqEntw7p
NsucQr4NkgonwsV4bY19Dp27PJ5fzOMYL6TD9thvhj01AgMBAAGjggKJMIIChTB5BggrBgEFBQcB
AQRtMGswOwYIKwYBBQUHMAKGL2h0dHBzOi8vd3d3LmZpcm1hZGlnaXRhbC5iby9maXJtYWRpZ2l0
YWxfYm8ucGVtMCwGCCsGAQUFBzABhiBodHRwOi8vd3d3LmZpcm1hZGlnaXRhbC5iby9vY3NwLzAd
BgNVHQ4EFgQUWn8qdW9cINXJP6J2RdKRhGHL9kYwCQYDVR0TBAIwADAfBgNVHSMEGDAWgBTSmd3B
byUuJ6gL69zZ1pJbYlWgwjCBxAYDVR0gBIG8MIG5MFAGDmBEAAAAAQ4BAgABAAAAMD4wPAYIKwYB
BQUHAgEWMGh0dHBzOi8vd3d3LmZpcm1hZGlnaXRhbC5iby9wb2xpdGljYWp1cmlkaWNhLnBkZjBl
Bg9gRAAAAAEOAQIAAQIBAAEwUjBQBggrBgEFBQcCAjBEHkIAUABlAHIAcwBvAG4AYQAgAEoAdQBy
AGkAZABpAGMAYQAgAEYAaQByAG0AYQAgAEEAdQB0AG8AbQBhAHQAaQBjAGEwgZMGA1UdHwSBizCB
iDCBhaAyoDCGLmh0dHA6Ly93d3cuZmlybWFkaWdpdGFsLmJvL2Zpcm1hZGlnaXRhbF9iby5jcmyi
T6RNMEsxLDAqBgNVBAMMI0VudGlkYWQgQ2VydGlmaWNhZG9yYSBQdWJsaWNhIEFEU0lCMQ4wDAYD
VQQKDAVBRFNJQjELMAkGA1UEBhMCQk8wCwYDVR0PBAQDAgTwMCcGA1UdJQQgMB4GCCsGAQUFBwMC
BggrBgEFBQcDAwYIKwYBBQUHAwQwKgYDVR0RBCMwIYEfZmFjdHVyYWNpb25lbGVjdHJvbmljYUBl
bnRlbC5ibzANBgkqhkiG9w0BAQsFAAOCAgEAUC27KSjUJ3T0zucgAmIuhvwDKFjvMGBeUnY5Rs9F
NDAiSlbvvAUBDOwt95WIWH8pAExFAi6Pgc2jXZ+Fop9Iqvj5/87pKBGjAuy7LyAR7YbKHRqB/HWT
icjgqEQQd86Hc65OpTip8k7MZOHiVc9unUTTg0E+RyZrlFoARwW602d7/HIY7qcx9ZR72e6PiGDY
GX5gHAjjWp4TVHkvTaa4YakCO3FJDl1XkIZF3p4iWrEDj2TwKb0A3LmL1qZhy+K0PmUTSiyzp1q3
hmpAcuWBx+QJLoy0QKkZ+oz8g7PFNmxz8Khw4dxwKZHyVVIS5f/BdqHLQirbRRQaAnoU3mNu6+UV
8uCqs/rtuab2DS5qlLJms9sPsUFKIau+56ZLXQxGKe7s1mEKeojxduRNzNT8fGXQBvSchhI7nfZ1
mvvkLu0/wPx73fB9+Gsff6Iq/6KoR2xiy7Nij7RPQAxaaKZsPcv/DljUZhHFLPIrBTMfmxWoFomc
xcKhPTlFc7AAn+qNR4KEG/tK69Nb5rdKywXKsnDz6ZZD7i+qJDNmg9JQTRxfakCIbMOE76E7QGLb
4ZiNBOadNp5/PTBg+ZkJ79Phx6YesyqdgtYJFM3+t878yoXoUW0Q2GUndqQEdAyFVtvy2IU00WfJ
hO4gZeRBxhndPqWi/G1Jmu26t2XPbvQrWvo= -----END PRIVATE KEY-----";
          $pub_key = openssl_pkey_get_public($certificado);
          $keyData = openssl_pkey_get_details($pub_key);
//          file_put_contents('./key.pub', $keyData['key']);
            echo "llave publica entel: ".$keyData['key'];
            
            
            
            //Firmado_digital($archivo_xml,$pub_key,$pub_key);
       
    } else {
        echo "Error: No se puede leer el almacén de certificados.\n";
        exit;
    }
    
    
  
echo "<br><br>";
echo "<br>For my current project I have to send a signature from PHP to Java application. I am using Crypt/RSA right now for signing my data.";
echo "<br><br>";
$data = "For my current project I have to send a signature from PHP to Java application. I am using Crypt/RSA right now for signing my data.";

$private_key = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIIBOgIBAAJBANDiE2+Xi/WnO+s120NiiJhNyIButVu6zxqlVzz0wy2j4kQVUC4Z
RZD80IY+4wIiX2YxKBZKGnd2TtPkcJ/ljkUCAwEAAQJAL151ZeMKHEU2c1qdRKS9
sTxCcc2pVwoAGVzRccNX16tfmCf8FjxuM3WmLdsPxYoHrwb1LFNxiNk1MXrxjH3R
6QIhAPB7edmcjH4bhMaJBztcbNE1VRCEi/bisAwiPPMq9/2nAiEA3lyc5+f6DEIJ
h1y6BWkdVULDSM+jpi1XiV/DevxuijMCIQCAEPGqHsF+4v7Jj+3HAgh9PU6otj2n
Y79nJtCYmvhoHwIgNDePaS4inApN7omp7WdXyhPZhBmulnGDYvEoGJN66d0CIHra
I2SvDkQ5CmrzkW5qPaE2oO7BSqAhRZxiYpZFb5CI
-----END RSA PRIVATE KEY-----
EOD;

$binary_signature = "";

$algo = "SHA256";
openssl_sign($data, $binary_signature, $private_key, $algo);

print(($binary_signature) ."\n");
echo "<br><br>";
print(base64_encode($binary_signature) ."\n");



}*/

//function Firmado_digital($src_file, $llave_privada, $llave_publica)
//{        
//    $doc = new DOMDocument();
//    $doc->formatOutput = TRUE;
//    $doc->load($src_file);        
//    $doc->C14N();
//    $objDSig = new XMLSecurityDSig();
//    $objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
//    $objDSig->addReference($doc, XMLSecurityDSig::SHA1, array('http://www.w3.org/2000/09/xmldsig#enveloped-signature'));
//    /* necesitamos una clave privada para completar el proceso. ahora usaremos cualquiera. luego reemplazarlo con el de la tarjeta */
//    $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type' => 'private'));
//    /* si la clave tiene frase de contraseña, configúrela usando $objKey->passphrase = <passphrase> " */
//    $objKey->loadKey($llave_privada, TRUE);
//    $objDSig->sign($objKey);
//    /*Agregar clave pública asociada */
//    $objDSig->add509Cert(file_get_contents($llave_publica));        
//    $objDSig->appendSignature($doc->documentElement);
//    $doc->save($src_file);
//}


/**
 * generateXMLSignFields XML genera campos de firma
 * Use sha256withrsa algorithm to generate XML internal signature
 * @param $xml
 * @return string
 * @throws \Exception
 * @author   liuml  <liumenglei0211@163.com>
 * @DateTime 2018/12/21  16:37
 */
/*function generateXMLSignFields($xml)
{
    // Cargue el XML para firmar
    $doc = new \DOMDocument();
    $doc->loadXML($xml);

    // Crear un nuevo objeto de seguridad
    $objDSig = new XMLSecurityDSig();
    // Usa la normalización exclusiva de c14n
    $objDSig->setCanonicalMethod(XMLSecurityDSig::C14N);
    // Use SHA-256 para la firma
    $objDSig->addReference(
        $doc,
        XMLSecurityDSig::SHA1,
        array('http://www.w3.org/2000/09/xmldsig#enveloped-signature')
    );

    // Crear una nueva clave de seguridad (privada)
    $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array('type' => 'private'));

    // Si la clave tiene una contraseña, úsela para establecer
    // $objKey->passphrase = '<passphrase>';

    // Cargue la clave privada
    $objKey->loadKey("-----BEGIN RSA PRIVATE KEY-----\n" . $this->privateKey . "\n-----END RSA PRIVATE KEY-----\n");

    // Firma el archivo XML
    $objDSig->sign($objKey);

    // Agrega la clave pública asociada a la firma
    $objDSig->add509Cert("-----BEGIN PUBLIC KEY-----\n" . $this->publicKey . "\n-----END PUBLIC KEY-----\n");

    // Añadir la firma a XML
    $objDSig->appendSignature($doc->documentElement);

    return $doc->saveXML();
}*/

/**
   * checkResponseSign firma de verificación
 * Validate signatures in XML
 * @param $xml
 * @return bool
 * @throws \Exception
 * @author   liuml  <liumenglei0211@163.com>
 * @DateTime 2018/12/21  17:51
 */
/*function checkResponseSign($xml)
{
    $doc = new \DOMDocument();
    $doc->loadXML($xml);
    $objXMLSecDSig = new XMLSecurityDSig();

    $objDSig = $objXMLSecDSig->locateSignature($doc);
    if (!$objDSig) {
        throw new \Exception("Cannot locate Signature Node");
    }
    $objXMLSecDSig->canonicalizeSignedInfo();
    $objXMLSecDSig->idKeys = array('wsu:Id');
    $objXMLSecDSig->idNS   = array('wsu' => 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd');

    $retVal = $objXMLSecDSig->validateReference();
    if (!$retVal) {
        throw new \Exception("Reference Validation Failed");
    }

    $objKey = $objXMLSecDSig->locateKey();
    if (!$objKey) {
        throw new \Exception("We have no idea about the key");
    }

    $key = NULL;

    $objKeyInfo = XMLSecEnc::staticLocateKeyInfo($objKey, $objDSig);

    if (!$objKeyInfo->key && empty($key)) {
        $objKey->loadKey("-----BEGIN PUBLIC KEY-----\n" . $this->myBankPublicKey . "\n-----END PUBLIC KEY-----\n");
    }

    if ($objXMLSecDSig->verify($objKey) === 1) {
        return true;
    } else {
        return false;
    }
}    
*/

?>