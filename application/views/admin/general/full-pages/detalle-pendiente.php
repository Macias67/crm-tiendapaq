<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title"><b>Detalles del pendiente: </b></h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12">
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
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal">Cerrar</button>
	<?php echo (isset($url_cotiza)) ? $url_cotiza : '' ?>
</div>