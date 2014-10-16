		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN STYLE CUSTOMIZER -->
				<div class="theme-panel hidden-xs hidden-sm">
					<div class="toggler">
					</div>
					<div class="toggler-close">
					</div>
					<div class="theme-options">
						<div class="theme-option theme-colors clearfix">
							<span>
							Color </span>
							<ul>
								<li class="color-default current tooltips" data-style="default" data-original-title="Default">
								</li>
								<li class="color-darkblue tooltips" data-style="darkblue" data-original-title="Dark Blue">
								</li>
								<li class="color-blue tooltips" data-style="blue" data-original-title="Blue">
								</li>
								<li class="color-grey tooltips" data-style="grey" data-original-title="Grey">
								</li>
								<li class="color-light tooltips" data-style="light" data-original-title="Light">
								</li>
								<li class="color-light2 tooltips" data-style="light2" data-html="true" data-original-title="Light 2">
								</li>
							</ul>
						</div>
						<div class="theme-option">
							<span>
							Layout </span>
							<select class="layout-option form-control input-small">
								<option value="fluid" selected="selected">Fluid</option>
								<option value="boxed">Boxed</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Header </span>
							<select class="page-header-option form-control input-small">
								<option value="fixed" selected="selected">Fixed</option>
								<option value="default">Default</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Sidebar </span>
							<select class="sidebar-option form-control input-small">
								<option value="fixed">Fixed</option>
								<option value="default" selected="selected">Default</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Sidebar Position </span>
							<select class="sidebar-pos-option form-control input-small">
								<option value="left" selected="selected">Left</option>
								<option value="right">Right</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Footer </span>
							<select class="page-footer-option form-control input-small">
								<option value="fixed">Fixed</option>
								<option value="default" selected="selected">Default</option>
							</select>
						</div>
					</div>
				</div>
				<!-- END STYLE CUSTOMIZER -->

				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title"> Perfil - <small><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?></small></h3>
						<ul class="page-breadcrumb breadcrumb">
							<li class="btn-group">
								<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
								<span>Acciones</span><i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">
									<li>
										<a href="#">Action</a>
									</li>
									<li>
										<a href="#">Another action</a>
									</li>
									<li>
										<a href="#">Something else here</a>
									</li>
									<li class="divider">
									</li>
									<li>
										<a href="#">Separated link</a>
									</li>
								</ul>
							</li>
							<li>
								<i class="fa fa-home"></i>
								<a href="index.html">Inicio</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo site_url('ejecutivo/perfil') ?>">Perfil</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
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
								<li>
									<a href="#acerca_de" data-toggle="tab">
									Acerca de </a>
								</li>
							</ul>
							<div class="tab-content">
								<!-- Vista Rapida -->
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
													<p>
														 <?php echo $usuario_activo['mensaje_personal'] ?>
													</p>
													<hr>
													<div class="portlet box grey">
														<div class="portlet-title">
															<div class="caption" style="color: black;">
																 Datos Básicos
															</div>
															<div class="tools">
																<a class="reload" href="javascript:;">
																</a>
															</div>
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
													<p>
														<a href="#">
														www.mywebsite.com </a>
													</p>
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
														<li>
															<i class="fa fa-star"></i> Top Seller
														</li>
														<li>
															<i class="fa fa-heart"></i> BASE Jumping
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="col-md-9">
											<!--end row-->
											<h1><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['segundo_nombre'].' '.$usuario_activo['apellido_paterno'].' '.$usuario_activo['apellido_materno'] ?></h1>
											<div class="portlet-body">
												<ul class="list-unstyled">
													<li><i class="fa fa-briefcase"></i><strong> <?php echo $usuario_activo['departamento'] ?></strong></li>
												</ul>
											</div>
											<hr>
											<div class="tabbable tabbable-custom tabbable-custom-profile">
												<ul class="nav nav-tabs">
													<li class="active">
														<a href="#tab_1_11" data-toggle="tab">
														Pendientes</a>
													</li>
													<li>
														<a href="#tab_1_22" data-toggle="tab">
														Casos </a>
													</li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane active" id="tab_1_11">
														<div class="portlet-body">
															<table class="table table-striped table-bordered table-advance table-hover" id="pendientes-ejecutivo">
																<thead>
																	<tr>
																		<th>No.</th>
																		<th>Actvidad</th>
																		<th>Empresa</th>
																		<th>Apertura</th>
																		<th>Estatus</th>
																		<th></th>
																	</tr>
																</thead>
																<tbody>
																	<?php foreach ($pendientes_usuario as $pendiente) : ?>
																		<tr class="odd gradeX">
																			<td><?php echo $pendiente->id_pendiente ?></td>
																			<td><?php echo $pendiente->actividad ?></td>
																			<td><?php echo (empty($pendiente->razon_social)) ? '----' : $pendiente->razon_social ?></td>
																			<td><?php echo fecha_completa($pendiente->fecha_origen) ?></td>
																			<td>
																				<?php switch ($pendiente->estatus) {
																					case 1:
																						echo '<p class="btn btn-xs red"> Cancelado </p>';
																					break;
																					case 2:
																						echo '<p class="btn btn-xs default"> Cerrado </p>';
																					break;
																					case 3:
																						echo '<p class="btn btn-xs green"> Pendiente </p>';
																					break;
																				} ?>
																			</td>
																			<td><a class="btn default" id="ajax-pendiente" id-pendiente="<?php echo $pendiente->id_pendiente ?>" data-toggle="modal"> Detalles </a></td>
																		</tr>
																	<?php endforeach ?>
																</tbody>
															</table>
														</div>
													</div>
													<!--tab-pane-->
													<div class="tab-pane" id="tab_1_22">
														<div class="tab-pane active" id="tab_1_1_1">
															<div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
																<ul class="feeds">
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-success">
																						<i class="fa fa-bell-o"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 You have 4 pending tasks. <span class="label label-danger label-sm">
																						Take action <i class="fa fa-share"></i>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 Just now
																			</div>
																		</div>
																	</li>
																	<li>
																		<a href="#">
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-success">
																						<i class="fa fa-bell-o"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New version v1.4 just lunched!
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 20 mins
																			</div>
																		</div>
																		</a>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-danger">
																						<i class="fa fa-bolt"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 Database server #12 overloaded. Please fix the issue.
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 24 mins
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-info">
																						<i class="fa fa-bullhorn"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New order received. Please take care of it.
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 30 mins
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-success">
																						<i class="fa fa-bullhorn"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New order received. Please take care of it.
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 40 mins
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-warning">
																						<i class="fa fa-plus"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New user registered.
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 1.5 hours
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-success">
																						<i class="fa fa-bell-o"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 Web server hardware needs to be upgraded. <span class="label label-inverse label-sm">
																						Overdue </span>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 2 hours
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-default">
																						<i class="fa fa-bullhorn"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New order received. Please take care of it.
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 3 hours
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-warning">
																						<i class="fa fa-bullhorn"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New order received. Please take care of it.
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 5 hours
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-info">
																						<i class="fa fa-bullhorn"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New order received. Please take care of it.
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 18 hours
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-default">
																						<i class="fa fa-bullhorn"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New order received. Please take care of it.
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 21 hours
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-info">
																						<i class="fa fa-bullhorn"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New order received. Please take care of it.
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 22 hours
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-default">
																						<i class="fa fa-bullhorn"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New order received. Please take care of it.
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 21 hours
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-info">
																						<i class="fa fa-bullhorn"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New order received. Please take care of it.
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 22 hours
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-default">
																						<i class="fa fa-bullhorn"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New order received. Please take care of it.
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 21 hours
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-info">
																						<i class="fa fa-bullhorn"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New order received. Please take care of it.
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 22 hours
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-default">
																						<i class="fa fa-bullhorn"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New order received. Please take care of it.
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 21 hours
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-info">
																						<i class="fa fa-bullhorn"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New order received. Please take care of it.
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 22 hours
																			</div>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<!--tab-pane-->
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- Editar -->
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
										<!-- Formulario editar informacion basica -->
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
																		<button type="submit" class="btn green"><i class="fa fa-save"></i> Guardar</button>
																		<button type="reset" class="btn default"><i class="fa fa-eraser"></i> Cancelar</button>
																	</div>
																</div>
															</div>
														</div>
													</form>
												</div>
												<!-- Cambiar Imagen -->
												<div id="cambiar_imagen" class="tab-pane">
													<div class="col-md-4">
														<form action="<?php echo site_url('ejecutivo/edit/img') ?>" id="form-imagen-ejecutivo" method="post" accept-charset="utf-8" enctype="multipart/form-data">
														<div class="form-group">
															<div class="fileinput fileinput-new" data-provides="fileinput">
																<div class="fileinput-new thumbnail" style="width: 300px; height: 300px;">
																	<img src="<?php echo $usuario_activo['ruta_imagenes'].'block.jpg' ?>" alt=""/>
																</div>
																<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 300px;">
																</div>
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
															<button type="submit" class="btn green"><i class="fa fa-save"></i> Guardar</button>
															<button type="reset" class="btn default"><i class="fa fa-eraser"></i> Cancelar</button>
														</div>
													</div>
													</form>
												</div>
												<!-- Usuario y contraseña -->
												<div id="usuario_password" class="tab-pane">
													<form action="<?php echo site_url('ejecutivo/edit/password') ?>" id="form-ejecutivo-password">
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
														</div>
														<hr>
														<div class="form-actions fluid">
															<div class="row">
																<div class="col-md-12">
																	<div class="col-md-offset-2 col-md-10">
																		<button type="submit" class="btn green"><i class="fa fa-save"></i> Guardar</button>
																		<button type="reset" class="btn default"><i class="fa fa-eraser"></i> Cancelar</button>
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
																 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus..
															</td>
															<td>
																<label class="uniform-inline">
																<input type="radio" name="optionsRadios1" value="option1"/>
																Yes </label>
																<label class="uniform-inline">
																<input type="radio" name="optionsRadios1" value="option2" checked/>
																No </label>
															</td>
														</tr>
														<tr>
															<td>
																 Enim eiusmod high life accusamus terry richardson ad squid wolf moon
															</td>
															<td>
																<label class="uniform-inline">
																<input type="checkbox" value=""/> Yes </label>
															</td>
														</tr>
														<tr>
															<td>
																 Enim eiusmod high life accusamus terry richardson ad squid wolf moon
															</td>
															<td>
																<label class="uniform-inline">
																<input type="checkbox" value=""/> Yes </label>
															</td>
														</tr>
														<tr>
															<td>
																 Enim eiusmod high life accusamus terry richardson ad squid wolf moon
															</td>
															<td>
																<label class="uniform-inline">
																<input type="checkbox" value=""/> Yes </label>
															</td>
														</tr>
														</table>
														<!--end profile-settings-->
														<div class="margin-top-10">
															<a href="#" class="btn green">
															Save Changes </a>
															<a href="#" class="btn default">
															Cancel </a>
														</div>
													</form>
												</div>
											</div>
										</div>
										<!--end col-md-9-->
									</div>
								</div>
								<!--Proyectos-->
								<div class="tab-pane" id="proyectos">
									<div class="row">
										<div class="col-md-12">
											<div class="add-portfolio">
												<span>
												502 Items sold this week </span>
												<a href="#" class="btn icn-only green">
												Add a new Project <i class="m-icon-swapright m-icon-white"></i>
												</a>
											</div>
										</div>
									</div>
									<!--end add-portfolio-->
									<div class="row portfolio-block">
										<div class="col-md-5">
											<div class="portfolio-text">
												<img src="../../assets/admin/pages/media/profile/logo_metronic.jpg" alt=""/>
												<div class="portfolio-text-info">
													<h4>Metronic - Responsive Template</h4>
													<p>
														 Lorem ipsum dolor sit consectetuer adipiscing elit.
													</p>
												</div>
											</div>
										</div>
										<div class="col-md-5 portfolio-stat">
											<div class="portfolio-info">
												 Today Sold <span>
												187 </span>
											</div>
											<div class="portfolio-info">
												 Total Sold <span>
												1789 </span>
											</div>
											<div class="portfolio-info">
												 Earns <span>
												$37.240 </span>
											</div>
										</div>
										<div class="col-md-2">
											<div class="portfolio-btn">
												<a href="#" class="btn bigicn-only">
												<span>
												Manage </span>
												</a>
											</div>
										</div>
									</div>
									<!--end row-->
									<div class="row portfolio-block">
										<div class="col-md-5 col-sm-12 portfolio-text">
											<img src="../../assets/admin/pages/media/profile/logo_azteca.jpg" alt=""/>
											<div class="portfolio-text-info">
												<h4>Metronic - Responsive Template</h4>
												<p>
													 Lorem ipsum dolor sit consectetuer adipiscing elit.
												</p>
											</div>
										</div>
										<div class="col-md-5 portfolio-stat">
											<div class="portfolio-info">
												 Today Sold <span>
												24 </span>
											</div>
											<div class="portfolio-info">
												 Total Sold <span>
												660 </span>
											</div>
											<div class="portfolio-info">
												 Earns <span>
												$7.060 </span>
											</div>
										</div>
										<div class="col-md-2 col-sm-12 portfolio-btn">
											<a href="#" class="btn bigicn-only">
											<span>
											Manage </span>
											</a>
										</div>
									</div>
									<!--end row-->
									<div class="row portfolio-block">
										<div class="col-md-5 portfolio-text">
											<img src="../../assets/admin/pages/media/profile/logo_conquer.jpg" alt=""/>
											<div class="portfolio-text-info">
												<h4>Metronic - Responsive Template</h4>
												<p>
													 Lorem ipsum dolor sit consectetuer adipiscing elit.
												</p>
											</div>
										</div>
										<div class="col-md-5 portfolio-stat">
											<div class="portfolio-info">
												 Today Sold <span>
												24 </span>
											</div>
											<div class="portfolio-info">
												 Total Sold <span>
												975 </span>
											</div>
											<div class="portfolio-info">
												 Earns <span>
												$21.700 </span>
											</div>
										</div>
										<div class="col-md-2 portfolio-btn">
											<a href="#" class="btn bigicn-only">
											<span>
											Manage </span>
											</a>
										</div>
									</div>
									<!--end row-->
								</div>
								<!--Acerda de-->
								<div class="tab-pane" id="acerca_de">
									<div class="row">
										<div class="col-md-3">
											<ul class="ver-inline-menu tabbable margin-bottom-10">
												<li class="active">
													<a data-toggle="tab" href="#tab_1">
													<i class="fa fa-briefcase"></i> General Questions </a>
													<span class="after">
													</span>
												</li>
												<li>
													<a data-toggle="tab" href="#tab_2">
													<i class="fa fa-group"></i> Membership </a>
												</li>
												<li>
													<a data-toggle="tab" href="#tab_3">
													<i class="fa fa-leaf"></i> Terms Of Service </a>
												</li>
												<li>
													<a data-toggle="tab" href="#tab_1">
													<i class="fa fa-info-circle"></i> License Terms </a>
												</li>
												<li>
													<a data-toggle="tab" href="#tab_2">
													<i class="fa fa-tint"></i> Payment Rules </a>
												</li>
												<li>
													<a data-toggle="tab" href="#tab_3">
													<i class="fa fa-plus"></i> Other Questions </a>
												</li>
											</ul>
										</div>
										<div class="col-md-9">
											<div class="tab-content">
												<div id="tab_1" class="tab-pane active">
													<div id="accordion1" class="panel-group">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
																1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
																</h4>
															</div>
															<div id="accordion1_1" class="panel-collapse collapse in">
																<div class="panel-body">
																	 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_2">
																2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
																</h4>
															</div>
															<div id="accordion1_2" class="panel-collapse collapse">
																<div class="panel-body">
																	 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
																</div>
															</div>
														</div>
														<div class="panel panel-success">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_3">
																3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
																</h4>
															</div>
															<div id="accordion1_3" class="panel-collapse collapse">
																<div class="panel-body">
																	 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
																</div>
															</div>
														</div>
														<div class="panel panel-warning">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_4">
																4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
																</h4>
															</div>
															<div id="accordion1_4" class="panel-collapse collapse">
																<div class="panel-body">
																	 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
																</div>
															</div>
														</div>
														<div class="panel panel-danger">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_5">
																5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
																</h4>
															</div>
															<div id="accordion1_5" class="panel-collapse collapse">
																<div class="panel-body">
																	 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_6">
																6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
																</h4>
															</div>
															<div id="accordion1_6" class="panel-collapse collapse">
																<div class="panel-body">
																	 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_7">
																7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
																</h4>
															</div>
															<div id="accordion1_7" class="panel-collapse collapse">
																<div class="panel-body">
																	 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
																</div>
															</div>
														</div>
													</div>
												</div>
												<div id="tab_2" class="tab-pane">
													<div id="accordion2" class="panel-group">
														<div class="panel panel-warning">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_1">
																1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
																</h4>
															</div>
															<div id="accordion2_1" class="panel-collapse collapse in">
																<div class="panel-body">
																	<p>
																		 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
																	</p>
																	<p>
																		 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-danger">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_2">
																2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
																</h4>
															</div>
															<div id="accordion2_2" class="panel-collapse collapse">
																<div class="panel-body">
																	 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
																</div>
															</div>
														</div>
														<div class="panel panel-success">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_3">
																3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
																</h4>
															</div>
															<div id="accordion2_3" class="panel-collapse collapse">
																<div class="panel-body">
																	 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_4">
																4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
																</h4>
															</div>
															<div id="accordion2_4" class="panel-collapse collapse">
																<div class="panel-body">
																	 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_5">
																5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
																</h4>
															</div>
															<div id="accordion2_5" class="panel-collapse collapse">
																<div class="panel-body">
																	 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_6">
																6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
																</h4>
															</div>
															<div id="accordion2_6" class="panel-collapse collapse">
																<div class="panel-body">
																	 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_7">
																7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
																</h4>
															</div>
															<div id="accordion2_7" class="panel-collapse collapse">
																<div class="panel-body">
																	 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
																</div>
															</div>
														</div>
													</div>
												</div>
												<div id="tab_3" class="tab-pane">
													<div id="accordion3" class="panel-group">
														<div class="panel panel-danger">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_1">
																1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
																</h4>
															</div>
															<div id="accordion3_1" class="panel-collapse collapse in">
																<div class="panel-body">
																	<p>
																		 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
																	</p>
																	<p>
																		 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
																	</p>
																	<p>
																		 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-success">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_2">
																2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
																</h4>
															</div>
															<div id="accordion3_2" class="panel-collapse collapse">
																<div class="panel-body">
																	 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_3">
																3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
																</h4>
															</div>
															<div id="accordion3_3" class="panel-collapse collapse">
																<div class="panel-body">
																	 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_4">
																4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
																</h4>
															</div>
															<div id="accordion3_4" class="panel-collapse collapse">
																<div class="panel-body">
																	 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_5">
																5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
																</h4>
															</div>
															<div id="accordion3_5" class="panel-collapse collapse">
																<div class="panel-body">
																	 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_6">
																6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
																</h4>
															</div>
															<div id="accordion3_6" class="panel-collapse collapse">
																<div class="panel-body">
																	 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_7">
																7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
																</h4>
															</div>
															<div id="accordion3_7" class="panel-collapse collapse">
																<div class="panel-body">
																	 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--END TABS-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->