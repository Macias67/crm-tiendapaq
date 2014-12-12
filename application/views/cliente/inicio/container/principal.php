<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title"> Bienvenido a CRM TiendaPAQ - <small><?php echo $usuario_activo['razon_social'] ?></small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<!-- BEGIN PEDIDOS CLIENTE PEDIENTES PORTLET-->
				<div class="portlet gren">
					<div class="portlet-title">
						<div class="caption"><i class="fa fa-user"></i> Cotizaciones Pendientes</div>
						<div class="tools">
							<a href="javascript:;" class="collapse">
							</a>
							<a href="javascript:;" class="reload">
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="sample_2">
							<thead>
								<tr>
									<th>Folio</th>
									<th>Fecha de emisión</th>
									<th>Vigencia hasta</th>
									<th>Oficina</th>
									<th>Estatus</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($cotizaciones as $cotizacion): ?>
								<tr>
									<td><?php echo $cotizacion->folio ?></td>
									<td><?php echo fecha_formato($cotizacion->fecha) ?></td>
									<td><?php echo fecha_formato($cotizacion->vigencia) ?></td>
									<td><?php echo $cotizacion->ciudad_estado ?></td>
									<?php switch ($cotizacion->id_estatus) {
										// por pagar
										case 1:
											echo '<td><span class="btn btn-circle btn-xs green">'.ucfirst($cotizacion->descripcion).'</span></td>
														<td>
															<button type="button" class="btn green default cotizacion-previa btn-circle btn-xs" id="'.$cotizacion->folio.'"><i class="fa fa-file-o"></i> Vista Previa</button>
															<a class="btn red default btn-circle btn-xs" href="'.site_url("cotizacion/descarga/".$cotizacion->folio).'"><i class="fa fa-file-o"></i> Descargar</a>
															<a href="#verificar-info" class="btn blue btn-circle btn-xs" data-toggle="modal"><i class="fa fa-dollar"></i> Comprobar Pago</a>
														</td>';
										break;
										// en revision
										case 2:
											echo '<td><span class="btn btn-xs yellow">'.ucfirst($cotizacion->descripcion).'</span></td>
														<td>
															<a href="'.site_url("cotizacion/comprobante/".$cotizacion->folio).'" class="btn blue btn-circle btn-xs"> Ver de Pago</a>
														</td>';
										break;
										//carrecta
										case 3:
											echo '<td><span class="btn btn-circle btn-xs green">'.ucfirst($cotizacion->descripcion).'</span></td>
														<td>
															<a href="'.site_url("cotizacion/comprobante/".$cotizacion->folio).'" class="btn blue btn-circle btn-xs"> Ver de Pago</a>
														</td>';
										break;
										//irregular
										case 4:
											echo '<td><span class="btn btn-circle btn-xs red">'.ucfirst($cotizacion->descripcion).'</span></td>
														<td>
															<a href="'.site_url("cotizacion/comprobante/".$cotizacion->folio).'" class="btn blue btn-circle btn-xs"><i class="fa fa-dollar"></i> Cambiar Comprobante</a>
														</td>';
										break;
										//vencida
										case 5:
											echo '<td><span class="btn btn-circle btn-xs red">'.ucfirst($cotizacion->descripcion).'</span></td>
														<td>
														</td>';
										break;
										//pago parcial
										case 6:
											echo '<td><span class="btn btn-circle btn-xs yellow">'.ucfirst($cotizacion->descripcion).'</span></td>
														<td>
															<a href="'.site_url("cotizacion/comprobante/".$cotizacion->folio).'" class="btn blue btn-circle btn-xs"><i class="fa fa-dollar"></i> Comprobar Pago</a>
														</td>';
										break;

										default:
											# code...
										break;
									} ?>
								</tr>
							<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- END PEDIDOS CLIENTE PEDIENTES PORTLET-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->

