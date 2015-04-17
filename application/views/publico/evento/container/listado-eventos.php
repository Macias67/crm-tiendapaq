
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Panel de cursos <small>registros y detalles</small></h1>
			</div>
			<!-- END PAGE TITLE -->
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
			<!-- BEGIN PAGE BREADCRUMB -->
<!-- 			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="#">Home</a><i class="fa fa-circle"></i>
				</li>
				<li class="active">
					 Dashboard
				</li>
			</ul> -->
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row margin-top-10">
				<div class="col-md-12 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<h1>Cursos Programados</h1>
							<!-- <div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">Cursos Programados</span>
							</div> -->
							<div class="actions">
								<!-- <div class="btn-group btn-group-devided" data-toggle="buttons">
									<label class="btn btn-transparent grey-salsa btn-circle btn-sm">
									<input type="radio" name="options" class="toggle" id="option2">Esta Semana</label>
									<label class="btn btn-transparent grey-salsa btn-circle btn-sm">
									<input type="radio" name="options" class="toggle" id="option2">Este Mes</label>
									<label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
									<input type="radio" name="options" class="toggle" id="option1">Todos</label>
								</div> -->
							</div>
						</div>
						<div class="portlet-body">
							<div class="row">
								<div class="col-md-12 news-page">
									<div class="row">
										<div class="col-md-4">
											<div class="top-news">
												<a href="javascript:;" class="btn blue">
													<span>Cursos Online </span>
													<!-- <em><i class="fa fa-tags"></i>USA, Business, Apple </em> -->
													<i class="fa fa-calendar top-news-icon"></i>
												</a>
											</div>
											<?php foreach ($online as $index => $curso): ?>
											<div class="news-blocks">
												<h3>
													<a href="<?php echo site_url('cursos/detalles/'.$curso->id_evento) ?>"><?php echo $curso->titulo ?></a>
												</h3>
												<div class="news-block-tags">
													<h5>
														<span class="label label-success"><b><?php echo ($curso->costo == 0) ? 'Sin Costo' : '$ '.number_format($curso->costo, 2, '.', ',').' MN'  ?></b></span>
														<span class="label label-primary"><b><?php echo ($curso->max_participantes == 0) ? 'Sin límite de cupo' : 'Cupo max. '.$curso->max_participantes  ?></b></span>
														<span class="label label-info"><b><?php echo ($curso->sesiones > 1) ?  $curso->sesiones.' sesiones' : $curso->sesiones.' sesion' ?></b></span>
													</h5>
													<h6><b><i class="fa fa-calendar"></i> <?php echo fecha_completa($curso->primera_sesion) ?></b></h6>
													<em></em>
												</div>
												<p>
													<!-- <img class="news-block-img pull-right" src="<?php echo $assets_admin_pages ?>media/gallery/image1.jpg" alt=""> -->
													<?php echo $curso->descripcion ?>
												</p>
												<a href="<?php echo site_url('cursos/inscripcion/'.$curso->id_evento) ?>" class="news-block-btn">
													<button class="btn btn-danger">
														¡INSCRÍBETE! <i class="m-icon-swapright m-icon-white"></i>
													</button>
												</a>
											</div>
											<?php endforeach ?>
										</div>
										<!--end col-md-5-->
										<div class="col-md-4">
											<div class="top-news">
												<a href="javascript:;" class="btn red">
													<span>
													En nuestras Sucursales </span>
													<!-- <em><i class="fa fa-tags"></i>UK, Canada, Asia </em> -->
													<i class="fa fa-calendar top-news-icon"></i>
												</a>
											</div>
											<?php foreach ($sucursal as $index => $curso): ?>
											<div class="news-blocks">
												<h3>
													<a href="<?php echo site_url('cursos/detalles/'.$curso->id_evento) ?>"><?php echo $curso->titulo ?></a>
												</h3>
												<div class="news-block-tags">
													<h5>
														<span class="label label-success"><b><?php echo ($curso->costo == 0) ? 'Sin Costo' : '$ '.number_format($curso->costo, 2, '.', ',').' MN'  ?></b></span>
														<span class="label label-primary"><b><?php echo ($curso->max_participantes == 0) ? 'Sin límite de cupo' : 'Cupo max. '.$curso->max_participantes  ?></b></span>
														<span class="label label-info"><b><?php echo ($curso->sesiones > 1) ?  $curso->sesiones.' sesiones' : $curso->sesiones.' sesion' ?></b></span>
													</h5>
													<h6><b><i class="fa fa-calendar"> </i> <?php echo fecha_completa($curso->primera_sesion) ?></b></h6>
													<h6><b><i class="fa fa-map-marker"> </i> <?php echo $curso->oficina ?></b></h6>
													<em></em>
												</div>
												<p>
													<!-- <img class="news-block-img pull-right" src="<?php echo $assets_admin_pages ?>media/gallery/image1.jpg" alt=""> -->
													<?php echo $curso->descripcion ?>
												</p>
												<a href="<?php echo site_url('cursos/inscripcion/'.$curso->id_evento) ?>" class="news-block-btn">
													<button class="btn btn-danger">
														¡INSCRÍBETE! <i class="m-icon-swapright m-icon-white"></i>
													</button>
												</a>
											</div>
											<?php endforeach ?>
										</div>
										<!--end col-md-4-->
										<div class="col-md-4">
											<div class="top-news">
												<a href="javascript:;" class="btn purple">
												<span>Fuera de nuestras sucursales </span>
												<!-- <em><i class="fa fa-tags"></i>Hi-Tech, Medicine, Space </em> -->
												<i class="fa fa-calendar top-news-icon"></i>
												</a>
											</div>
											<?php foreach ($otro as $index => $curso): ?>
											<div class="news-blocks">
												<h3>
													<a href="<?php echo site_url('cursos/detalles/'.$curso->id_evento) ?>"><?php echo $curso->titulo ?></a>
												</h3>
												<div class="news-block-tags">
													<h5>
														<span class="label label-success"><b><?php echo ($curso->costo == 0) ? 'Sin Costo' : '$ '.number_format($curso->costo, 2, '.', ',').' MN'  ?></b></span>
														<span class="label label-primary"><b><?php echo ($curso->max_participantes == 0) ? 'Sin límite de cupo' : 'Cupo max. '.$curso->max_participantes  ?></b></span>
														<span class="label label-info"><b><?php echo ($curso->sesiones > 1) ?  $curso->sesiones.' sesiones' : $curso->sesiones.' sesion' ?></b></span>
													</h5>
													<h6><b><i class="fa fa-calendar"></i> <?php echo fecha_completa($curso->primera_sesion) ?></b></h6>
													<h6><b><i class="fa fa-map-marker"> </i> <?php echo $curso->direccion ?></b></h6>
													<em></em>
												</div>
												<p>
													<!-- <img class="news-block-img pull-right" src="<?php echo $assets_admin_pages ?>media/gallery/image1.jpg" alt=""> -->
													<?php echo $curso->descripcion ?>
												</p>
												<a href="<?php echo site_url('cursos/inscripcion/'.$curso->id_evento) ?>" class="news-block-btn">
													<button class="btn btn-danger">
														¡INSCRÍBETE! <i class="m-icon-swapright m-icon-white"></i>
													</button></a>
											</div>
											<?php endforeach ?>
										</div>
										<!--end col-md-3-->
									</div>
									<div class="space20"></div>
								</div>
							</div>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->