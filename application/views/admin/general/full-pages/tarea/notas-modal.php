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
							<th width="1%"></th>
							<th width="20%"></th>
							<th width="40%"></th>
							<th width="15%"></th>
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
							<td>
								<?php if (isset($nota->imagen)): ?>
								<a href="<?php echo $nota->imagen ?>" class="btn blue btn-xs ver fancybox"><i class="fa fa-file-image-o"></i></a>
								<?php endif ?>
								<a href="<?php echo site_url('nota/modal/editar/'.$nota->id_nota) ?>" class="btn green btn-xs editar" data-target="#ajax_edita_nota" data-toggle="modal"><i class="fa fa-edit"></i></a>
								<button class="btn red btn-xs eliminar" id="<?php echo $nota->id_nota ?>"><i class="fa fa-trash-o"></i></button>
							</td>
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