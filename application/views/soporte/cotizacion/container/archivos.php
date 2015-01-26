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
			<div class="col-md-5">
				<!-- BEGIN COMENTARIOS COTIZACION-->
				<div class="portlet">
					<div class="portlet-title line">
						<div class="caption">
							<i class="fa fa-comments"></i>Comentarios de la cotización
						</div>
						<div class="tools">
							<!-- <a href="" class="reload">
							</a> -->
						</div>
					</div>
					<div class="portlet-body" id="chats">
						<div class="scroller" style="height: 150px;" data-always-visible="1" data-rail-visible1="1">
							<ul class="chats">
								<?php foreach ($comentarios as $comentario): ?>
									<?php if($comentario->tipo=='E'): ?>
										<li class="in">
											<img class="avatar" alt="" src="<?php echo site_url('assets/admin/pages/media/profile').'/'.$comentario->id_ejecutivo.'/chat.jpg' ?>"/>
											<div class="message">
												<span class="arrow"></span>
												<a href="#" class="name"><?php echo $comentario->nombre_ejecutivo.' '.$comentario->apellido_ejecutivo?></a>
												<span class="datetime"><?php echo fecha_chat($comentario->fecha) ?></span>
												<span class="body"><?php echo $comentario->comentario ?></span>
											</div>
										</li>
									<?php endif ?>
									<?php if($comentario->tipo=='C'): ?>
										<li class="out">
											<img class="avatar" alt="" src="<?php echo site_url('assets/admin/pages/media/profile/cliente').'/chat.jpg' ?>"/>
											<div class="message">
												<span class="arrow"></span>
												<a href="#" class="name"><?php echo $cotizacion->razon_social ?></a>
												<span class="datetime"><?php echo fecha_chat($comentario->fecha) ?></span>
												<span class="body"><?php echo $comentario->comentario ?></span>
											</div>
										</li>
									<?php endif ?>
								<?php endforeach ?>
							</ul>
						</div>
						<div class="chat-form">
							<div class="input-cont">
								<input class="form-control" type="text" placeholder="Escribe un comentario..."/>
								<input type="hidden" id="id_ejecutivo" value="<?php echo $usuario_activo['id'] ?>">
								<input type="hidden" id="folio" value="<?php echo $cotizacion->folio ?>">
								<input type="hidden" id="nombre_ejecutivo" value="<?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?>">
								<input type="hidden" id="ruta_imagen" value="<?php echo $usuario_activo['ruta_imagenes'].'chat.jpg' ?>">
							</div>
							<div class="btn-cont">
								<span class="arrow">
								</span>
								<a href="" class="btn blue icn-only">
								<i class="fa fa-check icon-white"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- END COMENTARIOS COTIZACION-->
				<!-- BEGIN Portlet FORMULARIO-->
				<div class="portlet gren">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i> Validación de documentos
						</div>
					</div>
					<div class="portlet-body form">
						<form role="form">
							<div class="form-body">
								<div class="form-group">
									<!-- <input type="hidden" id="folio" value="<?php echo $cotizacion->folio ?>"> -->
									<label>Valoración: </label>
									<div class="radio-list">
										<label class="radio-inline">
										<input type="radio" name="valoracion" id="valoracion1" value="aceptado"> Pagado </label>
										<label class="radio-inline">
										<input type="radio" name="valoracion" id="valoracion2" value="irregular"> Irregular </label>
										<label class="radio-inline">
										<input type="radio" name="valoracion" id="valoracion3" value="parcial"> Parcial </label>
									</div>
								</div>
								<div class="form-group">
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
			<div class="col-md-7">
				<h3>Archivos enviados por <b><?php echo $cotizacion->razon_social ?></b></h3>
				<!-- BEGIN FILTER -->
				<div class="filter-v1 margin-top-10">
					<div class="row mix-grid thumbnails">
						<?php foreach ($archivos as $index => $archivo): ?>
						<div class="col-md-4 col-sm-6 mix">
							<div class="mix-inner">
								<img class="img-responsive" src="<?php echo site_url('clientes/'.$cotizacion->id_cliente.'/comprobantes/'.$cotizacion->folio.'/'.$archivo) ?>" alt="">
								<div class="mix-details">
									<h3><?php echo $archivo ?></h3>
									<a class="mix-link" href="<?php echo site_url('clientes/'.$cotizacion->id_cliente.'/comprobantes/'.$cotizacion->folio.'/'.$archivo) ?>" target="_blank" title="Ampliar"><i class="fa fa-expand"></i></a>
									<a class="mix-preview fancybox-button" href="<?php echo site_url('clientes/'.$cotizacion->id_cliente.'/comprobantes/'.$cotizacion->folio.'/'.$archivo) ?>" title="Ver" data-rel="fancybox-button">
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
