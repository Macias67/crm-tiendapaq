<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Metronic | Email Templates - Responsive System <br> Email Template</title>
		<!--IMPORTANT:
		Before deploying this email template into your application make sure you convert all the css code in <style> tag using http://beaker.mailchimp.com/inline-css.
		Chrome and other few mail clients do not support <style> tag so the above converter from mailchip will make sure that all the css code will be converted into inline css.
		-->
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
								<h4 style="font-size: 22px;display: block;margin: 5px 0 15px 0;">TIENDAPAQ - DISTRIBUIDOR ASOCIADO MASTER CONTPAQi</h4>
								<p>
									 Estos son sus datos para inicio de session:
								</p>
								<!-- BEGIN: Note Panel -->
								<table class="twelve columns" style="margin-bottom: 10px">
								<tr>
									<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
										<b>Usuario:</b>          <?php echo $recordar->usuario ?>
									</td>
								</tr>
								<tr>
									<td class="panel" style="background: #ECF8FF;border: 0;padding: 10px !important;">
										<b>Contraseña:</b>  <?php echo $recordar->password ?>
									</td>
								</tr>
								</table>
								<p>
									 Puede hacer click en el enlace para ir a la pagina principal:
									 <a href="http://www.sycpaq.com">http://www.sycpaq.com </a>
								</p>
								<!-- END: Note Panel -->
							</td>
						</tr>
						</table>
						<span class="devider" style="border-bottom: 1px solid #eee;margin: 15px -15px;display: block;">
						</span>
						<table class="row">
						<tr>
							<td class="wrapper last">
								<!-- BEGIN: Disscount Content -->
								<table class="twelve columns">
								<tr>
									<td>
										<img src="<?php echo $assets_admin_pages.'media/email/LogoTiendaPAQ.gif' ?>" class="ie10-responsive" alt="" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: auto;height: auto;max-width: 100%;float: left;clear: both;display: block;">
									</td>
									<td>
										<h4 style="font-size: 22px;display: block;margin: 5px 0 15px 0;">Soporte técnico y capacitación.</h4>
											<p>
												Reciba un cordial saludo y nuestro agradecimiento por su confianza e interes en los Productos y Servicios que ofrecemos.
											</p>
										</td>
									<td class="expander">
									</td>
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
											<td class="vertical-middle" style="padding-top: 0;padding-bottom: 0;vertical-align: middle;color: #fff;">
												 &copy; TiendaPAQ 2015.
											</td>
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