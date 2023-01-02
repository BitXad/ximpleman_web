<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<!-- Add jQuery library -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jquery-1.10.2.min.js'); ?>"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jquery.mousewheel.pack.js?v=3.1.3'); ?>"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jquery.fancybox.pack.js?v=2.1.5'); ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/jquery.fancybox.css?v=2.1.5'); ?>" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/jquery.fancybox-buttons.css?v=1.0.5'); ?>" />
	<script type="text/javascript" src="<?php echo base_url('resources/js/jquery.fancybox-buttons.js?v=1.0.5'); ?>"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/jquery.fancybox-thumbs.css?v=1.0.7'); ?>" />
	<script type="text/javascript" src="<?php echo base_url('resources/js/jquery.fancybox-thumbs.js?v=1.0.7'); ?>"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jquery.fancybox-media.js?v=1.0.6'); ?>"></script>








<div class="box-header">
    <h3 class="box-title">Galeria de imagenes de <b><?php echo $producto_nombre; ?></b></h3>
    
    
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'Primer Imagen'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
    <style type="text/css">
        img{
            height: 50px;
            width: 50px
        }
        
		/*.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}*/

                /*
		.box-body {
			max-width: 700px;
			margin: 0 auto;
		}*/
	</style>
    
</div>
<div class="row">
    <div class="col-md-12">

        <div class="box">
            
            <div class="box-body table-responsive">
                <p>
                    <?php
                        $colum = 5;
                        $cont = 1;
                        //$cont = 1;
                        /*$anchoimg = "width='70'";
                        $altoimg = "heigth='60'"; */
                        foreach($all_imagen_producto as $imagen)
                        {
                            if(($cont % $colum) == 0){
                               // echo "<div id ='otrafila'>";
                            }
                            $mimagen = "thumb_".$imagen['imagenprod_archivo'];
                    
                            //echo "<div id='colum5'>";
                            echo "<a class='fancybox' href='".site_url('/resources/images/productos/'.$imagen['imagenprod_archivo'])."' data-fancybox-group='gallery' title='".$imagen['imagenprod_titulo']."'>";
                            echo "<img src='".site_url('/resources/images/productos/'.$mimagen)."' alt='' /></a>";
                            //echo "</div>";
                            if(($cont % $colum) == 0){
                                echo "<br>";
                            }
                        ?>
                        <?php $cont++; } ?>
                </p>

            </div>
            <div class="pull-right">
                
            </div>
        </div>
    </div>
    <div style="float: right">
    <center>
        <a href="<?php echo site_url('imagen_producto/catalogoprod/'.$producto_id); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important; " ><span class="fa fa-sign-out fa-4x"></span><br>Salir</a>
    </center>
</div>
</div>
