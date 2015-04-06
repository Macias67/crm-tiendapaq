<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Cotización - <small>Catálogo de cotizaciones</small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN TABLA COTIZACIONES-->
				<div class="portlet gren">
					<div class="portlet-title">
						<div class="caption"><i class="fa fa-user"></i>Cotizaciones</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="tabla-catalogo-cotizaciones">
							<thead>
								<tr>
									<th width="1%">Fo.</th>
									<th width="20%">Cliente</th>
									<th width="10%">Ejecutivo</th>
									<th width="20%">Fecha de creación</th>
									<th width="20%">Vigencia</th>
									<th width="1%">Estatus</th>
									<th width="1%"><i class="fa fa-comment"></i></th>
									<th width="1%"></th>
									<th width="1%"></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<!-- END TABLA COTIZACIONES-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->

<!-- BEGIN ASIGNAR EJECUTIVO MODAL -->
<div id="ajax-contactos-reenvio" class="modal fade" role="basic" aria-hidden="true">
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