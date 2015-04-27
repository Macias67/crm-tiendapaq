
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Editar Evento</h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption font-green-sharp">
									<i class="icon-speech font-green-sharp"></i>
									<span class="caption-subject bold uppercase"> Formulario Para Edicion de Evento</span>
								</div>
							</div>
							<div class="portlet-body">
								<?php echo (isset($upload_error)) ? $upload_error : '' ?>
								<?php echo validation_errors('<div class="alert alert-danger"><button class="close" data-close="alert"></button>', '</div>'); ?>
								<?php if (isset($exito) && $exito): ?>
								<div class="alert alert-success">
									<button class="close" data-close="alert"></button>
									Evento editado.
								</div>
								<?php endif ?>
								<?php echo form_open_multipart('evento/edit', array('class' => 'form-horizontal', 'role' => 'form', 'id'=>'form-evento-completo'));?>
									<div class="form-body">
										<div class="col-md-6">
											<h4><strong>Datos del evento</strong></h4>
											<!-- ejecutivo -->
											<div class="form-group">
												<label class="col-md-3 control-label">Ejecutivo <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="input-icon">
														<input type="hidden" name="id_evento" value="<?php echo $evento->id_evento ?>">
														<i class="fa fa-user"></i>
														<?php echo $options_ejecutivos ?>
														<span class="help-block">Organizador del evento.</span>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Título <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<input type="text" class="form-control" name="titulo" placeholder="Título" value="<?php echo $evento->titulo ?>">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Descripción <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<textarea class="form-control" name="descripcion" rows="2"><?php echo $evento->descripcion ?></textarea>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Costo <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="input-inline input-medium">
														<input id="costo" type="text" name="costo" value="<?php echo $evento->costo?>" class="form-control">
													</div>
													<span class="help-block">$0.00 se considera sin costo.</span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Max. Cupo <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="input-inline input-medium">
														<input id="cupo" type="text" name="cupo" value="<?php echo $evento->max_participantes ?>" class="form-control">
													</div>
													<span class="help-block">0 se considera sin límite de cupo.</span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Lugar: <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9 radio-list">
													<label class="radio-inline">
														<?php  echo form_radio($online); ?>
														Online </label>
													<label class="radio-inline">
														<?php echo form_radio($sucursal); ?>
														Pres. Sucursal </label>
													<label class="radio-inline">
														<?php echo form_radio($otro); ?>
														Pres. Otro lugar</label>
												</div>
											</div>
											<!-- LINK -->
											<div class="form-group" id="online">
												<label class="col-md-3 control-label">Link <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<input type="text" class="form-control" name="link" placeholder="Link del curso" value="<?php echo $evento->link ?>">
													</div>
												</div>
											</div>
											<!-- Oficinas -->
											<div class="form-group display-hide" id="sucursal">
												<label class="col-md-3 control-label">Oficinas: <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<?php echo form_dropdown('sucursal', $options_oficinas, $evento->id_oficina, 'class="form-control"'); ?>
														<p class="help-block">Dirección más detellada en el correo del cliente.</p>
													</div>
												</div>
											</div>
											<!-- Otro Lugar -->
											<div class="form-group display-hide" id="otro">
												<label class="col-md-3 control-label">Dirección <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<textarea class="form-control" rows="2" name="otro"><?php echo $evento->direccion ?></textarea>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="exampleInputFile" class="col-md-3 control-label">Temario <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<input type="file" name="userfile" id="exampleInputFile">
													<p class="help-block">Imagen con información del temario.</p>

													<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
													<img src="<?php echo site_url($ruta_nueva) ?>" alt=""/>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<h4><strong>Sesiones</strong></h4>
											<div class="form-group">
												<label class="control-label col-md-3">Sesión 1 <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<input type="text" name="sesion1" class="form-control daterange" value="<?php echo $sesiones_str[0]?>" readonly/>
													<input type="hidden" name="dsesion1" value="<?php echo (isset($sesion[0])) ? $sesion[0]->duracion : ''; ?>">
													<span class="help-block">Duración: <b id="sesion1"><?php echo (isset($sesion[0])) ? $sesion[0]->duracion.' horas aprox.' : ''; ?></b></span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Sesión 2</label>
												<div class="col-md-9">
													<input type="text" name="sesion2" class="form-control daterange" value="<?php echo (isset($sesiones_str[1])) ? $sesiones_str[1] : ''?>" readonly/>
													<input type="hidden" name="dsesion2" value="<?php echo (isset($sesion[1])) ? $sesion[1]->duracion : ''; ?>">
													<span class="help-block">Duración: <b id="sesion2"><?php echo (isset($sesion[1])) ? $sesion[1]->duracion.' horas aprox.' : ''; ?></b></span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Sesión 3</label>
												<div class="col-md-9">
													<input type="text" name="sesion3" class="form-control daterange" value="<?php echo (isset($sesiones_str[2])) ? $sesiones_str[2] : ''?>" readonly/>
													<input type="hidden" name="dsesion3" value="<?php echo (isset($sesion[2])) ? $sesion[2]->duracion : ''; ?>">
													<span class="help-block">Duración: <b id="sesion3"><?php echo (isset($sesion[2])) ? $sesion[2]->duracion.' horas aprox.' : ''; ?></b></span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Sesión 4</label>
												<div class="col-md-9">
													<input type="text" name="sesion4" class="form-control daterange" value="<?php echo (isset($sesiones_str[3])) ? $sesiones_str[3] : ''?>" readonly/>
													<input type="hidden" name="dsesion4" value="<?php echo (isset($sesion[3])) ? $sesion[3]->duracion : ''; ?>">
													<span class="help-block">Duración: <b id="sesion4"><?php echo (isset($sesion[3])) ? $sesion[3]->duracion.' horas aprox.' : ''; ?></b></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Fecha límite de inscripción:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<b id="limite"><?php echo fecha_completa($evento->fecha_limite) ?></b>
													</p>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-9 col-md-3">
												<button type="submit" class="btn green">Guardar</button>
												<button type="reset" class="btn default">Cancelar</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->