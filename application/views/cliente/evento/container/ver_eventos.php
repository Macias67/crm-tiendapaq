<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Eventos del día - <small><?php echo $usuario_activo['razon_social'] ?></small></h3>
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
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height:400px">
							<table class="table table-striped table-bordered table-hover" id="tabla-catalogo-eventos">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Modalidad</th>
										<th>Precio</th>
										<th>Fecha de inicio</th>
										<th>Ejecutivo</th>
										<th width="1%"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($eventos_revision as $evento): ?>
										<tr class="odd gradeX">
											<td><?php echo $evento->titulo ?></td>
											<td><?php echo $evento->modalidad ?></td>
											<td>$ <?php echo $evento->costo ?></td>
											<td><?php echo fecha_completa($evento->fecha_inicio) ?></td>
											<td><?php echo $evento->primer_nombre.' '.$evento->apellido_paterno ?></td>
											<td><a class="btn btn-circle blue btn-xs" href="<?php echo site_url('eventos/registro_evento/'.$evento->id_evento) ?>"> Registro </a></td>
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