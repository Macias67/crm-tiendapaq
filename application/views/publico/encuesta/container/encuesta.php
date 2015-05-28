
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Dashboard <small>statistics & reports</small></h1>
			</div>
			<!-- END PAGE TITLE -->
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row margin-top-10">
				<div class="col-md-4 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">Sales Summary</span>
								<span class="caption-helper hide">weekly stats...</span>
							</div>
						</div>
						<div class="portlet-body">
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
				<div class="col-md-8 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">Encuesta de valoración de servicio</span>
								<span class="caption-helper hide">weekly stats...</span>
							</div>
						</div>
						<div class="portlet-body form">
							<form class="form-horizontal" role="form">
								<div class="form-body">

									<!-- Pregunta 1 -->
									<div class="form-group">
										<label class="col-md-7 control-label">
											¿Usted fue atendido con amabilidad y respeto todo el tiempo?
										</label>
										<div class="col-md-5">
											<div class="radio-list">
												<label class="radio-inline">
												<input type="radio" name="pregunta1" id="p1_si" value="si" checked> Sí </label>
												<label class="radio-inline">
												<input type="radio" name="pregunta1" id="p1_no" value="no"> No </label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">¿Por qué?</label>
										<div class="col-md-9">
											<input type="text" name="p1_porque" class="form-control input-inline input-xlarge" disabled placeholder="Escriba el motivo por el cual seleccionó NO">
										</div>
									</div>

									<!-- Pregunta 2 -->
									<div class="form-group">
										<label class="col-md-7 control-label">
											¿Durante el desarrollo de su caso se le brindo información suficiente, clara y oportuna sobre los trabajos a realizar?
										</label>
										<div class="col-md-5">
											<div class="radio-list">
												<label class="radio-inline">
												<input type="radio" name="pregunta2" id="p2_si" value="si" checked> Sí </label>
												<label class="radio-inline">
												<input type="radio" name="pregunta2" id="p2_no" value="no"> No </label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">¿Por qué?</label>
										<div class="col-md-9">
											<input type="text" name="p1_porque" class="form-control input-inline input-xlarge" disabled placeholder="Escriba el motivo por el cual seleccionó NO">
										</div>
									</div>

									<!-- Pregunta 3 -->
									<div class="form-group">
										<label class="col-md-7 control-label">¿Cómo calificaría nuestro tiempo de respuesta y solución a este caso?</label>
										<div class="col-md-5">
											<select class="form-control">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
											</select>
											<span class="help-inline"> (1= Muy Lentos - 10 = Respuesta inmediata) </span>
										</div>
									</div>

									<!-- Pregunta 4 -->
									<div class="form-group">
										<label class="col-md-7 control-label">¿Cómo calificaría el conocimiento o experiencia del asesor asignado?</label>
										<div class="col-md-5">
											<select class="form-control">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
											</select>
											<span class="help-inline"> (1= Sin experiencia - 10 = Muy experto) </span>
										</div>
									</div>

									<!-- Pregunta 5 -->
									<div class="form-group">
										<label class="col-md-7 control-label">
											¿Estaría dispuesto a recomendar nuestos servicios a alguien más?
										</label>
										<div class="col-md-5">
											<div class="radio-list">
												<label class="radio-inline">
												<input type="radio" name="pregunta5" id="p5_si" value="si" checked> Sí </label>
												<label class="radio-inline">
												<input type="radio" name="pregunta5" id="p5_no" value="no"> Ahora no </label>
												<label class="radio-inline">
												<input type="radio" name="pregunta5" id="p5_nunca" value="nunca"> Nunca </label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-6 control-label">Nombre</label>
										<div class="col-md-6">
											<input type="text" name="p1_porque" class="form-control input-inline input-medium" disabled>
										</div>
										<label class="col-md-6 control-label margin-top-10">Email</label>
										<div class="col-md-6 margin-top-10">
											<input type="text" name="p1_porque" class="form-control input-inline input-medium" disabled>
										</div>
										<label class="col-md-6 control-label margin-top-10">Teléfono</label>
										<div class="col-md-6 margin-top-10">
											<input type="text" name="p1_porque" class="form-control input-inline input-medium" disabled>
										</div>
									</div>

									<!-- Pregunta 6 -->
									<div class="form-group">
										<label class="col-md-7 control-label">¿Hay algo en lo que usted considera que tenemos que mejorar?</label>
										<div class="col-md-5">
											<textarea class="form-control" rows="3"></textarea>
										</div>
									</div>

								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green">Submit</button>
											<button type="button" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
							</form>
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