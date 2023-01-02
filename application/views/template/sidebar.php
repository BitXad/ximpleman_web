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
            <li>
                <a href="<?php echo site_url('detalle_compra/index');?>">
                    <i class="fa fa-list-ol"></i> <span>Detalle Compra</span>
                </a>
                <!-- <ul class="treeview-menu">
								<li class="active">
                                    <a href="<?php //echo site_url('detalle_compra/add');?>"><i class="fa fa-plus"></i> Add</a>
                                </li>
								<li>
                                    <a href="<?php //echo site_url('detalle_compra/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                </li>
							</ul> -->
            </li>
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
                <a href="<?php echo site_url('servicio/index');?>">
                    <i class="fa fa-braille"></i> <span>Servicio</span>
                </a>
                <!-- <ul class="treeview-menu">
								<li class="active">
                                    <a href="<?php //echo site_url('servicio/add');?>"><i class="fa fa-plus"></i> Add</a>
                                </li>
								<li>
                                    <a href="<?php //echo site_url('servicio/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                </li>
							</ul> -->
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