
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">

				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title"><b>Folio # <?php echo $caso->folio_cotizacion ?></b> <small>Caso no. <?php echo $caso->id_caso ?></small></h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-4">
						<!-- <?php var_dump($cotizacion) ?> -->
						<!-- DETALLES CASO -->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-puzzle font-grey-gallery"></i>
									<span class="caption-subject bold font-grey-gallery uppercase">Detalles: </span>
								</div>
							</div>
							<div class="portlet-body">
								<h5>Cliente: </h5>
								<h4><b><?php echo $caso->razon_social ?></b></h4>

								<h5>Líder: </h5>
								<h4><b><?php echo $caso->primer_nombre.' '.$caso->apellido_paterno ?></b></h4>

								<h5>Descripción del caso: </h5>
								<dl>
								<?php if (empty($caso->descripcion)): ?>
								<?php foreach ($detalle_caso as $key => $lista): ?>
									<dt><?php echo ++$key.'. '.$lista['descripcion'] ?></dt>
									<dd><?php echo $lista['observacion'] ?></dd>
								<?php endforeach ?>
								<?php else: ?>
								<dt><?php echo $caso->descripcion ?></dt>
								<?php endif ?>
								</dl>

								<h5>Apertura del caso: </h5>
								<h5><b><?php echo fecha_completa($caso->fecha_inicio) ?></b></h5>
							</div>
						</div>

						<?php if(!is_null($caso->folio_cotizacion)): ?>
						<!-- DETALLES COTIZACION -->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-puzzle font-grey-gallery"></i>
									<span class="caption-subject bold font-grey-gallery uppercase">Cotización: </span>
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse" data-original-title="" title=""></a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="row">
									<div class="col-md-2">
										<h5>Folio: </h5>
										<h4><b><?php echo $cotizacion->folio ?></b></h4>
									</div>
									<div class="col-md-6">
										<h5>Ejecutivo: </h5>
										<h4><b><?php echo $cotizacion->primer_nombre.' '.$cotizacion->apellido_paterno ?></b></h4>
									</div>
									<div class="col-md-4">
										<h5>Estatus: </h5>
										<span class="badge <?php echo $estatus_cotizacion['class'] ?>"><b><?php echo $estatus_cotizacion['estatus'] ?></b></span>
									</div>
								</div>
								<br>
								<div class="row">
									<a class="btn btn-circle blue btn-block" id="btn-ver-comprobantes" href="<?php echo site_url('cotizaciones/archivos/'.$cotizacion->folio) ?>" data-target="#ajax" data-toggle="modal">Comprobantes de Pago</a>
									<button class="btn btn-circle green btn-block" id="btn-ver-cotizacion" url="<?php echo $url_cotizacion ?>">Ver cotizacion</button>
								</div>
							</div>
						</div>
						<?php endif ?>
					</div>
					<div class="col-md-6">
						<!-- DETALLES CASO -->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-puzzle font-grey-gallery"></i>
									<span class="caption-subject bold font-grey-gallery uppercase">Tareas: </span>
								</div>
								<div class="actions">
									<a class="btn btn-circle green btn-block" data-toggle="modal" href="#basic"><i class="fa fa-plus"></i> Nueva Tarea</a>
								</div>
							</div>
							<div class="portlet-body">
								<!-- <table class="table table-bordered table-striped table-condensed flip-content">
									<thead class="flip-content">
										<tr>
											<th width="20%">
												 Code
											</th>
											<th>
												 Company
											</th>
											<th class="numeric">
												 Price
											</th>
											<th class="numeric">
												 Change
											</th>
											<th class="numeric">
												 Change %
											</th>
											<th class="numeric">
												 Open
											</th>
											<th class="numeric">
												 High
											</th>
											<th class="numeric">
												 Low
											</th>
											<th class="numeric">
												 Volume
											</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												 AAC
											</td>
											<td>
												 AUSTRALIAN AGRICULTURAL COMPANY LIMITED.
											</td>
											<td class="numeric">
												 &nbsp;
											</td>
											<td class="numeric">
												 -0.01
											</td>
											<td class="numeric">
												 -0.36%
											</td>
											<td class="numeric">
												 $1.39
											</td>
											<td class="numeric">
												 $1.39
											</td>
											<td class="numeric">
												 &nbsp;
											</td>
											<td class="numeric">
												 9,395
											</td>
										</tr>
									</tbody>
								</table> -->
								<div class="clearfix">
									<ul class="media-list">
										<li class="media">
											<a class="pull-left" href="#">
												<img class="media-object" src="<?php echo $assets_admin_pages ?>media/profile/1/block.jpg" alt="" style="height: 64px; width: 64px; display: block;">
											</a>
											<div class="media-body">
												<div class="col-md-10">
													<b>Luis Macias</b>
													<hr style="margin: 5px 0">
													<h4 class="media-heading"><b>Media heading</b></h4>
													<p>
														Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
													</p>
												</div>
												<div class="col-md-2">
													<div class="easy-pie-chart">
														<div class="number transactions" data-percent="55">
															<span><b>55 %</b></span>
														</div>
														<span>Avance</span>
													</div>
												</div>
												<div class="col-md-12">
												<!-- BEGIN Portlet PORTLET-->
												<div class="portlet gren">
													<div class="portlet-title">
														<div class="caption">
															<i class="fa fa-gift"></i>Notas
														</div>
														<div class="tools">
															<a href="javascript:;" class="expand"></a>
														</div>
													</div>
													<div class="portlet-body display-hide">
														<div class="scroller" style="height:200px">
															<table class="table table-bordered table-striped table-condensed flip-content">
																<thead class="flip-content">
																	<tr>
																		<th width="70%"> Comentario </th>
																		<th width="10%"> Registro </th>
																		<th width="10%"> Privacidad </th>
																		<th width="10%"></th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>
																			 AUSTRALIAN AGRICULTURAL
																		</td>
																		<td class="numeric">
																			 &nbsp;
																		</td>
																		<td class="numeric">
																			 -0.01
																		</td>
																		<td class="numeric">
																			 -0.36%
																		</td>
																	</tr>
																	<tr>
																		<td>
																			 AUSTRALIAN AGRICULTURAL
																		</td>
																		<td class="numeric">
																			 &nbsp;
																		</td>
																		<td class="numeric">
																			 -0.01
																		</td>
																		<td class="numeric">
																			 -0.36%
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<!-- END Portlet PORTLET-->
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->

		<!--DOC: Aplly "modal-cached" class after "modal" class to enable ajax content caching-->
		<div class="modal fade" id="ajax" role="basic" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<img src="../../assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
						<span>
						&nbsp;&nbsp;Cargando... </span>
					</div>
				</div>
			</div>
		</div>

		<!-- MODAL TAREA NUEVA -->
		<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Modal Title</h4>
					</div>
					<div class="modal-body">
						 Modal body goes here
					</div>
					<div class="modal-footer">
						<button type="button" class="btn default" data-dismiss="modal">Close</button>
						<button type="button" class="btn blue">Save changes</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>