<?php require_once( WP_PLUGIN_DIR . '/wpSlackManager/views/includes/header.include.php'  ); ?>
	
	<p>
		<a class="ps" href="admin.php?page=wpsm.dashboard"> <?php echo __( 'Home', 'wpSlackManager' ); ?> </a> >
		404
	</p>

	<div class="error_page">
		<h3><?php echo __("Page not found !", "wpSlackManager" ); ?></h3>
		<h4><?php echo __("We're sorry  ¯\_(ツ)_/¯", "wpSlackManager" ); ?></h4>
		<a class="btn" href="<?php echo wp_get_referer(); ?>">Back</a>
	</div>

<?php require_once( WP_PLUGIN_DIR . '/wpSlackManager/views/includes/footer.include.php'  ); ?>