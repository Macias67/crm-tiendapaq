		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title"><?php echo $usuario_activo['primer_nombre'].' '.$usuario_activo['apellido_paterno'] ?> - <small>Cortar imagen</small></h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-8 responsive-1024">
							<!-- This is the image we're attaching Jcrop to -->
							<img src="<?php echo $usuario_activo['ruta_imagenes'].'perfil.jpg' ?>" id="imagen_ejecutivo" alt="Jcrop Example"/>
						</div>
						<div class="col-md-4 responsive-1024">
							<h3>Recorta tu imagen.</h3>
							<p>El recorte será utilizado como imagen de bloqueo de sesión, miniatura de perfil e imagen de chat.</p>
							<br>
							<!-- This is the form that our event handler fills -->
							<form action="<?php echo site_url('ejecutivo/recortar') ?>" method="post" id="form-recorte-imagen">
								<input type="hidden" id="crop_x" name="x"/>
								<input type="hidden" id="crop_y" name="y"/>
								<input type="hidden" id="crop_w" name="w"/>
								<input type="hidden" id="crop_h" name="h"/>
								<input type="submit" value="Cortar Imagen" class="btn btn-large green"/>
							</form>
						</div>
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->
