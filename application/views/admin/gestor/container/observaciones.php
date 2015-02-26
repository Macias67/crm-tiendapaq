<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Observaciones - <small>Gestor General</small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-speech"></i>
								<span class="caption-subject bold uppercase"> Observaciones</span>
							</div>
							<div class="actions">
								<a class="btn btn-circle green btn-xs" id="tabla_observaciones_editable_new" data-toggle="modal"><i class="fa fa-plus"></i> Nueva observación</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-hover table-bordered" id="tabla_observaciones_editable">
								<thead>
									<tr>
										<th>Descripción</th>
										<th></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($observaciones as $observacion): ?>
										<tr id="<?php echo $observacion->id_observacion?>">
											<td><?php echo $observacion->descripcion ?></td>
											<td><a class="btn edit blue btn-circle btn-xs" href="javascript:;"><i class="fa fa-edit"></i> Editar </a></td>
											<td><a class="btn delete red btn-circle btn-xs" href="javascript:;"><i class="fa fa-trash"></i> Eliminar </a></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->