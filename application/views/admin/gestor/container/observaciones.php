
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
						<div class="col-md-2">
						</div>
						<div class="col-md-8">
							<div class="portlet box grey">
								<div class="portlet-title">
									<div class="caption" style="color: black">
										<i class="fa fa-windows"></i> Observaciones
									</div>
									<div class="tools" style="color: black">
										<a href="javascript:;" class="collapse">
										</a>
										<a href="javascript:;" class="reload">
										</a>
									</div>
								</div>
								<div class="portlet-body">
									<table class="table table-striped table-hover table-bordered" id="tabla_observaciones_editable">
										<thead>
											<tr>
												<th>Descripcion</th>
												<th></th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($observaciones as $observacion): ?>
												<tr id="<?php echo $observacion->id_observacion?>">
													<td><?php echo $observacion->descripcion ?></td>
													<td><a class="edit" href="javascript:;">Editar </a></td>
													<td><a class="delete" href="javascript:;">Eliminar </a></td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
									<div class="table-toolbar">
										<div class="btn-group pull-right">
											<button id="tabla_observaciones_editable_new" class="btn green btn-xs">
												<i class="fa fa-plus"></i> Nuevo observacion
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2">
						</div>
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->
