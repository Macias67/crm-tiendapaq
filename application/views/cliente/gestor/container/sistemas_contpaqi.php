		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">

				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title"> Sistemas <strong>CONTPAQi®</strong> - <small><?php echo $usuario_activo['razon_social'] ?></small></h3>
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
									<i class="fa fa-info"></i> Sistemas <strong>CONTPAQi®</strong>
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
										<a href="#" class="btn btn-circle green btn-xs" data-target="#nuevo-sistema" data-toggle="modal"><i class="fa fa-plus"></i> Nueva Sistema </a>
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
			<form id ="form-nuevo-sistema" method="post" accept-charset="utf-8">
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
											<option value="<?php echo $sistema->sistema?>"><?php echo $sistema->sistema ?></option>
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
										<input type="text" class="form-control" placeholder="No. de Serie" name="no_serie" id="no_serie">
									</div>
								</div>
							</div>
						</div>
						<!-- END FORM BODY -->
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-circle btn-default">Cancelar</button>
					<button type="button" id="btn_guardar_sistema" class="btn btn-circle green">Guardar</button>
				</div>
			</form>
		</div>
	<!-- END NUEVO SISTEMA -->
<!-- END VENTANAS MODALES -->