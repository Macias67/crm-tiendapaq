	<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Blank Page <small>blank page</small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN TABLA CASOS-->
				<div class="portlet gren">
					<div class="portlet-title">
						<div class="caption"><i class="fa fa-user"></i>Casos para asignar</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height:400px">
							<table class="table table-striped table-bordered table-hover" id="tabla-cosos-asignar">
								<thead>
									<tr>
										<th>No. Caso</th>
										<th>Cliente</th>
										<th>Fecha de apertura</th>
										<th>Estatus</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($casos_asignacion as $caso ): ?>
										<tr>
											<td><?php echo $caso->id ?></td>
											<td><?php echo $caso->razon_social ?></td>
											<td><?php echo fecha_completa($caso->fecha_inicio) ?></td>
											<td><a class="btn yellow btn-circle btn-xs disabled" href=""><?php echo ucfirst($caso->descripcion) ?></a></td>
											<td>
												<a class="btn blue btn-circle btn-xs" href="#"><i class="fa fa-search"></i> Detalles</a>
												<a class="btn green btn-circle btn-xs" href="#modal_asignar_ejecutivo" data-toggle="modal" ><i class="fa fa-arrow-circle-right"></i> Asignar Lider</a>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- END TABLA CASOS-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->

<!-- SISTEMAS -->
<div id="modal_asignar_ejecutivo" class="modal fade" tabindex="-1" data-backdrop="static" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><b>Asignar caso a ejecutivo</b></h4>
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
										Ejecutivo
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-info"></i>
											<select class="form-control" name="sistema" id="select_sistemas">
												<option value=""></option>
												<?php foreach ($ejecutivos as $ejecutivo): ?>
													<option value="<?php echo $ejecutivo->id?>"><?php echo $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno ?></option>
												<?php endforeach ?>
											</select>
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
					<button type="submit" id="btn_asignar_caso" class="btn btn-circle green">Asignar</button>
				</div>
			</form>
		</div>
	</div>
</div>
