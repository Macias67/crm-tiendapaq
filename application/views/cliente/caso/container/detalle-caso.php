
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

								<h5>Estatus del caso: </h5>
								<span class="badge <?php echo $estatus_caso['class'] ?>"><b><?php echo $estatus_caso['estatus'] ?></b></span>
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
									<div class="col-md-6">
										<a class="btn btn-circle blue btn-block" id="btn-ver-comprobantes" href="<?php echo site_url('cotizacion/archivos/'.$cotizacion->folio) ?>" data-target="#ajax" data-toggle="modal">Comprobantes de Pago</a>
									</div>
									<div class="col-md-6">
										<button class="btn btn-circle green btn-block" id="btn-ver-cotizacion" url="<?php echo $url_cotizacion ?>">Ver cotizacion</button>
									</div>
								</div>
							</div>
						</div>
						<?php endif ?>
					</div>
					<div class="col-md-8">
						<!-- TAREAS -->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-puzzle font-grey-gallery"></i>
									<span class="caption-subject bold font-grey-gallery uppercase">Tareas: </span>
								</div>
							</div>
							<div class="portlet-body">
								<!-- <?php var_dump($tareas) ?> -->
								<div class="clearfix">
									<ul class="media-list">
										<?php foreach ($tareas as $key => $tarea): ?>
										<li class="media">
											<a class="pull-left" href="#">
												<img class="media-object" src="<?php echo $assets_admin_pages ?>media/profile/<?php echo $tarea->id_ejecutivo ?>/block.jpg" alt="" style="height: 64px; width: 64px; display: block;">
											</a>
											<div class="media-body">
												<div class="col-md-9">
													<b><i class="fa fa-user"></i> <?php echo $tarea->primer_nombre.' '.$tarea->apellido_paterno ?></b><br>
													<h4 class="media-heading"><b><?php echo $tarea->tarea ?></b> - <span class="badge <?php echo id_estatus_gral_to_class_html($tarea->id_estatus)['class'] ?>"><b><?php echo id_estatus_gral_to_class_html($tarea->id_estatus)['estatus'] ?></b></span></h4>
													<p><?php echo $tarea->descripcion ?></p>
												</div>
												<div class="col-md-3">
													<div class="easy-pie-chart">
														<div class="number transactions" data-percent="<?php echo $tarea->avance ?>">
															<span><b><?php echo $tarea->avance ?> %</b></span>
														</div><br>
														<b>Avance</b>
													</div>
												</div>
												<div class="col-md-12">
													<?php if ($tarea->total_notas != 0): ?>
														<div class="portlet gren">
															<div class="portlet-title">
																<div class="caption"><i class="fa fa-warning"></i>Notas</div>
															</div>
															<div class="portlet-body">
																<table class="table table-hover" id="notas-tarea">
																	<thead class="flip-content">
																		<tr>
																			<th width="15%"> Fecha </th>
																			<th width="80%"> Nota </th>
																			<th></th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php foreach ($notas as $key => $nota): ?>
																		<?php if ($nota->privacidad != 'privada'): ?>
																				<?php if ($tarea->id_tarea == $nota->id_tarea): ?>
																					<?php if ($nota->visto == 0): ?>
																					<tr class="danger">
																						<?php endif ?>
																						<td><?php echo fecha_corta($nota->fecha_registro) ?></td>
																						<td><?php echo $nota->nota ?></td>
																						<td>
																							<?php if (isset($nota->imagen)): ?>
																								<a href="<?php echo $nota->imagen ?>" class="btn blue btn-circle btn-xs fancybox" title="<?php echo $nota->nota ?>" target="_blank"><i class="fa fa-file-image-o"></i> Ver archivo</a>
																							<?php endif ?>
																						</td>
																					</tr>
																				<?php endif ?>
																			<?php endif ?>
																		<?php endforeach ?>
																	</tbody>
																</table>
															</div>
														</div>
													<?php endif ?>
												</div>

												<!-- <div class="col-md-12">
													<div class="clearfix">
														<a href="<?php //echo site_url('client/casos/notas/'.$tarea->id_tarea) ?>" class="btn btn-circle btn-xs blue" data-target="#ajax_ver_notas" data-toggle="modal">
															<i class="fa fa-quote-left"></i> Ver Notas (<?php //echo $tarea->total_notas ?>)
														</a>
													</div>
												</div> -->
											</div>
										</li>
										<hr>
										<?php endforeach ?>
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

		<!--AJAX MODAL para mostrar los archivos de una cotizacion -->
		<div class="modal fade" id="ajax" role="basic" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
						<span>
						&nbsp;&nbsp;Cargando... </span>
					</div>
				</div>
			</div>
		</div>

		<!--AJAX MODAL para ver notas de una tarea -->
		<div class="modal fade" id="ajax_ver_notas" role="basic" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
						<span>
						&nbsp;&nbsp;Cargando... </span>
					</div>
				</div>
			</div>
		</div>