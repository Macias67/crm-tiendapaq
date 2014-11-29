		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title"> Sistemas <strong>CONTPAQi®</strong> - <small>Gestor General</small></h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN GESTOR DE SISTEMAS -->
						<div class="col-md-6">
							<div class="portlet box grey">
								<div class="portlet-title">
									<div class="caption" style="color: black">
										<i class="fa fa-desktop"></i> Sistemas Registrados
									</div>
									<div class="tools" style="color: black">
										<a href="javascript:;" class="collapse">
										</a>
										<a href="javascript:;" class="reload">
										</a>
									</div>
								</div>
								<div class="portlet-body">
									<table class="table table-striped table-hover table-bordered" id="tabla_sistemas_editable">
										<thead>
											<tr>
												<th>Nombre del sistema</th>
												<th></th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($sistemascontpaqi as $sistema): ?>
												<tr id="<?php echo $sistema->id_sistema ?>">
													<td><?php echo $sistema->sistema ?></td>
													<td><a class="btn edit blue btn-circle btn-xs" href="javascript:;"><i class="fa fa-edit"></i> Editar</a></td>
													<td><a class="btn delete red btn-circle btn-xs" href="javascript:;"><i class="fa fa-trash"></i> Eliminar</a></td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
									<br>
									<div class="table-toolbar">
										<div class="btn-group pull-right">
											<button id="tabla_sistemas_editable_new" class="btn btn-circle green btn-xs">
												<i class="fa fa-plus"></i> Nuevo sistema
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END GESTOR DE SISTEMAS -->
						<!-- BEGIN GESTOR DE VERSIONES -->
						<div class="col-md-6">
							<div class="portlet box grey">
								<div class="portlet-title">
									<div class="caption" style="color: black">
										<i class="fa fa-list"></i> Versiones de los Sistemas
									</div>
									<div class="tools" style="color: black">
										<a href="javascript:;" class="collapse">
										</a>
										<a href="javascript:;" class="reload">
										</a>
									</div>
								</div>
								<div class="portlet-body">
									<!-- Tipo de sistema -->
									<div class="form-group">
										<label class="col-md-2 control-label"> Sistema: 
										</label>
										<div class="col-md-10">
											<div class="input-icon">
												<i class="fa fa-info"></i>
												<select class="form-control" name="sistema" id="select_sistemas">
													<option></option>
													<?php foreach ($sistemascontpaqi as $sistema): ?>
													<option value="<?php echo $sistema->id_sistema ?>"><?php echo $sistema->sistema ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
									</div>
									<br>
									<br>
									<hr>
									<br>
									<div class="form-group">
										<label class="control-label col-md-3"> Versiones registradas: 
										</label>
										<div class="col-md-9">
											<input type="hidden" name="input_versiones" id="input_versiones" class="form-control select2" value="">
										</div>
									</div>
									<br>
									<br>
									<br>
									<br>
									<div class="table-toolbar">
										<br>
										<div class="btn-group pull-right">
											<button id="guardar_versiones" class="btn btn-circle green btn-xs">
												<i class="fa fa-save"></i>  Guardar Versiones
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END GESTOR DE VERSIONES -->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->
