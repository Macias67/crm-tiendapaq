		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Evento Nuevo - <small><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?></small></h3>
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
									<span class="caption-helper"></span>
								</div>
							</div>
							<div class="portlet-body form-horizontal">
								<!-- BEGIN FORM-->
								<form action="<?php echo site_url('evento/nuevo/normal') ?>" id="form-evento-completo" accept-charset="utf-8">
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

										<div class="col-md-6">
											<!-- obtengo el titulo -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Titulo<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-asterisk"></i>
														<input type="text" class="form-control" placeholder="Titulo" name="titulo">
													</div>
												</div>
											</div>
											<!-- descrpcion -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Descripción<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-asterisk"></i>
														<textarea name="descripcion" class="form-control" placeholder="Descripción" class="form-control"></textarea>
													</div>
												</div>
											</div>
											<!-- temario -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Temario<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-asterisk"></i>
														<textarea name="temario" class="form-control" placeholder="Temario" class="form-control"></textarea>
													</div>
												</div>
											</div>
											<!-- numero de sesiones -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Numero de  Sesiones
												</label>
												<div class="col-md-8">
													<div id="numero-sesiones">
														<div class="input-group input-small">
															<input type="text" class="spinner-input form-control" maxlength="2" name="numero_sesiones">
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