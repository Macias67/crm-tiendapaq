
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
							Color </span>
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
						Bienvenido - <small> <?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?></small>
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
								<!-- Prospecto -->
								<a href="#" class="icon-btn" data-target="#nuevo-cliente" data-toggle="modal">
									<i class="fa  fa-male"></i>
									<div>Prospecto</div>
								</a>
								<!-- Pendiente -->
								<a href="#" id="pendiente" class="icon-btn" data-target="#nuevo-pendiente" data-toggle="modal">
									<i class="fa fa-check-square-o"></i>
									<div>Pendiente</div>
								</a>
								<!-- Cotizador -->
								<a href="<?php echo site_url('cotizador') ?>" class="icon-btn">
									<i class="fa fa-file-o"></i>
									<div>Cotizador</div>
								</a>
								<!-- Calendario -->
								<a href="#" class="icon-btn">
									<i class="fa fa-calendar"></i>
									<div>Calendario</div>
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
												<th>No.</th>
												<th>Actvidad</th>
												<th>Empresa</th>
												<th>Apertura</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
										<?php foreach ($pendientes_usuario as $pendiente) : ?>
											<tr class="odd gradeX">
												<td><?php echo $pendiente->id_pendiente ?></td>
												<td><?php echo $pendiente->actividad ?></td>
												<td><?php echo (empty($pendiente->razon_social)) ? '----' : $pendiente->razon_social ?></td>
												<td><?php echo fecha_completa($pendiente->fecha_origen) ?></td>
												<td><a class="btn default" id="ajax-pendiente" id-pendiente="<?php echo $pendiente->id_pendiente ?>" data-toggle="modal"> Detalles </a></td>
											</tr>
										<?php endforeach ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- END TABLA MIS PENDIENTES-->
					</div>
					<div class="col-md-5">
						<!-- BEGIN TABLA PENDIENTES GENERALES-->
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
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- END TABLA PENDIENTES GENERALES-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->

				<!-- BEGIN VENTANAS MODALES -->

				<!-- BEGIN FORM NUEVO CLIENTE -->
				<div id="nuevo-cliente" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
					<div class="modal-header">
						<h3 class="modal-title">
							<b>Registrar prospecto - </b> <small>Registro de un cliente prospecto en TiendaPAQ</small>
						</h3>
					</div>
					<form action="<?php echo site_url('cliente/nuevo') ?>" id ="form-nuevo-cliente" method="post" accept-charset="utf-8">
						<div class="modal-body form-horizontal">
							<div class="scroller" style="height: 300px">
								<!-- DIV ERROR -->
								<div class="alert alert-danger display-hide">
									<button class="close" data-close="alert"></button>
									Tienes Errores en tu formulario
								</div>
								<!-- DIV SUCCESS -->
								<div class="alert alert-success display-hide">
									<button class="close" data-close="alert"></button>
									Exito en el formulario
								</div>
								<!-- BEGIN FORM BODY -->
								<div class="form-body">
									<!-- INFORMACION BASICA -->
									<div class="col-md-6">
										<h4>Información Básica</h4>
										<!-- Razon Social -->
										<div class="form-group">
											<label class="col-md-4 control-label">
												Razón Social<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-asterisk"></i>
													<input type="text" class="form-control" placeholder="Razón Social" name="razon_social">
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
													<input type="text" class="form-control" placeholder="Email" name="email">
												</div>
											</div>
										</div>
										<hr>
										<!-- TELEFONOS -->
										<h4>Teléfonos</h4>
										<!-- Telefono 1 -->
										<div class="form-group">
											<label class="col-md-4 control-label">
												Teléfono 1 <span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-phone"></i>
													<input type="text" class="form-control" id="telefono1" placeholder="(999) 999-9999" name="telefono1">
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
											<label class="col-md-4 control-label">
												Email <span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa  fa-envelope"></i>
													<input type="text" class="form-control" placeholder="Email" name="email_contacto">
												</div>
											</div>
										</div>
										<!-- Telefono del contacto -->
										<div class="form-group">
											<label class="col-md-4 control-label">
												Teléfono <span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-phone"></i>
													<input type="text" class="form-control" id="telefono_contacto" placeholder="Teléfono" name="telefono_contacto">
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- END FORM BODY -->
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
							<button type="submit" class="btn green">Guardar</button>
						</div>
					</form>
				</div>
				<!-- END FORM NUEVO CLIENTE -->

				<!-- BEGIN NUEVO PENDIENTE -->
				<div id="nuevo-pendiente" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
					<div class="modal-header">
						<h3 class="modal-title">
							<b>Asignar Pendiente</b>
						</h3>
						<small>Nuevo pendiente por atender</small>
					</div>
					<form action="<?php echo site_url('pendiente/nuevo') ?>" id="form-pendiente" method="post" accept-charset="utf-8">
						<div class="modal-body form-horizontal">
							<div class="scroller" style="height: 300px">
								<!-- DIV ERROR -->
								<div class="alert alert-danger display-hide">
									<button class="close" data-close="alert"></button>
									Tienes Errores en tu formulario
								</div>
								<!-- DIV SUCCESS -->
								<div class="alert alert-success display-hide">
									<button class="close" data-close="alert"></button>
									Exito en el formulario
								</div>
								<div class="form-body">
									<div class="col-md-12">
										<!-- Ejectuivo -->
										<div class="form-group">
											<label class="control-label col-md-4">Ejecutivo</label>
											<div class="col-md-8">
												<select class="form-control" name="ejecutivo">
													<option value=""></option>
													<?php foreach ($ejecutivos as $ejecutivo): ?>
													<option value="<?php echo $ejecutivo->id ?>"><?php echo $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
										<!-- Empresa -->
										<div class="form-group">
											<label class="control-label col-md-4">Razón Social</label>
											<div class="col-md-8">
												<input type="hidden" id="razon_social" name="razon_social" class="form-control select2">
											</div>
										</div>
										<!-- Actividad -->
										<div class="form-group">
											<label class="control-label col-md-4">Actividad</label>
											<div class="col-md-8">
												<select class="form-control" name="actividad">
													<option value=""></option>
													<?php foreach ($actividades_pendientes as $actividad_pendiente): ?>
														<option value="<?php echo $actividad_pendiente->id_actividad ?>"><?php echo $actividad_pendiente->actividad ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
										<!-- Fecha -->
										<div class="form-group">
											<label class="col-md-4 control-label">Descripción</label>
											<div class="col-md-8">
												<textarea class="form-control" rows="3" style="resize: none;" name="descripcion"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
							<button type="submit" class="btn green">Abrir</button>
						</div>
					</form>
				</div>
				<!-- END NUEVO PENDIENTE -->

				<!-- BEGIN AJAX DETALLE PENDIENTE -->
				<div id="ajax-modal" class="modal fade" tabindex="-1"></div>
				<!-- END AJAX DETALLE PENDIENTE -->

				<!-- END VENTANAS MODALES -->
			</div>
		</div>
		<!-- END CONTENT -->