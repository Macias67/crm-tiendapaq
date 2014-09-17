
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN STYLE CUSTOMIZER -->
				<div class="theme-panel hidden-xs hidden-sm">
					<div class="toggler">
					</div>
					<div class="toggler-close">
					</div>
					<div class="theme-options">
						<div class="theme-option theme-colors clearfix">
							<span>
							COLOR </span>
							<ul>
								<li class="color-default current tooltips" data-style="default" data-original-title="Default">
								</li>
								<li class="color-darkblue tooltips" data-style="darkblue" data-original-title="Dark Blue">
								</li>
								<li class="color-blue tooltips" data-style="blue" data-original-title="Blue">
								</li>
								<li class="color-grey tooltips" data-style="grey" data-original-title="Grey">
								</li>
								<li class="color-light tooltips" data-style="light" data-original-title="Light">
								</li>
								<li class="color-light2 tooltips" data-style="light2" data-html="true" data-original-title="Light 2">
								</li>
							</ul>
						</div>
						<div class="theme-option">
							<span>
							Layout </span>
							<select class="layout-option form-control input-small">
								<option value="fluid" selected="selected">Fluid</option>
								<option value="boxed">Boxed</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Header </span>
							<select class="page-header-option form-control input-small">
								<option value="fixed" selected="selected">Fixed</option>
								<option value="default">Default</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Sidebar </span>
							<select class="sidebar-option form-control input-small">
								<option value="fixed">Fixed</option>
								<option value="default" selected="selected">Default</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Sidebar Position </span>
							<select class="sidebar-pos-option form-control input-small">
								<option value="left" selected="selected">Left</option>
								<option value="right">Right</option>
							</select>
						</div>
						<div class="theme-option">
							<span>
							Footer </span>
							<select class="page-footer-option form-control input-small">
								<option value="fixed">Fixed</option>
								<option value="default" selected="selected">Default</option>
							</select>
						</div>
					</div>
				</div>
				<!-- END STYLE CUSTOMIZER -->

				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title"> Equipos de Cómputo - <small><?php echo $usuario_activo['razon_social'] ?></small></h3>
						<ul class="page-breadcrumb breadcrumb">
							<li class="btn-group">
								<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
								<span>Actions</span><i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">
									<li>
										<a href="#">Action</a>
									</li>
									<li>
										<a href="#">Another action</a>
									</li>
									<li>
										<a href="#">Something else here</a>
									</li>
									<li class="divider">
									</li>
									<li>
										<a href="#">Separated link</a>
									</li>
								</ul>
							</li>
							<li>
								<i class="fa fa-home"></i>
								<a href="<?php echo site_url() ?>">Inicio</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Actualizar Información</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Equipos de Computo</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN TABLA EQUIPOS -->
						<div class="portlet box grey">
							<div class="portlet-title">
								<div class="caption" style="color: black">
									<i class="fa fa-desktop"></i> Equipos registrados
								</div>
								<div class="tools" style="color: black">
									<a href="javascript:;" class="collapse">
									</a>
									<a href="javascript:;" class="reload">
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-hover table-bordered" id="tabla_equipos_cliente">
									<thead>
										<tr>
											<th>Nombre</th>
											<th>Sistema O.</th>
											<th>Bits</th>
											<th>M. Virtual</th>
											<th>RAM</th>
											<th>SQL Server</th>
											<th>SQL Management</th>
											<th>Instancia SQL</th>
											<th>Contaseña SQL</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($equipos_computo as $equipo) : ?>
											<tr id="<?php echo $equipo->id ?>">
												<td><?php echo $equipo->nombre_equipo ?></td>
												<td><?php echo $equipo->sistema_operativo ?></td>
												<td><?php echo $equipo->arquitectura ?></td>
												<td><?php echo $equipo->maquina_virtual ?></td>
												<td><?php echo $equipo->memoria_ram ?></td>
												<td><?php echo $equipo->sql_server ?></td>
												<td><?php echo $equipo->sql_management ?></td>
												<td><?php echo $equipo->instancia_sql ?></td>
												<td><?php echo $equipo->password_sql ?></td>
												<td><a class="delete" href="javascript:;">Eliminar </a></td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
								<br>
								<div class="table-toolbar">
									<div class="btn-group pull-right">
										<a href="#" class="btn green btn-xs" data-target="#nuevo-equipo" data-toggle="modal"><i class="fa fa-plus"></i> Nueva Equipo </a>
									</div>
								</div>
							</div>
						</div>
						<!-- END TABLA EQUIPOS -->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->

