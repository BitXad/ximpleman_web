<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
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

<body class="hold-transition skin-blue sidebar-mini">
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

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo site_url('uploads/profile/'.$thumb);  ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo strtolower($usuario_login)?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?php echo site_url('uploads/profile/'.$usuario_imagen);?>" class="img-circle" alt="User Image">
                                <p>
                                    <?php echo $usuario_nombre.' - '.$rol  ?>
                                    <small><?php echo $usuario_email?></small>
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
                            <img src="<?php echo site_url('uploads/profile/'.$thumb);?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo strtolower($usuario_nombre) ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">Menu</li>
                        <li>
                            <a href="<?php echo site_url();?>">
                                <i class="fa fa-dashboard"></i> <span>Inicio</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo site_url();?>admin/pedidos">
                                <i class="fa fa-address-book-o"></i> <span>Pedidos Mañana</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo site_url('categoria_cliente');?>">
                                <i class="fa fa-sitemap"></i> <span>Categoria Cliente</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('categoria_cliente/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('categoria_cliente/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('categoria_producto/index');?>">
                                <i class="fa fa-cubes"></i> <span>Categoria Producto</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('categoria_producto/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('categoria_producto/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('cliente/index');?>">
                                <i class="fa fa-users"></i> <span>Cliente</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('cliente/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('cliente/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('cliente_usuario/index');?>">
                                <i class="fa fa-american-sign-language-interpreting"></i> <span>Cliente Usuario</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('cliente_usuario/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('cliente_usuario/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('compra/index');?>">
                                <i class="fa fa-cart-arrow-down"></i> <span>Compra</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('compra/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('compra/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('credito/index');?>">
                                <i class="fa fa-credit-card-alt"></i> <span>Credito</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('credito/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('credito/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('cuotum/index');?>">
                                <i class="fa fa-cc"></i> <span>Cuota</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('cuotum/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('cuotum/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <!--<li>
                            <a href="<?php // echo site_url('detalle_compra/index');?>">
                                <i class="fa fa-list-ol"></i> <span>Detalle Compra</span>
                            </a>
                        </li>-->
                        <li>
                            <a href="<?php echo site_url('detalle_pedido/index');?>">
                                <i class="fa fa-list-ol"></i> <span>Detalle Pedido</span>
                            </a>
                            <!--  <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('detalle_pedido/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('detalle_pedido/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('detalle_venta/index');?>">
                                <i class="fa fa-list-ol"></i> <span>Detalle Venta</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('detalle_venta/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('detalle_venta/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('dosificacion/index');?>">
                                <i class="fa fa-list-alt"></i> <span>Dosificacion</span>
                            </a>
                            <!--  <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('dosificacion/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('dosificacion/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('empresa/index');?>">
                                <i class="fa fa-bank"></i> <span>Empresa</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('empresa/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('empresa/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('estado/index');?>">
                                <i class="fa fa-sliders"></i> <span>Estado</span>
                            </a>
                            <!--  <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('estado/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('estado/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('factura/index');?>">
                                <i class="fa fa-table"></i> <span>Factura</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('factura/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('factura/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('forma_pago/index');?>">
                                <i class="fa fa-exchange"></i> <span>Forma Pago</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('forma_pago/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('forma_pago/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('moneda/index');?>">
                                <i class="fa fa-money"></i> <span>Moneda</span>
                            </a>
                            <!--  <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('moneda/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('moneda/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('pedido/index');?>">
                                <i class="fa fa-paste"></i> <span>Pedido</span>
                            </a>
                            <!--  <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('pedido/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('pedido/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('presentacion/index');?>">
                                <i class="fa fa-connectdevelop"></i> <span>Presentación</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('presentacion/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('presentacion/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('producto/index');?>">
                                <i class="fa fa-codepen"></i> <span>Producto</span>
                            </a>
                            <!--  <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('producto/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('producto/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('proveedor/index');?>">
                                <i class="fa fa-address-book"></i> <span>Proveedor</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('proveedor/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('proveedor/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('responsable/index');?>">
                                <i class="fa fa-address-book"></i> <span>Responsable</span>
                            </a>
                            <!--  <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('responsable/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('responsable/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('rol/index');?>">
                                <i class="fa fa-gg"></i> <span>Rol</span>
                            </a>
                            <!--  <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('rol/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('rol/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('rol_usuario/index');?>">
                                <i class="fa fa-compress"></i> <span>Rol Usuario</span>
                            </a>
                            <!--  <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('rol_usuario/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('rol_usuario/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                       <li>
                            <a href="#"><i class="fa fa-braille"></i> <span>Servicio</span></a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?php echo site_url('servicio/index');?>"><i class="fa fa-list-ul"></i> Servicios</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('categoria_servicio/index');?>"><i class="fa fa-list-ul"></i>Categoria Servicio</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('subcategoria_servicio/index');?>"><i class="fa fa-list-ul"></i>Sub categoria Servicio</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('tipo_servicio/index');?>"><i class="fa fa-list-ul"></i>Tipo Servicio</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('categoria_trabajo/index');?>"><i class="fa fa-list-ul"></i> Categoria Trabajo</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('tiempo_uso/index');?>"><i class="fa fa-list-ul"></i>Tiempo de Uso</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('procedencia/index');?>"><i class="fa fa-list-ul"></i>Procedencia</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('responsable/index');?>"><i class="fa fa-list-ul"></i>Responsable</a>
                                </li>
				
			    </ul>
                        </li>
                        <li>
                            <a href="<?php echo site_url('tipo_cliente/index');?>">
                                <i class="fa fa-list"></i> <span>Tipo Cliente</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('tipo_cliente/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('tipo_cliente/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('tipo_transaccion/index');?>">
                                <i class="fa fa-houzz"></i> <span>Tipo Transaccion</span>
                            </a>
                            <!--   <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('tipo_transaccion/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('tipo_transaccion/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('tipo_usuario/index');?>">
                                <i class="fa fa-id-badge"></i> <span>Tipo Usuario</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('tipo_usuario/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('tipo_usuario/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('usuario/index');?>">
                                <i class="fa fa-user-circle-o"></i> <span>Usuario</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('usuario/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('usuario/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('venta/index');?>">
                                <i class="fa fa-cart-plus"></i> <span>Venta</span>
                            </a>
                            <!-- <ul class="treeview-menu">
                                        <li class="active">
                                            <a href="<?php //echo site_url('venta/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('venta/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <?php
                    echo $main;
                    ?>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
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
