
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN STYLE CUSTOMIZER -->
				<div class="theme-panel hidden-xs hidden-sm">
					<div class="toggler">
					</div>
					<div class="toggler-close">
					</div>
					<div class="theme-options">
						<div class="theme-option theme-colors clearfix">
							<span>
							COLOR </span>
							<ul>
								<li class="color-default current tooltips" data-style="default" data-original-title="Default">
								</li>
								<li class="color-darkblue tooltips" data-style="darkblue" data-original-title="Dark Blue">
								</li>
								<li class="color-blue tooltips" data-style="blue" data-original-title="Blue">
								</li>
								<li class="color-grey tooltips" data-style="grey" data-original-title="Grey">
								</li>
								<li class="color-light tooltips" data-style="light" data-original-title="Light">
								</li>
								<li class="color-light2 tooltips" data-style="light2" data-html="true" data-original-title="Light 2">
								</li>
							</ul>
						</div>
						<div class="theme-option">
							<span>
							Layout </span>
							<select class="layout-option form-control input-small">
								<option value="fluid" selected="selected">Fluid</option>
								<option value="boxed">Boxed</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Header </span>
							<select class="page-header-option form-control input-small">
								<option value="fixed" selected="selected">Fixed</option>
								<option value="default">Default</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Sidebar </span>
							<select class="sidebar-option form-control input-small">
								<option value="fixed">Fixed</option>
								<option value="default" selected="selected">Default</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Sidebar Position </span>
							<select class="sidebar-pos-option form-control input-small">
								<option value="left" selected="selected">Left</option>
								<option value="right">Right</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Footer </span>
							<select class="page-footer-option form-control input-small">
								<option value="fixed">Fixed</option>
								<option value="default" selected="selected">Default</option>
							</select>
						</div>
					</div>
				</div>
				<!-- END STYLE CUSTOMIZER -->

				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Productos - <small>Gestor</small></h3>
						<ul class="page-breadcrumb breadcrumb">
							<li class="btn-group">
								<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
								<span>Actions</span><i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">
									<li>
										<a href="#">Action</a>
									</li>
									<li>
										<a href="#">Another action</a>
									</li>
									<li>
										<a href="#">Something else here</a>
									</li>
									<li class="divider">
									</li>
									<li>
										<a href="#">Separated link</a>
									</li>
								</ul>
							</li>
							<li>
								<i class="fa fa-home"></i>
								<a href="<?php echo site_url() ?>">Inicio</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Productos</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN Portlet PORTLET-->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-speech"></i>
									<span class="caption-subject bold uppercase"> Portlet</span>
									<span class="caption-helper">weekly stats...</span>
								</div>
								<div class="actions">
									<a class="btn btn-circle btn-default" data-toggle="modal"  data-target="#static"><i class="fa fa-plus"></i> Nuevo Producto </a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-hover table-bordered" id="tabla_productos">
									<thead>
										<tr>
											<th>Código</th>
											<th>Descripción</th>
											<th>Precio</th>
											<th>Unidad</th>
											<th>Impuesto 1</th>
											<th>Impuesto 2</th>
											<th>Retencion 1</th>
											<th>Retencion 2</th>
											<th></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
						<!-- END Portlet PORTLET-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->

				<!-- BEGIN VENTANAS MODALES -->

				<!-- BEGIN AJAX DETALLE PRODUCTO -->
				<div id="ajax-modal" class="modal fade" tabindex="-1"></div>
				<!-- END AJAX DETALLE PRODUCTO -->

				<!-- BEGIN FORMULARIO PRODUCTO -->
				<div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
					<div class="modal-body">
						<p>
							 Would you like to continue with some arbitrary task?
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
						<button type="button" data-dismiss="modal" class="btn blue">Continue Task</button>
					</div>
				</div>
				<!-- END FORMULARIO PRODUCTO -->


				<!-- END VENTANAS MODALES -->
			</div>
		</div>
		<!-- END CONTENT -->
