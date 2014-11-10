
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Gestionar Ejecutivos - <small><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?></small></h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN TABLA CLIENTES -->
						<div class="portlet box grey">
							<div class="portlet-title">
								<div class="caption" style="color: black">
									<i class="fa fa-building"></i> Ejecutivos
								</div>
								<div class="tools" style="color: black">
									<a href="javascript:;" class="collapse">
									</a>
									<a href="javascript:;" class="reload">
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-hover table-bordered" id="tabla_gestionar_ejecutivos">
									<thead>
										<tr>
											<th>ID</th>
											<th>Primer Nombre</th>
											<th>Apellido Paterno</th>
											<th>Oficina</th>
											<th>Departamento</th>
											<th>Email</th>
											<th>Teléfono</th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($ejecutivos as $ejecutivo) : ?>
											<tr id="<?php echo $ejecutivo->id ?>">
												<td><?php echo $ejecutivo->id ?></td>
												<td><?php echo $ejecutivo->primer_nombre ?></td>
												<td><?php echo $ejecutivo->apellido_paterno ?></td>
												<td><?php echo $ejecutivo->oficina ?></td>
												<td><?php echo $ejecutivo->departamento ?></td>
												<td><?php echo $ejecutivo->email ?></td>
												<td><?php echo $ejecutivo->telefono ?></td>
												<td><a class="edit" href="<?php echo site_url('ejecutivo/gestionar/editar').'/'.$ejecutivo->id?>">Ver/Editar </a></td>
												<td><a class="delete" href="javascript:;">Eliminar </a></td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
								<div class="table-toolbar">
									<div class="btn-group pull-right">
										<a href="<?php echo site_url('ejecutivo/gestionar/nuevo') ?>" class="btn green btn-xs" ><i class="fa fa-plus"></i> Nueva Ejecutivo </a>
									</div>
								</div>
							</div>
						</div>
						<!-- END TABLA CLIENTES -->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->