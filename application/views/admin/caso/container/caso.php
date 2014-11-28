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
									<table class="table table-striped table-bordered table-hover" id="tabla-cosos-asignar">
										<thead>
											<tr>
												<th>No. Caso</th>
												<th>Cliente</th>
												<th>Fecha</th>
												<th>Estatus</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($casos_asignacion as $caso ): ?>
												<tr>
													<td><?php echo $caso->id ?></td>
													<td><?php echo $caso->razon_social ?></td>
													<td><?php echo $caso->fecha_inicio ?></td>
													<td><?php echo $caso->descripcion ?></td>
													<td>Asignar Lider</td>
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
