
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title"> Oficinas y Departamentos - <small> Gestor General</small></h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN TABLA OFICINAS -->
						<div class="col-md-9">
							<div class="portlet box grey">
								<div class="portlet-title">
									<div class="caption" style="color: black">
										<i class="fa fa-building"></i> Oficinas
									</div>
									<div class="tools" style="color: black">
										<a href="javascript:;" class="collapse">
										</a>
										<a href="javascript:;" class="reload">
										</a>
									</div>
								</div>
								<div class="portlet-body">
									<table class="table table-striped table-hover table-bordered" id="tabla_oficinas_editable">
										<thead>
											<tr>
												<th>Ciudad</th>
												<th>Estado</th>
												<th>Colonia</th>
												<th>Calle</th>
												<th>Número</th>
												<th>Email</th>
												<th>Teléfono</th>
												<th></th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($oficinas as $oficina) : ?>
												<tr id="<?php echo $oficina->id_oficina ?>">
													<td><?php echo $oficina->ciudad ?></td>
													<td><?php echo $oficina->estado ?></td>
													<td><?php echo $oficina->colonia ?></td>
													<td><?php echo $oficina->calle ?></td>
													<td><?php echo $oficina->numero ?></td>
													<td><?php echo $oficina->email ?></td>
													<td><?php echo $oficina->telefono ?></td>
													<td><a class="edit" href="javascript:;">Editar </a></td>
													<td><a class="delete" href="javascript:;">Eliminar </a></td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
									<div class="table-toolbar">
										<div class="btn-group pull-right">
											<button id="tabla_oficinas_editable_new" class="btn green btn-xs">
												<i class="fa fa-plus"></i> Nueva oficina
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END TABLA OFICINAS -->
						<!-- BEGIN DEPARTAMENTOS -->
						<div class="col-md-3">
							<div class="portlet box grey">
								<div class="portlet-title">
									<div class="caption" style="color: black">
										<i class="fa fa-briefcase"></i> Departamentos
									</div>
									<div class="tools" style="color: black">
										<a href="javascript:;" class="collapse">
										</a>
										<a href="javascript:;" class="reload">
										</a>
									</div>
								</div>
								<div class="portlet-body">
									<table class="table table-striped table-hover table-bordered" id="tabla_departamentos_editable">
										<thead>
											<tr>
												<th>Departamento</th>
												<th></th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($departamentos as $departamento) : ?>
												<tr id="<?php echo $departamento->id_departamento?>">
													<td><?php echo $departamento->area ?></td>
													<td><a class="edit" href="javascript:;">Editar </a></td>
													<td><a class="delete" href="javascript:;">Eliminar </a></td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
									<div class="table-toolbar">
										<div class="btn-group pull-right">
											<button id="tabla_departamentos_editable_new" class="btn green btn-xs">
												<i class="fa fa-plus"></i> Nuevo departamento
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END DEPARTAMENTOS -->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->
