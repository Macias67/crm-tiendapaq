
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
					<div class="col-md-8">
						<form id="fileupload" action="<?php echo site_url('cotizacion/ajax/'.$cotizacion->cliente.'/'.$cotizacion->folio) ?>" method="POST" enctype="multipart/form-data">
							<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
							<div class="row fileupload-buttonbar">
								<div class="col-lg-8">
									<div class="btn-group btn-group-xs btn-group-solid">
										<!-- The fileinput-button span is used to style the file input field as button -->
										<span class="btn green btn-xs fileinput-button">
											<i class="fa fa-plus"></i>
											<span>Añadir archivos... </span>
											<input type="file" name="files[]" multiple="">
										</span>
										<button type="submit" class="btn blue btn-xs start">
											<i class="fa fa-upload"></i>
											<span>Subir archivos </span>
										</button>
										<button type="reset" class="btn warning btn-xs cancel">
											<i class="fa fa-ban-circle"></i>
											<span>
											Cancelar subida </span>
										</button>
										<button type="button" class="btn red btn-xs delete">
											<i class="fa fa-trash"></i>
											<span>Borrar </span>
										</button>
									</div>
										<br>
									<span>
										<input type="checkbox" class="toggle"> Seleccionar todos
									</span>
									<!-- The global file processing state -->
									<span class="fileupload-process">
									</span>
								</div>
								<!-- The global progress information -->
								<div class="col-lg-4 fileupload-progress fade">
									<!-- The global progress bar -->
									<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
										<div class="progress-bar progress-bar-success" style="width:0%;"></div>
									</div>
									<!-- The extended global progress information -->
									<div class="progress-extended">&nbsp;</div>
								</div>
							</div>
							<!-- The table listing the files available for upload/download -->
							<table role="presentation" class="table table-striped clearfix">
								<tbody class="files">
								</tbody>
							</table>
						</form>
						<button class="btn green btn-lg btn-block" id="confirmar" folio="<?php echo $cotizacion->folio ?>">Confirmar archivos</button>
					</div>
					<div class="col-md-4">
						<div class="panel panel-success">
							<div class="panel-heading">
								<h3 class="panel-title">Especificaciones de archivos a subir</h3>
							</div>
							<div class="panel-body">
								<ul>
									<li>El tamaño por archivo maximo es de <strong>2 MB</strong>. </li>
									<li>Unicamente archivos  (<strong>JPG, PNG, PDF</strong>) son permitidos.</li>
								</ul>
							</div>
						</div>
						<!-- <div class="portlet gren">
							<div class="portlet-title">
								<div class="caption"><i class="fa fa-gift"></i> Detalles de cotización</div>
								<div class="tools">
									<a href="javascript:;" class="expand"></a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="invoice">
									<div class="row invoice-logo">
										<div class="col-xs-6 invoice-logo-space">
											<img src="../../assets/admin/pages/media/invoice/tiendapaq.png" class="img-responsive" alt=""/>
										</div>
										<div class="col-xs-6">
											<p>
												Folio: <?php echo $cotizacion->folio ?> / <?php echo $cotizacion->fecha ?>
												<span class="muted"><strong>Vigencia: </strong><?php echo $cotizacion->vigencia ?></span>
											</p>
										</div>
									</div>
									<hr/>
									<div class="row">
										<div class="col-xs-5">
											<h3>Cliente: </h3>
											<ul class="list-unstyled">
												<li><strong><?php echo $usuario_activo['razon_social'] ?></strong></li>
												<li> Mr Nilson Otto</li>
												<li>FoodMaster Ltd</li>
												<li>Madrid</li>
												<li> Spain</li>
												<li>1982 OOP</li>
											</ul>
										</div>
										<div class="col-xs-6 invoice-payment">
											<h3>Detalles de pago:</h3>
											<ul class="list-unstyled">
												<li><strong><?php echo $cotizacion->banco ?></strong></li>
												<li><?php echo $cotizacion->titular ?></li>
												<li><?php echo $cotizacion->sucursal.'/'.$cotizacion->cta ?></li>
												<li><?php echo $cotizacion->cib ?></li>
											</ul>
										</div>
										<div class="col-xs-12">
											<h3>Observaciones:</h3>
											<ul class="list-unstyled">
												<li><strong><?php echo $cotizacion->descripcion ?></strong></li>
											</ul>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<h3>Productos:</h3>
											<table class="table table-striped table-hover">
												<thead>
													<tr>
														<th>Código</th>
														<th>Descripcion</th>
														<th class="hidden-480">Cantidad</th>
														<th class="hidden-480">Precio</th>
														<th class="hidden-480">Neto</th>
														<th class="hidden-480">Descuento</th>
														<th>Total</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($cotizacion->cotizacion as $producto): ?>
													<tr>
														<td><?php echo $producto->codigo ?></td>
														<td><?php echo $producto->descripcion ?></td>
														<td class="hidden-480"><?php echo $producto->cantidad ?></td>
														<td class="hidden-480">$ <?php printf("%.2f", $producto->precio) ?></td>
														<td class="hidden-480">$ <?php printf("%.2f", $producto->neto) ?></td>
														<td class="hidden-480">$ <?php printf("%.2f", $producto->descuento) ?></td>
														<td>$ <?php printf("%.2f", $producto->total) ?></td>
													</tr>
													<?php endforeach ?>
												</tbody>
											</table>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-6">
											<div class="well">
												<address>
													<strong>TiendaPAQ</strong><br/>
													<?php echo $cotizacion->calle.' '.$cotizacion->numero ?><br/>
													<?php echo 'Col. '.$cotizacion->colonia ?><br/>
													<?php echo $cotizacion->ciudad_estado ?><br/>
													<abbr title="Teléfono"><?php echo $cotizacion->telefono ?></abbr>
													<a href="mailto:<?php echo $cotizacion->email ?>"><?php echo $cotizacion->email ?></a>
												</address>
											</div>
										</div>
										<div class="col-xs-6 invoice-block">
											<ul class="list-unstyled amounts">
												<li>
													<strong>NETO: </strong> $9265
												</li>
												<li>
													<strong>Descueto: </strong> $9265
												</li>
												<li>
													<strong>I.V.A: </strong> -----
												</li>
												<li>
													<strong>Total: </strong> $12489
												</li>
											</ul>
											<br/>
											<a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();">Imprimir PDF <i class="fa fa-print"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div> -->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->

		<!-- The blueimp Gallery widget -->
		<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
			<div class="slides"></div>
			<h3 class="title"></h3>
			<a class="prev">‹ </a>
			<a class="next">› </a>
			<a class="close white"></a>
			<a class="play-pause"></a>
			<ol class="indicator"></ol>
		</div>

		<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
		<script id="template-upload" type="text/x-tmpl">
			{% for (var i=0, file; file=o.files[i]; i++) { %}
				<tr class="template-upload fade">
					<td>
						<span class="preview"></span>
					</td>
					<td>
						<p class="name">{%=file.name%}</p>
						<strong class="error text-danger label label-danger"></strong>
					</td>
					<td>
						<p class="size">Procesando...</p>
						<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
						<div class="progress-bar progress-bar-success" style="width:0%;"></div>
						</div>
					</td>
					<td>
						{% if (!i && !o.options.autoUpload) { %}
							<button class="btn blue start" disabled>
								<i class="fa fa-upload"></i>
								<span>Iniciar</span>
							</button>
						{% } %}
						{% if (!i) { %}
							<button class="btn red cancel">
								<i class="fa fa-ban"></i>
								<span>Cancelar</span>
							</button>
						{% } %}
					</td>
				</tr>
			{% } %}
		</script>
		<!-- The template to display files available for download -->
		<script id="template-download" type="text/x-tmpl">
			{% for (var i=0, file; file=o.files[i]; i++) { %}
			<tr class="template-download fade">
				<td>
					<span class="preview">
					{% if (file.thumbnailUrl) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
					{% } %}
					</span>
				</td>
				<td>
					<p class="name">
						{% if (file.url) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
						{% } else { %}
						<span>{%=file.name%}</span>
						{% } %}
					</p>
					{% if (file.error) { %}
					<div><span class="label label-danger">Error</span> {%=file.error%}</div>
					{% } %}
				</td>
				<td>
					<span class="size">{%=o.formatFileSize(file.size)%}</span>
				</td>
				<td>
					{% if (file.deleteUrl) { %}
					<button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
						<i class="fa fa-trash-o"></i>
						<span>Borrar</span>
					</button>
						<input type="checkbox" name="delete" value="1" class="toggle">
					{% } else { %}
					<button class="btn yellow cancel btn-sm">
						<i class="fa fa-ban"></i>
						<span>Cancelar</span>
					</button>
					{% } %}
				</td>
			</tr>
			{% } %}
		</script>
		<!-- BEGIN CORE PLUGINS -->