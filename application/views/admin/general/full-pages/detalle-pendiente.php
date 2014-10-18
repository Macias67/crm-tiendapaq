<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title"><b>Detalles del pendiente: </b></h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12">
				<input type="hidden" id="id_pendiente" value="<?php echo $pendiente->id_pendiente ?>">
				<div class="col-md-4 text-right"><b>Razón Social: </b></div>
				<div class="col-md-8"><p><?php echo $pendiente->razon_social ?></p></div>
			</div>
			<div class="col-md-12">
				<div class="col-md-4 text-right"><b>Actividad: </b></div>
				<div class="col-md-8"><p><?php echo $pendiente->actividad ?></p></div>
			</div>
			<div class="col-md-12">
				<div class="col-md-4 text-right"><b>Descripción: </b></div>
				<div class="col-md-8"><p><?php echo $pendiente->descripcion ?></p></div>
			</div>
			<div class="col-md-12">
				<div class="col-md-4 text-right"><b>Fecha asignada: </b></div>
				<div class="col-md-8"><p><?php echo fecha_completa($pendiente->fecha_origen) ?></p></div>
			</div>
			<div class="col-md-12">
				<div class="col-md-4 text-right"><b>Asignado por: </b></div>
				<div class="col-md-8"><p><?php echo $pendiente->creador ?></p></div>
			</div>
			<div class="col-md-12">
				<div class="col-md-4 text-right"><b>Oficina origen: </b></div>
				<div class="col-md-8"><p><?php echo $pendiente->oficina ?></p></div>
			</div>
			<div class="col-md-12">
				<div class="col-md-4 text-right"><b>Estatus: </b></div>
				<div class="col-md-8">
					<?php if($pendiente->estatus == 3 || $pendiente->estatus == 7): ?>
						<select id="estatus_pendiente">
							<option value="<?php echo $estatus[2]->id_estatus ?>"><?php echo $estatus[2]->estatus ?></option>
							<option value="<?php echo $estatus[4]->id_estatus ?>"><?php echo $estatus[4]->estatus ?></option>
							<option value="<?php echo $estatus[1]->id_estatus ?>"><?php echo $estatus[1]->estatus ?></option>
							<option value="<?php echo $estatus[0]->id_estatus ?>"><?php echo $estatus[0]->estatus ?></option>
						</select>
					<?php else: ?>
						<b><?php echo strtoupper($estatus[($pendiente->estatus)-1]->estatus) ?></b>
					<?php endif ?>
				</div>
			</div>
			<?php if($pendiente->estatus == 3 || $pendiente->estatus == 7): ?>
				<div class="col-md-12">
					<div class="col-md-4 text-right"><b>Reasignar a: </b></div>
					<div class="col-md-8">
						<select id="ejecutivo_destino">
							<option value=""></option>
							<?php foreach ($ejecutivos as $ejecutivo): ?>
								<?php if($ejecutivo->id!=$usuario_activo['id']): ?>
									<option value="<?php echo $ejecutivo->id ?>"><?php echo $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno ?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			<?php endif ?>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn green update">Aceptar</button>
	<button type="button" class="btn default" data-dismiss="modal">Cerrar</button>
	<?php echo (isset($url_cotiza)) ? $url_cotiza : '' ?>
</div>