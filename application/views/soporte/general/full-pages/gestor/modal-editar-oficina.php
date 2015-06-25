<div class="modal-header">
	<h3 class="modal-title"><b>Editar Oficina</b></h3>
	<small> </small>
</div>
<form id ="form-editar-oficina" method="post" accept-charset="utf-8">
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
					<!-- Ciudad -->
					<div class="form-group">
						<input type="hidden" id="id_oficina" name="id_oficina" value="<?php echo $oficina->id_oficina ?>">
						<label class="col-md-4 control-label">
							Ciudad<span class="required" aria-required="true">*</span>
						 </label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-map-marker"></i>
								<input type="text" class="form-control" placeholder="Ciudad" name="ciudad" value="<?php echo $oficina->ciudad ?>">
							</div>
						</div>
					</div>
					<!-- Estado -->
					<div class="form-group" id="div_estado">
						<label class="col-md-4 control-label">
							Estado<span class="required" aria-required="true">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-map-marker"></i>
								<select class="form-control" name="estado" id="estado">
									<?php foreach ($this->estados as $estado): ?>
										<option value="<?php echo $estado ?>" <?php echo ($estado==$oficina->estado)? 'selected':'' ?>><?php echo $estado ?></option>
									<?php endforeach ?>
								</select>
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
								<input type="text" class="form-control" placeholder="Colonia" name="colonia" value="<?php echo $oficina->colonia ?>">
							</div>
						</div>
					</div>
					<!-- Calle -->
					<div class="form-group">
						<label class="col-md-4 control-label">
							Calle<span class="required" aria-required="true">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-map-marker"></i>
								<input type="text" class="form-control" placeholder="Calle" name="calle" value="<?php echo $oficina->calle ?>">
							</div>
						</div>
					</div>
					<!-- Numero -->
					<div class="form-group">
						<label class="col-md-4 control-label">Numero </label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-map-marker"></i>
								<input type="text" class="form-control" id="numero" placeholder="Numero" name="numero" value="<?php echo $oficina->numero ?>">
							</div>
						</div>
					</div>
					<!-- Email -->
					<div class="form-group">
						<label class="col-md-4 control-label">Email </label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-envelope"></i>
								<input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $oficina->email ?>">
							</div>
						</div>
					</div>
					<!-- Teléfono -->
					<div class="form-group">
						<label class="col-md-4 control-label">Teléfono </label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-phone"></i>
								<input type="text" class="form-control telefono" placeholder="Teléfono" name="telefono" value="<?php echo $oficina->telefono ?>">
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
		<button type="submit" id="btn_guardar_oficina" class="btn btn-circle green">Guardar</button>
	</div>
</form>