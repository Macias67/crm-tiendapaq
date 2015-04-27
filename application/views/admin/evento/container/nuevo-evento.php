
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Evento Nuevo</h3>
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
									<span class="caption-subject bold uppercase"> Formulario de Nuevo Evento</span>
								</div>
							</div>
							<div class="portlet-body">
								<?php echo (isset($upload_error)) ? $upload_error : '' ?>
								<?php echo validation_errors('<div class="alert alert-danger"><button class="close" data-close="alert"></button>', '</div>'); ?>
								<?php if (isset($exito) && $exito): ?>
								<div class="alert alert-success">
									<button class="close" data-close="alert"></button>
									Nuevo evento creado.
								</div>
								<?php endif ?>
								<?php echo form_open_multipart('evento/create', array('class' => 'form-horizontal', 'role' => 'form'));?>
									<div class="form-body">
										<div class="col-md-6">
											<h4><strong>Datos del evento</strong></h4>
											<div class="form-group">
												<label class="col-md-3 control-label">Ejecutivo <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<?php echo form_dropdown('ejecutivo', $options_ejecutivos, null, 'class="form-control"'); ?>
														<span class="help-block">Organizador del evento.</span>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Título <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<input type="text" class="form-control" name="titulo" placeholder="Título" value="<?php echo set_value('titulo'); ?>">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Descripción <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<textarea class="form-control" name="descripcion" rows="2"><?php echo set_value('descripcion'); ?></textarea>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Costo <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="input-inline input-medium">
														<input id="costo" type="text" name="costo" value="<?php echo set_value('costo'); ?>" class="form-control">
													</div>
													<span class="help-block">$0.00 se considera sin costo.</span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Max. Cupo <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="input-inline input-medium">
														<input id="cupo" type="text" name="cupo" value="<?php echo set_value('cupo'); ?>" class="form-control">
													</div>
													<span class="help-block">0 se considera sin límite de cupo.</span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Lugar: <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9 radio-list">
													<label class="radio-inline">
													<input type="radio" name="lugar" id="lugar4" value="online" checked> Online </label>
													<label class="radio-inline">
													<input type="radio" name="lugar" id="lugar5" value="sucursal">Pres. Sucursal </label>
													<label class="radio-inline">
													<input type="radio" name="lugar" id="lugar6" value="otro">Pres. Otro lugar</label>
												</div>
											</div>
											<!-- LINK -->
											<div class="form-group" id="online">
												<label class="col-md-3 control-label">Link <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<input type="text" class="form-control" name="link" placeholder="Link del curso">
													</div>
												</div>
											</div>
											<!-- Oficinas -->
											<div class="form-group display-hide" id="sucursal">
												<label class="col-md-3 control-label">Oficinas: <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<?php echo form_dropdown('sucursal', $options_oficinas, null, 'class="form-control"'); ?>
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
														<textarea class="form-control" rows="2" name="otro"></textarea>
													</div>
												</div>
											</div>
											<!-- TEMARIO -->
											<div class="form-group">
												<label for="exampleInputFile" class="col-md-3 control-label">Temario <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
															<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
														</div>
														<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
														</div>
														<div class="col-md-12">
															<span class="btn default btn-file">
																<span class="fileinput-new">
																Selecionar imagen </span>
																<span class="fileinput-exists">
																Cambiar </span>
																<input type="file" name="userfile" id="exampleInputFile">
															</span>
															<a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
															Quitar </a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<h4><strong>Sesiones</strong></h4>
											<div class="form-group">
												<label class="control-label col-md-3">Sesión 1 <span class="required" aria-required="true">*</span></label>
												<div class="col-md-9">
													<input type="text" name="sesion1" class="form-control daterange" readonly/>
													<input type="hidden" name="dsesion1">
													<span class="help-block">Duración: <b id="sesion1"></b></span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Sesión 2</label>
												<div class="col-md-9">
													<input type="text" name="sesion2" class="form-control daterange" readonly/>
													<input type="hidden" name="dsesion2">
													<span class="help-block">Duración: <b id="sesion2"></b></span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Sesión 3</label>
												<div class="col-md-9">
													<input type="text" name="sesion3" class="form-control daterange" readonly/>
													<input type="hidden" name="dsesion3">
													<span class="help-block">Duración: <b id="sesion3"></b></span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Sesión 4</label>
												<div class="col-md-9">
													<input type="text" name="sesion4" class="form-control daterange" readonly/>
													<input type="hidden" name="dsesion4">
													<span class="help-block">Duración: <b id="sesion4"></b></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-6 control-label">Fecha límite de inscripción: </label>
												<div class="col-md-6">
													<p class="form-control-static">
														<b id="limite"></b>
													</p>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-9 col-md-3">
												<button type="submit" class="btn green">Crear</button>
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
