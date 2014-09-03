
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
						<h3 class="page-title"> Sistemas <strong>CONTPAQi®</strong> - <small><?php echo $usuario_activo['razon_social'] ?></small></h3>
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
								<a href="#">Actualizar Información</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Sistemas <strong>CONTPAQi®</strong></a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-2">
					</div>
					<div class="col-md-8">
						<!-- BEGIN TABLA SIATEMAS CONTPAQI -->
						<div class="portlet box grey">
							<div class="portlet-title">
								<div class="caption" style="color: black">
									<i class="fa fa-users"></i> Sistemas <strong>CONTPAQi®</strong>
								</div>
								<div class="tools" style="color: black">
									<a href="javascript:;" class="collapse">
									</a>
									<a href="javascript:;" class="reload">
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-hover table-bordered" id="tabla_sistemas_cliente">
									<thead>
										<tr>
											<th>Sistema</th>
											<th>Versión</th>
											<th>Número de Serie</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($sistemas_contpaqi_cliente as $sistema) : ?>
											<tr id="<?php echo $sistema->id ?>">
												<td><?php echo $sistema->sistema ?></td>
												<td><?php echo $sistema->version ?></td>
												<td><?php echo $sistema->no_serie ?></td>
												<td><a class="delete" href="javascript:;">Eliminar </a></td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
								<div class="table-toolbar">
									<div class="btn-group pull-right">
										<a href="#" class="btn green btn-xs" data-target="#nuevo-sistema" data-toggle="modal"><i class="fa fa-plus"></i> Nueva Sistema </a>
									</div>
								</div>
							</div>
						</div>
						<!-- END TABLA SIATEMAS CONTPAQI -->
					</div>
					<div class="col-md-2">
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->

<!-- BEGIN VENTANAS MODALES -->
	<!-- BEGIN NUEVO SISTEMA -->
		<div id="nuevo-sistema" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
			<div class="modal-header">
				<h3 class="modal-title">
					<b>Registrar sistema <strong>CONTPAQi®</strong></b>
				</h3>
				<small> <?php echo $usuario_activo['razon_social'] ?></small>
			</div>
			<form action="<?php echo site_url('/actualizar/sistemas/nuevo') ?>" id ="form-nuevo-sistema" method="post" accept-charset="utf-8">
				<div class="modal-body form-horizontal">
					<div>
						<!-- DIV ERROR -->
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							Tienes Errores en tu formulario
						</div>
						<!-- DIV SUCCESS -->
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Exito en el formulario
						</div>
						<!-- BEGIN FORM BODY -->
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">
									Sistema
								</label>
								<div class="col-md-8">
									<div class="input-icon">
										<i class="fa fa-info"></i>
										<select class="form-control" name="sistema" id="select_sistemas">
											<option value=""></option>
											<?php foreach ($sistemas_contpaqi as $sistema): ?>
											<option value="<?php echo $sistema->id_sistema?>"><?php echo $sistema->sistema ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<!-- Version -->
							<div class="form-group">
								<label class="col-md-3 control-label">Versión</label>
								<div class="col-md-8">
									<div class="input-icon">
										<i class="fa fa-history"></i>
										<select class="form-control" name="version" id="select_versiones">
										</select>
									</div>
								</div>
							</div>
							<!-- No de serie -->
							<div class="form-group">
								<label class="col-md-3 control-label">No. de Serie</label>
								<div class="col-md-8">
									<div class="input-icon">
										<i class="fa fa-barcode"></i>
										<input type="text" class="form-control" placeholder="No. de Serie" name="no_serie">
									</div>
								</div>
							</div>
						</div>
						<!-- END FORM BODY -->
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
					<button type="submit" class="btn green">Guardar</button>
				</div>
			</form>
		</div>
	<!-- END NUEVO SISTEMA -->
<!-- END VENTANAS MODALES -->