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
						<h3 class="page-title">Blank Page <small>blank page</small></h3>
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
								<a href="#">Pagina</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Seccion</a>
							</li>
						</ul>
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
								<form role="form" id-folio="<?php echo $cotizacion->folio ?>">
									<div class="form-body">
										<div class="form-group">
											<label>Valoración: </label>
											<div class="radio-list">
												<label class="radio-inline">
												<input type="radio" name="valoracion" id="valoracion1" value="aceptado"> Aceptado </label>
												<label class="radio-inline">
												<input type="radio" name="valoracion" id="valoracion2" value="irregular"> Irregular </label>
											</div>
										</div>
										<div class="form-group">
											<label>Comentarios: </label>
											<textarea class="form-control" id="comentarios" rows="2"></textarea>
											<br>
											<button type="button" id="validar" class="btn red btn-block">VALIDAR</button>
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
