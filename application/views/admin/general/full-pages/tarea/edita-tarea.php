<form class="form-horizontal" role="form" id="tarea_editar" method="post" action="<?php echo site_url('tarea/edita') ?>">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Editar Tarea</h4>
	</div>
	<div class="modal-body">
			<div class="form-body">
				<!-- ALERTS -->
				<div class="alert alert-danger display-hide">
					<button class="close" data-close="alert"></button>
					Tienes errores en el formulario
				</div>
				<div class="alert alert-success display-hide">
					<button class="close" data-close="alert"></button>
					Éxito en el formulario
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Ejecutivo: <span class="required" aria-required="true">*</span></label>
					<div class="col-md-6">
						<?php echo form_dropdown('ejecutivo', $opciones_ejecutivo, $tarea->id_ejecutivo, 'class="form-control"') ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Tarea: <span class="required" aria-required="true">*</span></label>
					<div class="col-md-9">
						<div class="input-icon">
							<i class="fa fa-bell-o"></i>
							<input type="text" class="form-control" name="tarea" value="<?php echo $tarea->tarea ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Descripción: </label>
					<div class="col-md-9">
						<div class="input-icon">
							<i class="fa fa-bell-o"></i>
							<textarea class="form-control" rows="2" name="descripcion"><?php echo $tarea->descripcion ?></textarea>
							<input type="hidden" name="id_tarea" value="<?php echo $tarea->id_tarea ?>">
							<input type="hidden" name="id_caso" value="<?php echo $caso->id_caso ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Estatus: </label>
					<div class="col-md-6">
						<?php echo form_dropdown('estatus', $opciones_estatus, $tarea->id_estatus, 'class="form-control"') ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Avance: </label>
					<div class="col-md-4">
						<div id="slider-snap-inc" class="slider bg-green" avance="<?php echo $tarea->avance ?>"></div>
						<div class="slider-value">
							<b><span id="slider-snap-inc-amount"><?php echo $tarea->avance ?> %</span></b>
						</div>
					</div>
				</div>
			</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn blue"> Guardar</button>
		<button type="button" class="btn default" data-dismiss="modal"> Cerrar </button>
	</div>
</form>