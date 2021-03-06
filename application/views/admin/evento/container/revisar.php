<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Gestionar Eventos - <small><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?></small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN TABLA EVENTOS-->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-speech"></i>
							<span class="caption-subject bold uppercase"> Catálogo de eventos</span>
						</div>
						<div class="actions">
							<a href="<?php echo site_url('evento/gestionar/nuevo') ?>" class="btn btn-circle green">
							<i class="fa fa-plus"></i> Agregar </a>
						</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height:400px">
							<table class="table table-striped table-bordered table-hover" id="tabla-catalogo-eventos">
								<thead>
									<tr>
										<th width="10%">Fecha de inicio</th>
										<th width="10%">Nombre</th>
										<th width="10%">Modalidad</th>
										<th width="1%">Precio</th>
										<th width="10%">Ejecutivo</th>
										<th width="1%">Participantes</th>
										<th width="1%"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($eventos_revision as $evento): ?>
										<tr class="odd gradeX">
											<td><?php echo fecha_completa($evento->fecha_inicio) ?></td>
											<td><?php echo $evento->titulo ?></td>
											<td><?php echo $evento->modalidad ?></td>
											<td>$ <?php echo $evento->costo ?></td>
											<td><?php echo $evento->primer_nombre.' '.$evento->apellido_paterno ?></td>
											<td><a class="btn btn-circle green-meadow btn-xs" href="<?php echo site_url('evento/participantes_detalles/'.$evento->id_evento) ?>"><?php echo $evento->total_participantes ?></a></td>
											<td><a class="btn btn-circle blue btn-xs" href="<?php echo site_url('evento/gestionar/editar/'.$evento->id_evento.'/'.$evento->id_ejecutivo) ?>"><i class="fa fa-search"></i> Ver/editar</a></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- END TABLA EVENTOS-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->
<!-- BEGIN DETALLES MODAL -->
<div id="ajax-detalles-evento" class="modal fade" role="basic" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
		<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
		<span>Cargando... </span>
	</div>
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<!-- END DETALLES MODAL