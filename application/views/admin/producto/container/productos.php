
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Productos - <small>Gestor</small></h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box grey">
							<div class="portlet-title">
								<div class="caption" style="color: black">
									<i class="fa fa-shopping-cart"></i> Productos
								</div>
								<div class="tools" style="color: black">
									<a href="javascript:;" class="collapse">
									</a>
									<a href="javascript:;" class="reload">
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-hover table-bordered" id="tabla_productos_editable">
									<thead>
										<tr>
											<th>Código</th>
											<th>Descripción</th>
											<th>Precio</th>
											<th>Unidad</th>
											<th>Impuesto 1</th>
											<th>Impuesto 2</th>
											<th>Retencion 1</th>
											<th>Retencion 2</th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($productos as $producto): ?>
											<tr id="<?php echo $producto->codigo ?>">
												<td><?php echo $producto->codigo ?></td>
												<td><?php echo $producto->descripcion ?></td>
												<td><?php echo $producto->precio ?></td>
												<td><?php echo $producto->unidad ?></td>
												<td><?php echo $producto->impuesto1 ?></td>
												<td><?php echo $producto->impuesto2 ?></td>
												<td><?php echo $producto->retencion1 ?></td>
												<td><?php echo $producto->retencion2 ?></td>
												<td><a class="edit" href="javascript:;">Editar </a></td>
												<td><a class="delete" href="javascript:;">Eliminar </a></td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
								<div class="table-toolbar">
									<div class="btn-group pull-right">
										<button id="tabla_productos_editable_new" class="btn green btn-xs">
											<i class="fa fa-plus"></i> Nuevo producto
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->
