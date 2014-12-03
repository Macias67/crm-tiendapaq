
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title"><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?> - <small>Gestionar Ejecutivos</small></h3>
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN FORM EDITAR EJECUTIVO -->
						<div class="portlet light" id="nuevo-ejecutivo">
							<div class="portlet-title">
								<div class="caption font-green-sharp">
									<i class="icon-speech font-green-sharp"></i>
									<span class="caption-subject bold uppercase"> Ejecutivo</span>
									<span class="caption-helper"></span>
								</div>
							</div>
							<div class="portlet-body form-horizontal">
								<form action="<?php echo site_url('ejecutivo/editar/info-ejecutivo') ?>" id="form-ejecutivo-editado" accept-charset="utf-8">
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
											<h4><strong>Datos Personales</strong></h4>
											<!-- Primer nombre -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Primer Nombre<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<input type="hidden" class="form-control" name="id" value="<?php echo $ejecutivo->id ?>">
													<input type="text" class="form-control" placeholder="Primer Nombre" name="primer_nombre" value="<?php echo $ejecutivo->primer_nombre ?>">
												</div>
											</div>
											<!-- Segundo nombre -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Segundo Nombre
												</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Segundo Nombre" name="segundo_nombre" value="<?php echo $ejecutivo->segundo_nombre ?>">
												</div>
											</div>
											<!-- Apellido paterno -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Apellido Paterno<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Apellido Paterno" name="apellido_paterno" value="<?php echo $ejecutivo->apellido_paterno ?>">
												</div>
											</div>
											<!-- Apellido materno -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Apellido Materno<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Apellido Materno" name="apellido_materno" value="<?php echo $ejecutivo->apellido_materno ?>">
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
														<input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $ejecutivo->email ?>">
													</div>
												</div>
											</div>
											<!-- Telefono -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Teléfono<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-phone"></i>
														<input type="text" class="form-control" id="telefono" placeholder="(999) 999-9999" name="telefono" value="<?php echo $ejecutivo->telefono ?>">
													</div>
												</div>
											</div>
										</div>
										<!-- INFORMACION DEL SISTEMA -->
										<div class="col-md-6">
											<h4><strong>Datos del Sistema</strong></h4>
											<!-- Oficina -->
											<div class="form-group">
												<label class="control-label col-md-4">Oficina </label>
												<div class="col-md-8">
													<select class="form-control" name="oficina">
														<option value="<?php echo $ejecutivo->oficina?>"><?php echo $ejecutivo->oficina?></option>
														<?php foreach ($tablaoficinas as $oficina): ?>
															<?php if ($oficina->ciudad_estado != $ejecutivo->oficina): ?>
																<option value="<?php echo $oficina->ciudad_estado ?>"><?php echo $oficina->ciudad_estado?></option>
															<?php endif ?>
														<?php endforeach ?>
													</select>
												</div>
											</div>
											<!-- Privilegios -->
											<div class="form-group">
												<label class="control-label col-md-4">Privilegios </label>
												<div class="col-md-8">
													<select class="form-control" name="privilegios">
														<option value="<?php echo $ejecutivo->privilegios ?>"><?php echo $ejecutivo->privilegios ?></option>
														<?php foreach ($tablaprivilegios as $privilegio): ?>
															<?php if ($privilegio->privilegios != $ejecutivo->privilegios): ?>
																<option value="<?php echo $privilegio->privilegios ?>"><?php echo $privilegio->privilegios; ?></option>
															<?php endif ?>
														<?php endforeach ?>
													</select>
												</div>
											</div>
											<!-- Departamento -->
											<div class="form-group">
												<label class="control-label col-md-4">Departamento </label>
												<div class="col-md-8">
													<select class="form-control" name="departamento">
														<option value="<?php echo $ejecutivo->departamento?>"><?php echo $ejecutivo->departamento?></option>
														<?php foreach ($tabladepartamentos as $departamento): ?>
															<?php if ($departamento->area != $ejecutivo->departamento): ?>
																<option value="<?php echo $departamento->area?>"><?php echo $departamento->area?></option>
															<?php endif ?>
														<?php endforeach ?>
													</select>
												</div>
											</div>
											<!-- Usuario -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Usuario<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<input type="text" class="form-control" placeholder="Usuario" name="usuario" value="<?php echo $ejecutivo->usuario ?>">
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
														<i class="fa fa-unlock-alt"></i>
														<input type="text" class="form-control" placeholder="Contraseña" name="password" value="<?php echo $ejecutivo->password ?>">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions fluid">
										<div class="row">
											<div class="col-md-12">
												<hr>
												<button type="submit" class="btn btn-circle green"><i class="fa fa-save"></i> Guardar</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- END FORM EDITAR EJECUTIVO -->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->