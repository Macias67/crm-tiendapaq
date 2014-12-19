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
				<!-- BEGIN TABLA CASOS-->
				<div class="portlet gren">
					<div class="portlet-title">
						<div class="caption"><i class="fa fa-user"></i>Casos para asignar</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height:400px">
							<table class="table table-striped table-bordered table-hover" id="tabla-casos-asignar">
								<thead>
									<tr>
										<th>No. Caso</th>
										<th>Cliente</th>
										<th>Fecha de apertura</th>
										<th>Estatus</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($casos_asignacion as $caso ): ?>
										<tr>
											<td><?php echo $caso->id ?></td>
											<td><?php echo $caso->razon_social ?></td>
											<td><?php echo fecha_completa($caso->fecha_inicio) ?></td>
											<td><a class="btn yellow btn-circle btn-xs disabled" href=""><?php echo ucfirst($caso->descripcion) ?></a></td>
											<td>
												<a class="btn blue btn-circle btn-xs" href="#"><i class="fa fa-search"></i> Detalles</a>
												<a class="btn green btn-circle btn-xs" href="<?php echo site_url('/caso/asignar/mostrar/'.$caso->id) ?>" data-target="#ajax-asignar-ejecutivo" data-toggle="modal" ><i class="fa fa-arrow-circle-right"></i> Asignar Lider</a>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- END TABLA CASOS-->
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