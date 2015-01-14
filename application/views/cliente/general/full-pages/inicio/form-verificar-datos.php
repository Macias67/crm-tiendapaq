<div class="modal-header">
		<h3><b>Verificar Datos - <small><a href="<?php echo site_url('/gestionar/porque') ?>" data-target="#ajax-porque" data-toggle="modal">¿Por qué esto?</a></small></h3>
</div>
<form id="form-verificar-datos" method="post" accept-charset="utf-8">
	<div class="modal-body form-horizontal">
		<div class="scroller" style="height: 350px" id="div-scroll-verificar-datos">
			<!-- DIV ERROR -->
			<div class="alert alert-danger display-hide">
				<button class="close" data-close="alert"></button>
				Tienes Errores en tu formulario
			</div>
			<!-- BEGIN FORM BODY -->
			<div class="form-body">
				<!-- INFORMACION BASICA -->
				<div class="col-md-6">
					<h4>Información Básica</h4>
					<!-- Razon Social -->
					<div class="form-group">
						<label class="col-md-4 control-label">
							Razón Social<span class="required" aria-required="true">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-asterisk"></i>
								<input type="hidden" id="folio_cotizacion"  value="<?php echo $folio_cotizacion ?>">
								<input type="hidden" name="id_cliente"  value="<?php echo $usuario_activo['id'] ?>">
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
					<!-- TELEFONOS -->
					<!-- Telefono 1 -->
					<div class="form-group">
						<label class="col-md-4 control-label">
							Teléfono 1 <span class="required" aria-required="true">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-phone"></i>
								<input type="text" class="form-control" id="telefono1" placeholder="(999) 999-9999" name="telefono1" value="<?php echo $usuario_activo['telefono1'] ?>">
							</div>
						</div>
					</div>
					<br>
					<br>
					<ul>
						<li>Puedes editar mas información en la seccion de gestión</li>
					</ul>
				</div>
				<!-- INFORMACION DE CONTACTO -->
				<div class="col-md-6">
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
								<input type="text" class="form-control" id="codigo_postal" placeholder="99999" name="codigo_postal" value="<?php echo $usuario_activo['codigo_postal'] ?>">
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
				</div>
			</div>
			<!-- END FORM BODY -->
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="modal-footer">
		<button type="submit" id="btn_verificar_datos" class="btn green btn-circle update">Guardar</button>
		<button type="button" class="btn default btn-circle" data-dismiss="modal">Cerrar</button>
	</div>
</form>