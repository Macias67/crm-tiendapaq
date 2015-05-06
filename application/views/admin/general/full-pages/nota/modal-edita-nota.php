<form enctype="multipart/form-data"  id="nueva_nota" role="form">
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
							<input
								type="checkbox"
								name="privacidad"
								checked class="make-switch"
								data-size="small"
								data-on-text="&nbsp;Privada&nbsp;"
								data-off-text="&nbsp;Pública&nbsp;"
								data-on-color="success"
								data-off-color="danger"
							>
						</div>
						<div class="form-group">
							<label>Nota</label>
							<textarea class="form-control" name="nota" rows="2" required></textarea>
						</div>
						<div class="form-group">
							<div class="col-md-9">
								<input type="file" name="archivo" id="archivo">
								<p class="help-block"> Ligar archivo.</p>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		<!-- </div> -->
	</div>
	<div class="modal-footer">
		<button type="button" class="btn blue">Guardar</button>
		<button type="button" class="btn default" data-dismiss="modal">Cancelar</button>
	</div>
</form>