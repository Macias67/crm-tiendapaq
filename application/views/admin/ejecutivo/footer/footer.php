
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
	<script src="<?php echo $assets_global_plugins ?>jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>jquery-migrate.min.js" type="text/javascript"></script>
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
	<script type="text/javascript" src="<?php echo $assets_global_plugins ?>jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
	<script type="text/javascript" src="<?php echo $assets_global_plugins ?>jquery-validation/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo $assets_global_plugins ?>bootstrap-fileinput/bootstrap-fileinput.js"></script>
	<script src="<?php echo $assets_global_plugins ?>jcrop/js/jquery.color.js"></script>
	<script src="<?php echo $assets_global_plugins ?>jcrop/js/jquery.Jcrop.min.js"></script>
	<script src="<?php echo $assets_global_plugins ?>bootbox/bootbox.min.js" type="text/javascript" ></script>
	<script type="text/javascript" src="<?php echo $assets_global_plugins ?>datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo $assets_global_plugins ?>datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo $assets_global_plugins ?>bootstrap-modal/js/bootstrap-modalmanager.js"></script>
	<script type="text/javascript" src="<?php echo $assets_global_plugins ?>fuelux/js/spinner.min.js"></script>
	<script type="text/javascript" src="<?php echo $assets_global_plugins ?>bootstrap-modal/js/bootstrap-modal.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->

	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo $assets_global_scripts ?>metronic.js" type="text/javascript"></script>
	<script src="<?php echo $assets_admin_layout ?>scripts/layout.js" type="text/javascript"></script>
	<script src="<?php echo $assets_admin_layout ?>scripts/quick-sidebar.js" type="text/javascript"></script>
	<script src="<?php echo load_myscript($assets_admin_pages_myscripts, $privilegios, $controlador, 'components-form-tools-ejecutivo') ?>" type="text/javascript"></script>
	<script src="<?php echo load_myscript($assets_admin_pages_myscripts, $privilegios, $controlador, 'form-validation-ejecutivo') ?>" type="text/javascript"></script>
	<script src="<?php echo load_myscript($assets_admin_pages_myscripts, $privilegios, $controlador, 'form-image-crop-ejecutivo') ?>" type="text/javascript"></script>
	<script src="<?php echo load_myscript($assets_admin_pages_myscripts, $privilegios, $controlador, 'table-managed-ejecutivo') ?>" type="text/javascript"></script>
	<script src="<?php echo load_myscript($assets_admin_pages_myscripts, $privilegios, $controlador, 'ajax-modals-ejecutivo') ?>" type="text/javascript"></script>
	<script>
		jQuery(document).ready(function() {
			Metronic.init(); // init metronic core components
			Layout.init(); // init current layout
			QuickSidebar.init() // init quick sidebar
			//MyScripts
			ComponentsFormToolsEjecutivo.init();//init de las mascaras de ejecutivo
			FormValidationEjecutivo.init(); //validacion para editar imagen en perfil
			FormImageCropEjecutivo.init();//para recortar imagenes
			TableManaged.init(); //plugin para la tabla de pendientes
			UIExtendedModals.init(); //modal de los detalles de los pendientes
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>