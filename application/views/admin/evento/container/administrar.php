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
							<a href="<?php echo site_url('cliente/gestionar/nuevo') ?>" class="btn btn-circle green">
							<i class="fa fa-plus"></i> Agregar </a>
						</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height:400px">
							<table class="table table-striped table-bordered table-hover" id="tabla-catalogo-eventos">
								<thead>
									<tr>
										<th width="1%">No.</th>
										<th width="10%">Ejecutivo</th>
										<th width="20%">Cliente</th>
										<th width="10%">Título</th>
										<th width="20%">Descripción</th>
										<th width="20%">Temario</th>
										<th width="1%">Sesiones</th>
										<th width="15%">Fecha de evento</th>
										<th width="5%">Horario</th>
										<th width="1%">Duración</th>
										<th width="1%">Costo</th>
										<th width="1%"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($eventos_revision as $evento): ?>
										<tr class="odd gradeX">
											<td><?php echo $evento->id_evento ?></td>
											<td><?php echo $evento->primer_nombre.' '.$evento->apellido_paterno ?></td>
											<td><?php echo $evento->razon_social ?></td>
											<td><?php echo $evento->titulo ?></td>
											<td><?php echo $evento->descripcion ?></td>
											<td><?php echo $evento->temario ?></td>
											<td><?php echo $evento->sesiones ?></td>
											<td><?php echo $evento->fecha ?></td>
											<td><?php echo $evento->hora ?></td>
											<td><?php echo $evento->duracion ?></td>
											<td><?php echo $evento->costo ?></td>
											<td><a class="btn btn-circle blue btn-xs" href="<?php echo site_url('cotizaciones/revision/'.$evento->folio) ?>"><i class="fa fa-search"></i> Detalles </a></td>
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