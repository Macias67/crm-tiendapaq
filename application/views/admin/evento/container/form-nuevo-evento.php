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
								<form action="<?php echo site_url('evento/gestionar/nuevo') ?>" id="form-evento-completo" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
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
										<select class="form-control" name="ejecutivo">
											<?php foreach ($ejecutivos as $ejecutivo): ?>
											<option value="<?php echo $ejecutivo->id ?>"><?php echo $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno ?></option>
											<?php endforeach ?>
										</select>

									<div class="col-md-8">
										<select class="form-control" name="oficina">
											<?php foreach ($oficinas as $oficina): ?>
											<option value="<?php echo $oficina->ciudad_estado?>"><?php echo $oficina->ciudad_estado?></option>
											<?php endforeach ?>
									</select>
									</div>
									</div>
								</div>

								<!-- titulo -->
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
								<!-- <div class="form-group">
									<label class="col-md-4 control-label">
										Temario<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-asterisk"></i>
											<textarea name="temario" class="form-control" placeholder="Temario" class="form-control"></textarea>
										</div>
									</div>
								</div> -->
								
								<!--inicio temario imagen -->
								<!-- <div class="form-group last">
										<label class="control-label col-md-4">Temario</label>
										<div class="col-md-8">
											<?php echo form_open_multipart('upload/do_upload');?>
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
													<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=sin+imagen" alt=""/>
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
												</div>
												<div>
													<span class="btn default btn-file">
													<span class="fileinput-new">
													Seleccionar imagen </span>
													<span class="fileinput-exists">
													Cambiar </span>
													<input type="file" name="userfile">
													</span>
													<a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
													Quitar </a>
												</div>
											</div>
										</form>
										</div>
									</div> -->
									<!--fin temario imagen -->

								<!--incio temario imagen basico -->
								<!-- Cambiar Imagen -->
										<div id="cambiar_imagen" class="tab-pane">
												<div class="col-md-12">
													<div class="form-group">
														<div class="fileinput fileinput-new" data-provides="fileinput">
															<div>
																<span class="btn default btn-file">
																	<span class="fileinput-new">Buscar... </span>
																	<span class="fileinput-exists">Cambiar </span>
																	<input type="file" class="default" name="userfile">
																</span>
																<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">Borrar </a>
															</div>
														</div>
													</div>
												</div>
										</div>
								<!-- fin temario imagen basico -->

								<!-- numero de sesiones dinamicas-->
								<!-- <div class="form-group">
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
									</div>
								</div> -->
								<!-- ***este*** -->
								<!-- numero de sesiones -->
								<!-- <div class="form-group">
									<label class="col-md-4 control-label">
										Seiones<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
									<a id="agregarCampo" class="btn btn-info" href="#">Agregar Sesion</a>
									</div>
								</div> -->

								<!-- <div class="form-group">
									<label class="col-md-4 control-label">
										dia<span class="required" aria-required="true">*</span>
									</label>
										<div id="contenedor">
										    <div class="added">
										        <input type="date" name="mitexto[]" id="campo_1" placeholder="Sesion 1"/>
										        <a href="#" class="eliminar">&times;</a>
										    </div>
										</div>
								</div> -->

								<!-- <div class="form-group">
										<label class="col-md-4 control-label">
											<span class="required" aria-required="true"></span>
										</label>
									<div class="col-md-8">
										<div id="contenedor">
											<div class="added">
												<div class="input-group date form_datetime">
													<input type="text" name="mitexto[]" id="campo_1" size="16" readonly class="form-control"  placeholder="Sesion 1"/>
														<span class="input-group-btn">
															<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
														</span>
													<a href="#" class="eliminar">&times;</a>
												</div>
											</div>
										</div>
									</div>
								</div> -->

								<!-- ***este*** -->
								<!-- <div class="form-group">
										<label class="col-md-4 control-label">
											<span class="required" aria-required="true"></span>
										</label>
										<div class="col-md-8">
											<div id="contenedor">
											</div>
										</div>
									</div> -->
									<!-- FIN numero de sesiones dinamicas-->

								<!-- INICIO Costo -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Costo<span class="required" aria-required="true">$</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-dollar"></i>
											<input name="costo" class="form-control" class="form-control"></input>
										</div>
									</div>
								</div>

								<!-- numero de sesiones fijas -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Sesiones<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-6" Default:"es">
										<div id="contenedor">
											<div class="input-group date form_datetime" Default:"es">
												<input name="sesion_1" id="campo_1" size="16" readonly class="form-control"  placeholder="Sesión 1" Default:"es"/>
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

								<!-- duracion de las sesiones -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										duracion<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-clock-o"></i>
											<input name="duracion_1" class="form-control" class="form-control"></input>
										</div>
										<div class="input-icon">
											<i class="fa fa-clock-o"></i>
											<input name="duracion_2" class="form-control" class="form-control"></input>
										</div>
										<div class="input-icon">
											<i class="fa fa-clock-o"></i>
											<input name="duracion_3" class="form-control" class="form-control"></input>
										</div>
										<div class="input-icon">
											<i class="fa fa-clock-o"></i>
											<input name="duracion_4" class="form-control" class="form-control"></input>
										</div>
									</div>
								</div>

								<!-- numero maximo de participantes -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										N° de particiantes<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-clock-o"></i>
											<input name="max_participantes" class="form-control" class="form-control"></input>
										</div>
									</div>
								</div>

								<!-- Radiobutton para seleccionar la modalidad del evento -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Modalidad<span class="required" aria-required="true">*</span>
									</label>
									<div class="clearfix">
									<div class="btn-group" data-toggle="buttons">
										<a id="online" class="btn btn-info" href="#">Online</a>
										<a id="sucursal" class="btn btn-info" href="#">Sucursal</a>
										<a id="otro" class="btn btn-info" href="#">Otro</a>
									</div>
									</div>
									<div  id="modalidad" >
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