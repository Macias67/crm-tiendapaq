<div class="modal-header">
	<h3 class="modal-title"><b>Contácto</b></h3>
	<small> </small>
</div>
<form id ="form-contacto" method="post" accept-charset="utf-8">
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
						<!-- Nombre(s) -->
						<div class="form-group">
							<label class="col-md-4 control-label">Nombre(s): </label>
							<div class="col-md-8">
								<div class="input-icon">
									<i class="fa fa-user"></i>
									<input type="hidden" class="form-control" name="id" value="<?php echo $contacto->id ?>">
									<input type="hidden" class="form-control" name="id_cliente" value="<?php echo $contacto->id_cliente ?>">
									<input type="text" class="form-control" placeholder="Nombre(s)" name="nombre_contacto" value="<?php echo $contacto->nombre_contacto ?>">
								</div>
							</div>
						</div>
						<!-- Apellido paterno -->
						<div class="form-group">
							<label class="col-md-4 control-label">Apellido paterno: </label>
							<div class="col-md-8">
								<div class="input-icon">
									<i class="fa fa-user"></i>
									<input type="text" class="form-control" placeholder="Apellido paterno" name="apellido_paterno" value="<?php echo $contacto->apellido_paterno ?>">
								</div>
							</div>
						</div>
						<!-- Apellido materno -->
						<div class="form-group">
							<label class="col-md-4 control-label">Apellido materno: </label>
							<div class="col-md-8">
								<div class="input-icon">
									<i class="fa fa-user"></i>
									<input type="text" class="form-control" placeholder="Apellido materno" name="apellido_materno" value="<?php echo $contacto->apellido_materno ?>">
								</div>
							</div>
						</div>
						<!-- Email -->
						<div class="form-group">
							<label class="col-md-4 control-label">Email: </label>
							<div class="col-md-8">
								<div class="input-icon">
									<i class="fa fa-envelope"></i>
									<input type="text" class="form-control" placeholder="Email" name="email_contacto" value="<?php echo $contacto->email_contacto ?>">
								</div>
							</div>
						</div>
						<!-- Teléfono -->
						<div class="form-group">
							<label class="col-md-4 control-label">Teléfono: </label>
							<div class="col-md-8">
								<div class="input-icon">
									<i class="fa fa-phone"></i>
									<input type="text" class="form-control telefono_contacto" placeholder="Teléfono" name="telefono_contacto" value="<?php echo $contacto->telefono_contacto ?>">
								</div>
							</div>
						</div>
						<!-- Puesto -->
						<div class="form-group">
							<label class="col-md-4 control-label">Puesto: </label>
							<div class="col-md-8">
								<div class="input-icon">
									<i class="fa fa-certificate"></i>
									<input type="text" class="form-control" placeholder="Puesto" name="puesto_contacto" value="<?php echo $contacto->puesto_contacto ?>">
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
		<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
		<button type="submit" id="btn_guardar_equipo" class="btn green">Guardar</button>
	</div>
</form>