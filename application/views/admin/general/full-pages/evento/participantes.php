<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title"><b><?php echo count($participantes) ?> Participantes</b></h4>
</div>
<div class="modal-body">
	<!-- <div class="scroller"> -->
		<div class="row">
			<div class="col-md-12">
			<table class="table table-bordered table-striped table-condensed flip-content">
				<thead class="flip-content">
					<tr>
						<th width="20%"> Contacto</th>
						<th width="10%"> Email </th>
						<th width="20%"> Teléofono </th>
						<th width="30%">Cliente</th>
						<th width="1%"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($participantes as $index => $participante): ?>
						<tr>
							<td><?php echo $participante->nombre_contacto.' '.$participante->apellido_paterno ?></td>
							<td><?php echo $participante->email_contacto ?></td>
							<td><?php echo $participante->telefono_contacto ?></td>
							<td><?php echo $participante->razon_social ?></td>
							<td><button type="button" class="btn blue btn-sm">Recordar</button></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			</div>
		</div>
	<!-- </div> -->
</div>
<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal">Cerrar</button>
</div>