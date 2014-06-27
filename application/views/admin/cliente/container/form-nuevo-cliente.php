		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
				<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title">Modal title</h4>
							</div>
							<div class="modal-body">
								 Widget settings form goes here
							</div>
							<div class="modal-footer">
								<button type="button" class="btn blue">Save changes</button>
								<button type="button" class="btn default" data-dismiss="modal">Close</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
				<!-- BEGIN STYLE CUSTOMIZER -->
				<div class="theme-panel hidden-xs hidden-sm">
					<div class="toggler">
					</div>
					<div class="toggler-close">
					</div>
					<div class="theme-options">
						<div class="theme-option theme-colors clearfix">
							<span>
							THEME COLOR </span>
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
						Bienvenido - <small>blank page</small>
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
								<a href="<?php echo site_url('admin/add') ?>">Nuevo Cliente</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<div class="portlet gren" id="nuevo-cliente-completo">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-gift"></i>Formulario de Nuevo Cliente
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse">
									</a>
									<a href="javascript:;" class="reload">
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
								<form action="<?php echo site_url('cliente/add/addNormal') ?>" class="form-horizontal" id="form-cliente-completo">
									<div class="form-body">
										<!-- INFORMACION BASICA -->
										<div class="col-md-6">
											<h4>Información Básica</h4>
											<!-- Razon Social -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Razón Social
													<span class="required" aria-required="true">*</span>
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
													R.F.C.
													<span class="required" aria-required="true">*</span>
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
												<label class="col-md-4 control-label">Email</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa  fa-envelope"></i>
														<input type="text" class="form-control" placeholder="Email" name="email">
													</div>
												</div>
											</div>
											<!-- Tipo -->
											<div class="form-group">
												<label class="control-label col-md-4">Tipo : </label>
												<div class="col-md-8">
													<select class="form-control" name="tipo">
														<option value="normal" selected>Normal</option>
														<option value="distribuidor">Distribuidor</option>
													</select>
												</div>
											</div>
											<hr>
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
														<input type="text" class="form-control" placeholder="Calle" name="calle">
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
												<label class="col-md-4 control-label">Colonia</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-map-marker"></i>
														<input type="text" class="form-control" placeholder="Colonia" name="colonia">
													</div>
												</div>
											</div>
											<!-- Codigo Postal -->
											<div class="form-group">
												<label class="col-md-4 control-label">Código Postal</label>
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
											<div class="form-group">
												<label class="col-md-4 control-label">Estado</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-map-marker"></i>
														<select class="form-control" name="estado">
															<option value="Aguascalientes">Aguascalientes</option>
															<option value="Baja California">Baja California</option>
															<option value="Baja California Sur">Baja California Sur</option>
															<option value="Campeche">Campeche</option>
															<option value="Chiapas">Chiapas</option>
															<option value="Chihuahua">Chihuahua</option>
															<option value="Coahuila">Coahuila</option>
															<option value="Colima">Colima</option>
															<option value="Distrito Federal">Distrito Federal</option>
															<option value="Durango">Durango</option>
															<option value="Estado de México">Estado de México</option>
															<option value="Guanajuato">Guanajuato</option>
															<option value="Guerrero">Guerrero</option>
															<option value="Hidalgo">Hidalgo</option>
															<option value="Jalisco" selected>Jalisco</option>
															<option value="Michoacán">Michoacán</option>
															<option value="Morelos">Morelos</option>
															<option value="Nayarit">Nayarit</option>
															<option value="Nuevo León">Nuevo León</option>
															<option value="Oaxaca">Oaxaca</option>
															<option value="Puebla">Puebla</option>
															<option value="Querétaro">Querétaro</option>
															<option value="Quintana Roo">Quintana Roo</option>
															<option value="San Luis Potosí">San Luis Potosí</option>
															<option value="Sinaloa">Sinaloa</option>
															<option value="Sonora">Sonora</option>
															<option value="Tabasco">Tabasco</option>
															<option value="Tamaulipas">Tamaulipas</option>
															<option value="Tlaxcala">Tlaxcala</option>
															<option value="Veracruz">Veracruz</option>
															<option value="Yucatán">Yucatán</option>
															<option value="Zacatecas">Zacatecas</option>
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
														<select class="form-control" name="pais">
				                      <option value="Estados Unidos">Estados Unidos</option>
				                      <option value="México" selected>México</option>
														</select>
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
														<input type="text" class="form-control" id="telefono_1" placeholder="(999) 999-9999" name="telefono1">
													</div>
												</div>
											</div>
											<!-- Telefono 2 -->
											<div class="form-group">
												<label class="col-md-4 control-label">Teléfono 2</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-phone"></i>
														<input type="text" class="form-control" id="telefono_2" placeholder="(999) 999-9999" name="telefono2">
													</div>
												</div>
											</div>
										</div>

										<!-- INFORMACION DE CONTACTO -->
										<div class="col-md-6">
											<h4>Contácto <small>- Puedes añadir más contactos en la seccion de gestión</small></h4>
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
													Apellido Paterno <span class="required" aria-required="true">*</span>
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
													Apellido Materno <span class="required" aria-required="true">*</span>
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
												<label class="col-md-4 control-label">Email</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa  fa-envelope"></i>
														<input type="text" class="form-control" placeholder="Email" name="email_contacto">
														<span class="help-block">Email personal de la empresa</span>
													</div>
												</div>
											</div>
											<!-- Telefono del contacto -->
											<div class="form-group">
												<label class="col-md-4 control-label">Teléfono</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-phone"></i>
														<input type="text" class="form-control" placeholder="Teléfono" name="telefono_contacto">
														<span class="help-block">En la empresa (extensión o departamento)</span>
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
											<h4>Sistemas de CONTPAQi <small>- Puedes añadir más sistemas en la seccion de gestión</small></h4>
											<!-- Tipo de sistema -->
											<div class="form-group">
												<label class="col-md-4 control-label">
													Sistema
												</label>
												<div class="col-md-8">
													<div class="input-icon">
														<i class="fa fa-desktop"></i>
														<select class="form-control" name="sistema">
															<option value=""></option>
															<option value="CONTABILIDAD">CONTPAQi® CONTABILIDAD</option>
															<option value="NOMINAS">CONTPAQi® NÓMINAS</option>
															<option value="BANCOS">CONTPAQi® BANCOS</option>
															<option value="ADMINPAQ">CONTPAQi® ADMINPAQ®</option>
															<option value="COMERCIAL">CONTPAQi® COMERCIAL</option>
															<option value="FACTURA ELECTRONICA">CONTPAQi® FACTURA ELECTRÓNICA</option>
															<option value="PUNTO DE VENTA">CONTPAQi® PUNTO DE VENTA</option>
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
														<select class="form-control" name="version">
															<option value=""></option>
															<optgroup label="CONTPAQi® CONTABILIDAD">
																<option value="7.2.0">7.2.0</option>
																<option value="7.1.1">7.1.1</option>
																<option value="7.1.0">7.1.0</option>
																<option value="6.1.1">6.1.1</option>
																<option value="6.0.2">6.0.2</option>
																<option value="6.0.1">6.0.1</option>
																<option value="6.0.0">6.0.0</option>
																<option value="5.1.5">5.1.5</option>
																<option value="5.1.4">5.1.4</option>
																<option value="5.1.3">5.1.3</option>
																<option value="5.1.2">5.1.2</option>
																<option value="5.1.1">5.1.1</option>
																<option value="5.1.0">5.1.0</option>
																<option value="5.0.0">5.0.0</option>
															</optgroup>
															<optgroup label="CONTPAQi® NÓMINAS">
																<option value="6.3.0">6.3.0</option>
																<option value="6.2.2">6.2.2</option>
																<option value="6.2.1">6.2.1</option>
																<option value="6.2.0">6.2.0</option>
																<option value="6.1.0">6.1.0</option>
																<option value="6.0.2">6.0.2</option>
																<option value="6.0.1">6.0.1</option>
																<option value="6.0.0">6.0.0</option>
																<option value="5.1.3">5.1.3</option>
																<option value="5.1.2">5.1.2</option>
																<option value="5.1.0">5.1.0</option>
																<option value="5.0.1">5.0.1</option>
																<option value="5.0.0">5.0.0</option>
																<option value="4.0.6">4.0.6</option>
																<option value="4.0.5">4.0.5</option>
																<option value="4.0.4">4.0.4</option>
																<option value="4.0.3">4.0.3</option>
																<option value="4.0.2">4.0.2</option>
																<option value="4.0.1">4.0.1</option>
																<option value="4.0.0">4.0.0</option>
															</optgroup>
															<optgroup label="CONTPAQi® BANCOS">
																<option value="7.2.0">7.2.0</option>
																<option value="7.1.1">7.1.1</option>
																<option value="7.1.0">7.1.0</option>
																<option value="6.1.0">6.1.0</option>
																<option value="6.0.2">6.0.2</option>
																<option value="6.0.1">6.0.1</option>
																<option value="6.0.0">6.0.0</option>
																<option value="5.1.5">5.1.5</option>
																<option value="5.1.4">5.1.4</option>
																<option value="5.1.3">5.1.3</option>
																<option value="5.1.2">5.1.2</option>
																<option value="5.1.1">5.1.1</option>
																<option value="5.1.0">5.1.0</option>
																<option value="5.0.0">5.0.0</option>
															</optgroup>
															<optgroup label="CONTPAQi® ADMINPAQ®">
																<option value="7.3.3">7.3.3</option>
																<option value="7.3.2">7.3.2</option>
																<option value="7.3.1">7.3.1</option>
																<option value="7.3.0">7.3.0</option>
																<option value="7.2.1">7.2.1</option>
																<option value="7.2.0">7.2.0</option>
																<option value="7.1.2">7.1.2</option>
																<option value="7.1.1">7.1.1</option>
																<option value="7.0.0">7.0.0</option>
															</optgroup>
															<optgroup label="CONTPAQi® COMERCIAL">
																<option value="1.0.1">1.0.1</option>
															</optgroup>
															<optgroup label="CONTPAQi® FACTURA ELECTRÓNICA">
																<option value="2.5.2">2.5.2</option>
																<option value="2.5.1">2.5.1</option>
																<option value="2.5.0">2.5.0</option>
																<option value="2.3.2">2.3.2</option>
																<option value="2.3.1">2.3.1</option>
																<option value="2.3.0">2.3.0</option>
																<option value="2.2.1">2.2.1</option>
																<option value="2.2.0">2.2.0</option>
																<option value="2.1.0">2.1.0</option>
																<option value="2.2.0">2.2.0</option>
															</optgroup>
															<optgroup label="CONTPAQi® PUNTO DE VENTA">
																<option value="3.2.2">3.2.2</option>
																<option value="3.2.0">3.2.0</option>
																<option value="3.1.1">3.1.1</option>
																<option value="3.0.0">3.0.0</option>
															</optgroup>
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
											<h4>Info. Equipo de Cómputo <small>- Puedes añadir mas registros en la seccion de gestión</small></h4>
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
														<i class="fa fa-desktop"></i>
														<select class="form-control" name="sistema_operativo">
															<option value=""></option>
															<option value="Windows XP">Windows XP</option>
															<option value=">Windows Vista Starter">Windows Vista Starter</option>
															<option value=">Windows Vista Home Basic">Windows Vista Home Basic</option>
															<option value=">Windows Vista Home Premium">Windows Vista Home Premium</option>
															<option value=">Windows Vista Business">Windows Vista Business</option>
															<option value=">Windows Vista Enterprise">Windows Vista Enterprise</option>
															<option value=">Windows Vista Ultimate">Windows Vista Ultimate</option>
															<option value=">Windows Vista Starter">Windows Vista Starter</option>
															<option value="Windows 7 Starter">Windows 7 Starter</option>
															<option value="Windows 7 Home Basic">Windows 7 Home Basic</option>
															<option value="Windows 7 Home Premium">Windows 7 Home Premium</option>
															<option value="Windows 7 Professional">Windows 7 Professional</option>
															<option value="Windows 7 Ultimate">Windows 7 Ultimate</option>
															<option value="Windows 7 Enterprise">Windows 7 Enterprise</option>
															<option value="Windows 8">Windows 8  </option>
															<option value="Windows 8 Single">Windows 8 Single</option>
															<option value="Windows 8 Pro">Windows 8 Pro</option>
															<option value="Windows 8 Enterprise">Windows 8 Enterprise</option>
															<option value="Windows 8.1">Windows 8.1 </option>
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
										</div>
									</div>
									<div class="form-actions fluid">
										<div class="row">
											<div class="col-md-12">
												<div class="col-md-offset-4 col-md-9">
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