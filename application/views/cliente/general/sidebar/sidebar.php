
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
				<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
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
								<input type="text" class="form-control" placeholder="Search...">
								<span class="input-group-btn">
								<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
								</span>
							</div>
						</form>
						<!-- END RESPONSIVE QUICK SEARCH FORM -->
					</li>
					<li class="start ">
						<a href="index.html">
						<i class="icon-home"></i>
						<span class="title"> Inicio</span>
						</a>
					</li>
					<li>
						<a href="javascript:;">
							<i class="fa fa-folder-open-o"></i><span class="title"> Mis Casos</span>
						</a>
					</li>
					<!-- Actualizar Informacion -->
					<li>
						<a href="#">
							<i class="fa fa-bars"></i><span class="title"> Actualizar Información</span>
							<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="<?php echo site_url('cliente/nuevo'); ?>"><i class="fa fa-user"></i> Información básica</a>
							</li>
							<li>
								<a href="<?php echo site_url('cliente'); ?>"><i class="fa fa-users"></i> Contactos</a>
							</li>
							<li>
								<a href="<?php echo site_url('cliente'); ?>"><i class="fa fa-info"></i> Sistemas <strong>CONTPAQi®</strong></a>
							</li>
							<li>
								<a href="<?php echo site_url('cliente'); ?>"><i class="fa fa-desktop"></i> Equipos de cómputo</a>
							</li>
						</ul>
					</li>
				</ul>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
		<!-- END SIDEBAR -->