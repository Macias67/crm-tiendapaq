
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
							Elige un color </span>
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
						<h3 class="page-title">
						Bienvenido - <small>blank page</small>
						</h3>
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
								<a href="<?php echo base_url() ?>">Inicio</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<!-- Menu -->
				<div class="row">
					<div class="col-md-12">
						<div class="portlet gren">
							<div class="portlet-title">
								<div class="caption"><i class="fa fa-user"></i>Menú</div>
							</div>
							<div class="portlet-body">
								<a href="#" class="icon-btn" data-target="#nuevo-cliente" data-toggle="modal">
									<i class="fa fa-building"></i>
									<div>Nuevo Cliente</div>
								</a>
								<a href="#" class="icon-btn" data-target="#nuevo-ticket" data-toggle="modal">
									<i class="fa fa-ticket"></i>
									<div>Abrir Ticket</div>
								</a>
								<a href="#" class="icon-btn">
									<i class="fa fa-calendar"></i>
									<div>Calendario</div>
									<span class="badge badge-success">4 </span>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-envelope"></i>
								<div>
								Inbox
								</div>
								<span class="badge badge-info">
								12 </span>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-bullhorn"></i>
								<div>
								Notification
								</div>
								<span class="badge badge-danger">
								3 </span>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-map-marker"></i>
								<div>
								Locations
								</div>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-money"><i></i></i>
								<div>
								Finance
								</div>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-plane"></i>
								<div>
								Projects
								</div>
								<span class="badge badge-info">
								21 </span>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-thumbs-up"></i>
								<div>
								Feedback
								</div>
								<span class="badge badge-info">
								2 </span>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-cloud"></i>
								<div>
								Servers
								</div>
								<span class="badge badge-danger">
								2 </span>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-globe"></i>
								<div>
								Regions
								</div>
								</a>
								<a href="#" class="icon-btn">
								<i class="fa fa-heart-o"></i>
								<div>
								Popularity
								</div>
								<span class="badge badge-info">
								221 </span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Pendientes -->
				<div class="row">
					<div class="col-md-7">
						<!-- BEGIN TABLA MIS PENDIENTES-->
						<div class="portlet gren">
							<div class="portlet-title">
								<div class="caption"><i class="fa fa-user"></i>Mis Pendientes</div>
							</div>
							<div class="portlet-body">
								<div class="scroller" style="height:400px">
									<table class="table table-striped table-bordered table-hover" id="mis_pendientes">
										<thead>
											<tr>
												<th>Username</th>
												<th>Email</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<tr class="odd gradeX">
												<td>shuxer</td>
												<td>
													<a href="mailto:shuxer@gmail.com">shuxer@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>looper</td>
												<td>
													<a href="mailto:looper90@gmail.com">looper90@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-warning">Suspended </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>
													userwow
												</td>
												<td>
													<a href="mailto:userwow@yahoo.com">userwow@yahoo.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>user1wow</td>
												<td>
													<a href="mailto:userwow@gmail.com">userwow@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-default">Blocked </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>restest</td>
												<td>
													<a href="mailto:userwow@gmail.com">test@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>foopl</td>
												<td>
													<a href="mailto:userwow@gmail.com">good@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>weep</td>
												<td>
													<a href="mailto:userwow@gmail.com">good@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>coop</td>
												<td>
													<a href="mailto:userwow@gmail.com">good@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- END TABLA MIS PENDIENTES-->
					</div>
					<div class="col-md-5">
						<!-- BEGIN TABLA MIS PENDIENTES-->
						<div class="portlet gren">
							<div class="portlet-title">
								<div class="caption"><i class="fa fa-user"></i>Pendientes Generales</div>
							</div>
							<div class="portlet-body">
								<div class="scroller" style="height:400px">
									<table class="table table-striped table-bordered table-hover" id="pendientes_grales">
										<thead>
											<tr>
												<th>Username</th>
												<th>Email</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<tr class="odd gradeX">
												<td>shuxer</td>
												<td>
													<a href="mailto:shuxer@gmail.com">shuxer@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>looper</td>
												<td>
													<a href="mailto:looper90@gmail.com">looper90@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-warning">Suspended </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>
													userwow
												</td>
												<td>
													<a href="mailto:userwow@yahoo.com">userwow@yahoo.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>user1wow</td>
												<td>
													<a href="mailto:userwow@gmail.com">userwow@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-default">Blocked </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>restest</td>
												<td>
													<a href="mailto:userwow@gmail.com">test@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>foopl</td>
												<td>
													<a href="mailto:userwow@gmail.com">good@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>weep</td>
												<td>
													<a href="mailto:userwow@gmail.com">good@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td>coop</td>
												<td>
													<a href="mailto:userwow@gmail.com">good@gmail.com </a>
												</td>
												<td>
													<span class="label label-sm label-success">Approved </span>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- END TABLA MIS PENDIENTES-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->

				<!-- BEGIN VENTANAS MODALES -->
				<!-- Nuevo Cliente -->
				<div id="nuevo-cliente" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
					<div class="modal-header">
						<h3 class="modal-title">
							<b>Registrar nuevo cliente</b>
						</h3>
						<small>Registro de un cliente en TiendaPAQ</small>
					</div>
					<form action="<?php echo site_url('cliente/add') ?>" method="post" accept-charset="utf-8">
						<div class="modal-body form-horizontal">
							<div class="scroller" style="height: 400px">
								<div class="form-body">
									<div class="col-md-6">
										<h4>Información Básica</h4>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Razón Social
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-asterisk"></i>
													<input type="text" class="form-control" placeholder="Razón Social" name="razon_social">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">
												R.F.C.
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-barcode"></i>
													<input type="text" class="form-control" placeholder="R.F.C." name="rfc">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Email</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa  fa-envelope"></i>
													<input type="text" class="form-control" placeholder="Email" name="email">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Tipo : </label>
											<div class="col-md-9">
												<select class="form-control">
													<option value="Normal">Normal</option>
													<option value="Distribuidor">Distribuidor</option>
													<option value="Prospecto">Prospecto</option>
												</select>
											</div>
										</div>

										<hr>

										<h4>Domicilio</h4>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Calle
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="Calle" name="calle">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">
												No. Exterior
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="No. Exterior" name="no_exterior">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">No. Interior</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="No. Interior" name="no_interior">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Colonia</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="Colonia" name="colonia">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Código Postal</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="Código Postal" name="codigo_postal">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Ciudad</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="Ciudad" name="ciudad">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Municipio</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" placeholder="Municipio" name="minucipio">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Estado</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<select class="form-control">
														<option value="Aguascalientes">Aguascalientes</option>
														<option value="Baja California">Baja California</option>
														<option value="Baja California Sur">Baja California Sur</option>
														<option value="Campeche">Campeche</option>
														<option value="Chiapas">Chiapas</option>
														<option value="Chihuahua">Chihuahua</option>
														<option value="Coahuila">Coahuila</option>
														<option value="Colima">Colima</option>
														<option value="Distrito Federal">Distrito Federal</option>
														<option value="Durango">Durango</option>
														<option value="Estado de México">Estado de México</option>
														<option value="Guanajuato">Guanajuato</option>
														<option value="Guerrero">Guerrero</option>
														<option value="Hidalgo">Hidalgo</option>
														<option value="Jalisco" selected>Jalisco</option>
														<option value="Michoacán">Michoacán</option>
														<option value="Morelos">Morelos</option>
														<option value="Nayarit">Nayarit</option>
														<option value="Nuevo León">Nuevo León</option>
														<option value="Oaxaca">Oaxaca</option>
														<option value="Puebla">Puebla</option>
														<option value="Querétaro">Querétaro</option>
														<option value="Quintana Roo">Quintana Roo</option>
														<option value="San Luis Potosí">San Luis Potosí</option>
														<option value="Sinaloa">Sinaloa</option>
														<option value="Sonora">Sonora</option>
														<option value="Tabasco">Tabasco</option>
														<option value="Tamaulipas">Tamaulipas</option>
														<option value="Tlaxcala">Tlaxcala</option>
														<option value="Veracruz">Veracruz</option>
														<option value="Yucatán">Yucatán</option>
														<option value="Zacatecas">Zacatecas</option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">País</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<select class="form-control">
														<option value="AF">Afganistán</option> 
			                      <option value="AL">Albania</option> 
			                      <option value="DE">Alemania</option> 
			                      <option value="AD">Andorra</option> 
			                      <option value="AO">Angola</option> 
			                      <option value="AI">Anguilla</option> 
			                      <option value="AQ">Antártida</option> 
			                      <option value="AG">Antigua y Barbuda</option> 
			                      <option value="AN">Antillas Holandesas</option> 
			                      <option value="SA">Arabia Saudí</option> 
			                      <option value="DZ">Argelia</option> 
			                      <option value="AR">Argentina</option> 
			                      <option value="AM">Armenia</option> 
			                      <option value="AW">Aruba</option> 
			                      <option value="AU">Australia</option> 
			                      <option value="AT">Austria</option>  
			                      <option value="AZ">Azerbaiyán</option>  
			                      <option value="BS">Bahamas</option>  
			                      <option value="BH">Bahrein</option>  
			                      <option value="BD">Bangladesh</option>  
			                      <option value="BB">Barbados</option>  
			                      <option value="BE">Bélgica</option>  
			                      <option value="BZ">Belice</option>  
			                      <option value="BJ">Benin</option>  
			                      <option value="BM">Bermudas</option>  
			                      <option value="BY">Bielorrusia</option>  
			                      <option value="MM">Birmania</option>  
			                      <option value="BO">Bolivia</option>  
			                      <option value="BA">Bosnia y Herzegovina</option>  
			                      <option value="BW">Botswana</option>  
			                      <option value="BR">Brasil</option>  
			                      <option value="BN">Brunei</option>  
			                      <option value="BG">Bulgaria</option>  
			                      <option value="BF">Burkina Faso</option>  
			                      <option value="BI">Burundi</option>  
			                      <option value="BT">Bután</option>  
			                      <option value="CV">Cabo Verde</option>  
			                      <option value="KH">Camboya</option>  
			                      <option value="CM">Camerún</option>  
			                      <option value="CA">Canadá</option>  
			                      <option value="TD">Chad</option>  
			                      <option value="CL">Chile</option>  
			                      <option value="CN">China</option>  
			                      <option value="CY">Chipre</option>  
			                      <option value="VA">Ciudad del Vaticano (Santa Sede)</option>  
			                      <option value="CO">Colombia</option>  
			                      <option value="KM">Comores</option>  
			                      <option value="CG">Congo</option>  
			                      <option value="CD">Congo, República Democrática del</option>  
			                      <option value="KR">Corea</option>  
			                      <option value="KP">Corea del Norte</option>  
			                      <option value="CI">Costa de Marfíl</option>  
			                      <option value="CR">Costa Rica</option>  
			                      <option value="HR">Croacia (Hrvatska)</option>  
			                      <option value="CU">Cuba</option>  
			                      <option value="DK">Dinamarca</option>  
			                      <option value="DJ">Djibouti</option>  
			                      <option value="DM">Dominica</option>  
			                      <option value="EC">Ecuador</option>  
			                      <option value="EG">Egipto</option>  
			                      <option value="SV">El Salvador</option>  
			                      <option value="AE">Emiratos Árabes Unidos</option>  
			                      <option value="ER">Eritrea</option>  
			                      <option value="SI">Eslovenia</option>  
			                      <option value="ES">España</option>  
			                      <option value="US">Estados Unidos</option>  
			                      <option value="EE">Estonia</option>  
			                      <option value="ET">Etiopía</option>  
			                      <option value="FJ">Fiji</option>  
			                      <option value="PH">Filipinas</option>  
			                      <option value="FI">Finlandia</option>  
			                      <option value="FR">Francia</option>  
			                      <option value="GA">Gabón</option>  
			                      <option value="GM">Gambia</option>  
			                      <option value="GE">Georgia</option>  
			                      <option value="GH">Ghana</option>  
			                      <option value="GI">Gibraltar</option>  
			                      <option value="GD">Granada</option>  
			                      <option value="GR">Grecia</option>  
			                      <option value="GL">Groenlandia</option>  
			                      <option value="GP">Guadalupe</option>  
			                      <option value="GU">Guam</option>  
			                      <option value="GT">Guatemala</option>  
			                      <option value="GY">Guayana</option>  
			                      <option value="GF">Guayana Francesa</option>  
			                      <option value="GN">Guinea</option>  
			                      <option value="GQ">Guinea Ecuatorial</option>  
			                      <option value="GW">Guinea-Bissau</option>  
			                      <option value="HT">Haití</option>  
			                      <option value="HN">Honduras</option>  
			                      <option value="HU">Hungría</option>  
			                      <option value="IN">India</option>  
			                      <option value="ID">Indonesia</option>  
			                      <option value="IQ">Irak</option>  
			                      <option value="IR">Irán</option>  
			                      <option value="IE">Irlanda</option>  
			                      <option value="BV">Isla Bouvet</option>  
			                      <option value="CX">Isla de Christmas</option>  
			                      <option value="IS">Islandia</option>  
			                      <option value="KY">Islas Caimán</option>  
			                      <option value="CK">Islas Cook</option>  
			                      <option value="CC">Islas de Cocos o Keeling</option>  
			                      <option value="FO">Islas Faroe</option>  
			                      <option value="HM">Islas Heard y McDonald</option>  
			                      <option value="FK">Islas Malvinas</option>  
			                      <option value="MP">Islas Marianas del Norte</option>  
			                      <option value="MH">Islas Marshall</option>  
			                      <option value="UM">Islas menores de Estados Unidos</option>  
			                      <option value="PW">Islas Palau</option>  
			                      <option value="SB">Islas Salomón</option>  
			                      <option value="SJ">Islas Svalbard y Jan Mayen</option>  
			                      <option value="TK">Islas Tokelau</option>  
			                      <option value="TC">Islas Turks y Caicos</option>  
			                      <option value="VI">Islas Vírgenes (EE.UU.)</option>  
			                      <option value="VG">Islas Vírgenes (Reino Unido)</option>  
			                      <option value="WF">Islas Wallis y Futuna</option>  
			                      <option value="IL">Israel</option>  
			                      <option value="IT">Italia</option>  
			                      <option value="JM">Jamaica</option>  
			                      <option value="JP">Japón</option>  
			                      <option value="JO">Jordania</option>  
			                      <option value="KZ">Kazajistán</option>  
			                      <option value="KE">Kenia</option>  
			                      <option value="KG">Kirguizistán</option>  
			                      <option value="KI">Kiribati</option>  
			                      <option value="KW">Kuwait</option>  
			                      <option value="LA">Laos</option>  
			                      <option value="LS">Lesotho</option>  
			                      <option value="LV">Letonia</option>  
			                      <option value="LB">Líbano</option>  
			                      <option value="LR">Liberia</option>  
			                      <option value="LY">Libia</option>  
			                      <option value="LI">Liechtenstein</option>  
			                      <option value="LT">Lituania</option>  
			                      <option value="LU">Luxemburgo</option>  
			                      <option value="MK">Macedonia, Ex-República Yugoslava de</option>  
			                      <option value="MG">Madagascar</option>  
			                      <option value="MY">Malasia</option>  
			                      <option value="MW">Malawi</option>  
			                      <option value="MV">Maldivas</option>  
			                      <option value="ML">Malí</option>  
			                      <option value="MT">Malta</option>  
			                      <option value="MA">Marruecos</option>  
			                      <option value="MQ">Martinica</option>  
			                      <option value="MU">Mauricio</option>  
			                      <option value="MR">Mauritania</option>  
			                      <option value="YT">Mayotte</option>  
			                      <option value="MX" selected>México</option>  
			                      <option value="FM">Micronesia</option>  
			                      <option value="MD">Moldavia</option>  
			                      <option value="MC">Mónaco</option>  
			                      <option value="MN">Mongolia</option>  
			                      <option value="MS">Montserrat</option>  
			                      <option value="MZ">Mozambique</option>  
			                      <option value="NA">Namibia</option>  
			                      <option value="NR">Nauru</option>  
			                      <option value="NP">Nepal</option>  
			                      <option value="NI">Nicaragua</option>  
			                      <option value="NE">Níger</option>  
			                      <option value="NG">Nigeria</option>  
			                      <option value="NU">Niue</option>  
			                      <option value="NF">Norfolk</option>  
			                      <option value="NO">Noruega</option>  
			                      <option value="NC">Nueva Caledonia</option>  
			                      <option value="NZ">Nueva Zelanda</option>  
			                      <option value="OM">Omán</option>  
			                      <option value="NL">Países Bajos</option>  
			                      <option value="PA">Panamá</option>  
			                      <option value="PG">Papúa Nueva Guinea</option>  
			                      <option value="PK">Paquistán</option>  
			                      <option value="PY">Paraguay</option>  
			                      <option value="PE">Perú</option>  
			                      <option value="PN">Pitcairn</option>  
			                      <option value="PF">Polinesia Francesa</option>  
			                      <option value="PL">Polonia</option>  
			                      <option value="PT">Portugal</option>  
			                      <option value="PR">Puerto Rico</option>  
			                      <option value="QA">Qatar</option>  
			                      <option value="UK">Reino Unido</option>  
			                      <option value="CF">República Centroafricana</option>  
			                      <option value="CZ">República Checa</option>  
			                      <option value="ZA">República de Sudáfrica</option>  
			                      <option value="DO">República Dominicana</option>  
			                      <option value="SK">República Eslovaca</option>  
			                      <option value="RE">Reunión</option>  
			                      <option value="RW">Ruanda</option>  
			                      <option value="RO">Rumania</option>  
			                      <option value="RU">Rusia</option>  
			                      <option value="EH">Sahara Occidental</option>  
			                      <option value="KN">Saint Kitts y Nevis</option>  
			                      <option value="WS">Samoa</option>  
			                      <option value="AS">Samoa Americana</option>  
			                      <option value="SM">San Marino</option>  
			                      <option value="VC">San Vicente y Granadinas</option>  
			                      <option value="SH">Santa Helena</option>  
			                      <option value="LC">Santa Lucía</option>  
			                      <option value="ST">Santo Tomé y Príncipe</option>  
			                      <option value="SN">Senegal</option>  
			                      <option value="SC">Seychelles</option>  
			                      <option value="SL">Sierra Leona</option>  
			                      <option value="SG">Singapur</option>  
			                      <option value="SY">Siria</option>  
			                      <option value="SO">Somalia</option>  
			                      <option value="LK">Sri Lanka</option>  
			                      <option value="PM">St. Pierre y Miquelon</option>  
			                      <option value="SZ">Suazilandia</option>  
			                      <option value="SD">Sudán</option>  
			                      <option value="SE">Suecia</option>  
			                      <option value="CH">Suiza</option>  
			                      <option value="SR">Surinam</option>  
			                      <option value="TH">Tailandia</option>  
			                      <option value="TW">Taiwán</option>  
			                      <option value="TZ">Tanzania</option>  
			                      <option value="TJ">Tayikistán</option>  
			                      <option value="TF">Territorios franceses del Sur</option>  
			                      <option value="TP">Timor Oriental</option>  
			                      <option value="TG">Togo</option>  
			                      <option value="TO">Tonga</option>  
			                      <option value="TT">Trinidad y Tobago</option>  
			                      <option value="TN">Túnez</option>  
			                      <option value="TM">Turkmenistán</option>  
			                      <option value="TR">Turquía</option>  
			                      <option value="TV">Tuvalu</option>  
			                      <option value="UA">Ucrania</option>  
			                      <option value="UG">Uganda</option>  
			                      <option value="UY">Uruguay</option>  
			                      <option value="UZ">Uzbekistán</option>  
			                      <option value="VU">Vanuatu</option>  
			                      <option value="VE">Venezuela</option>  
			                      <option value="VN">Vietnam</option>  
			                      <option value="YE">Yemen</option>  
			                      <option value="YU">Yugoslavia</option>  
			                      <option value="ZM">Zambia</option>  
			                      <option value="ZW">Zimbabue</option> 
													</select>
												</div>
											</div>
										</div>

										<hr>

										<h4>Teléfonos</h4>
										<div class="form-group">
											<label class="col-md-4 control-label">Teléfono 1</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-phone"></i>
													<input type="text" class="form-control" id="telefono_1" placeholder="(999) 999-9999" name="telefono_1">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Teléfono 2</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-phone"></i>
													<input type="text" class="form-control" id="telefono_2" placeholder="(999) 999-9999" name="telefono_2">
												</div>
											</div>
										</div>
									</div>
									<!-- CONTACTO -->
									<div class="col-md-6">
										<h4>Contácto <small>- Puedes añadir más contactos en la seccion de gestión</small></h4>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Nombre
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-user"></i>
													<input type="text" class="form-control" placeholder="Nombre">
													<!-- <span class="help-block">A block of help text. </span> -->
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Email</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa  fa-envelope"></i>
													<input type="text" class="form-control" placeholder="Email">
													<span class="help-block">Email personal de la empresa</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Teléfono</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-phone"></i>
													<input type="text" class="form-control" placeholder="Teléfono">
													<span class="help-block">En la empresa (extensión o departamento)</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Puesto</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-certificate"></i>
													<input type="text" class="form-control" placeholder="Puesto">
												</div>
											</div>
										</div>

										<hr>

										<h4>Sistemas de CONTPAQi <small>- Puedes añadir más sistemas en la seccion de gestión</small></h4>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Sistema
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-desktop"></i>
													<select class="form-control">
														<option>CONTPAQi® CONTABILIDAD</option>
														<option>CONTPAQi® NÓMINAS</option>
														<option>CONTPAQi® BANCOS</option>
														<option>CONTPAQi® ADMINPAQ®</option>
														<option>CONTPAQi® COMERCIAL</option>
														<option>CONTPAQi® FACTURA ELECTRÓNICA</option>
														<option>CONTPAQi® PUNTO DE VENTA</option>
													</select>
													<!-- <span class="help-block">A block of help text. </span> -->
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Versión</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-history"></i>
													<select class="form-control">
														<optgroup label="CONTPAQi® CONTABILIDAD">
															<option>7.2.0</option>
															<option>7.1.1</option>
															<option>7.1.0</option>
															<option>6.1.1</option>
															<option>6.0.2</option>
															<option>6.0.1</option>
															<option>6.0.0</option>
															<option>5.1.5</option>
															<option>5.1.4</option>
															<option>5.1.3</option>
															<option>5.1.2</option>
															<option>5.1.1</option>
															<option>5.1.0</option>
															<option>5.0.0</option>
														</optgroup>
														<optgroup label="CONTPAQi® NÓMINAS">
															<option>Chicago Bears</option>
															<option>Detroit Lions</option>
															<option>Green Bay Packers</option>
															<option>Minnesota Vikings</option>
														</optgroup>
														<optgroup label="CONTPAQi® BANCOS">
															<option>Atlanta Falcons</option>
															<option>Carolina Panthers</option>
															<option>New Orleans Saints</option>
															<option>Tampa Bay Buccaneers</option>
														</optgroup>
														<optgroup label="CONTPAQi® ADMINPAQ®">
															<option>7.3.3</option>
															<option>7.3.2</option>
															<option>7.3.1</option>
															<option>7.3.0</option>
															<option>7.2.1</option>
															<option>7.2.0</option>
															<option>7.1.2</option>
															<option>7.1.1</option>
															<option>7.0.0</option>
														</optgroup>
														<optgroup label="CONTPAQi® COMERCIAL">
															<option>Buffalo Bills</option>
															<option>Miami Dolphins</option>
															<option>New England Patriots</option>
															<option>New York Jets</option>
														</optgroup>
															<optgroup label="CONTPAQi® FACTURA ELECTRÓNICA">
															<option>Baltimore Ravens</option>
															<option>Cincinnati Bengals</option>
															<option>Cleveland Browns</option>
															<option>Pittsburgh Steelers</option>
														</optgroup>
														<optgroup label="CONTPAQi® PUNTO DE VENTA">
															<option>Houston Texans</option>
															<option>Indianapolis Colts</option>
															<option>Jacksonville Jaguars</option>
															<option>Tennessee Titans</option>
														</optgroup>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">No. de Serie</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-barcode"></i>
													<input type="text" class="form-control" placeholder="No. de Serie">
												</div>
											</div>
										</div>

										<hr>

										<h4>Info. Equipo de Cómputo <small>- Puedes añadir mas registros en la seccion de gestión</small></h4>
										<div class="form-group">
											<label class="col-md-4 control-label">Nombre del Equipo</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-desktop"></i>
													<input type="text" class="form-control" placeholder="Nombre del Equipo">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Sistema Operativo
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-desktop"></i>
													<select class="form-control">
														<option>Option 1</option>
														<option>Option 2</option>
														<option>Option 3</option>
														<option>Option 4</option>
														<option>Option 5</option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Arquitectura
											</label>
											<div class="col-md-8">
												<div class="radio-list">
													<label class="radio-inline">
														<input type="radio" name="arquitectura" id="arquitectura1" value="option1" checked>
														x64 (64 bits)
													</label>
													<label class="radio-inline">
														<input type="radio" name="arquitectura" id="arquitectura2" value="option2">
														x86 (32 bits)
													</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Máquina Virtual
											</label>
											<div class="col-md-8">
												<div class="radio-list">
													<label class="radio-inline">
														<input type="radio" name="maquina_virtual" id="maquina_virtual1" value="option1">
														Sí
													</label>
													<label class="radio-inline">
														<input type="radio" name="maquina_virtual" id="maquina_virtual2" value="option2" checked>
														No
													</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">
												Memoria RAM
											</label>
											<div class="col-md-8">
												<div id="memoria-ram">
													<div class="input-group input-small">
														<input type="text" class="spinner-input form-control" maxlength="2">
														<div class="spinner-buttons input-group-btn btn-group-vertical">
															<button type="button" class="btn spinner-up btn-xs">
																<i class="fa fa-angle-up"></i>
															</button>
															<button type="button" class="btn spinner-down btn-xs">
																<i class="fa fa-angle-down"></i>
															</button>
														</div>
													</div>
												</div>
												<span class="help-block">GB</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">
												SQL Server
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-database"></i>
													<select class="form-control">
														<option>Option 1</option>
														<option>Option 2</option>
														<option>Option 3</option>
														<option>Option 4</option>
														<option>Option 5</option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">
												SQL Server Management
											</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-database"></i>
													<select class="form-control">
														<option>Option 1</option>
														<option>Option 2</option>
														<option>Option 3</option>
														<option>Option 4</option>
														<option>Option 5</option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Instancia SQL</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa  fa-database"></i>
													<input type="text" class="form-control" placeholder="Instancia SQL">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Contraseña SQL</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa  fa-database"></i>
													<input type="text" class="form-control" placeholder="Contraseña SQL">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
							<button type="submit" class="btn green">Guardar</button>
						</div>
					</form>
				</div>

				<!-- Nuevo Ticket -->
				<div id="nuevo-ticket" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
					<div class="modal-body">
						<p>Would you like to continue with some arbitrary task?</p>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
						<button type="button" data-dismiss="modal" class="btn blue">Continue Task</button>
					</div>
				</div>
				<!-- END VENTANAS MODALES -->
			</div>
		</div>
		<!-- END CONTENT -->