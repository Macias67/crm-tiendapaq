<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title"><b>Cotización <?php echo $folio ?></b> - <small>Selecciona el contacto para el reenvio</small></h4>
</div>
<div class="modal-body">
	<div class="scroller">
		<div class="row">
			<div class="col-md-12">
				<form id ="form-sistema-nuevo" method="post" accept-charset="utf-8">
					<div class="modal-body form-horizontal">
						<div class="col-md-12">
							<!-- BEGIN FORM BODY -->
							<div class="form-body">
								<div class="col-md-12">
									<!-- Contacto -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											Contacto
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-user"></i>
												<!-- <input type="hidden" id="id_caso" value="<?php echo $id_caso ?>"> -->
												<select class="form-control" name="contacto" id="select_contacto">
													<option value=""></option>
													<?php foreach ($contactos as $contacto): ?>
														<option value="<?php echo $contacto->email_contacto?>"><?php echo $contacto->nombre_contacto.' '.$contacto->apellido_paterno ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
									</div>
									<!-- Email -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											Email: 
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-inbox"></i>
												<input type="hidden" id="folio" value="<?php echo $folio ?>">
												<label class="form-control email_contacto" type"text" value=""></label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- END FORM BODY -->
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-circle green btn_reenviar_cotizacion">Reenviar</button>
						<button type="button" data-dismiss="modal" class="btn btn-circle btn-default">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>