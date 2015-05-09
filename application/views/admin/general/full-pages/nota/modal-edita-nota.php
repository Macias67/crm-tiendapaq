<form enctype="multipart/form-data"  id="edita_nota" role="form">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Edita nota:</h4>
	</div>
	<div class="modal-body">
		<!-- <div class="scroller"> -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-body">
						<div class="form-group">
							<input type="hidden" name="edita_id_tarea" value="<?php echo $nota->id_tarea ?>">
							<input type="hidden" name="edita_id_nota" value="<?php echo $nota->id_nota ?>">
							<input
								type="checkbox"
								name="edita_privacidad"
								<?php echo $nota->privacidad ?>
								class="make-switch"
								data-size="small"
								data-on-text="&nbsp;Privada&nbsp;"
								data-off-text="&nbsp;Pública&nbsp;"
								data-on-color="success"
								data-off-color="danger"
							>
						</div>
						<div class="form-group">
							<label>Nota</label>
							<textarea class="form-control" name="edita_nota" rows="2" required><?php echo $nota->nota ?></textarea>
						</div>
						<div class="form-group">
							<?php if (isset($imagen)): ?>
								<div class="col-md-2">
									<input type="hidden" name="url-imagen" value="<?php echo $imagen ?>">
									<button type="button" class="btn btn-circle btn-danger btn-sm borrar">Borrar foto</button>
								</div>
							<?php endif ?>
							<div class="col-md-9">
								<input type="file" name="edita_archivo" id="archivo">
								<p class="help-block"> Ligar archivo. (En caso de ya tener foto se sobrescribirá)</p>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		<!-- </div> -->
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn blue" >Guardar</button>
		<button type="button" class="btn default" data-dismiss="modal">Cancelar</button>
	</div>
</form>