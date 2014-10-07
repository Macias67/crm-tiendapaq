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
						<h3 class="page-title"> Información básica - <small><?php echo $usuario_activo['razon_social'] ?></small></h3>
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
								<a href="#">Actualizar Información</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Información Básica</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN INFORMACION BASICA -->
						<div class="portlet gren">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-gift"></i>Información básica
								</div>
							</div>
							<div class="portlet-body form-horizontal">
								<!-- BEGIN FORM-->
								<form  action="<?php echo site_url('actualizar/basica/editar') ?>" id="form-basica-cliente" accept-charset="utf-8">
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
													Razón Social<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-asterisk"></i>
														<input type="hidden" class="form-control" name="id_cliente" value="<?php echo $usuario_activo['id'] ?>">
														<input type="hidden" class="form-control" name="tipo" value="<?php echo $usuario_activo['tipo'] ?>">
														<input type="text" class="form-control" placeholder="Razón Social" name="razon_social" value="<?php echo $usuario_activo['razon_social'] ?>">
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
														<input type="text" class="form-control" placeholder="R.F.C." name="rfc" value="<?php echo $usuario_activo['rfc'] ?>">
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
														<input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $usuario_activo['email'] ?>">
													</div>
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
														<input type="text" class="form-control" id="telefono_1" placeholder="(999) 999-9999" name="telefono1" value="<?php echo $usuario_activo['telefono1'] ?>">
													</div>
												</div>
											</div>
											<!-- Telefono 2 -->
											<div class="form-group">
												<label class="col-md-4 control-label">Teléfono 2</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-phone"></i>
														<input type="text" class="form-control" id="telefono_2" placeholder="(999) 999-9999" name="telefono2" value="<?php echo $usuario_activo['telefono2'] ?>">
													</div>
												</div>
											</div>

											<hr>

											<!-- ACCESO AL SISTEMA -->
											<h4>Acceso al sistema</h4>
											<!-- Usuario -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Usuario<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-user"></i>
														<input type="text" class="form-control" id="usuario" placeholder="Nombre de usuario" name="usuario" value="<?php echo $usuario_activo['usuario'] ?>">
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
														<input type="text" class="form-control" id="password" placeholder="Contraseña" name="password" value="<?php echo $usuario_activo['password'] ?>">
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
													Calle<span class="required" aria-required="true">*</span>
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-map-marker"></i>
														<input type="text" class="form-control" placeholder="Calle" name="calle" value="<?php echo $usuario_activo['calle'] ?>">
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
														<input type="text" class="form-control" placeholder="No. Exterior" name="no_exterior" value="<?php echo $usuario_activo['no_exterior'] ?>">
													</div>
												</div>
											</div>
											<!-- No Interior -->
											<div class="form-group">
												<label class="col-md-4 control-label">No. Interior</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-map-marker"></i>
														<input type="text" class="form-control" placeholder="No. Interior" name="no_interior" value="<?php echo $usuario_activo['no_interior'] ?>">
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
														<input type="text" class="form-control" placeholder="Colonia" name="colonia" value="<?php echo $usuario_activo['colonia'] ?>">
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
														<input type="text" class="form-control" id="codigo_postal_mask" placeholder="99999" name="codigo_postal" value="<?php echo $usuario_activo['codigo_postal'] ?>">
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
														<input type="text" class="form-control" placeholder="Ciudad" name="ciudad" value="<?php echo $usuario_activo['ciudad'] ?>">
													</div>
												</div>
											</div>
											<!-- Municipio -->
											<div class="form-group">
												<label class="col-md-4 control-label">Municipio</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-map-marker"></i>
														<input type="text" class="form-control" placeholder="Municipio" name="municipio" value="<?php echo $usuario_activo['municipio'] ?>">
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
															<option value="<?php echo $usuario_activo['estado'] ?>"><?php echo $usuario_activo['estado'] ?></option>
															<?php foreach ($this->estados as $estado): ?>
																<?php if ($usuario_activo['estado']!=$estado): ?>
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
															<option value="Estados Unidos" <?php echo ($usuario_activo['pais']=="México")? "selected":"" ?>>Estados Unidos</option>
															<option value="México" <?php echo ($usuario_activo['pais']=="México")? "selected":"" ?>>México</option>
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
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->
