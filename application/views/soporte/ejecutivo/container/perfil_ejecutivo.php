<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<h3 class="page-title"> Perfil - <small><?php echo $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno ?></small></h3>
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row profile">
			<div class="col-md-12">
				<!-- Errores de imagen -->
				<!--BEGIN TABS-->
				<div class="tabbable tabbable-custom tabbable-full-width">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#principal" data-toggle="tab">
							Principal </a>
						</li>
						<li>
							<a href="#proyectos" data-toggle="tab">
							Proyectos </a>
						</li>
					</ul>
					<div class="tab-content">
						<!-- BEGIN TAB PRINCIPAL -->
						<div class="tab-pane active" id="principal">
							<div class="row">
								<div class="col-md-3">
									<ul class="list-unstyled profile-nav">
										<li>
											<img src="<?php echo $ejecutivo->ruta_img_ejecutivo.'perfil.jpg' ?>" class="img-responsive" alt=""/>
										</li>
									</ul>
									<div class="row">
										<div class="col-md-12 profile-info">
											<h1><?php echo $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno ?></h1>
											<p> <?php echo $ejecutivo->mensaje_personal ?></p>
											<hr>
											<div class="portlet gren">
												<div class="portlet-title">
													<div class="caption" style="color: black;">Datos Básicos</div>
												</div>
												<div class="portlet-body">
													<ul class="list-unstyled">
														<li><i class="fa fa-cogs"></i><strong> Privilegios</strong> :  <?php echo $ejecutivo->privilegios ?></li>
														<li><i class="fa fa-user"></i><strong> Usuario</strong> : <?php echo $ejecutivo->usuario ?></li>
														<li><i class="fa fa-envelope"></i><strong> Email</strong>: <?php echo $ejecutivo->email ?></li>
														<li><i class="fa fa-phone"></i><strong> Teléfono</strong>: <?php echo $ejecutivo->telefono ?></li>
														<li><i class="fa fa-building"></i><strong> Oficina</strong>: <?php echo $ejecutivo->oficina ?></li>
														<li><i class="fa fa-briefcase"></i><strong> Departamento</strong>: <?php echo $ejecutivo->departamento ?></li>
													</ul>
												</div>
											</div>
											<p><a href="#">www.facebook.com/usuario </a></p>
											<ul class="list-inline">
												<li>
													<i class="fa fa-map-marker"></i> México
												</li>
												<li>
													<i class="fa fa-calendar"></i> 1992
												</li>
												<li>
													<i class="fa fa-briefcase"></i> Desarrollo
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="col-md-9">
									<h1><?php echo $ejecutivo->primer_nombre.' '.$ejecutivo->segundo_nombre.' '.$ejecutivo->apellido_paterno.' '.$ejecutivo->apellido_materno ?></h1>
									<div class="portlet-body">
										<ul class="list-unstyled">
											<li><i class="fa fa-briefcase"></i><strong> <?php echo $ejecutivo->departamento ?></strong></li>
										</ul>
									</div>
									<hr>
									<!-- BEGIN PANEL PENDIENTES-CASOS -->
									<div class="tabbable tabbable-custom tabbable-custom-profile">
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_pendientes" data-toggle="tab">Pendientes</a>
											</li>
											<li>
												<a href="#tab_casos" data-toggle="tab">Casos </a>
											</li>
										</ul>
										<div class="tab-content">
											<!-- TAB PENDIENTES -->
											<div class="tab-pane active" id="tab_pendientes">
												<table class="table table-striped table-bordered table-hover" id="pendientes-ejecutivo">
													<thead>
														<tr>
															<th>No.</th>
															<th>Actvidad</th>
															<th>Cliente</th>
															<th>Apertura</th>
															<th>Estatus</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($pendientes_ejecutivo as $pendiente): ?>
															<tr class="odd gradeX">
																<td><?php echo $pendiente->id_pendiente ?></td>
																<td><?php echo $pendiente->actividad ?></td>
																<td><?php echo (empty($pendiente->razon_social)) ? '----' : $pendiente->razon_social ?></td>
																<td><?php echo fecha_completa($pendiente->fecha_origen) ?></td>
																<td>
																	<?php switch ($pendiente->id_estatus_general) {
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
																<td>
																	<a class="btn btn-circle blue btn-xs" href="<?php echo site_url('/pendiente/detalles/'.$pendiente->id_pendiente) ?>" data-target="#ajax-detalles-pendiente" data-toggle="modal"><i class="fa fa-search"></i> Detalles </a>
																</td>
															</tr>
														<?php endforeach ?>
													</tbody>
												</table>
											</div>
											<!--TAB CASOS-->
											<div class="tab-pane" id="tab_casos">
												<table class="table table-striped table-bordered table-hover" id="casos-ejecutivo">
													<thead>
														<tr>
															<th>No.</th>
															<th>Cliente</th>
															<th>Apertura</th>
															<th>Vigencia (aprox.)</th>
															<th>Estatus</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($casos as $caso): ?>
															<tr class="odd gradeX">
																<td><?php echo $caso->id_caso ?></td>
																<td><?php echo $caso->razon_social ?></td>
																<td><?php echo fecha_completa($caso->fecha_inicio) ?></td>
																<td><?php echo ($caso->fecha_final=='0000-00-00 00:00:00')? 'Sin fecha de fin':fecha_completa($caso->fecha_final) ?></td>
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
																<td><a class="btn blue btn-circle btn-xs" href="<?php echo site_url('/caso/detalles/'.$caso->id_caso) ?>" data-target="#ajax-detalles-caso" data-toggle="modal"><i class="fa fa-search"></i> Detalles</a></td>
															</tr>
														<?php endforeach ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- END PANEL PENDIENTES-CASOS -->
								</div>
							</div>
						</div>
						<!-- END TAB PRINCIPAL -->

						<!-- BEGIN TAB PROYECTOS -->
						<div class="tab-pane" id="proyectos">
							<div class="row">
								<div class="col-md-12">
									Apartado de Proyectos
								</div>
							</div>
						</div>
						<!-- END TAB PROYECTOS -->
					</div>
				</div>
				<!--END TABS-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->

<!-- BEGIN AJAX DETALLE PENDIENTE -->
<div id="ajax-detalles-pendiente" class="modal fade" role="basic" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
		<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
		<span>Cargando... </span>
	</div>
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<!-- END AJAX DETALLE PENDIENTE -->

<!-- BEGIN AJAX REASIGNACIONES PENDIENTE -->
<div id="ajax-reasignacion-pendiente" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
		<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
		<span>Cargando... </span>
	</div>
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
	</div>
</div>
<!-- END AJAX REASIGNACIONES PENDIENTE -->

<!-- BEGIN DETALLES CASO  MODAL -->
<div id="ajax-detalles-caso" class="modal fade" role="basic" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
		<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
		<span>Cargando... </span>
	</div>
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<!-- END DETALLES CASO  MODAL-->