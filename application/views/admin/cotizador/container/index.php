
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
						<h3 class="page-title">Blank Page <small>blank page</small></h3>
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
								<a href="#">Pagina</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Seccion</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PORTLET -->
						<div class="portlet gren">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-gift"></i>
									Cotización
								</div>
							</div>
							<div class="portlet-body">
								<div class="col-md-12">
									<form class="form-inline">

										<!-- Cotización -->
										<div class="col-md-2">
											<div class="portlet gren">
												<div class="portlet-title">
													<div class="caption">
														<i class="fa fa-gift"></i> Cotización
													</div>
												</div>
												<div class="portlet-body">
													<h5>Folio: <b>1290</b></h5>
													<h5>Ejecutivo: <b>Luis Alberto Macias Angulo</b></h5>
													<h5>Fecha: <b>02/06/2013</b></h5>
												</div>
											</div>
										</div>
										<!-- FIN Cotización -->

										<!-- Cliente -->
										<div class="col-md-5">
											<div class="portlet gren">
												<div class="portlet-title">
													<div class="caption">
														<i class="fa fa-gift"></i> Cliente
													</div>
												</div>
												<div class="portlet-body">
													<div class="col-md-12">
														<div class="col-md-12">
															<input type="hidden" id="razon_social" name="razon_social" class="form-control input-inline input-large select2">
														</div>
														<div class="col-md-6">
															<h5>Folio: <b>1290</b></h5>
															<h5>Fecha: <b>02/06/2013</b></h5>
														</div>
														<div class="col-md-6">
															<h5>Ejecutivo: <b>Luis Alberto Macias Angulo</b></h5>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- FIN Cliente -->

										<!-- Producto -->
										<div class="col-md-5">
											<div class="portlet gren">
												<div class="portlet-title">
													<div class="caption">
														<i class="fa fa-gift"></i> Producto
													</div>
												</div>
												<div class="portlet-body">
													<!-- Empresa -->
													<div class="col-md-12">
														<!-- Empresa -->
														<div class="form-group">
															<div class="col-md-6">
																<input type="hidden" class="form-control input-inline input-large select2" id="producto" name="producto">
															</div>
														</div>

														<div class="form-group">
															<div class="col-md-6">
																<div id="cantidad">
																	<div class="input-group input-small">
																		<input type="text" class="spinner-input form-control" maxlength="3" readonly="">
																		<div class="spinner-buttons input-group-btn btn-group-vertical">
																			<button type="button" class="btn spinner-up btn-xs gray">
																				<i class="fa fa-angle-up"></i>
																			</button>
																			<button type="button" class="btn spinner-down btn-xs gray">
																				<i class="fa fa-angle-down"></i>
																			</button>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<button type="button" id="add" class="btn green-meadow"> Añadir a lista</button>
														<!-- FIN Empresa -->
													</div>
												</div>
											</div>
										</div>
										<!-- FIN Producto -->
									</form>
									<hr>
								</div>
								<div class="col-md-12">
									<table class="table table-striped table-hover">
										<thead>
											<tr>
												<th>Código</th>
												<th>Nombre</th>
												<th class="hidden-480">Unidad</th>
												<th class="hidden-480">Precio</th>
												<th class="hidden-480">Cantidad</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody id="lista">
											<script id="fila" type="text/x-jquery-tmpl">
												<tr>
													<td>${codigo}</td>
													<td>${nombre}</td>
													<td class="hidden-480">${unidad}</td>
													<td class="hidden-480">$ ${precio}</td>
													<td class="hidden-480">${cantidad}</td>
													<td class="hidden-480">$ ${importe}</td>
												</tr>
											</script>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- END PORTLET -->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->
