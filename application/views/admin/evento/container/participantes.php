<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Participantes registrados - <small><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?></small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN TABLA CLIENTES -->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-speech"></i>
							<span class="caption-subject bold uppercase"> Participantes registrados</span>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-hover table-bordered" id="tabla-ver-participantes">
							<thead>
								<tr>
									<th width="30%">Nombre</th>
									<th width="30%">Email</th>
									<th width="40%">Teléfono</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($participantes as $participante): ?>
									<tr class="odd gradeX">
										<td><?php echo $participante->nombre_contacto.' '.$participante->apellido_paterno ?></td>
										<td><?php echo $participante->email_contacto ?></td>
										<td><?php echo $participante->telefono_contacto ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- END TABLA CLIENTES -->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->