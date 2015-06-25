<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h3 class="modal-title"><b>Detalles del caso:</b></h3>
</div>
<div class="modal-body">
	<div class="scroller">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12">
					<input type="hidden" id="folio_cotizacion" value="<?php echo $caso->folio_cotizacion ?>">
					<input type="hidden" id="id_cliente" value="<?php echo $caso->id_cliente ?>">
					<input type="hidden" id="id_caso" value="<?php echo $caso->id_caso ?>">
					<div class="col-md-4 text-right"><b>No. de caso: </b></div>
					<div class="col-md-8"><p><?php echo $caso->id_caso ?></p></div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4 text-right"><b>Lider del caso: </b></div>
					<div class="col-md-8"><p><?php echo $caso->primer_nombre.' '.$caso->apellido_paterno ?></p></div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4 text-right"><b>Estatus: </b></div>
					<div class="col-md-8"><p><?php echo ucfirst($caso->estatus)?></p></div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4 text-right"><b>Cliente: </b></div>
					<div class="col-md-8"><p><?php echo $caso->razon_social ?></p></div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4 text-right"><b>Tipo de cliente: </b></div>
					<div class="col-md-8"><p><?php echo ucfirst($caso->tipo) ?></p></div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4 text-right"><b>Fecha de inicio: </b></div>
					<div class="col-md-8"><p><?php echo fecha_completa($caso->fecha_inicio); ?></p></div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4 text-right"><b>Fecha de fin (aprox.): </b></div>
					<div class="col-md-8"><p><?php echo ($caso->fecha_final == '1000-01-01 00:00:00')? 'Sin cerrar caso' : fecha_completa($caso->fecha_final) ?></p></div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4 text-right"><b>Cotización: </b></div>
					<div class="col-md-8"><a class="btn blue btn-circle btn-xs ver-cotizacion">Click para ver la cotización</a></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn green btn-circle" data-dismiss="modal">Aceptar</button>
	<?php if($boton_cerrar_caso): ?>
	<button type="button" class="btn red btn-circle cerrar-caso" >Cerrar caso</button>
	<?php endif ?>
</div>