<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones.js'); ?>"></script>


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


p {
    font-family: Arial;
    font-size: 7pt;
    line-height: 120%;   /*esta es la propiedad para el interlineado*/
    color: #000;
    padding: 10px;
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
font-family: Arial narrow;
font-size: 7pt;  

td {
border:hidden;
}
}

td#comentario {
vertical-align : bottom;
border-spacing : 0;
}
div#content {
background : #ddd;
font-size : 7px;
margin : 0 0 0 0;
padding : 0 5px 0 5px;
border-left : 1px solid #aaa;
border-right : 1px solid #aaa;
border-bottom : 1px solid #aaa;
}
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<!---------------------- Modal ---------------------------->

        <div id="myModalAnular" class="modal fade no-print" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Anular Factura</h4>
              </div>
              <div class="modal-body">
                  <p>
                  <h3>              
                    ADVERTENCIA: La factura Nº: <?php //echo $dosificacion[0]['dosificacion_numfact']."lklk"; ?>, esta a punto de ser ANULADA. ¿Desea continuar?
                  </h3>
                  </p>
              </div>
              <div class="modal-footer">
                  <!--<a href="<?php //echo base_url('factura/anular_factura/'.$factura[0]['factura_id'].'/'.$factura[0]['factura_id']); ?>" type="button" class="btn btn-warning" ><i class="fa fa-times-rectangle"></i> Anular</a>-->
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
              </div>
            </div>

          </div>
        </div>
<!-------------------------------------------------------->





<table class="table" style="width: 18cm; padding: 0;" >
                <tr>
                    
                    <td style="width: 6cm;  padding: 0;" colspan="3">

                        <center>

                                <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                                <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                                <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                                <?php if (sizeof($empresa[0]['empresa_propietario'])>2){ ?>
                                <font size="1" face="Arial"></b>
                                
                                    <?php  echo "<b> DE: ".$empresa[0]['empresa_propietario'] ; ?>
                                    
                                    </b></font><br>
                                <?php } ?>
                                
                                <font size="1" face="Arial"><?php echo $dosificacion['dosificacion_sucursal'];?><br>
                                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>                

                        </center>                      
                    </td>
                    <td style="width: 6cm;  padding: 0;">
                        <center>            
                            <br>
                            <br>
                            <br>
                            
                            <font size="3" face="arial"><b><?php echo "FACTURA"; ?></b></font> <br>
                            <font size="1" face="arial"><b><?php echo "ORIGINAL"; ?></b></font> <br>                    
                        </center>
                    </td>
                    
                    <td style="width: 6cm;  padding: 0;">
                            <table style="width: 6cm;">
                                <tr>
                                    <td style="font-family: arial; font-size: 7pt;">

                                        <b>NIT:      </b><br>
                                        <b>FACTURA No.:  </b><br>
                                        <b>AUTORIZACION: </b>

                                    </td>
                                    <td style="font-family: arial; font-size: 7pt;">
                                        <?php echo $dosificacion['dosificacion_nitemisor']; ?> <br>
                                        <?php echo $dosificacion['dosificacion_numfact']+1; ?> <br>
                                        <?php echo $dosificacion['dosificacion_autorizacion'] ?>           
                                    </td>
                                </tr>
                            </table>            

                            <center>
                            _________________________________________________
                                <font size="1px" face="arial"><?php echo $dosificacion['dosificacion_actividad']?></font>
                            _________________________________________________
                            </center>

                    </td>
                </tr>
                <tr style="padding: 0;">
                    <td></td>
                    <td colspan="5" style="font-family: arial; font-size: 8pt; padding: 0; text-align: left">
                        <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ";?><input type="date" value="<?php echo date("Y-m-d"); ?>" id="factura_fecha">  <br>
                        <br><b>NIT/CI: </b> <input type="text" value="0" id="fatura_nit" style="">
                        <b>SEÑOR(ES): </b><input type="text" value="SIN NOMBRE" id="factura_razon">
                    </td>
                </tr>

            </table>


<div class="modal-content table-responsive" style="width: 20cm; padding: 0;" >
    
<table class="table table-responsive" style="width: 18cm; padding: 0;" id="mitabla">
    <tr>
        <th style="width: 1cm; padding: 0;">CANT</th>
        <th style="width: 9cm; padding: 0;">DETALLE</th>
        <th style="width: 2cm; padding: 0;">UNIDAD</th>
        <th style="width: 2cm; padding: 0;">PREC. UNIT</th>
        <th style="width: 2cm; padding: 0;">SUB. TOTAL</th>
    </tr>
    
    <?php foreach($detalle_factura as $d){ ?>    
    <tr>
        
        <td><input type="text" style="width: 1cm; padding: 0;" id="cantidad<?php echo $nada; ?>"></td>
        <td><input type="text" style="width: 9cm; padding: 0;"></td>
        <td><input type="text" style="width: 2cm; padding: 0;"></td>
        <td><input type="text" style="width: 2cm; padding: 0;"></td>
        <td><input type="text" style="width: 2cm; padding: 0;"></td>
        <td><button class="btn btn-success btn-xs"><fa class="fa fa-floppy-o"></fa></button></td>
        
    </tr>
    <?php } ?>
    <tr>
        
        <th colspan="4">LITERAL: Tres mil Seicientos 100/100 Bolivianos</th>
        <th style="width: 3cm; padding: 0;"><font size="2"><b> 3,600.00</b></font></th>
    </tr>
</table>   
</div>
