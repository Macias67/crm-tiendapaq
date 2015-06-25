<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<h3 class="page-title"> Perfil - <small><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?></small></h3>
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row profile">
			<div class="col-md-12">
				<!-- Errores de imagen -->
				<?php echo $upload_error ?>
				<?php echo validation_errors() ?>
				<!--BEGIN TABS-->
				<div class="tabbable tabbable-custom tabbable-full-width">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#principal" data-toggle="tab">
							Principal </a>
						</li>
						<li>
							<a href="#editar" data-toggle="tab">
							Editar </a>
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
											<img src="<?php echo $usuario_activo['ruta_imagenes'].'perfil.jpg' ?>" class="img-responsive" alt=""/>
										</li>
									</ul>
									<div class="row">
										<div class="col-md-12 profile-info">
											<h1><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?></h1>
											<p> <?php echo $usuario_activo['mensaje_personal'] ?></p>
											<hr>
											<div class="portlet gren">
												<div class="portlet-title">
													<div class="caption" style="color: black;">Datos Básicos</div>
												</div>
												<div class="portlet-body">
													<ul class="list-unstyled">
														<li><i class="fa fa-cogs"></i><strong> Privilegios</strong> :  <?php echo $usuario_activo['privilegios'] ?></li>
														<li><i class="fa fa-user"></i><strong> Usuario</strong> : <?php echo $usuario_activo['usuario'] ?></li>
														<li><i class="fa fa-envelope"></i><strong> Email</strong>: <?php echo $usuario_activo['email'] ?></li>
														<li><i class="fa fa-phone"></i><strong> Teléfono</strong>: <?php echo $usuario_activo['telefono'] ?></li>
														<li><i class="fa fa-building"></i><strong> Oficina</strong>: <?php echo $usuario_activo['oficina'] ?></li>
														<li><i class="fa fa-briefcase"></i><strong> Departamento</strong>: <?php echo $usuario_activo['departamento'] ?></li>
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
									<h1><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['segundo_nombre'].' '.$usuario_activo['apellido_paterno'].' '.$usuario_activo['apellido_materno'] ?></h1>
									<div class="portlet-body">
										<ul class="list-unstyled">
											<li><i class="fa fa-briefcase"></i><strong> <?php echo $usuario_activo['departamento'] ?></strong></li>
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
														<?php foreach ($pendientes_usuario as $pendiente): ?>
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

						<!-- BEGIN TAB EDITAR -->
						<div class="tab-pane" id="editar">
							<div class="row profile-account">
								<div class="col-md-3">
									<ul class="ver-inline-menu tabbable margin-bottom-10">
										<li class="active">
											<a data-toggle="tab" href="#informacion_general">
											<i class="fa fa-cog"></i> Información General </a>
											<span class="after">
											</span>
										</li>
										<li>
											<a data-toggle="tab" href="#cambiar_imagen">
											<i class="fa fa-picture-o"></i> Cambiar Imagen </a>
										</li>
										<li>
											<a data-toggle="tab" href="#usuario_password">
											<i class="fa fa-lock"></i> Usuario y Contraseña </a>
										</li>
										<li>
											<a data-toggle="tab" href="#otros">
											<i class="fa fa-eye"></i> Otras Opciones </a>
										</li>
									</ul>
								</div>
								<div class="col-md-9">
									<div class="tab-content">
										<!-- Informacion General -->
										<div id="informacion_general" class="tab-pane active">
											<form action="<?php echo site_url('ejecutivo/editar/info-personal') ?>" id="form-ejecutivo-info">
												<!-- DIV ERROR -->
												<div class="alert alert-danger display-hide">
													<button class="close" data-close="alert"></button>
													Tienes Errores en tu formulario
												</div>
												<div class="alert alert-success display-hide">
													<button class="close" data-close="alert"></button>
													Exito en el formulario
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Primer Nombre</label>
														<div class="input-icon">
															<i class="fa fa-user"></i>
															<input type="text" name="primer_nombre" value="<?php echo $usuario_activo['primer_nombre'] ?>" class="form-control"/>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label">Segundo Nombre</label>
														<div class="input-icon">
															<i class="fa fa-user"></i>
															<input type="text" name="segundo_nombre" value="<?php echo $usuario_activo['segundo_nombre'] ?>" class="form-control"/>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label">Apellido Paterno</label>
														<div class="input-icon">
															<i class="fa fa-user"></i>
															<input type="text" name="apellido_paterno" value="<?php echo $usuario_activo['apellido_paterno'] ?>" class="form-control"/>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label">Apellido Materno</label>
														<div class="input-icon">
															<i class="fa fa-user"></i>
															<input type="text" name="apellido_materno" value="<?php echo $usuario_activo['apellido_materno'] ?>" class="form-control"/>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Oficina</label>
														<div class="input-icon">
															<i class="fa fa-building"></i>
															<select class="form-control" name="oficina">
																<option value="<?php echo $usuario_activo['oficina'] ?>"><?php echo $usuario_activo['oficina'] ?></option>
																<?php foreach ($tablaoficinas as $oficina ): ?>
																	<?php if ($usuario_activo['oficina']!=$oficina->ciudad_estado): ?>
																		<option value="<?php echo $oficina->ciudad_estado ?>"><?php echo $oficina->ciudad_estado ?></option>
																	<?php endif ?>
																<?php endforeach ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label">Email</label>
														<div class="input-icon">
															<i class="fa fa-envelope"></i>
															<input type="text" name="email" value="<?php echo $usuario_activo['email'] ?>" class="form-control"/>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label">Telefono</label>
														<div class="input-icon">
															<i class="fa fa-phone"></i>
															<input type="text" name="telefono" value="<?php echo $usuario_activo['telefono'] ?>" id="telefono" class="form-control"/>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label">Departamento</label>
														<div class="input-icon">
															<i class="fa fa-group"></i>
															<select class="form-control" name="departamento">
																<option value="<?php echo $usuario_activo['departamento'] ?>"><?php echo $usuario_activo['departamento'] ?></option>
																<?php foreach ($tabladepartamentos as $departamento ): ?>
																	<?php if ($usuario_activo['departamento']!=$departamento->area): ?>
																		<option value="<?php echo $departamento->area ?>"><?php echo $departamento->area ?></option>
																	<?php endif ?>
																<?php endforeach ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label">Mensaje Personal</label>
														<div class="input-icon">
															<i class="fa fa-heart"></i>
															<textarea name="mensaje_personal" placeholder="Cambia tu mensaje..." class="form-control" style="resize: none" col="4"><?php echo $usuario_activo['mensaje_personal'] ?></textarea>
														</div>
													</div>
												</div>
												<div class="form-actions fluid">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-offset-2 col-md-10">
																<button type="submit" class="btn btn-circle green"><i class="fa fa-save"></i> Guardar</button>
																<button type="reset" class="btn btn-circle default"><i class="fa fa-eraser"></i> Cancelar</button>
															</div>
														</div>
													</div>
												</div>
											</form>
										</div>
										<!-- Cambiar Imagen -->
										<div id="cambiar_imagen" class="tab-pane">
											<form action="<?php echo site_url('ejecutivo/editar/img') ?>" id="form-imagen-ejecutivo" method="post" accept-charset="utf-8" enctype="multipart/form-data">
												<div class="col-md-4">
													<div class="form-group">
														<div class="fileinput fileinput-new" data-provides="fileinput">
															<div class="fileinput-new thumbnail" style="width: 300px; height: 300px;">
																<img src="<?php echo $usuario_activo['ruta_imagenes'].'block.jpg' ?>" alt=""/>
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 300px;"></div>
															<div>
																<span class="btn default btn-file">
																	<span class="fileinput-new">Buscar... </span>
																	<span class="fileinput-exists">Cambiar </span>
																	<input type="file" class="default" name="userfile">
																</span>
																<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">Borrar </a>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-8">
													<h3>Selecciona una foto de perfil</h3>
													<br>
													<ul>
														<li> Resolución mínima 300 x 300 px.</li>
														<li> Resolución máxima 1600 x 1600 px.</li>
														<li> Tamaño mínimo a 10 KB </li>
														<li> Tamaño máximo a 2 MB </li>
														<li> Formato .jpg ó .png </li>
													</ul>
													<br>
													<hr>
													<div class="col-md-12">
														<button type="submit" class="btn btn-circle green"><i class="fa fa-save"></i> Guardar</button>
														<button type="reset" class="btn btn-circle default"></i> Cancelar</button>
													</div>
												</div>
											</form>
										</div>
										<!-- Usuario y contraseña -->
										<div id="usuario_password" class="tab-pane">
											<form action="<?php echo site_url('ejecutivo/editar/password') ?>" id="form-ejecutivo-password">
												<!-- DIV ERROR -->
												<div class="alert alert-danger display-hide">
													<button class="close" data-close="alert"></button>
													Tienes Errores en tu formulario
												</div>
												<div class="alert alert-success display-hide">
													<button class="close" data-close="alert"></button>
													Exito en el formulario
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Usuario actual </label>
														<label class="form-control"  style="margin-top: 0px; border: #FFFFFF;"><strong><?php echo $usuario_activo['usuario'] ?></strong> </label>
														<input type="hidden" name="usuario_actual" value="<?php echo $usuario_activo['usuario'] ?>" class="form-control"/>
													</div>
													<hr>
													<div class="form-group">
														<label class="control-label">Nuevo usuario </label>
														<input type="text" name="usuario_nuevo" placeholder="Nuevo usuario" class="form-control"/>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Contraseña actual</label>
														<input type="password" name="password_actual" class="form-control"/>
													</div>
													<hr>
													<div class="form-group">
														<label class="control-label">Nueva contraseña</label>
														<input type="password" name="password_nuevo_1" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Confirmar nueva contraseña</label>
														<input type="password" name="password_nuevo_2" class="form-control"/>
													</div>
													<br>
													<ul>
														<li> Puedes cambiar de contraseña sin cambiar de usuario</li>
														<li> Cambio de usuario requiere cambio de contraseña, o repetir en los 3 campos la contraseña actual</li>
													</ul>
													<br>
												</div>
												<hr>
												<div class="form-actions fluid">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-offset-2 col-md-10">
																<button type="submit" class="btn btn-circle green"><i class="fa fa-save"></i> Guardar</button>
																<button type="reset" class="btn btn-circle default"></i> Cancelar</button>
															</div>
														</div>
													</div>
												</div>
											</form>
										</div>
										<!-- Otras opciones -->
										<div id="otros" class="tab-pane">
											<form action="#">
												<table class="table table-bordered table-striped">
												<tr>
													<td>
														 Opcion de configuracion 1
													</td>
													<td>
														<label class="uniform-inline">
														<input type="radio" name="optionsRadios1" value="option1"/>
														Si </label>
														<label class="uniform-inline">
														<input type="radio" name="optionsRadios1" value="option2" checked/>
														No </label>
													</td>
												</tr>
												<tr>
													<td>
														 Opcion de configuracion 2
													</td>
													<td>
														<label class="uniform-inline">
														<input type="checkbox" value=""/> Si </label>
													</td>
												</tr>
												<tr>
													<td>
														 Opcion de configuracion 3
													</td>
													<td>
														<label class="uniform-inline">
														<input type="checkbox" value=""/> Si </label>
													</td>
												</tr>
												<tr>
													<td>
														 Opcion de configuracion 4
													</td>
													<td>
														<label class="uniform-inline">
														<input type="checkbox" value=""/> Si </label>
													</td>
												</tr>
												</table>
												<!--end profile-settings-->
												<div class="margin-top-10">
													<a href="#" class="btn btn-circle green">
													Guardar </a>
													<a href="#" class="btn btn-circle default">
													Cancel </a>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!--end col-md-9-->
							</div>
						</div>
						<!-- END TAB EDITAR -->

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