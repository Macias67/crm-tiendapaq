
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
						<form class="sidebar-search" action="extra_search.html" method="POST">
							<a href="javascript:;" class="remove">
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
								<a href="<?php echo site_url('cliente/nuevo'); ?>"><i class="fa fa-plus"></i> Añadir</a>
							</li>
							<li>
								<a href="<?php echo site_url('cliente'); ?>"><i class="fa fa-cogs"></i> Gestionar</a>
							</li>
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
								<a href="<?php echo site_url('ejecutivo/nuevo') ?>">
								<i class="fa fa-plus"></i> Añadir</a>
							</li>
							<li>
								<a href="#">
								<i class="fa fa-cogs"></i> Gestionar</a>
							<li>
						</ul>
					</li>
					<li>
						<a href="<?php echo site_url('calendario') ?>">
							<i class="fa fa-calendar"></i>
							<span class="title">Calendario</span>
						</a>
					</li>
					<!-- Importar Catalagos -->
					<li>
						<a href="<?php echo site_url('catalogo') ?>">
							<i class="fa fa-upload"></i>
							<span class="title"> Importar Catálogos</span>
						</a>
					</li>
					<!-- Cerrar Sesion -->
					<li>
						<a href="<?php echo site_url('logout') ?>">
						<i class="icon-settings"></i>
						<span class="title">Cerrar Sesion</span></a>
					</li>
				</ul>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
		<!-- END SIDEBAR -->