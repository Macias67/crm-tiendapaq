
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Bancos - <small>Gestor General</small></h3>
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
									<i class="fa fa-usd"></i> Bancos
								</div>
								<div class="tools" style="color: black">
									<a href="javascript:;" class="collapse">
									</a>
									<a href="javascript:;" class="reload">
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-hover table-bordered" id="tabla_bancos_editable">
									<thead>
										<tr>
											<th>Banco</th>
											<th>Sucursal</th>
											<th>Numero de cuenta</th>
											<th>Titular</th>
											<th>Clave interbancaria</th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($bancos as $banco): ?>
											<tr id="<?php echo $banco->id_banco?>">
												<td><?php echo $banco->banco ?></td>
												<td><?php echo $banco->sucursal ?></td>
												<td><?php echo $banco->cta ?></td>
												<td><?php echo $banco->titular ?></td>
												<td><?php echo $banco->cib ?></td>
												<td><a class="btn edit blue btn-circle btn-xs" href="javascript:;"><i class="fa fa-edit"></i> Editar </a></td>
												<td><a class="btn delete red btn-circle btn-xs" href="javascript:;"><i class="fa fa-trash"></i> Eliminar </a></td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
								<br>
								<div class="table-toolbar">
									<div class="btn-group pull-right">
										<button id="tabla_bancos_editable_new" class="btn btn-circle green btn-xs">
											<i class="fa fa-plus"></i> Nuevo banco
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
