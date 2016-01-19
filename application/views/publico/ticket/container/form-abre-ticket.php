
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Registro de nuevo ticket</h1>
			</div>
			<!-- END PAGE TITLE -->
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
			<!-- BEGIN PAGE BREADCRUMB -->
<!-- 			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="#">Home</a><i class="fa fa-circle"></i>
				</li>
				<li class="active">
					 Dashboard
				</li>
			</ul> -->
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row margin-top-10">
				<div class="col-md-12 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">Datos requeridos de inscripción</span><br>
								<small><b> Si ya eres un cliente registrado, escribe tu R.F.C. en el primer campo para autocompletar el formulario, de no ser así llena todos los campos para tener el registro de tus datos para futuros registros.</b></small>
							</div>
							<div class="actions">
							</div>
						</div>
						<div class="portlet-body form-horizontal">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('cursos/registro') ?>" id="form-cliente-completo" accept-charset="utf-8">
								<div class="form-body">
									<!-- ALERTS -->
									<div class="alert alert-danger display-hide">
										<button class="close" data-close="alert"></button>
										Tienes errores en el formulario
									</div>
									<div class="alert alert-success display-hide">
										<button class="close" data-close="alert"></button>
										Éxito en el formulario
									</div>
									<!-- INFORMACION BASICA -->
									<h4><strong>Información Básica</strong><small> - Información de la empresa.</small></h4>
									<!-- Rfc -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											R.F.C.<span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-barcode"></i>
												<input type="hidden" name="id_cliente">
												<input type="hidden" name="id_evento" value="<?php echo $evento->id_evento ?>">
												<input type="text" class="form-control" placeholder="R.F.C." name="rfc">
											</div>
										</div>
									</div>
									<!-- Razon Social -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											Razón Social<span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-asterisk"></i>
												<input type="text" class="form-control" placeholder="Razón Social" name="razon_social">
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
												<input type="text" class="form-control" placeholder="Email" name="email">
											</div>
										</div>
									</div>
									<!-- Tipo -->
									<div class="form-group">
										<label class="control-label col-md-4">
											Tipo<span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<select class="form-control" name="tipo">
												<option value="normal">Normal</option>
												<option value="distribuidor">Distribuidor</option>
											</select>
										</div>
									</div>

									<hr>

									<!-- INFORMACION DEL DOMICILIO -->
									<h4><strong>Domicilio</strong><small> - Domicilio fiscal</small></h4>
									<!-- Calle -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											Calle<span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-map-marker"></i>
												<input type="text" class="form-control" placeholder="Calle" name="calle">
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
												<input type="text" class="form-control" placeholder="No. Exterior" name="no_exterior">
											</div>
										</div>
									</div>
									<!-- No Interior -->
									<div class="form-group">
										<label class="col-md-4 control-label">No. Interior</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-map-marker"></i>
												<input type="text" class="form-control" placeholder="No. Interior" name="no_interior">
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
												<input type="text" class="form-control" placeholder="Colonia" name="colonia">
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
												<input type="text" class="form-control" id="codigo_postal_mask" placeholder="99999" name="codigo_postal">
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
												<input type="text" class="form-control" placeholder="Ciudad" name="ciudad">
											</div>
										</div>
									</div>
									<!-- Municipio -->
									<div class="form-group">
										<label class="col-md-4 control-label">Municipio</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-map-marker"></i>
												<input type="text" class="form-control" placeholder="Municipio" name="municipio">
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
													<?php foreach ($this->estados as $estado): ?>
														<option value="<?php echo strtoupper($estado) ?>" <?php echo ($estado=='Jalisco')? 'selected':'' ?>><?php echo $estado ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
									</div>
									<!-- Pais -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											País<span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-map-marker"></i>
												<select class="form-control" name="pais" id="pais">
													<option value="Estados Unidos">Estados Unidos</option>
													<option value="México" selected>México</option>
												</select>
											</div>
										</div>
									</div>

									<hr>

									<!-- TELEFONOS -->
									<h4><strong>Teléfonos</strong></h4>
									<!-- Telefono 1 -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											Teléfono 1<span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-phone"></i>
												<input type="text" class="form-control" id="telefono1" placeholder="(999) 999-9999" name="telefono1">
											</div>
										</div>
									</div>
									<!-- Telefono 2 -->
									<div class="form-group">
										<label class="col-md-4 control-label">Teléfono 2</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-phone"></i>
												<input type="text" class="form-control" id="telefono2" placeholder="(999) 999-9999" name="telefono2">
											</div>
										</div>
									</div>

									<hr>

									<!-- INFORMACION DE CONTACTO -->
									<h4><strong>Contácto</strong><small> - Contácto de la empresa.</small></h4>
									<!-- Pais -->
									<div class="form-group" id="contactos" style="display: none">
										<label class="col-md-4 control-label">Contactos Registrados
										</label>
										<div class="col-md-8">
											<div class="input-icon"></div>
										</div>
									</div>
									<!-- Nombre del contacto -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											Nombre(s)<span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-user"></i>
												<input type="hidden" name="id_contacto" value="">
												<input type="text" class="form-control" placeholder="Nombre" name="nombre_contacto">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">
											Apellido Paterno<span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-user"></i>
												<input type="text" class="form-control" placeholder="Apellido Paterno" name="apellido_paterno">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">
											Apellido Materno<span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-user"></i>
												<input type="text" class="form-control" placeholder="Apellido Materno" name="apellido_materno">
											</div>
										</div>
									</div>
									<!-- Email del contacto -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											Email<span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa  fa-envelope"></i>
												<input type="text" class="form-control" placeholder="Email" name="email_contacto">
											</div>
										</div>
									</div>
									<!-- Telefono del contacto -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											Teléfono<span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-phone"></i>
												<input type="text" class="form-control" id="telefono_contacto" placeholder="Teléfono" name="telefono_contacto">
											</div>
										</div>
									</div>
									<!-- Puesto del contacto -->
									<div class="form-group">
										<label class="col-md-4 control-label">Puesto</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-certificate"></i>
												<input type="text" class="form-control" placeholder="Puesto" name="puesto_contacto">
											</div>
										</div>
									</div>

									<hr>

									<!-- Mensaje -->
									<h4><strong>Mensaje</strong></h4>

									<!-- Mensaje -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											Descripción del Ticket: <span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<textarea class="form-control autosizeme" rows="4" placeholder="Autosizeme..."></textarea>
											<p class="help-block"> Escribe a detalle tu mensaje. </p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">
											Adjuntar archivo:
										</label>
										<div class="col-md-8">
											<input type="file" id="exampleInputFile1">
										</div>
									</div>

									<hr>

									<!-- ACCESO AL SISTEMA -->
									<h4><strong>Acceso al sistema</strong><small> - Si ya estás registrado escribe tu usuario y contraseña para validar el envío, si eres usuario nuevo escribe algún usuario y contraseña para acceder al sistema.</small></h4>
									<!-- Usuario -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											Usuario<span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-user"></i>
												<input type="text" class="form-control" id="usuario" placeholder="Nombre de usuario" name="usuario">
											</div>
										</div>
									</div>
									<!-- Contraseña -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											Contraseña<span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-lock"></i>
												<input type="text" class="form-control" id="password" placeholder="Contraseña" name="password">
											</div>
										</div>
									</div>
									<!-- Contraseña -->
									<div class="form-group">
										<label class="col-md-4 control-label">
											Confirma Contraseña<span class="required" aria-required="true">*</span>
										</label>
										<div class="col-md-8">
											<div class="input-icon">
												<i class="fa fa-lock"></i>
												<input type="text" class="form-control" id="conf_password" placeholder="Contraseña" name="conf_password">
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions fluid">
									<div class="row">
										<div class="col-md-12">
											<button type="submit" class="btn btn-circle green"><i class="fa fa-save"></i> Enviar</button>
											<button type="reset" class="btn btn btn-circle default"><i class="fa fa-eraser"></i> Cancelar</button>
										</div>
									</div>
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->