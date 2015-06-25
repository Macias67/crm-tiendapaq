<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title"><b>Asignar caso a ejecutivo</b></h4>
</div>
<div class="modal-body">
	<div class="scroller">
		<div class="row">
			<div class="col-md-12">
				<form id ="form-sistema-nuevo" method="post" accept-charset="utf-8">
					<div class="modal-body form-horizontal">
						<div class="col-md-12">
							<!-- DIV ERROR -->
							<div class="alert alert-danger  display-hide">
								<button class="close" data-close="alert"></button>
								Tienes errores en tu formulario
							</div>
							<!-- BEGIN FORM BODY -->
							<div class="form-body">
								<div class="col-md-12">
									<!-- Sistema -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											Ejecutivo
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-group"></i>
												<input type="hidden" id="id_caso" value="<?php echo $id_caso ?>">
												<select class="form-control" name="ejecutivos" id="select_ejecutivo">
													<?php foreach ($ejecutivos as $ejecutivo): ?>
														<option value="<?php echo $ejecutivo->id?>"><?php echo $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno ?></option>
													<?php endforeach ?>
												</select>
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
						<button type="button" class="btn btn-circle green btn_asignar_caso">Asignar</button>
						<button type="button" data-dismiss="modal" class="btn btn-circle btn-default">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>