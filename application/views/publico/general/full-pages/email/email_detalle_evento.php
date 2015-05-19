<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Responsive System <br> Email Template</title>
		<meta name="viewport" content="width=device-width">
	</head>
	<body style="min-width: 100%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;margin: 0;padding: 0;direction: ltr;background: #f6f8f1;width: 100% !important;">
		<table class="body">
			<tr>
				<td class="center" align="center" valign="top">
					<!-- BEGIN: Content -->
					<table class="container content" align="center">
						<tr>
							<td>
								<table class="row note">
									<tr>
										<td class="wrapper last">
											<h4 style="font-size: 22px;display: block;margin: 5px 0 15px 0;"> TiendaPAQ - DISTRIBUIDOR ASOCIADO MASTER CONTPAQi </h4>
											<span class="devider" style="border-bottom: 1px solid #eee;margin: 15px -15px;display: block;"></span>
											<p> Le agradecemos que se haya inscrito a nuestros cursos, le enviamos los detalles del curso y adjuntamos la imagen del temario: </p>
											<!-- BEGIN: Note Panel -->
											<table class="twelve columns" style="margin-bottom: 10px">
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														<b>Nombre:</b> <?php echo $titulo ?>
													</td>
												</tr>
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														<b>Descripción:</b> <?php echo $descripcion ?>
													</td>
												</tr>
												<!-- Validar si es online o presencial -->
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														<b><?php echo ($modalidad == 'online') ? 'Link del curso:' : 'Dirección:'?></b> <?php echo $ubicacion ?>
													</td>
												</tr>
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														<b>Fecha del curso:</b> <?php echo fecha_completa($sesiones[0]->fecha_inicio) ?>
													</td>
												</tr>
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														<b>Sesiones:</b><br />
														<?php foreach ($sesiones as $index => $sesion): ?>
														<?php echo ($index+1).'. '.fecha_completa($sesion->fecha_inicio).' al '. fecha_completa($sesion->fecha_final) ?><br />
														<?php endforeach ?>
													</td>
												</tr>
											</table>

											<span class="devider" style="border-bottom: 1px solid #eee;margin: 15px -15px;display: block;"></span>
											<p> Tus datos de logueo a nuestra aplicación web: </p>

											<!-- BEGIN: Note Panel -->
											<table class="twelve columns" style="margin-bottom: 10px">
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														<b>Nuestra aplicación web:</b> <a href="<?php echo base_url() ?>"><?php echo base_url() ?> </a>
													</td>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														<a href="https://www.youtube.com/watch?v=pCKrm0ZZE3s"><b>Videotutorial de nuestra aplicación</b></a>
													</td>
													<td class="expander"></td>
												</tr>
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														<b>Usuario:</b> <?php echo $usuario ?>
													</td>
												</tr>
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														<b>Contraseña:</b> <?php echo $password ?>
													</td>
												</tr>
											</table>
											<p>Si al hacer clic en la URL de arriba no funciona, copia y pega la URL en el navegador.</p>
											<!-- END: Note Panel -->
										</td>
									</tr>
								</table>
								<span class="devider" style="border-bottom: 1px solid #eee;margin: 15px -15px;display: block;"></span>
								<table class="row">
									<tr>
										<td class="wrapper last">
											<!-- BEGIN: Disscount Content -->
											<table class="twelve columns">
												<tr>
													<td>
														<img src="<?php echo $assets_admin_pages.'media/email/logoTP.png' ?>" class="ie10-responsive" alt="" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: auto;height: auto;max-width: 100%;float: left;clear: both;display: block;">
													</td>
													<td class="expander"></td>
													<td class="expander"></td>
													<td>
														<h4 style="font-size: 18px;display: block;margin: 5px 0 15px 0;"> Soporte técnico y capacitación. </h4>
														<p> Reciba un cordial saludo y nuestro agradecimiento por su confianza e interés en los productos y servicios que ofrecemos.</p>
													</td>
													<td class="expander"></td>
												</tr>
											</table>
											<!-- END: Disscount Content -->
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<!-- END: Content -->
					<!-- BEGIN: Footer -->
					<table class="page-footer" align="center" style="width: 100%;background: #2f2f2f;">
						<tr>
							<td class="center" align="center" style="vertical-align: middle;color: #fff;">
								<table class="container" align="center">
									<tr>
										<td style="vertical-align: middle;color: #fff;">
											<!-- BEGIN: Unsubscribet -->
											<table class="row">
												<tr>
													<td class="wrapper last" style="vertical-align: middle;color: #fff;">
														<span style="font-size:12px;">
														<i>Email generado por el sistema, no reenviar.</i>
														</span>
													</td>
												</tr>
											</table>
											<!-- END: Unsubscribe -->
											<!-- BEGIN: Footer Panel -->
											<table class="row">
												<tr>
													<td class="wrapper" style="vertical-align: middle;color: #fff;">
														<table class="four columns">
														<tr>
															<td class="vertical-middle" style="padding-top: 0;padding-bottom: 0;vertical-align: middle;padding: 0 2px !important;width: auto !important;">
																<a href="https://www.facebook.com/Tiendapaq">
																<img src="<?php echo $assets_admin_pages.'media/email/social_facebook.png' ?>" alt="social icon" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: auto;height: auto;max-width: none !important;float: left;clear: both;display: block;">
																</a>
															</td>
															<td class="vertical-middle" style="padding-top: 0;padding-bottom: 0;vertical-align: middle;color: #fff;"> TiendaPAQ <?php echo date('Y') ?>.</td>
														</tr>
														</table>
													</td>
												</tr>
											</table>
											<!-- END: Footer Panel List -->
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<!-- END: Footer -->
				</td>
			</tr>
		</table>
	</body>
</html>