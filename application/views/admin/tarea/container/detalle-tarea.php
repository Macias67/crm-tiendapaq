
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
					<div class="col-md-3">
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
										<a class="btn btn-circle blue btn-block" id="btn-ver-comprobantes" href="<?php echo site_url('cotizaciones/archivos/'.$cotizacion->folio) ?>" data-target="#ajax" data-toggle="modal">Pagos</a>
									</div>
									<div class="col-md-6">
										<button class="btn btn-circle green btn-block" id="btn-ver-cotizacion" url="<?php echo $url_cotizacion ?>">Ver cotizacion</button>
									</div>
								</div>
							</div>
						</div>
						<?php endif ?>
					</div>
					<div class="col-md-5">
					<!-- fechatentativa de cierre -->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-puzzle font-grey-gallery"></i>
								<span class="caption-subject bold font-grey-gallery uppercase">Fecha tentativa de cierre: </span>
							</div>
							<div class="tools">
								<a href="javascript:;" class="expand"></a>
							</div>
						</div>
						<div class="portlet-body display-hide">
							<div class="portlet-body form">
								<form role="form">
									<div class="form-body">
										<div class="form-group">
											<div class="col-md-12">
													<?php if ($tarea->fecha_cierre != '1000-01-01 00:00:00'): ?>
														<label class="control-label col-md-4">Tentativa de cierre:</label>
														<label type="text" name="fecha_de_cierre" /><b><?php echo fecha_formato($tarea->fecha_cierre) ?></b></label>
													<?php else: ?>
														<label class="control-label col-md-4">Tentativa de cierre <span class="required" aria-required="true">*</span></label>
														<div class="col-md-8">
															<input type="text" name="fecha_cierre" class="form-control datepicker" value="" readonly/>
														</div>
													<?php endif ?>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="form-actions">
										<?php if ($tarea->fecha_cierre == '1000-01-01 00:00:00'): ?>
											<button type="button" class="btn btn-circle blue" id="btn_establecer">Establecer</button>
										<?php endif ?>
									</div>
								</form>
							</div>
						</div>
					</div>
						<!-- DETALLES TAREA -->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-puzzle font-grey-gallery"></i>
									<span class="caption-subject bold font-grey-gallery uppercase">Tarea asignada: </span>
								</div>
							</div>
								<div class="portlet-body form">
									<form role="form">
										<div class="form-body">
											<div class="form-group">
												<div class="col-md-12">
													<b><span class="fa fa-calendar"></span> <?php echo fecha_completa($tarea->fecha_inicio) ?></b>
													<h4><b><?php echo $tarea->tarea ?></b></h4>
													<h5>Descripción: </h5>
													<p><?php echo $tarea->descripcion ?></p>
												</div>
											</div><br>
											<div class="form-group">
												<div class="col-md-6">
													<h5>Progreso de la tarea: </h5>
													<div id="slider-snap-inc" class="slider bg-green" avance="<?php echo $tarea->avance ?>"></div>
													<b><span id="slider-snap-inc-amount"><?php echo $tarea->avance ?>%</span></b>
												</div>
												<div class="col-md-6">
													<h5>Estatus: </h5>
													<?php echo form_dropdown('estatus', $opciones_estatus, $tarea->id_estatus, 'class="form-control"') ?>
													<input type="hidden" name="id_tarea" value="<?php echo $tarea->id_tarea ?>">
													<input type="hidden" name="id_caso" value="<?php echo $caso->id_caso ?>">
												</div>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="form-actions">
											<button type="button" class="btn btn-circle blue" id="btn-guardar">Guardar</button>
										</div>
									</form>
							</div>
						</div>
						<!-- Notas TAREA -->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-puzzle font-grey-gallery"></i>
									<span class="caption-subject bold font-grey-gallery uppercase">Notas: </span>
								</div>
							</div>
							<div class="portlet-body flip-scroll">
								<table class="table table-bordered table-striped table-condensed flip-content">
									<thead class="flip-content">
										<tr>
											<th width="1%"> ID </th>
											<th width="1%"></th>
											<th width="20%"></th>
											<th width="40%"></th>
											<th width="20%"></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($notas as $key => $nota): ?>
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
												<a href="<?php echo $nota->imagen ?>" class="btn blue btn-xs ver fancybox" target="_blank"><i class="fa fa-file-image-o"></i></a>
												<?php endif ?>
												<a href="<?php echo site_url('nota/modal/editar/'.$nota->id_nota) ?>" class="btn green btn-xs editar" data-target="#ajax_edita_nota" data-toggle="modal"><i class="fa fa-edit"></i></a>
												<button class="btn red btn-xs eliminar" id="<?php echo $nota->id_nota ?>"><i class="fa fa-trash-o"></i></button>
											</td>
										</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<!-- DETALLES TAREA -->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-puzzle font-grey-gallery"></i>
									<span class="caption-subject bold font-grey-gallery uppercase">Agregar Nota: </span>
								</div>
							</div>
							<div class="portlet-body form">
								<form enctype="multipart/form-data"  id="nueva_nota" role="form">
									<div class="form-body">
										<div class="form-group">
											<input
												type="checkbox"
												name="privacidad"
												checked class="make-switch"
												data-size="small"
												data-on-text="&nbsp;Privada&nbsp;"
												data-off-text="&nbsp;Pública&nbsp;"
												data-on-color="success"
												data-off-color="danger"
											>
										</div>
										<div class="form-group">
											<label>Nota</label>
											<textarea class="form-control" name="nota" rows="2" required></textarea>
										</div>
										<div class="form-group">
											<div class="col-md-9">
												<input type="file" name="archivo" id="archivo">
												<p class="help-block"> Ligar archivo. (JPG, PNG o PDF)</p>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-circle blue" id="btn-guardar-nota">Guardar</button>
									</div>
								</form>
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