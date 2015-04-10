
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
					<div class="col-md-8">
						<!-- DETALLES CASO -->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-puzzle font-grey-gallery"></i>
									<span class="caption-subject bold font-grey-gallery uppercase">Tareas: </span>
								</div>
								<div class="actions">
									<a class="btn btn-circle green btn-block" data-toggle="modal" href="#tarea"><i class="fa fa-plus"></i> Nueva Tarea</a>
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
													<b><?php echo $tarea->primer_nombre.' '.$tarea->apellido_paterno ?></b><br>
													<h4 class="media-heading"><b><?php echo $tarea->tarea ?></b></h4>
													<p><?php echo $tarea->descripcion ?></p>
												</div>
												<div class="col-md-3">
													<div class="easy-pie-chart">
														<div class="number transactions" data-percent="<?php echo $tarea->avance ?>">
															<span><b><?php echo $tarea->avance ?> %</b></span>
														</div>
													</div>
												</div>
												<div class="col-md-12">
													<span class="badge <?php echo id_estatus_gral_to_class_html($tarea->id_estatus)['class'] ?>"><b><?php echo id_estatus_gral_to_class_html($tarea->id_estatus)['estatus'] ?></b></span>
													<button type="button" class="btn btn-circle green btn-xs">12 Notas</button>
												<!-- BEGIN Portlet PORTLET-->
												<!-- <div class="portlet gren">
													<div class="portlet-title">
														<div class="caption">
															<i class="fa fa-gift"></i>Notas
														</div>
														<div class="tools">
															<a href="javascript:;" class="expand"></a>
														</div>
													</div>
													<div class="portlet-body display-hide">
														<div class="scroller" style="height: 100px">
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
												</div> -->
												<!-- END Portlet PORTLET-->
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

		<!--AJAX MODEL para mostrar los archivos de una cotizacion -->
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
										<div class="col-md-3">
											<button  type="button" class="btn default">
												<i class="fa fa-calendar"></i> Agenda
											</button>
										</div>
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