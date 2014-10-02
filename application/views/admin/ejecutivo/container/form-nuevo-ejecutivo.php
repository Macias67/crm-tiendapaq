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
						<h3 class="page-title">
						Bienvenido - <small> Gestionar ejecutivos</small>
						</h3>
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
								<a href="<?php echo site_url('ejecutivo/nuevo') ?>">Nuevo Ejecutivo</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<div class="portlet gren" id="nuevo-ejecutivo">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-gift"></i>Formulario de Nuevo Ejecutivo
								</div>
							</div>
							<div class="portlet-body form-horizontal">
								<!-- BEGIN FORM-->
								<form action="<?php echo site_url('ejecutivo/nuevo/procesa') ?>" id="form-ejecutivo" accept-charset="utf-8">
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
											<h4>Datos Personales</h4>
											<!-- Primer nombre -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Primer Nombre <span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Primer Nombre" name="primer_nombre">
												</div>
											</div>
											<!-- Segundo nombre -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Segundo Nombre 
												</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Segundo Nombre" name="segundo_nombre">
												</div>
											</div>
											<!-- Apellido paterno -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Apellido Paterno <span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Apellido Paterno" name="apellido_paterno">
												</div>
											</div>
											<!-- Apellido materno -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Apellido Materno <span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Apellido Materno" name="apellido_materno">
												</div>
											</div>
											<!-- Email -->
											<div class="form-group">
												<label class="col-md-4 control-label">Email </label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa  fa-envelope"></i>
														<input type="text" class="form-control" placeholder="Email" name="email">
													</div>
												</div>
											</div>
											<!-- Telefono -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Teléfono <span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-phone"></i>
														<input type="text" class="form-control" id="telefono_1" placeholder="(999) 999-9999" name="telefono">
													</div>
												</div>
											</div>
										</div>
										<!-- INFORMACION DEL SISTEMA -->
										<div class="col-md-6">
											<h4>Datos del Sistema</h4>
											<!-- Oficina -->
											<div class="form-group">
												<label class="control-label col-md-4">Oficina </label>
												<div class="col-md-8">
													<select class="form-control" name="oficina">
														<?php foreach ($tablaoficinas as $oficina): ?>
															<option value="<?php echo $oficina->ciudad_estado?>"><?php echo $oficina->ciudad_estado?></option>
														<?php endforeach ?>
													</select>
												</div>
											</div>
											<!-- Privilegios -->
											<div class="form-group">
												<label class="control-label col-md-4">Privilegios </label>
												<div class="col-md-8">
													<select class="form-control" name="privilegios">
														<?php foreach ($tablaprivilegios as $privi): ?>
														<option value="<?php echo $privi->privilegios; ?>"><?php echo $privi->privilegios; ?></option>
														<?php endforeach ?>
													</select>
												</div>
											</div>
											<!-- Departamento -->
											<div class="form-group">
												<label class="control-label col-md-4">Departamento </label>
												<div class="col-md-8">
													<select class="form-control" name="departamento">
														<?php foreach ($tabladepartamentos as $departamento): ?>
															<option value="<?php echo $departamento->area?>"><?php echo $departamento->area?></option>
														<?php endforeach ?>
													</select>
												</div>
											</div>
											<!-- Usuario -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Usuario <span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<input type="text" class="form-control" placeholder="Usuario" name="usuario">
													</div>
												</div>
											</div>
											<!-- Contraseña -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Contraseña <span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-unlock-alt"></i>
														<input type="text" class="form-control" placeholder="Contraseña" name="password">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions fluid">
										<div class="row">
											<div class="col-md-12">
												<hr>
												<button type="submit" class="btn green"><i class="fa fa-save"></i> Guardar</button>
												<button type="reset" class="btn default"><i class="fa fa-eraser"></i> Limpiar</button>
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