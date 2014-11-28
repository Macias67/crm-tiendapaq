
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Gestionar Clientes - <small><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?></small></h3>
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
									<span class="caption-subject bold uppercase"> Catálogo de clientes</span>
								</div>
								<div class="actions">
									<a href="<?php echo site_url('cliente/gestionar/nuevo') ?>" class="btn btn-circle green">
									<i class="fa fa-plus"></i> Agregar </a>
									<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#">
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-hover table-bordered" id="tabla_gestionar_cliente">
									<thead>
										<tr>
											<th width="2%">Activo</th>
											<th width="6%">Código</th>
											<th width="7%">R.F.C.</th>
											<th width="45%">Razón Social</th>
											<th width="5%">Email</th>
											<th width="3%">Tipo</th>
											<th width="1%"></th>
											<th width="1%"></th>
									</thead>
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