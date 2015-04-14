<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Gestionar Eventos - <small><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?></small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN TABLA EVENTOS-->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-speech"></i>
							<span class="caption-subject bold uppercase"> Catálogo de eventos</span>
						</div>
						<div class="actions">
							<a href="<?php echo site_url('evento/nuevo') ?>" class="btn btn-circle green">
							<i class="fa fa-plus"></i> Agregar </a>
						</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height:400px">
							<table class="table table-striped table-bordered table-hover" id="tabla-catalogo-eventos">
								<thead>
									<tr>
										<th width="1%">No.</th>
										<th width="5%">Ejecutivo</th>
										<th width="5%">Modalidad</th>
										<th width="10%">Título</th>
										<th width="15%">Sesion Próxima</th>
										<th width="1%">Participantes</th>
										<th width="5%">Estatus</th>
										<th width="1%"></th>
										<th width="1%"></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<!-- END TABLA EVENTOS-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->
<!-- BEGIN DETALLES MODAL -->
<div id="ajax-detalles-evento" class="modal fade" role="basic" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
		<img src="<?php echo $assets_global_img ?>loading-spinner-grey.gif" alt="" class="loading">
		<span>Cargando... </span>
	</div>
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<!-- END DETALLES MODAL -->