<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title"> Oficinas y Departamentos - <small> Gestor General</small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN TABLA OFICINAS -->
				<div class="col-md-9">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-building"></i>
								<span class="caption-subject bold uppercase"> Oficinas</span>
							</div>
							<div class="actions">
								<a class="btn btn-circle green btn-xs" href="#modal_nueva_oficina" data-toggle="modal"><i class="fa fa-plus"></i> Nueva oficina</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-hover table-bordered" id="tabla_oficinas_editable">
								<thead>
									<tr>
										<th width="1%">Ciudad</th>
										<th width="5%">Estado</th>
										<th width="10%">Colonia</th>
										<th width="10%">Calle</th>
										<th width="1%">Número</th>
										<th width="20%">Email</th>
										<th width="10%">Teléfono</th>
										<th width="1%"></th>
										<th width="1%"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($oficinas as $oficina) : ?>
										<tr id="<?php echo $oficina->id_oficina ?>" ciudad="<?php echo $oficina->ciudad ?>" estado="<?php echo $oficina->estado ?>">
											<td><?php echo $oficina->ciudad ?></td>
											<td><?php echo $oficina->estado ?></td>
											<td><?php echo $oficina->colonia ?></td>
											<td><?php echo $oficina->calle ?></td>
											<td><?php echo $oficina->numero ?></td>
											<td><?php echo $oficina->email ?></td>
											<td><?php echo $oficina->telefono ?></td>
											<td><a class="btn edit blue btn-circle btn-xs" href="<?php echo site_url('/gestor/oficinas/mostrar/'.$oficina->id_oficina) ?>" data-target="#ajax_editar_oficina" data-toggle="modal"><i class="fa fa-edit"></i> Editar</a></td>
											<td><a class="btn delete red btn-circle btn-xs eliminar-oficina" href="javascript:;"><i class="fa fa-trash"></i> Eliminar</a></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- END TABLA OFICINAS -->

				<!-- BEGIN DEPARTAMENTOS -->
				<div class="col-md-3">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-briefcase"></i>
								<span class="caption-subject bold uppercase"> Departamentos</span>
							</div>
							<div class="actions">
								<button id="tabla_departamentos_editable_new" class="btn btn-circle green btn-xs">
									<i class="fa fa-plus"></i> Nuevo departamento
								</button>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-hover table-bordered" id="tabla_departamentos_editable">
								<thead>
									<tr>
										<th>Departamento</th>
										<th></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($departamentos as $departamento) : ?>
										<tr id="<?php echo $departamento->id_departamento?>">
											<td><?php echo $departamento->area ?></td>
											<td><a class="btn edit blue btn-circle btn-xs"  href="javascript:;"><i class="fa fa-edit"></i></a></td>
											<td><a class="btn delete red btn-circle btn-xs"  href="javascript:;"><i class ="fa fa-trash"></i></a></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- END DEPARTAMENTOS -->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->

<!-- BEGIN MODAL NUEVA OFICINA -->
<div id="modal_nueva_oficina" class="modal fade" tabindex="-1" data-backdrop="static" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><b>Nueva Oficina</b></h3>
				<small> </small>
			</div>
			<form id ="form-nueva-oficina" method="post" accept-charset="utf-8">
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
								<!-- Ciudad -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Ciudad<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" placeholder="Ciudad" name="ciudad">
										</div>
									</div>
								</div>
								<!-- Estado -->
								<div class="form-group" id="div_estado">
									<label class="col-md-4 control-label">
										Estado<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<select class="form-control" name="estado" id="estado">
												<?php foreach ($this->estados as $estado): ?>
													<option value="<?php echo $estado ?>" <?php echo ($estado=='Jalisco')? 'selected':'' ?>><?php echo $estado ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
								</div>
								<!-- Colonia -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Colonia<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" placeholder="Colonia" name="colonia">
										</div>
									</div>
								</div>
								<!-- Calle -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Calle<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" placeholder="Calle" name="calle">
										</div>
									</div>
								</div>
								<!-- Numero -->
								<div class="form-group">
									<label class="col-md-4 control-label">Numero </label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" id="numero" placeholder="Numero" name="numero">
										</div>
									</div>
								</div>
								<!-- Email -->
								<div class="form-group">
									<label class="col-md-4 control-label">Email </label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-envelope"></i>
											<input type="text" class="form-control" placeholder="Email" name="email">
										</div>
									</div>
								</div>
								<!-- Teléfono -->
								<div class="form-group">
									<label class="col-md-4 control-label">Teléfono </label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-phone"></i>
											<input type="text" class="form-control telefono" placeholder="Teléfono" name="telefono">
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
					<button type="submit" id="btn_guardar_oficina" class="btn btn-circle green">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END MODAL NUEVA OFICINA -->

<!-- BEGIN MODAL EDITAR DEPTO -->
<div id="ajax_editar_oficina" class="modal container fade" role="basic" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
		<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
		<span>Cargando... </span>
	</div>
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<!-- END MODAL EDITAR DEPTO -->
