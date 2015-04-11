
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
										<a class="btn btn-circle blue btn-block" id="btn-ver-comprobantes" href="<?php echo site_url('cotizaciones/archivos/'.$cotizacion->folio) ?>" data-target="#ajax" data-toggle="modal">Comprobantes de Pago</a>
									</div>
									<div class="col-md-6">
										<button class="btn btn-circle green btn-block" id="btn-ver-cotizacion" url="<?php echo $url_cotizacion ?>">Ver cotizacion</button>
									</div>
								</div>
							</div>
						</div>
						<?php endif ?>
					</div>
					<div class="col-md-4">
						<!-- DETALLES TAREA -->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-puzzle font-grey-gallery"></i>
									<span class="caption-subject bold font-grey-gallery uppercase">Tarea asignada: </span>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="row">
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
											<th width="1%">Privacidad</th>
											<th width="15%"> Fecha </th>
											<th width="50%"> Nota </th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($notas as $key => $nota): ?>
										<tr>
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
											<td><a href="" class="btn blue btn-circle btn-xs" id="<?php echo $nota->id_nota ?>"><i class="fa fa-search"></i> Editar</a></td>
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
								<form role="form" action="<?php site_url('') ?>">
									<div class="form-body">
										<div class="form-group">
											<label>Nota</label>
											<textarea class="form-control" name="nota" rows="2"></textarea>
										</div>
										<div class="form-group">
											<input
												type="checkbox"
												name="privacidad"
												checked class="make-switch"
												data-size="small"
												data-on-text="&nbsp;Privada&nbsp;"
												data-off-text="&nbsp;Pública&nbsp;"
												checked data-on-color="success"
												data-off-color="danger"
											>
										</div>
									</div>
									<div class="form-actions">
										<button type="button" class="btn btn-circle blue" id="btn-guardar-nota">Guardar</button>
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