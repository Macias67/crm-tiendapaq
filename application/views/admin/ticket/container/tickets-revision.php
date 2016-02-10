<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Tickets - <small>Tickets pendientes por atender</small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN TABLA MIS PENDIENTES-->
				<div class="portlet gren">
					<div class="portlet-title">
						<div class="caption">Tickets pendientes</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height:400px">
							<table class="table table-striped table-bordered table-hover" id="tabla-tickets-revision">
								<thead>
									<tr>
										<th>No.</th>
										<th>Cliente</th>
										<th>Contacto</th>
										<th>Email contacto</th>
										<th>Teléfono</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($tickets_revision as $ticket): ?>
										<tr class="odd gradeX">
											<td><?php echo $ticket->id_ticket ?></td>
											<td><?php echo $ticket->razon_social ?></td>
											<td><?php echo $ticket->nombre_contacto.' '.$ticket->apellido_paterno ?></td>
											<td><?php echo $ticket->email_contacto ?></td>
											<td><?php echo $ticket->telefono1 ?></td>
											<td><a class="btn btn-circle blue btn-xs" href="<?php echo site_url('tickets/revision/'.$ticket->id_ticket) ?>"><i class="fa fa-search"></i> Detalles </a></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- END TABLA MIS PENDIENTES-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->