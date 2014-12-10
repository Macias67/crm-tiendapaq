<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title"> Contactos - <small><?php echo $usuario_activo['razon_social'] ?></small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN TABLA CONTACTOS -->
				<!-- <div class="portlet box grey">
					<div class="portlet-title">
						<div class="caption" style="color: black">
							<i class="fa fa-users"></i> Contactos
						</div>
						<div class="tools" style="color: black">
							<a href="javascript:;" class="collapse">
							</a>
							<a href="javascript:;" class="reload">
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-hover table-bordered" id="tabla_contactos_cliente">
							<thead>
								<tr>
									<th>Nombre(s)</th>
									<th>Apellido Paterno</th>
									<th>Apellido Materno</th>
									<th>Email</th>
									<th>Teléfono</th>
									<th>Puesto</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($contactos_cliente as $contacto) : ?>
									<tr id="<?php echo $contacto->id ?>">
										<td><?php echo $contacto->nombre_contacto ?></td>
										<td><?php echo $contacto->apellido_paterno ?></td>
										<td><?php echo $contacto->apellido_materno ?></td>
										<td><?php echo $contacto->email_contacto ?></td>
										<td><?php echo $contacto->telefono_contacto ?></td>
										<td><?php echo $contacto->puesto_contacto ?></td>
										<td><a class="edit" href="javascript:;">Editar </a></td>
										<td><a class="delete" href="javascript:;">Eliminar </a></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
						<br>
						<div class="table-toolbar">
							<div class="btn-group pull-right">
								<button id="tabla_contactos_cliente_new" class="btn green btn-circle btn-xs">
									<i class="fa fa-plus"></i> Nuevo Contacto
								</button>
							</div>
						</div>
					</div>
				</div> -->
				<!-- END TABLA CONTACTOS -->

				<!-- BEGIN TABLA CONTACTOS -->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-puzzle font-red-flamingo"></i>
							<span class="caption-subject bold font-red-flamingo uppercase">
							Contáctos </span>
						</div>
						<div class="actions">
							<a class="btn btn-circle green"  data-toggle="modal" href="#nuevo_contacto_form">
								<i class="fa fa-plus"></i> Agregar
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-hover table-bordered" id="tabla_contactos" id-cliente="<?php echo $usuario_activo['id'] ?>">
							<thead>
								<tr>
									<th>Nombre(s)</th>
									<th>Apellido Paterno</th>
									<th>Apellido Materno</th>
									<th>Email</th>
									<th>Teléfono</th>
									<th>Puesto</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($contactos_cliente as $contacto) : ?>
									<tr class="odd gradeX" id="<?php echo $contacto->id ?>">
										<td><?php echo $contacto->nombre_contacto ?></td>
										<td><?php echo $contacto->apellido_paterno ?></td>
										<td><?php echo $contacto->apellido_materno ?></td>
										<td><?php echo $contacto->email_contacto ?></td>
										<td><?php echo $contacto->telefono_contacto ?></td>
										<td><?php echo $contacto->puesto_contacto ?></td>
										<td width="1%"><a href="<?php echo site_url('cliente/contacto/'.$contacto->id) ?>" data-target="#ajax_form_contacto" data-toggle="modal" class="btn btn-circle blue btn-xs"><i class="fa fa-search-plus"></i> Ver/Editar</button></td>
										<td width="1%"><button type="button" class="btn btn-circle red btn-xs eliminar-contacto"><i class="fa fa-trash-o"></i> Eliminar</button></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- END TABLA CONTACTOS -->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->

<!-- CONTACTO -->
<div id="nuevo_contacto_form" class="modal fade" tabindex="-1" data-backdrop="static" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><b>Contácto</b></h3>
				<small> </small>
			</div>
			<form id ="form-contacto-nuevo" method="post" accept-charset="utf-8">
				<div class="modal-body form-horizontal">
					<div class="col-md-12">
						<!-- DIV ERROR -->
						<div class="alert alert-danger  display-hide">
							<button class="close" data-close="alert"></button>
							Tienes errores en tu formulario
						</div>
						<!-- BEGIN FORM BODY -->
						<div class="form-body">
							<div class="col-md-12">
								<!-- Nombre(s) -->
								<div class="form-group">
									<label class="col-md-4 control-label">Nombre(s): </label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-user"></i>
											<input type="hidden" class="form-control" name="id_cliente" value="<?php echo $usuario_activo['id'] ?>">
											<input type="text" class="form-control" placeholder="Nombre(s)" name="nombre_contacto">
										</div>
									</div>
								</div>
								<!-- Apellido paterno -->
								<div class="form-group">
									<label class="col-md-4 control-label">Apellido paterno: </label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-user"></i>
											<input type="text" class="form-control" placeholder="Apellido paterno" name="apellido_paterno">
										</div>
									</div>
								</div>
								<!-- Apellido materno -->
								<div class="form-group">
									<label class="col-md-4 control-label">Apellido materno: </label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-user"></i>
											<input type="text" class="form-control" placeholder="Apellido materno" name="apellido_materno">
										</div>
									</div>
								</div>
								<!-- Email -->
								<div class="form-group">
									<label class="col-md-4 control-label">Email: </label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-envelope"></i>
											<input type="text" class="form-control" placeholder="Email" name="email_contacto">
										</div>
									</div>
								</div>
								<!-- Teléfono -->
								<div class="form-group">
									<label class="col-md-4 control-label">Teléfono: </label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-phone"></i>
											<input type="text" class="form-control telefono_contacto" placeholder="Teléfono" name="telefono_contacto">
										</div>
									</div>
								</div>
								<!-- Puesto -->
								<div class="form-group">
									<label class="col-md-4 control-label">Puesto: </label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-certificate"></i>
											<input type="text" class="form-control" placeholder="Puesto" name="puesto_contacto">
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END FORM BODY -->
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
					<button type="submit" id="btn_guardar_contacto" class="btn green">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--DOC: Aplly "modal-cached" class after "modal" class to enable ajax content caching-->
<div id="ajax_form_contacto" class="modal container fade" role="basic" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
		<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
		<span>Cargando... </span>
	</div>
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<!-- /.modal -->
