<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html" charset="gb18030">
    <?php
        $session_data = $this->session->userdata('logged_in');
        $rolusuario = $session_data['rol'];
    ?>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ximpleman<?php if(isset($page_title)){ echo " - ".$page_title; }?> </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap.min.css');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo site_url('resources/css/font-awesome.min.css');?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Datetimepicker -->
    <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap-datetimepicker.min.css');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo site_url('resources/css/AdminLTE.min.css');?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo site_url('resources/css/_all-skins.min.css');?>">

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo site_url('resources/js/jquery-2.2.3.min.js');?>"></script>
    <script type="text/javascript"> 
        function mueveReloj(){
            console.log("mueveReloj");
            momentoActual = new Date();
            var today = moment(momentoActual).format('DD/MM/YYYY HH:mm:ss');
            $("#reloj").html(today);
            
        } 
        setInterval("mueveReloj()",1000);
    </script>
    <link rel="shortcut icon" href="<?php echo site_url('resources/images/icono.png');?>" />
    
</head>


<input type="hidden" name="empresa_nombre" id="empresa_nombre" value="<?php if(isset($empresa)){ echo $empresa[0]['empresa_nombre'];} else {echo ""; }?>" />
<input type="hidden" name="punto_venta" id="punto_venta" value="<?php echo $punto_venta; ?>" />
<input type="hidden" name="sistema_moduloventas" id="sistema_moduloventas" value="<?php echo $sistema["sistema_moduloventas"]; ?>" />

<body class="hold-transition skin-blue sidebar-mini sidebar-collapsed sidebar-collapse" onload="mueveReloj()">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo" id="nologo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="<?php echo site_url('resources/images/icono.png');?>"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="<?php echo site_url('resources/images/icono.png');?>"></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo site_url('resources/images/usuarios/'.$session_data['thumb']);  ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo strtolower($session_data['usuario_login'])?></span>
                        </a>
                        
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?php echo site_url('resources/images/usuarios/'.$session_data['usuario_imagen']);?>" class="img-circle" alt="User Image">
                                <p>
                                    <?php echo $session_data['usuario_nombre'].' - '.$session_data['tipousuario_descripcion']  ?>
                                    <small><?php echo $session_data['usuario_email']?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?php echo site_url()?>admin/dashb/cuenta" class="btn btn-default btn-flat">Mi Cuenta</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo site_url()?>admin/dashb/logout" class="btn btn-default btn-flat">Salir</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
<div style="float: none; width: 90%" face="Arial" class="text-center" >
    <span class="text-bold" style="display: block; padding-top: 0px;padding-bottom: -8px; color: #FFF; font-size: 22px;"><?php echo $sistema["sistema_nombre"]." ".$sistema["sistema_version"]; ?></span>
    <span name="reloj" id="reloj" style="color: #FFF; font-size: 12px;"></span> 
    
