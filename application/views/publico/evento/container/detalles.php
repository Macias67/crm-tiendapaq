
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Detalles <small>cursos</small></h1>
			</div>
			<!-- END PAGE TITLE -->
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE BREADCRUMB -->
<!-- 			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="#">Home</a><i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="page_news_item.html">Pages</a>
					<i class="fa fa-circle"></i>
				</li>
				<li class="active">
					 News View
				</li>
			</ul> -->
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="portlet light">
				<div class="portlet-body">
					<div class="row">
						<div class="col-md-12 news-page blog-page">
							<div class="row">
								<div class="col-md-9 blog-tag-data">
									<h1 style="margin-top:0"><?php echo $evento->titulo; ?></h1>
									<h4><b><i class="fa fa-calendar"></i> <?php echo fecha_completa($sesiones[0]->fecha_inicio) ?></b></h4>
									<?php if ($evento->modalidad != 'online'): ?>
									<h5><b><i class="fa fa-map-marker"></i> <?php echo $lugar ?></b></h5>
									<?php endif ?>
									<div class="news-item-page">
										<p><?php echo $evento->descripcion; ?></p>
										<hr>
										<h4><?php echo (count($sesiones) == 1) ? 'Una sesión' : count($sesiones).' sesiones' ?></h4>
										<?php foreach ($sesiones as $index => $sesion): ?>
											<p><span class="label bg-red-pink"><?php echo fecha_completa($sesion->fecha_inicio) ?></span> al <span class="label bg-red-pink"><?php echo fecha_completa($sesion->fecha_final) ?></span></p>
										<?php endforeach ?>
										<hr>
										<h3>Temario</h3>
										<a href="<?php echo $temario_url ?>" target="_blank"><img src="<?php echo $temario_url ?>" class="img-responsive" alt=""></a>
										<!-- <div class="row">
											<div class="col-md-6">
												<ul class="list-inline blog-tags">
													<li>
														<i class="fa fa-tags"></i>
														<a href="javascript:;">
														Technology </a>
														<a href="javascript:;">
														Education </a>
														<a href="javascript:;">
														Internet </a>
													</li>
												</ul>
											</div>
											<div class="col-md-6 blog-tag-data-inner">
												<ul class="list-inline">
													<li>
														<i class="fa fa-calendar"></i>
														<a href="javascript:;">
														April 16, 2013 </a>
													</li>
													<li>
														<i class="fa fa-comments"></i>
														<a href="javascript:;">
														38 Comments </a>
													</li>
												</ul>
											</div>
										</div> -->
									</div>
									<hr>
								</div>
								<div class="col-md-3">
									<!-- <h3 style="margin-top:0">News Feeds</h3> -->
									<div class="top-news">
										<a href="<?php echo site_url('cursos/inscripcion/'.$evento->id_evento) ?>" class="btn green">
											<span>¡Inscríbete! </span>
											<em>Fecha límite: </em>
											<em><b><?php echo fecha_completa($evento->fecha_limite) ?></b></em>
											<i class="fa fa-music top-news-icon"></i>
										</a>
										<a class="btn yellow">
											<span><?php echo ($evento->max_participantes == 0) ? 'Sin límite de cupo' : 'Cupo para '.$evento->max_participantes.' personas.'  ?></span>
											<i class="fa fa-book top-news-icon"></i>
										</a>
										<a class="btn red">
											<span><?php echo ($evento->modalidad == 'online') ? 'Curso Online' : 'Curso Presencial' ?></span>
											<i class="fa fa-briefcase top-news-icon"></i>
										</a>
										<a class="btn blue">
											<span><?php echo ($evento->costo == 0) ? 'Sin Costo' : 'Costo: $ '.number_format($evento->costo, 2, '.', ',').' MN'  ?></span>
											<?php if ($evento->costo != 0): ?>
												<em><b>Previa cotización.</b></em>
											<?php endif ?>
											<i class="fa fa-globe top-news-icon"></i>
										</a>
									</div>
									<div class="space20">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->