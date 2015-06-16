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
											<h4 style="font-size: 22px;display: block;margin: 5px 0 15px 0;"> TiendaPAQ - Respuestas del cliente al cuestionario de su caso </h4>
											<span class="devider" style="border-bottom: 1px solid #eee;margin: 15px -15px;display: block;"></span>
											<p> Detalle general del caso.</p>
											<!-- BEGIN: Note Panel -->
											<table class="twelve columns" style="margin-bottom: 10px">
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														<b>Folio del caso:</b> <?php echo $folio ?>
													</td>
												</tr>
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														<b>ID del caso:</b> <?php echo $id_caso ?>
													</td>
												</tr>
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														<b>Lider del caso:</b> <?php echo $lider ?>
													</td>
												</tr>
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														<b>Cliente del caso:</b> <?php echo $cliente ?>
													</td>
												</tr>
											</table>

											<span class="devider" style="border-bottom: 1px solid #eee;margin: 15px -15px;display: block;"></span>

											<p> Respuestas del cliente. </p>

											<!-- BEGIN: Note Panel -->
											<table class="twelve columns" style="margin-bottom: 10px">
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														¿Usted fue atendido con amabilidad y respeto todo el tiempo? <b>(<?php echo $puntos1 ?>/25 pts)</b> <br />
														<b><?php echo $respuesta1 ?></b>
													</td>
												</tr>
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														¿Durante el desarrollo de su caso se le brindo información suficiente, clara y oportuna sobre los trabajos a realizar? <b>(<?php echo $puntos2 ?>/15 pts)</b> <br />
														<b><?php echo $respuesta2 ?> </b>
													</td>
												</tr>
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														¿Cómo calificaría nuestro tiempo de respuesta y solución a este caso? <b>(<?php echo $puntos3 ?>/30 pts)</b><br />
														<b><?php echo $respuesta3 ?></b>
													</td>
												</tr>
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														¿Cómo calificaría el conocimiento o experiencia del asesor asignado? <b>(<?php echo $puntos4 ?>/20 pts)</b> <br />
														<b><?php echo $respuesta4 ?></b>
													</td>
												</tr>
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														¿Estaría dispuesto a recomendar nuestos servicios a alguien más? <b>(<?php echo $puntos5 ?>/10 pts)</b><br />
														<b><?php echo $respuesta5 ?></b><br />
														<?php if ($respuesta5 == 'si'): ?>
															<b> Nombre: </b> <?php echo $data['p5_nombre'] ?> <br />
															<b>Email: </b> <?php echo $data['p5_email'] ?> <br />
															<b>Telefono: </b> <?php echo $data['p5_telefono'] ?>
														<?php elseif ($respuesta5 == 'nunca'): ?>
															<b>¿Por qué? <?php echo $data['p5_porque'] ?></b>
														<?php endif ?>
													</td>
												</tr>
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														¿Hay algo en lo que usted considera que tenemos que mejorar? <br />
														<b><?php echo $data['pregunta6'] ?></b>
													</td>
												</tr>
												<tr>
													<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
														Calificación final (Minimo 80% para cerrar caso) <br />
														<b><?php echo $puntaje ?>% - Cierra Caso</b>
													</td>
												</tr>
											</table>
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