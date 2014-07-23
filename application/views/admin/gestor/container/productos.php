
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
						<h3 class="page-title">Blank Page <small>blank page</small></h3>
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
								<a href="#">Pagina</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Seccion</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box grey">
							<div class="portlet-title">
								<div class="caption" style="color: black">
									<i class="fa fa-shopping-cart"></i> Productos
								</div>
								<div class="tools" style="color: black">
									<a href="javascript:;" class="collapse">
									</a>
									<a href="javascript:;" class="reload">
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-hover table-bordered" id="tabla_productos_editable">
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
											<th></th>
										</tr>
									</thead>
									<tbody>
											<tr id="1">
												<td>P001</td>
												<td>SOPORTE TECNICO</td>
												<td>400.00</td>
												<td>Hr</td>
												<td>0.00</td>
												<td>0.00</td>
												<td>0.00</td>
												<td>0.00</td>
												<td><a class="edit" href="javascript:;">Editar </a></td>
												<td><a class="delete" href="javascript:;">Eliminar </a></td>
											</tr>
											<tr id="2">
												<td>P028</td>
												<td>INSTALACION DE SISTEMA</td>
												<td>600.00</td>
												<td>Hr</td>
												<td>0.00</td>
												<td>0.00</td>
												<td>0.00</td>
												<td>0.00</td>
												<td><a class="edit" href="javascript:;">Editar </a></td>
												<td><a class="delete" href="javascript:;">Eliminar </a></td>
											</tr>
											<tr id="3">
												<td>P102</td>
												<td>ACTUALIZACION DE SISTEMA</td>
												<td>800.00</td>
												<td>Hr</td>
												<td>0.00</td>
												<td>0.00</td>
												<td>0.00</td>
												<td>0.00</td>
												<td><a class="edit" href="javascript:;">Editar </a></td>
												<td><a class="delete" href="javascript:;">Eliminar </a></td>
											</tr>
									</tbody>
								</table>
								<div class="table-toolbar">
									<div class="btn-group pull-right">
										<button id="tabla_productos_editable_new" class="btn green btn-xs">
											<i class="fa fa-plus"></i> Nuevo producto
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->