<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Registro de participantes - <small><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?></small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN REGISTRO A EVENTO -->
					<div class="row">
						<!-- Cliente -->
						<div class="col-md-12">
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
											<div class="col-md-12">
												Si no se encuentra en la lista de contactos, te pedimos que tu empresa te registre.
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				<!-- END REGISTRO A EVENTO -->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->