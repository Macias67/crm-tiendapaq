<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					Bienvenido - <small> <?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?></small>
				</h3>
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
						<div class="caption"><i class="fa fa-bolt"></i> Accesos Rápidos </div>
					</div>
					<div class="portlet-body">
						<!-- Prospecto -->
						<a href="#nuevo-cliente" class="icon-btn" data-toggle="modal">
							<i class="fa  fa-male"></i>
							<div>Prospecto</div>
						</a>
						<!-- Pendiente -->
						<a id="pendiente" class="icon-btn" href="#nuevo-pendiente" data-toggle="modal">
							<i class="fa fa-check-square-o"></i>
							<div>Pendiente</div>
						</a>
						<!-- Cotizador -->
						<a href="<?php echo site_url('cotizador') ?>" class="icon-btn">
							<i class="fa fa-file-o"></i>
							<div>Cotizador</div>
						</a>
						<!-- Calendario <a href="#" class="icon-btn">
							<i class="fa fa-calendar"></i>
							<div>Calendario</div>
						</a> -->
						<!-- Catálogo de Clientes -->
						<a href="<?php echo site_url('cliente/gestionar') ?>" class="icon-btn">
							<i class="fa fa-search"></i>
							<div>&nbsp;&nbsp;Catálogo de clientes&nbsp;&nbsp;</div>
						</a>
						<!-- Todos Mis Pendientes -->
						<a href="<?php echo site_url('perfil') ?>" class="icon-btn">
							<i class="fa fa-list"></i>
							<div>&nbsp;&nbsp;Todos mis pendientes&nbsp;&nbsp;</div>
						</a>
						<!-- Gestor de cotizaciones -->
						<a href="<?php echo site_url('cotizaciones/catalogo') ?>" id="cotizacion_comentada" class="icon-btn">
							<i class="fa fa-file-pdf-o"></i>
							<div>&nbsp;&nbsp;Cotizaciones enviadas&nbsp;&nbsp;</div>
							<?php if ($cotizaciones_comentarios !=0): ?>
								<span class="badge badge-danger">
									<?php echo $cotizaciones_comentarios ?>
								</span>
							<?php endif ?>
						</a>
						<!-- Revision de cotizaciones -->
						<a href="<?php echo site_url('cotizaciones/revisar') ?>"  id="pagos_revisar" class="icon-btn">
							<i class="fa fa-dollar"></i>
							<div>&nbsp;&nbsp;Pagos por revisar&nbsp;&nbsp;</div>
							<?php if ($cotizaciones_revision !=0): ?>
								<span class="badge badge-danger">
									<?php echo $cotizaciones_revision ?>
								</span>
							<?php endif ?>
						</a>
						<!-- Casos por asignar -->
						<?php if($asignador_casos=="si"): ?>
							<a href="<?php echo site_url('caso') ?>" id="casos_asignar" class="icon-btn">
								<i class="fa fa-folder-open"></i>
								<div>&nbsp;&nbsp;Casos por asignar&nbsp;&nbsp;</div>
								<?php if ($casos_asignar!=0): ?>
									<span class="badge badge-danger">
										<?php echo $casos_asignar ?>
									</span>
								<?php endif ?>
							</a>
						<?php endif ?>
						<!-- Abrir caso -->
						<a href="#nuevo-caso" class="icon-btn" data-toggle="modal">
							<i class="fa fa-arrow-circle-o-up"></i>
							<div>Abrir Caso</div>
						</a>
						<!-- Revision de casos -->
						<!-- <a href="<?php echo site_url('caso/revisar') ?>"  id="casos_revisar" class="icon-btn">
							<i class="fa  fa-briefcase"></i>
							<div>&nbsp;&nbsp;Casos&nbsp;&nbsp;</div>
						</a> -->
					</div>
				</div>
			</div>
		</div>
		<!-- Pendientes -->
		<div class="row">
			<div class="col-md-7">
				<div class="col-md-12">
					<!-- BEGIN TABLA MIS PENDIENTES-->
					<div class="portlet gren">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-user"></i> Mis nuevos pendientes sin atender...</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="mis_pendientes">
								<thead>
									<tr>
										<th width="1%">No.</th>
										<th width="15%">Actvidad</th>
										<th width="30%">Cliente</th>
										<th width="20%">Apertura</th>
										<th width="1%"></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($pendientes_usuario as $pendiente) : ?>
									<tr class="odd gradeX">
										<td><?php echo $pendiente->id_pendiente ?></td>
										<td><?php echo $pendiente->actividad ?></td>
										<td><?php echo (empty($pendiente->razon_social)) ? '----' : $pendiente->razon_social ?></td>
										<td><?php echo fecha_completa($pendiente->fecha_origen) ?></td>
										<td>
											<a class="btn btn-circle blue btn-xs" href="<?php echo site_url('/pendiente/detalles/'.$pendiente->id_pendiente) ?>" data-target="#ajax-detalles-pendiente" data-toggle="modal"><i class="fa fa-search"></i> Detalles </a>
										</td>
									</tr>
								<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- END TABLA MIS PENDIENTES-->
				</div>
				<div class="col-md-12">
					<!-- BEGIN TABLA PENDIENTES GENERALES-->
					<div class="portlet gren">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-user"></i> Pendientes generales sin atender...</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="pendientes_grales">
								<thead>
									<tr>
										<th width="1%">No.</th>
										<th width="10%">Ejecutivo</th>
										<th width="40%">Cliente</th>
										<th width="1%"></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($pendientes_generales as $pendiente) : ?>
									<tr class="odd gradeX">
										<td><?php echo $pendiente->id_pendiente ?></td>
										<td><?php echo $pendiente->primer_nombre.' '.$pendiente->apellido_paterno ?></td>
										<td><?php echo (empty($pendiente->razon_social)) ? '----' : $pendiente->razon_social ?></td>
										<td>
											<a class="btn btn-circle blue btn-xs" href="<?php echo site_url('/pendiente/detalles/'.$pendiente->id_pendiente) ?>" data-target="#ajax-detalles-pendiente" data-toggle="modal"><i class="fa fa-search"></i> Detalles </a>
										</td>
									</tr>
								<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- END TABLA PENDIENTES GENERALES-->
				</div>
				<div class="col-md-12">
					<!-- BEGIN TABLA MIS CASOS-->
					<div class="portlet gren">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-user"></i>Casos generales</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="mis_casos">
								<thead>
									<tr>
										<th>Folio</th>
										<th>Cliente</th>
										<th>Lider</th>
										<th>Apertura</th>
										<th>Estatus</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($casos as $caso): ?>
									<tr class="odd gradeX">
										<td><?php echo $caso->folio_cotizacion ?></td>
										<td><?php echo $caso->razon_social ?></td>
										<td><?php echo $caso->primer_nombre.' '.$caso->apellido_paterno ?></td>
										<td><?php echo fecha_completa($caso->fecha_inicio) ?></td>
										<td>
											<?php switch ($caso->id_estatus_general) {
												case 1:
													echo '<p class="btn btn-circle btn-circle btn-xs red"> Cancelado </p>';
												break;
												case 2:
													echo '<p class="btn btn-circle btn-xs default"> Cerrado </p>';
												break;
												case 3:
													echo '<p class="btn btn-circle btn-xs green"> Pendiente </p>';
												break;
												case 5:
													echo '<p class="btn btn-circle btn-xs yellow"> En Proceso</p>';
												break;
												case 7:
													echo '<p class="btn btn-circle btn-xs green"> Reasignado </p>';
												break;
											} ?>
										</td>
										<td><a class="btn blue btn-circle btn-xs" href="<?php echo site_url('/caso/detalles/'.$caso->id_caso) ?>" data-target="#ajax-detalles-caso" data-toggle="modal"><i class="fa fa-search"></i> Detalles</a></td>
									</tr>
								<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- END TABLA MIS CASOS-->
				</div>
			</div>
			<div class="col-md-5">
				<div class="col-md-12">
					<!-- BEGIN TABLA MIS PENDIENTES-->
					<div class="portlet gren">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-search"></i> Búsqueda rápida de clientes.</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="tabla_busqueda_cliente">
								<thead>
									<tr>
										<th width="1%"><i class="fa fa-power-off"></i></th>
										<th width="7%">R.F.C.</th>
										<th width="45%">Razón Social</th>
										<th width="3%">Tipo</th>
										<th width="1%"></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					<!-- END TABLA MIS PENDIENTES-->
				</div>
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->

