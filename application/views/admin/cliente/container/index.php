
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
							Color </span>
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
						<h3 class="page-title">Blank Page <small>blank page</small></h3>
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
								<a href="index.html">Home</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Page Layouts</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Blank Page</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
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
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->
