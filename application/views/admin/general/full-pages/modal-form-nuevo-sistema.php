<div class="modal-header">
	<h3 class="modal-title"><b>SIstema</b></h3>
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
					<!-- Sistema -->
					<div class="form-group">
						<label class="col-md-4 control-label">Sistema: </label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-user"></i>
								<input type="hidden" class="form-control" name="id" value="<?php echo $sistema->id ?>">
								<input type="hidden" class="form-control" name="id_cliente" value="<?php echo $sistema->id_cliente ?>">
								<input type="text" class="form-control" placeholder="Sistema" name="sistema" value="<?php echo $sistema->sistema ?>">
							</div>
						</div>
					</div>
					<!-- Version -->
					<div class="form-group">
						<label class="col-md-4 control-label">Versión: </label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-user"></i>
								<input type="text" class="form-control" placeholder="Version" name="version" value="<?php echo $sistema->version ?>">
							</div>
						</div>
					</div>
					<!-- No. Serie -->
					<div class="form-group">
						<label class="col-md-4 control-label">No. Serie: </label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-user"></i>
								<input type="text" class="form-control" placeholder="No. Serie" name="no_serie" value="<?php echo $sistema->no_serie ?>">
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