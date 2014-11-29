		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Cliente Nuevo - <small><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?></small></h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<div class="portlet gren">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-child"></i>Formulario de Nuevo Cliente
								</div>
							</div>
							<div class="portlet-body form-horizontal">
								<!-- BEGIN FORM-->
								<form action="<?php echo site_url('cliente/nuevo/normal') ?>" id="form-cliente-completo" accept-charset="utf-8">
									<div class="form-body">
										<!-- ALERTS -->
										<div class="alert alert-danger display-hide">
											<button class="close" data-close="alert"></button>
											Tienes errores en el formulario
										</div>
										<div class="alert alert-success display-hide">
											<button class="close" data-close="alert"></button>
											Éxito en el formulario
										</div>
										<!-- INFORMACION BASICA -->
										<div class="col-md-6">
											<h4><strong>Información Básica</strong></h4>
											<!-- Razon Social -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Razón Social<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-asterisk"></i>
														<input type="text" class="form-control" placeholder="Razón Social" name="razon_social">
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
														<input type="text" class="form-control" placeholder="R.F.C." name="rfc">
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
														<input type="text" class="form-control" placeholder="Email" name="email">
													</div>
												</div>
											</div>
											<!-- Tipo -->
											<div class="form-group">
												<label class="control-label col-md-4">
													Tipo<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<select class="form-control" name="tipo">
														<option value="normal" selected>Normal</option>
														<option value="distribuidor">Distribuidor</option>
													</select>
												</div>
											</div>

											<hr>

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
														<input type="text" class="form-control" placeholder="Calle" name="calle">
													</div>
												</div>
											</div>
											<!-- No Exterior -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													No. Exterior<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-map-marker"></i>
														<input type="text" class="form-control" placeholder="No. Exterior" name="no_exterior">
													</div>
												</div>
											</div>
											<!-- No Interior -->
											<div class="form-group">
												<label class="col-md-4 control-label">No. Interior</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-map-marker"></i>
														<input type="text" class="form-control" placeholder="No. Interior" name="no_interior">
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
														<input type="text" class="form-control" placeholder="Colonia" name="colonia">
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
														<input type="text" class="form-control" id="codigo_postal_mask" placeholder="99999" name="codigo_postal">
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
														<input type="text" class="form-control" placeholder="Ciudad" name="ciudad">
													</div>
												</div>
											</div>
											<!-- Municipio -->
											<div class="form-group">
												<label class="col-md-4 control-label">Municipio</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-map-marker"></i>
														<input type="text" class="form-control" placeholder="Municipio" name="municipio">
													</div>
												</div>
											</div>
											<!-- Estado -->
											<div class="form-group" id="div_estado">
												<label class="col-md-4 control-label">
													Estado
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-map-marker"></i>
														<select class="form-control" name="estado" id="estado">
															<?php foreach ($this->estados as $estado): ?>
																<option value="<?php echo $estado ?>" <?php echo ($estado=='Jalisco')? 'selected':'' ?>><?php echo $estado ?></option>
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
															<option value="Estados Unidos">Estados Unidos</option>
															<option value="México" selected>México</option>
														</select>
													</div>
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
														<input type="text" class="form-control" id="telefono1" placeholder="(999) 999-9999" name="telefono1">
													</div>
												</div>
											</div>
											<!-- Telefono 2 -->
											<div class="form-group">
												<label class="col-md-4 control-label">Teléfono 2</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-phone"></i>
														<input type="text" class="form-control" id="telefono2" placeholder="(999) 999-9999" name="telefono2">
													</div>
												</div>
											</div>

											<hr>

											<!-- ACCESO AL SISTEMA -->
											<h4><strong>Acceso al sistema</strong></h4>
											<!-- Usuario -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Usuario<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<input type="text" class="form-control" id="usuario" placeholder="Nombre de usuario" name="usuario">
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
														<input type="text" class="form-control" id="password" placeholder="Contraseña" name="password">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<!-- INFORMACION DE CONTACTO -->
											<h4><strong>Contácto</strong><small>- Puedes añadir más contactos en la seccion de gestión</small></h4>
											<!-- Nombre del contacto -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Nombre(s)<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<input type="text" class="form-control" placeholder="Nombre" name="nombre_contacto">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 control-label">
													Apellido Paterno<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<input type="text" class="form-control" placeholder="Apellido Paterno" name="apellido_paterno">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 control-label">
													Apellido Materno<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<input type="text" class="form-control" placeholder="Apellido Materno" name="apellido_materno">
													</div>
												</div>
											</div>
											<!-- Email del contacto -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Email<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa  fa-envelope"></i>
														<input type="text" class="form-control" placeholder="Email" name="email_contacto">
													</div>
												</div>
											</div>
											<!-- Telefono del contacto -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Teléfono<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-phone"></i>
														<input type="text" class="form-control" id="telefono_contacto" placeholder="Teléfono" name="telefono_contacto">
													</div>
												</div>
											</div>
											<!-- Puesto del contacto -->
											<div class="form-group">
												<label class="col-md-4 control-label">Puesto</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-certificate"></i>
														<input type="text" class="form-control" placeholder="Puesto" name="puesto_contacto">
													</div>
												</div>
											</div>
											<hr>

											<!-- INFORMACION DE SISTEMAS CONTPAQi DEL CLIENTE -->
											<h4><strong>Sistemas de CONTPAQi</strong> <small>- Puedes añadir más sistemas en la seccion de gestión</small></h4>
											<!-- Tipo de sistema -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Sistema
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-info"></i>
														<select class="form-control" name="sistema" id="select_sistemas">
															<option value=""></option>
															<?php foreach ($sistemascontpaqi as $sistema): ?>
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
											<!-- No de serie -->
											<div class="form-group">
												<label class="col-md-4 control-label">No. de Serie</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-barcode"></i>
														<input type="text" class="form-control" placeholder="No. de Serie" name="no_serie">
													</div>
												</div>
											</div>
											<hr>

											<!-- INFORMACION DEL EQUIPO DE COMPUTO	 -->
											<h4><strong>Info. Equipo de Cómputo</strong> <small>- Puedes añadir mas registros en la seccion de gestión</small></h4>
											<!-- Nombre del equipo -->
											<div class="form-group">
												<label class="col-md-4 control-label">Nombre del Equipo</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-desktop"></i>
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
															<?php foreach ($sistemasoperativos as $operativo): ?>
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
													Memoria RAM
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
													<span class="help-block">GB</span>
												</div>
											</div>
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
									<div class="form-actions fluid">
										<div class="row">
											<div class="col-md-12">
												<div class="col-md-offset-2 col-md-10">
													<button type="submit" class="btn btn-circle green"><i class="fa fa-save"></i> Guardar</button>
													<button type="reset" class="btn btn btn-circle default"><i class="fa fa-eraser"></i> Limpiar</button>
												</div>
											</div>
										</div>
									</div>
								</form>
								<!-- END FORM-->
							</div>
						</div>
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->