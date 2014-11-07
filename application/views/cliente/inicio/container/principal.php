
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
						<h3 class="page-title"> Bienvenido a CRM TiendaPAQ - <small><?php echo $usuario_activo['razon_social'] ?></small></h3>
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
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<!-- BEGIN PEDIDOS CLIENTE PEDIENTES PORTLET-->
						<div class="portlet gren">
							<div class="portlet-title">
								<div class="caption"><i class="fa fa-user"></i> Cotizaciones Pendientes</div>
								<div class="tools">
									<a href="javascript:;" class="collapse">
									</a>
									<a href="#portlet-config" data-toggle="modal" class="config">
									</a>
									<a href="javascript:;" class="reload">
									</a>
									<a href="javascript:;" class="remove">
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-hover" id="sample_2">
									<thead>
										<tr>
											<th>Folio</th>
											<th>Fecha de emisión</th>
											<th>Vigencia hasta</th>
											<th>Oficina</th>
											<th>Estatus</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($cotizaciones as $cotizacion): ?>
										<tr>
											<td><?php echo $cotizacion->folio ?></td>
											<td><?php echo fecha_formato($cotizacion->fecha) ?></td>
											<td><?php echo fecha_formato($cotizacion->vigencia) ?></td>
											<td><?php echo $cotizacion->ciudad_estado ?></td>
											<?php if($cotizacion->id_estatus==1): ?>
												<td><span class="btn btn-xs green"><?php echo ucfirst($cotizacion->descripcion) ?></span></td>
												<td>
													<button type="button" class="btn green default cotizacion-previa btn-xs" id="<?php echo $cotizacion->folio ?>"><i class="fa fa-file-o"></i> Detalles</button>
													<a class="btn red default btn-xs" href="<?php echo site_url('cotizacion/descarga/'.$cotizacion->folio) ?>"><i class="fa fa-file-o"></i> Descargar</a>
													<a href="<?php echo site_url('cotizacion/comprobante/'.$cotizacion->folio) ?>" class="btn blue btn-xs"><i class="fa fa-dollar"></i> Comprobante de Pago</a>
												</td>
											<?php endif ?>
											<?php if($cotizacion->id_estatus==2): ?>
												<td><span class="btn btn-xs yellow"><?php echo ucfirst($cotizacion->descripcion) ?></span></td>
												<td>
													<a href="<?php echo site_url('cotizacion/comprobante/'.$cotizacion->folio) ?>" class="btn blue btn-xs"> Ver de Pago</a>
												</td>
											<?php endif ?>
											<?php if($cotizacion->id_estatus==5): ?>
												<td><span class="btn btn-xs red"><?php echo ucfirst($cotizacion->descripcion) ?></span></td>
												<td>
												</td>
											<?php endif ?>
										</tr>
									<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- END PEDIDOS CLIENTE PEDIENTES PORTLET-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->

				<!-- ajax -->
				<div id="ajax-modal" class="modal container fade" tabindex="-1"></div>
			</div>
		</div>
		<!-- END CONTENT -->