<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title"><b>Detalles del pendiente: </b></h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			
			<!-- BEGIN INFORMACION BASICA -->
			<div class="portlet gren">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gift"></i>Información básica
					</div>
				</div>
				<div class="portlet-body form-horizontal">
					<!-- BEGIN FORM-->
					<form  action="<?php echo site_url('actualizar/basica/editar') ?>" id="form-basica-cliente" accept-charset="utf-8">
						<div class="form-body">
							<!-- DIV ERROR -->
							<div class="alert alert-danger display-hide">
								<button class="close" data-close="alert"></button>
								Tienes Errores en tu formulario
							</div>
							<div class="alert alert-success display-hide">
								<button class="close" data-close="alert"></button>
								Exito en el formulario
							</div>
							<!-- INFORMACION BASICA -->
							<div class="col-md-6">
								<h4>Datos de la Empresa</h4>
								<!-- Razon Social -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Razón Social<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-asterisk"></i>
											<input type="hidden" class="form-control" name="id_cliente" value="<?php echo $usuario_activo['id'] ?>">
											<input type="hidden" class="form-control" name="tipo" value="<?php echo $usuario_activo['tipo'] ?>">
											<input type="text" class="form-control" placeholder="Razón Social" name="razon_social" value="<?php echo $usuario_activo['razon_social'] ?>">
										</div>
									</div>
								</div>
								<!-- Rfc -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										R.F.C.<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-barcode"></i>
											<input type="text" class="form-control" placeholder="R.F.C." name="rfc" value="<?php echo $usuario_activo['rfc'] ?>">
										</div>
									</div>
								</div>
								<!-- Email -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Email<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa  fa-envelope"></i>
											<input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $usuario_activo['email'] ?>">
										</div>
									</div>
								</div>

								<hr>

								<!-- TELEFONOS -->
								<h4>Teléfonos</h4>
								<!-- Telefono 1 -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Teléfono 1<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-phone"></i>
											<input type="text" class="form-control" id="telefono_1" placeholder="(999) 999-9999" name="telefono1" value="<?php echo $usuario_activo['telefono1'] ?>">
										</div>
									</div>
								</div>
								<!-- Telefono 2 -->
								<div class="form-group">
									<label class="col-md-4 control-label">Teléfono 2</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-phone"></i>
											<input type="text" class="form-control" id="telefono_2" placeholder="(999) 999-9999" name="telefono2" value="<?php echo $usuario_activo['telefono2'] ?>">
										</div>
									</div>
								</div>

								<hr>

								<!-- ACCESO AL SISTEMA -->
								<h4>Acceso al sistema</h4>
								<!-- Usuario -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Usuario<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-user"></i>
											<input type="text" class="form-control" id="usuario" placeholder="Nombre de usuario" name="usuario" value="<?php echo $usuario_activo['usuario'] ?>">
										</div>
									</div>
								</div>
								<!-- Contraseña -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Contraseña<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-lock"></i>
											<input type="text" class="form-control" id="password" placeholder="Contraseña" name="password" value="<?php echo $usuario_activo['password'] ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<!-- INFORMACION DEL DOMICILIO -->
								<h4>Domicilio</h4>
								<!-- Calle -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Calle<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" placeholder="Calle" name="calle" value="<?php echo $usuario_activo['calle'] ?>">
										</div>
									</div>
								</div>
								<!-- No Exterior -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										No. Exterior<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" placeholder="No. Exterior" name="no_exterior" value="<?php echo $usuario_activo['no_exterior'] ?>">
										</div>
									</div>
								</div>
								<!-- No Interior -->
								<div class="form-group">
									<label class="col-md-4 control-label">No. Interior</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" placeholder="No. Interior" name="no_interior" value="<?php echo $usuario_activo['no_interior'] ?>">
										</div>
									</div>
								</div>
								<!-- Colonia -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Colonia<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" placeholder="Colonia" name="colonia" value="<?php echo $usuario_activo['colonia'] ?>">
										</div>
									</div>
								</div>
								<!-- Codigo Postal -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Código Postal<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" id="codigo_postal_mask" placeholder="99999" name="codigo_postal" value="<?php echo $usuario_activo['codigo_postal'] ?>">
										</div>
									</div>
								</div>
								<!-- Ciudad -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Ciudad<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" placeholder="Ciudad" name="ciudad" value="<?php echo $usuario_activo['ciudad'] ?>">
										</div>
									</div>
								</div>
								<!-- Municipio -->
								<div class="form-group">
									<label class="col-md-4 control-label">Municipio</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" placeholder="Municipio" name="municipio" value="<?php echo $usuario_activo['municipio'] ?>">
										</div>
									</div>
								</div>
								<!-- Estado -->
								<div class="form-group" id="div_estado">
									<label class="col-md-4 control-label">Estado</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<select class="form-control" name="estado" id="estado">
												<option value="<?php echo $usuario_activo['estado'] ?>"><?php echo $usuario_activo['estado'] ?></option>
												<?php foreach ($this->estados as $estado): ?>
													<?php if ($usuario_activo['estado']!=$estado): ?>
														<option value="<?php echo $estado ?>"><?php echo $estado ?></option>
													<?php endif ?>
												<?php endforeach ?>
											</select>
										</div>
									</div>
								</div>
								<!-- Pais -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										País<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<select class="form-control" name="pais" id="pais">
												<option value="Estados Unidos" <?php echo ($usuario_activo['pais']=="México")? "selected":"" ?>>Estados Unidos</option>
												<option value="México" <?php echo ($usuario_activo['pais']=="México")? "selected":"" ?>>México</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions fluid">
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-offset-5 col-md-10">
										<button type="submit" class="btn green"><i class="fa fa-save"></i> Guardar</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					<!-- END FORM-->
				</div>
			</div>
			<!-- END INFORMACION BASICA -->

		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn green update">Aceptar</button>
	<button type="button" class="btn default" data-dismiss="modal">Cerrar</button>
</div>