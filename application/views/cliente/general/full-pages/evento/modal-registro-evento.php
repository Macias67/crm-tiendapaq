<div class="modal-header">
	<h3 class="modal-title"><b>Registro a evento</b></h3>
	<small> </small>
</div>
<form id="registro-evento" method="post" accept-charset="utf-8">
	<div class="modal-body form-horizontal">
		<div class="col-md-12">
			<!-- BEGIN FORM BODY -->
			<div class="form-body">
				<div class="col-md-12">
					<!-- Nombre evento -->
					<!-- Contacto -->
					<div class="form-group">
						<label class="col-md-4 control-label">Contacto a registrar: </label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-users"></i>
								<input type="text" class="form-control" value="<?php echo $contacto->nombre_contacto.' '.$contacto->apellido_paterno ?>" readonly>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Nombre de curso: </label>
						<div class="col-md-8">
							<div class="input-icon">
								<input type="hidden" class="form-control" id="id_evento" value="<?php echo $evento->id_evento ?>">
								<input type="hidden" class="form-control" id="id_contacto" value="<?php echo $contacto->id ?>">
								<input type="hidden" class="form-control" id="id_cliente" value="<?php echo $contacto->id_cliente ?>">
								<i class="fa fa-mortar-board"></i>
								<input type="text" class="form-control" value="<?php echo $evento->titulo ?>" readonly>
							</div>
						</div>
					</div>
					<!-- Modalidad -->
					<div class="form-group">
						<label class="col-md-4 control-label">Modalidad: </label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-edit"></i>
								<input type="text" class="form-control" value="<?php echo ucfirst($evento->modalidad) ?>" readonly>
							</div>
						</div>
					</div>
					<!-- Precio -->
					<div class="form-group">
						<label class="col-md-4 control-label">Precio: </label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-dollar"></i>
								<input type="text" class="form-control" value="<?php echo $evento->costo ?>" readonly>
							</div>
						</div>
					</div>
					<!-- Fecha de inicio -->
					<div class="form-group">
						<label class="col-md-4 control-label">Fecha de inicio: </label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-calendar"></i>
								<input type="text" class="form-control" value="<?php echo fecha_completa($evento->fecha_inicio) ?>" readonly>
							</div>
						</div>
					</div>
					<!-- Sesiones -->
					<div class="form-group">
						<label class="col-md-4 control-label">N° Sesiones: </label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-check"></i>
								<input type="text" class="form-control" value="<?php echo $evento->sesiones ?>" readonly>
							</div>
						</div>
					</div>
					<!-- Ejecutivo -->
					<div class="form-group">
						<label class="col-md-4 control-label">Ejecutivo: </label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-user"></i>
								<input type="text" class="form-control" value="<?php echo $evento->primer_nombre.' '.$evento->apellido_paterno ?>" readonly>
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
		<button type="button" class="btn btn-circle purple-studio btn_registrar_participante">Enviar</button>
	</div>
</form>