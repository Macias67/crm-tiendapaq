
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">

				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title"><b><?php echo ($caso->folio_cotizacion) ? 'Folio #'.$caso->folio_cotizacion : 'Sin Folio' ?></b> <small>Caso no. <?php echo $caso->id_caso ?></small></h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-4">
						<!-- DETALLES CASO -->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-puzzle font-grey-gallery"></i>
									<span class="caption-subject bold font-grey-gallery uppercase">Detalles: </span>
								</div>
							</div>
							<!-- BOTON PARA MOSTRAR LAS REASIGNASIONES -->
							<?php if (count($casoreasignado)): ?>
							<div class="col-md-12">
								<a class="btn btn-circle blue btn-xs" href="<?php echo site_url('/caso/detallesreasignar/'.$caso->id_caso) ?>" data-target="#ajax-detalles-reasignacion" data-toggle="modal"><i class="fa fa-search"></i> Historial de reasignaciones </a>
							</div>
							<?php endif ?>
							<div class="portlet-body">
								<div class="row">
									<div class="col-md-12">
									<?php if ($encuesta->calificacion != "0"): ?>
										<h5>Evaluación: </h5>
										<h4><b><?php echo $encuesta->calificacion ?> puntos</b></h4>
									<?php elseif($encuesta->fecha_respuesta != "1000-01-01"): ?>
										<h5><b>En espera de contestar encuesta.</b></h5>
										<h5>Enviado: <b><?php echo fecha_completa($encuesta->fecha_enviado) ?></b></h5>
									<?php endif ?>

										<h5>Cliente: </h5>
										<h4><b><?php echo $caso->razon_social ?></b></h4>

										<h5>Líder: </h5>
										<h4><b><?php echo $caso->primer_nombre.' '.$caso->apellido_paterno ?></b></h4>

										<h5>Fecha tentativa de cierre: </h5>
										<h4><b><?php echo $caso->fecha_tentativa_cierre ?></b></h4>

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
								<br>
								<?php if ($tareas==null): ?>
								<div class="row">
									<div class="col-md-12">
										<a class="btn btn-circle red btn-block" data-target="#modal-reasignar" data-toggle="modal">Reasignar</a>
									</div>
								</div>
								<?php endif ?>
								<br>
								<?php if ($boton_cerrar_caso&&$id_estatus_cotizacion==3): ?>
								<div class="row">
									<div class="col-md-12">
										<button class="btn btn-circle red btn-block" id="cierra_caso">Cerrar Caso - Evaluación: <b><?php echo $encuesta->calificacion ?>%</b></button>
									</div>
								</div>
								<?php endif ?>
							</div>
						</div>

						<!-- DETALLES COTIZACION -->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-puzzle font-grey-gallery"></i>
									<span class="caption-subject bold font-grey-gallery uppercase">Cotización: </span>
								</div>
							</div>
							<div class="portlet-body">
								<?php if(!is_null($caso->folio_cotizacion)): ?>
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
										<a class="btn btn-circle blue btn-block" id="btn-ver-comprobantes" href="<?php echo site_url('cotizaciones/archivos/'.$cotizacion->folio) ?>" data-target="#ajax" data-toggle="modal">Comprobantes de Pago</a>
									</div>
									<div class="col-md-6">
										<button class="btn btn-circle green btn-block" id="btn-ver-cotizacion" url="<?php echo $url_cotizacion ?>">Ver cotizacion</button>
									</div>
								</div>
								<?php else: ?>
									<h3>Sin Cotización</h3>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<!-- TAREAS -->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-puzzle font-grey-gallery"></i>
									<span class="caption-subject bold font-grey-gallery uppercase">Tareas: </span>
								</div>
								<div class="actions">
									<?php if ($boton_tareas): ?>
									<a class="btn btn-circle green btn-block" data-toggle="modal" href="#tarea"><i class="fa fa-plus"></i> Nueva Tarea</a>
									<?php endif ?>
								</div>
							</div>
							<div class="portlet-body">
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
													<p><i class="fa fa-calendar"></i> Cierre tentativo: <b><?php echo $tarea->fecha_cierre ?></b></p>
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
													<div class="clearfix">
														<a href="<?php echo site_url('tarea/modal/editar/'.$tarea->id_tarea) ?>" class="btn btn-circle btn-xs red" data-target="#ajax_edita_tarea" data-toggle="modal">
															<i class="fa fa-edit"></i> Editar
														</a>