<!-- BEGIN VENTANAS MODALES -->
	<!-- BEGIN NUEVO SISTEMA -->
		<div id="nuevo-equipo" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
			<div class="modal-header">
				<h3 class="modal-title">
					<b>Registrar un equipo de cómputo</b>
				</h3>
				<small> <?php echo $usuario_activo['razon_social'] ?></small>
			</div>
				<div class="modal-body container">
					<form id ="form-nuevo-equipo" class="form-horizontal" method="post" accept-charset="utf-8">
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

							<div class="col-md-6">
								<!-- Nombre del equipo -->
								<div class="form-group">
									<label class="col-md-4 control-label">Nombre del Equipo</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa fa-desktop"></i>
											<input type="text" class="form-control" placeholder="Nombre del Equipo" name="nombre_equipo">
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
											<select class="form-control" name="sistema_operativo">
												<option value=""></option>
												<?php foreach ($sistemas_operativos as $operativo): ?>
													<option value="Windows XP"><?php echo $operativo->sistema_operativo ?></option>
												<?php endforeach ?>
											</select>
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
												<input type="radio" name="arquitectura" id="arquitectura1" value="x64">
												x64 (64 bits)
											</label>
											<label class="radio-inline">
												<input type="radio" name="arquitectura" id="arquitectura2" value="x86">
												x86 (32 bits)
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
												<input type="radio" name="maquina_virtual" id="maquina_virtual1" value="Si">
												Sí
											</label>
											<label class="radio-inline">
												<input type="radio" name="maquina_virtual" id="maquina_virtual2" value="No">
												No
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
										<div id="memoria-ram">
											<div class="input-group input-small">
												<input type="text" class="spinner-input form-control" maxlength="2" name="memoria_ram">
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
											<select class="form-control" name="sql_server">
												<option value=""></option>
												<option value="SQL Server 2005">SQL Server 2005</option>
												<option value="SQL Server 2008">SQL Server 2008</option>
												<option value="SQL Server 2008 R2">SQL Server 2008 R2</option>
												<option value="SQL Server 2012">SQL Server 2012</option>
												<option value="SQL Server 2014">SQL Server 2014</option>
											</select>
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
											<select class="form-control" name="sql_management">
												<option value=""></option>
												<option value="2005">2005</option>
												<option value="2008">2008</option>
												<option value="2008 R2">2008 R2</option>
												<option value="2012">2012</option>
												<option value="2014">2014</option>
											</select>
										</div>
									</div>
								</div>
								<!-- Instalcia SQL -->
								<div class="form-group">
									<label class="col-md-4 control-label">Instancia SQL</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa  fa-database"></i>
											<input type="text" class="form-control" placeholder="Instancia SQL" name="instancia_sql">
										</div>
									</div>
								</div>
								<!-- Contraseña SQL -->
								<div class="form-group">
									<label class="col-md-4 control-label">Contraseña SQL</label>
									<div class="col-md-8">
										<div class="input-icon">
											<i class="fa  fa-database"></i>
											<input type="text" class="form-control" placeholder="Contraseña SQL" name="password_sql">
										</div>
									</div>
								</div>
							</div>

						</div>
						<!-- END FORM BODY -->
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
					<button type="button" id="btn_guardar_equipo" class="btn green">Guardar</button>
				</div>
		</div>
	<!-- END NUEVO SISTEMA -->
<!-- END VENTANAS MODALES -->