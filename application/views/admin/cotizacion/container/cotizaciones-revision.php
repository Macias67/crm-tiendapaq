<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Cotización - <small>Nuevas cotizaciones pagadas</small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN TABLA MIS PENDIENTES-->
				<div class="portlet gren">
					<div class="portlet-title">
						<div class="caption"><i class="fa fa-user"></i>Cotizaciones en revisión</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height:400px">
							<table class="table table-striped table-bordered table-hover" id="tabla-cotizaciones-revision">
								<thead>
									<tr>
										<th>Folio</th>
										<th>Cliente</th>
										<th>Ejecutivo</th>
										<th>Fecha de creación</th>
										<th>Vigencia</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($cotizaciones_revision as $cotizacion): ?>
										<tr class="odd gradeX">
											<td><?php echo $cotizacion->folio ?></td>
											<td><?php echo $cotizacion->razon_social ?></td>
											<td><?php echo $cotizacion->primer_nombre.' '.$cotizacion->apellido_paterno ?></td>
											<td><?php echo fecha_completa($cotizacion->fecha) ?></td>
											<td><?php echo fecha_completa($cotizacion->vigencia) ?></td>
											<td><a class="btn btn-circle blue btn-xs" href="<?php echo site_url('cotizaciones/revision/'.$cotizacion->folio) ?>"><i class="fa fa-search"></i> Detalles </a></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- END TABLA MIS PENDIENTES-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->