
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Mis casos - <small><?php echo $usuario_activo['razon_social'] ?></small></h3>
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
								<div class="caption"><i class="fa fa-user"></i>Casos de <?php echo $usuario_activo['razon_social'] ?></div>
							</div>
							<div class="portlet-body">
								<div class="scroller" style="height:400px">
									<table class="table table-striped table-bordered table-hover" id="tabla-casos-asignar">
										<thead>
											<tr>
												<th>No. Caso</th>
												<th>Cliente</th>
												<th>Lider</th>
												<th>Fecha de apertura</th>
												<th>Fecha tentativa de cierre</th>
												<th>Estatus</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($casos_cliente as $caso ): ?>
												<tr>
													<td><?php echo $caso->id_caso ?></td>
													<td><?php echo $caso->razon_social ?></td>
													<td><?php echo $caso->primer_nombre.' '.$caso->apellido_paterno ?></td>
													<td><?php echo fecha_completa($caso->fecha_inicio) ?></td>
													<td><?php echo ($caso->fecha_tentativa_cierre== NULL) ? 'Sin fecha de fin':fecha_completa($caso->fecha_tentativa_cierre) ?></td>
													<td>
														<?php switch ($caso->id_estatus_general) {
															case 1:
																echo '<p class="btn btn-circle btn-circle btn-xs red"> Cancelado </p>';
															break;
															case 2:
																echo '<p class="btn btn-circle btn-xs default"> Cerrado </p>';
															break;
															case 3:
																echo '<p class="btn btn-circle btn-xs green"> Pendiente </p>';
															break;
															case 5:
																echo '<p class="btn btn-circle btn-xs yellow"> En Proceso</p>';
															break;
															case 7:
																echo '<p class="btn btn-circle btn-xs green"> Reasignado </p>';
															break;
														} ?>
													</td>
													<td><a class="btn blue btn-circle btn-xs" href="<?php echo site_url('client/casos/detalles/'.$caso->id_caso) ?>"><i class="fa fa-search"></i> Detalles</a></td>
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
