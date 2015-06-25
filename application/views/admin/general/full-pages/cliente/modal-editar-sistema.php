<div class="modal-header">
	<h3 class="modal-title"><b>Sistema</b></h3>
	<small> </small>
</div>
<form id="form-sistema-editar" method="post" accept-charset="utf-8">
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
						<label class="col-md-4 control-label">
							Sistema
						</label>
						<div class="col-md-8">
							<input type="hidden" class="form-control" name="id" value="<?php echo $sistema->id ?>">
							<input type="hidden" class="form-control" name="id_cliente" value="<?php echo $sistema->id_cliente ?>">
							<div class="input-icon">
								<i class="fa fa-info"></i>
								<?php echo $select_SIS ?>
							</div>
						</div>
					</div>
					<!-- Versión -->
					<div class="form-group">
						<label class="col-md-4 control-label">Versión</label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-history"></i>
								<?php echo $select_VERS ?>
								<!-- <select class="form-control" name="version" id="select_versiones_edita">

								</select> -->
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
		<button type="button" data-dismiss="modal" class="btn btn-circle btn-default">Cancelar</button>
		<button type="submit" id="btn_guardar_sistema" class="btn btn-circle green">Guardar</button>
	</div>
</form>