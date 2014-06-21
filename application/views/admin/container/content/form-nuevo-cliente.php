		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
				<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title">Modal title</h4>
							</div>
							<div class="modal-body">
								 Widget settings form goes here
							</div>
							<div class="modal-footer">
								<button type="button" class="btn blue">Save changes</button>
								<button type="button" class="btn default" data-dismiss="modal">Close</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
				<!-- BEGIN STYLE CUSTOMIZER -->
				<div class="theme-panel hidden-xs hidden-sm">
					<div class="toggler">
					</div>
					<div class="toggler-close">
					</div>
					<div class="theme-options">
						<div class="theme-option theme-colors clearfix">
							<span>
							THEME COLOR </span>
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
						<h3 class="page-title">
						Blank Page <small>blank page</small>
						</h3>
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
								<a href="index.html">Home</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Page Layouts</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Blank Page</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">

						<div class="tab-pane " id="tab_2">
							<div class="portlet gren">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-gift"></i>Formulario de Nuevo Cliente
									</div>
									<div class="tools">
										<a href="javascript:;" class="collapse">
										</a>
										<a href="javascript:;" class="reload">
										</a>
									</div>
								</div>
								<div class="portlet-body form">
									<!-- BEGIN FORM-->
									<form action="#" class="form-horizontal">
										<div class="form-body">
											<div class="row">
												<!-- DATOS DE LA EMPRESA -->
												<div class="col-md-6">
													<h3 class="form-section">Datos de la Empresa</h3>
													<!-- FRC -->
													<div class="form-group">
														<label class="control-label col-md-3">R.F.C. : </label>
														<div class="col-md-9">
															<input type="text" class="form-control" placeholder="RFC del cliente o empresa">
														</div>
													</div>
													<!-- RAZON SOCIAL -->
													<div class="form-group">
														<label class="control-label col-md-3">Razón Social: </label>
														<div class="col-md-9">
															<input type="text" class="form-control" placeholder="Rzzon social del cliente">
														</div>
													</div>
													<!-- TELEFONO -->
													<div class="form-group">
														<label class="control-label col-md-3">Telefono</label>
														<div class="col-md-4">
															<input class="form-control" id="telefono-cliente" type="text"/>
															<span class="help-block">
															(999) 999-9999 </span>
														</div>
													</div>
													<!-- EMAIL -->
													<div class="form-group">
													<label class="col-md-3 control-label">Email</label>
													<div class="col-md-9">
														<div class="input-group">
															<span class="input-group-addon">
															<i class="fa fa-envelope"></i>
															</span>
															<input type="email" class="form-control" placeholder="Email del cliente">
														</div>
													</div>
												</div>
												<!-- TIPO -->
													<div class="form-group">
														<label class="control-label col-md-3">Tipo : </label>
														<div class="col-md-9">
															<select class="form-control">
																<option value="">Normal</option>
																<option value="">Distribuidor</option>
																<option value="">Prospecto</option>
															</select>
														</div>
													</div>
												</div>
												<!---->
												<div class="col-md-6">
													<h3 class="form-section">Datos del domicilio</h3>
													<div class="form-group has-error">
														<label class="control-label col-md-3">Last Name</label>
														<div class="col-md-9">
															<select name="foo" class="select2me form-control">
																<option value="1">Abc</option>
																<option value="1">Abc</option>
																<option value="1">This is a really long value that breaks the fluid design for a select2</option>
															</select>
															<span class="help-block">
															This field has error. </span>
														</div>
													</div>
												</div>
												<!--/span-->
											</div>
										</div>
										<div class="form-actions fluid">
											<div class="row">
												<div class="col-md-6">
													<div class="col-md-offset-3 col-md-9">
														<button type="submit" class="btn green"> Guardar</button>
														<button type="button" class="btn default"> Cancelar</button>
													</div>
												</div>
												<div class="col-md-6">
												</div>
											</div>
										</div>
									</form>
									<!-- END FORM-->
								</div>
							</div>
						</div>

					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->