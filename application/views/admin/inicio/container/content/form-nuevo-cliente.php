		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
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
				<!-- BEGIN STYLE CUSTOMIZER -->
				<div class="theme-panel hidden-xs hidden-sm">
					<div class="toggler">
					</div>
					<div class="toggler-close">
					</div>
					<div class="theme-options">
						<div class="theme-option theme-colors clearfix">
							<span>
							THEME COLOR </span>
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
								<a href="<?php echo site_url() ?>">Inicio</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo site_url('admin/add') ?>">Nuevo Cliente</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">

						<div class="tab-pane " id="tab_2">
							<div class="portlet gren">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-gift"></i>Formulario de Nuevo Cliente
									</div>
									<div class="tools">
										<a href="javascript:;" class="collapse">
										</a>
										<a href="javascript:;" class="reload">
										</a>
									</div>
								</div>
								<div class="portlet-body form">
									<!-- BEGIN FORM-->
									<form action="#" class="form-horizontal">
										<div class="form-body">
											<div class="row">
												<!-- DATOS DE LA EMPRESA -->
												<div class="col-md-6">
													<h4 class="form-section">Datos del cliente</h4>
													<!-- RFC -->
													<div class="form-group">
														<label class="control-label col-md-3">R.F.C. : </label>
														<div class="col-md-9">
															<input type="text" class="form-control" placeholder="RFC del cliente">
														</div>
													</div>
													<!-- RAZON SOCIAL -->
													<div class="form-group">
														<label class="control-label col-md-3">Razón Social: </label>
														<div class="col-md-9">
															<input type="text" class="form-control" placeholder="Razon social del cliente">
														</div>
													</div>
													<!-- TELEFONO -->
													<div class="form-group">
														<label class="control-label col-md-3">Telefono 1</label>
														<div class="col-md-4">
															<input class="form-control" id="telefono-cliente" type="text"/>
															<span class="help-block">
															(999) 999-9999 </span>
														</div>
													</div>
													<!-- TELEFONO 2 -->
													<div class="form-group">
														<label class="control-label col-md-3">Telefono 2</label>
														<div class="col-md-4">
															<input class="form-control" id="telefono-cliente" type="text"/>
															<span class="help-block">
															(999) 999-9999 </span>
														</div>
													</div>
													<!-- EMAIL -->
													<div class="form-group">
														<label class="col-md-3 control-label">Email</label>
														<div class="col-md-9">
															<div class="input-group">
																<span class="input-group-addon">
																<i class="fa fa-envelope"></i>
																</span>
																<input type="email" class="form-control" placeholder="Email del cliente">
															</div>
														</div>
													</div>
													<!-- TIPO -->
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
												</div>
												<!-- DATOS DEL DOMICILIO-->
												<div class="col-md-6">
													<h4 class="form-section">Datos del domicilio</h4>
													<!-- CALLE -->
													<div class="form-group">
														<label class="control-label col-md-3">Calle : </label>
														<div class="col-md-9">
															<input type="text" class="form-control">
														</div>
													</div>
													<!-- NO. INTERIOR -->
													<div class="form-group">
														<label class="control-label col-md-3">No. Interior : </label>
														<div class="col-md-9">
															<input type="text" class="form-control">
														</div>
													</div>
													<!-- NO. EXTERIOR -->
													<div class="form-group">
														<label class="control-label col-md-3">No. Exterior : </label>
														<div class="col-md-9">
															<input type="text" class="form-control">
														</div>
													</div>
													<!-- COLONIA -->
													<div class="form-group">
														<label class="control-label col-md-3">Colonia : </label>
														<div class="col-md-9">
															<input type="text" class="form-control">
														</div>
													</div>
													<!-- CODIGO POSTAL-->
													<div class="form-group">
														<label class="control-label col-md-3">C. P. : </label>
														<div class="col-md-9">
															<input type="text" class="form-control">
														</div>
													</div>
													<!-- CIUDAD -->
													<div class="form-group">
														<label class="control-label col-md-3">Ciudad : </label>
														<div class="col-md-9">
															<input type="text" class="form-control">
														</div>
													</div>
													<!-- MUNICIPIO -->
													<div class="form-group">
														<label class="control-label col-md-3">Municipio : </label>
														<div class="col-md-9">
															<input type="text" class="form-control">
														</div>
													</div>
													<!-- ESTADO -->
													<div class="form-group">
														<label class="control-label col-md-3">Estado : </label>
														<div class="col-md-9">
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
													<!-- PAIS -->
													<div class="form-group">
														<label class="control-label col-md-3">Pais : </label>
														<div class="col-md-9">
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
												<!--/span-->
											</div>
										</div>
										<div class="form-actions fluid">
											<div class="row">
												<div class="col-md-12">
													<div class="col-md-offset-4 col-md-9">
														<button type="submit" class="btn green"><i class="fa fa-save"></i> Guardar</button>
														<button type="reset" class="btn default"><i class="fa fa-eraser"></i> Limpiar</button>
												</div>
											</div>
										</div>
									</form>
									<!-- END FORM-->
								</div>
							</div>
						</div>

					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->