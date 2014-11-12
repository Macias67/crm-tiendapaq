
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
						<!--?php var_dump($this->data) ?-->
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
												<span class="caption-helper">more samples...</span>
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
												<span class="caption-helper">more samples...</span>
											</div>
											<div class="actions">
												<button class="btn btn-circle green" id="tabla_contactos_cliente_new">
													<i class="fa fa-plus"></i> Agregar
												</button>
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
															<td width="1%"><a href="<?php echo site_url('cliente/contacto/'.$contacto->id) ?>" data-target="#ajax_form_cliente" data-toggle="modal" class="btn btn-circle green btn-xs"><i class="fa fa-search-plus"></i></button></td>
															<td width="1%"><button type="button" class="btn btn-circle red btn-xs eliminar"><i class="fa fa-trash-o"></i></button></td>
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
												<span class="caption-helper">more samples...</span>
											</div>
										</div>
										<div class="portlet-body">
											<table class="table table-striped table-hover table-bordered" id="tabla_sistemas_cliente" idcliente="<?php echo $cliente->id ?>">
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
									<div class="portlet light">
										<div class="portlet-title">
											<div class="caption">
												<i class="icon-puzzle font-red-flamingo"></i>
												<span class="caption-subject bold font-red-flamingo uppercase">
												Equipos de computo </span>
												<span class="caption-helper">more samples...</span>
											</div>
										</div>
										<div class="portlet-body">
											<table class="table table-striped table-hover table-bordered" id="tabla_equipos_cliente">
												<thead>
													<tr>
														<th>Nombre</th>
														<th>S.O.</th>
														<th>Bits</th>
														<th>M. Virtual</th>
														<th>RAM</th>
														<th>Server</th>
														<th>Management</th>
														<th>Instancia</th>
														<th>Contaseña</th>
														<th>Obs.</th>
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
															<td><?php echo $equipo->observaciones ?></td>
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

		<!-- BEGIN VENTANAS MODALES -->

		<!--DOC: Aplly "modal-cached" class after "modal" class to enable ajax content caching-->
		<div class="modal fade" id="ajax_form_cliente" role="basic" aria-hidden="true">
			<div class="page-loading page-loading-boxed">
				<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
				<span>&nbsp;&nbsp;Loading... </span>
			</div>
			<div class="modal-dialog">
				<div class="modal-content">
				</div>
			</div>
		</div>
		<!-- /.modal -->

		<!-- BEGIN NUEVO EQUIPO -->
		<div id="nuevo-equipo" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
			<div class="modal-header">
				<h3 class="modal-title">
					<b>Registrar un equipo de cómputo</b>
				</h3>
				<small> <?php echo $cliente->razon_social ?></small>
			</div>
				<div class="modal-body container">
					<form id ="form-nuevo-equipo" class="form-horizontal" method="post" accept-charset="utf-8">
						<!-- DIV ERROR -->
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							Tienes Errores en tu formulario
						</div>
						<!-- DIV SUCCESS -->
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Exito en el formulario
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
													<option value="Windows XP"><?php echo $operativo->sistema_operativo ?></option>
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
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
					<button type="button" id="btn_guardar_equipo" class="btn green">Guardar</button>
				</div>
		</div>
		<!-- END NUEVO EQUIPO -->

		<!-- BEGIN NUEVO SISTEMA -->
		<div id="nuevo-sistema" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
			<div class="modal-header">
				<h3 class="modal-title">
					<b>Registrar sistema <strong>CONTPAQi®</strong></b>
				</h3>
				<small> <?php echo $cliente->razon_social ?></small>
			</div>
			<form id ="form-nuevo-sistema" method="post" accept-charset="utf-8">
				<div class="modal-body form-horizontal">
					<div>
						<!-- DIV ERROR -->
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							Tienes Errores en tu formulario
						</div>
						<!-- DIV SUCCESS -->
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Exito en el formulario
						</div>
						<!-- BEGIN FORM BODY -->
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">
									Sistema
								</label>
								<div class="col-md-8">
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
								<label class="col-md-3 control-label">Versión</label>
								<div class="col-md-8">
									<div class="input-icon">
										<i class="fa fa-history"></i>
										<select class="form-control" name="version" id="select_versiones">
										</select>
									</div>
								</div>
							</div>
							<!-- No de serie -->
							<div class="form-group">
								<label class="col-md-3 control-label">No. de Serie</label>
								<div class="col-md-8">
									<div class="input-icon">
										<i class="fa fa-barcode"></i>
										<input type="text" class="form-control" placeholder="No. de Serie" name="no_serie" id="no_serie">
									</div>
								</div>
							</div>
						</div>
						<!-- END FORM BODY -->
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
					<button type="button" id="btn_guardar_sistema" class="btn green">Guardar</button>
				</div>
			</form>
		</div>
		<!-- END NUEVO SISTEMA -->
		<!-- END VENTANAS MODALES -->