</div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo site_url('resources/images/usuarios/'.$session_data['thumb']);?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo strtolower($session_data['usuario_nombre']) ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">Menu</li>
                <li>
                    <a href="<?php echo site_url('admin/dashb/index_user');?>">
                        <i class="fa fa-dashboard"></i> <span>Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-connectdevelop"></i> <span>Operaciones</span></a>
                    <ul class="treeview-menu">
                        <?php
                        if($rolusuario[12-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('venta/ventas');?>"><i class="fa fa-cart-plus"></i> <?php echo $sistema["sistema_moduloventas"]; ?></a>
                        </li>
                        <?php } ?>
                        
                        <?php
                        if($rolusuario[179-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('venta_online');?>"><i class="fa fa-internet-explorer"></i> <?php echo $sistema["sistema_moduloventas"]; ?> Online</a>
                        </li>
                        <?php } ?>
                        
                        <?php 
                            if($rolusuario[1-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('compra');?>"><i class="fa fa-shopping-basket"></i> <?php echo $sistema["sistema_modulocompras"]; ?></a>
                        </li>
                        <?php
                        } ?>
                        
                        <?php
                        if($rolusuario[30-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('pedido');?>"><i class="fa fa-clipboard"></i> <?php echo $sistema["sistema_modulopedidos"]; ?></a>
                        </li>
                        <?php
                        }
                        if($rolusuario[69-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('servicio');?>"><i class="fa fa-wrench"></i> Servicios</a>
                        </li>      
                        <?php
                        }
                        if($rolusuario[36-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('cotizacion');?>"><i class="fa fa-file-text-o"></i> Cotizaciones</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[180-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('cliente/reporte_distribuidor');?>"><i class="fa fa-truck"></i> <span> Entregas</span></a>
                        </li>
                        <?php
                        }
                        if($rolusuario[65-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('cambio_producto');?>"><i class="fa fa-exchange"></i> <span> Cambios/Devoluciones</span></a>
                        </li>
                        <?php
                        }
                        if($rolusuario[36-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('orden_trabajo');?>"><i class="fa fa-text-height"></i> Órdenes de Trabajo</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[158-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="javascript:window.open('<?php echo site_url('detalle_venta/venta_proceso');?>','','toolbar=yes');"><i class="fa fa-television"></i> Monitor de <?php echo $sistema["sistema_moduloventas"]; ?></a>
                        </li>
                        <?php
                        }
                        
                        if($rolusuario[166-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('proceso_orden');?>"><i class="fa fa-check-square-o"></i> Terminar Proceso</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('proceso_orden/terminados');?>"><i class="fa fa-indent"></i> Recepcionar Proceso</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[174-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('detalle_venta/recepcion');?>"><i class="fa fa-cutlery"></i> Despacho</a>
                        </li>
                        <?php
                        }
                        ?>
                        
                        <?php
                        if($rolusuario[181-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('pedido_diario/index');?>"><i class="fa fa-calendar"></i> <?php echo $sistema["sistema_modulopedidos"]; ?> Diarios</a>
                        </li>
                        <?php
                        } ?>
                        
                        
                        <?php 
                        if($rolusuario[139-1]['rolusuario_asignado'] == 1){
                        ?>
                        <!--<li>
                            <a href="<?php echo site_url('admin/pedidos');?>"><i class="fa fa-list"></i> Pedidos para compras</a>
                        </li>-->
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-address-book"></i> <span>Registro</span></a>
                    <ul class="treeview-menu">
                        <?php
                        if($rolusuario[94-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('cliente');?>"><i class="fa fa-group"></i>Clientes</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[102-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('producto');?>"><i class="fa fa-cubes"></i>Productos</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[110-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('proveedor');?>"><i class="fa fa-truck"></i>Proveedores</a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-money"></i> <span>Ingresos/Egresos</span></a>
                    <ul class="treeview-menu">
                        <?php
                        
                        if($rolusuario[53-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('ingreso');?>"><i class="glyphicon glyphicon-save"></i> <span> Ingresos</span></a>
                        </li>
                        <?php
                        }
                        if($rolusuario[59-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('egreso');?>"><i class="glyphicon glyphicon-open"></i> <span> Egresos</span></a>
                        </li>
                        <?php
                        }
                        if($rolusuario[47-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('credito/indexCuenta');?>"><i class="glyphicon glyphicon-import"></i> Deudas por Cobrar</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[41-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('credito/indexDeuda');?>"><i class="glyphicon glyphicon-export"></i> Deudas por Pagar</a>
                        </li>
                        
                        <?php
                        }
                        if($rolusuario[89-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('orden_pago');?>"><i class="fa fa-ticket"></i> Órdenes de Pago</a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                <?php 
                if($rolusuario[125-1]['rolusuario_asignado'] == 1){
                ?>
                <li>
                    <a href="#"><i class="fa fa-sliders"></i> <span>Configuración</span></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo site_url('parametro');?>"><i class="fa fa-check-square"></i> <span> Parametros</span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('configuracion_email');?>"><i class="fa fa-envelope"></i> <span> Email</span></a>
                        </li>
                    </ul>
                </li>
                <?php
                }
                ?>
                
                <li>
                    <a href="#"><i class="fa fa-cogs"></i> <span>Parámetros</span></a>
                    <ul class="treeview-menu">
                        <?php
                        if($rolusuario[175-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('destino_producto');?>"><i class="fa fa-tasks"></i>Destino Producto</a>
                        </li> 
                        <?php
                        }
                        if($rolusuario[121-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('empresa');?>"><i class="fa fa-bank"></i>Empresa</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[122-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('estado');?>"><i class="fa fa-toggle-on"></i>Estados</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[124-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('moneda');?>"><i class="fa fa-money"></i>Moneda</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[123-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('forma_pago');?>"><i class="fa fa-credit-card"></i>Forma de Pago</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[133-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('tipo_transaccion');?>"><i class="fa fa-houzz"></i>Tipo de Transacción</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[132-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('tipo_cliente');?>"><i class="fa fa-group"></i>Tipo Cliente</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[159-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('tipo_respuesta');?>"><i class="fa fa-comments-o"></i>Tipo Respuesta</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[134-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('tipo_servicio');?>"><i class="fa fa-code-fork"></i>Tipo Servicio</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[126-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('procedencia');?>"><i class="fa fa-car"></i>Procedencia Servicio</a>
                        </li> 
                        <?php
                        }
                        if($rolusuario[135-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('tiempo_uso');?>"><i class="fa fa-clock-o"></i>Tiempo de Uso</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[136-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('unidad');?>"><i class="glyphicon glyphicon-baby-formula"></i>Unidades</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[176-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('usuario_destino');?>"><i class="fa fa-tag"></i>Usuario Destino</a>
                        </li> 
                        <?php
                        }
                        if($rolusuario[115-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('Categoria_clientezona');?>"><i class="fa fa-map-marker"></i>Zonas</a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-braille"></i> <span>Categorías</span></a>
                    <ul class="treeview-menu">
                         
                        <?php
                        
                        if($rolusuario[117-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('Categoria_ingreso');?>"><i class="glyphicon glyphicon-save"></i>Ingreso</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[116-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('Categoria_egreso');?>"><i class="glyphicon glyphicon-open"></i>Egreso</a>
                        </li>
                        <?php
                        }
                        
                        if($rolusuario[118-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('Categoria_producto');?>"><i class="fa fa-cube"></i>Producto</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[118-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('subcategoria_producto');?>"><i class="fa fa-cubes"></i>Sub Categoria Prod.</a>
                        </li>
                        <?php
                        }
                        
                        if($rolusuario[114-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('Categoria_cliente');?>"><i class="fa fa-stack-overflow"></i>Negocio</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[119-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('Categoria_servicio');?>"><i class="fa fa-wrench"></i>Servicio</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[127-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('subcategoria_servicio');?>"><i class="fa fa-list"></i>Sub Categoría Servicio</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[120-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('Categoria_trabajo');?>"><i class="fa fa-gavel"></i>Trabajo</a>
                        </li>
                        <?php
                        } 
                        ?>
                    </ul>
                </li>
         
                <li>
                    <a href="#"><i class="fa fa-clipboard"></i> <span>Reportes</span></a>
                    <ul class="treeview-menu">
                      
                        <?php
                        //if($rolusuario[141-1]['rolusuario_asignado'] == 1){
                        if($session_data['tipousuario_id'] == 1){
                        ?>
                        <li>
                            <!--<a href="<?php echo site_url('reportes');?>"><i class="fa fa-exchange"></i>Movimiento Diario</a>-->
                            <a href="<?php echo site_url('reportes/movimientodiario');?>"><i class="fa fa-exchange"></i>Movimiento Diario</a>
                        </li> 
                        <?php
                        }  ?>
                        
                        
                        
                        <?php
                        if($rolusuario[156-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('venta');?>"><i class="fa fa-paste"></i><?php echo $sistema["sistema_moduloventas"]; ?> del dia</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('detalle_venta/reportes');?>"><i class="fa fa-cart-plus"></i><?php echo $sistema["sistema_moduloventas"]; ?></a>
                        </li>

                        <li>
                            <a href="<?php echo site_url('detalle_venta/reporte_generalventa');?>"><i class="fa fa-cart-plus"></i>Simple <?php echo $sistema["sistema_moduloventas"]; ?></a>
                        </li>
                        <?php
                        } ?>
                        
                        
                        <?php
                        if($rolusuario[24-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('inventario');?>"><i class="fa fa-cubes"></i> Inventario Valorado</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('inventario/realizable');?>"><i class="fa fa-money"></i> Inventario Realizable</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('venta/inventario_envases');?>"><i class="fa fa-glass"></i> Inventario de Envases</a>
                        </li>
                        <?php
                        } ?>
                        
                        <?php
                        if($rolusuario[137-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('reportes/comprareportes');?>"><i class="fa fa-shopping-basket"></i><?php echo $sistema["sistema_modulocompras"]; ?></a>
                        </li>
                        <?php
                        }
                        if($rolusuario[142-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('reportes/servicioreportes');?>"><i class="fa fa-wrench"></i>Servicios</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[140-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('reportes/ingresorep');?>"><i class="fa fa-arrow-right"></i>Ingresos</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[138-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('reportes/egresorep');?>"><i class="fa fa-arrow-left"></i>Egresos</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[143-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('venta/comision');?>"><i class="fa fa-percent"></i>Comisiones</a>
                        </li>                        
                        <?php
                        } ?>
                        

                        <?php
                        if($rolusuario[144-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('venta/busquedacombi');?>"><i class="fa fa-file"></i>Reporte de Embarque</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[24-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('inventario_usuario');?>"><i class="fa fa-cubes"></i>Inventario Individual</a>
                        </li>
                        <?php
                        }
                        ?>
                        
                        <?php if($rolusuario[156-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('venta/vencimientos');?>"><i class="fa fa-calendar"></i>Vencimientos</a>
                        </li>
                        <?php
                        }
                        ?>
                        
                        <?php if($rolusuario[156-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('venta/prestamos');?>"><i class="fa fa-bitbucket"></i>Envases prestados</a>
                        </li>
                        <?php
                        }
                        ?>
                        

                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-line-chart"></i> <span>Estadísticas</span></a>
                    <ul class="treeview-menu">
                        <?php
                        
                        if($rolusuario[157-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('estadistica/ventas');?>"><i class="fa fa-cart-plus fa-bars"></i><?php echo $sistema["sistema_moduloventas"]; ?> mensuales</a>
                        </li>
                        <?php
                        }
                        ?>
                        
                        <?php
                        
                        if($rolusuario[157-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('reportes/graficas2');?>"><i class="fa fa-pie-chart"></i>Clientes frecuentes</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[157-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('reportes/graficas');?>"><i class="fa fa-bar-chart"></i><?php echo $sistema["sistema_modulocompras"]; ?> y <?php echo $sistema["sistema_moduloventas"]; ?></a>
                        </li>
                        <?php
                        }
                        ?>
                        
                    </ul>
                   
                </li>
                
                <li>
                    <a href="#"><i class="fa fa-calculator"></i> <span>Contabilidad</span></a>
                    <ul class="treeview-menu">
                        <?php
                        if($rolusuario[149-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('dosificacion');?>"><i class="fa fa-list-alt"></i>Dosificación</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[152-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('factura');?>"><i class="fa fa-shopping-cart"></i> <span>Libro de <?php echo $sistema["sistema_moduloventas"]; ?></span></a>
                        </li>
                        <?php
                        }
                        if($rolusuario[153-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('factura/factura_compra');?>"><i class="fa fa-shopping-basket"></i> <span>Libro de <?php echo $sistema["sistema_modulocompras"]; ?>
                        <?php
                        }
                        if($rolusuario[154-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('factura/verificador');?>"><i class="fa fa-paperclip"></i>Verificador de facturas</a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                   
                </li>
                <li>
                    <a href="#"><i class="fa fa-lock"></i> <span>Seguridad</span></a>
                    <ul class="treeview-menu">
                        <?php
                        if($rolusuario[145-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('rol');?>"><i class="fa fa-gg"></i>Roles</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[147-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('tipo_usuario');?>"><i class="fa fa-list-ul"></i>Tipo Usuario</a>
                        </li>
                        <?php
                        }
                        if($rolusuario[148-1]['rolusuario_asignado'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('usuario');?>"><i class="fa fa-users"></i>Usuarios</a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                <?php
                if($rolusuario[155-1]['rolusuario_asignado'] == 1){
                ?>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span>Sitio Web</span></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo site_url('articulo');?>"><i class="fa fa-gg"></i>Artículos</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('boton');?>"><i class="fa fa-square"></i>Botón</a>
                        </li>
                        <!--<li>
                            <a href="<?php //echo site_url('boton_articulo');?>"><i class="fa fa-square"></i><i class="fa fa-gg"></i>Botón Artículo</a>
                        </li>-->
                        <!--<li>
                            <a href="<?php //echo site_url('boton_slide');?>"><i class="fa fa-square"></i><i class="fa fa-image"></i>Botón Slide</a>
                        </li>-->
                        <!--<li>
                            <a href="<?php //echo site_url('categ_imagen');?>"><i class="fa fa-image"></i>Categoría Imagen</a>
                          </li>-->
                        <li>
                            <a href="<?php echo site_url('Categoria_imagen');?>"><!--<i class="fa fa-list-ul"></i>--><i class="fa fa-file-image-o"></i>Categoría Imagen</a>
                        </li>
                        <!--<li>
                            <a href="<?php //echo site_url('empresa_pagina');?>"><i class="fa fa-bank"></i><i class="fa fa-sitemap"></i>Empresa Página</a>
                        </li>-->
                        <li>
                            <a href="<?php echo site_url('estado_pagina');?>"><i class="fa fa-toggle-on"></i>Estado Página</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('galeria');?>"><i class="fa fa-film"></i>Galería</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('idioma');?>"><i class="fa fa-language"></i>Idioma</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('imagen');?>"><i class="fa fa-image"></i>Imagen</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('item');?>"><i class="fa fa-indent"></i>Item</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('mapa');?>"><i class="fa fa-map-marker"></i>Mapa</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('menu');?>"><i class="fa fa-list-alt"></i>Menú</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('menu_principal');?>"><i class="fa fa-th-list"></i>Menú Principal</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('pagina_web');?>"><i class="fa fa-globe"></i>Página Web</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('promocion');?>"><!--<i class="fa fa-percent"></i>--><i class="fa fa-minus-circle"></i>Promoción</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('seccion');?>"><i class="fa fa-paragraph"></i>Sección</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('slide');?>"><i class="fa fa-sliders"></i>Slide</a>
                        </li>
                        <!--<li>
                            <a href="<?php //echo site_url('slide_image');?>"><i class="fa fa-list"></i><i class="fa fa-image"></i>Slide Imagen</a>
                        </li>-->
                        <li>
                            <a href="<?php echo site_url('submenu');?>"><i class="fa fa-tasks"></i>Sub Menú</a>
                        </li>
                    </ul>
                </li>
                <?php
                }
                ?>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <!--<section class="content" style='padding-left: 5px; padding-right: 0px; padding-bottom: 0px; padding-top: 0px;'>-->
                <section class="content">
                    <?php                    
                    if(isset($_view) && $_view)
                        $this->load->view($_view);
                    ?>                    
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer no-print">
                <strong>Desarrollado por <a href="http://www.passwordbolivia.com/">PASSWORD SRL</a> Ingenieria Hardware & Software</strong>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">

                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                    <!-- /.tab-pane -->
                    
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->


        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo site_url('resources/js/bootstrap.min.js');?>"></script>
        <!-- FastClick -->
        <script src="<?php echo site_url('resources/js/fastclick.js');?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo site_url('resources/js/app.min.js');?>"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo site_url('resources/js/demo.js');?>"></script>
        <!-- DatePicker -->
        <script src="<?php echo site_url('resources/js/moment.js');?>"></script>
        <script src="<?php echo site_url('resources/js/bootstrap-datetimepicker.min.js');?>"></script>
        <script src="<?php echo site_url('resources/js/global.js');?>"></script>
    </body>
</html>
