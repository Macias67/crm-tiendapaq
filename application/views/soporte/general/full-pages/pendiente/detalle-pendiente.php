<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title"><b>Detalles del pendiente: </b></h4>
</div>
<div class="modal-body">
	<div class="scroller">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12">
					<input type="hidden" id="id_pendiente" value="<?php echo $pendiente->id_pendiente ?>">
					<div class="col-md-4 text-right"><b>Razón Social: </b></div>
					<div class="col-md-8"><p><a href="<?php echo site_url('cliente/gestionar/editar'.'/'.$pendiente->id_cliente) ?>" target="_blank"><?php echo $pendiente->razon_social ?></a></p></div>
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
					<div class="col-md-4 text-right"><b>Creación: </b></div>
					<div class="col-md-8"><p><?php echo fecha_completa($pendiente->fecha_origen) ?></p></div>
				</div>
				<?php if($pendiente->id_estatus_general == 2): // Cerrado?>
					<div class="col-md-12">
						<div class="col-md-4 text-right"><b>Finalización: </b></div>
						<div class="col-md-8"><p><?php echo fecha_completa($pendiente->fecha_finaliza) ?></p></div>
					</div>
				<?php endif ?>
				<div class="col-md-12">
					<div class="col-md-4 text-right"><b>Creado por: </b></div>
					<div class="col-md-8"><p><a href="<?php echo site_url('ejecutivo/catalogo'.'/'.$pendiente->id_creador) ?>" target="_blank"><?php echo $pendiente->creador_nombre.' '.$pendiente->creador_apellido ?></a></p></div>
				</div>
				<!-- HISTORIAL DE REASIGNACIONES -->
				<?php if(!empty($reasignaciones)): ?>
					<div class="col-md-12" style="margin-bottom: 1em;">
						<div class="col-md-4 text-right"><b>Reasignaciones: </b></div>
						<div class="col-md-8">
							<a class="btn btn-circle blue btn-xs" href="<?php echo site_url('/pendiente/reasignaciones/'.$pendiente->id_pendiente) ?>" data-target="#ajax-reasignacion-pendiente" data-toggle="modal">Ver historial de reasignaciones</a>
						</div>
					</div>
				<?php endif ?>
				<div class="col-md-12">
					<div class="col-md-4 text-right"><b>Oficina origen: </b></div>
					<div class="col-md-8"><p><?php echo $pendiente->oficina ?></p></div>
				</div>
				<!-- ESTATUS -->
				<?php if($usuario_activo['id']==$pendiente->id_ejecutivo): ?>
					<!-- 3=pendiente, 7=reasignado 5=en proceso -->
					<div class="col-md-12" id="div_estatus">
						<div class="col-md-4 text-right"><b>Estatus: </b></div>
						<div class="col-md-8">
							<?php if($pendiente->id_estatus_general == 3 || $pendiente->id_estatus_general == 7 || $pendiente->id_estatus_general == 5): ?>
								<select id="estatus_pendiente" class="form-control">
									<?php if($pendiente->id_estatus_general!=5): ?>
										<option value="<?php echo $estatus[2]->id_estatus ?>" <?php echo ($pendiente->id_estatus_general==2)? "selected":"" ?>><?php echo $estatus[2]->descripcion ?></option>
									<?php endif ?>
									<option value="<?php echo $estatus[4]->id_estatus ?>" <?php echo ($pendiente->id_estatus_general==4)? "selected":"" ?>><?php echo $estatus[4]->descripcion ?></option>
									<option value="<?php echo $estatus[1]->id_estatus ?>"><?php echo $estatus[1]->descripcion ?></option>
									<option value="<?php echo $estatus[0]->id_estatus ?>"><?php echo $estatus[0]->descripcion ?></option>
								</select>
							<?php else: ?>
								<span class="label label-sm label-danger"><b><?php echo strtoupper($estatus[($pendiente->id_estatus_general)-1]->descripcion) ?></b></span>
							<?php endif ?>
						</div>
					</div>
					<!-- EJECUTIVOS PARA REASIGNAR PENDIENTE -->
					<?php if($pendiente->id_estatus_general == 3 || $pendiente->id_estatus_general == 7): ?>
						<div class="col-md-12" style="margin-top: 1em;">
							<div class="col-md-4 text-right"><b>Reasignar a: </b></div>
							<div class="col-md-8">
								<select id="ejecutivo_destino" class="form-control">
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
					<!-- MOTIVO DE REASIGNACION -->
					<div class="col-md-12 display-hide" style="margin-top: 1em;" id="div_motivo">
						<div class="col-md-4 text-right"><b>Motivo: </b></div>
						<div class="col-md-8">
							<textarea name="motivo" id="motivo" class="form-control" placeholder="¿Porque vas a reasignarlo?"></textarea>
						</div>
					</div>
				<?php endif ?>
				<?php if($usuario_activo['id']!=$pendiente->id_ejecutivo): ?>
					<div class="col-md-12">
						<div class="col-md-4 text-right"><b>Estatus: </b></div>
						<div class="col-md-8">
							<p><span class="label label-sm label-success"><b><?php echo strtoupper($estatus[($pendiente->id_estatus_general)-1]->descripcion) ?></b></span></p>
						</div>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer">
	<?php if($usuario_activo['id']==$pendiente->id_ejecutivo): ?>
		<button type="button" class="btn green btn-circle update">Aceptar</button>
		<button type="button" class="btn default btn-circle" data-dismiss="modal">Cerrar</button>
		<?php if($pendiente->id_estatus_general == 3 || $pendiente->id_estatus_general == 5 || $pendiente->id_estatus_general == 7): ?>
			<?php echo (isset($url_cotiza)) ? $url_cotiza : '' ?>
		<?php endif ?>
	<?php endif ?>
	<?php if($usuario_activo['id']!=$pendiente->id_ejecutivo): ?>
		<button type="button" class="btn default btn-circle" data-dismiss="modal">Cerrar</button>
	<?php endif ?>
</div>