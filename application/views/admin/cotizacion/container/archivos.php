<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Cotización - <small>Comprobantes de Pago</small></h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-4">
				<!-- BEGIN Portlet FORMULARIO-->
				<div class="portlet gren">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i>Validación de documentos
						</div>
					</div>
					<div class="portlet-body form">
						<form role="form">
							<div class="form-body">
								<div class="form-group">
									<input type="hidden" id="folio" value="<?php echo $cotizacion->folio ?>">
									<label>Valoración: </label>
									<div class="radio-list">
										<label class="radio-inline">
										<input type="radio" name="valoracion" id="valoracion1" value="aceptado"> Aceptado </label>
										<label class="radio-inline">
										<input type="radio" name="valoracion" id="valoracion2" value="irregular"> Irregular </label>
										<label class="radio-inline">
										<input type="radio" name="valoracion" id="valoracion3" value="parcial"> Parcial </label>
									</div>
								</div>
								<div class="form-group">
									<label>Comentarios: </label>
									<textarea class="form-control" id="comentarios" rows="2"></textarea>
									<br>
									<button type="button" id="validar" class="btn btn-circle red btn-block">VALIDAR</button>
								</div>
								<div class="form-group">
									<button type="button" class="btn green default cotizacion-previa btn-circle btn-block" id="<?php echo $cotizacion->folio ?>" id-cliente="<?php echo $cotizacion->id_cliente ?>">Ver Cotización</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- END Portlet FORMULARIO-->
			</div>
			<div class="col-md-8">
				<!-- BEGIN FILTER -->
				<div class="filter-v1 margin-top-10">
					<div class="row mix-grid thumbnails">
						<?php foreach ($archivos as $index => $archivo): ?>
						<div class="col-md-4 col-sm-6 mix">
							<div class="mix-inner">
								<img class="img-responsive" src="<?php echo site_url('clientes/'.$cotizacion->id_cliente.'/comprobantes/'.$cotizacion->folio.'/'.$archivo) ?>" alt="">
								<div class="mix-details">
									<h3><?php echo $archivo ?></h3>
									<a class="mix-link"><i class="fa fa-link"></i></a>
									<a class="mix-preview fancybox-button" href="<?php echo site_url('clientes/'.$cotizacion->id_cliente.'/comprobantes/'.$cotizacion->folio.'/'.$archivo) ?>" title="Cotización #<?php echo $cotizacion->folio ?>" data-rel="fancybox-button">
										<i class="fa fa-search"></i>
									</a>
								</div>
							</div>
						</div>
						<?php endforeach ?>
					</div>
				</div>
				<!-- END FILTER -->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->
