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
						<div class="portlet box grey">
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
						</div>
						<!-- END TABLA CONTACTOS -->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->
