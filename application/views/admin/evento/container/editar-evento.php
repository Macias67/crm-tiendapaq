<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Editar evento - <small><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?></small></h3>
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
							<span class="caption-subject bold uppercase"> Formulario para editar evento</span>
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
									<!-- Ejectuivo -->
									<div class="form-group">
										<label class="control-label col-md-4">Ejecutivo</label>
										<div class="col-md-8">
											<select class="form-control" name="lider_caso">
												<option value=""></option>
												<?php foreach ($ejecutivos as $ejecutivo): ?>
												<option value="<?php echo $ejecutivo->id ?>"><?php echo $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<!-- titulo -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											Título<span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-asterisk"></i>
												<input type="text" class="form-control" placeholder="Título" name="titulo">
											</div>
										</div>
									</div>
									<!-- descripcion -->
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
											Sesiones<span class="required" aria-required="true">*</span>
										</label>
									<!-- Campos para fechas -->
										<div class="col-md-6">
											<div id="contenedor">
												<div class="input-group date form_datetime">
													<input type="text" name="sesion_1" id="campo_1" size="16" readonly class="form-control"  placeholder="Sesión 1"/>
													<span class="input-group-btn">
														<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
												<div class="input-group date form_datetime">
													<input type="text" name="sesion_2" id="campo_1" size="16" readonly class="form-control"  placeholder="Sesión 2"/>
													<span class="input-group-btn">
														<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
												<div class="input-group date form_datetime">
													<input type="text" name="sesion_3" id="campo_1" size="16" readonly class="form-control"  placeholder="Sesión 3"/>
													<span class="input-group-btn">
														<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
												<div class="input-group date form_datetime">
													<input type="text" name="sesion_4" id="campo_1" size="16" readonly class="form-control"  placeholder="Sesión 4"/>
													<span class="input-group-btn">
														<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
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
<!-- END CONTENT