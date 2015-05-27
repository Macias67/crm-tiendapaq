<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title"><b>Reasignacones del caso: </b></h4>
</div>
<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
			<table class="table table-bordered table-striped table-condensed flip-content">
				<thead class="flip-content">
					<tr>
						<th width="20%"> Caso no.</th>
						<th width="10%"> Ejecutivo origen </th>
						<th width="20%"> Ejecutivo destino </th>
						<th width="30%"> Fecha</th>
						<th width="30%"> Motivo</th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($casoreasignado)==1): ?>
						<tr>
							<td><?php echo $casoreasignado->id_caso ?></td>
							<td><?php echo $ejecutivos[$casoreasignado->id_ejecutivo_origen-1]->primer_nombre.' '.$ejecutivos[$casoreasignado->id_ejecutivo_origen-1]->apellido_paterno?></td>
							<td><?php echo $ejecutivos[$casoreasignado->id_ejecutivo_destino-1]->primer_nombre.' '.$ejecutivos[$casoreasignado->id_ejecutivo_destino-1]->apellido_paterno?></td>
							<td><?php echo fecha_corta($casoreasignado->fecha) ?></td>
							<td><?php echo $casoreasignado->motivo ?></td>
						</tr>
					<?php else: ?>
					<?php foreach ($casoreasignado as $index => $reasignacion): ?>
						<tr>
							<td><?php echo $reasignacion->id_caso ?></td>
							<td><?php echo $ejecutivos[$reasignacion->id_ejecutivo_origen-1]->primer_nombre.' '.$ejecutivos[$reasignacion->id_ejecutivo_origen-1]->apellido_paterno?></td>
							<td><?php echo $ejecutivos[$reasignacion->id_ejecutivo_destino-1]->primer_nombre.' '.$ejecutivos[$reasignacion->id_ejecutivo_destino-1]->apellido_paterno?></td>
							<td><?php echo fecha_corta($reasignacion->fecha) ?></td>
							<td><?php echo $reasignacion->motivo ?></td>
						</tr>
					<?php endforeach ?>
					<?php endif ?>
				</tbody>
			</table>
			</div>
		</div>
	<!-- </div> -->
</div>
<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal">Cerrar</button>
</div>