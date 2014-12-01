		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Blank Page <small>blank page</small></h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN FILTER -->
						<div class="filter-v1 margin-top-10">
							<div class="row mix-grid thumbnails">
								<?php foreach ($archivos as $index => $archivo): ?>
								<div class="col-md-4 col-sm-6 mix">
									<div class="mix-inner">
										<img class="img-responsive" src="<?php echo site_url('clientes/'.$cotizacion->id_cliente.'/comprobantes/'.$cotizacion->folio.'/'.$archivo) ?>" alt="">
										<div class="mix-details">
											<h3><?php echo $archivo ?></h3>
											<a class="mix-link"><i class="fa fa-link"></i></a>
											<a class="mix-preview fancybox-button" href="<?php echo site_url('clientes/'.$cotizacion->id_cliente.'/comprobantes/'.$cotizacion->folio.'/'.$archivo) ?>" title="Cotización #<?php echo $cotizacion->folio ?>" data-rel="fancybox-button">
												<i class="fa fa-search"></i>
											</a>
										</div>
									</div>
								</div>
								<?php endforeach ?>
							</div>
						</div>
						<!-- END FILTER -->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->
