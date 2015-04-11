<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h3 class="modal-title"><b>Notas</b></h3>
</div>
<div class="modal-body">
	<div class="scroller" style="height: 200px;">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered table-striped table-condensed flip-content">
					<thead class="flip-content">
						<tr>
							<th width="15%"> Fecha </th>
							<th width="50%"> Nota </th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($notas as $key => $nota): ?>
						<tr>
							<td><?php echo fecha_corta($nota->fecha_registro) ?></td>
							<td><?php echo $nota->nota ?></td><td><a href="" class="btn blue btn-circle btn-xs" id="<?php echo $nota->id_nota ?>"><i class="fa fa-search"></i> Editar</a></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal">Cerrar</button>
</div>