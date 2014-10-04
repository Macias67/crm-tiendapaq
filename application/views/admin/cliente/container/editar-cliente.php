
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
						<h3 class="page-title"><?php echo $cliente->razon_social ?> - <small>Gestionar Clientes</small></h3>
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
								<a href="<?php echo site_url('cliente/gestionar') ?>">Gestionar Clientes</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#"><?php echo $cliente->razon_social ?></a>
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
											<form  action="<?php echo site_url('cliente/editado') ?>" id="form-basica-cliente" accept-charset="utf-8">
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
																	<input type="hidden" class="form-control" name="id_cliente" value="<?php echo $cliente->id ?>">
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
														<!-- Tipo -->
														<div class="form-group">
															<label class="control-label col-md-4">Tipo : </label>
															<div class="col-md-8">
																<select class="form-control" name="tipo">
																	<?php if($cliente->tipo=="prospecto"): ?>
																		<option value="prospecto" selected>Prospecto</option>
																	<?php endif ?>
																	<option value="normal" <?php echo ($cliente->tipo=="normal")? 'selected':'' ?>>Normal</option>
																	<option value="distribuidor" <?php echo ($cliente->tipo=="distribuidor")? 'selected':'' ?>>Distribuidor</option>
																</select>
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
														<hr>
														<!-- Acceso al sistema -->
														<h4>Acceso al sistema</h4>
														<!-- Usuario -->
														<div class="form-group">
															<label class="col-md-4 control-label">Usuario </label>
															<div class="col-md-8">
																<div class="input-icon">
																	<i class="fa fa-user"></i>
																	<input type="text" class="form-control" id="usuario" placeholder="Nombre de usuario" name="usuario" value="<?php echo $cliente->usuario ?>">
																</div>
															</div>
														</div>
														<!-- Contraseña -->
														<div class="form-group">
															<label class="col-md-4 control-label">Contraseña </label>
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
											<table class="table table-striped table-hover table-bordered" id="tabla_contactos_cliente" idcliente="<?php echo $cliente->id ?>">
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

<!-- BEGIN VENTANAS MODALES -->
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