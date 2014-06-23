
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
							Elige un color </span>
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
								<a href="<?php echo base_url() ?>">Inicio</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<!-- Menu -->
				<div class="row">
					<div class="col-md-12">
						<div class="portlet gren">
							<div class="portlet-title">
								<div class="caption"><i class="fa fa-user"></i>Menú</div>
							</div>
							<div class="portlet-body">
								<a href="#" class="icon-btn" data-target="#nuevo-cliente" data-toggle="modal">
									<i class="fa fa-building"></i>
									<div>Nuevo Cliente</div>
								</a>
								<a href="#" class="icon-btn" data-target="#nuevo-ticket" data-toggle="modal">
									<i class="fa fa-ticket"></i>
									<div>Abrir Ticket</div>
								</a>
								<a href="#" class="icon-btn">
									<i class="fa fa-calendar"></i>
									<div>Calendario</div>
									<span class="badge badge-success">4 </span>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-envelope"></i>
								<div>
								Inbox
								</div>
								<span class="badge badge-info">
								12 </span>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-bullhorn"></i>
								<div>
								Notification
								</div>
								<span class="badge badge-danger">
								3 </span>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-map-marker"></i>
								<div>
								Locations
								</div>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-money"><i></i></i>
								<div>
								Finance
								</div>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-plane"></i>
								<div>
								Projects
								</div>
								<span class="badge badge-info">
								21 </span>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-thumbs-up"></i>
								<div>
								Feedback
								</div>
								<span class="badge badge-info">
								2 </span>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-cloud"></i>
								<div>
								Servers
								</div>
								<span class="badge badge-danger">
								2 </span>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-globe"></i>
								<div>
								Regions
								</div>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-heart-o"></i>
								<div>
								Popularity
								</div>
								<span class="badge badge-info">
								221 </span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Pendientes -->
				<div class="row">
					<div class="col-md-7">
						<!-- BEGIN TABLA MIS PENDIENTES-->
						<div class="portlet gren">
							<div class="portlet-title">
								<div class="caption"><i class="fa fa-user"></i>Mis Pendientes</div>
							</div>
							<div class="portlet-body">
								<div class="scroller" style="height:400px">
									<table class="table table-striped table-bordered table-hover" id="mis_pendientes">
										<thead>
											<tr>
												<th>Username</th>
												<th>Email</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<tr class="odd gradeX">
												<td>shuxer</td>
												<td>
													<a href="mailto:shuxer@gmail.com">shuxer@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>looper</td>
												<td>
													<a href="mailto:looper90@gmail.com">looper90@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-warning">Suspended </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>
													userwow
												</td>
												<td>
													<a href="mailto:userwow@yahoo.com">userwow@yahoo.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>user1wow</td>
												<td>
													<a href="mailto:userwow@gmail.com">userwow@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-default">Blocked </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>restest</td>
												<td>
													<a href="mailto:userwow@gmail.com">test@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>foopl</td>
												<td>
													<a href="mailto:userwow@gmail.com">good@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>weep</td>
												<td>
													<a href="mailto:userwow@gmail.com">good@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>coop</td>
												<td>
													<a href="mailto:userwow@gmail.com">good@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- END TABLA MIS PENDIENTES-->
					</div>
					<div class="col-md-5">
						<!-- BEGIN TABLA MIS PENDIENTES-->
						<div class="portlet gren">
							<div class="portlet-title">
								<div class="caption"><i class="fa fa-user"></i>Pendientes Generales</div>
							</div>
							<div class="portlet-body">
								<div class="scroller" style="height:400px">
									<table class="table table-striped table-bordered table-hover" id="pendientes_grales">
										<thead>
											<tr>
												<th>Username</th>
												<th>Email</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<tr class="odd gradeX">
												<td>shuxer</td>
												<td>
													<a href="mailto:shuxer@gmail.com">shuxer@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>looper</td>
												<td>
													<a href="mailto:looper90@gmail.com">looper90@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-warning">Suspended </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>
													userwow
												</td>
												<td>
													<a href="mailto:userwow@yahoo.com">userwow@yahoo.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>user1wow</td>
												<td>
													<a href="mailto:userwow@gmail.com">userwow@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-default">Blocked </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>restest</td>
												<td>
													<a href="mailto:userwow@gmail.com">test@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>foopl</td>
												<td>
													<a href="mailto:userwow@gmail.com">good@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>weep</td>
												<td>
													<a href="mailto:userwow@gmail.com">good@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>coop</td>
												<td>
													<a href="mailto:userwow@gmail.com">good@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- END TABLA MIS PENDIENTES-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->

				<!-- BEGIN VENTANAS MODALES -->
				<!-- Nuevo Cliente -->
				<div id="nuevo-cliente" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
					<div class="modal-header">
						<h3 class="modal-title">
							<b>Registrar nuevo cliente</b>
						</h3>
						<small>Registro de un cliente en TiendaPAQ</small>
					</div>
					<form action="<?php echo site_url('cliente/add') ?>" method="post" accept-charset="utf-8">
						<div class="modal-body form-horizontal">
							<div class="scroller" style="height: 500px">
								<div class="form-body">
									<div class="col-md-6">
										<h4>Información Básica</h4>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Razón Social
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-asterisk"></i>
													<input type="text" class="form-control" placeholder="Razón Social">
													<!-- <span class="help-block">A block of help text. </span> -->
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">
												R.F.C.
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-barcode"></i>
													<input type="text" class="form-control" placeholder="R.F.C.">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Email</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa  fa-envelope"></i>
													<input type="text" class="form-control" placeholder="Email">
												</div>
											</div>
										</div>

										<hr>

										<h4>Domicilio</h4>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Calle
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="Calle">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">
												No. Exterior
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="No. Exterior">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">No. Interior</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="No. Interior">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Colonia</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="Colonia">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Código Postal</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="Código Postal">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Ciudad</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="Ciudad">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Municipio</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="Municipio">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Estado</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="Estado">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">País</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="País">
												</div>
											</div>
										</div>

										<hr>

										<h4>Teléfonos</h4>
										<div class="form-group">
											<label class="col-md-4 control-label">Teléfono 1</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-phone"></i>
													<input type="text" class="form-control" placeholder="(999) 999-9999">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Teléfono 2</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-phone"></i>
													<input type="text" class="form-control" placeholder="(999) 999-9999">
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<h4>Contácto <small>- Puedes añadir más contactos en la seccion de gestión</small></h4>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Nombre
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-user"></i>
													<input type="text" class="form-control" placeholder="Nombre">
													<!-- <span class="help-block">A block of help text. </span> -->
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Email</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa  fa-envelope"></i>
													<input type="text" class="form-control" placeholder="Email">
													<span class="help-block">Email personal de la empresa</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Teléfono</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-phone"></i>
													<input type="text" class="form-control" placeholder="Teléfono">
													<span class="help-block">En la empresa (extensión o departamento)</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Puesto</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-certificate"></i>
													<input type="text" class="form-control" placeholder="Puesto">
												</div>
											</div>
										</div>

										<hr>

										<h4>Sistemas de CONTPAQi <small>- Puedes añadir más sistemas en la seccion de gestión</small></h4>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Sistema
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-desktop"></i>
													<select class="form-control">
														<option>Option 1</option>
														<option>Option 2</option>
														<option>Option 3</option>
														<option>Option 4</option>
														<option>Option 5</option>
													</select>
													<!-- <span class="help-block">A block of help text. </span> -->
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Versión</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-history"></i>
													<select class="form-control">
														<option>Option 1</option>
														<option>Option 2</option>
														<option>Option 3</option>
														<option>Option 4</option>
														<option>Option 5</option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">No. de Serie</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-barcode"></i>
													<input type="text" class="form-control" placeholder="No. de Serie">
												</div>
											</div>
										</div>

										<hr>

										<h4>Info. Equipo de Cómputo <small>- Puedes añadir mas registros en la seccion de gestión</small></h4>
										<div class="form-group">
											<label class="col-md-4 control-label">Nombre del Equipo</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-desktop"></i>
													<input type="text" class="form-control" placeholder="Nombre del Equipo">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Sistema Operativo
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-desktop"></i>
													<select class="form-control">
														<option>Option 1</option>
														<option>Option 2</option>
														<option>Option 3</option>
														<option>Option 4</option>
														<option>Option 5</option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Arquitectura
											</label>
											<div class="col-md-8">
												<div class="radio-list">
													<label class="radio-inline">
														<input type="radio" name="arquitectura" id="arquitectura1" value="option1" checked>
														x64 (64 bits)
													</label>
													<label class="radio-inline">
														<input type="radio" name="arquitectura" id="arquitectura2" value="option2">
														x86 (32 bits)
													</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Máquina Virtual
											</label>
											<div class="col-md-8">
												<div class="radio-list">
													<label class="radio-inline">
														<input type="radio" name="maquina_virtual" id="maquina_virtual1" value="option1">
														Sí
													</label>
													<label class="radio-inline">
														<input type="radio" name="maquina_virtual" id="maquina_virtual2" value="option2" checked>
														No
													</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Memoria RAM
											</label>
											<div class="col-md-8">
												<div id="memoria-ram">
													<div class="input-group input-small">
														<input type="text" class="spinner-input form-control" maxlength="2">
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
										<div class="form-group">
											<label class="col-md-4 control-label">
												SQL Server
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-database"></i>
													<select class="form-control">
														<option>Option 1</option>
														<option>Option 2</option>
														<option>Option 3</option>
														<option>Option 4</option>
														<option>Option 5</option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">
												SQL Server Management
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-database"></i>
													<select class="form-control">
														<option>Option 1</option>
														<option>Option 2</option>
														<option>Option 3</option>
														<option>Option 4</option>
														<option>Option 5</option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Instancia SQL</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa  fa-database"></i>
													<input type="text" class="form-control" placeholder="Instancia SQL">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Contraseña SQL</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa  fa-database"></i>
													<input type="text" class="form-control" placeholder="Contraseña SQL">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
							<button type="submit" class="btn green">Guardar</button>
						</div>
					</form>
				</div>

				<!-- Nuevo Ticket -->
				<div id="nuevo-ticket" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
					<div class="modal-body">
						<p>Would you like to continue with some arbitrary task?</p>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
						<button type="button" data-dismiss="modal" class="btn blue">Continue Task</button>
					</div>
				</div>
				<!-- END VENTANAS MODALES -->
			</div>
		</div>
		<!-- END CONTENT -->