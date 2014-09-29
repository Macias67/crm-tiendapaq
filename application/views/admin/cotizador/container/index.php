
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

						<div class="row">
							<!-- Cotización -->
							<div class="col-md-3">
								<div class="portlet gren">

									<div class="portlet-title">
										<div class="caption"><i class="fa fa-gift"></i> Cotización</div>
									</div>
									<div class="portlet-body">
										<div class="col-md-6">
											<h5>Folio: </h5>
											<b id="folio"><?php echo $sig_folio ?></b>
										</div>
										<div class="col-md-6">
											<h5>Fecha: </h5>
											<b id="fecha"><?php echo date('d/m/Y') ?></b>
										</div>
										<div class="col-md-12">
											<h5>Ejecutivo: </h5>
											<b id="<?php echo $id_ejecutivo ?>" class="ejecutivo"><?php echo $nombre_completo ?></b>
										</div>
									</div>
								</div>
							</div>
							<!-- Cliente -->
							<div class="col-md-9">
								<div class="portlet gren">

									<div class="portlet-title">
										<div class="caption"><i class="fa fa-gift"></i> Cliente</div>
									</div>

									<div class="portlet-body">
										<form role="form">
											<div class="form-body">

												<div class="col-md-12">
													<div class="form-group">
														<input type="hidden" id="razon_social" name="razon_social" class="form-control input-inline select2" style="width: 100%">
													</div>
												</div>

												<div class="col-md-12">

													<div class="col-md-4">
														<div class="form-group">
															<label>Contactos</label>
															<select class="form-control" id="contactos" name="contactos"></select>
														</div>
													</div>

													<div class="col-md-4">
														<div class="form-group">
															<label>Teléfono</label>
															<input class="form-control" id="telefono" type="text">
														</div>
													</div>

													<div class="col-md-4">
														<div class="form-group">
															<label>Email</label>
															<input class="form-control" id="email" type="text">
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

						<hr>

						<div class="row">
							<div class="col-md-4">
								<div class="col-md-12">
									<div class="portlet gren">
										<div class="portlet-title">
											<div class="caption"><i class="fa fa-gift"></i> Producto</div>
										</div>
										<div class="portlet-body">
											<!-- Empresa -->
											<div class="form-group">
												<input type="hidden" class="form-control input-inline select2" id="producto" name="producto" style="width: 100%">
											</div>

											<div class="form-group">
												<div class="col-md-6">
													<label>Cantidad</label>
													<div id="cantidad">
														<div class="input-group input-small">
															<input type="text" class="spinner-input form-control" maxlength="3">
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
													<br>
												</div>

												<div class="col-md-6">
													<label for="descuento" id="label-desc">Descuento</label>
													<input type="text" class="form-control" placeholder="99.99% ó $99.99" id="descuento">
												</div>
											</div>

											<div class="form-group">
												<div class="col-md-12">
													<button type="button" id="add" class="btn btn-block green-meadow"> Añadir a lista</button>
												</div>
											</div>
											<!-- FIN Empresa -->
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<br>
									<div class="portlet gren">
										<div class="portlet-title">
											<div class="caption"><i class="fa fa-gift"></i> Total</div>
										</div>
										<div class="portlet-body">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Subtotal</th>
														<th>I.V.A.</th>
														<th>TOTAL</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td id="subtotal">$ 0</td>
														<td id="iva">$ 0</td>
														<td id="total"><b style="color: red">$ 0</b></td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="col-md-6">
											<button type="button" id="previa" class="btn btn-block red cotizacion">Previa cotización</button>
										</div>
										<div class="col-md-6">
											<button type="button" id="enviar" class="btn btn-block red cotizacion">Enviar cotización</button>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-8">
								<div class="portlet gren">

									<div class="portlet-title">
										<div class="caption"><i class="fa fa-gift"></i> Lista de Productos</div>
									</div>

									<div class="portlet-body">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th></th>
													<th>Código</th>
													<th>Descripción</th>
													<th>Cantidad</th>
													<th>P. Unitario</th>
													<th>Neto</th>
													<th>Desc.</th>
													<th>Total</th>
													<th></th>
												</tr>
											</thead>
											<tbody id="lista">
												<script id="fila" type="text/x-jquery-tmpl">
													<tr id="${producto.codigo}" class="${producto.posicion}">
														<td>
															<button type="button" class="btn popovers btn-info btn-xs comments" data-content="${observacion.contenido}" data-original-title="${observacion.titulo}"><i class="fa fa-comments-o"></i></button>
														</td>
														<td>${producto.codigo}</td>
														<td>${producto.descripcion}</td>
														<td>${producto.cantidad}</td>
														<td>$ ${producto.precio}</td>
														<td>$ ${producto.neto}</td>
														<td>$ ${producto.descuento}</td>
														<td><b>$ ${producto.total}</b></td>
														<td>
															<button type="button" class="btn btn-danger btn-xs delete"><i class="fa fa-times"></i></button>
														</td>
													</tr>
												</script>
											</tbody>
										</table>
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