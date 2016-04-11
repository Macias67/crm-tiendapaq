
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper" id="loaderbody">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Importar Catálogos</h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PORTLET-->
						<div class="portlet gren">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-gift"></i>Formulario para importar <?php echo $tipo ?>
								</div>
							</div>
							<div class="portlet-body form-horizontal">
								<!-- BEGIN FORM-->
								<form action="<?php echo site_url('catalogo/importar/'.$tipo) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
									<div class="form-body">
										<?php echo validation_errors() ?>
										<?php echo $upload_error ?>
										<div class="form-group">
											<div class="col-md-12">
												<h5>
													El archivo debe ser formato <strong>.TXT</strong> y debe tener el <strong>mismo patrón</strong>
													señalado por <strong>CRM <?php echo $nombre_empresa ?></strong>. Este archivo es exportado desde <strong>CONTPAQi Comercial®</strong>.
												</h5>
												<br>
												<div class="fileinput fileinput-new" data-provides="fileinput">
													<div class="input-group input-xlarge">
														<div class="form-control uneditable-input span3" data-trigger="fileinput">
															<i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
															</span>
														</div>
														<span class="input-group-addon btn default btn-file">
														<span class="fileinput-new">
														Seleccionar archivo </span>
														<span class="fileinput-exists">
														Cambiar </span>
														<input type="file" name="userfile">
														</span>
														<a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
														Eliminar </a>
													</div>
													<br>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<button type="submit" class="btn btn-circle green" id="loaderbutton"><i class="fa fa-sign-in"></i> Importar</button>
											</div>
										</div>
									</div>
								</form>
								<!-- END FORM-->
							</div>
						</div>
						<!-- END PORTLET-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->
