
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
							COLOR </span>
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
						<h3 class="page-title">Blank Page <small>blank page</small></h3>
						<ul class="page-breadcrumb breadcrumb">
							<li class="btn-group">
								<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
								<span>Actions</span><i class="fa fa-angle-down"></i>
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
								<a href="<?php echo site_url() ?>">Inicio</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Pagina</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Seccion</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!--?php var_dump($this->data) ?-->
						<!--BEGIN TABS-->
						<div class="tabbable tabbable-custom tabbable-full-width">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#basica" data-toggle="tab">
									Información Básica</a>
								</li>
								<li>
									<a href="#contactos" data-toggle="tab">
									Contactos </a>
								</li>
								<li>
									<a href="#sistemas" data-toggle="tab">
									Sistemas <strong>CONTPAQi®</strong> </a>
								</li>
								<li>
									<a href="#equipos" data-toggle="tab">
									Equipos de Computo</a>
								</li>
							</ul>
							<div class="tab-content">

								<!-- Información Básica -->
								<div class="tab-pane active" id="basica">
									<!-- BEGIN INFORMACION BASICA -->
									<div class="portlet gren">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-gift"></i>Información básica
											</div>
										</div>
										<div class="portlet-body form-horizontal">
											<!-- BEGIN FORM-->
											<form  action="<?php echo site_url('') ?>" id="form-basica-cliente" accept-charset="utf-8">
												<div class="form-body">
													<!-- DIV ERROR -->
													<div class="alert alert-danger display-hide">
														<button class="close" data-close="alert"></button>
														Tienes Errores en tu formulario
													</div>
													<div class="alert alert-success display-hide">
														<button class="close" data-close="alert"></button>
														Exito en el formulario
													</div>
													<!-- INFORMACION BASICA -->
													<div class="col-md-6">
														<h4>Datos de la Empresa</h4>
														<!-- Razon Social -->
														<div class="form-group">
															<label class="col-md-4 control-label">
																Razón Social
																<span class="required" aria-required="true">*</span>
															</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-asterisk"></i>
																	<input type="text" class="form-control" placeholder="Razón Social" name="razon_social" value="<?php echo $cliente->razon_social ?>">
																</div>
															</div>
														</div>
														<!-- Rfc -->
														<div class="form-group">
															<label class="col-md-4 control-label">
																R.F.C.
																<span class="required" aria-required="true">*</span>
															</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-barcode"></i>
																	<input type="text" class="form-control" placeholder="R.F.C." name="rfc" value="<?php echo $cliente->rfc ?>">
																</div>
															</div>
														</div>
														<!-- Email -->
														<div class="form-group">
															<label class="col-md-4 control-label">
																Email<span class="required" aria-required="true">*</span>
															</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa  fa-envelope"></i>
																	<input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $cliente->email ?>">
																</div>
															</div>
														</div>

														<hr>

														<!-- TELEFONOS -->
														<h4>Teléfonos</h4>
														<!-- Telefono 1 -->
														<div class="form-group">
															<label class="col-md-4 control-label">
																Teléfono 1<span class="required" aria-required="true">*</span>
															</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-phone"></i>
																	<input type="text" class="form-control" id="telefono_1" placeholder="(999) 999-9999" name="telefono1" value="<?php echo $cliente->telefono1 ?>">
																</div>
															</div>
														</div>
														<!-- Telefono 2 -->
														<div class="form-group">
															<label class="col-md-4 control-label">Teléfono 2</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-phone"></i>
																	<input type="text" class="form-control" id="telefono_2" placeholder="(999) 999-9999" name="telefono2" value="<?php echo $cliente->telefono2 ?>">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<!-- INFORMACION DEL DOMICILIO -->
														<h4>Domicilio</h4>
														<!-- Calle -->
														<div class="form-group">
															<label class="col-md-4 control-label">
																Calle
																<span class="required" aria-required="true">*</span>
															</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-map-marker"></i>
																	<input type="text" class="form-control" placeholder="Calle" name="calle" value="<?php echo $cliente->calle ?>">
																</div>
															</div>
														</div>
														<!-- No Exterior -->
														<div class="form-group">
															<label class="col-md-4 control-label">
																No. Exterior
																<span class="required" aria-required="true">*</span>
															</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-map-marker"></i>
																	<input type="text" class="form-control" placeholder="No. Exterior" name="no_exterior" value="<?php echo $cliente->no_exterior ?>">
																</div>
															</div>
														</div>
														<!-- No Interior -->
														<div class="form-group">
															<label class="col-md-4 control-label">No. Interior</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-map-marker"></i>
																	<input type="text" class="form-control" placeholder="No. Interior" name="no_interior" value="<?php echo $cliente->no_interior ?>">
																</div>
															</div>
														</div>
														<!-- Colonia -->
														<div class="form-group">
															<label class="col-md-4 control-label">Colonia</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-map-marker"></i>
																	<input type="text" class="form-control" placeholder="Colonia" name="colonia" value="<?php echo $cliente->colonia ?>">
																</div>
															</div>
														</div>
														<!-- Codigo Postal -->
														<div class="form-group">
															<label class="col-md-4 control-label">Código Postal</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-map-marker"></i>
																	<input type="text" class="form-control" id="codigo_postal_mask" placeholder="99999" name="codigo_postal" value="<?php echo $cliente->codigo_postal ?>">
																</div>
															</div>
														</div>
														<!-- Ciudad -->
														<div class="form-group">
															<label class="col-md-4 control-label">
																Ciudad<span class="required" aria-required="true">*</span>
															</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-map-marker"></i>
																	<input type="text" class="form-control" placeholder="Ciudad" name="ciudad" value="<?php echo $cliente->ciudad ?>">
																</div>
															</div>
														</div>
														<!-- Municipio -->
														<div class="form-group">
															<label class="col-md-4 control-label">Municipio</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-map-marker"></i>
																	<input type="text" class="form-control" placeholder="Municipio" name="municipio" value="<?php echo $cliente->municipio ?>">
																</div>
															</div>
														</div>
														<!-- Estado -->
														<div class="form-group">
															<label class="col-md-4 control-label">Estado</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-map-marker"></i>
																	<select class="form-control" name="estado" id="estado">
																		<option value="<?php echo $cliente->estado ?>"><?php echo $cliente->estado ?></option>
																		<?php foreach ($this->estados as $estado): ?>
																			<?php if ($cliente->estado!=$estado): ?>
																				<option value="<?php echo $estado ?>"><?php echo $estado ?></option>
																			<?php endif ?>
																		<?php endforeach ?>
																	</select>
																</div>
															</div>
														</div>
														<!-- Pais -->
														<div class="form-group">
															<label class="col-md-4 control-label">País</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-map-marker"></i>
																	<select class="form-control" name="pais" id="pais">
																		<option value="Estados Unidos" <?php  echo ($cliente->pais=="México")? "selected":"" ?>>Estados Unidos</option>
																		<option value="México" <?php echo ($cliente->pais=="México")? "selected":"" ?>>México</option>
																	</select>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="form-actions fluid">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-offset-5 col-md-10">
																<button type="submit" class="btn green"><i class="fa fa-save"></i> Guardar</button>
															</div>
														</div>
													</div>
												</div>
											</form>
											<!-- END FORM-->
										</div>
									</div>
									<!-- END INFORMACION BASICA -->
								</div>

								<!-- Contactos -->
								<div class="tab-pane" id="contactos">
									<!-- BEGIN TABLA CONTACTOS -->
									<div class="portlet box grey">
										<div class="portlet-title">
											<div class="caption" style="color: black">
												<i class="fa fa-users"></i> Contactos
											</div>
											<div class="tools" style="color: black">
												<a href="javascript:;" class="collapse">
												</a>
												<a href="javascript:;" class="reload">
												</a>
											</div>
										</div>
										<div class="portlet-body">
											<table class="table table-striped table-hover table-bordered" id="tabla_contactos_cliente">
												<thead>
													<tr>
														<th>Nombre(s)</th>
														<th>Apellido Paterno</th>
														<th>Apellido Materno</th>
														<th>Email</th>
														<th>Teléfono</th>
														<th>Puesto</th>
														<th></th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($contactos as $contacto) : ?>
														<tr id="<?php echo $contacto->id ?>">
															<td><?php echo $contacto->nombre_contacto ?></td>
															<td><?php echo $contacto->apellido_paterno ?></td>
															<td><?php echo $contacto->apellido_materno ?></td>
															<td><?php echo $contacto->email_contacto ?></td>
															<td><?php echo $contacto->telefono_contacto ?></td>
															<td><?php echo $contacto->puesto_contacto ?></td>
															<td><a class="edit" href="javascript:;">Editar </a></td>
															<td><a class="delete" href="javascript:;">Eliminar </a></td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>
											<br>
											<div class="table-toolbar">
												<div class="btn-group pull-right">
													<button id="tabla_contactos_cliente_new" class="btn green btn-xs">
														<i class="fa fa-plus"></i> Nuevo Contacto
													</button>
												</div>
											</div>
										</div>
									</div>
									<!-- END TABLA CONTACTOS -->
								</div>

								<!--Sistemas-->
								<div class="tab-pane" id="sistemas">
									<!-- BEGIN TABLA SIATEMAS CONTPAQI -->
									<div class="portlet box grey">
										<div class="portlet-title">
											<div class="caption" style="color: black">
												<i class="fa fa-info"></i> Sistemas <strong>CONTPAQi®</strong>
											</div>
											<div class="tools" style="color: black">
												<a href="javascript:;" class="collapse">
												</a>
												<a href="javascript:;" class="reload">
												</a>
											</div>
										</div>
										<div class="portlet-body">
											<table class="table table-striped table-hover table-bordered" id="tabla_sistemas_cliente">
												<thead>
													<tr>
														<th>Sistema</th>
														<th>Versión</th>
														<th>Número de Serie</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($sistemas_contpaqi as $sistema) : ?>
														<tr id="<?php echo $sistema->id ?>">
															<td><?php echo $sistema->sistema ?></td>
															<td><?php echo $sistema->version ?></td>
															<td><?php echo $sistema->no_serie ?></td>
															<td><a class="delete" href="javascript:;">Eliminar </a></td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>
											<div class="table-toolbar">
												<div class="btn-group pull-right">
													<a href="#" class="btn green btn-xs" data-target="#nuevo-sistema" data-toggle="modal"><i class="fa fa-plus"></i> Nueva Sistema </a>
												</div>
											</div>
										</div>
									</div>
									<!-- END TABLA SIATEMAS CONTPAQI -->
								</div>

								<!--Equipos-->
								<div class="tab-pane" id="equipos">
									<!-- BEGIN TABLA EQUIPOS -->
									<div class="portlet box grey">
										<div class="portlet-title">
											<div class="caption" style="color: black">
												<i class="fa fa-desktop"></i> Equipos registrados
											</div>
											<div class="tools" style="color: black">
												<a href="javascript:;" class="collapse">
												</a>
												<a href="javascript:;" class="reload">
												</a>
											</div>
										</div>
										<div class="portlet-body">
											<table class="table table-striped table-hover table-bordered" id="tabla_equipos_cliente">
												<thead>
													<tr>
														<th>Nombre</th>
														<th>Sistema O.</th>
														<th>Bits</th>
														<th>M. Virtual</th>
														<th>RAM</th>
														<th>SQL Server</th>
														<th>SQL Management</th>
														<th>Instancia SQL</th>
														<th>Contaseña SQL</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($equipos as $equipo) : ?>
														<tr id="<?php echo $equipo->id ?>">
															<td><?php echo $equipo->nombre_equipo ?></td>
															<td><?php echo $equipo->sistema_operativo ?></td>
															<td><?php echo $equipo->arquitectura ?></td>
															<td><?php echo $equipo->maquina_virtual ?></td>
															<td><?php echo $equipo->memoria_ram ?></td>
															<td><?php echo $equipo->sql_server ?></td>
															<td><?php echo $equipo->sql_management ?></td>
															<td><?php echo $equipo->instancia_sql ?></td>
															<td><?php echo $equipo->password_sql ?></td>
															<td><a class="delete" href="javascript:;">Eliminar </a></td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>
											<br>
											<div class="table-toolbar">
												<div class="btn-group pull-right">
													<a href="#" class="btn green btn-xs" data-target="#nuevo-equipo" data-toggle="modal"><i class="fa fa-plus"></i> Nueva Equipo </a>
												</div>
											</div>
										</div>
									</div>
									<!-- END TABLA EQUIPOS -->
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
