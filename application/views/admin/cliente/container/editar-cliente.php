
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title"><?php echo $cliente->razon_social ?> - <small>Gestionar Clientes</small></h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!--BEGIN TABS-->
						<div class="tabbable-line tabbable-full-width">
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
									<!-- BEGIN Portlet PORTLET-->
									<div class="portlet light">
										<div class="portlet-title">
											<div class="caption">
												<i class="icon-puzzle font-red-flamingo"></i>
												<span class="caption-subject bold font-red-flamingo uppercase">
												Información básica </span>
											</div>
											<div class="actions">
												<input type="checkbox" class="make-switch" id-cliente="<?php echo $cliente->id ?>" data-on-text="&nbsp;Activo&nbsp;" data-off-text="&nbsp;Inactivo&nbsp;&nbsp;&nbsp;" data-on-color="success" data-off-color="danger" <?php echo ($cliente->activo == '1') ? "checked" : ""?>>
												<div class="clear-fix"></div>
											</div>
										</div>
										<div class="portlet-body form-horizontal">
											<!-- BEGIN FORM-->
											<form  action="<?php echo site_url('cliente/editar') ?>" id="form-basica-cliente" accept-charset="utf-8">
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
														<h4><strong>Datos de la Empresa</strong></h4>
														<!-- Razon Social -->
														<div class="form-group">
															<label class="col-md-4 control-label">
																Razón Social<span class="required" aria-required="true">*</span>
															</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-asterisk"></i>
																	<input type="hidden" class="form-control" name="id_cliente" value="<?php echo $cliente->id ?>">
																	<input type="text" class="form-control" placeholder="Razón Social" name="razon_social" value="<?php echo $cliente->razon_social ?>">
																</div>
															</div>
														</div>
														<!-- Rfc -->
														<div class="form-group">
															<label class="col-md-4 control-label">
																R.F.C.<span class="required" aria-required="true">*</span>
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
														<!-- Tipo -->
														<div class="form-group">
															<label class="control-label col-md-4">Tipo : </label>
															<div class="col-md-8">
																<select class="form-control" name="tipo">
																	<option value="normal" <?php echo ($cliente->tipo=="normal")? 'selected':'' ?>>Normal</option>
																	<option value="distribuidor" <?php echo ($cliente->tipo=="distribuidor")? 'selected':'' ?>>Distribuidor</option>
																</select>
															</div>
														</div>

														<hr>

														<!-- TELEFONOS -->
														<h4><strong>Teléfonos</strong></h4>
														<!-- Telefono 1 -->
														<div class="form-group">
															<label class="col-md-4 control-label">
																Teléfono 1<span class="required" aria-required="true">*</span>
															</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-phone"></i>
																	<input type="text" class="form-control" id="telefono1" placeholder="(999) 999-9999" name="telefono1" value="<?php echo $cliente->telefono1 ?>">
																</div>
															</div>
														</div>
														<!-- Telefono 2 -->
														<div class="form-group">
															<label class="col-md-4 control-label">Teléfono 2</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-phone"></i>
																	<input type="text" class="form-control" id="telefono2" placeholder="(999) 999-9999" name="telefono2" value="<?php echo $cliente->telefono2 ?>">
																</div>
															</div>
														</div>
														<hr>
														<!-- Acceso al sistema -->
														<h4><strong>Acceso al sistema</strong></h4>
														<!-- Usuario -->
														<div class="form-group">
															<label class="col-md-4 control-label">
																Usuario<span class="required" aria-required="true">*</span>
															</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-user"></i>
																	<input type="text" class="form-control" id="usuario" placeholder="Nombre de usuario" name="usuario" value="<?php echo $cliente->usuario ?>">
																</div>
															</div>
														</div>
														<!-- Contraseña -->
														<div class="form-group">
															<label class="col-md-4 control-label">
																Contraseña<span class="required" aria-required="true">*</span>
															</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-lock"></i>
																	<input type="text" class="form-control" id="password" placeholder="Contraseña" name="password" value="<?php echo $cliente->password ?>">
																</div>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<!-- INFORMACION DEL DOMICILIO -->
														<h4><strong>Domicilio</strong></h4>
														<!-- Calle -->
														<div class="form-group">
															<label class="col-md-4 control-label">
																Calle<span class="required" aria-required="true">*</span>
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
															<label class="col-md-4 control-label">
																Colonia<span class="required" aria-required="true">*</span>
															</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-map-marker"></i>
																	<input type="text" class="form-control" placeholder="Colonia" name="colonia" value="<?php echo $cliente->colonia ?>">
																</div>
															</div>
														</div>
														<!-- Codigo Postal -->
														<div class="form-group">
															<label class="col-md-4 control-label">
																Código Postal<span class="required" aria-required="true">*</span>
															</label>
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
														<div class="form-group" id="div_estado">
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
															<label class="col-md-4 control-label">
																País<span class="required" aria-required="true">*</span>
															</label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-map-marker"></i>
																	<select class="form-control" name="pais" id="pais">
																		<option value="México" <?php echo ($cliente->pais=="México")? "selected":"" ?>>México</option>
																		<option value="Estados Unidos" <?php  echo ($cliente->pais=="Estados Unidos")? "selected":"" ?>>Estados Unidos</option>
																	</select>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="form-actions fluid">
													<div class="row">
														<div class="col-md-12">
															<hr>
															<div class="col-md-offset-10 col-md-2">
																<button type="submit" class="btn btn-circle btn-lg green"><i class="fa fa-save"></i> Guardar</button>
															</div>
														</div>
													</div>
												</div>
											</form>
											<!-- END FORM-->
										</div>
									</div>
									<!-- END GRID PORTLET-->
								</div>

								<!-- Contactos -->
								<div class="tab-pane" id="contactos">
									<!-- BEGIN TABLA CONTACTOS -->
									<div class="portlet light">
										<div class="portlet-title">
											<div class="caption">
												<i class="icon-puzzle font-red-flamingo"></i>
												<span class="caption-subject bold font-red-flamingo uppercase">
												Contáctos </span>
											</div>
											<div class="actions">
												<a class="btn btn-circle green"  data-toggle="modal" href="#nuevo_contacto_form">
													<i class="fa fa-plus"></i> Agregar
												</a>
											</div>
										</div>
										<div class="portlet-body">
											<table class="table table-striped table-hover table-bordered" id="tabla_contactos" id-cliente="<?php echo $cliente->id ?>">
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
														<tr class="odd gradeX" id="<?php echo $contacto->id ?>">
															<td><?php echo $contacto->nombre_contacto ?></td>
															<td><?php echo $contacto->apellido_paterno ?></td>
															<td><?php echo $contacto->apellido_materno ?></td>
															<td><?php echo $contacto->email_contacto ?></td>
															<td><?php echo $contacto->telefono_contacto ?></td>
															<td><?php echo $contacto->puesto_contacto ?></td>
															<td width="1%"><a href="<?php echo site_url('cliente/contacto/'.$contacto->id) ?>" data-target="#ajax_form_contacto" data-toggle="modal" class="btn btn-circle blue btn-xs"><i class="fa fa-search-plus"></i> Ver/Editar</button></td>
															<td width="1%"><button type="button" class="btn btn-circle red btn-xs eliminar-contacto"><i class="fa fa-trash-o"></i> Eliminar</button></td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>
										</div>
									</div>
									<!-- END TABLA CONTACTOS -->
								</div>

								<!--Sistemas-->
								<div class="tab-pane" id="sistemas">
									<!-- BEGIN TABLA SIATEMAS CONTPAQI -->
									<div class="portlet light">
										<div class="portlet-title">
											<div class="caption">
												<i class="icon-puzzle font-red-flamingo"></i>
												<span class="caption-subject bold font-red-flamingo uppercase">
												Sistemas CONTPAQi® </span>
											</div>
											<div class="actions">
												<a class="btn btn-circle green"  data-toggle="modal" href="#nuevo_sistema_form">
													<i class="fa fa-plus"></i> Agregar
												</a>
											</div>
										</div>
										<div class="portlet-body">
											<table class="table table-striped table-hover table-bordered" id="tabla_sistemas_cliente" id-cliente="<?php echo $cliente->id ?>">
												<thead>
													<tr>
														<th>Sistema</th>
														<th>Versión</th>
														<th>Número de Serie</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($sistemas_contpaqi_cliente as $sistema) : ?>
														<tr id="<?php echo $sistema->id ?>">
															<td><?php echo $sistema->sistema ?></td>
															<td><?php echo $sistema->version ?></td>
															<td><?php echo $sistema->no_serie ?></td>
															<td width="1%"><button type="button" class="btn btn-circle red btn-xs eliminar-sistema"><i class="fa fa-trash-o"></i> Eliminar</button></td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>
										</div>
									</div>
									<!-- END TABLA SIATEMAS CONTPAQI -->
								</div>

								<!--Equipos-->
								<div class="tab-pane" id="equipos">
									<!-- BEGIN TABLA CONTACTOS -->
									<div class="portlet light">
										<div class="portlet-title">
											<div class="caption">
												<i class="icon-puzzle font-red-flamingo"></i>
												<span class="caption-subject bold font-red-flamingo uppercase">
												Equipos de Computo </span>
											</div>
											<div class="actions">
												<a class="btn btn-circle green"  data-toggle="modal" href="#nuevo_equipo_form">
													<i class="fa fa-plus"></i> Agregar
												</a>
											</div>
										</div>
										<div class="portlet-body">
											<table class="table table-striped table-hover table-bordered" id="tabla_equipos_cliente" id-cliente="<?php echo $cliente->id ?>">
												<thead>
													<tr>
														<th>Nombre</th>
														<th>S.O.</th>
														<th>Server</th>
														<th>Management</th>
														<th>Instancia</th>
														<th>Contaseña</th>
														<th></th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($equipos as $equipo) : ?>
														<tr id="<?php echo $equipo->id ?>">
															<td><?php echo $equipo->nombre_equipo ?></td>
															<td><?php echo $equipo->sistema_operativo ?></td>
															<td><?php echo $equipo->sql_server ?></td>
															<td><?php echo $equipo->sql_management ?></td>
															<td><?php echo $equipo->instancia_sql ?></td>
															<td><?php echo $equipo->password_sql ?></td>
															<td width="1%"><a href="<?php echo site_url('cliente/equipo/'.$contacto->id) ?>" data-target="#ajax_form_equipo" data-toggle="modal" class="btn btn-circle blue btn-xs"><i class="fa fa-search"></i> Ver/Editar</button></td>
															<td width="1%"><button type="button" class="btn btn-circle red btn-xs eliminar-equipo"><i class="fa fa-trash-o"></i> Eliminar</button></td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>
										</div>
									</div>
									<!-- END TABLA CONTACTOS -->
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

		<!-- BEGIN VENTANAS MODALES -->

		<!-- CONTACTO -->
		<div id="nuevo_contacto_form" class="modal fade" tabindex="-1" data-backdrop="static" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title"><b>Contácto</b></h3>
						<small> </small>
					</div>
					<form id ="form-contacto-nuevo" method="post" accept-charset="utf-8">
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
										<!-- Nombre(s) -->
										<div class="form-group">
											<label class="col-md-4 control-label">Nombre(s): </label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-user"></i>
													<input type="hidden" class="form-control" name="id_cliente" value="<?php echo $cliente->id ?>">
													<input type="text" class="form-control" placeholder="Nombre(s)" name="nombre_contacto">
												</div>
											</div>
										</div>
										<!-- Apellido paterno -->
										<div class="form-group">
											<label class="col-md-4 control-label">Apellido paterno: </label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-user"></i>
													<input type="text" class="form-control" placeholder="Apellido paterno" name="apellido_paterno">
												</div>
											</div>
										</div>
										<!-- Apellido materno -->
										<div class="form-group">
											<label class="col-md-4 control-label">Apellido materno: </label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-user"></i>
													<input type="text" class="form-control" placeholder="Apellido materno" name="apellido_materno">
												</div>
											</div>
										</div>
										<!-- Email -->
										<div class="form-group">
											<label class="col-md-4 control-label">Email: </label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-envelope"></i>
													<input type="text" class="form-control" placeholder="Email" name="email_contacto">
												</div>
											</div>
										</div>
										<!-- Teléfono -->
										<div class="form-group">
											<label class="col-md-4 control-label">Teléfono: </label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-phone"></i>
													<input type="text" class="form-control telefono_contacto" placeholder="Teléfono" name="telefono_contacto">
												</div>
											</div>
										</div>
										<!-- Puesto -->
										<div class="form-group">
											<label class="col-md-4 control-label">Puesto: </label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-certificate"></i>
													<input type="text" class="form-control" placeholder="Puesto" name="puesto_contacto">
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
							<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
							<button type="submit" id="btn_guardar_equipo" class="btn green">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--DOC: Aplly "modal-cached" class after "modal" class to enable ajax content caching-->
		<div id="ajax_form_contacto" class="modal container fade" role="basic" aria-hidden="true">
			<div class="page-loading page-loading-boxed">
				<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
				<span>Loading... </span>
			</div>
			<div class="modal-dialog">
				<div class="modal-content">
				</div>
			</div>
		</div>
		<!-- /.modal -->

		<!-- SISTEMAS -->
		<div id="nuevo_sistema_form" class="modal fade" tabindex="-1" data-backdrop="static" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title"><b>Sistema</b></h3>
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
												Sistema
											</label>
											<div class="col-md-8">
												<input type="hidden" class="form-control" name="id_cliente" value="<?php echo $cliente->id ?>">
												<div class="input-icon">
													<i class="fa fa-info"></i>
													<select class="form-control" name="sistema" id="select_sistemas">
														<option value=""></option>
														<?php foreach ($sistemas_contpaqi as $sistema): ?>
														<option value="<?php echo $sistema->sistema?>"><?php echo $sistema->sistema ?></option>
														<?php endforeach ?>
													</select>
												</div>
											</div>
										</div>
										<!-- Version -->
										<div class="form-group">
											<label class="col-md-4 control-label">Versión</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-history"></i>
													<select class="form-control" name="version" id="select_versiones">
													</select>
												</div>
											</div>
										</div>
										<!-- No. Serie -->
										<div class="form-group">
											<label class="col-md-4 control-label">No. Serie: </label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-user"></i>
													<input type="text" class="form-control" placeholder="No. Serie" name="no_serie" value="">
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
							<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
							<button type="submit" id="btn_guardar_equipo" class="btn green">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /.modal -->

		<!-- EQUIPO -->
		<div id="nuevo_equipo_form" class="modal fade bs-modal-lg" tabindex="-1" data-backdrop="static" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title"><b>Equipo</b></h3>
						<small> </small>
					</div>
					<form id ="form-equipo-nuevo" method="post" accept-charset="utf-8">
						<div class="modal-body form-horizontal">
							<div class="col-md-12">
								<!-- DIV ERROR -->
								<div class="alert alert-danger  display-hide">
									<button class="close" data-close="alert"></button>
									Tienes errores en tu formulario
								</div>
								<!-- BEGIN FORM BODY -->
								<div class="form-body">
									<div class="col-md-6">
										<!-- Nombre del equipo -->
										<div class="form-group">
											<label class="col-md-4 control-label">Nombre del Equipo</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-desktop"></i>
													<input type="hidden" class="form-control" name="id_cliente" value="<?php echo $cliente->id ?>">
													<input type="text" class="form-control" placeholder="Nombre del Equipo" name="nombre_equipo">
												</div>
											</div>
										</div>
										<!-- Sistema Operativo -->
										<div class="form-group">
											<label class="col-md-4 control-label">
												Sistema Operativo
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-windows"></i>
													<select class="form-control" name="sistema_operativo">
														<option value=""></option>
														<?php foreach ($sistemas_operativos as $operativo): ?>
															<option value="<?php echo $operativo->sistema_operativo ?>"><?php echo $operativo->sistema_operativo ?></option>
														<?php endforeach ?>
													</select>
												</div>
											</div>
										</div>
										<!-- Arquitectura -->
										<div class="form-group">
											<label class="col-md-4 control-label">
												Arquitectura
											</label>
											<div class="col-md-8">
												<div class="radio-list">
													<label class="radio-inline">
														<input type="radio" name="arquitectura" id="arquitectura1" value="x64">
														x64 (64 bits)
													</label>
													<label class="radio-inline">
														<input type="radio" name="arquitectura" id="arquitectura2" value="x86">
														x86 (32 bits)
													</label>
												</div>
											</div>
										</div>
										<!-- Maquina Virtual -->
										<div class="form-group">
											<label class="col-md-4 control-label">
												Máquina Virtual
											</label>
											<div class="col-md-8">
												<div class="radio-list">
													<label class="radio-inline">
														<input type="radio" name="maquina_virtual" id="maquina_virtual1" value="Si">
														Sí
													</label>
													<label class="radio-inline">
														<input type="radio" name="maquina_virtual" id="maquina_virtual2" value="No">
														No
													</label>
												</div>
											</div>
										</div>
										<!-- Memoria RAM -->
										<div class="form-group">
											<label class="col-md-4 control-label">
												Memoria RAM (GB)
											</label>
											<div class="col-md-8">
												<div id="memoria-ram">
													<div class="input-group input-small">
														<input type="text" class="spinner-input form-control" maxlength="2" name="memoria_ram">
														<div class="spinner-buttons input-group-btn btn-group-vertical">
															<button type="button" class="btn spinner-up btn-xs">
																<i class="fa fa-angle-up"></i>
															</button>
															<button type="button" class="btn spinner-down btn-xs">
																<i class="fa fa-angle-down"></i>
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<!-- SQL Server -->
										<div class="form-group">
											<label class="col-md-4 control-label">
												SQL Server
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-database"></i>
													<select class="form-control" name="sql_server">
														<option value=""></option>
														<option value="SQL Server 2005">SQL Server 2005</option>
														<option value="SQL Server 2008">SQL Server 2008</option>
														<option value="SQL Server 2008 R2">SQL Server 2008 R2</option>
														<option value="SQL Server 2012">SQL Server 2012</option>
														<option value="SQL Server 2014">SQL Server 2014</option>
													</select>
												</div>
											</div>
										</div>
										<!-- SQL server management -->
										<div class="form-group">
											<label class="col-md-4 control-label">
												SQL Server Management
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-database"></i>
													<select class="form-control" name="sql_management">
														<option value=""></option>
														<option value="2005">2005</option>
														<option value="2008">2008</option>
														<option value="2008 R2">2008 R2</option>
														<option value="2012">2012</option>
														<option value="2014">2014</option>
													</select>
												</div>
											</div>
										</div>
										<!-- Instalcia SQL -->
										<div class="form-group">
											<label class="col-md-4 control-label">Instancia SQL</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa  fa-database"></i>
													<input type="text" class="form-control" placeholder="Instancia SQL" name="instancia_sql">
												</div>
											</div>
										</div>
										<!-- Contraseña SQL -->
										<div class="form-group">
											<label class="col-md-4 control-label">Contraseña SQL</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa  fa-database"></i>
													<input type="text" class="form-control" placeholder="Contraseña SQL" name="password_sql">
												</div>
											</div>
										</div>
										<!-- Observaciones Generales -->
										<div class="form-group">
											<label class="col-md-4 control-label">Observaciones</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-eye"></i>
													<textarea name="observaciones" class="form-control" placeholder="Observaciones del equipo" class="form-control"></textarea>
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
							<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
							<button type="submit" id="btn_guardar_equipo" class="btn green">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--DOC: Aplly "modal-cached" class after "modal" class to enable ajax content caching-->
		<div id="ajax_form_equipo" class="modal fade bs-modal-lg" role="basic" aria-hidden="true">
			<div class="page-loading page-loading-boxed">
				<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
				<span>Loading... </span>
			</div>
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
				</div>
			</div>
		</div>
		<!-- /.modal -->

		<!-- END VENTANAS MODALES -->