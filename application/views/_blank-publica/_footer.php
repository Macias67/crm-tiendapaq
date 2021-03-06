
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="container">
		 <?php echo date('Y') ?>&copy; <?php echo $nombre_empresa ?>
	</div>
</div>
<div class="scroll-to-top">
	<i class="icon-arrow-up"></i>
</div>
<!-- END FOOTER -->

	<!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<!--[if lt IE 9]>
	<script src="<?php echo $assets_global_plugins ?>respond.min.js"></script>
	<script src="<?php echo $assets_global_plugins ?>excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo $assets_global_plugins ?>jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>jquery-migrate.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?php echo $assets_global_plugins ?>jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>jquery.cokie.min.js" type="text/javascript"></script>
	<script src="<?php echo $assets_global_plugins ?>uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->

	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<!-- Aqui van las librerias de los plugins -->
	<!-- END PAGE LEVEL PLUGINS -->

	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo $assets_global_scripts ?>metronic.js" type="text/javascript"></script>
	<script src="<?php echo $assets_admin_layout ?>scripts/layout.js" type="text/javascript"></script>
	<script src="<?php echo $assets_admin_layout ?>scripts/demo.js" type="text/javascript"></script>
	<script src="<?php echo $assets_admin_pages ?>scripts/index3.js" type="text/javascript"></script>
	<script src="<?php echo $assets_admin_pages ?>scripts/tasks.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL SCRIPTS -->
	<script>
	jQuery(document).ready(function() {
		Metronic.init(); // init metronic core componets
		Layout.init(); // init layout
		Demo.init(); // init demo(theme settings page)
		Index.init(); // init index page
		Tasks.initDashboardWidget(); // init tash dashboard widget
	});
	</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>