		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">Cotización - <small>Comprobar Pago</small></h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-8">
						<form id="fileupload" action="<?php echo site_url('cotizacion/ajax/'.$cotizacion->id_cliente.'/'.$cotizacion->folio) ?>" method="POST" enctype="multipart/form-data">
							<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
							<div class="row fileupload-buttonbar">
								<div class="col-lg-8">
									<div class="btn-group btn-group btn-group-solid">
										<!-- The fileinput-button span is used to style the file input field as button -->
										<span class="btn green btn-circle fileinput-button">
											<i class="fa fa-plus"></i>
											<span>Añadir archivos... </span>
											<input type="file" name="files[]" multiple="">
										</span>
										<button type="submit" class="btn btn-circle blue start">
											<i class="fa fa-upload"></i>
											<span>Subir archivos </span>
										</button>
										<button type="reset" class="btn btn-circle warning cancel">
											<i class="fa fa-ban-circle"></i>
											<span>
											Cancelar subida </span>
										</button>
										<button type="button" class="btn red btn-circle delete">
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
						<button class="btn green btn-lg btn-circle btn-block" id="confirmar" folio="<?php echo $cotizacion->folio ?>">Confirmar archivos</button>
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