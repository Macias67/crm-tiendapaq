<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h3 class="modal-title"><b>Detalles del evento:</b></h3>
</div>
<div class="modal-body">
	<div class="scroller">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12">
					<input type="hidden" id="id_evento" value="<?php echo $evento[0]->id_evento ?>">
					<input type="hidden" id="id_ejecutivo" value="<?php echo $evento[0]->id_ejecutivo ?>">
					<input type="hidden" id="id_cliente" value="<?php echo $evento[0]->id_cliente ?>">
					<div class="col-md-4 text-right"><b>No. de evento: </b></div>
					<div class="col-md-8"><p><?php echo $evento[0]->id_evento ?></p></div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4 text-right"><b>Ejecutivo: </b></div>
					<div class="col-md-8"><p><?php echo $evento[0]->primer_nombre.' '.$evento[0]->apellido_paterno ?></p></div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4 text-right"><b>Título: </b></div>
					<div class="col-md-8"><p><?php echo ucfirst($evento[0]->titulo)?></p></div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4 text-right"><b>Fecha de evento: </b></div>
					<div class="col-md-8"><p><?php echo $evento[0]->fecha_evento ?></p></div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4 text-right"><b>Fecha de creación: </b></div>
					<div class="col-md-8"><p><?php echo $evento[0]->fecha_creacion ?></p></div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4 text-right"><b>Costo: </b></div>
					<div class="col-md-8"><p><?php echo ucfirst($evento[0]->costo)?></p></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn green btn-circle" data-dismiss="modal">Aceptar</button>
</div>