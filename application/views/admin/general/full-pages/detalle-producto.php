<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title"><b>Producto: </b></h4>
	<h4><?php echo $producto->descripcion ?></h4>
</div>
<form class="form-horizontal" role="form" action="<?php echo site_url('producto/gestor/editar') ?>">
	<div class="modal-body">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 control-label">Código: </label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="codigo" placeholder="Código" value="<?php echo $producto->codigo ?>">
						<input type="hidden" id="codigo_old" value="<?php echo $producto->codigo ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Descripción: </label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="descripcion" placeholder="Descripcion" value="<?php echo $producto->descripcion ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Unidad</label>
					<div class="col-md-9">
						<select class="form-control" id="unidad">
							<option value="<?php echo $producto->unidad ?>" selected><?php echo $producto->unidad ?></option>
							<option value="Metro">Metro</option>
							<option value="Kilos">Kilos</option>
							<option value="Litros">Litros</option>
							<option value="Unidad">Unidad</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Precio: </label>
					<div class="col-md-9">
						<div class="input-inline input-medium">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-usd"></i></span>
								<input type="text" id="precio" class="form-control" value="<?php echo $producto->precio ?>">
							</div>
						</div>
						<span class="help-inline">99 ó 99.99 </span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Impuesto 1: </label>
					<div class="col-md-9">
						<div class="input-inline input-medium">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-usd"></i></span>
								<input type="text" id="impuesto1" class="form-control" value="<?php echo $producto->impuesto1 ?>">
							</div>
						</div>
						<span class="help-inline">99 ó 99.99 </span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Impuesto 2: </label>
					<div class="col-md-9">
						<div class="input-inline input-medium">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-usd"></i></span>
								<input type="text" id="impuesto2" class="form-control" value="<?php echo $producto->impuesto2 ?>">
							</div>
						</div>
						<span class="help-inline">99 ó 99.99 </span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Retencion 1: </label>
					<div class="col-md-9">
						<div class="input-inline input-medium">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-usd"></i></span>
								<input type="text" id="retencion1" class="form-control" value="<?php echo $producto->retencion1 ?>">
							</div>
						</div>
						<span class="help-inline">99 ó 99.99 </span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Retencion 2: </label>
					<div class="col-md-9">
						<div class="input-inline input-medium">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-usd"></i></span>
								<input type="text" id="retencion2" class="form-control" value="<?php echo $producto->retencion2 ?>">
							</div>
						</div>
						<span class="help-inline">99 ó 99.99 </span>
					</div>
				</div>
			</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn green update">Guardar</button>
		<button type="button" class="btn default" data-dismiss="modal">Cerrar</button>
	</div>
</form>