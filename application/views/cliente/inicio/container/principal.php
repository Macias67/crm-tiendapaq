
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
					<div class="col-md-12 col-sm-12">
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
													echo '<td><span class="btn btn-xs green">'.ucfirst($cotizacion->descripcion).'</span></td>
																<td>
																	<button type="button" class="btn green default cotizacion-previa btn-xs" id="'.$cotizacion->folio.'"><i class="fa fa-file-o"></i> Vista Previa</button>
																	<a class="btn red default btn-xs" href="'.site_url("cotizacion/descarga/".$cotizacion->folio).'"><i class="fa fa-file-o"></i> Descargar</a>
																	<a href="'.site_url("cotizacion/comprobante/".$cotizacion->folio).'" class="btn blue btn-xs"><i class="fa fa-dollar"></i> Comprobar Pago</a>
																</td>';
												break;
												// en revision
												case 2:
													echo '<td><span class="btn btn-xs yellow">'.ucfirst($cotizacion->descripcion).'</span></td>
																<td>
																	<a href="'.site_url("cotizacion/comprobante/".$cotizacion->folio).'" class="btn blue btn-xs"> Ver de Pago</a>
																</td>';
												break;
												//carrecta
												case 3:
													echo '<td><span class="btn btn-xs green">'.ucfirst($cotizacion->descripcion).'</span></td>
																<td>
																	<a href="'.site_url("cotizacion/comprobante/".$cotizacion->folio).'" class="btn blue btn-xs"> Ver de Pago</a>
																</td>';
												break;
												//irregular
												case 4:
													echo '<td><span class="btn btn-xs red">'.ucfirst($cotizacion->descripcion).'</span></td>
																<td>
																	<a href="'.site_url("cotizacion/comprobante/".$cotizacion->folio).'" class="btn blue btn-xs"><i class="fa fa-dollar"></i> Cambiar Comprobante</a>
																</td>';
												break;
												//vencida
												case 5:
													echo '<td><span class="btn btn-xs red">'.ucfirst($cotizacion->descripcion).'</span></td>
																<td>
																</td>';
												break;
												//pago parcial
												case 6:
													echo '<td><span class="btn btn-xs yellow">'.ucfirst($cotizacion->descripcion).'</span></td>
																<td>
																	<a href="'.site_url("cotizacion/comprobante/".$cotizacion->folio).'" class="btn blue btn-xs"><i class="fa fa-dollar"></i> Comprobar Pago</a>
																</td>';
												break;

												default:
													# code...
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
				</div>
				<!-- END PAGE CONTENT-->

				<!-- ajax -->
				<div id="ajax-modal-verificacion" class="modal container hide" tabindex="-1"></div>

			</div>
		</div>
		<!-- END CONTENT -->