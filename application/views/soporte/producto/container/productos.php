
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Productos - <small>Gestor</small></h3>
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
									<i class="fa fa-shopping-cart"></i>
									<span class="caption-subject bold uppercase"> Productos</span>
									<span class="caption-helper"></span>
								</div>
								<div class="actions">
									<a class="btn btn-circle green"  data-toggle="modal" href="#nuevo_producto_form">
										<i class="fa fa-plus"></i> Agregar
									</a>
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

				<!-- BEGIN  NEUVO PRODUCTO -->
				<div id="nuevo_producto_form" class="modal fade" tabindex="-1" data-backdrop="static" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h3 class="modal-title"><b>Nuevo Producto</b></h3>
								<small> </small>
							</div>
							<form id ="form-producto-nuevo" method="post" accept-charset="utf-8" action="<?php echo site_url('producto/gestor/nuevo') ?>">
								<div class="modal-body form-horizontal">
									<div class="col-md-12">
										<!-- DIV ERROR -->
										<div class="alert alert-danger  display-hide">
											<button class="close" data-close="alert"></button>
											Tienes errores en tu formulario
										</div>
										<!-- BEGIN FORM BODY -->
										<div class="form-body">
											<div class="col-md-12">
												<!-- Nombre(s) -->
												<div class="form-group">
													<label class="col-md-3 control-label">Código: </label>
													<div class="col-md-8">
														<div class="input-icon">
															<i class="fa fa-user"></i>
															<input type="text" class="form-control" name="codigo" placeholder="Código">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Descripción: </label>
													<div class="col-md-9">
														<input type="text" class="form-control" name="descripcion" placeholder="Descripcion">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Unidad</label>
													<div class="col-md-9">
														<select class="form-control" name="unidad">
															<option value="Horas">Horas</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Precio: </label>
													<div class="col-md-9">
														<div class="input-inline input-medium">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-usd"></i></span>
																<input type="text" name="precio" class="form-control">
															</div>
														</div>
														<span class="help-inline">99 ó 99.99 </span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Impuesto 1: </label>
													<div class="col-md-9">
														<div class="input-inline input-medium">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-usd"></i></span>
																<input type="text" name="impuesto1" class="form-control">
															</div>
														</div>
														<span class="help-inline">99 ó 99.99 </span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Impuesto 2: </label>
													<div class="col-md-9">
														<div class="input-inline input-medium">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-usd"></i></span>
																<input type="text" name="impuesto2" class="form-control">
															</div>
														</div>
														<span class="help-inline">99 ó 99.99 </span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Retencion 1: </label>
													<div class="col-md-9">
														<div class="input-inline input-medium">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-usd"></i></span>
																<input type="text" name="retencion1" class="form-control">
															</div>
														</div>
														<span class="help-inline">99 ó 99.99 </span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Retencion 2: </label>
													<div class="col-md-9">
														<div class="input-inline input-medium">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-usd"></i></span>
																<input type="text" name="retencion2" class="form-control">
															</div>
														</div>
														<span class="help-inline">99 ó 99.99 </span>
													</div>
												</div>
											</div>
										</div>
										<!-- END FORM BODY -->
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="modal-footer">
									<button type="button" id="btn_nuevo_producto" class="btn btn-circle green">Guardar</button>
									<button type="button" data-dismiss="modal" class="btn btn-circle btn-default">Cancelar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!--DOC: Aplly "modal-cached" class after "modal" class to enable ajax content caching-->
				<div id="ajax_form_producto" class="modal container fade" role="basic" aria-hidden="true">
					<div class="page-loading page-loading-boxed">
						<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
						<span>Cargando... </span>
					</div>
					<div class="modal-dialog">
						<div class="modal-content">
						</div>
					</div>
				</div>
				<!-- END AJAX DETALLE PRODUCTO -->

				<!-- END VENTANAS MODALES -->
			</div>
		</div>
		<!-- END CONTENT -->