<!-- BEGIN FORM NUEVO CLIENTE PROSPECTO-->
<div id="verificar-info" class="modal bs-modal-lg fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">
					<b>Verificar Datos - <small><a href="#">¿Por qué esto?</a></small>
				</h3>
			</div>
			<form action="#" id ="form-verificar-datos" method="post" accept-charset="utf-8">
				<div class="modal-body form-horizontal">
					<div class="scroller" style="height: 350px" id="div-scroll-verificar-datos">
						<!-- DIV ERROR -->
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							Tienes Errores en tu formulario
						</div>
						<!-- DIV SUCCESS -->
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Exito en el formulario
						</div>
						<!-- BEGIN FORM BODY -->
						<div class="form-body">
							<!-- INFORMACION BASICA -->
							<div class="col-md-6">
								<h4>Información Básica</h4>
								<!-- Razon Social -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Razón Social<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-asterisk"></i>
											<input type="text" class="form-control" placeholder="Razón Social" name="razon_social" value="<?php echo $usuario_activo['razon_social'] ?>">
										</div>
									</div>
								</div>
								<!-- Rfc -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										R.F.C.<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-barcode"></i>
											<input type="text" class="form-control" placeholder="R.F.C." name="rfc" value="<?php echo $usuario_activo['rfc'] ?>">
										</div>
									</div>
								</div>
								<!-- Email -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Email<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa  fa-envelope"></i>
											<input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $usuario_activo['email'] ?>">
										</div>
									</div>
								</div>
								<!-- TELEFONOS -->
								<!-- Telefono 1 -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Teléfono 1 <span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-phone"></i>
											<input type="text" class="form-control" id="telefono1" placeholder="(999) 999-9999" name="telefono1" value="<?php echo $usuario_activo['telefono1'] ?>">
										</div>
									</div>
								</div>
								<br>
								<br>
								<ul>
									<li>Puedes editar mas información en la seccion de gestión</li>
								</ul>
							</div>
							<!-- INFORMACION DE CONTACTO -->
							<div class="col-md-6">
								<h4>Domicilio</h4>
								<!-- Calle -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Calle<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" placeholder="Calle" name="calle" value="<?php echo $usuario_activo['calle'] ?>">
										</div>
									</div>
								</div>
								<!-- No Exterior -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										No. Exterior<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" placeholder="No. Exterior" name="no_exterior" value="<?php echo $usuario_activo['no_exterior'] ?>">
										</div>
									</div>
								</div>
								<!-- Colonia -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Colonia<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" placeholder="Colonia" name="colonia" value="<?php echo $usuario_activo['colonia'] ?>">
										</div>
									</div>
								</div>
								<!-- Codigo Postal -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Código Postal<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" id="codigo_postal" placeholder="99999" name="codigo_postal" value="<?php echo $usuario_activo['codigo_postal'] ?>">
										</div>
									</div>
								</div>
								<!-- Ciudad -->
								<div class="form-group">
									<label class="col-md-4 control-label">
										Ciudad<span class="required" aria-required="true">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="form-control" placeholder="Ciudad" name="ciudad" value="<?php echo $usuario_activo['ciudad'] ?>">
										</div>
									</div>
								</div>
								<!-- Estado -->
								<div class="form-group" id="div_estado">
									<label class="col-md-4 control-label">Estado</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-map-marker"></i>
											<select class="form-control" name="estado" id="estado">
												<option value="<?php echo $usuario_activo['estado'] ?>"><?php echo $usuario_activo['estado'] ?></option>
												<?php foreach ($this->estados as $estado): ?>
													<?php if ($usuario_activo['estado']!=$estado): ?>
														<option value="<?php echo $estado ?>"><?php echo $estado ?></option>
													<?php endif ?>
												<?php endforeach ?>
											</select>
										</div>
									</div>
								</div>

							</div>
						</div>
						<!-- END FORM BODY -->
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-circle btn-default">Cancelar</button>
					<button type="submit" class="btn btn-circle green">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END FORM NUEVO CLIENTE PROSPECTO-->