<!--														<button class="btn btn-circle btn-xs red edita-tarea" url="--><?php //echo site_url('tarea/modal/editar/'.$tarea->id_tarea) ?><!--">-->
<!--															<i class="fa fa-edit"></i> Editar-->
<!--														</button>-->
													</div>
												</div>
												<div class="col-md-9">
												<?php if ($tarea->total_notas != 0): ?>
												<div class="portlet gren">
													<div class="portlet-title">
														<div class="caption"><i class="fa fa-warning"></i>Notas</div>
													</div>
													<div class="portlet-body">
														<table class="table table-striped table-bordered table-hover" id="notas-tarea">
															<thead class="flip-content">
																<tr>
																	<th width="1%">ID</th>
																	<th width="1%"></th>
																	<th width="20%"></th>
																	<th width="40%"></th>
																	<th width="15%"></th>
																</tr>
															</thead>
															<tbody>
																<?php foreach ($notas as $key => $nota): ?>
																		<?php if ($tarea->id_tarea == $nota->id_tarea): ?>
																		<?php if ($nota->visto == 0): ?>
																		<tr class="danger">
																			<?php endif ?>
																			<td><?php echo $nota->id_nota ?></td>
																			<td>
																				<?php if ($nota->privacidad == 'publica'): ?>
																				<span class="label label-sm label-danger"> Pública </span>
																				<?php else: ?>
																				<span class="label label-sm label-success">Privada </span>
																				<?php endif ?>
																			</td>
																			<td><?php echo fecha_corta($nota->fecha_registro) ?></td>
																			<td><?php echo $nota->nota ?></td>
																			<td>
																				<?php if (isset($nota->imagen)): ?>
																				<a href="<?php echo $nota->imagen ?>" class="btn blue btn-xs ver fancybox"><i class="fa fa-file-image-o"></i></a>
																				<?php endif ?>
																				<a href="<?php echo site_url('nota/modal/editar/'.$nota->id_nota) ?>" class="btn green btn-xs editar" data-target="#ajax_edita_nota" data-toggle="modal"><i class="fa fa-edit"></i></a>
																				<button class="btn red btn-xs eliminar" id="<?php echo $nota->id_nota ?>"><i class="fa fa-trash-o"></i></button>
																			</td>
																		</tr>
																	<?php endif ?>
																<?php endforeach ?>
															</tbody>
														</table>
													</div>
												</div>
												<?php endif ?>
												</div>
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

		<!-- MODAL Reasignar -->
		<div class="modal fade" id="modal-reasignar" tabindex="-1" role="basic" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" role="form" id="reasignar-caso" method="post">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Reasignar Caso</h4>
						</div>
						<div class="modal-body">
							<div class="form-body">
								<!-- ALERTS -->
								<div class="alert alert-danger display-hide">
									<button class="close" data-close="alert"></button>
									Tienes errores en el formulario
								</div>
								<div class="alert alert-success display-hide">
									<button class="close" data-close="alert"></button>
									Éxito en el formulario
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Ejecutivo: <span class="required" aria-required="true">*</span></label>
									<div class="col-md-6">
										<select class="form-control" name="reasignar">
											<?php foreach ($ejecutivos as $key => $ejecutivo):  ?>
											<option value="<?php echo $ejecutivo->id ?>"><?php echo $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Motivo: </label>
									<div class="col-md-9">
										<div class="input-icon">
											<i class="fa fa-bell-o"></i>
											<textarea class="form-control" rows="2" name="motivo" required></textarea>
											<input type="hidden" name="id_caso" value="<?php echo $caso->id_caso ?>">
											<input type="hidden" name="id_lider" value="<?php echo $caso->id_lider ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn default" data-dismiss="modal"> Cerrar </button>
							<button type="submit" class="btn blue"> Reasignar</button>
						</div>
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

		<!--AJAX MODAL para mostrar los archivos de una cotizacion -->
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
		<div class="modal fade" id="tarea" tabindex="-1" role="basic" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" role="form" id="tarea_nueva" method="post" action="<?php echo site_url('tarea/nueva') ?>">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Nueva Tarea</h4>
						</div>
						<div class="modal-body">
								<div class="form-body">
									<!-- ALERTS -->
									<div class="alert alert-danger display-hide">
										<button class="close" data-close="alert"></button>
										Tienes errores en el formulario
									</div>
									<div class="alert alert-success display-hide">
										<button class="close" data-close="alert"></button>
										Éxito en el formulario
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Ejecutivo: <span class="required" aria-required="true">*</span></label>
										<div class="col-md-6">
											<select class="form-control" name="ejecutivo">
												<option></option>
												<?php foreach ($ejecutivos as $key => $ejecutivo):  ?>
												<option value="<?php echo $ejecutivo->id ?>"><?php echo $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno ?></option>
												<?php endforeach ?>
											</select>
										</div>
										<!-- <div class="col-md-3">
											<button  type="button" class="btn default">
												<i class="fa fa-calendar"></i> Agenda
											</button>
										</div> -->
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tarea: <span class="required" aria-required="true">*</span></label>
										<div class="col-md-9">
											<div class="input-icon">
												<i class="fa fa-bell-o"></i>
												<input type="text" class="form-control" name="tarea">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Descripción: </label>
										<div class="col-md-9">
											<div class="input-icon">
												<i class="fa fa-bell-o"></i>
												<textarea class="form-control" rows="2" name="descripcion"></textarea>
												<input type="hidden" name="id_caso" value="<?php echo $caso->id_caso ?>">
											</div>
										</div>
									</div>
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn default" data-dismiss="modal"> Cerrar </button>
							<button type="submit" class="btn blue"> Agregar</button>
						</div>
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

		<!--AJAX MODAL para Editar una tarea -->
		<div class="modal fade" id="ajax_edita_tarea" role="basic" aria-hidden="true">
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

		<!--AJAX MODAL para ver notas de una tarea -->
		<div class="modal fade" id="ajax_ver_notas" role="basic" aria-hidden="true">
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

		<!--AJAX MODAL para editar datos de una nota -->
		<div class="modal fade" id="ajax_edita_nota" role="basic" aria-hidden="true">
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

		<!-- BEGIN AJAX DETALLE REASIGNACION -->
		<div id="ajax-detalles-reasignacion" class="modal fade" role="basic" aria-hidden="true">
			<div class="page-loading page-loading-boxed">
				<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
				<span>Cargando... </span>
			</div>
			<div class="modal-dialog">
				<div class="modal-content">
				</div>
			</div>
		</div>
		<!-- END AJAX DETALLE REASIGNACION -->