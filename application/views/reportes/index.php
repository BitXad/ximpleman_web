<script src="<?php echo base_url('resources/js/reporte_ingegr.js'); ?>" type="text/javascript"></script>
<link href="<?php echo base_url('resources/css/mitabladetalleimpresion.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<script type="text/javascript">
    function imprimirdetalle(){
        var f = new Date();
        
        var estafecha = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+" "+
                        f.getHours()+":"+f.getMinutes()+":"+f.getSeconds();
        $('#fechaimpresion').html(estafecha);
        window.print();
    }
</script>
<div class="box-header no-print">
    <h3 class="box-title"><b>Reporte de Ingresos y Egresos</b></h3><br><br>
    <div class="container">  
        <div class="box-tools">
            
                <div class=" col-md-11"> <!-- panel panel-primary -->
                    <!--<div class="panel panel-primary col-md-8" id='buscador_oculto' > style='display:none; padding-top: 10px;'> -->
                          
                        <div class="col-md-2">
                            Desde: <input type="date" class="btn btn-primary btn-sm form-control" id="fecha_desde" name="fecha_desde" required="true">
                        </div>
                        <div class="col-md-2">
                            Hasta: <input type="date" class="btn btn-primary btn-sm form-control" id="fecha_hasta" name="fecha_hasta" required="true">
                        </div>

                        
                        <div class="col-md-2">
                            <br>
                            <button class="btn btn-sm btn-primary btn-sm btn-block"  type="submit" onclick="buscar_por_fecha()" style="height: 34px;">
                                <span class="fa fa-search"></span>Buscar
                          </button>
                            <br>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <span class="badge btn-primary" style="height: 34px; padding-top: 5px;">Ing. Egr. encontrados: <span class="badge btn-primary"><input style="border-width: 0;" id="resingegr" type="text" value="0" readonly="true"> </span></span>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <br>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <a id="imprimirestedetalle" class="btn btn-sq-lg btn-success" onclick="imprimirdetalle()" ><span class="fa fa-print"></span>&nbsp;Imprimir</a>
                        </div>

                </div>
            
        </div>

        
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
          
     
        <!-- ********************************INICIO Cabecera******************************* -->
            <div class="box-body table-responsive" id="contenedortitulo">
                <div id="cabizquierda">
                <?php
                echo $all_empresa[0]['empresa_nombre']."<br>";
                echo $all_empresa[0]['empresa_direccion']."<br>";
                echo $all_empresa[0]['empresa_telefono'];
                ?>
                </div>
                <div id="cabcentro">
                    REPORTE DE INGRESO Y SALIDA<br>
                    <label id="fechaimpresion"></label><br>
                    <label id="tituloimpresion"></label>
                </div>
                <div id="cabderecha">
                    <?php
                    $mimagen = "thumb_".$all_empresa[0]['empresa_imagen'];
                    echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';
                    ?>
                </div>
                
            </div>
            <div class="box-body table-responsive" id="cabizquierdafechas">
                    <label id="fecha1impresion"></label>
                    <label id="fecha2impresion"></label>
            </div>
            <!-- <div class="box-body table-responsive" id="resbusquedadetalleserv">

            </div> -->
            <!-- ********************************FIN Cabecera******************************* -->
            <div class="box-body table-responsive" id="resbusquedadetalleserv">
                <table class="table table-striped table-condensed" id="mitabladetimpresion">
                    <tr>
                        <th>N°</th>
                        <th>Fecha</th>
                        <th>Detalle</th>
                        <th>Ingreso</th>
                        <th>Egreso</th>
                        <th>Utilidad</th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    <?php $cont = 0;
                          $totalingreso = 0;
                          $totalegreso = 0;
                          $totalutilidad = 0;
                    
                          foreach($ingresos as $i){;
                             $cont = $cont+1;
                             $totalingreso = $totalingreso + $i['ingreso'];
                             $totalegreso = $totalegreso + $i['egreso'];
                             $totalutilidad = $totalutilidad + $i['utilidad'];
                            ?>
                    
                    <tr>
                      <td><?php echo $cont;?></td>
                        <td><?php echo $i['fecha']; ?></td>
                        <td><?php echo $i['detalle']; ?></td>
                        <td id='alinearder'><?php echo number_format($i['ingreso'],2); ?></td>
                        <td id='alinearder'><?php echo number_format($i['egreso'],2); ?></td>
                        <td id='alinearder'><?php echo number_format($i['utilidad'],2); ?></td>
                                                      
                    </tr>
                    <?php } ?>
                   
                   <tr>
                     <td colspan="2"></td>
                     <td class='esbold'>TOTAL (INGRESOS/EGRESOS/UTILIDAD)Bs.</td>
                     <td class='esbold' id='alinearder'><?php echo number_format($totalingreso,2,'.',',');?></td>
                     <td class='esbold' id='alinearder'><?php echo number_format($totalegreso,2,'.',',');?></td>
                     <td class='esbold' id='alinearder'><?php echo number_format($totalutilidad,2,'.',',');?></td>
                   </tr>
                  <!-- <tr>
                    <td colspan="2"></td>
                     <td class="subtitulo">TOTAL (VENTAS POR BANCO/TARJETAS DE CREDITO)Bs.</td>
                    <td class="subtitulo" align="right" ><?php //echo number_format('0',2);?></td>
                    <td></td>
                     <td class="subtitulo" align="right"><?php //echo number_format('0',2);?></td>
                   </tr> -->
                   <tr>
                     <td colspan="2"></td>
                     <td class='esbold' >SALDO EFECTIVO EN CAJA Bs.</td>
                     <td></td>
                     <td class='esbold' id='alinearder'><?php echo number_format($totalingreso-$totalegreso,2,'.',',');?></td>
                   </tr>
                </table>

        </div>
        <div id="parafirmas">
            <div id="firmaizquierda">
              <br>
              <br>
              ________________________<br>ENTREGADO POR
            </div>
            <div id="firmaderecha">
              <br>
              <br>
              ________________________<br>REVISADO POR
            </div>
        </div>
        <br>
            <div class="column" align="right">
              <p class="subtitulo">EFECTIVO EN CAJA Bs.:...........$US:........</p>
              <P class="subtitulo">UTILIDAD BRUTA Bs.:...........$US:........</P>
              <P class="subtitulo">GASTOS OPERAT. Bs.:...........$US:........</P>
              <Pclass="subtitulo">UTILIDAD NETA Bs.:...........$US:........</P>
            </div>

        </div>
    </div>
</div>