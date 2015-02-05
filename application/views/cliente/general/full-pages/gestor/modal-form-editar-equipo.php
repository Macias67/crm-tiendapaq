<div class="modal-header">
	<h3 class="modal-title"><b>Equipo</b></h3>
	<small> </small>
</div>
<form id ="form-equipo" method="post" accept-charset="utf-8">
	<div class="modal-body form-horizontal">
		<div class="col-md-12">
			<!-- DIV ERROR -->
			<div class="alert alert-danger  display-hide">
				<button class="close" data-close="alert"></button>
				Tienes errores en tu formulario
			</div>
			<!-- BEGIN FORM BODY -->
			<div class="form-body">
				<div class="col-md-6">
					<!-- Nombre del equipo -->
					<div class="form-group">
						<label class="col-md-4 control-label">Nombre del Equipo</label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-desktop"></i>
								<input type="hidden" class="form-control" name="id" value="<?php echo $equipo->id ?>">
								<input type="hidden" class="form-control" name="id_cliente" value="<?php echo $equipo->id_cliente ?>">
								<input type="text" class="form-control" placeholder="Nombre del Equipo" name="nombre_equipo"  value="<?php echo $equipo->nombre_equipo ?>">
							</div>
						</div>
					</div>
					<!-- Sistema Operativo -->
					<div class="form-group">
						<label class="col-md-4 control-label">
							Sistema Operativo
						</label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-windows"></i>
								<?php echo $select_SO ?>
							</div>
						</div>
					</div>
					<!-- Arquitectura -->
					<div class="form-group">
						<label class="col-md-4 control-label">
							Arquitectura
						</label>
						<div class="col-md-8">
							<div class="radio-list">
								<label class="radio-inline">
									<?php echo $radio64 ?> x64 (64 bits)
								</label>
								<label class="radio-inline">
									<?php echo $radio86 ?> x86 (32 bits)
								</label>
							</div>
						</div>
					</div>
					<!-- Maquina Virtual -->
					<div class="form-group">
						<label class="col-md-4 control-label">
							Máquina Virtual
						</label>
						<div class="col-md-8">
							<div class="radio-list">
								<label class="radio-inline">
									<?php echo $radioSi ?> Sí
								</label>
								<label class="radio-inline">
									<?php echo $radioNo ?> No
								</label>
							</div>
						</div>
					</div>
					<!-- Memoria RAM -->
					<div class="form-group">
						<label class="col-md-4 control-label">
							Memoria RAM (GB)
						</label>
						<div class="col-md-8">
							<div id="memoria-ram-ajax">
								<div class="input-group input-small">
									<input type="text" class="spinner-input form-control" maxlength="2" name="memoria_ram" value="<?php echo $equipo->memoria_ram ?>">
									<div class="spinner-buttons input-group-btn btn-group-vertical">
										<button type="button" class="btn spinner-up btn-xs">
											<i class="fa fa-angle-up"></i>
										</button>
										<button type="button" class="btn spinner-down btn-xs">
											<i class="fa fa-angle-down"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<!-- SQL Server -->
					<div class="form-group">
						<label class="col-md-4 control-label">
							SQL Server
						</label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-database"></i>
								<?php echo $select_SQL ?>
							</div>
						</div>
					</div>
					<!-- SQL server management -->
					<div class="form-group">
						<label class="col-md-4 control-label">
							SQL Server Management
						</label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-database"></i>
								<?php echo $select_mgm ?>
							</div>
						</div>
					</div>
					<!-- Observaciones Generales -->
					<div class="form-group">
						<label class="col-md-4 control-label">Observaciones</label>
						<div class="col-md-8">
							<div class="input-icon">
								<i class="fa fa-eye"></i>
								<textarea name="observaciones" class="form-control" placeholder="Observaciones del equipo" class="form-control"><?php echo $equipo->observaciones ?></textarea>
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
		<button type="button" data-dismiss="modal" class="btn btn-circle btn-default">Cancelar</button>
		<button type="submit" id="btn_guardar_equipo" class="btn btn-circle green">Guardar</button>
	</div>
</form>