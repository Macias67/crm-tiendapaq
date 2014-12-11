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
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-puzzle font-red-flamingo"></i>
							<span class="caption-subject bold font-red-flamingo uppercase">
							Sistemas CONTPAQi® </span>
						</div>
						<div class="actions">
							<a class="btn btn-circle green"  data-toggle="modal" href="#nuevo_sistema_form">
								<i class="fa fa-plus"></i> Agregar
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-hover table-bordered" id="tabla_sistemas_cliente" id-cliente="<?php echo $usuario_activo['id'] ?>">
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
										<td width="1%"><button type="button" class="btn btn-circle red btn-xs eliminar-sistema"><i class="fa fa-trash-o"></i> Eliminar</button></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
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

<!-- SISTEMAS -->
<div id="nuevo_sistema_form" class="modal fade" tabindex="-1" data-backdrop="static" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><b>Sistema</b></h3>
				<small> </small>
			</div>
			<form id ="form-sistema-nuevo" method="post" accept-charset="utf-8">
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
								<!-- Sistema -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Sistema
									</label>
									<div class="col-md-8">
										<input type="hidden" class="form-control" name="id_cliente" value="<?php echo $usuario_activo['id'] ?>">
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
									<label class="col-md-4 control-label">Versión</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-history"></i>
											<select class="form-control" name="version" id="select_versiones">
											</select>
										</div>
									</div>
								</div>
								<!-- No. Serie -->
								<div class="form-group">
									<label class="col-md-4 control-label">No. Serie: </label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-user"></i>
											<input type="text" class="form-control" placeholder="No. Serie" name="no_serie" value="">
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END FORM BODY -->
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
					<button type="submit" id="btn_guardar_sistema" class="btn green">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /.modal -->