<!-- BEGIN VENTANAS MODALES -->
<!-- BEGIN FORM NUEVO CLIENTE PROSPECTO-->
<div id="nuevo-cliente" class="modal bs-modal-lg fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">
					<b>Registrar prospecto - </b> <small>Registro de un cliente prospecto en TiendaPAQ</small>
				</h3>
			</div>
			<form action="<?php echo site_url('cliente/nuevo') ?>" id ="form-nuevo-cliente" method="post" accept-charset="utf-8">
				<div class="modal-body form-horizontal">
					<div class="scroller" style="height: 300px" id="div-scroll-prospecto">
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
							<div class="col-md-5">
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
								<!-- TELEFONOS -->
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
								<!-- ACCESO AL SISTEMA -->
								<!-- Usuario -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Usuario<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-user"></i>
											<input type="text" class="form-control" id="usuario" placeholder="Nombre de usuario" name="usuario" value="<?php echo $user_pass_prospecto ?>">
										</div>
									</div>
								</div>
								<!-- Contraseña -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Contraseña<span class="required" aria-required="true" >*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-lock"></i>
											<input type="text" class="form-control" id="password" placeholder="Contraseña" name="password" value="<?php echo $user_pass_prospecto ?>">
										</div>
									</div>
								</div>
							</div>
							<!-- INFORMACION DE CONTACTO -->
							<div class="col-md-7">
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
					<button type="button" data-dismiss="modal" class="btn btn-circle btn-default">Cancelar</button>
					<button type="submit" class="btn btn-circle green">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END FORM NUEVO CLIENTE PROSPECTO-->

