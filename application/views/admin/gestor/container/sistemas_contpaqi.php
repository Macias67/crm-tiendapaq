		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN STYLE CUSTOMIZER -->
				<div class="theme-panel hidden-xs hidden-sm">
					<div class="toggler">
					</div>
					<div class="toggler-close">
					</div>
					<div class="theme-options">
						<div class="theme-option theme-colors clearfix">
							<span>
							COLOR </span>
							<ul>
								<li class="color-default current tooltips" data-style="default" data-original-title="Default">
								</li>
								<li class="color-darkblue tooltips" data-style="darkblue" data-original-title="Dark Blue">
								</li>
								<li class="color-blue tooltips" data-style="blue" data-original-title="Blue">
								</li>
								<li class="color-grey tooltips" data-style="grey" data-original-title="Grey">
								</li>
								<li class="color-light tooltips" data-style="light" data-original-title="Light">
								</li>
								<li class="color-light2 tooltips" data-style="light2" data-html="true" data-original-title="Light 2">
								</li>
							</ul>
						</div>
						<div class="theme-option">
							<span>
							Layout </span>
							<select class="layout-option form-control input-small">
								<option value="fluid" selected="selected">Fluid</option>
								<option value="boxed">Boxed</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Header </span>
							<select class="page-header-option form-control input-small">
								<option value="fixed" selected="selected">Fixed</option>
								<option value="default">Default</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Sidebar </span>
							<select class="sidebar-option form-control input-small">
								<option value="fixed">Fixed</option>
								<option value="default" selected="selected">Default</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Sidebar Position </span>
							<select class="sidebar-pos-option form-control input-small">
								<option value="left" selected="selected">Left</option>
								<option value="right">Right</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Footer </span>
							<select class="page-footer-option form-control input-small">
								<option value="fixed">Fixed</option>
								<option value="default" selected="selected">Default</option>
							</select>
						</div>
					</div>
				</div>
				<!-- END STYLE CUSTOMIZER -->

				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title"> Sistemas <strong>CONTPAQi®</strong> - <small>Gestor General</small></h3>
						<ul class="page-breadcrumb breadcrumb">
							<li class="btn-group">
								<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
								<span>Actions</span><i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">
									<li>
										<a href="#">Action</a>
									</li>
									<li>
										<a href="#">Another action</a>
									</li>
									<li>
										<a href="#">Something else here</a>
									</li>
									<li class="divider">
									</li>
									<li>
										<a href="#">Separated link</a>
									</li>
								</ul>
							</li>
							<li>
								<i class="fa fa-home"></i>
								<a href="<?php echo site_url() ?>">Inicio</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Gestor Geleral</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Sistemas CONTPAQi®</a>
							</li>
						</ul>
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
													<td><a class="edit" href="javascript:;">Editar </a></td>
													<td><a class="delete" href="javascript:;">Eliminar </a></td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
									<br>
									<div class="table-toolbar">
										<div class="btn-group pull-right">
											<button id="tabla_sistemas_editable_new" class="btn green btn-xs">
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
											<button id="guardar_versiones" class="btn green btn-xs">
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
