
	<div class="clearfix">
	</div>

	<!-- BEGIN CONTAINER -->
	<div class="page-container">

		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper">
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<div class="page-sidebar navbar-collapse collapse">
				<!-- BEGIN SIDEBAR MENU -->
				<ul class="page-sidebar-menu page-sidebar-menu-closed" data-auto-scroll="true" data-slide-speed="200">
					<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
					<li class="sidebar-toggler-wrapper">
						<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
						<div class="sidebar-toggler">
						</div>
						<!-- END SIDEBAR TOGGLER BUTTON -->
					</li>
					<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
					<li class="sidebar-search-wrapper">
						<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
						<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
						<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
						<form class="sidebar-search" action="#" method="POST">
							<a href="#;" class="remove">
							<i class="icon-close"></i>
							</a>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Buscar...">
								<span class="input-group-btn">
								<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
								</span>
							</div>
						</form>
						<!-- END RESPONSIVE QUICK SEARCH FORM -->
					</li>
					<li class="start">
						<a href="<?php echo site_url() ?>">
						<i class="icon-home"></i>
						<span class="title"> Inicio</span>
						</a>
					</li>
					<!-- Clientes -->
					<li>
						<a href="#">
							<i class="fa fa-users"></i>
							<span class="title"> Clientes</span>
							<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="<?php echo site_url('cliente/gestionar/nuevo'); ?>"><i class="fa fa-plus"></i> Añadir</a>
							</li>
							<li>
								<a href="<?php echo site_url('cliente/gestionar'); ?>"><i class="fa fa-cogs"></i> Gestionar</a>
							</li>
						</ul>
					</li>
					<!-- Cotizaciones -->
					<li>
						<a href="javascript:;">
						<i class="fa fa-file-pdf-o"></i>
						<span class="title"> Cotizaciones</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="<?php echo site_url('cotizador') ?>">
								<i class="fa fa-plus"></i> Nueva cotización</a>
							</li>
							<li>
								<a href="<?php echo site_url('cotizaciones/revisar') ?>">
								<i class="fa fa-dollar"></i> Pagos por revisar</a>
							</li>
							<li>
								<a href="<?php echo site_url('cotizaciones/catalogo') ?>">
								<i class="fa fa-search"></i> Catálogo</a>
							<li>
						</ul>
					</li>
					<!-- Ejecutivos -->
					<li>
						<a href="javascript:;">
						<i class="fa fa-user"></i>
						<span class="title"> Ejecutivos</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="<?php echo site_url('ejecutivo/gestionar/nuevo') ?>">
								<i class="fa fa-plus"></i> Añadir</a>
							</li>
							<li>
								<a href="<?php echo site_url('ejecutivo/gestionar') ?>">
								<i class="fa fa-cogs"></i> Gestionar</a>
							<li>
						</ul>
					</li>
					<!-- Productos -->
					<li>
						<a href="<?php echo site_url('producto') ?>">
							<i class="fa fa-shopping-cart"></i>
							<span class="title"> Productos</span>
						</a>
					</li>
					<!-- Gestor General -->
					<li>
						<a href="#">
							<i class="fa fa-cogs"></i>
							<span class="title"> Gestor General</span>
							<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="<?php echo site_url('gestor/oficinas') ?>"><i class="fa fa-building"></i> Oficinas y Dptos.</a>
							</li>
							<li>
								<a href="<?php echo site_url('gestor/sistemas') ?>"><i class="fa fa-info"></i> Sistemas <strong>CONTPAQi®</strong></a>
							</li>
							<li>
								<a href="<?php echo site_url('gestor/operativos'); ?>"><i class="fa fa-windows"></i> Sistemas Operativos</a>
							</li>

							<li>
								<a href="<?php echo site_url('gestor/bancos'); ?>"><i class="fa fa-usd"></i> Cuentas Bancarias</a>
							</li>

							<li>
								<a href="<?php echo site_url('gestor/observaciones'); ?>"><i class="fa fa-eye"></i> Observaciones de pago</a>
							</li>
						</ul>
					</li>
					<!-- Calendario <li>
						<a href="<?php echo site_url('calendario') ?>">
							<i class="fa fa-calendar"></i>
							<span class="title">Calendario</span>
						</a>
					</li>-->
					<!-- Importar -->
					<li>
						<a href="<?php echo site_url('catalogo') ?>">
							<i class="fa fa-upload"></i>
							<span class="title"> Importar</span>
							<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="<?php echo site_url('catalogo/clientes'); ?>"><i class="fa fa-users"></i> Clientes</a>
							</li>
							<li>
								<a href="<?php echo site_url('catalogo/productos'); ?>"><i class="fa fa-shopping-cart"></i> Productos</a>
							</li>
						</ul>
					</li>
					<!-- Cerrar Sesion -->
					<li>
						<a href="<?php echo site_url('logout') ?>">
						<i class="fa fa-key"></i>
						<span class="title">Cerrar Sesion</span></a>
					</li>
				</ul>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
		<!-- END SIDEBAR -->