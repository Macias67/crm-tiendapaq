<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title"><b>Historial de Reasignaciones: </b></h4>
</div>
<div class="modal-body">
	<div class="row">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Ejecutivo Origen</th>
					<th>Ejecutivo Destino</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($reasignaciones as $reasignacion) : ?>
				<tr class="odd gradeX">
					<td><?php echo $reasignacion->nombre_origen.' '.$reasignacion->apellido_origen ?></td>
					<td><?php echo $reasignacion->nombre_destino.' '.$reasignacion->apellido_destino ?></td>
					<td><?php echo $reasignacion->fecha ?></td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn green" data-dismiss="modal">Aceptar</button>
</div>
