<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h3 class="modal-title">Archivos: </h3>
</div>
<div class="modal-body">
	<!-- <div class="scroller"> -->
		<div class="row">
			<div class="col-md-12">
				<h5>Imagenes</h5>
				<?php foreach ($archivos['thumbnails'] as $key => $imagen): ?>
				<div class="col-sm-6 col-md-3">
					<a href="<?php echo $archivos['imagenes'][$key] ?>" class="thumbnail" target="_blank">
						<img src="<?php echo $imagen ?>" alt="" style="height: 150px; width: 200px; display: block;">
					</a>
				</div>
				<?php endforeach ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>PDF's</h5>
				<?php foreach ($archivos['pdfs'] as $key => $pdf): ?>
				<a class="icon-btn muestra-pdf" href="<?php echo $pdf ?>" target="_blank">
					<i class="fa fa-file-pdf-o"></i>
					<div>&nbsp;&nbsp;Pdf&nbsp;&nbsp;</div>
				</a>
				<?php endforeach ?>
			</div>
		</div>
	<!-- </div> -->
</div>
<div class="modal-footer">
	<button type="button" class="btn blue" data-dismiss="modal">OK </button>
</div>