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
							Elige un color </span>
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
						<h3 class="page-title">
						Bienvenido - <small>blank page</small>
						</h3>
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
								<a href="#">Mis Pendientes</a>
							</li>
							<li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN TABLE MANAGED PENDIENTES -->
						<div class="portlet box grey-cascade">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-file-text-o"></i>Mis Pendientes
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse">
									</a>
									<a href="javascript:;" class="reload">
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="table-toolbar">
									<div class="btn-group">
										<button id="cado-admin" class="btn red">
											<i class="fa fa-mail-forward"></i> Abrir Caso
										</button>
									</div>
									<div class="btn-group pull-right">
										<button class="btn dropdown-toggle" data-toggle="dropdown">Herramientas <i class="fa fa-angle-down"></i>
										</button>
										<ul class="dropdown-menu pull-right">
											<li>
												<a href="#">
												Imprimir </a>
											</li>
											<li>
												<a href="#">
												Guardar como PDF </a>
											</li>
											<li>
												<a href="#">
												Exportar a Excel </a>
											</li>
										</ul>
									</div>
								</div>
								<table class="table table-striped table-bordered table-hover" id="pendientes-admin">
									<thead>
										<tr>
											<th class="table-checkbox">
												<input type="checkbox" class="group-checkable" data-set="#pendientes-admin .checkboxes"/>
											</th>
											<th> R.F.C</th>
											<th> Razón Social</th>
											<th> Cita</th>
											<th> Estado</th>
											<th> Opciones</th>
										</tr>
									</thead>
									<tbody>
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="1"/></td>
											<td> LDJO726MM12K</td>
											<td><a href="#"> Joaquin Lopez Doriga</a></td>
											<td> 12 Julio 2014</td>
											<td><span class="label label-sm label-success">	Abierto </span></td>
											<td>
												<a href="#" class="btn btn-xs blue"><i class ="fa fa-search"></i> Detalles</a>
												<a href="#" class="btn btn-xs yellow"><i class ="fa fa-pencil"></i> Editar</a>
												<a href="#" class="btn btn-xs red"><i class ="fa fa-minus-circle"></i> Eliminar</a>
											</td>
										</tr>
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="1"/></td>
											<td> MALA728JSH02</td>
											<td><a href="#"> Luis Alberto Macias Angulo</a></td>
											<td> 30 Mayo 2014</td>
											<td><span class="label label-sm label-warning">	Suspendido </span></td>
											<td>
												<a href="#" class="btn btn-xs blue"><i class ="fa fa-search"></i> Detalles</a>
												<a href="#" class="btn btn-xs yellow"><i class ="fa fa-pencil"></i> Editar</a>
												<a href="#" class="btn btn-xs red"><i class ="fa fa-minus-circle"></i> Eliminar</a>
											</td>
										</tr>
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="1"/></td>
											<td> VALR8383JDJ83</td>
											<td><a href="#"> Rancho Vistalegre SA de CV</a></td>
											<td> 15 Abril 2014</td>
											<td><span class="label label-sm label-default"> Bloqueado </span></td>
											<td>
												<a href="#" class="btn btn-xs blue"><i class ="fa fa-search"></i> Detalles</a>
												<a href="#" class="btn btn-xs yellow"><i class ="fa fa-pencil"></i> Editar</a>
												<a href="#" class="btn btn-xs red"><i class ="fa fa-minus-circle"></i> Eliminar</a>
											</td>
										</tr>
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="1"/></td>
											<td> ROCD921002HJ</td>
											<td><a href="#"> Diego I. Rodriguez Cuevas</a></td>
											<td> 28 Febrero 2014</td>
											<td><span class="label label-sm label-danger">	Atrazado </span></td>
											<td>
												<a href="#" class="btn btn-xs blue"><i class ="fa fa-search"></i> Detalles</a>
												<a href="#" class="btn btn-xs yellow"><i class ="fa fa-pencil"></i> Editar</a>
												<a href="#" class="btn btn-xs red"><i class ="fa fa-minus-circle"></i> Eliminar</a>
											</td>
										</tr>
										
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="1"/></td>
											<td> LDJO726MM12K</td>
											<td><a href="#"> Joaquin Lopez Doriga</a></td>
											<td> 12 Julio 2014</td>
											<td><span class="label label-sm label-success">	Abierto </span></td>
											<td>
												<a href="#" class="btn btn-xs blue"><i class ="fa fa-search"></i> Detalles</a>
												<a href="#" class="btn btn-xs yellow"><i class ="fa fa-pencil"></i> Editar</a>
												<a href="#" class="btn btn-xs red"><i class ="fa fa-minus-circle"></i> Eliminar</a>
											</td>
										</tr>
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="1"/></td>
											<td> MALA728JSH02</td>
											<td><a href="#"> Luis Alberto Macias Angulo</a></td>
											<td> 30 Mayo 2014</td>
											<td><span class="label label-sm label-warning">	Suspendido </span></td>
											<td>
												<a href="#" class="btn btn-xs blue"><i class ="fa fa-search"></i> Detalles</a>
												<a href="#" class="btn btn-xs yellow"><i class ="fa fa-pencil"></i> Editar</a>
												<a href="#" class="btn btn-xs red"><i class ="fa fa-minus-circle"></i> Eliminar</a>
											</td>
										</tr>
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="1"/></td>
											<td> VALR8383JDJ83</td>
											<td><a href="#"> Rancho Vistalegre SA de CV</a></td>
											<td> 15 Abril 2014</td>
											<td><span class="label label-sm label-default"> Bloqueado </span></td>
											<td>
												<a href="#" class="btn btn-xs blue"><i class ="fa fa-search"></i> Detalles</a>
												<a href="#" class="btn btn-xs yellow"><i class ="fa fa-pencil"></i> Editar</a>
												<a href="#" class="btn btn-xs red"><i class ="fa fa-minus-circle"></i> Eliminar</a>
											</td>
										</tr>
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="1"/></td>
											<td> ROCD921002HJ</td>
											<td><a href="#"> Diego I. Rodriguez Cuevas</a></td>
											<td> 28 Febrero 2014</td>
											<td><span class="label label-sm label-danger">	Atrazado </span></td>
											<td>
												<a href="#" class="btn btn-xs blue"><i class ="fa fa-search"></i> Detalles</a>
												<a href="#" class="btn btn-xs yellow"><i class ="fa fa-pencil"></i> Editar</a>
												<a href="#" class="btn btn-xs red"><i class ="fa fa-minus-circle"></i> Eliminar</a>
											</td>
										</tr>

										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="1"/></td>
											<td> LDJO726MM12K</td>
											<td><a href="#"> Joaquin Lopez Doriga</a></td>
											<td> 12 Julio 2014</td>
											<td><span class="label label-sm label-success">	Abierto </span></td>
											<td>
												<a href="#" class="btn btn-xs blue"><i class ="fa fa-search"></i> Detalles</a>
												<a href="#" class="btn btn-xs yellow"><i class ="fa fa-pencil"></i> Editar</a>
												<a href="#" class="btn btn-xs red"><i class ="fa fa-minus-circle"></i> Eliminar</a>
											</td>
										</tr>
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="1"/></td>
											<td> MALA728JSH02</td>
											<td><a href="#"> Luis Alberto Macias Angulo</a></td>
											<td> 30 Mayo 2014</td>
											<td><span class="label label-sm label-warning">	Suspendido </span></td>
											<td>
												<a href="#" class="btn btn-xs blue"><i class ="fa fa-search"></i> Detalles</a>
												<a href="#" class="btn btn-xs yellow"><i class ="fa fa-pencil"></i> Editar</a>
												<a href="#" class="btn btn-xs red"><i class ="fa fa-minus-circle"></i> Eliminar</a>
											</td>
										</tr>
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="1"/></td>
											<td> VALR8383JDJ83</td>
											<td><a href="#"> Rancho Vistalegre SA de CV</a></td>
											<td> 15 Abril 2014</td>
											<td><span class="label label-sm label-default"> Bloqueado </span></td>
											<td>
												<a href="#" class="btn btn-xs blue"><i class ="fa fa-search"></i> Detalles</a>
												<a href="#" class="btn btn-xs yellow"><i class ="fa fa-pencil"></i> Editar</a>
												<a href="#" class="btn btn-xs red"><i class ="fa fa-minus-circle"></i> Eliminar</a>
											</td>
										</tr>
										<tr class="odd gradeX">
											<td><input type="checkbox" class="checkboxes" value="1"/></td>
											<td> ROCD921002HJ</td>
											<td><a href="#"> Diego I. Rodriguez Cuevas</a></td>
											<td> 28 Febrero 2014</td>
											<td><span class="label label-sm label-danger">	Atrazado </span></td>
											<td>
												<a href="#" class="btn btn-xs blue"><i class ="fa fa-search"></i> Detalles</a>
												<a href="#" class="btn btn-xs yellow"><i class ="fa fa-pencil"></i> Editar</a>
												<a href="#" class="btn btn-xs red"><i class ="fa fa-minus-circle"></i> Eliminar</a>
											</td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
						<!-- END TABlE MANAGED PENDIENTES -->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->