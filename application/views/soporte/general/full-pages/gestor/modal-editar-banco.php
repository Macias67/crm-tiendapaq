<div class="modal-header">
	<h3 class="modal-title"><b>Editar Banco</b></h3>
	<small> </small>
</div>
<form id ="form-editar-banco" method="post" accept-charset="utf-8">
	<div class="modal-body form-horizontal">
		<div class="col-md-12">
			<!-- DIV ERROR -->
			<div class="alert alert-danger  display-hide">
				<button class="close" data-close="alert"></button>
				Tienes errores en tu formulario
			</div>
			<!-- BEGIN FORM BODY -->
			<div class="form-body">
				<div class="col-md-12">
					<!-- Banco -->
					<div class="form-group" id="div_estado">
						<label class="col-md-4 control-label">
							Banco
						</label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-map-marker"></i>
								<select class="form-control" name="banco" id="banco">
										<option value="BANAMEX">BANAMEX</option>
										<option value="BANCOMER">BANCOMER</option>
										<option value="SANTANDER">SANTANDER</option>
										<option value="BANORTE">BANORTE</option>
								</select>
							</div>
						</div>
					</div>
					<!-- Sucursal -->
					<div class="form-group">
						<label class="col-md-4 control-label">
							Sucursal<span class="required" aria-required="true">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-map-marker"></i>
								<input type="hidden" id="id_banco" name="id_banco" value="<?php echo $banco->id_banco ?>">
								<input type="text" class="form-control sucursal" placeholder="Sucursal" name="sucursal" value="<?php echo $banco->sucursal ?>">
							</div>
						</div>
					</div>
					<!-- No de cuenta -->
					<div class="form-group">
						<label class="col-md-4 control-label">
							No. de Cuenta<span class="required" aria-required="true">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-map-marker"></i>
								<input type="text" class="form-control cta" placeholder="No. de cuenta" name="cta" value="<?php echo $banco->cta ?>">
							</div>
						</div>
					</div>
					<!-- Titular -->
					<div class="form-group">
						<label class="col-md-4 control-label">
							Titular<span class="required" aria-required="true">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-map-marker"></i>
								<input type="text" class="form-control" placeholder="Nombre del titular" name="titular" value="<?php echo $banco->titular ?>">
							</div>
						</div>
					</div>
					<!-- Clabe interbancaria -->
					<div class="form-group">
						<label class="col-md-4 control-label">
							Clabe interbancaria<span class="required" aria-required="true">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-envelope"></i>
								<input type="text" class="form-control cib" placeholder="Clabe 18 digitos" name="cib" value="<?php echo $banco->cib ?>">
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
		<button type="button" data-dismiss="modal" class="btn btn-circle btn-default">Cancelar</button>
		<button type="submit" id="btn_guardar_banco" class="btn btn-circle green">Guardar</button>
	</div>
</form>