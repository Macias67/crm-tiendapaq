
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Gestionar Ejecutivos - <small><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?></small></h3>
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
								<div class="caption font-green-sharp">
									<i class="icon-speech font-green-sharp"></i>
									<span class="caption-subject bold uppercase"> Ejecutivos</span>
									<span class="caption-helper"></span>
								</div>
								<div class="actions">
									<a href="<?php echo site_url('ejecutivo/gestionar/nuevo') ?>" class="btn btn-circle green">
									<i class="fa fa-plus"></i> Agregar </a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-hover table-bordered" id="tabla_gestionar_ejecutivos">
									<thead>
										<tr>
											<th width="1%"><i class="fa fa-asterisk"></i></th>
											<th width="1%">ID</th>
											<th width="25%">Nombre</th>
											<th width="10%">Oficina</th>
											<th width="10%">Departamento</th>
											<th width="25%">Email</th>
											<th width="10%">Teléfono</th>
											<th width="5%">Privilegio</th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($ejecutivos as $ejecutivo) : ?>
											<tr id="<?php echo $ejecutivo->id ?>">
												<td><label><input type="radio" name="optionsRadios" class="radios" id-radio="<?php echo $ejecutivo->id ?>" <?php echo($ejecutivo->asignador_casos=="si")? 'checked="checked"':""?>></label></td>
												<td><?php echo $ejecutivo->id ?></td>
												<td><?php echo $ejecutivo->primer_nombre.' '.$ejecutivo->segundo_nombre.' '.$ejecutivo->apellido_paterno.' '.$ejecutivo->apellido_materno ?></td>
												<td><?php echo $ejecutivo->oficina ?></td>
												<td><?php echo $ejecutivo->departamento ?></td>
												<td><?php echo $ejecutivo->email ?></td>
												<td><?php echo $ejecutivo->telefono ?></td>
												<td><?php echo $ejecutivo->privilegios ?></td>
												<td>
													<a class="btn btn-circle green btn-xs" href="<?php echo site_url('ejecutivo/catalogo').'/'.$ejecutivo->id?>"><i class="fa fa-search"></i> Ver Perfil</a>
													<a class="btn btn-circle blue btn-xs" href="<?php echo site_url('ejecutivo/gestionar/editar').'/'.$ejecutivo->id?>"><i class="fa fa-edit"></i> Editar</a>
												</td>
												<td><button class="delete btn btn-circle red btn-xs"><i class="fa fa-trash-o"></i> Eliminar </button></td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
							<div class="portlet-footer">
								<i class="fa fa-asterisk"></i> Encargado de asignar los casos nuevos.
							</div>
						</div>
						<!-- END TABLA CLIENTES -->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->