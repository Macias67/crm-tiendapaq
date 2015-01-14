<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title"> Bienvenido a CRM TiendaPAQ - <small><?php echo $usuario_activo['razon_social'] ?></small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-8 col-sm-8">
				<!-- BEGIN PEDIDOS CLIENTE PEDIENTES PORTLET-->
				<div class="portlet gren">
					<div class="portlet-title">
						<div class="caption"><i class="fa fa-user"></i> Cotizaciones Pendientes</div>
						<div class="tools">
							<a href="javascript:;" class="collapse">
							</a>
							<a href="javascript:;" class="reload">
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="sample_2">
							<thead>
								<tr>
									<th>Folio</th>
									<th>Fecha de emisión</th>
									<th>Vigencia hasta</th>
									<th>Oficina</th>
									<th>Estatus</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($cotizaciones as $cotizacion): ?>
								<tr>
									<td><?php echo $cotizacion->folio ?></td>
									<td><?php echo fecha_formato($cotizacion->fecha) ?></td>
									<td><?php echo fecha_formato($cotizacion->vigencia) ?></td>
									<td><?php echo $cotizacion->ciudad_estado ?></td>
									<?php switch ($cotizacion->id_estatus) {
										// por pagar
										case 1:
											echo '
												<td><span class="btn btn-circle btn-xs green disabled">'.ucfirst($cotizacion->descripcion).'</span></td>
												<td>
													<a class="btn red default btn-circle btn-xs" href="'.site_url("cotizacion/descarga/".$cotizacion->folio).'"><i class="fa fa-file-o"></i> Descargar</a>
													<a href="'.site_url("gestionar/basica/verificar/".$cotizacion->folio).'" class="btn blue btn-circle btn-xs" data-target="#ajax-verificar-info" data-toggle="modal"><i class="fa fa-dollar"></i> Comprobar Pago</a>
												</td>';
										break;
										// en revision
										case 2:
											echo '<td><span class="btn btn-circle btn-xs yellow disabled">'.ucfirst($cotizacion->descripcion).'</span></td>
														<td>
															<button type="button" class="btn green default cotizacion-previa btn-circle btn-xs" id="'.$cotizacion->folio.'"><i class="fa fa-file-o"></i> Vista Previa</button>
															<a href="'.site_url("cotizacion/comprobante/".$cotizacion->folio).'" class="btn blue btn-circle btn-xs"> Ver Pago</a>
														</td>';
										break;
										//correcta
										case 3:
											echo '<td><span class="btn btn-circle btn-xs green disabled">'.ucfirst($cotizacion->descripcion).'</span></td>
														<td>
															<button type="button" class="btn green default cotizacion-previa btn-circle btn-xs" id="'.$cotizacion->folio.'"><i class="fa fa-file-o"></i> Vista Previa</button>
															<a href="'.site_url("cotizacion/comprobante/".$cotizacion->folio).'" class="btn blue btn-circle btn-xs"> Ver Pago</a>
														</td>';
										break;
										//irregular
										case 4:
											echo '<td><span class="btn btn-circle btn-xs red disabled">'.ucfirst($cotizacion->descripcion).'</span></td>
														<td>
															<a class="btn red default btn-circle btn-xs" href="'.site_url("cotizacion/descarga/".$cotizacion->folio).'"><i class="fa fa-file-o"></i> Descargar</a>
															<a href="'.site_url("cotizacion/comprobante/".$cotizacion->folio).'" class="btn blue btn-circle btn-xs"><i class="fa fa-dollar"></i> Cambiar Comprobante</a>
														</td>';
										break;
										//vencida
										case 5:
											echo '<td><span class="btn btn-circle btn-xs red disabled">'.ucfirst($cotizacion->descripcion).'</span></td>
														<td>
															<button type="button" class="btn green default cotizacion-previa btn-circle btn-xs" id="'.$cotizacion->folio.'"><i class="fa fa-file-o"></i> Vista Previa</button>
														</td>';
										break;
										//pago parcial
										case 6:
											echo '
												<td><span class="btn btn-circle btn-xs yellow disabled">'.ucfirst($cotizacion->descripcion).'</span></td>
												<td>
													<a class="btn red default btn-circle btn-xs" href="'.site_url("cotizacion/descarga/".$cotizacion->folio).'"><i class="fa fa-file-o"></i> Descargar</a>
													<a href="'.site_url("gestionar/basica/verificar/".$cotizacion->folio).'" class="btn blue btn-circle btn-xs" data-target="#ajax-verificar-info" data-toggle="modal"><i class="fa fa-dollar"></i> Comprobar Pago</a>
												</td>';
										break;
									} ?>
								</tr>
							<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- END PEDIDOS CLIENTE PEDIENTES PORTLET-->
			</div>
			<div class="col-md-4 col-sm-4">
				<!-- BEGIN VIDEO TUTORIAL PORTLET-->
				<div class="portlet gren">
					<div class="portlet-title">
						<div class="caption"><i class="fa fa-user"></i> Tutorial</div>
						<div class="tools">
							<a href="javascript:;" class="collapse">
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<iframe width="100%" height="270px" src="//www.youtube.com/embed/FqPPZlVCvOQ" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
				<!-- END VIDEO TUTORIAL PORTLET-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->

<!-- BEGIN AJAX VERIFICAR INFO-->
<div id="ajax-verificar-info" class="modal bs-modal-lg fade" data-backdrop="static" role="basic" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
		<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
		<span>Cargando... </span>
	</div>
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
	</div>
</div>
<!-- END AJAX VERIFICAR INFO-->

<!-- BEGIN AJAX PORQUE -->
<div id="ajax-porque" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
		<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
		<span>Cargando... </span>
	</div>
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<!-- END AJAX PORQUE -->