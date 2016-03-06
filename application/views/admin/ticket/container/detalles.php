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
