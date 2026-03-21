<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<style type="text/css">
    .page-title-mobile{
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 15px;
    }
    .page-title-mobile h3{
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: #2c3e50;
    }
    .subtitulo-viajes{
        color: #7f8c8d;
        font-size: 13px;
        margin-top: 3px;
    }
    .contenedor-viajes{
        margin-top: 15px;
    }
    .buscador-viajes{
        margin-bottom: 15px;
    }
    .buscador-viajes .input-group-addon{
        background: #34495e;
        color: #fff;
        border-color: #34495e;
        font-weight: bold;
    }
    .buscador-viajes .form-control{
        height: 42px;
        border-radius: 0 6px 6px 0;
        font-size: 14px;
    }
    .resumen-viajes{
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 15px;
    }
    .mini-card{
        background: #fff;
        border-radius: 10px;
        padding: 12px 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
        min-width: 160px;
        flex: 1;
    }
    .mini-card .mini-label{
        display: block;
        font-size: 11px;
        color: #7f8c8d;
        text-transform: uppercase;
        margin-bottom: 3px;
        letter-spacing: .4px;
    }
    .mini-card .mini-value{
        font-size: 20px;
        font-weight: bold;
        color: #2c3e50;
        line-height: 1.2;
    }

    .viaje-card{
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 3px 14px rgba(0,0,0,.08);
        margin-bottom: 16px;
        overflow: hidden;
        border: 1px solid #ecf0f1;
    }
    .viaje-card-header{
        padding: 14px 16px 10px 16px;
        background: linear-gradient(135deg, #f8fafc, #eef3f8);
        border-bottom: 1px solid #edf1f5;
    }
    .viaje-top{
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 10px;
        flex-wrap: wrap;
    }
    .viaje-id{
        font-size: 18px;
        font-weight: bold;
        color: #2c3e50;
    }
    .viaje-meta{
        font-size: 12px;
        color: #7f8c8d;
        margin-top: 2px;
    }
    .labelestado{
        display: inline-block;
        padding: 7px 12px;
        border-radius: 30px;
        color: #fff;
        font-weight: bold;
        font-size: 11px;
        letter-spacing: .3px;
        text-transform: uppercase;
        box-shadow: 0 2px 6px rgba(0,0,0,.15);
    }
    .viaje-card-body{
        padding: 14px 16px;
    }
    .ruta-principal{
        font-size: 18px;
        font-weight: 700;
        color: #1f2d3d;
        margin-bottom: 4px;
        line-height: 1.3;
    }
    .ruta-secundaria{
        color: #6c7a89;
        font-size: 13px;
        margin-bottom: 12px;
    }
    .grid-detalle{
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }
    .detalle-item{
        background: #f8fafc;
        border-radius: 10px;
        padding: 10px 12px;
        border: 1px solid #edf2f7;
        min-height: 68px;
    }
    .detalle-item .titulo{
        display: block;
        font-size: 11px;
        text-transform: uppercase;
        color: #7f8c8d;
        margin-bottom: 5px;
        font-weight: 700;
        letter-spacing: .3px;
    }
    .detalle-item .valor{
        font-size: 14px;
        color: #2c3e50;
        line-height: 1.35;
        word-break: break-word;
    }
    .detalle-item .valor strong{
        font-size: 16px;
    }
    .conductores-box{
        margin-top: 12px;
        background: #fcfcfd;
        border: 1px solid #edf1f5;
        border-radius: 10px;
        padding: 10px 12px;
    }
    .conductores-box .titulo{
        display: block;
        font-size: 11px;
        text-transform: uppercase;
        color: #7f8c8d;
        margin-bottom: 6px;
        font-weight: 700;
    }
    .conductores-box .valor{
        font-size: 14px;
        color: #2c3e50;
        line-height: 1.5;
    }
    .viaje-card-footer{
        padding: 12px 16px 16px 16px;
        border-top: 1px solid #f0f3f6;
        background: #fff;
    }
    .btn-accion-viaje{
        width: 100%;
        border-radius: 10px;
        padding: 11px 12px;
        font-size: 14px;
        font-weight: bold;
        box-shadow: 0 3px 8px rgba(0,0,0,.08);
    }
    .btn-finalizado{
        width: 100%;
        border-radius: 10px;
        padding: 11px 12px;
        font-size: 14px;
        font-weight: bold;
        background: #95a5a6;
        color: #fff;
        border: none;
        cursor: not-allowed;
    }
    .alert{
        border-radius: 10px;
    }
    .empty-viajes{
        background: #fff;
        border: 1px dashed #d5dce3;
        border-radius: 14px;
        padding: 30px 20px;
        text-align: center;
        color: #7f8c8d;
        box-shadow: 0 2px 8px rgba(0,0,0,.05);
    }
    .empty-viajes i{
        font-size: 34px;
        margin-bottom: 8px;
        color: #bdc3c7;
    }
    .chip-fecha{
        display: inline-block;
        background: #eef5ff;
        color: #2c3e50;
        font-size: 11px;
        border-radius: 20px;
        padding: 4px 9px;
        margin-top: 6px;
        font-weight: 600;
    }

    @media (max-width: 767px){
        .page-title-mobile h3{
            font-size: 20px;
        }
        .grid-detalle{
            grid-template-columns: 1fr;
        }
        .viaje-id{
            font-size: 16px;
        }
        .ruta-principal{
            font-size: 16px;
        }
        .detalle-item .valor{
            font-size: 13px;
        }
        .mini-card{
            min-width: calc(50% - 6px);
            padding: 10px 12px;
        }
        .mini-card .mini-value{
            font-size: 18px;
        }
    }

    @media (max-width: 480px){
        .mini-card{
            min-width: 100%;
        }
        .buscador-viajes .form-control{
            font-size: 13px;
        }
        .btn-accion-viaje,
        .btn-finalizado{
            font-size: 13px;
            padding: 10px;
        }
    }

    @media print{
        .no-print{
            display: none !important;
        }
        .viaje-card{
            box-shadow: none !important;
            border: 1px solid #ccc !important;
            page-break-inside: avoid;
        }
    }
</style>

<div class="box-header">
    <div class="page-title-mobile">
        <div>
            <h3 class="box-title"><i class="fa fa-bus"></i> Mis Viajes Asignados</h3>
            <div class="subtitulo-viajes">Consulta tus viajes y actualiza su estado desde el celular o escritorio.</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <?php if($this->session->flashdata('mensaje')){ ?>
            <div class="alert alert-<?php echo $this->session->flashdata('tipomensaje'); ?>">
                <?php echo $this->session->flashdata('mensaje'); ?>
            </div>
        <?php } ?>

        <?php
            $total_viajes = count($viajes);
            $pendientes = 0;
            $finalizados = 0;

            foreach($viajes as $vv){
                if($vv['estado_id'] >= 55 && $vv['estado_id'] < 60){
                    $pendientes++;
                }
                if($vv['estado_id'] == 60){
                    $finalizados++;
                }
            }
        ?>

        <div class="resumen-viajes">
            <div class="mini-card">
                <span class="mini-label">Total viajes</span>
                <span class="mini-value"><?php echo $total_viajes; ?></span>
            </div>
            <div class="mini-card">
                <span class="mini-label">En gestión</span>
                <span class="mini-value"><?php echo $pendientes; ?></span>
            </div>
            <div class="mini-card">
                <span class="mini-label">Finalizados</span>
                <span class="mini-value"><?php echo $finalizados; ?></span>
            </div>
        </div>

        <div class="buscador-viajes">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i> Buscar</span>
                <input id="filtrar" type="text" class="form-control" placeholder="Ruta, placa, conductor, estado, fecha...">
            </div>
        </div>

        <div class="contenedor-viajes" id="contenedor_viajes">
            <?php if($viajes){ ?>
                <?php $cont = 0; foreach($viajes as $v){ $cont++; 

                    $siguiente_texto = "";
                    $btn_class = "btn btn-default";
                    switch($v['estado_id']){
                        case 55:
                            $siguiente_texto = "Pasar a ABORDANDO";
                            $btn_class = "btn btn-warning";
                            break;
                        case 56:
                            $siguiente_texto = "Pasar a PARTIDO";
                            $btn_class = "btn btn-primary";
                            break;
                        case 57:
                            $siguiente_texto = "Pasar a EN VIAJE";
                            $btn_class = "btn btn-info";
                            break;
                        case 58:
                            $siguiente_texto = "Pasar a LLEGADO";
                            $btn_class = "btn btn-success";
                            break;
                        case 59:
                            $siguiente_texto = "Pasar a FINALIZADO";
                            $btn_class = "btn btn-danger";
                            break;
                        default:
                            $siguiente_texto = "";
                            break;
                    }

                    $fecha_salida = ($v['viaje_fechasalida'] != null) ? date('d/m/Y', strtotime($v['viaje_fechasalida'])) : '-';
                    $hora_salida = ($v['viaje_horasalida'] != null) ? substr($v['viaje_horasalida'],0,5) : '-';
                    $fecha_llegada = ($v['viaje_fechallegada'] != null) ? date('d/m/Y', strtotime($v['viaje_fechallegada'])) : '-';
                    $hora_llegada = ($v['viaje_horallegada'] != null) ? substr($v['viaje_horallegada'],0,5) : '-';

                    $texto_busqueda = 
                        strtoupper($v['viaje_id'].' '.
                        $v['ruta_nombre'].' '.
                        $v['ruta_descripcion'].' '.
                        $v['inicio_ruta'].' '.
                        $v['fin_ruta'].' '.
                        $v['vehiculo_placa'].' '.
                        $v['vehiculo_marca'].' '.
                        $v['vehiculo_modelo'].' '.
                        $v['estado_descripcion'].' '.
                        $v['conductor_nombre'].' '.
                        $v['conductor2_nombre'].' '.
                        $fecha_salida.' '.$hora_salida.' '.$fecha_llegada.' '.$hora_llegada);
                ?>
                <div class="viaje-card item-viaje" data-search="<?php echo htmlspecialchars($texto_busqueda, ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="viaje-card-header">
                        <div class="viaje-top">
                            <div>
                                <div class="viaje-id">
                                    <i class="fa fa-ticket"></i> Viaje #<?php echo $v['viaje_id']; ?>
                                </div>
                                <div class="viaje-meta">
                                    Registro <?php echo $cont; ?>
                                </div>
                                <div class="chip-fecha">
                                    <i class="fa fa-calendar"></i> Salida: <?php echo $fecha_salida; ?> <?php echo $hora_salida; ?>
                                </div>
                            </div>
                            <div>
                                <span class="labelestado" style="background-color: <?php echo (!empty($v['estado_color']) ? $v['estado_color'] : '#777'); ?>;">
                                    <?php echo $v['estado_descripcion']; ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="viaje-card-body">
                        <div class="ruta-principal">
                            <?php echo !empty($v['ruta_nombre']) ? $v['ruta_nombre'] : 'SIN RUTA'; ?>
                        </div>

                        <div class="ruta-secundaria">
                            <?php if(!empty($v['ruta_descripcion'])){ ?>
                                <?php echo $v['ruta_descripcion']; ?><br>
                            <?php } ?>
                            <?php if(!empty($v['inicio_ruta']) || !empty($v['fin_ruta'])){ ?>
                                <i class="fa fa-map-marker"></i>
                                <strong>De:</strong> <?php echo !empty($v['inicio_ruta']) ? $v['inicio_ruta'] : '-'; ?>
                                &nbsp;&nbsp;
                                <strong>A:</strong> <?php echo !empty($v['fin_ruta']) ? $v['fin_ruta'] : '-'; ?>
                            <?php } ?>
                        </div>

                        <div class="grid-detalle">
                            <div class="detalle-item">
                                <span class="titulo"><i class="fa fa-bus"></i> Vehículo</span>
                                <div class="valor">
                                    <?php echo !empty($v['vehiculo_placa']) ? $v['vehiculo_placa'] : '-'; ?>
                                    <?php if(!empty($v['vehiculo_marca']) || !empty($v['vehiculo_modelo'])){ ?>
                                        <br><?php echo trim($v['vehiculo_marca']." ".$v['vehiculo_modelo']); ?>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="detalle-item">
                                <span class="titulo"><i class="fa fa-money"></i> Precio pasaje</span>
                                <div class="valor">
                                    <strong>Bs <?php echo number_format((float)$v['viaje_preciopasaje'], 2, '.', ','); ?></strong>
                                </div>
                            </div>

                            <div class="detalle-item">
                                <span class="titulo"><i class="fa fa-sign-out"></i> Salida</span>
                                <div class="valor">
                                    <?php echo $fecha_salida; ?><br>
                                    <?php echo $hora_salida; ?>
                                </div>
                            </div>

                            <div class="detalle-item">
                                <span class="titulo"><i class="fa fa-flag-checkered"></i> Llegada</span>
                                <div class="valor">
                                    <?php echo $fecha_llegada; ?><br>
                                    <?php echo $hora_llegada; ?>
                                </div>
                            </div>
                        </div>

                        <div class="conductores-box">
                            <span class="titulo"><i class="fa fa-user"></i> Conductores asignados</span>
                            <div class="valor">
                                <?php if(!empty($v['conductor_nombre'])){ ?>
                                    <strong>Conductor 1:</strong> <?php echo $v['conductor_nombre']; ?>
                                <?php }else{ ?>
                                    <strong>Conductor 1:</strong> -
                                <?php } ?>

                                <?php if(!empty($v['conductor2_nombre'])){ ?>
                                    <br><strong>Conductor 2:</strong> <?php echo $v['conductor2_nombre']; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="viaje-card-footer no-print">
                        <?php if($v['estado_id'] >= 55 && $v['estado_id'] < 60){ ?>
                            <a href="<?php echo site_url('viajechofer/cambiarestado/'.$v['viaje_id']); ?>"
                               class="<?php echo $btn_class; ?> btn-accion-viaje"
                               onclick="return confirm('¿Está seguro de cambiar el estado del viaje #<?php echo $v['viaje_id']; ?>?');">
                                <i class="fa fa-refresh"></i> <?php echo $siguiente_texto; ?>
                            </a>
                        <?php }elseif($v['estado_id'] == 60){ ?>
                            <button type="button" class="btn-finalizado">
                                <i class="fa fa-check"></i> VIAJE FINALIZADO
                            </button>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php }else{ ?>
                <div class="empty-viajes">
                    <i class="fa fa-bus"></i>
                    <h4 style="margin-top: 0;">No tienes viajes asignados</h4>
                    <div>No se encontraron viajes para mostrar en este momento.</div>
                </div>
            <?php } ?>

            <div class="empty-viajes" id="sin_resultados" style="display:none;">
                <i class="fa fa-search"></i>
                <h4 style="margin-top: 0;">Sin resultados</h4>
                <div>No se encontraron viajes con ese criterio de búsqueda.</div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#filtrar').on('keyup', function() {
            var valor = $(this).val().toUpperCase().trim();
            var visibles = 0;

            $('.item-viaje').each(function() {
                var texto = ($(this).attr('data-search') || '').toUpperCase();

                if (texto.indexOf(valor) !== -1) {
                    $(this).show();
                    visibles++;
                } else {
                    $(this).hide();
                }
            });

            if (visibles === 0) {
                $('#sin_resultados').show();
            } else {
                $('#sin_resultados').hide();
            }
        });
    });
</script>