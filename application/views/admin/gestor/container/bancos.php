<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Bancos - <small>Gestor General</small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<span class="caption-subject bold uppercase"><i class="fa fa-bank"></i> Bancos</span>
						</div>
						<div class="actions">
							<div class="btn-group pull-right">
								<a id="btn_nuevo_banco" class="btn btn-circle green btn-xs" href="#modal_nuevo_banco" data-toggle="modal">
									<i class="fa fa-plus"></i> Nuevo banco
								</a>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-hover table-bordered" id="tabla_bancos_editable">
							<thead>
								<tr>
									<th>Banco</th>
									<th>Sucursal</th>
									<th>Numero de cuenta</th>
									<th>Titular</th>
									<th>Clave interbancaria</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($bancos as $banco) : ?>
									<tr id="<?php echo $banco->id_banco?>">
										<td><?php echo $banco->banco ?></td>
										<td><?php echo $banco->sucursal ?></td>
										<td><?php echo $banco->cta ?></td>
										<td><?php echo $banco->titular ?></td>
										<td><?php echo $banco->cib ?></td>
										<td><a class="btn edit blue btn-circle btn-xs" href="<?php echo site_url('gestor/bancos/mostrar/'.$banco->id_banco) ?>" data-target="#ajax_editar_banco" data-toggle="modal"><i class="fa fa-edit"></i> Ver/Editar </a></td>
										<td><a class="btn delete red btn-circle btn-xs eliminar-banco" href="javascript:;"><i class="fa fa-trash"></i> Eliminar </a></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- END TABLA BANCOS -->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->

<!-- BEGIN MODAL NUEVO BANCO -->
<div id="modal_nuevo_banco" class="modal fade" tabindex="-1" data-backdrop="static" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><b>Nuevo Banco</b></h3>
				<small> </small>
			</div>
			<form id ="form-nuevo-banco" method="post" accept-charset="utf-8">
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
								<!-- Banco -->
								<div class="form-group" id="div_estado">
									<label class="col-md-4 control-label">
										Banco
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<select class="form-control" name="banco" id="banco">
													<option value="BANAMEX">BANAMEX</option>
													<option value="BANCOMER">BANCOMER</option>
													<option value="SANTANDER">SANTANDER</option>
													<option value="BANORTE">BANORTE</option>
											</select>
										</div>
									</div>
								</div>
								<!-- Sucursal -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Sucursal<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control sucursal" placeholder="Sucursal" name="sucursal">
										</div>
									</div>
								</div>
								<!-- No de cuenta -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										No. de Cuenta<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control cta" placeholder="No. de cuenta" name="cta">
										</div>
									</div>
								</div>
								<!-- Titular -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Titular<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" placeholder="Nombre del titular" name="titular">
										</div>
									</div>
								</div>
								<!-- Clabe interbancaria -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Clabe interbancaria<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-envelope"></i>
											<input type="text" class="form-control cib" placeholder="Clabe 18 digitos" name="cib">
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
					<button type="button" data-dismiss="modal" class="btn btn-circle btn-default">Cancelar</button>
					<button type="submit" id="btn_guardar_banco" class="btn btn-circle green">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END MODAL NUEVO BANCO -->

<!-- BEGIN MODAL EDITAR BANCO-->
<div id="ajax_editar_banco" class="modal container fade" role="basic" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
		<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
		<span>Cargando... </span>
	</div>
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<!-- END MODAL EDITAR BANCO -->