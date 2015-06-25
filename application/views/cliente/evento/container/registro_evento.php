<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Registro al evento - <small><?php echo $usuario_activo['razon_social'] ?></small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN TABLA CONTACTOS PARA EVENTOS -->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-puzzle font-red-flamingo"></i>
							<span class="caption-subject bold font-red-flamingo uppercase">
							Contáctos </span>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-hover table-bordered" id="tabla_contactos_eventos">
							<thead>
								<tr>
									<th>Nombre(s)</th>
									<th>Apellido Paterno</th>
									<th>Apellido Materno</th>
									<th>Email</th>
									<th>Teléfono</th>
									<th width="1%"></th>
								</tr>
							</thead>
							<tbody>
								<form id="form-contacto" method="post" accept-charset="utf-8">
									<?php foreach ($contactos_cliente as $contacto) : ?>
										<tr class="odd gradeX">
											<td><?php echo $contacto->nombre_contacto ?></td>
											<td><?php echo $contacto->apellido_paterno ?></td>
											<td><?php echo $contacto->apellido_materno ?></td>
											<td><?php echo $contacto->email_contacto ?></td>
											<td><?php echo $contacto->telefono_contacto ?></td>
											<td><a class="btn green-seagreen btn-circle btn-xs" href="<?php echo site_url('eventos/detalles/'.$this->data['id_evento']."/".$contacto->id) ?>" data-target="#ajax-registro-participantes" data-toggle="modal">Registrar</a></td>
										</tr>
									<?php endforeach ?>
								</form>
							</tbody>
						</table>
					</div>
				</div>
				<!-- END TABLA CONTACTOS PARA EVENTOS -->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->

<!-- BEGIN DETALLES EVENTO MODAL -->
<div id="ajax-registro-participantes" class="modal fade" role="basic" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
		<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
		<span>Cargando... </span>
	</div>
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<!-- END DETALLES EVENTO MODAL -->