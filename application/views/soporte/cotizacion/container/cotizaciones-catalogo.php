<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Cotización - <small>Catálogo de cotizaciones</small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<?php var_dump($this->data) ?>
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN TABLA MIS PENDIENTES-->
				<div class="portlet gren">
					<div class="portlet-title">
						<div class="caption"><i class="fa fa-user"></i>Cotizaciones</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height:400px">
							<table class="table table-striped table-bordered table-hover" id="tabla-catalogo-cotizaciones">
								<thead>
									<tr>
										<th>Folio</th>
										<th>Cliente</th>
										<th>Ejecutivo</th>
										<th>Fecha de creación</th>
										<th>Vigencia</th>
										<th>Estatus</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($cotizaciones as $cotizacion): ?>
										<tr class="odd gradeX">
											<td><?php echo $cotizacion->folio ?></td>
											<td><?php echo $cotizacion->razon_social ?></td>
											<td><?php echo $cotizacion->primer_nombre.' '.$cotizacion->apellido_paterno ?></td>
											<td><?php echo fecha_completa($cotizacion->fecha) ?></td>
											<td><?php echo fecha_completa($cotizacion->vigencia) ?></td>
											<?php switch ($cotizacion->id_estatus_cotizacion) {
												// por pagar
												case 1:
													echo '
														<td><span class="btn btn-circle btn-xs green disabled">'.ucfirst($cotizacion->descripcion).'</span></td>';
												break;
												// en revision
												case 2:
													echo '<td><span class="btn btn-circle btn-xs yellow disabled">'.ucfirst($cotizacion->descripcion).'</span></td>';
												break;
												//correcta
												case 3:
													echo '<td><span class="btn btn-circle btn-xs green disabled">'.ucfirst($cotizacion->descripcion).'</span></td>';
												break;
												//irregular
												case 4:
													echo '<td><span class="btn btn-circle btn-xs red disabled">'.ucfirst($cotizacion->descripcion).'</span></td>';
												break;
												//vencida
												case 5:
													echo '<td><span class="btn btn-circle btn-xs red disabled">'.ucfirst($cotizacion->descripcion).'</span></td>';
												break;
												//pago parcial
												case 6:
													echo '
														<td><span class="btn btn-circle btn-xs yellow disabled">'.ucfirst($cotizacion->descripcion).'</span></td>';
												break;
											} ?>
											<td>
												<a class="btn btn-circle blue btn-xs" href="#" ><i class="fa fa-edit"></i> Editar</a>
											</td>
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