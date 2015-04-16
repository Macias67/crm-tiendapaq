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
							<th width="1%"> ID </th>
							<th width="1%">Privacidad</th>
							<th width="15%"> Fecha </th>
							<th width="50%"> Nota </th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($notas as $key => $nota): ?>
						<tr>
							<td><?php echo $nota->id_nota ?></td>
							<td>
								<?php if ($nota->privacidad == 'publica'): ?>
								<span class="label label-sm label-danger"> Pública </span>
								<?php else: ?>
								<span class="label label-sm label-success">Privada </span>
								<?php endif ?>
							</td>
							<td><?php echo fecha_corta($nota->fecha_registro) ?></td>
							<td><?php echo $nota->nota ?></td>
							<td><a href="" class="btn blue btn-circle btn-xs" id="<?php echo $nota->id_nota ?>"><i class="fa fa-search"></i> Editar</a></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal">Close</button>
</div>