<!-- BEGIN NUEVO PENDIENTE -->
<div id="nuevo-pendiente" class="modal fade" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">
					<b>Asignar Pendiente</b>
				</h3>
				<small>Nuevo pendiente por atender</small>
			</div>
			<form action="<?php echo site_url('pendiente/nuevo') ?>" id="form-pendiente" method="post" accept-charset="utf-8">
				<div class="modal-body form-horizontal">
					<div class="scroller" style="height: 300px" id="div-scroll-pendiente">
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
					<button type="button" data-dismiss="modal" class="btn btn-circle btn-default">Cancelar</button>
					<button type="submit" class="btn btn-circle green">Crear</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END NUEVO PENDIENTE -->

<!-- BEGIN NUEVO CASO -->
<div id="nuevo-caso" class="modal fade" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">
					<b>Apertura directa de caso</b>
				</h3>
				<small>Nuevo caso</small>
			</div>
			<form action="<?php echo site_url('caso/abrir') ?>" id="form-caso" method="post" accept-charset="utf-8">
				<div class="modal-body form-horizontal">
					<div class="scroller" style="height: 250px" id="div-scroll-caso">
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
									<label class="control-label col-md-4">Lider</label>
									<div class="col-md-8">
										<select class="form-control" name="lider_caso">
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
										<input type="hidden" id="razon_social_caso" name="razon_social_caso" class="form-control select2">
									</div>
								</div>
								<!-- Descipcion -->
								<div class="form-group">
									<label class="col-md-4 control-label">Descripción</label>
									<div class="col-md-8">
										<textarea class="form-control" rows="3" style="resize: none;" name="descripcion_caso"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-circle btn-default">Cancelar</button>
					<button type="submit" class="btn btn-circle green">Abrir</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END NUEVO CASO -->

<!-- BEGIN AJAX DETALLE PENDIENTE -->
<div id="ajax-detalles-pendiente" class="modal fade" role="basic" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
		<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
		<span>Cargando... </span>
	</div>
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<!-- END AJAX DETALLE PENDIENTE -->

<!-- BEGIN AJAX REASIGNACIONES PENDIENTE -->
<div id="ajax-reasignacion-pendiente" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
		<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
		<span>Cargando... </span>
	</div>
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
	</div>
</div>
<!-- END AJAX REASIGNACIONES PENDIENTE -->

<!-- BEGIN DETALLES CASO  MODAL -->
<div id="ajax-detalles-caso" class="modal fade" role="basic" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
		<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
		<span>Cargando... </span>
	</div>
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<!-- END DETALLES CASO  MODAL