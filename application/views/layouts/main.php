<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <?php
        $session_data = $this->session->userdata('logged_in');
    ?>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ximpleman - <?php echo $page_title?> </title>
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

</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapsed sidebar-collapse">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">Ximpleman Web</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">Ximpleman Web</span>
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
<!---<div style="float: left; padding-top: 12px; padding-left: 40%; color: white; font-size: 15pt">
    <b><?php $misitio  = trim(dirname($_SERVER['PHP_SELF']), "/"); echo $misitio; ?></b></div>-->
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
                                    <?php echo $session_data['usuario_nombre'].' - '.$session_data['rol']  ?>
                                    <small><?php echo $session_data['usuario_email']?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?php site_url()?>dashb/cuenta" class="btn btn-default btn-flat">Mi Cuenta</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo site_url()?>admin/dashb/logout" class="btn btn-default btn-flat">Salir</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
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
                    <a href="<?php echo site_url('admin/dashb');?>">
                        <i class="fa fa-dashboard"></i> <span>Inicio</span>
                    </a>
                </li>
                <?php
                    if($session_data['tipousuario_id']==1){
                ?>
                 <li>
                    <a href="#"><i class="fa fa-address-book"></i> <span>Registro</span></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo site_url('cliente');?>"><i class="fa fa-user"></i>Clientes</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('producto');?>"><i class="fa fa-cubes"></i>Productos</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('proveedor');?>"><i class="fa fa-truck"></i>Proveedores</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('responsable/index');?>"><i class="fa fa-user"></i>Responsable</a>
                        </li>
                    </ul>
                </li>
                <?php }?>

                <?php
                if($session_data['tipousuario_id']==1){
                ?>
                <li>
                    <a href="#"><i class="fa fa-list-ol"></i> <span>Parametros</span></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo site_url('categoria_cliente');?>"><i class="fa fa-user"></i>Categoria Cliente</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('categoria_clientezona');?>"><i class="fa fa-user"></i>Categoria Cliente Zona</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('categoria_egreso');?>"><i class="fa fa-user"></i>Categoria Egreso</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('categoria_ingreso');?>"><i class="fa fa-user"></i>Categoria Ingreso</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('categoria_producto');?>"><i class="fa fa-cubes"></i>Categoria Productos</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('categoria_servicio');?>"><i class="fa fa-list-ul"></i>Categoria Servicio</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('categoria_trabajo');?>"><i class="fa fa-building"></i> Categoria Trabajo</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('dosificacion');?>"><i class="fa fa-list-alt"></i>Dosificación</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('empresa');?>"><i class="fa fa-bank"></i>Empresas</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('estado');?>"><i class="fa fa-ellipsis-v"></i>Estados</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('forma_pago');?>"><i class="fa fa-dollar"></i>Forma de Pago</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('moneda');?>"><i class="fa fa-money"></i>Moneda</a>
                        </li>
                       
                        <li>
                            <a href="<?php echo site_url('presentacion');?>"><i class="fa fa-connectdevelop"></i> <span>Presentación</span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('procedencia');?>"><i class="fa fa-car"></i>Procedencia</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('subcategoria_servicio');?>"><i class="fa fa-list"></i>Sub categoria Servicio</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('tipo_cliente');?>"><i class="fa fa-user"></i>Tipo Cliente</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('tipo_transaccion');?>"><i class="fa fa-houzz"></i>Tipo Transacción</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('tipo_servicio');?>"><i class="fa fa-wrench"></i>Tipo Servicio</a>
                        </li>
                        
                        <li>
                            <a href="<?php echo site_url('tiempo_uso');?>"><i class="fa fa-hourglass"></i>Tiempo de Uso</a>
                        </li>
                        
                    </ul>
                </li>

                <?php }?>
                <li>
                    <a href="#"><i class="fa fa-industry"></i> <span>Operaciones</span></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo site_url('venta/ventas');?>"><i class="fa fa-cart-plus"></i>Ventas</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('compra');?>"><i class="fa fa-cart-arrow-down"></i>Compras</a>
                        </li>
                        <?php
                            if($session_data['tipousuario_id']==1){
                        ?>
                        <li>
                            <a href="<?php echo site_url('inventario');?>"><i class="fa fa-cart-plus"></i>Actualizar Inventario</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('pedido');?>"><i class="fa fa-clipboard"></i>Pedidos Mañana</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('proveedor');?>"><i class="fa fa-address-book"></i>Proveedores</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('cotizacion');?>"><i class="fa fa-list-ul"></i>Cotizaciones</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-credit-card"></i> <span>Credito</span></a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?php echo site_url('credito/indexDeuda');?>"><i class="fa fa-hand-o-right"></i><i class="fa fa-money"></i> Deudas por pagar</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('credito/indexCuenta');?>"><i class="fa fa-hand-o-left"></i><i class="fa fa-money"></i> Cuentas por cobrar</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo site_url('ingreso');?>"><i class="fa fa-arrow-right"></i> <span>Ingresos</span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('egreso');?>"><i class="fa fa-arrow-left"></i> <span>Egresos</span></a>
                        </li>
                            <?php }?>
                        <li>
                            <a href="<?php echo site_url('cambio_producto');?>"><i class="fa fa-exchange"></i> <span>Cambio</span></a>
                        </li>
                        <?php
                            if($session_data['tipousuario_id']==1){
                         ?>
                        <li>
                            <a href="<?php echo site_url('servicio/index');?>"><i class="fa fa-wrench"></i> Servicios</a>
                        </li>
                        <?php }?>
                    </ul>
                </li>
                <?php
                    if($session_data['tipousuario_id']==1){
                ?>
                <li>
                    <a href="#"><i class="fa fa-clipboard"></i> <span>Reportes</span></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo site_url('reportes/cajareportes');?>"><i class="fa fa-archive"></i>Caja</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('reportes/comprareportes');?>"><i class="fa fa-cart-arrow-down"></i>Compras</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('reportes/egresorep');?>"><i class="fa fa-arrow-left"></i>Egresos</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('factura');?>"><i class="fa fa-table"></i> <span>Factura</span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('reportes/ingresorep');?>"><i class="fa fa-arrow-right"></i>Ingresos</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('reportes');?>"><i class="fa fa-exchange"></i>Ingresos/Egresos</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('reportes/planillacaja');?>"><i class="fa fa-exchange"></i>Planilla de Caja</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('reportes/servicioreportes');?>"><i class="fa fa-exchange"></i>Servicios</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('reportes/ventareportes');?>"><i class="fa fa-cart-plus"></i>Ventas</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('venta/comision');?>"><i class="fa fa-cart-plus"></i>Ventas</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-lock"></i><i class="fa fa-user"></i> <span>Seguridad</span></a>
                    <ul class="treeview-menu">
                        
                        <li>
                            <a href="<?php echo site_url('rol');?>"><i class="fa fa-gg"></i>Roles</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('rol_usuario');?>"><i class="fa fa-compress"></i> <span>Rol Usuario</span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('tipo_usuario');?>"><i class="fa fa-list-ul"></i>Tipo Usuario</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('usuario');?>"><i class="fa fa-user"></i>Usuarios</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-braille"></i> <span>Contabilidad</span></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="#"><i class="fa fa-building"></i>En Construcción</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span>Web Site</span></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo site_url('articulo');?>"><i class="fa fa-gg"></i>Articulos</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('boton');?>"><i class="fa fa-square"></i>Boton</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('boton_articulo');?>"><i class="fa fa-square"></i><i class="fa fa-gg"></i>Boton Articulo</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('boton_slide');?>"><i class="fa fa-square"></i><i class="fa fa-image"></i>Boton Slide</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('categ_imagen');?>"><i class="fa fa-image"></i>Categ. Imagen</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('categoria_imagen');?>"><i class="fa fa-list-ul"></i><i class="fa fa-image"></i>Categoria Imagen</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('empresa_pagina');?>"><i class="fa fa-bank"></i><i class="fa fa-sitemap"></i>Empresa Pagina</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('estado_pagina');?>"><i class="fa fa-ellipsis-v"></i><i class="fa fa-sitemap"></i>Estado Pagina</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('galeria');?>"><i class="fa fa-image"></i>Galeria</a>
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
                            <a href="<?php echo site_url('menu');?>"><i class="fa fa-list-alt"></i>Menu</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('menu_principal');?>"><i class="fa fa-th-list"></i>Menu Principal</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('pagina_web');?>"><i class="fa fa-globe"></i>Pagina Web</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('promocion');?>"><i class="fa fa-percent"></i><i class="fa fa-minus-circle"></i>Promoción</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('seccion');?>"><i class="fa fa-list-alt"></i>Sección</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('slide');?>"><i class="fa fa-image"></i>Slide</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('slide_image');?>"><i class="fa fa-list"></i><i class="fa fa-image"></i>Slide Imagn</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('submenu');?>"><i class="fa fa-list-alt"></i>Sub Menu</a>
                        </li>
                    </ul>
                </li>
                    <?php }?>
                
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
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
                <strong>Generated By <a href="http://www.crudigniter.com/">CRUDigniter</a> 3.2</strong>
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
