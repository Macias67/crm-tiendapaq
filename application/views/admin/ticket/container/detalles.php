		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Ticket # - <?php echo $ticket->id_ticket ?></h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-7">
						<b>Detalles</b>
						<p> <?php echo $ticket->mensaje ?></p>
						<a class="btn green btn-circle btn-xs" href="<?php echo site_url('/tickets/asignar/mostrar/'.$ticket->id_ticket) ?>" data-target="#ajax-asignar-ejecutivo" data-toggle="modal"><i class="fa fa-arrow-circle-right"></i> Asignar Lider</a>
					</div>
					<div class="col-md-7">
						<!-- BEGIN FILTER -->
						<div class="filter-v1 margin-top-10">
							<div class="row mix-grid thumbnails">
								<?php foreach ($imagenes as $index => $imagen): ?>
									<div class="col-md-4 col-sm-6 mix">
										<div class="mix-inner">
											<img class="img-responsive" src="<?php echo site_url('clientes/'.$cotizacion->id_cliente.'/comprobantes/'.$cotizacion->folio.'/'.$imagen) ?>" alt="">
											<div class="mix-details">
												<h3><?php echo $imagen ?></h3>
												<a class="mix-link" href="<?php echo site_url('clientes/'.$cotizacion->id_cliente.'/comprobantes/'.$cotizacion->folio.'/'.$imagen) ?>" target="_blank" title="Ampliar"><i class="fa fa-expand"></i></a>
												<a class="mix-preview fancybox-button" href="<?php echo site_url('clientes/'.$cotizacion->id_cliente.'/comprobantes/'.$cotizacion->folio.'/'.$imagen) ?>" title="Ver" data-rel="fancybox-button">
													<i class="fa fa-search"></i>
												</a>
											</div>
										</div>
									</div>
								<?php endforeach ?>
							</div>
						</div>
						<!-- END FILTER -->
						<div class="col-md-12">
							<?php foreach ($pdfs as $index => $pdf): ?>
								<a class="icon-btn muestra-pdf" file="<?php echo $pdf ?>" ruta="<?php echo $ruta_pdf ?>">
									<i class="fa fa-file-pdf-o"></i>
									<div>&nbsp;&nbsp;<?php echo $pdf ?>&nbsp;&nbsp;</div>
								</a>
							<?php endforeach ?>
						</div>
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->

		<!-- BEGIN ASIGNAR EJECUTIVO MODAL -->
		<div id="ajax-asignar-ejecutivo" class="modal fade" role="basic" aria-hidden="true">
			<div class="page-loading page-loading-boxed">
				<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
				<span>Cargando... </span>
			</div>
			<div class="modal-dialog">
				<div class="modal-content">
				</div>
			</div>
		</div>
		<!-- END ASIGNAR EJECUTIVO MODAL-->
