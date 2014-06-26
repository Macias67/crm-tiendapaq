
	<!-- BEGIN FOOTER -->
	<div class="page-footer">
		<div class="page-footer-inner">
			 2014 &copy; TiendaPaq.com
		</div>
		<div class="page-footer-tools">
			<span class="go-top">
			<i class="fa fa-angle-up"></i>
			</span>
		</div>
	</div>
	<!-- END FOOTER -->

	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<!--[if lt IE 9]>
	<script src="<?php echo $assets_global_plugins ?>respond.min.js"></script>
	<script src="<?php echo $assets_global_plugins ?>excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo $assets_global_plugins ?>jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?php echo $assets_global_plugins ?>jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>jquery.cokie.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->

	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script type="text/javascript" src="<?php echo $assets_global_plugins ?>datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo $assets_global_plugins ?>datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
	<script src="<?php echo $assets_global_plugins ?>bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript" ></script>
	<script src="<?php echo $assets_global_plugins ?>bootstrap-modal/js/bootstrap-modal.js" type="text/javascript" ></script>
	<script src="<?php echo $assets_global_plugins ?>fuelux/js/spinner.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo $assets_global_plugins ?>select2/select2.min.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->

	<!-- BEGIN COMPONENT FORM TOOLS PLUGIS -->
	<script type="text/javascript" src="<?php echo $assets_global_plugins ?>jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
	<script type="text/javascript" src="<?php echo $assets_global_plugins ?>jquery-validation/js/jquery.validate.min.js"></script>
	<!-- END COMPONENT FORM TOOLS PLUGINS -->

	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo $assets_global_scripts ?>metronic.js" type="text/javascript"></script>
	<script src="<?php echo $assets_admin_layout ?>scripts/layout.js" type="text/javascript"></script>
	<script src="<?php echo $assets_admin_layout ?>scripts/quick-sidebar.js" type="text/javascript"></script>
	<script src="<?php echo $assets_admin_pages ?>scripts/ui-extended-modals.js" type="text/javascript"></script>
	<script src="<?php echo load_myscript($assets_admin_pages_myscripts, $privilegios, $controlador, 'table-managed') ?>" type="text/javascript"></script>
	<script src="<?php echo load_myscript($assets_admin_pages_myscripts, $privilegios, $controlador, 'form-validation-cliente') ?>" type="text/javascript"></script>
	<script src="<?php echo load_myscript($assets_admin_pages_myscripts, $privilegios, $controlador, 'form-validation-ticket') ?>" type="text/javascript"></script>
	<script src="<?php echo load_myscript($assets_admin_pages_myscripts, $privilegios, $controlador, 'components-form-tools-cliente') ?>" type="text/javascript"></script>
	<script>
		jQuery(document).ready(function() {
			Metronic.init(); // init metronic core components
			Layout.init(); // init current layout
			QuickSidebar.init() // init quick sidebar
			TableManaged.init(); // table-managed
			FormValidationCliente.init(); // form-validation-cliente
			FormValidationTicket.init(); // form-validation-ticket
			ComponentsFormTools.init(); //form-components-tools de agregar clientes
			UIExtendedModals.init();
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>