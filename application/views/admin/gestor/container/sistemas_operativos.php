
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Sistemas Operativos - <small>Gestor General</small></h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-3">
						</div>
						<div class="col-md-6">
							<div class="portlet box grey">
								<div class="portlet-title">
									<div class="caption" style="color: black">
										<i class="fa fa-windows"></i> Sistemas Operativos
									</div>
									<div class="tools" style="color: black">
										<a href="javascript:;" class="collapse">
										</a>
										<a href="javascript:;" class="reload">
										</a>
									</div>
								</div>
								<div class="portlet-body">
									<table class="table table-striped table-hover table-bordered" id="tabla_operativos_editable">
										<thead>
											<tr>
												<th>Sistemas</th>
												<th></th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($sistemasoperativos as $sistema): ?>
												<tr id="<?php echo $sistema->id_so ?>">
													<td><?php echo $sistema->sistema_operativo ?></td>
													<td><a class="btn edit blue btn-circle btn-xs" href="javascript:;"><i class="fa fa-edit"></i> Editar</a></td>
													<td><a class="btn delete red btn-circle btn-xs" href="javascript:;"><i class="fa fa-trash"></i> Eliminar</a></td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
									<div class="table-toolbar">
										<div class="btn-group pull-right">
											<button id="tabla_operativos_editable_new" class="btn green btn-xs">
												<i class="fa fa-plus"></i> Nuevo Sistema Operativo
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->
