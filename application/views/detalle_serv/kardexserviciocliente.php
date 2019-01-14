<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<style type="text/css">
/*    #tamtex{ font-size: 0.1em; }*/
    #recepcion{ background-color: #FFFF33; font-size: small; }
    #entrega{ background-color: #00FF33; font-size: small; }
    #terminado{ background-color: #5C6BC0; font-size: small; }
    #entregado{ background-color: #31b0d5; font-size: small; }
    #alinear{ text-align: right; }
    #numeracion{ text-align: right; }
    #horizontal{ white-space: nowrap; }
    #masgrande{ font-size: 20px; }
    #estilo_div{
  background:#F0F5F0;
  border:solid 10px #F0F5F0;
  border-radius:15px; 
  /*box-shadow: 8px 8px 10px 0px #818181;*/
/*  height:100px;
  width:250px;*/
}
</style>
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
<!-------------------------------------------------------->
<div class="box-header">
    <h3 class="box-title"><b>Kardex de servicios de: <?php echo $cliente; ?></b></h3><br>
</div>

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre, codigo..">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>N°</th>
						<th>Cliente</th>
						<th>Servicio</th>
						<th>Estado</th>
						<th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php
                         $i = 1;
                         foreach($all_cliente as $cliente){
                    ?>
                    <tr>
                        <td><?php echo $i ?>
                        </td>
                        <td id="horizontal"><?php 
                             echo '<b>Cliente: '.$cliente['cliente_nombre']."</b><br>";
                             echo '<font size="1"><b>Codigo: </b>'.$cliente['cliente_codigo']."<br>";
                             echo '<b>C.I.: </b>'.$cliente['cliente_ci']."<br>";
                             echo '<b>Nit: </b>'.$cliente['cliente_nit']."<br>";
                             echo '<b>Teléf.: </b>'.$cliente['cliente_telefono'].'</font>';
                             
                            ?>
                        </td>
                        <td><?php
                            echo '<b>Código: </b>'.$cliente['servicio_id'].'<br>';
                            echo '<font size="1"><b>Fecha Rec.: </b>'.$cliente['servicio_fecharecepcion'].'<br>';
                            echo '<b>Fecha Salida: </b>'.$cliente['servicio_horarecepcion'].'</font>';
                            
                        
                        ?></td>
                        <td style="background-color: #<?php echo $cliente['estado_color']; ?>"><?php echo $cliente['estado_descripcion'] ?></td>
                        <td>
                            <a class="btn btn-info btn-xs" href="<?php echo site_url('servicio/verservdet/'.$cliente['servicio_id']);?>" title="ver detalle servicio" ><span class="fa fa-eye"></span><br></a>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </table>
                                
            </div>
            <div style="float: right">
                <center>

                    <a href="<?php echo site_url('admin/dashb/logout'); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important; " ><span class="fa fa-sign-out fa-4x"></span><br>Salir</a>
                </center>
            </div>
            <div class="pull-right">
                <?php echo $this->pagination->create_links(); ?>                    
            </div>
            
        </div>
    </div>
</div>


     